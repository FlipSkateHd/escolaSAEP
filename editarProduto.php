<html>
<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px;
  }
</style>

<?php
session_start();
include 'conexao.php';
include 'verificaSessao.php';

$tabela = "produtos";
$idUser = $_SESSION['idUser'];
$id = $_GET['id'];

// ========================
// CONSULTA DO PRODUTO
// ========================
$sqlProduto = "SELECT id, nome, caracteristicas, quantidade, medida, quantidade_min 
               FROM $tabela 
               WHERE id = $id";

$resultado = $conexao->query($sqlProduto);

// ========================
// CONSULTA DE TODOS OS EMPRÉSTIMOS DO PRODUTO
// ========================
$sqlEmprestimos = "SELECT 
  e.id_emprestimo AS idEmprestimo,
  e.status AS statusEmprestimo, 
  e.data_emprestimo AS dataEmprestimo,
  e.data_devolucao AS dataDevolucao,
  p.nome AS nomeProduto,
  ie.quantidade_emprestada
FROM emprestimos e
JOIN itens_emprestimo ie ON e.id_emprestimo = ie.id_emprestimo
JOIN produtos p ON ie.id_produto = p.id
WHERE p.id = $id
ORDER BY e.data_emprestimo DESC";

$resultEmprestimos = $conexao->query($sqlEmprestimos);

// ========================
// EXIBIÇÃO DOS DADOS DO PRODUTO
// ========================
if ($resultado && $resultado->num_rows > 0) {
  echo '
  <table>
    <tr>
      <th>Produto</th>
      <th>Características</th>
      <th>Quantidade</th>
      <th>Medida</th>
      <th>Quantidade mínima</th>
    </tr>';

  while ($row = $resultado->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['nome'] . '</td>';
    echo '<td>' . $row['caracteristicas'] . '</td>';
    echo '<td>' . $row['quantidade'] . '</td>';
    echo '<td>' . $row['medida'] . '</td>';
    echo '<td>' . $row['quantidade_min'] . '</td>';
    echo '</tr>';
  }

  echo '</table>
  <br><br>
  <h4>Histórico de Empréstimos:</h4>';

  // ========================
  // EXIBIÇÃO DOS EMPRÉSTIMOS
  // ========================
  if ($resultEmprestimos && $resultEmprestimos->num_rows > 0) {
    echo '
    <table>
      <tr>
        <th>ID Empréstimo</th>
        <th>Status</th>
        <th>Qtd. Emprestada</th>
        <th>Data Empréstimo</th>
  <th>Data Devolução Prevista</th>
  <th>Opção</th>
      </tr>';

    while ($emprestimo = $resultEmprestimos->fetch_assoc()) {
      echo '<tr>';
      echo '<td>' . $emprestimo['idEmprestimo'] . '</td>';
      echo '<td>' . $emprestimo['statusEmprestimo'] . '</td>';
      echo '<td>' . $emprestimo['quantidade_emprestada'] . '</td>';
      echo '<td>' . $emprestimo['dataEmprestimo'] . '</td>';
      echo '<td>' . $emprestimo['dataDevolucao'] . '</td>';
      echo '<td> ' . '<a href="devolveProduto.php?id=' . $id . '">Devolver</a>';
      echo '</tr>';
    }

    echo '</table>';
  } else {
    echo '<p>Nenhum empréstimo registrado para este produto.</p>';
  }

  // ========================
  // FORMULÁRIO PARA NOVO EMPRÉSTIMO
  // ========================
  echo '
  <br><br>
  <h4>Registrar Novo Empréstimo:</h4>
  <form method="post" action="emprestaProduto.php?id=' . $id . '">
    Quantidade: <input type="number" name="quantidadeMov" required> <br>
    Data de Devolução: <input name="dataDevolucao" type="date" required> <br>
    Data de Empréstimo: <input name="dataEmprestimo" type="date" required> <br>
    <input type="submit" value="Enviar">
  </form>

  <br><br>
  <a href="gestaoEstoque.php">Voltar</a>
  ';
} else {
  echo "Erro ao consultar produto: " . $conexao->error;
}
?>

</html>
