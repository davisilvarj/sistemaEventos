<?php 
include ("head.php"); 
include ("connect.php");

include ("logic-user.php"); 
include ("back-evento.php"); 


    verifyUser();
    if(userIsLog()){
        include ("menu.php");
    }
    

//*Dados Solicitante
	$nome_solicitante = $_POST["nome_solicitante"];
	$area = $_POST["area"];
	$email = $_POST["email"];
	$telefone = $_POST["telefone"];
	$drt = $_POST["drt"];

//*Dados Evento
	$nome_evento = $_POST["nome_evento"];
	$hr_complementar = $_POST["hr_complementar"];
	$atr_presenca = $_POST["atr_presenca"];
	$hr_atribuida = $_POST["hr_atribuida"];
	$quant_pessoa = $_POST["quant_pessoa"];
	$desc_evento = $_POST["desc_evento"];
	
//*Dados Data_evento
	$data_evento = $_POST["data"];
	$hr_inicio = $_POST["hr_inicio"];
	$hr_termino = $_POST["hr_termino"];

	
//*dados local evento
	$nome_local = $_POST["nome_local"];
	$outro_local = $_POST["outro_local"];

//*dados Participante
	$nome_participante = $_POST["nome_participante"];
	$nome_coord = $_POST["nome_coord"];
	
	if(array_key_exists('conf_diretor', $_POST)){
		$conf_diretor = "1";
	}else{
		$conf_diretor = "0";
	}
	if(array_key_exists('conf_coord', $_POST)){
		$conf_coord = "1";
	}else{
		$conf_coord = "0";
	}
	if(array_key_exists('conf_cap', $_POST)){
		$conf_cap = "1";
	}else{
		$conf_cap = "0";
	}

//*dados NUSOP
	$outro_oper = $_POST["outro_oper"];
	if(array_key_exists('conf_toalha', $_POST)){
		$conf_toalha = "1";
	}else{
		$conf_toalha = "0";
	}
	if(array_key_exists('conf_bandeira', $_POST)){
		$conf_bandeira = "1";
	}else{
		$conf_bandeira = "0";
	}
	if(array_key_exists('conf_pulpito', $_POST)){
		$conf_pulpito = "1";
	}else{
		$conf_pulpito = "0";
	}
	if(array_key_exists('conf_cafe', $_POST)){
		$conf_cafe = "1";
	}else{
		$conf_cafe = "0";
	}
	if(array_key_exists('conf_material', $_POST)){
		$conf_material = "1";
	}else{
		$conf_material = "0";
	}

	if($conf_toalha == 1 || $conf_bandeira == 1 || $conf_pulpito == 1 || $conf_cafe == 1 || $conf_material == 1){
		$conf_nusop = "1";
	}else{
		$conf_nusop = "0";
	}

//*dados NUTIN
	$outro_info = $_POST["outro_info"];
	if(array_key_exists('conf_projetor', $_POST)){
		$conf_projetor = "1";
	}else{
		$conf_projetor = "0";
	}
	if(array_key_exists('conf_internet', $_POST)){
		$conf_internet = "1";
	}else{
		$conf_internet = "0";
	}
	if(array_key_exists('conf_apoio', $_POST)){
		$conf_apoio = "1";
	}else{
		$conf_apoio = "0";
	}
	
	if($conf_projetor == 1 || $conf_internet == 1 || $conf_apoio == 1){
		$conf_nutin = "1";
	}else{
		$conf_nutin = "0";
	}
	
//*Dados NUCOM
	$outro_mark = $_POST["outro_mark"];
	$conf_divulgacao = $_POST["conf_divulgacao"];
	$conf_brinde = $_POST["conf_brinde"];

	if(array_key_exists('conf_mesa', $_POST)){
		$conf_mesa = "1";
	}else{
		$conf_mesa = "0";
	}
	
	
	if($conf_mesa == 1 || $conf_divulgacao != "" || $conf_brinde != "" || $conf_outro != ""){
		$conf_nucom = "1";
	}else{
		$conf_nucom = "0";
	}
//* UPLOAD
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

//*Chamando Funções
	if(inserirSolicitante($connect, $nome_solicitante, $area, $email, $telefone, $drt) and inserirEvento($connect, $nome_evento, $hr_complementar, $atr_presenca, $hr_atribuida, $quant_pessoa, $desc_evento, $fk_solicitante)  and inserirData($connect, $data_evento, $hr_inicio, $hr_termino, $fk_evento) and inserirParticipante($connect, $conf_diretor, $conf_coord, $conf_cap, $nome_coord, $nome_participante, $fk_evento) and inserirLocal($connect, $nome_local, $outro_local, $fk_evento) and inserirNusop($connect, $conf_toalha, $conf_bandeira, $conf_pulpito, $conf_cafe, $conf_material, $outro_oper, $conf_nusop, $fk_evento) and inserirNutin($connect, $conf_projetor, $conf_internet, $conf_apoio, $outro_info, $conf_nutin, $fk_evento) and inserirNucom($connect, $conf_mesa, $conf_divulgacao, $conf_brinde, $outro_mark, $conf_nucom, $fk_evento) and inserirStatusEmail($connect, $fk_evento)){
	?>	
		 <p class="alert-success">
	    	Prezado senhor(a) <?= $$nome_solicitante;?> o evento <?= $nome_evento;?> foi solicitado para <?= $data_evento;?> às <?= $hr_inicio;?> no <?= $nome_local;?>. 
	   	</p>

   	<?php 	
	} else{
		$msg = mysqli_error($connect);
	?>		
		<p class="alert-danger">
	     	<?= $nome_solicitante;?>, <?= $area;?> <?= $email;?>, <?= $telefone;?> não foi adicionado!
	   	</p>	
	   	<?php
	}

//ENVIO DA SOLICITAÇÃO (E-mail)
	$Mensagem = $_POST["sendmail"];
	
	require ("email2.php");	
			
?>
	
	