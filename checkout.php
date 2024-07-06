<?php
// Inicia a sessão PHP
session_start();

// Inclui o arquivo que contém as funções para conexão com o banco de dados
require_once "./functions/database_functions.php";

// Define o título da página
$title = "Checking out";

// Inclui o cabeçalho HTML comum a todas as páginas
require "./template/header.php";

// Verifica se o carrinho não está vazio
if (isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])) {
  // Verifica se o formulário foi enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera e limpa os dados do formulário
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $zip_code = trim($_POST['zip_code']);
    $country = trim($_POST['country']);
    $email = trim($_POST['email']);
    
    // Inicializa o array de erros
    $errors = [];
    
    // Valida os dados do formulário
    if (empty($name)) {
      $errors[] = "Name is required.";
    }
    if (empty($address)) {
      $errors[] = "Address is required.";
    }
    if (empty($city)) {
      $errors[] = "City is required.";
    }
    if (empty($zip_code)) {
      $errors[] = "Zip Code is required.";
    }
    if (empty($country)) {
      $errors[] = "Country is required.";
    }
    if (empty($email)) {
      $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
    }
    
    // Se houver erros, redireciona de volta para a página de checkout com mensagens de erro
    if (!empty($errors)) {
      $_SESSION['err'] = 1;
      $_SESSION['error_msgs'] = $errors;
      header("Location: checkout.php");
      exit();
    } else {
      // Se não houver erros, redireciona para a página de compra
      header("Location: purchase.php"); 
      exit();
    }
  }
?>
<!-- Tabela de resumo do carrinho -->
<table class="table">
  <tr>
    <th>Item</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
  </tr>
  <?php
  // Loop para exibir os itens do carrinho
  foreach ($_SESSION['cart'] as $isbn => $qty) {
    $conn = db_connect();
    $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
  ?>
  <tr>
    <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
    <td><?php echo $book['book_price'] . "€"; ?></td>
    <td><?php echo $qty; ?></td>
    <td><?php echo $qty * $book['book_price'] . "€"; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th><?php echo $_SESSION['total_items']; ?></th>
    <th><?php echo $_SESSION['total_price'] . "€"; ?></th>
  </tr>
</table>

<!-- Formulário de checkout -->
<form method="post" action="purchase.php" class="form-horizontal">
  <?php if (isset($_SESSION['err']) && $_SESSION['err'] == 1) { ?>
    <p class="text-danger">All fields have to be filled</p>
  <?php } ?>
  <div class="form-group">
    <label for="name" class="control-label col-md-4">Name</label>
    <div class="col-md-4">
      <input type="text" name="name" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="control-label col-md-4">Address</label>
    <div class="col-md-4">
      <input type="text" name="address" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <label for="city" class="control-label col-md-4">City</label>
    <div class="col-md-4">
      <input type="text" name="city" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <label for="zip_code" class="control-label col-md-4">Zip Code</label>
    <div class="col-md-4">
      <input type="text" name="zip_code" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <label for="country" class="control-label col-md-4">Country</label>
    <div class="col-md-4">
      <input type="text" name="country" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="control-label col-md-4">Email</label>
    <div class="col-md-4">
      <input type="email" name="email" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <input type="submit" name="submit" value="Purchase" class="btn btn-primary">
    <a href="books.php" class="btn btn-primary">Continue Shopping</a>
  </div>
</form>
<p class="lead">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</p>
<?php
} else {
  // Mensagem se o carrinho estiver vazio
  echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
}

// Fecha a conexão com o banco de dados, se estiver aberta
if (isset($conn)) {
  mysqli_close($conn);
}

// Inclui o rodapé HTML comum a todas as páginas
require_once "./template/footer.php";
?>
