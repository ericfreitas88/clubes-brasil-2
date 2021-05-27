<?php
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");

function listarNoticiaHome()
{
  global $conexao;

  $list_news = "SELECT  * FROM noticias ORDER BY noticiaId DESC LIMIT 8";
  $result_list = mysqli_query($conexao, $list_news);

  $noticias = array();

  while ($row_noticias = mysqli_fetch_assoc($result_list)) {
    $noticias[] = array(
      "id" => $row_noticias["noticiaId"],
      "titulo" => $row_noticias["titulo"],
      "conteudo" => nl2br($row_noticias["conteudo"]),
      "data_cadastro" => $row_noticias["data_cadastro"],
    );
  }
  return $noticias;
}

function listarNoticia($pagina_atual, $qnt_result_pg)
{
  global $conexao;

  $pagina_atual = (!empty($pagina_atual)) ? $pagina_atual : 1;
  $qnt_result_pg = $qnt_result_pg;
  $inicio = ($qnt_result_pg * $pagina_atual) - $qnt_result_pg;

  $qnt_id = "SELECT COUNT(noticiaId) as total FROM noticias";
  $query_qnt_id = mysqli_query($conexao, $qnt_id);
  $row_qnt_id = mysqli_fetch_assoc($query_qnt_id);

  $total_pg = ceil($row_qnt_id['total'] / $qnt_result_pg);

  if ($pagina_atual == 1) {
    $prox_pagina = $pagina_atual + 1;
    $ant_pagina = 1;

  } elseif (($pagina_atual > 1) && ($pagina_atual < $total_pg)) {
    $prox_pagina = $pagina_atual + 1;
    $ant_pagina = $pagina_atual - 1;

  } elseif ($pagina_atual == $total_pg) {
    $prox_pagina = $total_pg;
    $ant_pagina = $pagina_atual - 1;

  } elseif (($pagina_atual < 1) or ($pagina_atual > $total_pg)) {
   header('location: /clubes-brasil-2/system/news.php?pagina=1');
   exit;
  }

  $retorno = array(
    'noticias' => null,
    'paginacao' => null
  );

  $noticias = array();

  $paginas = array(
    'pg_atual' => $pagina_atual,
    'pg_proxima' => $prox_pagina,
    'pg_anterior' => $ant_pagina,
    'pg_ultima' =>$total_pg
  );

  $list_news = "SELECT * FROM noticias ORDER BY noticiaId DESC LIMIT $inicio, $qnt_result_pg";
  $result_list = mysqli_query($conexao, $list_news);

  while ($row_noticias = mysqli_fetch_assoc($result_list)) {

    $noticias[] = array(
      "id" => $row_noticias["noticiaId"],
      "titulo" => $row_noticias["titulo"],
      "conteudo" => nl2br($row_noticias["conteudo"]),
      "data_cadastro" => $row_noticias["data_cadastro"],
    );
  }

  $retorno = array(
    'noticias' => $noticias,
    'paginacao' => $paginas
  );

  return $retorno;
}
