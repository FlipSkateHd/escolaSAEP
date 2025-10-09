
<?php
session_start();

include 'conexao.php';
$tabela = "usuario";



$nome  = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];

$sql = "INSERT INTO `{$tabela}` (`nome`, `login`, `senha`) 
        VALUES ('{$nome}', '{$login}', '{$senha}');";

if ($conexao->query($sql) === true) {
  echo "cadastrado com sucesso <br> </br>";
  echo '<a href="index.php">Voltar</a>';
} else {
  echo "Erro ao cadastrar: " . $conexao->error;
}

$conexao->close();
?>

