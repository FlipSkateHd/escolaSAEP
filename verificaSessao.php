<?php 

if (empty($_SESSION['idUser'])) { // Tratamento de erros de acesso sem credenciais

echo "<p style='color: red; font-weight: bold;'>Login ou senha inválidos. Tente novamente.</p>";
echo "<p><a href='login.html'>Voltar para o login</a></p>";
die();
} 

?>