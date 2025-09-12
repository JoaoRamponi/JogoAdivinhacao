<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'jogo_adivinhacao';

    $conexao = mysqli_connect($host, $user, $password, $database);

    if (!$conexao) {
        die('Erro ao conectar ao MySQl: ' . mysqli_connect_error()); 
    }
?>
