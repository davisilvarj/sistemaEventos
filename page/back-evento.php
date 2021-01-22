<?php
	function listaEvento($connect){
		$eventos = array();
		$resultado = mysqli_query($connect, "select * from evento");
			while($evento = mysqli_fetch_assoc($resultado)){
				array_push($eventos, $evento);
			}
			return $eventos;
	}

	$eventos = listaEvento($connect);

	foreach ($eventos as $evento){
		$fk_evento 	= $evento['id_evento']+1;
	}

	function listaData($connect){
		$datas = array();
		$resultData= mysqli_query($connect, "select * from data_evento");
			while($data = mysqli_fetch_assoc($resultData)){
				array_push($datas, $data);
			}
			return $datas;
	}

	$datas = listaData($connect);

	foreach ($datas as $data){
		$fk_data =  $data['id_data'];
	}

	function listaLocal($connect){
		$locais = array();
		$resultLocal = mysqli_query($connect, "select * from local_evento");
			while($local = mysqli_fetch_assoc($resultLocal)){
				array_push($locais, $local);
			}
			return $locais;
	}

	$locais = listaLocal($connect);

	foreach ($locais as $local){
		$fk_local =  $local['id_local']+1;
	}

	function listSolicitantes($connect){
		$solicitantes = array();
		$resultSolic = mysqli_query($connect, "select * from solicitante");
		
		while ($solicitante = mysqli_fetch_assoc($resultSolic)){
			array_push($solicitantes, $solicitante);
		}
		return $solicitantes;
	}

	$solicitantes = listSolicitantes($connect);

	foreach ($solicitantes as $solicitante){
		$fk_solicitante = $solicitante['id_solicitante']+1;
	}

