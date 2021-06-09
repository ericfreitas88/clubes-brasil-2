<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
require_once("/xampp/htdocs/clubes-brasil-2/sql/user-sql/list_users.php");
include_once("/xampp/htdocs/clubes-brasil-2/class/Template.class.php");

if (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}
if ($_SESSION['perfil'] <> 1) {

$_SESSION['msg'] = "Acesso Negado.";
header('location: /clubes-brasil-2/index.php');
exit;
}

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/management/user-management/template/login_management.html");
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

$usuarios = listarUsuario();

foreach ($usuarios as $value) {

  $tpl->NOME = $value["nome"];
  $tpl->SOBRENOME = $value["sobrenome"];
  $tpl->EMAIL = $value["email"];
  $tpl->TELEFONE = $value["telefone"];
  $tpl->EDITAR_USUARIO = $value["id"];
  $tpl->EDITAR_SENHA = $value["id"];
  $tpl->EXCLUIR_USUARIO = $value["id"];

  if (($value["id"] <> $_SESSION['idAcesso'])) {
    $tpl->block("DADOS");
  } 
}

if (!empty($usuarios)) {
  $tpl->block("USUARIOS_CADASTRADOS");
  
} else {
  $tpl->block("SEM_USUARIOS_CADASTRADOS");
}

$tpl->show();
?>