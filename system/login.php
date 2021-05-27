<?php
session_start();
include_once("/xampp/htdocs/clubes-brasil-2/includebphp/Template.class.php");

if (isset($_SESSION['nomeAcesso'])) {
    header('location: /clubes-brasil-2/index.php');
    exit;
}

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/system/template/login.html");
$tpl->addFile("TOPO", "/xampp/htdocs/clubes-brasil-2/template/header.html");
$tpl->addFile("RODAPE", "/xampp/htdocs/clubes-brasil-2/template/footer.html");

if (isset($_SESSION['msg'])) {
    $tpl->MSG = $_SESSION['msg'];
    unset($_SESSION['msg']);
    $tpl->block("MENSAGEM");
}

if (!isset($_SESSION['nomeAcesso'])) {
    $tpl->block("DESLOGADO");
}

$tpl->show();
?>