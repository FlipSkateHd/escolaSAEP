
<?php
session_start();
include 'conexao.php';
include 'verificaSessao.php';

$tabela = 'produtos';


$id =  $_GET['id'];
$conexao->query("DELETE FROM historico WHERE id_produto = $id");
$conexao->query("DELETE FROM itens_emprestimo WHERE id_produto = $id");
$conexao->query("DELETE FROM produtos WHERE id = $id");

echo "Deletado com sucesso!";
header('Location: gestaoEstoque.php', true, 301);
exit();
?>

