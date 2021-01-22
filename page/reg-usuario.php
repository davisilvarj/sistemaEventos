<?php 
include ("head.php"); 
include ("connect.php"); 
include ("back-evento.php");


//*Dados USUARIO
	$nome = $_POST['nome'];
	$drt = $_POST['drt'];
	$email = $_POST['email'];
	$setor = $_POST['setor'];

if ($setor == 'Direção'){
	$setor = 'Direcao';
	$_SESSION["success"] = "Atualizado o cadastro do usuário.".$nome. ", para o setor: " .$setor;
	atualizaUser($connect, $nome, $drt, $email, $setor);
	header("Location: usuario.php");
} else {
	if(atualizaUser($connect, $nome, $drt, $email, $setor)){
		
		$_SESSION["success"] = "Atualizado o cadastro do usuário.".$nome. ", para o setor: " .$setor;
		header("Location: usuario.php");
	?>		
		<h5 class='alert alert-success'>
    		Atualizado!
   		</h5>
   			
   	<?php 	
	} else{
		$msg = mysqli_error($connect);
	?>		
		<p class="alert-danger">
	     	<?= $nome_solicitante;?>, <?= $area;?> <?= $email;?>, <?= $telefone;?> não foi adicionado!
	   	</p>	
	   	<?php
	}
}	



