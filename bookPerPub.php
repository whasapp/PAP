<?php
session_start();
require_once "./functions/database_functions.php";
// Verifica se o parâmetro 'pubid' está presente na URL
if (isset($_GET['pubid'])) {
	// Se 'pubid' estiver presente na URL, atribui seu valor à variável $pubid
	$pubid = $_GET['pubid'];
} else {
	// Se 'pubid' não estiver presente na URL, exibe uma mensagem de erro e encerra o script
	echo "Wrong query! Check again!";
	exit;
}

// Conecta a base de dados
$conn = db_connect();

// Obtém o nome da editora com base no ID da editora
$pubName = getPubName($conn, $pubid);

// Consulta o base de dados para obter os ISBNs, títulos e imagens dos livros da editora
$query = "SELECT book_isbn, book_title, book_image FROM books WHERE publisherid = '$pubid'";
$result = mysqli_query($conn, $query);
if (!$result) {
	// Se houver um erro durante a consulta, exibe uma mensagem de erro e encerra o script
	echo "Can't retrieve data " . mysqli_error($conn);
	exit;
}

// Verifica se não há livros associados à editora
if (mysqli_num_rows($result) == 0) {
	// Se não houver livros, exibe uma mensagem indicando que não há livros disponíveis e encerra o script
	echo "Empty books ! Please wait until new books coming!";
	exit;
}


$title = "Books Per Publisher";
require "./template/header.php";
?>
<p class="lead"><a href="publisher_list.php">Publishers</a> > <?php echo $pubName; ?></p>
<?php while ($row = mysqli_fetch_assoc($result)) {
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['book_title']; ?></h4>
			<a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
	<br>
<?php
}
if (isset($conn)) {
	mysqli_close($conn);
}
require "./template/footer.php";
?>