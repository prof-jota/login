<?php
// Inicia a sessão
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
// Proteção contra XSS
$nome = htmlspecialchars($_SESSION['nome']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background-image: url("imagens/fundo.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
        /* Barra de navegação */
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
        .navbar a:hover {
            background-color: #007bff;
        }
        .usuario {
            background-color: #222 !important;
            font-weight: bold;
        }
        .logout {
            background-color: #b30000 !important;
        }
        .logout:hover {
            background-color: red !important;
        }
        /* Conteúdo */
        .conteudo {
            text-align: center;
            margin-top: 60px;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            width: 60%;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(6px);
        }
    </style>
</head>
<body>
    <!-- Barra de tarefas -->
    <div class="navbar">
        <a class="usuario">
            <?php echo $nome; ?>
        </a>
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
    <!-- Conteúdo -->
    <div class="conteudo">
        <div class="card">
            <h1>Bem-vindo ao Painel, <?php echo $nome; ?> 👋</h1>
            <p>
                Esta é uma área protegida do sistema.
            </p>
            <p>
                Apenas usuários autenticados conseguem acessar esta página.
            </p>
        </div>
    </div>
    <footer style="text-align:center; margin-top:40px; color:#666;">
        Sistema de Cadastro © 2026
    </footer>
</body>
</html>