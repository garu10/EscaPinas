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
                     <a class="navbar-brand fw-bold" href="/EscaPinas/index.php">
                    <img src="../../assets/images/logo2.jpg" height="90" class="d-inline-block align-text-top"> </a>
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
                    <a href="../../../index.php" class="back-link fw-bold text-decoration-none">BACK</a>
                </div>
            </div>
        </div>
    </div>

    <div id="chatbox" class="flex-grow-1 overflow-auto bg-white">
        <div class="container-fluid px-4 py-2 d-flex flex-column">
            <div class="row">
                <div class="col-12 d-flex flex-column">
                    <div class="bot-bubble rounded-3 p-3 mb-3">
                        Magandang Buhay, I'm EscaPinas! What can I help you?
                    </div>
                </div>
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
                    <button onclick="sendMessage()" class="btn send-btn px-4 fw-bold text-white border-0 text-uppercase">Send</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sendMessage() {
            const input = document.getElementById('prompt');
            const chatbox = document.getElementById('chatbox').firstElementChild; 
            const text = input.value.trim();
            if (!text) return;

            const u = document.createElement('div');
            u.className = 'user-bubble rounded-3 p-3 mb-3 align-self-end text-white';
            u.textContent = text;
            chatbox.appendChild(u);
            
            input.value = "";
            document.getElementById('chatbox').scrollTop = document.getElementById('chatbox').scrollHeight;
        }
    </script>
</body>
</html>