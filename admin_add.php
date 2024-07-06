<?php
	session_start();
	require_once "./functions/admin_session.php";
	$title = "Add new book";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	// Verifica se o formulário foi submetido com o botão 'add'
	if(isset($_POST['add'])){
		
	
		// Limpa e escapa os valores dos campos do formulário para evitar injeção de SQL
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
	
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);
	
		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
	
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
	
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
	
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);
	
		// Adiciona a imagem do livro, se fornecida no formulário
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}
	
		// Verifica se o editora do livro já existe na base de dados
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		if(mysqli_num_rows($findResult) == 0){
			// Se a editora não existe, adiciona uma nova editora à base de dados
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			// Obtém o ID da nova editora adicionada
			$publisherid = mysqli_insert_id($conn);
		} else {
			// Se a editora existe, obtém o ID da editora encontrada
			$row = mysqli_fetch_assoc($findResult);
			$publisherid = $row['publisherid'];
		}
	
		// Insere os valores na tabela books no base de dados
		$query = "INSERT INTO books VALUES (
		'" . $isbn . "', 
		'" . $title . "', 
		'" . $author . "', 
		'" . $image . "', 
		'" . $descr . "', 
		'" . $price . "', 
		'" . $publisherid . 
		"')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			// Se houver um erro ao adicionar os dados, exibe uma mensagem de erro
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			// Se a inserção for bem-sucedida, redireciona para a página admin_book.php
			header("Location: admin_book.php");
		}
	}
	
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn" required></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image" required></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="number" name="price" required></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisher" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new book" class="btn btn-primary">
		<input type="reset" value="Cancel" class="btn btn-default" onclick="window.history.back();">
	</form>
	<br/>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>