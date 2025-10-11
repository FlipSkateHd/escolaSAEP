
<?php
session_start();
include 'conexao.php';
include 'verificaSessao.php';

$idUser = $_SESSION['idUser'];
$dataDevolucao = $_POST['dataDevolucao'];
$dataEmprestimo = $_POST['dataEmprestimo'];
$idProduto = $_GET['id'];
$quantidadeMov = $_POST['quantidadeMov'];

$selectSQL = "SELECT * FROM produtos WHERE id = $idProduto";
$respostaSelect = $conexao->query($selectSQL);
$row = $respostaSelect->fetch_assoc();

$quantidadeEstoque = $row['quantidade'];
$quantidadeMin = $row['quantidade_min'];

if (($quantidadeEstoque - $quantidadeMov) >= $quantidadeMin) {

  // TABELA EMPRESTIMOS
  $sqlEmprestimo = "INSERT INTO emprestimos (id_usuario_responsavel, data_emprestimo, data_devolucao, status)
                    VALUES ($idUser, '$dataEmprestimo', '$dataDevolucao', 'pendente')";
  $conexao->query($sqlEmprestimo);

  $idEmprestimo = $conexao->insert_id;

  // TABELA ITENS EMPRESTADOS
  $sqlItensEmprestimo = "INSERT INTO itens_emprestimo (id_emprestimo, id_produto, quantidade_emprestada)
                         VALUES ($idEmprestimo, $idProduto, $quantidadeMov)";
  $conexao->query($sqlItensEmprestimo);

  // UPDATE TABELA PRODUTOS
  $sqlUpdate = "UPDATE produtos SET quantidade = quantidade - $quantidadeMov WHERE id = $idProduto";
  $conexao->query($sqlUpdate);

  // TABELA HISTORICO 
  $sqlHistorico = "INSERT INTO historico (id_usuario, id_produto, id_emprestimo, data_emprestimo, data_devolucao, quantidade, tipo_movimentacao, data_movimentacao)
                   VALUES ($idUser, $idProduto, $idEmprestimo, '$dataEmprestimo', '$dataDevolucao', $quantidadeMov, 'emprestimo', CURDATE())";
  $conexao->query($sqlHistorico);

  header("Location:editarProduto.php?id=$idProduto");
} else {
  echo "Quantidade Mínima excedida! 
<a href='editarProduto.php?id=$idProduto'>Voltar</a>";
}
?>
