<?php
require_once "..\config\Conecao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ticket_id"])) {
        $ticketId = $_POST["ticket_id"];

        $conexao = new Conecao("root", "");
        $pdo = $conexao->criarConexao();

        $sql = "DELETE FROM ticket WHERE id = :ticket_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":ticket_id", $ticketId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ..\\adm.php");
        } else {
            return false;
        }

    }
}
?>
