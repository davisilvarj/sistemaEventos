<?php   
require ("PHPMailerAutoload.php");
require ("credenciais.php");

$usuarios = buscaSet($connect, $Mensagem);

	foreach($usuarios as $usuario){
		$email_setor = $usuario['email'];
	}


$mail = new PHPMailer;

//$mail->SMTPDebug = 4;					// Enable verbose debug output

$mail->isSMTP();						// Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';		// Specify main and backup SMTP servers
$mail->SMTPAuth = TRUE;					// Enable SMTP authentication
$mail->Username = EMAIL;				// SMTP username
$mail->Password = PASS;					// SMTP password
$mail->SMTPSecure = 'starttls';			// Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;						// TCP port to connect to

$mail->setFrom(EMAIL);

$mail->addAddress($email_setor);     	// Add a recipient
$mail->addCC($email);
$mail->addReplyTo(EMAIL);

//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(TRUE);					// Set email format to HTML

$mail->CharSet  = 'utf-8';
$mail->Subject = ('Pedido de Evento');
$mail->Body    = ('<p>'.$nome_solicitante.' solicitou o evento '.$nome_evento.' para o dia '.$data_evento.' horário das: '.$hr_inicio.' às '.$hr_termino. ' código do evento '. $fk_evento. "</p>
	<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$_SESSION["success"] = "Solicitação realizada! Cógido do evento: ". $fk_evento;
		header("Location: date.php?pesquisar=$fk_evento");
		?>
	    <h5 class='alert alert-success'>Solicitação realizada! Cógido do evento: <?= $fk_evento ?> </h5> 
	    <?php
	}

