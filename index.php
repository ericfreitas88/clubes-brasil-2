<?php
session_start();
include_once("/xampp/htdocs/clubes-brasil-2/class/Template.class.php");
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/sql/news-sql/list_news.php");

$tpl = new Template("template/index.html");
$tpl->addFile("TOPO", "template/header.html");
$tpl->addFile("MIOLO", "template/conteudo.html");
$tpl->addFile("RODAPE", "template/footer.html");


if (isset($_SESSION['idAcesso'])) {
  $tpl->EDITAR_PERFIL = $_SESSION['idAcesso'];
}

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

  if ($_SESSION['perfil'] == 3) {
    $tpl->block("USUARIO");
    $tpl->block("LOGADO");
  }
} else {
  $tpl->block("DESLOGADO");
}

$noticias = listarNoticiaHome();

if (!empty($noticias)) {
  foreach ($noticias as $value) {
    $tpl->ID_NOTICIA = $value["id"];
    $tpl->TITULO = $value["titulo"];
    $tpl->CONTEUDO = $value["conteudo"];
    $tpl->block("DADOS");
  }
  $tpl->block("NOTICIAS");
} else {
  $tpl->block("SEM_NOTICIAS");
}

$tpl->show();
