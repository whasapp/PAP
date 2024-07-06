<!-- Cabeçalho -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Escala inicial e largura do viewport para dispositivos móveis -->

    <title><?php echo $title; ?></title> <!-- Título da página -->

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Estilos -->
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top"> <!-- Barra de navegação -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span> <!-- Botão para telas/separadores pequenos -->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Fantasy Gate</a> <!-- Nome do Website -->
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right"> <!-- Lista de links -->
              <li><a href="publisher_list.php">Publisher</a></li>
              <li><a href="books.php">Books</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="cart.php">My Cart</a></li>
            </ul>
        </div>
      </div>
    </nav>

    <?php
      // Mensagem inicial na página inicial
      if(isset($title) && $title == "Index") {
    ?>
    <div class="jumbotron"> <!-- Mensagem de boas-vindas -->
      <div class="container">
        <h1>Welcome to The Fantasy Gate!</h1>
        <p class="lead">Take a step into a world where fantasy becomes reality!</p>
        <p>A bookstore made by Filipe Isakov.</p>
      </div>
    </div>
    <?php } ?>

    <div class="container" id="main"> <!-- Contêiner principal -->
