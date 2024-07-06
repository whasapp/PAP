<?php
	//acaba a sessão de admin
	session_start();
	session_destroy();
	header("Location: index.php");
?>