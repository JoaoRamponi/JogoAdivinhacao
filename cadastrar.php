<?php
require_once 'conexao.php';

$palavra = $_POST['palavra1'] ?? '';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .mensagem {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sucesso {
            color: #28a745;
            font-weight: bold;
        }

        .erro {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="mensagem">
        <?php
        if (empty($palavra)) {
            echo '<p class="erro">Por favor, preencha todos os campos.</p>';
        } else {
            $sql = "INSERT INTO palavras (palavra) VALUES (?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 's', $palavra);

            if (mysqli_stmt_execute($stmt)) {
                echo '<p class="sucesso">Cadastro realizado com sucesso!</p>';
            } else {
                echo '<p class="erro">Erro no cadastro: ' . mysqli_error($con) . '</p>';
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($con);
        ?>
        <a href="index.php">Voltar ao formulário</a>
    </div>
</body>
</html>