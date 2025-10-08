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


$IP = "127.0.0.1";
$usuarioDB = "root";
$senhaDB = "";

$database = "escola_db";
$tabela = "produtos";

$conexao = new mysqli($IP, $usuarioDB, $senhaDB, $database);

if ($conexao->connect_errno) { // Tratamento de erros de conexão mysql
  echo "Falha ao conectar-se ao Banco de dados: " . $conexao->connect_error;
  exit();
}

if (empty($_SESSION['idUser'])) { // Tratamento de erros de acesso sem credenciais
  echo "<p style='color: red; font-weight: bold;'>Login ou senha inválidos. Tente novamente.</p>";
  echo "<p><a href='login.html'>Voltar para o login</a></p>";
} else {
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

    echo '<br> <a href="cadastroProduto.php">Cadastrar novo produto</a>';
    echo '<br> <a href="deletarProduto.php">Deletar um produto</a>';
    echo '<br> <a href="inicio.php">Voltar ao menu</a>';
  } else {
    echo "Erro ao consultar: " . $conexao->error;
  }
}

?>

</html>
