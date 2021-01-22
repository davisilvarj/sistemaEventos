<?php
include ("head.php"); 
include ("connect.php"); 
include ("back-evento.php");

	$id= $_POST['id'];
	$x_data = $_POST['x_data'];

	$loc_extra = $_POST['local_extra'];
	$out_extra = $_POST['outro_extra'];

	$dt_extra = $_POST['dt_extra'];
	$inic_extra = $_POST['inicio_extra'];
	$term_extra = $_POST['termino_extra'];

	$id_dt_extra = $_POST['id_dt_extra'];
	$id_loc_extra = $_POST['id_loc_extra'];

	$submit = $_POST['add'];

	if(($submit == 'adicionar') and dataExtra($connect, $dt_extra, $inic_extra, $term_extra, $loc_extra, $out_extra, $x_data)){
		$_SESSION["success"] = "Dados adicionados.";

		header("Location: date.php?pesquisar=$id");
	}

	if(($submit == 'del_dt') and delData($connect, $id_dt_extra)){
		$_SESSION["success"] = "Dados deletados.";
		header("Location: date.php?pesquisar=$id");
		die();
		
	}else{
		$msg = mysqli_error($connect);
		echo $msg;
		}
	
?>


	
