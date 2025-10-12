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
  ie.quantidade_emprestada as quantidadeDevolvida

FROM emprestimos e

JOIN itens_emprestimo ie 
  ON e.id_emprestimo = ie.id_emprestimo

JOIN produtos p 
  ON ie.id_produto = p.id

WHERE e.id_emprestimo = $idEmprestimo;";

$emprestimosResult = $conexao->query($sqlSelect);

if ($emprestimo = $emprestimosResult->fetch_assoc()) {

  $idProduto = $emprestimo['idProduto'];
  $idEmprestimo = $emprestimo['idEmprestimo'];
  $dataEmprestimo = $emprestimo['dataEmprestimo'];
  $dataDevolucao = $emprestimo['dataDevolucao'];
  $quantidadeDevolvida = $emprestimo['quantidadeDevolvida'];

  // TABELA EMPRESTIMOS
  $sqlEmprestimo = "UPDATE emprestimos SET status = 'devolvido' WHERE id_emprestimo = $idEmprestimo ;";
  $conexao->query($sqlEmprestimo);

  // TABELA PRODUTOS
  $sqlProdutos = "UPDATE produtos SET quantidade = quantidade + $quantidadeDevolvida WHERE id = $idProduto;";
  $conexao->query($sqlProdutos);

  header("Location:editarProduto.php?id= $idProduto");


  // TABELA HISTORICO 

  $sqlHistorico = "INSERT INTO historico (id_usuario, id_produto, id_emprestimo, data_emprestimo, data_devolucao, quantidade, tipo_movimentacao, data_movimentacao)
                   VALUES ($idUser, $idProduto, $idEmprestimo, '$dataEmprestimo', '$dataDevolucao', $quantidadeDevolvida, 'devolucao', CURDATE())";

  $conexao->query($sqlHistorico);



  //fim
} else {

  echo 'Erro ao processar informações!';
}
