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

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($email == false) {

  $_SESSION['msg'] = "Email inválido!";
  header('location: /clubes-brasil-2/management/user-management/login_management.php');
  exit;
} else {

  $email = addslashes($email);
  $perfil = addslashes($_POST['perfil']);
  $nome = addslashes($_POST['nome']);
  $sobrenome = addslashes($_POST['sobrenome']);
  $telefone = addslashes($_POST['telefone']);
  $senha = addslashes($_POST['senha']);

  if (strlen($nome) > 250) {
    $_SESSION['msg'] = "O nome deve ter no máximo 250 caracteres!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  }  elseif (strlen($sobrenome) > 250) {
    $_SESSION['msg'] = "O sobrenome deve ter no máximo 250 caracteres!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  } elseif (strlen($email) > 250) {
    $_SESSION['msg'] = "O email deve ter no máximo 250 caracteres!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  } elseif (strlen($telefone) > 15) {
    $_SESSION['msg'] = "O telefone deve ter no máximo 15 caracteres!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  } elseif (strlen($senha) > 60) {
    $_SESSION['msg'] = "A senha deve ter no máximo 60 caracteres!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;
    
  } elseif (empty($nome) or empty($sobrenome) or empty($email) or empty($telefone) or empty($senha) or empty($perfil)) {
    $_SESSION['msg'] = "Favor preencher todos os campos. ";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  } elseif (($perfil <> 1) && ($perfil <> 2) && ($perfil <> 3)) {
    $_SESSION['msg'] = "Perfil inválido ";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;

  } else {
    $check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_query = mysqli_query($conexao, $check_email);

    if (mysqli_affected_rows($conexao)) {

      $_SESSION['msg'] = "Não foi possível criar o usuário. Email já cadastrado.";
      header('location: /clubes-brasil-2/management/user-management/login_management.php');
      exit;
    } else {

      $query = "INSERT INTO usuarios (nome, sobrenome, email, telefone, senha, perfil) VALUES ('$nome', '$sobrenome', '$email', '$telefone', '$senha', $perfil)";
      $result_query = mysqli_query($conexao, $query);

      if (mysqli_insert_id($conexao)) {

        $nome = stripslashes($nome);
        $sobrenome = stripslashes($sobrenome);

        $_SESSION['msg'] = "Usuário $nome $sobrenome cadastrado com sucesso ";
        header('location: /clubes-brasil-2/management/user-management/login_management.php');
        exit;
      } else {

        $_SESSION['msg'] = "Usuário $nome $sobrenome não cadastrado ";
        header('location: /clubes-brasil-2/management/user-management/login_management.php');
        exit;
      }
    }
  }
}
