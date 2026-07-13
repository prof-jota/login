<?php
$hostname = "localhost";
$bancodedados = "sistema_usuarios";
$usuario = "root"; //usuario padrao do xampp
$senha = ""; //senha padrao do xampp é vazia
//Cria a conexão usando MySQL
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
//Verifica se houve erro
if ($mysqli->connect_errno) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}
