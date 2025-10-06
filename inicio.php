<html>
  <head>
    <title>Menu inicial</title>
  </head>
  <body>

    
    <?php
    session_start();
  if(empty(_SESSION['idUser'])){
  header('Location: index.php')

} else {
  echo '<h1>bem vindo!<h1>'

}

?>


  </body>


</html>
