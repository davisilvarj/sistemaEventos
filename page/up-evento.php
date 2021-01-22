<?php
include ("head.php"); 
include ("connect.php"); 
include ("back-evento.php");


//*Dados USUARIO
	$id 			= 	$_POST['id'];
	$id_solic		= 	$_POST['id_solic'];
	$nome_evento 	= 	$_POST['nome_evento'];
	$hr_complementar= 	$_POST['hr_complementar'];
	$atr_presenca 	= 	$_POST['atr_presenca'];
	$hr_atribuida 	= 	$_POST['hr_atribuida'];
	$quant_pessoa	=	$_POST['quant_pessoa'];
	$data			=	$_POST['data'];
	$hr_inicio		=	$_POST['hr_inicio'];
	$hr_termino		=	$_POST['hr_termino'];
	$nome_local		=	$_POST['nome_local'];
	$outro_local	=	$_POST['outro_local'];
	$desc_evento	=	$_POST['desc_evento'];	

	$id_extra		=	$_POST['id_extra'];
	$dt_extra 		=	$_POST['dt_extra'];
	$inicio_extra	=	$_POST['inicio_extra'];
	$termino_extra	=	$_POST['termino_extra'];
	$local_extra	=	$_POST['local_extra'];
	$outro_extra	=	$_POST['outro_extra'];

	$button			= $_POST['button'];
	
	if(isset($_FILES['arquivo'])){

		$nome = $_FILES['arquivo']['name'];

		$point = substr($nome, -4,1);

		if($point == '.'){
			$extencao = strtolower(substr($nome, -4));
		}else{
			$extencao = strtolower(substr($nome, -5));
		}
		$novo_nome = md5(time()).$extencao;

		$local = 'upload/';

		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $local.$nome)){
			$img = mysqli_query($connect,"INSERT INTO arquivo (nome, doc, doc_fk_evento) values ('{$nome}','{$novo_nome}', '{$id}')");
			
		}else{
			echo "Algum erro ocorreu";
		}
	}

	if(($button == 'upEvento' ) and updateEvento($connect, $nome_evento, $hr_complementar, $atr_presenca, $hr_atribuida, $quant_pessoa, $desc_evento, $id_solic) and
		upData($connect, $data, $hr_inicio, $hr_termino, $id) and
		upLocal($connect, $nome_local, $outro_local, $id)){	
			$_SESSION["success"] = "Atualizado o cadastro do usuário.".$id." ".$id_dt_extra;?>
			<input type="hidden" name="pesquisar" value="<?=$evento['id_evento']?>" />
			<?php header("Location: date.php?pesquisar=$id");
	}
	

	if(($button == 'upData' ) and upDataextra($connect, $dt_extra, $inicio_extra, $termino_extra, $local_extra, $outro_extra, $id_extra)){
		echo "atualizando ". $id_extra;

	}else{
		echo "Não esta atualizando ".$id_extra;
	}

//*Upload
	if(isset($_FILES['arquivo'])){

		$nome = $_FILES['arquivo']['name'];

		$point = substr($nome, -4,1);

		if($point == '.'){
			$extencao = strtolower(substr($nome, -4));
		}else{
			$extencao = strtolower(substr($nome, -5));
		}
		$novo_nome = md5(time()).$extencao;

		$local = 'upload/';

		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $local.$novo_nome)){
			$img = mysqli_query($connect,"INSERT INTO arquivo (doc,fk_doc_evento) values ('$novo_nome', '$fk_evento')");
			
		}else{
			echo "Algum erro ocorreu";
		}
	}

