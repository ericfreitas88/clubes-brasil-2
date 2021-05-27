<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = addslashes($_POST['senha']);

if (!$email) {

  $_SESSION['msg'] = "Email inválido!";
  header('location: /clubes-brasil-2/system/login.php');
  exit;

} else {

  if (empty($email) or empty($senha)) {

    $_SESSION['msg'] = "Favor preencher todos os campos!";
    header('location: /clubes-brasil-2/system/login.php');

  } else {

    if (!empty($email) && strlen($senha) > 0) {

      $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
      $result_query = mysqli_query($conexao, $query);
      $row_query = mysqli_fetch_assoc($result_query);

      if (!empty($row_query)) {

        $nomeUsuario = explode(" ",$row_query["nome"]);
        $_SESSION['nomeAcesso'] = $nomeUsuario[0];
        $_SESSION['idAcesso'] = $row_query["usuarioId"];
        $_SESSION['perfil'] = $row_query["perfil"];
        header('location: /clubes-brasil-2/index.php');
        exit;

      } else {

        $_SESSION['msg'] = "Dados incorretos";
        header('location: /clubes-brasil-2/system/login.php');
        exit;

      }
    }
  }
}
