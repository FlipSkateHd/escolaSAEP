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
$tabela = "produtos";


$id = $_GET['id'];

$sql = "SELECT id, nome, caracteristicas, quantidade, medida, quantidade_min FROM  $tabela WHERE id = $id ";

$resultado = $conexao->query($sql);

if ($resultado->num_rows == true) {
  echo '
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
  echo '
    <br><br>
    <h4>Registrar movimentação:</h4> </br>
    <form method="post" action=processaMovimento.php?id=' . $id . '>

      <input type="radio" name="escolha" size="20" value= "1" required> <label> Empréstimo </>
 
      <input type="radio" name="escolha" size="20" value="0" required>  <label> Devolução </> <br/>
      Quantidade: <input type="number" name="quantidadeMov"> <br>
    
    Data de Devolução: <input name="dataDevolucao" type="date"> <br>

    Data de Empréstimo:<input name="dataEmprestimo" type="date"> <br>
    <input type="submit" value="Enviar">
  </form>


';

  echo '<br><br> <a href="gestaoEstoque.php">Voltar</a>';
} else {
  echo "Erro ao consultar: " . $conexao->error;
}




?>

</html>
