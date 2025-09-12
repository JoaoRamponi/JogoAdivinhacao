<?php
include 'conexao.php';
session_start();

// Inicializa sessão
if (!isset($_SESSION['palavra'])) {
    $sql = "SELECT palavra FROM palavras ORDER BY RAND() LIMIT 1"; // seleção aleatoria do banco com limite de 1
    $res = mysqli_query($conexao, $sql); 
    $_SESSION['palavra'] = mysqli_fetch_assoc($res)['palavra'];
    $_SESSION['tentativas'] = 0; // inicia a tentativa em 0
    $_SESSION['letras'] = []; // inicia a letra vazia
}

            //nao sumir as informaçoes
$palavra    = $_SESSION['palavra'];
$letras     = $_SESSION['letras'];  
$tentativas = $_SESSION['tentativas'];

// Processa tentativa                    //se a variavel existe e nao é nula
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['letra'])) {
    $letra = strtolower($_POST['letra']); // 'A' ou 'a'
    if (!in_array($letra, $letras)) {
        $_SESSION['letras'][] = $letra;
        $_SESSION['tentativas']++;
        $letras = $_SESSION['letras'];
    }
}

// Monta exibição da palavra
$mostrar = '';
$completo = true;
          //separa as letras da palavra
foreach (str_split($palavra) as $l) {
    if (in_array(strtolower($l), $letras)) {
        $mostrar .= $l . ' '; // mostra a letra se já foi digitada
                // o ponto(.) serve para concatenar 
    } else {
        $mostrar .= "_"; // senão, mostra "_"
        $completo = false; // a palvra ainda não foi encontrada
    }
}

// Exibição
echo "<p>Palavra: $mostrar</p>";
echo "<p>Tentativas: $tentativas</p>";

if ($completo) {
    echo "<h3>Parabéns! Você adivinhou a palavra: $palavra</h3>";
    session_destroy(); 
    echo "<a href='jogar.php'>Jogar Novamente</a>";
} else {
?>
    <form method="post">
        <label>Digite uma letra:</label>
        <input type="text" name="letra" maxlength="1" required>
        <input type="submit" value="Tentar">
    </form>

    <form method="post">
        <button name="mostrar" value="1">Mostrar Palavra</button>
    </form>

    <?php if (isset($_POST['mostrar'])): ?>
        <p><strong>Palavra Sorteada: <?= htmlspecialchars($palavra) ?></strong></p>
    <?php endif; ?>
<?php
}
?>
