<?php
	session_start();
	require_once "./functions/admin_session.php";
	$title = "Edit book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();


	
	if(isset($_GET['bookisbn'])){
		// Verifica se o parâmetro 'bookisbn' está presente na URL
	
		// Se 'bookisbn' estiver presente na URL, atribui seu valor à variável $book_isbn
		$book_isbn = $_GET['bookisbn'];
	} else {
		// Se 'bookisbn' não estiver presente na URL, exibe uma mensagem de erro e encerra o script
		echo "Empty query!";
		exit;
	}
	
	// Verifica se $book_isbn está definido
	if(!isset($book_isbn)){
		// Se $book_isbn não estiver definido, exibe uma mensagem de erro e encerra o script
		echo "Empty isbn! check again!";
		exit;
	}
	
	// Consulta a base de dados para obter os dados do livro com base no ISBN fornecido
	$query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		// Se houver um erro ao recuperar os dados, exibe uma mensagem de erro e encerra o script
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	
	// Obtém a primeira linha de resultados da consulta
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="edit_book.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn" value="<?php echo $row['book_isbn'];?>" readOnly="true"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" value="<?php echo $row['book_title'];?>" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" value="<?php echo $row['book_author'];?>" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"><?php echo $row['book_descr'];?></textarea>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="number" name="price" value="<?php echo $row['book_price'];?>" required></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisher" value="<?php echo getPubName($conn, $row['publisherid']); ?>" required></td>
			</tr>
		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<input type="reset" value="Cancel" class="btn btn-default" onclick="window.history.back();">
	</form>
	<br/>
	<a href="admin_book.php" class="btn btn-success">Confirm</a>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>