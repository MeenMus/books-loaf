<!DOCTYPE html>
<html>
<head>
    <title>Book Assistant Chat</title>
    <style>
        #chat { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; }
        .message { margin: 10px 0; }
        .user { font-weight: bold; }
    </style>
</head>
<body>
    <div id="chat">
        <div id="messages"></div>
        <input type="text" id="userInput" placeholder="Ask about a book..." />
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        async function sendMessage() {
            const input = document.getElementById('userInput');
            const msg = input.value;
            if (!msg) return;

            const messages = document.getElementById('messages');
            messages.innerHTML += `<div class="message user">You: ${msg}</div>`;
            input.value = '';

            const res = await fetch('/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ message: msg })
            });
            const data = await res.json();
            messages.innerHTML += `<div class="message">LoafBot: ${data.reply}</div>`;
        }
    </script>
</body>
</html>