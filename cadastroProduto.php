<html>

<head>
  <title>Cadastro de produtos</title>
</head>

<body>
  <h1>Cadastrar um novo produto:</h1>
  <form method="post" action="cadastrarProdutoBanco.php">
    Nome:
    <input type="text" name="nome">
    <br><br>
    Características:
    <input type="text" name="caracteristicas">
    <br><br>
    Quantidade:
    <input type="number" name="quantidade">
    <br><br>
    Medida:
    <input type="text" name="medida">
    <br><br>
    Quantidade mínima:
    <input type="number" name="quant_minima">


    <input type="submit" value="Cadastrar">
  </form>
</body>


</html>
