<?php
include 'conexao.php';
$tabela = 'produtos';

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
