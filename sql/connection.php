<?php

$host = "localhost";
$usuario = "root";
$senha = "root";
$bd = "clubesbrasil";

$conexao = new mysqli($host, $usuario, $senha, $bd);

if ($conexao->connect_errno) {
    echo "Falha na conexão: (" . $conexao->connect_errno . ") " . $conexao->connect_error;
}