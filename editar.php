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
if (isset($_POST['atualizar'])) {
    $usuario_login = trim($_POST['usuario']);
    $nome = trim($_POST['nome']);
    $senha = trim($_POST['senha']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $stmt = $mysqli->prepare("
        UPDATE usuarios
        SET usuario=?,
            nome=?,
            senha=?,
            email=?,
            telefone=?,
            endereco=?
        WHERE id=?
    ");
    $stmt->bind_param(
        "ssssssi",
        $usuario_login,
        $nome,
        $senha,
        $email,
        $telefone,
        $endereco,
        $id
    );
    if ($stmt->execute()) {
        header("Location: usuarios.php");
        exit();
    }
    echo "Erro ao atualizar.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }
        .input-pequeno input {
            width: 50px;
            background: #f1f1f1;
        }
        .btn {
            background: #4a90e2;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
        }
        .input-group input {
            width: 180px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        .botoes {
            background: #4a90e2;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
        }
        table th {
            background: #4a90e2;
            color: white;
        }
        a.botao {
            background: #4a90e2;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th,
        table td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .navbar a:hover {
            background-color: #007bff;
        }
        .editar {
            color: #3498db;
        }
        .logout {
            background-color: #b30000 !important;
        }
        .navbar {
            background-color: #333;
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            background-color: #555;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .logout:hover {
            background-color: red !important;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .excluir {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Barra de tarefas -->
    <div class="navbar">
        <a href="cadastro.php">
            ➕ Cadastrar
        </a>
        <a href="usuarios.php">
            ➕ Usuários
        </a>
        <a href="logout.php" class="logout">
            🚪 Sair
        </a>
    </div>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <table>
                <tr>
                    <th>Campo</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>
                        <input
                            type="text"
                            value="<?= $usuario['id']; ?>"
                            readonly>
                    </td>
                </tr>
                <tr>
                    <td>Usuário</td>
                    <td>
                        <input
                            type="text"
                            name="usuario"
                            value="<?= htmlspecialchars($usuario['usuario']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>
                        <input
                            type="text"
                            name="nome"
                            value="<?= htmlspecialchars($usuario['nome']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td>
                        <input
                            type="password"
                            name="senha"
                            value="<?= htmlspecialchars($usuario['senha']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>
                        <input
                            type="email"
                            name="email"
                            value="<?= htmlspecialchars($usuario['email']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Telefone</td>
                    <td>
                        <input
                            type="text"
                            name="telefone"
                            value="<?= htmlspecialchars($usuario['telefone']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Endereço</td>
                    <td>
                        <input
                            type="text"
                            name="endereco"
                            value="<?= htmlspecialchars($usuario['endereco']); ?>">
                    </td>
                </tr>
            </table>
            <br>
            <button
                type="submit"
                name="atualizar"
                class="btn">
                Atualizar
            </button>
            <a href="usuarios.php" class="btn">Voltar</a>
        </form>
    </div>
    </div>
</body>
</html>