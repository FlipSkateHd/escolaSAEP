<?php
session_start();

include 'conexao.php';
$tabela = "usuario";

$login = $_POST['login'];
$senha = $_POST['senha'];


$sql = "SELECT `id`, `nome` FROM `{$tabela}` 
        WHERE `login` = '{$login}'
        AND `senha` = '{$senha}';";

$resultado = $conexao->query($sql);
if ($resultado->num_rows != 0) {
  $row = $resultado->fetch_array();
  $_SESSION['idUser'] = $row[0];
  $_SESSION['nome'] = $row[1];
  $conexao->close();

  header('Location: inicio.php', true, 301);
  exit();
} else {
  $conexao->close();
  echo "<p style='color: red; font-weight: bold;'>Login ou senha inválidos. Tente novamente.</p>";
  echo "<p><a href='login.html'>Voltar para o login</a></p>";
  exit();
}
