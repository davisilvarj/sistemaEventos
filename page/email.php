<?php 
require ("connect.php");
require ("back-evento.php");

require ("PHPMailerAutoload.php");
require ("credenciais.php");

	
	$id = $_POST["id"];
	$eventos = buscaEvent($connect, $id);

		foreach ($eventos as $evento){
			$inicio = $evento['hr_inicio'];
			$termino = $evento['hr_termino'];
			$data = $evento['data'];
			$solicitante = $evento['nome_solicitante'];
			$evento = $evento['nome_evento'];
			$conf_nusop = $evento['conf_nusop'];
			$conf_nutin = $evento['conf_nutin'];
			$conf_nucom = $evento['conf_nucom'];
		}

	if ($conf_nusop == 1){
		$infoNusop = 'foi solicitado para evento';
	}elseif ($conf_nusop == 0) {
		$infoNusop = 'não foi solicitado para evento';
	}
	if ($conf_nutin == 1){
		$infoNutin = 'foi solicitado para evento';
	}elseif ($conf_nutin == 0) {
		$infoNutin = 'não foi solicitado para evento';
	}
	if ($conf_nucom == 1){
		$infoNucom = 'foi solicitado para evento';
	}elseif ($conf_nucom == 0) {
		$infoNucom = 'não foi solicitado para evento';
	}

	$Mensagem = utf8_encode($_REQUEST["sendmail"]);
	
	$usuarios = buscaSet($connect, $Mensagem);

		foreach ($usuarios as $usuario){
	        $email = $usuario['email'];
	        $nome = $usuario['nome'];
	        $setor = $usuario['setor'];
	    }

	$email_solicitante = $_POST['email_solicitante'];

//Enviando Mensagem    
	switch($Mensagem){
        case 'Direcao':
        	$direcao = 'enviado';
			envioDiretor($connect, $direcao, $id);

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

			$mail->addAddress($email);     			// Add a recipient
			
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id."</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
				
					header("Location: search-evento.php");
					die();
				}
		break;
		case 'Coafi':
			$admin = 'enviado';
			envioAdmin($connect, $admin, $id);

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

			$mail->addAddress($email);     			// Add a recipient

			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. "</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
					header("Location: search-evento.php");
					die();
				}

		break;
		case 'Capelania':

			$cap = 'enviado';
			envioCap($connect, $cap, $id);	

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

			$mail->addAddress($email);     			// Add a recipient
			
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. "</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
					header("Location: search-evento.php");
					die();
				}

		break;
		case 'Secca':

			$secretaria = 'enviado';
			envioSecca($connect, $secretaria, $id);

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

			$mail->addAddress($email);     			// Add a recipient

			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. "</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
					header("Location: search-evento.php");
					die();
				}

		break;
		case 'Nutin':

			$nutin = 'enviado';
			envioNutin($connect, $nutin, $id);

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

			$mail->addAddress($email);     			// Add a recipient
			


			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. 
				'<p>O setor NUSOP '.$infoNusop.
				'<p>O setor NUCOM '.$infoNucom."</p>
				
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


		if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
				header("Location: search-evento.php");
				die();
			}


		break;
		case 'Nucom':

			$nucom = 'enviado';
			envioNucom($connect, $nucom, $id);

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

			$mail->addAddress($email);     			// Add a recipient
			
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. 
				'<p>O setor NUSOP '.$infoNusop.
				'<p>O setor NUTIM '.$infoNutim."</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


		if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
				header("Location: search-evento.php");
				die();
			}
		break;
		case 'Nusop':

			$nusop = 'enviado';
			envioNusop($connect, $nusop, $id);

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

			$mail->addAddress($email);     			// Add a recipient
			


			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Pedido de Evento');
			$mail->Body    = ('<p>'.$solicitante.' solicitou o evento '.$evento.' para o dia '.$data.' horário das: '.$inicio.' às '.$termino. ' código do evento '. $id. 
				'<p>O setor NUSOP '.$infoNutin.
				'<p>O setor NUCOM '.$infoNucom."</p>
				<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


		if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["success"] = "Mensagem enviada com sucesso!".$email;
				header("Location: search-evento.php");
				die();
			}
		break;
	}

//Monitoria
	if($Mensagem == 'controle'){
		

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

		$mail->addAddress($email);     			// Add a recipient

		$mail->addReplyTo(EMAIL);

		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(TRUE);				// Set email format to HTML
		$mail->CharSet  = 'utf-8';
		$mail->Subject = ('Pedido de Evento');
		$mail->Body    = ('<p>'.$nome_solicitante.' solicitou o evento '.$nome_evento.' para o dia '.$data_evento.' horário das: '.$hr_inicio.' às '.$hr_termino. ' código do evento '. $fk_evento. "</p>
			<p>Consulte o evento através do link ".'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>".$Mensagem);
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Mensagem enviada com sucesso!';
		}
	}


