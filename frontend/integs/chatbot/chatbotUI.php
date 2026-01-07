<?php
session_start(); 
$_title="Chat EscaPinas";

if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['prompt'])) {
    $user_question = $_POST['prompt'];
    
    $_SESSION['chat_history'][] = ['role' => 'user', 'message' => $user_question];

    $data_path = __DIR__ . "/data.txt"; 
    
    if (file_exists($data_path)) {
        $data_context = file_get_contents($data_path);
    } else {
        $data_context = "EscaPinas is a travel agency in the Philippines providing tour packages for Luzon, Visayas, and Mindanao.";
    }

    $history_string = "";
    foreach (array_slice($_SESSION['chat_history'], -5) as $chat) { 
        $history_string .= ($chat['role'] == 'user' ? "Guest: " : "AI: ") . $chat['message'] . "\n";
    }

    $prompt = <<<EOT
You are the EscaPinas Professional Travel Consultant.
Your goal is to provide accurate, courteous, and formal assistance to our valued guests.

GUIDELINES:
1. Always maintain a professional, helpful, and welcoming tone.
2. For greetings, respond with "Magandang araw, I'm EscaPinas! How may I assist you today?".
3. Use ONLY the provided data.
4. If unknown, offer to connect to a human representative.
5. Use "po" and "opo" for Tagalog.
---- BEGIN DATA ----
$data_context
---- End Data ----
History:
$history_string
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
    $data = json_decode($response, true);
    $bot_reply = $data['response'] ?? '(no reply)';

    $_SESSION['chat_history'][] = ['role' => 'bot', 'message' => $bot_reply];

    echo $bot_reply;
    exit();
}

include __DIR__ . "/../../components/header.php";
include __DIR__ . "/../../components/navbar.php";
?>

<link rel="stylesheet" href="../../assets/css/chatbot.css">
<body class="vh-100 d-flex flex-column overflow-hidden">

    <div class="bg-white shadow-sm py-3 sticky-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2 col-md-3">
                    <a href="javascript:history.back()" class="btn btn-outline-success border-0 rounded-circle">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-8 col-md-6 text-center">
                    <h2 class="m-0 fw-bold text-success" style="letter-spacing: 1px;">EscaPinas</h2>
                    <small class="text-muted">Chat Support</small>
                </div>
                <div class="col-2 col-md-3"></div>
            </div>
        </div>
    </div>

    <div id="chatbox" class="flex-grow-1 overflow-auto p-4" style="background-color: var(--chat-bg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8" id="chat-content">
                    
                    <div class="bot-bubble bubble shadow-sm d-inline-block w-auto">
                        <strong>EscaPinas:</strong><br>
                        Magandang Buhay! I'm EscaPinas. How can I help you plan your Philippine adventure today?
                    </div>

                    <?php if(isset($_SESSION['chat_history'])): ?>
                        <?php foreach ($_SESSION['chat_history'] as $chat): ?>
                            <?php if ($chat['role'] == 'user'): ?>
                                <div class="text-end mb-3">
                                    <div class="user-bubble bubble d-inline-block text-start" style="max-width: 85%;">
                                        <?php echo htmlspecialchars($chat['message']); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-start mb-3">
                                    <div class="bot-bubble bubble d-inline-block" style="max-width: 85%;">
                                        <strong>EscaPinas:</strong><br><?php echo htmlspecialchars($chat['message']); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="chat-input-section shadow-lg bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <textarea id="prompt" class="form-control custom-textarea shadow-none" 
                                placeholder="Write your question here..."
                                rows="1"
                                onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMessage();}"></textarea>
                        </div>
                        <div class="col-auto">
                            <button id="sendBtn" onclick="sendMessage()" class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatContainer = document.getElementById('chatbox');
        chatContainer.scrollTop = chatContainer.scrollHeight;

        function sendMessage() {
            const input = document.getElementById('prompt');
            const chatContent = document.getElementById('chat-content'); 
            const sendBtn = document.getElementById('sendBtn');
            const text = input.value.trim();
            
            if (!text) return;

            const userWrapper = document.createElement('div');
            userWrapper.className = 'text-end mb-3';
            userWrapper.innerHTML = `<div class="user-bubble bubble d-inline-block text-start" style="max-width: 85%;">${text}</div>`;
            chatContent.appendChild(userWrapper);
            
            input.value = "";
            input.disabled = true;
            sendBtn.disabled = true;

            const reply_id = "bot_" + Date.now();
            const botWrapper = document.createElement('div');
            botWrapper.className = 'text-start mb-3';
            botWrapper.innerHTML = `
                <div id="${reply_id}" class="bot-bubble bubble d-inline-block" style="max-width: 85%;">
                    <div class="spinner-grow spinner-grow-sm text-success" role="status"></div>
                </div>`;
            chatContent.appendChild(botWrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            fetch(window.location.href, {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded" },
                body: "prompt=" + encodeURIComponent(text)
            })
            .then(res => res.text())
            .then(reply => {
                document.getElementById(reply_id).innerHTML = `<strong>EscaPinas:</strong><br>${reply}`;
                chatContainer.scrollTop = chatContainer.scrollHeight;
            })
            .finally(() => {
                input.disabled = false;
                sendBtn.disabled = false;
                input.focus();
            });
        }
    </script>
</body>