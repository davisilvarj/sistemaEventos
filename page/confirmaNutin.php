<?php
include ("head.php"); 
include ("connect.php"); 
include ("logic-user.php"); 
include ("back-evento.php");
require ("PHPMailerAutoload.php");
require ("credenciais.php");

$id = $_REQUEST['id'];
	$eventos = buscaEvent($connect, $id);

		foreach ($eventos as $evento){
			$inicio = $evento['hr_inicio'];
			$termino = $evento['hr_termino'];
			$data = $evento['data'];
			$solicitante = $evento['nome_solicitante'];
			$evento = $evento['nome_evento'];
		}

$drt = userLog();
    $usuarios = buscaUser($connect, $drt);
        foreach ($usuarios as $usuario){
            $setor = $usuario['setor'];
        }

$email_solic = $_POST['email_solicitante'];

$Mensagem = 'Monitoramento';
	$mails = buscaSet($connect, $Mensagem);

			foreach($mails as $mail){
				$nome 	= $mail['nome'];
				$email 	= $mail['email'];
			}

//DIRETOR OK 
	if($setor == 'Direcao'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];

		$jus_diretor = $_REQUEST['jus_diretor'];
		

		if($confirma == 1){
			$pres_diretor = 'deferido';
			$status = 'deferido';
			if (confirmaDiretoria($connect, $pres_diretor, $jus_diretor, $id) and deferirEvento($connect, $status, $id)){?>
				<p class="alert-success">
		    		Deferido pela Diretoria.
		   		</p>
		   		<p> Com justificativa: </p>
		   		<textarea style="width: 800px; height: 250px;"><?= $jus_diretor?></textarea>
		   	<?php	
			} 
		}
		if($confirma == 0){
			$pres_diretor = 'indeferido';
			$status = 'indeferido';
			if (confirmaDiretoria($connect, $pres_diretor, $jus_diretor, $id) and deferirEvento($connect, $status, $id)){?>
				<p class="alert-success">Indeferido!</p>
		    	<p> JUSTIFICATIVA: </p>
		    	<textarea style="width: 800px; height: 250px;"><?= $jus_diretor?></textarea>		
		   	<?php	
			} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Direção Geral');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_diretor.' pela Direção Geral </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso!";
					header("Location: search-evento.php");
					die();
				}
		
	}

//COORDENADOR OK 
	if($setor == 'Coafi'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];

		$jus_coord = $_REQUEST['jus_coord'];

		if($confirma == 1){
			$pres_coord = 'deferido';
			if (confirmaCoord($connect, $pres_coord, $jus_coord, $id)){
				?>
					<p class="alert-success">
			    		Deferido pela Coordenação.
			   		</p>
			   		<p> Com justificativa: </p>
			   		<textarea style="width: 800px; height: 250px;"><?= $jus_coord?></textarea>
			   	<?php	
				} 
		}
		if($confirma == 0){
			$pres_coord = 'indeferido';

			if (cconfirmaCoord($connect, $pres_coord, $jus_coord, $id)){	
				?>
					<p class="alert-success">Indeferido!</p>
			    	<p> JUSTIFICATIVA: </p>
			    	<textarea style="width: 800px; height: 250px;"><?= $jus_coord?></textarea>
			   	<?php	
				} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Coordenação Acadêmica e Financeira ');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_coord.' pela Coordenação Acadêmica e Financeira </p>
				<p>Consulte o evento através do link: '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>
				<p> Justificativa: </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			

			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}
		
	}

//CAPELANIA OK 
	if($setor == 'Capelania'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];

		$jus_cap = $_REQUEST['jus_cap'];

		if($confirma == 1){
			$pres_cap = 'deferido';

			if (confirmaCap($connect, $pres_cap, $jus_cap, $id)){?>
				<p class="alert-success">
			   		Deferido pela Capelania.
			  	</p>
		 		<p> Com justificativa: </p>
		   		<textarea style="width: 800px; height: 250px;"><?= $jus_cap?></textarea>
			<?php	
			} 
		}
		if($confirma == 0){
			$pres_cap = 'indeferido';
			if (confirmaCap($connect, $pres_cap, $jus_cap, $id)){?>
				<p class="alert-success">Indeferido!</p>
			   	<p> JUSTIFICATIVA: </p>
			   	<textarea style="width: 800px; height: 250px;"><?= $jus_cap?></textarea>		
			<?php	
			} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Capelania');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_cap.' pela Capelania </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}
		
	}

