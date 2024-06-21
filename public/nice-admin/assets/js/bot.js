// document.getElementById('toggle-chat').addEventListener('click', function() {
//     const chatWidget = document.getElementById('chat-widget');
//     chatWidget.style.display = chatWidget.style.display === 'none' ? 'flex' : 'none';
// });

// document.getElementById('close-chat').addEventListener('click', function() {
//     const chatWidget = document.getElementById('chat-widget');
//     chatWidget.style.display = 'none';
// });

// document.getElementById('send-message').addEventListener('click', function() {
//     const userInput = document.getElementById('user-input');
//     const message = userInput.value;
//     if (message.trim() !== "") {
//         appendMessage('user', message);
//         userInput.value = '';
//         getBotResponse(message);
//     }
// });

// document.querySelectorAll('.shortcut').forEach(button => {
//     button.addEventListener('click', function() {
//         const message = this.getAttribute('data-message');
//         appendMessage('user', message);
//         getBotResponse(message);
//     });
// });

// function appendMessage(sender, message) {
//     const chatBody = document.getElementById('chat-body');
//     const messageDiv = document.createElement('div');
//     messageDiv.classList.add('message', sender);
//     messageDiv.textContent = message;
//     chatBody.appendChild(messageDiv);
//     chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the bottom
// }

// const sensitiveWords = ["sara", "unsur sara", "kata sensitif", "rasis", "diskriminasi"];

// const responses = {
//     "halo": "Halo! Ada yang bisa saya bantu?",
//     "siapa kamu": "Saya adalah asisten virtual Anda.",
//     "terima kasih": "Sama-sama! Ada lagi yang bisa saya bantu?",
//     "bye": "Sampai jumpa!",
//     "ip internet error": "Silakan tuliskan IP yang saat ini digunakan, kami akan memperbaikinya.",
//     "absensi tidak bisa": "Mohon pastikan aplikasi absensi Anda sudah diperbarui dan coba lagi.",
//     "lain-lain": "Apa yang bisa kami bantu?",
//     "budaya kerja": "Baca Dokumentasi."
// };

// const defaultResponses = [
//     "Maaf, saya tidak mengerti. Bisa coba tanya lagi?",
//     "Baik, saya mengerti. Ada lagi yang bisa saya bantu?"
// ];

// function containsSensitiveWords(message) {
//     return sensitiveWords.some(word => message.includes(word));
// }

// function getBotResponse(message) {
//     const lowerMessage = message.toLowerCase();

//     if (containsSensitiveWords(lowerMessage)) {
//         appendMessage('bot', "Maaf, saya tidak mengerti. Bisa coba tanya lagi?");
//         return;
//     }

//     if (responses[lowerMessage]) {
//         appendMessage('bot', responses[lowerMessage]);
//     } else {
//         appendMessage('bot', "Baik, saya mengerti. Ada lagi yang bisa saya bantu?");
//     }
// }

document.getElementById('toggle-chat').addEventListener('click', function() {
    const chatWidget = document.getElementById('chat-widget');
    console.log('Toggle chat widget:', chatWidget.style.display);
    chatWidget.style.display = chatWidget.style.display === 'none' ? 'flex' : 'none';
});

document.getElementById('close-chat').addEventListener('click', function() {
    const chatWidget = document.getElementById('chat-widget');
    console.log('Close chat widget');
    chatWidget.style.display = 'none';
});

document.getElementById('send-message').addEventListener('click', function() {
    const userInput = document.getElementById('user-input');
    const message = userInput.value;
    console.log('Send message clicked:', message);
    if (message.trim() !== "") {
        appendMessage('user', message);
        userInput.value = '';
        sendMessageToServer(message);
    }
});

document.querySelectorAll('.shortcut').forEach(button => {
    button.addEventListener('click', function() {
        const message = this.getAttribute('data-message');
        console.log('Shortcut clicked:', message);
        appendMessage('user', message);
        sendMessageToServer(message);
    });
});

function appendMessage(sender, message) {
    const chatBody = document.getElementById('chat-body');
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message', sender);
    messageDiv.textContent = message;
    console.log('Appending message:', sender, message);
    chatBody.appendChild(messageDiv);
    chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the bottom
}

const sensitiveWords = ["sara", "unsur sara", "kata sensitif", "rasis", "diskriminasi"];

const responses = {
    "halo": "Halo! Ada yang bisa saya bantu?",
    "siapa kamu": "Saya adalah MitraHealth yang akan menjadi asisten virtual Anda.",
    "terima kasih": "Sama-sama! Ada lagi yang bisa saya bantu?",
    "bye": "Sampai jumpa!",
    "ip internet error": "Silakan tuliskan IP yang saat ini Anda gunakan, kami akan memperbaikinya dan silahkan coba kembali untuk beberapa saat.",
    "face id": "Mohon pastikan aplikasi absensi Anda sudah diperbarui dan coba lagi dan gunakan wajah yang sudah didaftarkan.",
    "lain-lain": "Apa yang bisa kami bantu?",
    "budaya kerja": "Baca Dokumentasi."
};

function containsSensitiveWords(message) {
    return sensitiveWords.some(word => message.includes(word));
}

function sendMessageToServer(message) {
    console.log('Sending message to server:', message);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ body: message })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response from server:', data);
        if (containsSensitiveWords(message)) {
            appendMessage('bot', "Maaf, saya tidak mengerti. Bisa coba tanya lagi?");
        } else if (responses[message.toLowerCase()]) {
            appendMessage('bot', responses[message.toLowerCase()]);
        } else {
            appendMessage('bot', data.reply || "Baik, saya mengerti. Ada lagi yang bisa saya bantu?");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        appendMessage('bot', "Maaf, terjadi kesalahan. Silakan coba lagi.");
    });
}
