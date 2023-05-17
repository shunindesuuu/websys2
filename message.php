<!DOCTYPE html>
<html foxified-108="">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Chat Example</title>
  <link rel="stylesheet" type="text/css" href="./Chat Example_files/styles.css">

<body cz-shortcut-listen="true">
  <div id="chatContainer">
    <div class="message">
      <div><strong>User1</strong></div>
      <div>Hello!</div>
      <div>2023-05-14 09:30:00</div>
    </div>
    <div class="message">
      <div><strong>User2</strong></div>
      <div>Hi there!</div>
      <div>2023-05-14 09:31:00</div>
    </div>
  </div>
  <div id="inputContainer">
    <input type="text" id="messageInput" placeholder="Type a message...">
    <button id="sendButton">Send</button>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var chatContainer = document.getElementById("chatContainer");
      var messageInput = document.getElementById("messageInput");
      var sendButton = document.getElementById("sendButton");

      // Dummy data for demonstration purposes
      var chatData = [
        { sender: "User1", message: "Hello!", timestamp: "2023-05-14 09:30:00" },
        { sender: "User2", message: "Hi there!", timestamp: "2023-05-14 09:31:00" }
      ];

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
      function renderChatMessages() {
        chatContainer.innerHTML = "";
        for (var i = 0; i < chatData.length; i++) {
          var { sender, message, timestamp } = chatData[i];
          var messageHTML = generateMessageHTML(sender, message, timestamp);
          chatContainer.appendChild(messageHTML);
        }
      }

      // Event listener for sending a messag e
      sendButton.addEventListener("click", function () {
        var newMessage = messageInput.value;
        if (newMessage.trim() !== "") {
          // Perform logic to send the message
          // ...
          // For demonstration, we'll just add it to the chatData array
          chatData.push({
            sender: "User1",
            message: newMessage,
            timestamp: new Date().toISOString()
          });
          renderChatMessages();
          messageInput.value = "";
        }
      });

      // Initial rendering of chat messages
      renderChatMessages();
    });
  </script>

  <style>
    #chatContainer {
      height: 400px;
      overflow-y: scroll;
      padding: 10px;
    }

    .message {
      background-color: #f2f2f2;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
    }

    #inputContainer {
      padding: 10px;
      background-color: #f2f2f2;
    }

    #messageInput {
      width: 70%;
      padding: 8px;
      border: none;
      border-radius: 4px;
      margin-right: 5px;
    }

    #sendButton {
      padding: 8px 16px;
      background-color: #4CAF50;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>


</body>

</html>