//SECRETARIA OK 
	if($setor == 'Secca'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];
		
		$jus_secca = $_REQUEST['jus_secca'];
		
		$cod_pai = $_REQUEST['codpai'];

		
		if($confirma == 1){
			$conf_secca = 'deferido';
			if (confirmaSecca($connect, $conf_secca, $jus_secca,  $cod_pai, $id)){
				?>
					<p class="alert-success">
			    		Deferido pela Secretaria.
			   		</p>
			   		<p> Com justificativa: </p>
			   		<textarea style="width: 800px; height: 250px;"><?= $jus_secca?></textarea>

			   	<?php	
				} 
		}
		if($confirma == 0){
			$conf_secca = 'indeferido';

			if (confirmaSecca($connect, $conf_secca, $jus_secca, $cod_pai,$id)){	
				?>
					<p class="alert-success">Secca  Indeferido!</p>
			    	<p> JUSTIFICATIVA: </p>
			    	<textarea style="width: 800px; height: 250px;"><?= $jus_secca?></textarea>		
			   	<?php	
				} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Secretaria Acadêmica');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$conf_secca.' pela Secretaria Acadêmica </p>
				<p> Código Pai: '.$cod_pai.' </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}

		
	}		

//NUTIN
	if($setor == 'Nutin'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];
		$jus_nutin= $_REQUEST['justifyNutin'];

		if($confirma == 1){
			$pres_nutin = 'deferido';

			if (confirmaNutin($connect, $pres_nutin, $jus_nutin, $id)){
				
				?>
					<p class="alert-success">
			    		Participação NUTIN cofirmado!
			   		</p>
			   		<p> Com justificativa: </p>
			   		<textarea style="width: 800px; height: 250px;"><?= $jus_nutin?></textarea>
			   	<?php	
				} 
		}
		if($confirma == 0){
			$pres_nutin = 'indeferido';

			if (confirmaNutin($connect, $pres_nutin, $jus_nutin, $id)){
				?>
					<p class="alert-success">Participação NUTIN Indeferido!</p>
			    	<p> JUSTIFICATIVA: </p>
			    	<textarea style="width: 800px; height: 250px;"><?= $jus_nutin?></textarea>	
			   	<?php	
				} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Nutin');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_nutin.' pelo Núcleo de Tecnologia da Informação (Nutin) </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}

	}	

//NUSOP
	if($setor == 'Nusop'){
	include ("menu.php");

	$confirma = $_REQUEST['confirma'];
	$jus_nusop= $_REQUEST['justifyNusop'];

	if($confirma == 1){
		$pres_nusop = 'deferido';

		if (confirmaNusop($connect, $pres_nusop, $jus_nusop, $id)){
			
			?>
				<p class="alert-success">
		    		Participação NUSOP cofirmado!
		   		</p>
		   		<p> Com justificativa: </p>
		   		<textarea style="width: 800px; height: 250px;"><?= $jus_nusop?></textarea>
		   	<?php	
			} 
	}
	if($confirma == 0){
		$pres_nusop = 'indeferido';

		if (confirmaNusop($connect, $pres_nusop, $jus_nusop, $id)){
			?>
				<p class="alert-success">Participação NUSOP Indeferido!</p>
		    	<p> JUSTIFICATIVA: </p>
		    	<textarea style="width: 800px; height: 250px;"><?= $jus_nusop?></textarea>	
		   	<?php	
			} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Nusop');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_nusop.' pelo Núcleo de Suporte Operacional (Nusop) </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}
	}	

//NUCOM
	if($setor == 'Nucom'){
		include ("menu.php");
		$confirma = $_REQUEST['confirma'];
		$jus_nucom= $_REQUEST['justifyNucom'];

		if($confirma == 1){
			$pres_nucom = 'deferido';

			if (confirmaNucom($connect, $pres_nucom, $jus_nucom, $id)){
				
				?>
					<p class="alert-success">
			    		Participação NUCOM cofirmado!
			   		</p>
			   		<p> Com justificativa: </p>
			   		<textarea style="width: 800px; height: 250px;"><?= $jus_nucom ?></textarea>
			   	<?php	
				} 
		}
		if($confirma == 0){
			$pres_nucom = 'indeferido';

			if (confirmaNucom($connect, $pres_nucom, $jus_nucom, $id)){
				?>
					<p class="alert-success">Participação NUCOM Indeferido!</p>
			    	<p> JUSTIFICATIVA: </p>
			    	<textarea style="width: 800px; height: 250px;"><?= $jus_nucom?></textarea>	
			   	<?php	
				} 
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

			$mail->setFrom(EMAIL, 'Evento Mackenzie');

			$mail->addAddress($email);     			// Add a recipient
			$mail->addCC($email_solic);
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(TRUE);				// Set email format to HTML
			$mail->CharSet  = 'utf-8';
			$mail->Subject = ('Aprovação de Evento Nucom');
			$mail->Body    = ('<p> O evento '.$evento.' código '.$id. ' foi '.$pres_nucom.' pelo Núcleo de Comunicação (Nucom) </p>
				<p>Consulte o evento através do link '.'<a href="http://172.18.0.170/Mack/page/acesso.php">'."http://172.18.0.170/Mack/page/acesso.php</a> </p>");
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


			if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$_SESSION["success"] = "Mensagem enviada com sucesso! ";
					header("Location: search-evento.php");
					die();
				}
	}
?>
