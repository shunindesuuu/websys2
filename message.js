document.addEventListener("DOMContentLoaded", function () {
    var chatContainer = document.getElementById("chatContainer");
    var messageInput = document.getElementById("messageInput");
    var sendButton = document.getElementById("sendButton");

    // Function to generate chat message HTML
    function generateMessageHTML(sender, message, timestamp) {
        var messageElement = document.createElement("div");
        messageElement.classList.add("message");
        messageElement.innerHTML = `
        <div><strong>${sender}</strong></div>
        <div>${message}</div>
        <div>${timestamp}</div>
      `;
        return messageElement;
    }

    // Function to render chat messages
    function renderChatMessages(messages) {
        chatContainer.innerHTML = "";
        for (var i = 0; i < messages.length; i++) {
            var { sender, message, timestamp } = messages[i];
            var messageHTML = generateMessageHTML(sender, message, timestamp);
            chatContainer.appendChild(messageHTML);
        }
    }

    // Function to retrieve chat messages from the server
    function getChatMessages() {
        fetch("read_chat_data.php")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                renderChatMessages(data);
            })
            .catch(function (error) {
                console.log("Error fetching chat messages:", error);
            });
    }

    // Event listener for sending a message
    sendButton.addEventListener("click", function () {
        var newMessage = messageInput.value;
        if (newMessage.trim() !== "") {
            // Send the message to the server
            var formData = new FormData();
            formData.append("message", newMessage);
            formData.append("recipient", "Admin");

            fetch("insert_chat_data.php", {
                method: "POST",
                body: formData,
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // Successfully inserted the message, update chat messages
                    getChatMessages();
                })
                .catch(function (error) {
                    console.log("Error sending chat message:", error);
                });

            messageInput.value = "";
        }
    });

    // Initial rendering of chat messages
    getChatMessages();
});

function openFormPopup() {
    document.getElementById('popup-container').style.display = 'flex';
}

function closeFormPopup() {
    document.getElementById('popup-container').style.display = 'none';
}
