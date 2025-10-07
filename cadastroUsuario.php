
<html>

  <head>
    <title>Cadastre-se</title>
  </head>
  
  <body>
    <h1> Sistema de gerenciamento de itens escolares - SAEP</h1>

    <form method="post" action="cadastroUserBanco.php" id="formlogin" name="formlogin" >
      <h3>Insira o seu nome:</h3>
				<label> Nome: </label>
        <input type="text" name="nome" required>
        <br />
 
      <h3>Insira o seu login:</h3>
				<label> Login: </label>
        <input type="text" name="login" required>
        <br />


      <h3>Insira a sua senha:</h3>
				<label>Senha: </label>
				<input type="password" name="senha" id="senha" size="20">
        
      <center>
      <br>
			<input type="submit" value="Criar conta"  />

				</center>
		</form>

    <a href="index.php">Voltar</a>
  </body>
</html>
