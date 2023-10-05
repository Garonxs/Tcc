var username = generateUsername();
var canSendMessage = true;
var delayTime = 3000; 
var delayMessageElement = document.getElementById("delayMessage");
var forbiddenWords = ["smt", "se mata", "se corta"]; 
var userWarnings = {}; 

function generateUsername() {
  var randomNumber = Math.floor(Math.random() * 10000);
  return "user" + randomNumber;
}

function sendMessage() {
  if (!canSendMessage) {
    return;
  }

  var messageInput = document.getElementById("message");
  var message = messageInput.value.trim(); 

  if (message !== "") {
    if (containsForbiddenWord(message)) {
      var userWarningCount = incrementUserWarningCount(username);
      if (userWarningCount >= 3) {
        banUser(username);
        return;
      } else {
        alert("Você usou uma palavra proibida. Mais duas advertências resultarão em restrição de chat.");
        messageInput.value = "";
        return;
      }
    }

    var chatbox = document.getElementById("chatbox");
    chatbox.innerHTML += "<p><strong>" + username + ":</strong> " + message + "</p>";

    if (chatbox.scrollHeight > chatbox.clientHeight) {
      chatbox.scrollTop = chatbox.scrollHeight - chatbox.clientHeight;
    }
  }

  messageInput.value = "";
  canSendMessage = false;

  var secondsRemaining = delayTime / 1000;

  updateDelayMessage(secondsRemaining);

  var countdownInterval = setInterval(function() {
    secondsRemaining--;
    updateDelayMessage(secondsRemaining);

    if (secondsRemaining <= 0) {
      canSendMessage = true;
      clearInterval(countdownInterval);
      updateDelayMessage(0);
    }
  }, 1000);
}

function containsForbiddenWord(message) {
  for (var i = 0; i < forbiddenWords.length; i++) {
    var forbiddenWord = forbiddenWords[i];
    if (message.toLowerCase().includes(forbiddenWord.toLowerCase())) {
      return true;
    }
  }
  return false;
}

function incrementUserWarningCount(username) {
  if (!userWarnings[username]) {
    userWarnings[username] = 0;
  }
  userWarnings[username]++;
  return userWarnings[username];
}

function banUser(username) {
  alert("Você foi restrito de enviar mensagens devido ao uso de palavras proibidas.");
  var messageInput = document.getElementById("message");
  messageInput.disabled = true;
  messageInput.value = "";
}

function updateDelayMessage(secondsRemaining) {
  if (secondsRemaining > 0) {
    delayMessageElement.textContent = "Aguarde " + secondsRemaining + " segundo(s) antes de enviar uma nova mensagem.";
  } else {
    delayMessageElement.textContent = "";
  }
}

function handleKeyDown(event) {
  if (event.key === "Enter") {
    sendMessage();
  }
}
