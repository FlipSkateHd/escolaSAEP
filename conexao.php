<?php
$IP = "127.0.0.1";
$usuarioDB = "root";
$senhaDB = "";
$database = "escola_db";

$conexao = new mysqli($IP, $usuarioDB, $senhaDB, $database);

if ($conexao->connect_errno) {
  die("Falha ao conectar-se ao Banco de dados: " . $conexao->connect_error);
}
?>
