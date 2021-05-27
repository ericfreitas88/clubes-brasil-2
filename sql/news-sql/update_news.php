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

if (($_SESSION['perfil']  <> 1) && ($_SESSION['perfil']  <> 2)) {

    $_SESSION['msg'] = "Acesso Negado.";
    header('location: /clubes-brasil-2/index.php');
    exit;
}

$id = $_POST['id'];
$titulo = addslashes($_POST['titulo']);
$conteudo = addslashes($_POST['conteudo']);

if (strlen($titulo) > 40) {
    $_SESSION['msg'] = "O título deve ter no máximo 40 caracteres!";
    header("location: /clubes-brasil-2/management/news-management/edit_news_management.php?id=$id");
    exit;
}

if (strlen($conteudo) > 500) {
    $_SESSION['msg'] = "O conteúdo deve ter no máximo 500 caracteres!";
    header("location: /clubes-brasil-2/management/news-management/edit_news_management.php?id=$id");
    exit;
}

if (empty($titulo) or empty($conteudo)) {

    $_SESSION['msg'] = "Preencha todos os campos!";
    header("location: /clubes-brasil-2/management/news-management/edit_news_management.php?id=$id");
    exit;
} else {

    $query = "UPDATE noticias SET titulo = '$titulo', conteudo = '$conteudo' WHERE noticiaId = '$id'";
    $result_query = mysqli_query($conexao, $query);
    $linha = mysqli_affected_rows($conexao);

    if (mysqli_affected_rows($conexao)) {

        $_SESSION['msg'] = "Notícia Editada com sucesso!";
        header('location: /clubes-brasil-2/management/news-management/list_edit_news_management.php');
        exit;
    } elseif (mysqli_affected_rows($conexao) === 0) {

        $_SESSION['msg'] = "Sem altereações na Noticia!";
        header('location: /clubes-brasil-2/management/news-management/list_edit_news_management.php');
        exit;
    } else {

        $_SESSION['msg'] = "Notícia não editada!";
        header('location: /clubes-brasil-2/management/news-management/list_edit_news_management.php');
        exit;
    }
}
