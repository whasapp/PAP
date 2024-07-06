<?php
session_start();
if (!isset($_POST['submit'])) {
    $_SESSION['error_message'] = "Something went wrong! Please check again!";
    header("Location: admin.php");
    exit;
}

require_once "./functions/database_functions.php";
$conn = db_connect();

// Remove espaços em branco em excesso dos valores dos campos do formulário
$name = trim($_POST['name']);
$pass = trim($_POST['pass']);

// Escapa os valores dos campos 'name' e 'pass' para evitar injeção de SQL
$name = mysqli_real_escape_string($conn, $name);
$pass = mysqli_real_escape_string($conn, $pass);

// Verifica se o campo 'name' ou 'pass' está vazio
if ($name == "" || $pass == "") {
    // Se algum campo estiver vazio, define a mensagem de erro e redireciona para a página de login
    $_SESSION['error_message'] = "Name or Password is empty!";
    header("Location: admin.php");
    exit;
}

// Consulta a base de dados para obter os dados do administrador
$query = "SELECT name, pass FROM admin";
$result = mysqli_query($conn, $query);
if (!$result) {
    // Se houver um erro ao recuperar os dados, define a mensagem de erro e redireciona para a página de login
    $_SESSION['error_message'] = "Empty data " . mysqli_error($conn);
    header("Location: admin.php");
    exit;
}

// Obtém a primeira linha de resultados da consulta
$row = mysqli_fetch_assoc($result);

// Verifica se o nome de utilizador e a senha fornecidos correspondem aos dados do administrador na base de dados
if ($name == $row['name'] && $pass == $row['pass']) {
    // Fecha a conexão com a base de dados se estiver aberta
    if (isset($conn)) {
        mysqli_close($conn);
    }

    // Define $_SESSION['admin'] como true e redireciona para a página admin_book.php
    $_SESSION['admin'] = true;
    header("Location: admin_book.php");
    exit;
}

// Se os dados não corresponderem, define a mensagem de erro e redireciona para a página de login
$_SESSION['error_message'] = "Name or Password is incorrect. Please check again!";
$_SESSION['admin'] = false;
header("Location: admin.php");
exit;
?>