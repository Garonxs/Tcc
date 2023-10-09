<?php
require_once "config\Conecao.php";

    if (!isset($_COOKIE["usuario_logado"]) || $_COOKIE["usuario_logado"] !== "true" || $_COOKIE["tipousuario"] != "ADMIN") {
    header("Location: index.html");
    exit;
    }

    $pdo = new Conecao("root", "");
    $pdo = $pdo->criarConexao();
    $sql = "SELECT * FROM ticket";
    $stmt = $pdo->query($sql);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: orange;
            text-align: center;
            padding: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid orange;
            text-align: left;
        }

        th {
            background-color: orange;
            color: black;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 165, 0, 0.2);
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .logout-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .logout-button a {
            color: orange;
            text-decoration: none;
        }

        .logout-button a:hover {
            text-decoration: underline;
        }

        /* Estilo para as células da tabela */
        .table-cell {
            padding: 10px;
            border: 1px solid orange;
        }

        /* Estilo para o botão "Excluir" */
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
<h1>Painel do Administrador</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Categoria</th>
        <th>Assunto</th>
        <th>Mensagem</th>
        <th>Ação</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tickets as $ticket) : ?>
        <tr>
            <td class="table-cell"><?php echo $ticket['id']; ?></td>
            <td class="table-cell"><?php echo $ticket['nome']; ?></td>
            <td class="table-cell"><?php echo $ticket['email']; ?></td>
            <td class="table-cell"><?php echo $ticket['categoria']; ?></td>
            <td class="table-cell"><?php echo $ticket['assunto']; ?></td>
            <td class="table-cell"><?php echo $ticket['mensagem']; ?></td>
            <td class="table-cell">
                <form action="validacao\excluirTicket.php" method="POST">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                    <button class="delete-button" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="logout-button">
    <a href="validacao\logout.php">Sair</a>
</div>
</body>
</html>
