<?php
require ("head.php");
require ("connect.php"); 
require ("back-evento.php");

	$id = $_POST['id'];
	$drt = $_POST['drt'];
	$submit = $_POST['add'];
	
	$cod_evento = $_REQUEST["id"];
    
    $eventos = buscaEvent($connect, $cod_evento);
    	
    	foreach ($eventos as $evento){
        $fk_solicitante = $evento['fk_solicitante'];
        $drt_solic = $evento['drt'];
        $email_solic = $evento['email'];
        $id_solic = $evento['id_solicitante'];
    	}

    $usuarios = buscaUser($connect, $drt);
	    foreach ($usuarios as $usuario){
	        $email = $usuario['email'];
	        $nome = $usuario['nome'];
	        $setor = $usuario['setor'];
	    }

	
	      	if(($submit == 'del') and ($drt ==  $drt_solic) and deletaEvento($connect, $id)){
			$_SESSION["success"] = "Evento ".$id." removido!";
			header("Location: list-evento.php");
			die();
			}if(($submit == 'canc') and ($drt ==  $drt_solic) and  cancelaEvento($connect, $id)){
				$_SESSION["success"] = "Evento ".$id." cancelado!";
				header("Location: list-evento.php");
				die();
			}if(($drt == 'administrator' || $drt == 'dti') and deletaEvento($connect, $id)){
				$_SESSION["success"] = "Evento ".$id." removido!";
				header("Location: list-evento.php");
				die();
			}else{
				$_SESSION["danger"] = "Esse evento ".$id." não está vinculado ao seu DRT.";
				header("Location: list-evento.php");
			}

	

	

include("footer.php");