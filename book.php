<?php
  // Inicia a sessão PHP
  session_start();
  
  // Recebe o ISBN do livro selecionado a partir dos parâmetros GET da URL
  $book_isbn = $_GET['bookisbn'];
  
  // Inclui o arquivo que contém as funções para conexão com o banco de dados
  require_once "./functions/database_functions.php";
  
  // Conecta-se ao banco de dados
  $conn = db_connect();
  
  // Consulta a base de dados para obter os dados do livro com base no ISBN fornecido
  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  
  // Verifica se houve um erro durante a execução da consulta
  if(!$result){
      // Se houver um erro, exibe uma mensagem de erro e encerra o script
      echo "Can't retrieve data " . mysqli_error($conn);
      exit;
  }
  
  // Obtém a primeira linha de resultados da consulta
  $row = mysqli_fetch_assoc($result);
  
  // Verifica se não há dados retornados pela consulta, ou seja, se o livro não foi encontrado
  if(!$row){
      // Se não houver dados, exibe uma mensagem indicando que o livro está vazio e encerra o script
      echo "Empty book";
      exit;
  }
  
  // Extrai o título do livro
  $title = $row['book_title'];
  
  // Inclui o cabeçalho HTML comum a todas as páginas
  require "./template/header.php";
?>

<!-- Início do conteúdo da página -->
<p class="lead" style="margin: 25px 0"><a href="books.php">Books</a> > <?php echo $row['book_title']; ?></p>
<div class="row">
  <div class="col-md-3 text-center">
    <!-- Exibe a imagem do livro -->
    <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
  </div>
  <div class="col-md-6">
    <h4>Book Description</h4>
    <!-- Exibe a descrição do livro -->
    <p><?php echo $row['book_descr']; ?></p>
    <h4>Book Details</h4>
    <table class="table">
      <!-- Loop através dos dados do livro -->
      <?php foreach($row as $key => $value){
        // Verifica se a chave atual deve ser ignorada na exibição
        if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
          continue;
        }
        // Converte a chave para um rótulo mais legível
        switch($key){
          case "book_isbn":
            $key = "ISBN";
            break;
          case "book_author":
            $key = "Author";
            break;
          case "book_price":
            $key = "Price";
            break;
        }
      ?>
      <!-- Exibe os detalhes do livro numa tabela -->
      <tr>
        <td><?php echo $key; ?></td>
        <td><?php echo $value; ?></td>
      </tr>
      <?php 
        } 
        // Fecha a conexão com o banco de dados, se estiver aberta
        if(isset($conn)) {mysqli_close($conn); }
      ?>
    </table>
    <!-- Formulário para adicionar o livro ao carrinho -->
    <form method="post" action="cart.php">
      <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
      <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
    </form>
  </div>
</div>
<!-- Fim do conteúdo da página -->

<?php
  // Inclui o rodapé HTML comum a todas as páginas
  require "./template/footer.php";
?>
