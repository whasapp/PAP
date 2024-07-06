<?php
// Verifica se o formulário foi submetido com o botão 'save_change'
if (!isset($_POST['save_change'])) {
	// Se não, exibe uma mensagem de erro e encerra o script
	echo "Something wrong!";
	exit;
}

// Obtém os dados do formulário
$isbn = trim($_POST['isbn']);
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$descr = trim($_POST['descr']);
$price = floatval(trim($_POST['price']));
$publisher = trim($_POST['publisher']);

// Verifica se uma imagem foi enviada no formulário e a move para o diretório de imagens, se necessário
if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
	$image = $_FILES['image']['name'];
	$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
	$uploadDirectory .= $image;
	move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
}

require_once("./functions/database_functions.php");
$conn = db_connect();

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

// Cria a consulta SQL para atualizar os dados do livro
$query = "UPDATE books SET  
    book_title = '$title', 
    book_author = '$author', 
    book_descr = '$descr', 
    book_price = '$price',
    publisherid = '$publisherid'";
if (isset($image)) {
	$query .= ", book_image='$image' WHERE book_isbn = '$isbn'";
} else {
	$query .= " WHERE book_isbn = '$isbn'";
}

// Executa a consulta de atualização na base de dados
$result = mysqli_query($conn, $query);
if (!$result) {
	// Se houver um erro ao atualizar os dados, exibe uma mensagem de erro e encerra o script
	echo "Can't update data " . mysqli_error($conn);
	exit;
} else {
	// Se a atualização for bem-sucedida, redireciona para a página de edição do livro
	header("Location: admin_edit.php?bookisbn=$isbn");
}
