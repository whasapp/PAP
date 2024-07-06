<?php
	/*
		serve para confirmar se a sessao se encontra como admin para segurança
	*/
	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != true){
		header("Location: index.php");
	}
?>