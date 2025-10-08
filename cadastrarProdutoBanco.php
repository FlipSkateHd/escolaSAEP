<?php
$IP = '127.0.0.1';
$usuarioDB = 'root';
$senhaDB = '';
$database = 'escola_db';
$tabela = 'produtos';

$conexao = new mysqli($IP, $usuarioDB, $senhaDB, $database);

if ($conexao->connect_errno) {
  echo 'Falha ao conectar-se ao banco de dados: ' . $conexao->connect_error;
  exit();
}

$nome = $_POST['nome'];
$caracteristicas = $_POST['caracteristicas'];
$quantidade = $_POST['quantidade'];
$medida = $_POST['medida'];
$quantidade_min = $_POST['quantidade_min'];

$sql = "INSERT INTO `{$tabela}` (`nome`, `caracteristicas`, `quantidade`, `medida`, `quantidade_min`) 
VALUES ('{$nome}', '{$caracteristicas}', '{$quantidade}', '{$medida}', '{$quantidade_min}'); ";

$resposta = $conexao->query($sql);

if ($resposta === true) {
  echo 'Cadastrado com sucesso!';
  echo "<a href='cadastroProduto.php'.php>Voltar</a>";
}
