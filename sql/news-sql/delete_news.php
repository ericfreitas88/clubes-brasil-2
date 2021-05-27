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

$id = $_GET['id'];
$query = "SELECT * FROM noticias WHERE noticiaId = '$id'";
$result_query = mysqli_query($conexao, $query);

if (mysqli_affected_rows($conexao)) {
  $query = "DELETE FROM noticias WHERE noticiaId = '$id'";
  $result_query = mysqli_query($conexao, $query);

  if (mysqli_affected_rows($conexao)) {
    $_SESSION['msg'] = "Notícia excluída com sucesso ";
    header('location: /clubes-brasil-2/management/news-management/list_edit_news_management.php');
    exit;
  } else {
    $_SESSION['msg'] = "Notícia não excluida ";
    header("location: /clubes-brasil-2/management/news-management/list_edit_news_manegement.php?=$id");
    exit;
  }
} else {
  $_SESSION['msg'] = "Esta notícia não existe! ";
  header('location: /clubes-brasil-2/management/news-management/list_edit_news_management.php');
  exit;
}
