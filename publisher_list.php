<?php
	// Inicia uma nova sessão ou retoma a sessão existente
	session_start();
	// Inclui as funções da base de dados
	require_once "./functions/database_functions.php";
	// Conecta à base de dados
	$conn = db_connect();

	// Consulta para selecionar todos os editores, ordenados pelo ID do editor
	$query = "SELECT * FROM publisher ORDER BY publisherid";
	$result = mysqli_query($conn, $query);
	// Verifica se a consulta falhou
	if(!$result){
		// Se falhou, exibe uma mensagem de erro e encerra o script
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	// Verifica se não há resultados
	if(mysqli_num_rows($result) == 0){
		// Se não há resultados, exibe uma mensagem de erro e encerra o script
		echo "Empty publisher ! Something wrong! check again";
		exit;
	}

	// Define o título da página
	$title = "List Of Publishers";
	// Inclui o cabeçalho da página
	require "./template/header.php";
?>
	<p class="lead">List of Publisher</p>
	<ul>
	<?php 
		// Percorre sobre cada editor retornado pela consulta
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			// Consulta para selecionar todos os IDs de editores dos livros
			$query = "SELECT publisherid FROM books";
			$result2 = mysqli_query($conn, $query);
			// Verifica se a consulta falhou
			if(!$result2){
				// Se falhou, exibe uma mensagem de erro e encerra o script
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			// precorre sobre cada editor associado a um livro
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				// Incrementa o contador se o ID do editor do livro corresponder ao ID do editor atual
				if($pubInBook['publisherid'] == $row['publisherid']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="bookPerPub.php?pubid=<?php echo $row['publisherid']; ?>"><?php echo $row['publisher_name']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
<?php
	// Fecha a conexão com a base de dados
	mysqli_close($conn);
	// Inclui o rodapé da página
	require "./template/footer.php";
?>
