<?php
include ("head.php"); 
include ("connect.php"); 
include ("back-evento.php");

	$id_extra		=	$_POST['id_extra'];
	$dt_extra 		=	$_POST['dt_extra'];
	$inicio_extra	=	$_POST['inicio_extra'];
	$termino_extra	=	$_POST['termino_extra'];
	$local_extra	=	$_POST['local_extra'];
	$outro_extra	=	$_POST['outro_extra'];

	$button			= $_POST['button'];

	if(($button == 'upData' ) and upDataextra($connect, $dt_extra, $inicio_extra, $termino_extra, $local_extra, $outro_extra, $id_extra)){
		echo "atualizando ". $id_extra;
	}else{
		echo "Não esta atualizando ".$id_extra;
	}
