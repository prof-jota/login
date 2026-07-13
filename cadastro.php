<?php
include('conecta.php');
if (isset($_POST['salvar'])) {
    $nome = trim($_POST['nome']);
    $senha = trim($_POST['senha']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $stmt = $mysqli->prepare("
        INSERT INTO usuarios
        (nome, senha, email, telefone, endereco)
        VALUES (?, ?, ?, ?, ?)
    ");
    if (!$stmt) {
        die("Erro na consulta: " . $mysqli->error);
    }
    $stmt->bind_param(
        "sssss",
        $nome,
        $senha,
        $email,
        $telefone,
        $endereco
    );
    if ($stmt->execute()) {
        $sucesso = "Usuário cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
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
        .mensagem-sucesso {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .mensagem-erro {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
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
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
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
        .btn {
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
        .excluir {
            color: red;
        }
        .input-pequeno input {
            width: 50px;
            background: #f1f1f1;
        }
        .input-group input {
            width: 180px;
        }
    </style>
</head>
<body>
    <!-- Barra de tarefas -->
    <div class="navbar">
        <a href="usuarios.php">
            ➕ Usuários
        </a>
        <a href="painel.php">
            🏠 Menu
        </a>
        <a href="logout.php" class="logout">
            🚪 Sair
        </a>
    </div>
    <?php if (isset($sucesso)): ?>
        <div class="mensagem-sucesso">
            <?= $sucesso ?>
        </div>
    <?php endif; ?>
    <?php if (isset($erro)): ?>
        <div class="mensagem-erro">
            <?= $erro ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Senha</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
            <td>
                <div class="input-pequeno">

                    <input type="text" name="id" placeholder=" " disabled>
                </div>
            </td>
            <td>
                <div class="input-group">

                    <input type="text" name="nome" placeholder="Digite seu usuário" required>
                </div>
            </td>
            <td>
                <div class="input-group">

                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>
            </td>
            <td>
                <div class="input-group">

                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="tel" name="telefone" placeholder="Digite seu telefone" required>
                </div>
            </td>
            <td>
                <div class="input-group">

                    <input type="text" name="endereco" placeholder="Digite seu endereço" required>
                </div>
            </td>
            <td>
                <button type="submit" name="salvar" class="btn">
                    Salvar
                </button>
            </td>
        </table>
    </form>
    </div>
</body>
</html>