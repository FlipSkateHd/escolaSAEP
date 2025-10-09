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

  $sql = "SELECT nome, caracteristicas, quantidade, medida, quantidade_min FROM  $tabela";
  $resultado = $conexao->query($sql);

  if ($resultado->num_rows == true) {
    // Exibição do site + base para a tabela
    echo '
<h2>Buscar um produto</h2>
<form method="post" action="buscarProduto.php" name="formBuscar">
  <input type="text" name="busca" />
  <input type="submit" value="Pesquisar" />
</form>
<br><br><br>
<h2>Tabela de produtos</h2>
<table>
    <tr>
<th>Produto</th>
<th>caracteristicas</th>
<th>quantidade</th>
<th>medida</th>
<th>quantidade minima</th>

</tr>';

    while ($row = $resultado->fetch_assoc()) { // Código para exibir os produtos:

      echo '<tr>';
      echo '<td> ' . $row['nome'] . '</td>';
      echo '<td> ' . $row['caracteristicas'] . '</td>';
      echo '<td> ' . $row['quantidade'] . '</td>';
      echo '<td> ' . $row['medida'] . '</td>';
      echo '<td> ' . $row['quantidade_min'] . '</td>';
      echo '</tr>';
    }

    echo '</table>';


    echo '<br> <a href="inicio.php">Voltar ao menu</a>';
  } else {
    echo "Erro ao consultar: " . $conexao->error;
  }

?>

</html>
