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

if (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}

if ($_SESSION['perfil']  <> 1) {

  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/index.php');
  exit;
}

$id = addslashes($_POST['id']);
$senhaAtual = addslashes($_POST['senha']);
$novaSenha = addslashes($_POST['nova_senha']);
$confirmarNovaSenha = addslashes($_POST['confirmar_nova_senha']);

if (strlen($senhaAtual) > 60) {
  $_SESSION['msg'] = "A senha deve ter no máximo 60 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
  exit;
  
} elseif (strlen($novaSenha) > 60) {
  $_SESSION['msg'] = "A senha deve ter no máximo 60 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
  exit;
  
} elseif (strlen($confirmarNovaSenha) > 60) {
  $_SESSION['msg'] = "A senha deve ter no máximo 60 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
  exit;
  
} elseif (empty($senhaAtual) or empty($novaSenha) or empty($confirmarNovaSenha)) {
  $_SESSION['msg'] = "Preencha todos os campos! ";
  header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
  exit;
  
} else {

  $query = "SELECT * From usuarios WHERE usuarioId = '$id' AND senha = '$senhaAtual'";
  $result_query = mysqli_query($conexao, $query);

  if (!mysqli_affected_rows($conexao)) {

    $_SESSION['msg'] = "Senha atual incorreta.";
    header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
    exit;
  } elseif ($novaSenha <> $confirmarNovaSenha) {

    $_SESSION['msg'] = "Os campos 'Nova Senha' e 'Confrmar nova senha' precisam ser iguais. Favor tentar novamente! ";
    header("location: /clubes-brasil-2/management/user-management/update_password_management.php?id=$id");
    exit;
  } elseif (mysqli_affected_rows($conexao)) {

    $query = "UPDATE usuarios SET senha = '$novaSenha' WHERE usuarioId = '$id'";
    $result_query = mysqli_query($conexao, $query);

    if (mysqli_affected_rows($conexao)) {

      $_SESSION['msg'] = "Senha alterada com sucesso! ";
      header('location: /clubes-brasil-2/management/user-management/login_management.php');
      exit;
    } elseif (!mysqli_affected_rows($conexao)) {

      $_SESSION['msg'] = "Nenhuma alteração realizada! ";
      header('location: /clubes-brasil-2/management/user-management/login_management.php');
      exit;
    } else {

      $_SESSION['msg'] = "Usuário não editado! ";
      header('location: /clubes-brasil-2/management/user-management/login_management.php?=$id');
      exit;
    }
  }
}
