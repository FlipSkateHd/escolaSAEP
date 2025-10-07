
<?php
session_start();

$IP = "127.0.0.1";
$usuarioDB = "root";
$senhaDB = "";
$database = "escola_db";
$tabela = "usuario";

$conexao = new mysqli($IP, $usuarioDB, $senhaDB, $database);
if ($conexao->connect_errno) {
  echo "Falha ao conectar-se ao Banco de dados: " . $conexao->connect_error;
  exit();
}

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

