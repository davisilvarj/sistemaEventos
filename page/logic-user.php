<?php
session_start();

function userIsLog(){
	return isset($_SESSION["usuario_logado"]);
}

function verifyUser(){
	if(!userIsLog()){
		$_SESSION ["danger"] = "Você não tem acesso a esta funcionalidade";
		header("Location: acesso.php");
	}
}

function userLog(){
	return $_SESSION["usuario_logado"];
}

function logUser($drt){
	$_SESSION["usuario_logado"] = $drt;
}

function logout(){
	session_destroy();
	session_start();
}