//INSERIR INFORMAÇÕES NO BANCO
	function inserirStatusEmail($connect, $fk_evento){
		$query = "insert into confirma_email (fk_evento) values ('{$fk_evento}')";
		return mysqli_query($connect, $query);
	}	
	function inserirSolicitante ($connect, $nome_solicitante, $area, $email, $telefone,$drt){
		$query = "insert into solicitante (nome_solicitante, area, email, telefone, drt) values ('{$nome_solicitante}','{$area}','{$email}','{$telefone}','{$drt}')";
		return mysqli_query($connect, $query);
	}

	function inserirEvento($connect, $nome_evento, $hr_complementar, $atr_presenca, $hr_atribuida, $quant_pessoa, $desc_evento, $fk_solicitante){
		$query = "insert into evento (nome_evento, hr_complementar, atr_presenca, hr_atribuida, quant_pessoa, desc_evento, fk_solicitante) values ('{$nome_evento}', '{$hr_complementar}', '{$atr_presenca}', '{$hr_atribuida}', '{$quant_pessoa}', '{$desc_evento}', '{$fk_solicitante}')";
		return mysqli_query($connect, $query);
	}
	function inserirParticipante($connect, $conf_diretor, $conf_coord, $conf_cap, $nome_coord, $nome_participante, $fk_evento){
		$query = "insert into participante (conf_diretor, conf_coord, conf_cap, nome_coord, nome_participante, participante_fk_evento) values ('{$conf_diretor}', '{$conf_coord}','{$conf_cap}','{$nome_coord}','{$nome_participante}','{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}
	function inserirData($connect, $data_evento, $hr_inicio, $hr_termino, $fk_evento){
		$query = "insert into data_evento (data, hr_inicio, hr_termino, data_fk_evento) values ('{$data_evento}','{$hr_inicio}','{$hr_termino}','{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}
	function inserirLocal($connect, $nome_local, $outro_local, $fk_evento){
		$query = "insert into local_evento (nome_local, outro_local, local_fk_evento) values ('{$nome_local}','{$outro_local}', '{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}
	function inserirNusop($connect, $conf_toalha, $conf_bandeira, $conf_pulpito, $conf_cafe, $conf_material, $outro_oper, $conf_nusop, $fk_evento){
		$query = "insert into nusop (conf_toalha, conf_bandeira, conf_pulpito, conf_cafe, conf_material, outro_oper, conf_nusop, nusop_fk_evento) values ('{$conf_toalha}','{$conf_bandeira}', '{$conf_pulpito}','{$conf_cafe}', '{$conf_material}', '{$outro_oper}', '{$conf_nusop}', '{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}
	function inserirNutin($connect, $conf_projetor, $conf_internet, $conf_apoio, $outro_info, $conf_nutin, $fk_evento){
		$query = "insert into nutin (conf_projetor, conf_internet, conf_apoio, outro_info, conf_nutin, nutin_fk_evento) values ('{$conf_projetor}','{$conf_internet}','{$conf_apoio}','{$outro_info}','{$conf_nutin}','{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}

	function inserirNucom($connect, $conf_mesa, $conf_divulgacao, $conf_brinde, $outro_mark, $conf_nucom, $fk_evento){
		$query = "insert into nucom (conf_mesa, conf_divulgacao, conf_brinde, outro_mark, conf_nucom, nucom_fk_evento) values ('{$conf_mesa}','{$conf_divulgacao}','{$conf_brinde}','{$outro_mark}','{$conf_nucom}','{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}

	function datalocalExtra($connect, $loc_extra, $out_extra, $dt_extra, $inic_extra, $term_extra, $fk_evento){
		$query = "insert into dtloc_extra (loc_extra, out_extra, dt_extra, inic_extra, term_extra, dtloc_fk_evento) values ('{$loc_extra}','{$out_extra}','{$dt_extra}','{$inic_extra}','{$term_extra}','{$fk_evento}')";
		return mysqli_query ($connect, $query);
	}

	function dataExtra($connect, $dt_extra, $inic_extra, $term_extra, $loc_extra, $out_extra, $fk_data){
		$query = "insert into extra_data (dt_extra, inicio_extra, termino_extra, local_extra, outro_extra, fk_id_data) values ('{$dt_extra}','{$inic_extra}','{$term_extra}','{$loc_extra}','{$out_extra}','{$fk_data}')";
		return mysqli_query ($connect, $query);
	}
	

	function localExtra($connect, $local_extra, $outro_extra, $fk_local){
		$query = "insert into extra_local (nome_local, outro_local, fk_id_local) values ('{$local_extra}', '{$outro_extra}', '{$fk_local}')";
		return mysqli_query ($connect, $query);
	}

	function inserirUsuario($connect, $emailUser, $senha){
		$query = "insert into admin(email, senha) values ('{$emailUser}','{$senha}')";
		return mysqli_query ($connect, $query);
	}

//BUSCA DOS DADOS
	function buscaEvent($connect, $cod_evento){
	$eventos = array();
	$resultPartic = mysqli_query($connect, "select * from evento e 
		join data_evento d on d.data_fk_evento = e.id_evento 
		join local_evento l on l.local_fk_evento = e.id_evento
		join solicitante s on s.id_solicitante = e.fk_solicitante
		join participante p on p.participante_fk_evento = e.id_evento 
		left join nusop ns on ns.nusop_fk_evento = e.id_evento 
		left join nucom nc on nc.nucom_fk_evento = e.id_evento 
		left join nutin nt on nt.nutin_fk_evento = e.id_evento
		where e.id_evento = {$cod_evento}");
	while ($evento = mysqli_fetch_assoc($resultPartic)){
		array_push($eventos, $evento);
		}
		return $eventos;	
	}

	function listEventos($connect){
	$pesquisas = array();
	$resultPartic = mysqli_query($connect, "select * from evento e
			join data_evento d on d.data_fk_evento = e.id_evento 
			join local_evento l on l.local_fk_evento = e.id_evento 
			join solicitante s on s.id_solicitante = e.fk_solicitante 
			join participante p on p.participante_fk_evento = e.id_evento 
			left join nusop ns on ns.nusop_fk_evento = e.id_evento 
			left join nucom nc on nc.nucom_fk_evento = e.id_evento 
			left join nutin nt on nt.nutin_fk_evento = e.id_evento 
			order by e.id_evento desc");
		while ($pesquisa = mysqli_fetch_assoc($resultPartic)){
			array_push($pesquisas, $pesquisa);
		}
		return $pesquisas;
	}

	function buscaAdmin($connect, $email, $senha) {
	    $query = "select * from admin where email='{$email}' and senha='{$senha}'";
	    $resultado = mysqli_query($connect, $query);
	    $admin = mysqli_fetch_assoc($resultado);
	    return $admin;
	}

	function buscaUsuario($connect){
		$usuarios = array();
		$resultPartic  = mysqli_query($connect, "select * from usuario");
		while ($usuario = mysqli_fetch_assoc($resultPartic)){
			array_push($usuarios, $usuario);
		}
		return $usuarios;	
	}

	function buscaUser($connect, $drt){
		$usuarios = array();
		$resultPartic  = mysqli_query($connect, "select * from usuario where drt = '{$drt}'");
		while ($usuario = mysqli_fetch_assoc($resultPartic)){
			array_push($usuarios, $usuario);
		}
		return $usuarios;	
	}

	function buscaSet($connect, $Mensagem){
		$usuarios = array();
		$resultPartic  = mysqli_query($connect, "select * from usuario where setor = '{$Mensagem}'");
		while ($usuario = mysqli_fetch_assoc($resultPartic)){
			array_push($usuarios, $usuario);
		}
		return $usuarios;	
	}

	function buscaDatas($connect, $x_data){
		$datas = array();
		$resultData  = mysqli_query($connect, "select * from extra_data where fk_id_data = '{$x_data}'");
		while ($data = mysqli_fetch_assoc($resultData)){
			array_push($datas, $data);
		}
		return $datas;	
	}
	
	function buscaArquivo($connect, $cod_evento){
		$arquivos = array();
		$resultArquivo  = mysqli_query($connect, "select * from arquivo where doc_fk_evento = '{$cod_evento}'");
		while ($arquivo = mysqli_fetch_assoc($resultArquivo)){
			array_push($arquivos, $arquivo);
		}
		return $arquivos;	
	}

	function buscaLocais($connect, $fk_local){
		$locais = array();
		$resultLocal  = mysqli_query($connect, "select * from extra_local where fk_id_local = '{$fk_local}'");
		while ($local = mysqli_fetch_assoc($resultLocal)){
			array_push($locais, $local);
		}
		return $locais;	
	}

	function buscaSolicitantes($connect, $drt){
		$solicitantes = array();
		$resultSolic = mysqli_query($connect, "select * from solicitante where drt = '{$drt}'");
		while ($solicitante = mysqli_fetch_assoc($resultSolic)){
			array_push($solicitantes, $solicitante);
		}
		return $solicitantes;
	}
	function buscaConfirma_email($connect, $cod_evento){
		$emails = array();
		$resultEmail = mysqli_query($connect, "select * from confirma_email where fk_evento = '{$cod_evento}'");
		while ($email = mysqli_fetch_assoc($resultEmail)){
			array_push($emails, $email);
		}
		return $emails;
	}
	function  buscaMonitora($connect, $monitora){
		$monitoras = array();
		$resultMonitora = mysqli_query($connect, "select * from usuario where setor = '{$monitora}'");
		while ($monitora = mysqli_fetch_assoc($resultMonitora)){
			array_push($monitoras, $monitora);
		}
		return $monitoras;
	}


//ATUALIZAR O BANCO PARA CONFIRMAÇÃO DOS SETORES
	//DIRETORIA
	function confirmaDiretoria($connect, $pres_diretor, $jus_diretor, $id_evento){
			$query = "update participante set pres_diretor = '{$pres_diretor}', jus_diretor ='{$jus_diretor}'
			where participante_fk_evento = '{$id_evento}'";
			return mysqli_query($connect, $query);
		}
	//CAPELANIA
	function confirmaCap($connect, $pres_cap, $jus_cap, $id_evento){
		$query = "update participante set pres_cap = '{$pres_cap}', jus_cap = '{$jus_cap}'
		where participante_fk_evento = '{$id_evento}'";
		return mysqli_query($connect, $query);
	}
	//SECCA
	function confirmaSecca($connect, $conf_secca, $jus_secca, $cod_pai, $id_evento){
		$query = "update participante set conf_secca = '{$conf_secca}', jus_secca = '{$jus_secca}', cod_pai= '{$cod_pai}'
			where participante_fk_evento = '{$id_evento}'";
			return mysqli_query($connect, $query);
	}
	//COAFI Não esta funcionando
		function confirmaCoord($connect, $pres_coord, $jus_coord, $id_evento){
			$query = "update participante set pres_coord = '{$pres_coord}', jus_coord ='{$jus_coord}'
				where participante_fk_evento = '{$id_evento}'";
				return mysqli_query($connect, $query);
		}
	//NUTIN
		function confirmaNutin($connect, $pres_nutin, $jus_nutin, $id_evento){
			$query = "update nutin set pres_nutin = '{$pres_nutin}', jus_nutin = '{$jus_nutin}'
			where nutin_fk_evento = '{$id_evento}'";
			return mysqli_query($connect, $query);
		}
	//NUSOP	
		function confirmaNusop($connect, $pres_nusop, $jus_nusop, $id_evento){
			$query = "update nusop set pres_nusop = '{$pres_nusop}', jus_nusop = '{$jus_nusop}'
			where nusop_fk_evento = '{$id_evento}'";
			return mysqli_query($connect, $query);
		}
	//NUCOM	
		function confirmaNucom($connect, $pres_nucom, $jus_nucom, $id_evento){
			$query = "update nucom set  pres_nucom = '{$pres_nucom}', jus_nucom ='{$jus_nucom}'
			where nucom_fk_evento = '{$id_evento}'";
			return mysqli_query($connect, $query);
		}
	//ATUALIZA USUARIO DE CONTROLE
		function atualizaUser($connect, $nome, $drt, $email, $setor){
			$query = "update usuario set nome = '{$nome}', drt = '{$drt}', email = '{$email}'
			where setor = '{$setor}'";
			return mysqli_query($connect, $query);
		}
	//ATUALIZA EVENTO	
		function updateEvento($connect, $nome_evento, $hr_complementar, $atr_presenca, $hr_atribuida, $quant_pessoa, $desc_evento, $id_solic){
				$query = "update evento set nome_evento = '{$nome_evento}', hr_complementar = '{$hr_complementar}', atr_presenca = '{$atr_presenca}', hr_atribuida = '{$hr_atribuida}', quant_pessoa = '{$quant_pessoa}', desc_evento ='{$desc_evento}'
					where fk_solicitante = '{$id_solic}'";
				return mysqli_query($connect, $query);	
			}
	//ATUALIZA DATAS COMPLEMENTARES		  
		function upData($connect, $data, $hr_inicio, $hr_termino, $id){
			$query = "update data_evento set data = '{$data}', hr_inicio = '{$hr_inicio}', hr_termino = '{$hr_termino}' where data_fk_evento = '{$id}'";
				return mysqli_query($connect, $query);
		}
	//ATUALIZA LOCAIS COMPLEMENTARES	
		function upLocal($connect, $nome_local, $outro_local, $id){
			$query = "update local_evento set nome_local = '{$nome_local}', outro_local = '{$outro_local}'
				where local_fk_evento = '{$id}'";
				return mysqli_query($connect, $query);
		}
	//ATUALIZA DATAS COMPLEMENTARES	
		function upDataextra($connect, $dt_extra, $inicio_extra, $termino_extra, $local_extra, $outro_extra, $id_dt_extra){
			$query = "update extra_data set dt_extra = '{$dt_extra}', inicio_extra = '{$inicio_extra}', termino_extra = '{$termino_extra}', local_extra = '{$local_extra}', outro_extra = '{$outro_extra}' where id_data_extra = '{$id_extra}'";
				return mysqli_query($connect, $query);
		}

	//ATUALIZA STATUS DE ENVIO DE EMAIL
		function envioDiretor($connect, $direcao, $id){
			$query = "update confirma_email set direcao = '{$direcao}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);	
		}

		function envioAdmin($connect, $admin, $id){
			$query = "update confirma_email set coafi = '{$admin}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);	
		}
		function envioCap($connect, $cap, $id){
			$query = "update confirma_email set capelania = '{$cap}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);
		}
		function envioSecca($connect, $secretaria, $id){
			$query = "update confirma_email set secca = '{$secretaria}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);
		}
		function envioNutin($connect, $nutin, $id){
			$query = "update confirma_email set nutin= '{$nutin}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);
		}
		function envioNucom($connect, $nucom, $id){
			$query = "update confirma_email set nucom= '{$nucom}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);
		}
		function envioNusop($connect, $nusop, $id){
			$query = "update confirma_email set nusop= '{$nusop}' where fk_evento = '{$id}'";
			return mysqli_query($connect, $query);
		}

//DELETANDO 
	function delData($connect, $id_dt_extra){
		$query = "delete from extra_data where id_data_extra = '{$id_dt_extra}'";
    	return mysqli_query($connect, $query);
	}

	function delLocal($connect, $id_loc_extra){
		$query = "delete from extra_local where id_local_extra = '{$id_loc_extra}'";
    	return mysqli_query($connect, $query);
	}

	function deletaEvento($connect, $id){
		$query = "delete from evento where 		
					id_evento = '{$id}'";
    	return mysqli_query($connect, $query);
	}
//CANCELA EVENTO
	function cancelaEvento($connect, $id){
		$query = "update evento set status = 'cancelado' where 		
					id_evento = '{$id}'";
    	return mysqli_query($connect, $query);
	}
//DEFERIR EVENTO
	function deferirEvento($connect, $status, $id){
		$query = "update evento set status = '{$status}' where 		
			id_evento = '{$id}'";
    	return mysqli_query($connect, $query);
	}

//
	function contEvento($connect){	
		$resultLocal = mysqli_query($connect, "select * from evento");
		$num_rows = mysqli_num_rows($resultLocal);
		return $num_rows;
	}

	function contDeferido($connect){	
		$resultLocal = mysqli_query($connect, "select * from evento 
			where status = 'deferido'");
		$num_rows = mysqli_num_rows($resultLocal);
		return $num_rows;
	}
	function contIndeferido($connect){	
		$resultLocal = mysqli_query($connect, "select * from evento 
			where status = 'indeferido'");
		$num_rows = mysqli_num_rows($resultLocal);
		return $num_rows;
	}
	function contCancelado($connect){	
		$resultLocal = mysqli_query($connect, "select * from evento 
			where status = 'cancelado'");
		$num_rows = mysqli_num_rows($resultLocal);
		return $num_rows;
	}
?>

