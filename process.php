<?php
	// Inicia uma nova sessão ou retoma a sessão existente
	session_start();

	// Inicializa uma variável de sessão 'err' com valor 1
	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		// Verifica se algum valor no formulário POST está vazio após remover espaços em branco
		if(trim($value) == ''){
			// Se houver um campo vazio, define a variável de sessão 'err' como 0(erro)
			$_SESSION['err'] = 0;
		}
		break;  // Sai do loop após a primeira verificação
	}

	// Se houver um erro...
	if($_SESSION['err'] == 0){
		// Redireciona para a página de compra
		header("Location: purchase.php");
	} else {
		// Caso contrário, remove a variável de sessão 'err'
		unset($_SESSION['err']);
	}

	// Inclui o arquivo de funções da base de dados
	require_once "./functions/database_functions.php";
	// Define o título da página
	$title = "Purchase Process";
	// Inclui o cabeçalho da página
	require "./template/header.php";
	// Conecta à base de dados
	$conn = db_connect();
	// Extrai as variáveis de sessão relacionadas ao envio
	if (!isset($_SESSION['ship'])) {
		header("Location: books.php");
		exit();
	} else {
		extract($_SESSION['ship']);
	}

	// Obtém o ID do cliente com base nas informações de envio
	$customerid = getCustomerId($name, $address, $city, $zip_code, $country, $email);
	// Se o cliente não existir, cria um novo ID de cliente
	if($customerid == null) {
		$customerid = setCustomerId($name, $address, $city, $zip_code, $country, $email);
	}

	
	// Define a data atual
	$date = date("Y-m-d H:i:s");
	// Insere a ordem na base de dados
	insertIntoOrder($conn, $customerid, $_SESSION['total_price'], $date, $name, $address, $city, $zip_code, $country, $email);


	// Obtém o ID do pedido recém-criado
	$orderid = getOrderId($conn, $customerid);
	// Percorre sobre cada item no carrinho
	foreach($_SESSION['cart'] as $isbn => $qty){
		// Obtém o preço do livro
		$bookprice = getbookprice($isbn);
		// Insere os itens do pedido na base de dados
		$query = "INSERT INTO order_items VALUES 
		('$orderid', '$isbn', '$bookprice', '$qty')";
		$result = mysqli_query($conn, $query);
		// Verifica se houve um erro ao inserir os dados
		if(!$result){
			// Se houver um erro, exibe uma mensagem de erro e encerra o script
			echo "Insert value false!" . mysqli_error($conn);
			exit;
		}
	}
	// Gerar HTML da tabela do carrinho
$cartTable = '<table class="table">
<tr>
	<th>Item</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Total</th>
</tr>';
foreach ($_SESSION['cart'] as $isbn => $qty) {
$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
$cartTable .= '<tr>
	<td>' . $book['book_title'] . ' by ' . $book['book_author'] . '</td>
	<td>' . $book['book_price'] . '€</td>
	<td>' . $qty . '</td>
	<td>' . ($qty * $book['book_price']) . '€</td>
</tr>';
}
$cartTable .= '<tr>
<th>Total</th>
<th>&nbsp;</th>
<th>' . $_SESSION['total_items'] . '</th>
<th>' . $_SESSION['total_price'] . '€</th>
</tr></table>';



	// Limpa todas as variáveis de sessão
	session_unset();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'filipeisakov06@gmail.com';
    $mail->Password   = 'gwyeafgetskwpnnb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('filipeisakov06@gmail.com', 'Fantasy Gate');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Order confirmation - Order #' . $orderid;
    $mail->Body    = "<p>Hello,</p><p>Thank you for your purchase! Your order #$orderid has been received and is being processed.</p>
	<p>Here is the summary of your order:</p>$cartTable<p>Best regards,<br>Fantasy Gate</p>";

    $mail->send();
} catch (Exception $e) {
    echo "Erro ao enviar e-mail de confirmação. Mailer Error: {$mail->ErrorInfo}";
}

?>
	<div class="alert alert-success" role="alert">Your order has been processed sucessfully. Please check your email to get your order confirmation and shipping detail!. 
	Your cart has been emptied.</div>
	<a href="books.php" class="btn btn-primary">Continue Shopping</a>
<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>