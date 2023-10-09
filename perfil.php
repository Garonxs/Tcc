<?php
require_once "config\Conecao.php";

if (!isset($_COOKIE["usuario_logado"]) || $_COOKIE["usuario_logado"] !== "true") {
    header("Location: login.html");
    exit;
}

$id = $_COOKIE["idusuario"];

$pdo = new Conecao("root", "");
$pdo = $pdo->criarConexao();
$sql = "SELECT * FROM usuario WHERE id_usuario = {$id}";
$stmt = $pdo->query($sql);
$perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css">
    <title>Meu Perfil</title>
</head>
<body>
<header>
    <h1>Meu Perfil</h1>
    <div id="logo"></div>
    <a href="pagina_inicial.html" id="pagina-inicial">Página Inicial</a>
</header>
<main>
    <section id="informacoes">
        <img src="sua_foto.jpg" alt="Minha Foto">
        <h2>Nome: <span id="nome" contenteditable="false"><?php echo $perfil[0]['nome']; ?></span></h2>
        <p>Email: <span id="email" contenteditable="false"><?php echo $perfil[0]['email']; ?></span></p>
        <p>Idade: <span id="idade" contenteditable="false"><?php echo $perfil[0]['idade']; ?></span></p>
        <p>Telefone: <span id="localizacao" contenteditable="false"><?php echo $perfil[0]['telefone']; ?></span></p>
        <p>Mensagens Enviadas: <span id="mensagens-enviadas"><?php echo $perfil[0]['qtdmensagem']; ?></span></p>
        <p>Punições: <span id="punicoes"><?php echo $perfil[0]['qtdpunicao']; ?></span></p>
        <button id="editar">Editar</button>
    </section>
</main>

<script>
    const editarBotao = document.getElementById('editar');
    const spansEditaveis = document.querySelectorAll('[contenteditable]');

    editarBotao.addEventListener('click', () => {
        if (editarBotao.textContent === 'Editar') {
            editarBotao.textContent = 'Salvar';

            spansEditaveis.forEach(span => {
                span.contentEditable = 'true';
                span.style.border = '1px solid orange';
                span.style.backgroundColor = 'white';
            });
        } else {
            editarBotao.textContent = 'Editar';

            spansEditaveis.forEach(span => {
                span.contentEditable = 'false';
                span.style.border = 'none';
                span.style.backgroundColor = 'transparent';
            });
        }
    });
</script>
</body>
</html>
