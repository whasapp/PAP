<?php
// Inicia a sessão PHP
session_start();

// Inicializa a contagem de livros exibidos
$count = 0;

// Inclui o arquivo que contém as funções para conexão com o banco de dados
require_once "./functions/database_functions.php";

// Conecta-se ao banco de dados
$conn = db_connect();

// Consulta a base de dados para obter os ISBN e as imagens dos livros
$query = "SELECT book_isbn, book_image FROM books";
$result = mysqli_query($conn, $query);

// Verifica se houve um erro durante a execução da consulta
if (!$result) {
  echo "Can't retrieve data " . mysqli_error($conn);
  exit;
}

// Define o título da página
$title = "Full Catalogs of Books";

// Inclui o cabeçalho HTML comum a todas as páginas
require_once "./template/header.php";
?>

<!-- Título principal da página -->
<p class="lead text-center text-muted">Full Catalogs of Books</p>

<?php 
// Loop para exibir os livros em linhas de até 4 colunas
for ($i = 0; $i < mysqli_num_rows($result); $i++) { 
?>
  <div class="row">
    <?php 
    // Loop para exibir até 4 livros em cada linha
    while ($query_row = mysqli_fetch_assoc($result)) { 
    ?>
      <div class="col-md-3">
        <!-- Link para a página do livro -->
        <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
          <!-- Exibe a imagem do livro -->
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>">
        </a>
      </div>
    <?php
      // Incrementa a contagem de livros exibidos
      $count++;
      // Verifica se já foram exibidos 4 livros e reinicia a contagem para uma nova linha
      if ($count >= 4) {
        $count = 0;
        break;
      }
    } 
    ?>
  </div>
<?php
}
// Fecha a conexão com o banco de dados, se estiver aberta
if (isset($conn)) {
  mysqli_close($conn);
}
// Inclui o rodapé HTML comum a todas as páginas
require_once "./template/footer.php";
?>
