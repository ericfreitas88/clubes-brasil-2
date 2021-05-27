<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");

if (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$id = addslashes($_POST['id']);

if ($email == false) {
  $_SESSION['msg'] = "Email inválido!";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;

} elseif ($_SESSION['idAcesso']  <> $id) {
  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/index.php');
  exit;
}

$nome = addslashes($_POST['nome']);
$sobrenome = addslashes($_POST['sobrenome']);
$email = addslashes($_POST['email']);
$telefone = addslashes($_POST['telefone']);

if (strlen($nome) > 250) {
  $_SESSION['msg'] = "O nome deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;

}  elseif (strlen($sobrenome) > 250) {
  $_SESSION['msg'] = "O sobrenome deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;

} elseif (strlen($email) > 250) {
  $_SESSION['msg'] = "O email deve ter no máximo 250 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;

} elseif (strlen($telefone) > 15) {
  $_SESSION['msg'] = "O telefone deve ter no máximo 15 caracteres!";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;

} elseif (empty($nome) or empty($sobrenome) or empty($email) or empty($telefone)) {
  $_SESSION['msg'] = "Preencha todos os campos! ";
  header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
  exit;
  
} else {

  $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone' WHERE usuarioId = '$id'";
  $result_query = mysqli_query($conexao, $query);

  if (mysqli_affected_rows($conexao)) {
    $_SESSION['msg'] = "Seus dados foram editados com sucesso! ";
    header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
    exit;

  } elseif (mysqli_affected_rows($conexao) === 0) {
    $_SESSION['msg'] = "Nenhuma alteração realizada! ";
    header("location: /clubes-brasil-2/management/user-management/perfil_management.php?id=$id");
    exit;

  } else {
    $_SESSION['msg'] = "Não foi possível alterar seus dados! ";
    header("location: /clubes-brasil-2/management/user-management/perfil_management.php?=$id");
    exit;
  }
}
