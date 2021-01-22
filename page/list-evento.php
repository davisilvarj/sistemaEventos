<?php 
include ("head.php"); 
include ("connect.php");
include ("back-evento.php");
include ("logic-user.php");

verifyUser();

 if(userIsLog()){
       include ("menu.php");
}
	/*$eventos = listEvento($connect);
    $solicitantes = listSolicitantes($connect);*/
  $eventos = listEventos($connect);
  $drt = userLog();
  $usuarios = buscaUser($connect, $drt);
      foreach ($usuarios as $usuario){
          $email = $usuario['email'];
          $nome = $usuario['nome'];
          $setor = $usuario['setor'];
      }
?>

<section class="container"> 
      <table class="table  table-striped table-bordered col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-left:-15em;">
       	<tr style="text-align: center; font-size: 1em">
       		<td>Codigo Evento</td>
          <td>Status</td>
          <td>Solicitante</td>
       		<td>Nome Evento</td>
          <td>Descrição</td>
          <td>Local</td>
          <td>Data</td>
          <td>Inicio</td>
          <td>Fim</td>
          <td>Quantidade Pessoa</td>
          <td>Hora Atribuida</td>
          <td>Hora Complementar</td>
          <td>Atribuição de Presença</td>
          <?php if(($setor=='Direcao')||($setor=='Capelania')||($setor=='Secca')||($setor=='Coafi')
                ||($setor=='Nutin')||($setor=='Nucom')||($setor=='Nusop')){?>
            <td><a href="report-evento.php" target="_blank" title="Relatório Eventos">Relatorio Eventos</a></td>
          <?php
            }else{}?>
              <td></td>    
          </tr>
       	</tr> 	
<?php
      foreach ($eventos as $evento){?>	
       	<tr>
          <input type="hidden" name="pesquisar" value="<?=$evento['id_evento']?>" />
       		<td><a href="find-evento.php?pesquisar=<?=$evento['id_evento']?>"><?= $evento['id_evento'] ?></a></td> 
          <td><?=$evento['status']?></td>     
          <td><?= $evento['nome_solicitante'] ?></td>       
       		<td><?= $evento['nome_evento'] ?></td>
          <td><?= $evento['desc_evento'] ?></td>
          <td><?= $evento['nome_local'] ?></td>
          <td><?= $evento['data'] ?></td>
          <td><?= $evento['hr_inicio'] ?></td>
          <td><?= $evento['hr_termino'] ?></td>
        	<td><?= $evento['quant_pessoa'] ?></td>
          <td><?= $evento['hr_atribuida'] ?></td>
        	<td><?= $evento['hr_complementar'] ?></td>
        	<td><?= $evento['atr_presenca'] ?></td>

          <td>
             <form action="del-evento.php" method="post">
                <input type="hidden" name="drt" value="<?= userLog()?>">
                <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                <button name="add" type="submit"  value="canc">Cancelar</button>
                <!-- <button name="add" type="submit"  value="del">Remover</button> -->
             </form>
              <!--<a href="del-evento.php?id=<?=$evento['id_evento']?>" class="text-danger">Remover</a> -->
          </td>
       	</tr>     
<?php
}?>
       </table>
</section>

<?php
include("footer.php");