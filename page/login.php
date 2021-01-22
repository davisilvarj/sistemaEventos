<?php 
include ("connect.php"); 
//include ("back-evento.php");
include ("logic-user.php");
include ("back-evento.php");

/*$email = $_POST["email"];
$senha = $_POST["senha"];

$admin = buscaAdmin($connect, $email, $senha);

	if($admin == null) {
		$_SESSION["danger"] = "Usuário ou senha inválido.";
		header("Location: acesso.php");
		die();
		} else {
			$_SESSION["success"] = "Usuário logado com sucesso.";
			logUser($admin["email"]);
			header("Location: usuario.php");
			
			// if($admin["id"] < 6){
		 //  		header("Location: admin.php");
		 //  	}else{
		 //  		header("Location: usuario.php");
		 //  	}	
		}
die();*/


	$drt = $_POST['drt'];

	$eventos = buscaUser($connect, $drt);

		foreach ($eventos as $evento){
			$email = $evento['email'];
			$nome = $evento['nome'];
			$setor = $evento['setor'];
		}

	$ldap_dn =  $_POST['drt'].'@exemplo.br';
	
	$ldap_password = $_POST["senha"];
	
	$ldap_con = ldap_connect("ldap://exemplo.br");
	
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	if($ldap_password == null){
		$_SESSION["danger"] = "Insira uma Senha Válida.";
		header("Location: acesso.php");
	}else{	
		if (@ldap_bind($ldap_con, $ldap_dn, $ldap_password)){
			
			$_SESSION["success"] = "Usuário logado com sucesso.".$nome;
			logUser($drt);
			header("Location: usuario.php");
		}else{
			$_SESSION["danger"] = "Usuário ou senha inválido.";
			header("Location: acesso.php");
			die();
		}
	}



