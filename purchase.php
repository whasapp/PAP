<?php
	// Inicia uma nova sessão ou retoma a sessão existente
	session_start();
	// Define uma variável de sessão para verificar erros
	$_SESSION['err'] = 1;
	// Percorre sobre os dados enviados via POST
	foreach($_POST as $key => $value){
		// Verifica se algum campo está vazio após remover espaços em branco
		if(trim($value) == ''){
			// Se algum campo estiver vazio, define a variável de erro como 0
			$_SESSION['err'] = 0;
		}
		// Sai do loop após a primeira verificação
		break;
	}

	// Se houve algum erro (campo vazio)
	if($_SESSION['err'] == 0){
		// Redireciona para a página de checkout
		header("Location: checkout.php");
	} else {
		// Caso contrário, remove a variável de erro da sessão
		unset($_SESSION['err']);
	}

	// Cria um array para armazenar os dados de envio(os preenchidos na pagina de checkout.php)
	$_SESSION['ship'] = array();
	// Percorre novamente sobre os dados enviados via POST
	foreach($_POST as $key => $value){
		// Ignora o campo 'submit'
		if($key != "submit"){
			// Armazena os dados de envio na sessão
			$_SESSION['ship'][$key] = $value;
		}
	}
	// Inclui as funções da base de dados
	require_once "./functions/database_functions.php";
	// Define o título da página
	$title = "Purchase";
	// Inclui o cabeçalho da página
	require "./template/header.php";
	
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>
	<!-- Tabela para exibir os itens do carrinho -->
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
	    	<th>Quantity</th>
	    	<th>Total</th>
	    </tr>
	    <!-- Percorre sobre os itens do carrinho -->
	    <?php
		    foreach($_SESSION['cart'] as $isbn => $qty){
				// Conecta à base de dados
				$conn = db_connect();
				// Obtém os detalhes do livro pelo ISBN
				$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
		?>
		<tr>
			<!-- Exibe o título e autor do livro -->
			<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
			<!-- Exibe o preço do livro -->
			<td><?php echo $book['book_price'] . "€"; ?></td>
			<!-- Exibe a quantidade do livro no carrinho -->
			<td><?php echo $qty; ?></td>
			<!-- Exibe o total (preço x quantidade) -->
			<td><?php echo $qty * $book['book_price'] . "€"; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<!-- Exibe o total de itens no carrinho -->
			<th><?php echo $_SESSION['total_items']; ?></th>
			<!-- Exibe o preço total dos itens no carrinho -->
			<th><?php echo $_SESSION['total_price'] . "€"; ?></th>
		</tr>
		<tr>
			<th>Total</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<!-- Exibe o total incluindo envio -->
			<th><?php echo ($_SESSION['total_price']) . "€"; ?></th>
		</tr>
	</table>
	<!-- Formulário para entrada dos detalhes do cartão de crédito -->
	<form method="post" action="process.php" class="form-horizontal">
		<!-- Exibe mensagem de erro se houver campos obrigatórios não preenchidos -->
		<?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
		<p class="text-danger">All fields have to be filled</p>
		<?php } ?>
        <div class="form-group">
            <label for="card_type" class="col-lg-2 control-label">Type</label>
            <div class="col-lg-10">
              	<select class="form-control" name="card_type">
                  	<option value="VISA">VISA</option>
                  	<option value="MasterCard">MasterCard</option>
                  	<option value="American Express">American Express</option>
              	</select>
            </div>
        </div>
        <div class="form-group">
            <label for="card_number" class="col-lg-2 control-label">Number</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_number">
            </div>
        </div>
        <div class="form-group">
            <label for="card_PID" class="col-lg-2 control-label">PID</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_PID">
            </div>
        </div>
        <div class="form-group">
            <label for="card_expire" class="col-lg-2 control-label">Expiry Date</label>
            <div class="col-lg-10">
              	<input type="date" name="card_expire" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="card_owner" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
              	<input type="text" class="form-control" name="card_owner">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              	<button type="reset" class="btn btn-default">Cancel</button>
              	<button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </div>
    </form>
	<p class="lead">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</p>
<?php
	} else {
		// Mensagem exibida se o carrinho estiver vazio
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	// Fecha a conexão com a base de dados, se aberta
	if(isset($conn)){ mysqli_close($conn); }
	// Inclui o rodapé da página
	require_once "./template/footer.php";
?>
