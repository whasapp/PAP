<?php
session_start();
require_once "./functions/database_functions.php";
require_once "./functions/cart_functions.php";

// Verifica se o ISBN do livro foi enviado através do formulário POST
if (isset($_POST['bookisbn'])) {
	$book_isbn = $_POST['bookisbn'];
}

// Verifica se o ISBN do livro está definido
if (isset($book_isbn)) {
	// Verifica se a sessão do carrinho ainda não está definida
	if (!isset($_SESSION['cart'])) {
		// Se não estiver, inicializa as variáveis de sessão relacionadas ao carrinho
		$_SESSION['cart'] = array();
		$_SESSION['total_items'] = 0;
		$_SESSION['total_price'] = '0.00';
	}

	// Verifica se o livro ainda não está no carrinho
	if (!isset($_SESSION['cart'][$book_isbn])) {
		// Se não estiver, adiciona o livro ao carrinho com uma quantidade inicial de 1
		$_SESSION['cart'][$book_isbn] = 1;
	}
	// Se o livro já estiver no carrinho e um formulário com nome 'cart' for enviado
	elseif (isset($_POST['cart'])) {
		// Aumenta a quantidade do livro no carrinho em 1
		$_SESSION['cart'][$book_isbn]++;
		// Remove os dados do POST para evitar submissões múltiplas
		unset($_POST);
	}
}

// Se o formulário foi submetido com o botão 'save_change'
if (isset($_POST['save_change'])) {
	// Navega sobre cada item no carrinho
	foreach ($_SESSION['cart'] as $isbn => $qty) {
		
		// Verifica se a quantidade do item foi alterada para 0
		if ($_POST[$isbn] <= '0' || trim($_POST[$isbn]) == '') {
			// Se sim, remove o item do carrinho
			unset($_SESSION['cart']["$isbn"]);
		} else {
			// Senão, atualiza a quantidade do item no carrinho
			$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
		}
	}
}

$title = "Your shopping cart";
require "./template/header.php";

// Verifica se há itens no carrinho
if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
	// Calcula o preço total e o número total de itens no carrinho
	$_SESSION['total_price'] = total_price($_SESSION['cart']);
	$_SESSION['total_items'] = total_items($_SESSION['cart']);

?>
	<form action="cart.php" method="post">
		<table class="table">
			<tr>
				<th>Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			<?php
			foreach ($_SESSION['cart'] as $isbn => $qty) {
				$conn = db_connect();
				$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
				<tr>
					<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
					<td><?php echo  $book['book_price'] . "€"; ?></td>
					<td><input type="number" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
					<td><?php echo $qty * $book['book_price'] . "€"; ?></td>
				</tr>
			<?php } ?>
			<tr>
				<th>Total</th>
				<th>&nbsp;</th>
				<th><?php echo $_SESSION['total_items']; ?></th>
				<th><?php echo $_SESSION['total_price'] . "€"; ?></th>
			</tr>
		</table>
		<input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
	</form>
	<br /><br />
	<a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
	<a href="books.php" class="btn btn-primary">Continue Shopping</a>
<?php
} else {
	echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p><a href=\"books.php\" class=\"btn btn-primary\">Continue Shopping</a>";
}
if (isset($conn)) {
	mysqli_close($conn);
}
require_once "./template/footer.php";
?>