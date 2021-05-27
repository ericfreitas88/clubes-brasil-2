<?php
session_start();
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");
include_once("/xampp/htdocs/clubes-brasil-2/sql/news-sql/list_news.php");
include_once("/xampp/htdocs/clubes-brasil-2/includebphp/Template.class.php");

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/system/template/news.html");
$tpl->addFile("TOPO", "/xampp/htdocs/clubes-brasil-2/template/header.html");
$tpl->addFile("RODAPE", "/xampp/htdocs/clubes-brasil-2/template/footer.html");

if (isset($_SESSION['idAcesso'])) {
  $tpl->EDITAR_PERFIL = $_SESSION['idAcesso'];
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

$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = 3;
$dados = listarNoticia($pagina_atual, $qnt_result_pg);

if (!empty($dados)) {

  foreach ($dados["noticias"] as $value) {
    $tpl->ID_NOTICIA = $value["id"];
    $tpl->TITULO = $value["titulo"];
    $tpl->CONTEUDO = $value["conteudo"];
    $tpl->block("DADOS");
  } 

  $tpl->PG_ATUAL = $dados["paginacao"]["pg_atual"];
  $tpl->PG_PROXIMA = $dados["paginacao"]["pg_proxima"];
  $tpl->PG_ANTERIOR = $dados["paginacao"]["pg_anterior"];
  $tpl->PG_ULTIMA = $dados["paginacao"]["pg_ultima"];
  $tpl->PG_PRIMEIRA = $dados["paginacao"]["pg_ultima"] - $dados["paginacao"]["pg_ultima"];

  if ($dados["paginacao"]["pg_atual"] > 1) {
    $tpl->block("VOLTAR");
  }

  if ($dados["paginacao"]["pg_atual"] < $dados["paginacao"]["pg_proxima"] ) {
    $tpl->block("AVANCAR");
  }

  $tpl->block("PAGINACAO");


    $tpl->block("NOTICIAS");
} else {
  $tpl->block("SEM_NOTICIAS");
}


$tpl->show();
