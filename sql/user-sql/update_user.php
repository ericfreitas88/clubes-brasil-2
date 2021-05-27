<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/sql/validate_perfil.php");

$perfilOk = validar_perfil_da_sessao($_SESSION['idAcesso'], $_SESSION['perfil']);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$idAcesso =  $_SESSION['idAcesso'];
$id = addslashes($_POST['id']);

if ($perfilOk == false) {
  session_unset();
  $_SESSION['msg'] = "Perfil de acesso foi alterado.";
  header('location: /clubes-brasil-2/system/login.php');
  exit;

} elseif (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;

} elseif ($_SESSION['perfil']  <> 1) {

  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/index.php');
  exit;

} elseif ($email == false) {
  $_SESSION['msg'] = "Email inválido!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

} elseif ($idAcesso  == $id) {
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;
}

$perfil = addslashes($_POST['perfil']);
$nome = addslashes($_POST['nome']);
$sobrenome = addslashes($_POST['sobrenome']);
$email = addslashes($_POST['email']);
$telefone = addslashes($_POST['telefone']);

if (strlen($nome) > 250) {
  $_SESSION['msg'] = "O nome deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

}  elseif (strlen($sobrenome) > 250) {
  $_SESSION['msg'] = "O sobrenome deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

} elseif (strlen($email) > 250) {
  $_SESSION['msg'] = "O email deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

} elseif (strlen($telefone) > 15) {
  $_SESSION['msg'] = "O telefone deve ter no máximo 15 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

} elseif (empty($nome) or empty($sobrenome) or empty($email) or empty($telefone)) {
  $_SESSION['msg'] = "Preencha todos os campos!";
  header("location: /clubes-brasil-2/management/user-management/edit_management.php?id=$id");
  exit;

} else {

  $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', perfil = '$perfil' WHERE usuarioId = '$id'";
  $result_query = mysqli_query($conexao, $query);

  if (mysqli_affected_rows($conexao)) {

    $_SESSION['msg'] = "Usuário $nome editado com sucesso!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;
  } elseif (mysqli_affected_rows($conexao) === 0) {

    $_SESSION['msg'] = "Nenhuma alteração realizada!";
    header('location: /clubes-brasil-2/management/user-management/login_management.php');
    exit;
  } else {

    $_SESSION['msg'] = "Usuário não editado!";
    header("location: /clubes-brasil-2/management/user-management/login_management.php");
    exit;
  }
}
