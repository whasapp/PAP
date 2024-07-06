<?php
	//verifica se a sessão se encontra como admin 
	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != true){
		header("Location: index.php");
	}
?>