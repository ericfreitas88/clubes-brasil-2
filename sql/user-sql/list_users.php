<?php
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

function listarUsuario()
{
  global $conexao;

  $list_users = "SELECT * FROM usuarios";
  $result_list = mysqli_query($conexao, $list_users);

  $arrayListarUsuarios = array();

  while ($row_usuarios = mysqli_fetch_assoc($result_list)) {
    $usuario = array(
      "id" => $row_usuarios["usuarioId"],
      "nome" => $row_usuarios["nome"],
      "sobrenome" => $row_usuarios["sobrenome"],
      "email" => $row_usuarios["email"],
      "telefone" => $row_usuarios["telefone"],
      "senha" => $row_usuarios["senha"],
      "perfil" => $row_usuarios["perfil"]
    );

    array_push($arrayListarUsuarios, $usuario);
  }
  return $arrayListarUsuarios;
}
