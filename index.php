<!DOCTYPE html>
<html>
<head>
    <title>Help Company</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <h1>Help Company</h1>
        </div>
        <ul>
            <?php
            if($_COOKIE["usuario_logado"] == "false")
            {
                echo('<li><a href="login.html">Cadastre-se</a></li>');
            }else{
                echo('<li><a href="ticket.html" target="_Blank">Suporte</a></li>');
            }
            ?>
            <li><a href="sobre.html" target="_Blank">Sobre</a></li>
            <li><a href="servicos.html" target="_Blank">Serviços</a></li>
            <li><a href="Contato.html" target="_Blank">Contato</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <h2>Bem-vindo à Help Company</h2>
        <p>Sua solução completa para todas as suas necessidades.</p>
        <a href="chat.php" class="btn" target="_Blank">Acesse nosso chat</a>
    </div>
</section>

<footer>
    <p>&copy; 2023 Help Company. Todos os direitos reservados.</p>
</footer>
</body>
</html>
