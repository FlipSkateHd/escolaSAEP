<?php
  session_start();
  
  $IP = "127.0.0.1";
  $usuarioDB = "root";
  $senhaDB = "";

  $database = "escolaSAEP";
  $tabela = "usuario";
  
  $conexao = new mysqli($IP, $usuarioDB, $senhaDB, $database);

  if ($conexao -> connect_errno){ // Tratamento de erros de conexão mysql
  echo "Falha ao conectar-se ao Banco de dados: " . $conexao -> connect_error;
  exit();

} else { // Inicio da verificação de login
  $login = $_POST['login'];
  $senha = $_POST['senha'];


$sql = "SELECT `id`, `nome` FROM `{$tabela}` 
        WHERE `login` = '{$login}'
        AND `senha` = '{$senha}';";
  
$resultado = $conexao -> query($sql);

if ($resultado->num_rows != 0)   {
    $row = $resultado -> fetch_array();
    $_SESSION['idUser'] = $row[0];
    $_SESSION['nome'] = $row[1];
    $conexao -> close();

    header('Location: inicio.php', true, 301);
    exit();
  } else {
  $conexao  -> close();
    header('Location: index.php', true, 301);
    exit();

  }

}


  echo($conexao);

?>
