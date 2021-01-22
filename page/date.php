<?php 
include ("head.php");  
include ("connect.php");
include ("logic-user.php");
include ("back-evento.php");

verifyUser();
    $cod_evento = $_REQUEST["pesquisar"];
    $eventos = buscaEvent($connect, $cod_evento);

    if(userIsLog()){
       include ("menu.php"); 
    }
    
    foreach ($eventos as $evento){
        $fk_solicitante = $evento['fk_solicitante'];

        $drt_solic = $evento['drt'];
        $email_solic = $evento['email'];
        $id_solic = $evento['id_solicitante'];
        $x_data = $evento['id_data'];
    }
/*  $cod_evento = $_REQUEST['pesquisar'];

    $eventos = buscaEvent($connect, $cod_evento);*/
     
    $datas = buscaDatas($connect, $x_data); 
    //$locais = buscaLocais($connect, $fk_local);     

?>
    <div>
		<form action="reg-extra.php" method="post">
			<div class="card text-left">
                <div class="card-header bg-danger">
                    <h3 class="card-title">Datas extra para o Evento <?= $nome_evento?></h3>
                </div>    
                <div class="form-row card-body">               
                        <div class="form-group col-md-4">
                            <label>Solicitação de Sala: </label>
                            <select class="form-control" name="local_extra" id="mySelect">
                                <option disabled selected>--</option>
                                <option>Auditório - 9º andar | até 100 pessoas</option>
                                <option>Auditório - 6º andar | até 300 pessoas</option>
                                <option>Laboratório 8ª andar</option>
                                <option>Laboratório Térreo</option>
                                <option>Sala de Aula </option>
                            </select>
                        </div>
         
                        <div class="form-group col-md-2" id="inputOculto">    
                            <label>Sala: </label> 
                            <input class="form-control" type="text" name="outro_extra"/>
                        </div>
                       
                </div>    

                <div class="form-row card-body">    
                    <div class="form-row col-md-8">    
                        <div class="form-group col-5">
                            <label for="data">Data:</label>
                            <input id="data" type="text" class="form-control" name="dt_extra"/>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Hora Início: </label>
                            <select class="form-control" type="text" name="inicio_extra">
                                <option disabled selected>--</option>
                                <option>08:00</option>
                                <option>09:00</option>
                                <option>10:00</option>
                                <option>11:00</option>
                                <option>12:00</option>
                                <option>13:00</option>
                                <option>14:00</option>
                                <option>15:00</option>
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                        </div>    
                        <div class="form-group col-md-3">
                            <label>Hora Termino: </label>
                            <select class="form-control" type="text" name="termino_extra">
                                <option disabled selected>--</option>
                                <option>08:00</option>
                                <option>09:00</option>
                                <option>10:00</option>
                                <option>11:00</option>
                                <option>12:00</option>
                                <option>13:00</option>
                                <option>14:00</option>
                                <option>15:00</option>
                                <option>16:00</option>
                                <option>17:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                                <option>22:00</option>
                            </select>
                        </div>    
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $cod_evento ?>">
            <input type="hidden" name="x_data" value="<?= $x_data ?>"> 
            <button name="add" type="submit" class="btn btn-primary" value="adicionar">Adicionar</button>        
		</form>
	</div>

    <div>
        <form  action="del-extra.php" method="post">
            <div class="card text-left">
                <div class="card-header bg-danger">
                    <h3 class="card-title">Datas Inseridas</h3>
                </div>
                
                <div class="form-row card-body">
                    <table class="table table-striped table-bordered">

                        <?php foreach ($datas as $data){?>
                        <tr>
                            <input type="hidden" name="id_dt_extra" value='<?= $data['id_data_extra']?>'>
                            <td>
                                <label>Data: </label>
                                <h5><?= $data['dt_extra']?></h5>
                            </td>
                            <td>
                                <label>Inicio: </label>
                                <h5><?= $data['inicio_extra']?></h5>
                            </td>
                            <td>
                                <label>Termino: </label>
                                <h5><?= $data['termino_extra']?></h5>
                                <td>
                                        <label>Local: </label>
                                        <h5><?= $data['local_extra']?></h5>
                                    </td>
                                    <td>
                                        <label>Outro: </label>
                                        <h5><?= $data['outro_extra']?></h5>
                                    </td>
                            </td>
                            <input type="hidden" name="id" value="<?= $cod_evento ?>">
                            <input type="hidden" name="x_data" value="<?= $x_data ?>"> 
                            <td>
                                <button name="add" type="submit" class="btn btn-primary" style="float: left;" value="del_dt">Remover</button>
                            </td>
                        </tr>
                        <?php
                        }?>
                        
                    </table>
                </div>           
        </form>
    </div>                      
        <a href="usuario.php"><button type="submit" class="btn btn-primary">Finalizar</button></a>   
    </div>

     <script type="text/javascript">
        $(document).ready(function() {
        $('#inputOculto').hide();
        $('#mySelect').change(function() {
            if ($('#mySelect').val() == 'Sala de Aula') {
              $('#inputOculto').show();
            } else {
              $('#inputOculto').hide();
            }
          });
        });
    </script>  

    <script>
        $(function() {
            $("#data").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });
        });
    </script>