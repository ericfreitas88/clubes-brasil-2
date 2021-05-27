<?php
require_once("/xampp/htdocs/clubes-brasil-2/sql/connection.php");

function validar_perfil_da_sessao($idSessao, $perfilSessao) {

  global $conexao;
  $query = "SELECT * FROM usuarios WHERE usuarioId = $idSessao AND perfil = $perfilSessao";
  $result_query =  mysqli_query($conexao, $query);
  $row_query = mysqli_fetch_assoc($result_query);

  if (!empty($row_query)) {
    $perfilOk = true;

  } else {
    $perfilOk = false;
  }

  return $perfilOk;
}