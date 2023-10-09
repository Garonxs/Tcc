<?php
require_once "..\config\Conecao.php";

if (!isset($_COOKIE["usuario_logado"]) || $_COOKIE["usuario_logado"] !== "true") {
    header("Location: login.html");
    exit;
}

$id = $_COOKIE["idusuario"];

$pdoConexao = new Conecao("root", "");
$pdo = $pdoConexao->criarConexao();

$sql = "SELECT * FROM usuario WHERE id_usuario = {$id}";
$stmt = $pdo->query($sql);
$perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $qtdAtual = $perfil[0]["qtdmensagem"];
    $qtdAtual += 1;
    $id = $perfil[0]["id_usuario"];

    $sql = "UPDATE usuario
                SET qtdmensagem = {$qtdAtual}
            WHERE id_usuario = {$id}";
    $pdo->query($sql);
    // Recarregue o perfil após a atualização
    $stmt = $pdo->query("SELECT * FROM usuario WHERE id_usuario = {$id}");
    $perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
