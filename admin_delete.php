<?php
	//recebe o isbn do livro que se deseja apagar
	$book_isbn = $_GET['bookisbn'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	//apaga o livro escolhido
	$query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_book.php");
?>