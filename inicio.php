<html>

<head>
  <title>Menu inicial</title>
  <link rel="stylesheet" type="text/css" href="css/inicio.css">
</head>

<body>


  <?php
  session_start();
  if (empty($_SESSION['idUser'])) {
    echo '<script>prompt("por favor, efetue o login")</script>';
    header('Location: index.php');
  } else {
    echo '
     <div class="divCentral">
      <h1>Bem vindo(a)! ' . $_SESSION['nome'] . '</h1>
        <br>
          <br>
            <a href="produtos.php">Ver Produtos</a>
            <a href="gestaoEstoque.php">Gestão de estoque</a>
            <a href="sair.php">Sair da conta</a>
      </div>

      ';
  } ?>

</body>

</html>
