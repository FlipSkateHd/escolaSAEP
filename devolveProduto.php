<?php
session_start();
include 'conexao.php';
include 'verificaSessao.php';

$idEmprestimo = $_GET['id'];
$idUser = $_SESSION['idUser'];

$sqlSelect = "SELECT  
  e.id_emprestimo AS idEmprestimo,
  e.status AS statusEmprestimo, 
  e.data_emprestimo AS dataEmprestimo,
  e.data_devolucao AS dataDevolucao,
  p.nome AS nomeProduto,
  p.id as idProduto,
  ie.quantidade_emprestada as quantidadeEmprestada

FROM emprestimos e

JOIN itens_emprestimo ie 
  ON e.id_emprestimo = ie.id_emprestimo

JOIN produtos p 
  ON ie.id_produto = p.id

WHERE e.id_emprestimo = $idEmprestimo;";

$emprestimosResult = $conexao->query($sqlSelect);

if ($emprestimo = $emprestimosResult->fetch_assoc()) {
  $idProduto = $emprestimo['idProduto'];
  // TABELA EMPRESTIMOS
  $sqlEmprestimo = "UPDATE emprestimos SET status = 'devolvido' WHERE id_emprestimo = $idEmprestimo ;";
  $conexao->query($sqlEmprestimo);

  // TABELA PRODUTOS
  $quantidadeEmprestada = $emprestimo['quantidadeEmprestada'];
  $sqlProdutos = "UPDATE produtos SET quantidade = quantidade + $quantidadeEmprestada WHERE id = $idProduto;";
  $conexao->query($sqlProdutos);

  header("Location:editarProduto.php?id= $idProduto");

  //fim
} else {

  echo 'Erro ao processar informações!';
}
