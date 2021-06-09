<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/class/Template.class.php");

if (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}
if ($_SESSION['perfil']  <> 1) {

  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/management/management.php');
  exit;
}

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/management/user-management/template/update_password_management.html");
$tpl->addFile("TOPO", "/xampp/htdocs/clubes-brasil-2/template/header.html");
$tpl->addFile("RODAPE", "/xampp/htdocs/clubes-brasil-2/template/footer.html");
$tpl->EDITAR_PERFIL = $_SESSION['idAcesso'];

if (isset($_SESSION['msg'])) {
  $tpl->MSG = $_SESSION['msg'];
  unset($_SESSION['msg']);
  $tpl->block("MENSAGEM");
}

if (isset($_SESSION['nomeAcesso'])) {
  $tpl->NOME_USUARIO = $_SESSION['nomeAcesso'];

  if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2) {
    $tpl->block("USUARIO_ADM");
    $tpl->block("LOGADO");
  }
}

$id = addslashes($_GET['id']);
$result_usuario = "SELECT * FROM usuarios WHERE usuarioId = '$id'";
$resultado_usuario = mysqli_query($conexao, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
$tpl->ID_USUARIO = $row_usuario['usuarioId'];

if (!mysqli_affected_rows($conexao)) {
  $_SESSION['msg'] = "Este usuário não existe! ";
  header('location: /clubes-brasil-2/management/user-management/login_management.php');
  exit;
}

$tpl->show();
