<?php
include("conecta.php");
$sql = "SELECT * FROM usuarios";
$resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #333;
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            background: #555;
            padding: 10px 15px;
            border-radius: 5px;
            transition: .3s;
        }
        .btn-editar {
            background: #0d6efd;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-editar:hover {
            background: #0b5ed7;
        }
        .btn-excluir {
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-excluir:hover {
            background: #bb2d3b;
        }
        .novo {
            display: inline-block;
            background: #198754;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .novo:hover {
            background: #157347;
        }
        .navbar a:hover {
            background: #007bff;
        }
        .logout {
            background: #b30000 !important;
        }
        .logout:hover {
            background: red !important;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
        }
        h1 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        tr {
            transition: .2s;
        }
        tr:hover {
            background: #eef6ff;
        }
        th {
            background: #4a90e2;
            color: white;
            padding: 12px;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f8f8f8;
        }
        .editar {
            color: #007bff;
            text-decoration: none;
        }
        .excluir {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="painel.php">🏠 Menu</a>
        <a href="cadastro.php">➕ Cadastrar</a>
        <a href="logout.php" class="logout">🚪 Sair</a>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
            <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?= $usuario['id']; ?></td>
                    <td><?= htmlspecialchars($usuario['nome']); ?></td>
                    <td><?= htmlspecialchars($usuario['email']); ?></td>
                    <td><?= htmlspecialchars($usuario['telefone']); ?></td>
                    <td><?= htmlspecialchars($usuario['endereco']); ?></td>
                    <td>
                       <a class="btn-editar"
                            href="editar.php?id=<?= $usuario['id']; ?>">
                            Editar
                        </a>
                        <a class="btn-excluir"
                           href="excluir.php?id=<?= $usuario['id']; ?>">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>