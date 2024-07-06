<?php
  $title = "Contact";
  require_once "./template/header.php";

  session_unset();
  // Inclui o arquivo do PHPMailer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  // Verifica se o formulário foi enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Instancia o objeto PHPMailer
    $mail = new PHPMailer(true);

    try {
      // Configurações do servidor SMTP
      $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'filipeisakov06@gmail.com';
    $mail->Password   = 'gwyeafgetskwpnnb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

      // Define o endereço de email do remetente e do destinatário
      $mail->setFrom($email, $name);
      $mail->addAddress('filipeisakov06@gmail.com'); 

      // Conteúdo do email
      $mail->isHTML(true);
      $mail->Subject = 'Comment';
      $mail->Body    = "<p><b>Name:</b> $name</p><p><b>Email:</b> $email</p><p><b>Message:</b><br>$message</p>";

      // Enviar o email
      $mail->send();

      // Mensagem de sucesso
      echo '<div class="alert alert-success" role="alert">Your message has been sent successfully!</div>';
    } catch (Exception $e) {
      // Mensagem de erro
      echo '<div class="alert alert-danger" role="alert">Error sending message. Please try again later.</div>';
    }
  }
?>

<!-- Formulário de contato -->
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="form-horizontal">
      <fieldset>
        <legend>Contact</legend>
        <p class="lead">I’d love to hear from you! Complete the form to send me an email.</p>
        <div class="form-group">
          <label for="inputName" class="col-lg-2 control-label">Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="textArea" class="col-lg-2 control-label">Message</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="textArea" name="message" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="col-md-3"></div>
</div>

<?php
  require_once "./template/footer.php";
?>
