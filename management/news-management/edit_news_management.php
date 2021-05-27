<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/includebphp/Template.class.php");

if (!isset($_SESSION['nomeAcesso'])) {
  header('location: /clubes-brasil-2/system/login.php');
  exit;
}
if ($_SESSION['perfil']  == 3) {

  $_SESSION['msg'] = "Acesso Negado.";
  header('location: /clubes-brasil-2/index.php');
  exit;
}

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/management/news-management/template/edit_news_management.html");
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

$id = $_GET['id'];
$result_noticia = "SELECT * FROM noticias WHERE noticiaId = '$id'";
$resultado_noticia = mysqli_query($conexao, $result_noticia);
$row_noticia = mysqli_fetch_assoc($resultado_noticia);

$tpl->ID_NOTICIA = $row_noticia['noticiaId'];
$tpl->TITULO_NOTICIA = $row_noticia['titulo'];
$tpl->CONTEUDO_NOTICIA = $row_noticia['conteudo'];

if (!mysqli_affected_rows($conexao)) {
  $_SESSION['msg'] = "Esta notícia não existe!";
  header('location: /clubes-brasil-2/management/news-management/news_management.php');
  exit;
}

$tpl->show();
