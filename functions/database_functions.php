<?php
	/* Conexão a base de dados Fantasy_Gate */
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "Fantasy_gate");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	/* Função para encontrar os 4 últimos livros adicionados a base de dados para os mostrar na pagina incial */
	function select4LatestBook($conn){
		$row = array();
		$query = "SELECT book_isbn, book_image FROM books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 4; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}

	/* Função para encontrar um livro dado o seu ISBN */
	function getBookByIsbn($conn, $isbn){
		$query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	/* Função para estrair os id´s das das orders de um cliente especificado */
	function getOrderId($conn, $customerid){
		$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}

	/* Função para inserir na tabela "orders" os dados recebidos */
	function insertIntoOrder($conn, $customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country, $email){
		$query = "INSERT INTO orders VALUES 
		('', '" . $customerid . "',
		'" . $total_price . "',
		'" . $date . "',
		'" . $ship_name . "',
		'" . $ship_address . "',
		'" . $ship_city . "',
		'" . $ship_zip_code . "',
		'" . $ship_country . "',
		'" . $email ."')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
	}

	/* Função para estrair o preço de um livro especificado */
	function getbookprice($isbn){
		$conn = db_connect();
		$query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['book_price'];
	}

	/* Função para estrair o id de um cliente */
	function getCustomerId($name, $address, $city, $zip_code, $country, $email){
		$conn = db_connect();
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country' AND
		email = '$email'";
		$result = mysqli_query($conn, $query);
		
		if (!$result) {
			return null;
		} else {
			$row = mysqli_fetch_assoc($result);
			if ($row) {
				return $row["customerid"];
			} else {
				return null;
			}
		}
	}

	/* Função para inserir dados de um clienten */
	function setCustomerId($name, $address, $city, $zip_code, $country, $email){
		$conn = db_connect();
		$query = "INSERT INTO customers VALUES 
			('', '" . $name . "', '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "', '" . $email. "')";

		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "insert false !" . mysqli_error($conn);
			exit;
		}
		$customerid = mysqli_insert_id($conn);
		return $customerid;
	}

	/* Função para estrair o nome de um editora especificada */
	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty books ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}

	/* Função para estrair todos os dados de todos os livros na base de dados */
	function getAll($conn){
		$query = "SELECT * from books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
?>