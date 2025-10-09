<html>
<style>
  table,
  th,
  td {
    border: 1px solid black;
  }
</style>

<?php
session_start();

include 'conexao.php';
include 'verificaSessao.php';
$tabela = 'produtos';

$sql = "SELECT id, nome, caracteristicas, quantidade, medida, quantidade_min FROM  $tabela ORDER BY nome ASC";
$resultado = $conexao->query($sql);

if ($resultado->num_rows == true) {
  // Exibição do site + base para a tabela
  echo '

<h2>Tabela de produtos</h2>
<table>
    <tr>
<th>Produto</th>
<th>Caracteristicas</th>
<th>Quantidade</th>
<th>Medida</th>
<th>Quantidade mínima</th>
<th></th>

</tr>';

  while ($row = $resultado->fetch_assoc()) { // Código para exibir os produtos:

    echo '<tr>';

    echo '<td> ' . $row['nome'] . '</td>';
    echo '<td> ' . $row['caracteristicas'] . '</td>';
    echo '<td> ' . $row['quantidade'] . '</td>';
    echo '<td> ' . $row['medida'] . '</td>';
    echo '<td> ' . $row['quantidade_min']  . '</td>';
    echo '<td> ' . '<a href="editarProduto.php?id=' . $row['id'] . '">Editar</a>' . '<br> <a href="deletarProduto.php?id=' . $row['id'] . '">Deletar</a>' . '</td>'; // em construção
    echo '</tr>';
  }

  echo '</table>';

  echo '<br> <a href="entradaProduto.php">Cadastrar entrada de produtos </a>';
  echo '<br> <a href="saidaProduto.php">Cadastrar saída de produtos </a> </br>';
  echo '<br> <a href="inicio.php">Voltar ao menu</a>';
} else {
  echo "Erro ao consultar: " . $conexao->error;
}


?>

</html>
