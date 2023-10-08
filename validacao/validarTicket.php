<?php
require_once "..\config\Conecao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conexao = new Conecao("root", "");
    $conexao = $conexao->criarConexao();

    $nome = $conexao->quote($_POST["nome"]);
    $email = $conexao->quote($_POST["email"]);
    $categoria = $conexao->quote($_POST["categoria"]);
    $assunto = $conexao->quote($_POST["assunto"]);
    $mensagem = $conexao->quote($_POST["mensagem"]);

    $sql = "INSERT INTO ticket (nome, email, categoria, mensagem, assunto) VALUES ($nome, $email, $categoria, $mensagem, $assunto)";

    $stmt = $conexao->prepare($sql);

    if ($stmt->execute()) {
        echo 'Ticket enviado!';
    } else {
        echo 'Erro na execução da consulta.';
    }
}

?>
