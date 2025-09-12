<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Jogo </title>
</head>
<body>

    <form method="post" action="cadastrar.php">
        <label>Palavra 01:</label>
        <input type="text" id="palavra1" name="palavra1">
            <br><br>

        <button id="enviar">Enviar</button>
    </form>

    <h1>Palavras Cadastradas</h1>

    <?php
        require_once 'conexao.php';

        $sql = "select * from palavras";
        $resultado = mysqli_query($con, $sql);
        
        echo "<table border='1'>";
            echo "<tr> <td>ID</td> <td>Palavra</td> </tr>";

        while($linha = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $linha["id"] . "</td>";
            echo "<td>" . $linha["palavra"] . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    ?>

        
    </table>
</body>
</html>