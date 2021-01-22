<?php
include ("connect.php"); 


	function listParticipantes($connect){
		$pesquisas = array();
		$resultPartic = mysqli_query($connect, "select * from evento e 
			join data_evento d on d.data_fk_evento = e.id_evento 
			join local_evento l on l.local_fk_evento = e.id_evento
			join solicitante s on s.id_solicitante = e.fk_solicitante
			join participante p on p.participante_fk_evento = e.id_evento 
			left join nusop ns on ns.nusop_fk_evento = e.id_evento 
			left join nucom nc on nc.nucom_fk_evento = e.id_evento 
			left join nutin nt on nt.nutin_fk_evento = e.id_evento");
		while ($pesquisa = mysqli_fetch_assoc($resultPartic)){
			array_push($pesquisas, $pesquisa);
		}
		return $pesquisas;
	}

	function buscaUsuario($connect){
		$usuario = array();
		
		$resultUsuario = mysqli_query($connect, "select * from usuario");
		
		while ($usuario = mysqli_fetch_assoc($resultUsuario)){
			array_push($usuarios, $usuario);
		}
		return $usuarios;	
	}

	$drt = 6015121;
	
	echo $drt;

    $usuarios = buscaUsuario($connect);

    $eventos = listParticipantes($connect);

	
	 foreach ($eventos as $evento){?>	
		<tr>
			<td><?= $evento['id_evento']?></td>
		</tr>
	<?php
	}		