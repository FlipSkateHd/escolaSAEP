
<?php
session_start();

$IP = "127.0.0.1";
$usuarioDB = "root";
$senhaDB = "";
$database = "escolaSAEP";
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

if ($conexao->query($sql) === TRUE) {
    echo "cadastrado com sucesso <br> </br>";
    echo '<a href="index.php">Voltar</a>';
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}

$conexao->close();
?>

