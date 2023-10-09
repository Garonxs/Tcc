<!DOCTYPE html>
<html>
<head>
    <title>Chat Anônimo</title>
    <link rel="stylesheet" type="text/css" href="config.css">
</head>
<body>
<h1>Help Company</h1>
<hr>
<h2>Não é uma vida ruim, é apenas um dia ruim, lembre-se disso!</h2>
<div id="chatbox"></div>

<input type="text" id="message" placeholder="Digite sua mensagem" onkeydown="handleKeyDown(event)">
<button  onclick="sendMessage()">Enviar</button>

<div id="delayMessage"></div>

<footer>
    <p> &copy; 2023 Help Company. Todos os direitos reservados.</p>
</footer>

<script src="script.js"></script>
</body>
</html>
