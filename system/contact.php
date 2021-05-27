<?php
session_start();
include_once("/xampp/htdocs/clubes-brasil-2/includebphp/Template.class.php");

$tpl = new Template("/xampp/htdocs/clubes-brasil-2/system/template/contact.html");
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

$tpl->show();
