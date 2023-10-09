<?php
require_once "..\config\Conecao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $conexao = new Conecao("root", "");

    // Use marcadores de posição na consulta SQL
    $sql = "SELECT * FROM usuario WHERE nome = :username AND senha = :password";
    $stmt = $conexao->criarConexao()->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $idusuario = $result["id_usuario"];

        if ($result !== false) {
            if($result["tipousuario"] == "ADMIN"){
                setcookie("usuario_logado", "true", [
                    "path" => "/",
                ]);
                header("Location: ..\\adm.php");
            }

            if($result["tipousuario"] == "CLIENTE"){
                setcookie("usuario_logado", "true", [
                    "path" => "/",
                ]);

                setcookie("idusuario", "$idusuario", [
                    "path" => "/",
                ]);

                header("Location: ..\\perfil.php");
            }

        } else {
            echo 'Usuário ou senha inválidos. Tente novamente.';
        }
    } else {
        echo 'Erro na execução da consulta.';
    }
}
?>
