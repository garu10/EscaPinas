<?php
// 1. PHP BACKEND LOGIC (Processes the AI Request)
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['prompt'])) {
    $user_question = $_POST['prompt'];
    
    // ADJUST PATH: Since chatbotUI.php is in /integs/chatbot/
    // We assume data.txt is in /assets/culture_chatbot_data/ (back 2 levels)
    $data_path = __DIR__ . "/../../assets/culture_chatbot_data/data.txt";
    
    if (file_exists($data_path)) {
        $data_context = file_get_contents($data_path);
    } else {
        $data_context = "EscaPinas is a travel agency in the Philippines providing tour packages for Luzon, Visayas, and Mindanao.";
    }

    $prompt = <<<EOT
You are EscaPinas assistant. Answer using the data below.
If unsure, say "No specific data about that topic."
---- BEGIN DATA ----
$data_context
---- End Data ----
Question: $user_question
Answer:
EOT;

    $url = 'http://127.0.0.1:11434/api/generate';
    $payload = json_encode(['model' => 'qwen3:0.6b', 'prompt' => $prompt, 'stream' => false]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code != 200) {
        echo "(Connection Error: HTTP $http_code)";
    } else {
        $data = json_decode($response, true);
        echo $data['response'] ?? '(no reply)';
    }
    exit(); // Stop further HTML rendering
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot - EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/chatbot.css">
</head>
<body class="vh-100 d-flex flex-column overflow-hidden">

    <div class="bg-white shadow-sm border-bottom">
        <div class="container-fluid px-4 py-2">
            <div class="row align-items-center">
                <div class="col">
                     <a class="navbar-brand fw-bold" href="../../index.php">
                        <img src="../../assets/images/logo2.jpg" height="90" class="d-inline-block align-text-top"> 
                    </a>
                </div>
                <div class="col text-center">
                    <h1 class="m-0 fw-bold header-title">CHATBOT</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container-fluid px-4 py-3">
            <div class="row">
                <div class="col-12">
                    <a href="../../index.php" class="back-link fw-bold text-decoration-none">BACK</a>
                </div>
            </div>
        </div>
    </div>

    <div id="chatbox" class="flex-grow-1 overflow-auto bg-white p-4">
        <div class="d-flex flex-column" id="chat-content">
            <div class="bot-bubble rounded-3 p-3 mb-3" style="max-width: 80%; background-color: #f1f1f1;">
                Magandang Buhay, I'm EscaPinas! What can I help you?
            </div>
        </div>
    </div>

    <div class="chat p-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12 d-flex gap-2">
                    <textarea id="prompt" class="form-control border-0 p-2 shadow-none custom-textarea" 
                        placeholder="Type a message here..."
                        onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMessage();}"></textarea>
                    <button id="sendBtn" onclick="sendMessage()" class="btn btn-success send-btn px-4 fw-bold text-white border-0 text-uppercase">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            const input = document.getElementById('prompt');
            const chatContent = document.getElementById('chat-content'); 
            const sendBtn = document.getElementById('sendBtn');
            const text = input.value.trim();
            
            if (!text) return;

            // 1. Add User Bubble
            const u = document.createElement('div');
            u.className = 'user-bubble rounded-3 p-3 mb-3 align-self-end text-white ms-auto';
            u.style.backgroundColor = '#198754';
            u.style.maxWidth = '80%';
            u.textContent = text;
            chatContent.appendChild(u);
            
            // Clear input and lock UI
            input.value = "";
            input.disabled = true;
            sendBtn.disabled = true;

            // 2. Add "Processing" Bubble for Bot
            const reply_id = "bot_" + Date.now();
            const b = document.createElement('div');
            b.id = reply_id;
            b.className = 'bot-bubble rounded-3 p-3 mb-3';
            b.style.maxWidth = '80%';
            b.style.backgroundColor = '#f1f1f1';
            b.innerHTML = "<b>EscaPinas:</b> <small>Typing...</small>";
            chatContent.appendChild(b);

            // Scroll to bottom
            const chatContainer = document.getElementById('chatbox');
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // 3. FETCH DATA FROM PHP BLOCK ABOVE
            fetch("chatbotUI.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded" },
                body: "prompt=" + encodeURIComponent(text)
            })
            .then(res => res.text())
            .then(reply => {
                document.getElementById(reply_id).innerHTML = `<b>EscaPinas:</b> ${reply}`;
            })
            .catch(() => {
                document.getElementById(reply_id).innerHTML = "<b>EscaPinas:</b> Sorry, I'm having trouble connecting right now.";
            })
            .finally(() => {
                input.disabled = false;
                sendBtn.disabled = false;
                input.focus();
                chatContainer.scrollTop = chatContainer.scrollHeight;
            });
        }
    </script>
</body>
</html>