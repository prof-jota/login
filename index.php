<?php

include('conecta.php');

session_start();

$erro = "";

if (isset($_POST['nome']) && isset($_POST['senha'])) {

    if (strlen($_POST['nome']) == 0) {

        $erro = "Preencha seu usuário";
    } elseif (strlen($_POST['senha']) == 0) {

        $erro = "Preencha sua senha";
    } else {

        $nome = $mysqli->real_escape_string($_POST['nome']);
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$nome'";
        $sql_query = $mysqli->query($sql_code) or die("Falha SQL: " . $mysqli->error);

        if ($sql_query->num_rows == 1) {

            $dados_usuario = $sql_query->fetch_assoc();

            // Verifica a senha
            if ($senha == $dados_usuario['senha']) {
                session_regenerate_id(true);
                $_SESSION['id'] = $dados_usuario['id'];
                $_SESSION['nome'] = $dados_usuario['nome'];

                header("Location: painel.php");
                exit;
            } else {

                $erro = "Usuário ou senha incorreto";
            }
        } else {

            $erro = "Usuário ou senha incorreto";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f3ff;
        }

        .login-box {
            width: 350px;
            background: #ffffff;
            padding: 35px;
            border-radius: 18px;
            border: 1px solid #e9d5ff;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.08);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 28px;
            color: #141415;
            font-size: 28px;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            margin-bottom: 7px;
            color: #1b1a1c;
            font-size: 14px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d8b4fe;
            border-radius: 12px;
            background: #faf5ff;
            outline: none;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .input-group input:focus {
            border-color: #1e1c22;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(23, 22, 24, 0.12);
        }

        .btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 12px;
            background: #0c0c0d;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: #1f1d23;
        }

        .erro {
            background: #f3e8ff;
            color: #100f12;
            border: 1px solid #d8b4fe;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        ::placeholder {
            color: #28272b;
        }
    </style>

</head>

<body>

    <div class="login-box">

        <h2>Login</h2>

        <?php if (!empty($erro)) { ?>
            <div class="erro">
                <?php echo $erro; ?>
            </div>
        <?php } ?>

        <form action="" method="POST">

            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="nome" placeholder="Digite seu usuário">
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha">
            </div>

            <button type="submit" class="btn">
                Entrar
            </button>

        </form>

    </div>

</body>

</html>