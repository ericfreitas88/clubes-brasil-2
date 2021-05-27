<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/sql/validate_perfil.php");

$perfilOk = validar_perfil_da_sessao($_SESSION['idAcesso'], $_SESSION['perfil']);

if ($perfilOk == false) {
  session_unset();
  $_SESSION['msg'] = "Perfil de acesso foi alterado.";
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}

if ($_SESSION['perfil']  <> 1) {

  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/index.php');
  exit;
}

if ($_GET['id'] == $_SESSION['idAcesso']) {

  $_SESSION['msg'] = "Não é possível excluir um usuário logado no sistema. ";
  header('location: /clubes-brasil-2/management/user-management/login_management.php');
  exit;
} else {

  $id = $_GET['id'];
  $query = "DELETE FROM usuarios WHERE usuarioId = '$id'";
  $result_query = mysqli_query($conexao, $query);

  if (!mysqli_affected_rows($conexao)) {

    $_SESSION['msg'] = "Este usuário não existe. ";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;
  } elseif (mysqli_affected_rows($conexao)) {

    $_SESSION['msg'] = "Usuário excluído com sucesso ";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;
  } else {

    $_SESSION['msg'] = "Usuário não excluido ";
    header("location: /clubes-brasil-2/management/user-management/login_manegement.php");
    exit;
  }
}
