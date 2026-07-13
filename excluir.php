<?php
include("conecta.php");
session_start();
$id = intval($_GET['id']);
$stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
if (!$usuario) {
    die("Usuário não encontrado.");
}
if (isset($_POST['excluir'])) {
    $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "Erro ao excluir usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 500px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        }
        h2 {
            color: #b30000;
        }
        p {
            font-size: 18px;
        }
        button {
            background: red;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background: #cc0000;
        }
        a {
            margin-left: 15px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Excluir Usuário</h2>
        <p>Tem certeza que deseja excluir este usuário?</p>
        <hr>
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($usuario['telefone']) ?></p>
        <p><strong>Endereço:</strong> <?= htmlspecialchars($usuario['endereco']) ?></p>
        <form method="POST">
            <button type="submit" name="excluir">
                🗑️ Confirmar Exclusão
            </button>
            <a href="usuarios.php">Cancelar</a>
        </form>
    </div>
</body>
</html>