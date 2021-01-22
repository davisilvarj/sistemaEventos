<?php
include ("head.php"); 
include ("connect.php");
include ("logic-user.php"); 
include ("back-evento.php"); 

 
    verifyUser();
    $cod_evento = $_REQUEST["id"];
    $eventos = buscaEvent($connect, $cod_evento);

 if(userIsLog()){
    include ("menu.php");
        foreach ($eventos as $evento){
           $fk_solicitante = $evento['fk_solicitante'];

        $drt_solic = $evento['drt'];
        $email_solic = $evento['email'];
        $id_solic = $evento['id_solicitante'];

            $drt = userLog();
            $usuarios = buscaUser($connect, $drt);
                foreach ($usuarios as $usuario){
                    $email = $usuario['email'];
                    $nome = $usuario['nome'];
                    $setor = $usuario['setor'];
                }

 /*   $solicitantes = buscaSolicitantes($connect, $drt); //listSolicitantes($connect); 
        foreach($solicitantes as $solicitante){
            $drt_solicitante = $solicitante['drt'];
            $id_solicitante = $solicitante['id_solicitante'];
            $email_solicitante = $solicitante['email'];
        }*/
    $datas = buscaDatas($connect, $x_data);      
?>
    

<section class="container">
    <div class="row" style="opacity: .873;">                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
            <?php             
                if(($drt_solic == userLog()) and ($id_solic == $fk_solicitante)){
                ?>
                <form action="up-evento.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                    <input type="hidden" name="id_solic" value="<?= $id_solic?>">
                    <div class="card text-left">
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Solicitante</h3>
                        </div> 
                        <div class="form-row card-body">
                            <table class="table">
                                <tr>  
                                    <td><label for="inputNome">Nome: </label>
                                        <h5><?= $evento['nome_solicitante']?></h5>
                                    </td>                      
                         
                                    <td><label for="inputArea">Coordenador/Núcle/Setor: </label>
                                        <h5><?= $evento['area']?></h5>
                                    </td>
                                </tr> 
                                <tr>
                                    <td>
                                        <label for="inputEmail">E-mail:</label>
                                        <h5><?= $evento['email']?></h5>
                                    </td> 
                                    <td>
                                        <label for="inputTel">Telefone: </label>
                                        <h5><?= $evento['telefone']?></h5>
                                    </td>   
                                </tr>
                            </table> 
                        </div>       
                    </div>  

                    <div class="card-header bg-danger">
                        <h3 class="card-title">Dados Evento</h3>
                    </div>

                    <div class="form-row card-body">
                        <div class="form-group col-md-6" >
                            <label>Nome do Evento:</label>
                            <input class="form-control" type="text" name="nome_evento" value="<?=$evento['nome_evento']?>">
                        </div>
                        <div class="form-group col-md-3">    
                            <label>Horas Complementares: </label>
                            <input type="hidden" name="hr_complementar" value="<?=$evento['hr_complementar']?>">
                            <select class="form-control" name="hr_complementar" value="<?=$evento['hr_complementar']?>">
                                <option disabled selected><?=$evento['hr_complementar']?></option>
                                <option> Sim </option>
                                <option> Não </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">    
                            <label>Atribuição de Presença: </label>
                             <input type="hidden" name="atr_presenca" value="<?=$evento['atr_presenca']?>">
                            <select class="form-control" name="atr_presenca" value="<?=$evento['atr_presenca']?>">
                                <option disabled selected><?=$evento['atr_presenca']?></option> 
                                <option> Sim </option>
                                <option> Não </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="hrAtr">Quantidade de horas atribuídas:</label>
                            <input id="hrAtr" class="form-control" type="text" name="hr_atribuida" value="<?=$evento['hr_atribuida']?>"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Quantidade de pessoas:</label>
                            <input class="form-control" type="text" name="quant_pessoa" value="<?=$evento['quant_pessoa']?>"/>
                        </div>
                    </div>    

                    <div class="form-row card-body">
                        <div class="form-row col-md-12">    
                            <div class="form-group col-4">
                                <label for="data">Data:</label>
                                <input id="data" type="text" class="form-control" name="data" value="<?=$evento['data']?>" />
                            </div>
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
                            <div class="form-group col-md-4">
                                <label>Hora Início: </label>
                                <input type="hidden" name="hr_inicio" value="<?=$evento['hr_inicio']?>">
                                <select class="form-control" type="text" name="hr_inicio" value="<?=$evento['hr_inicio']?>">
                                    <option disabled selected><?=$evento['hr_inicio']?></option>
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
                            <div class="form-group col-md-4">
                                <label>Hora Termino: </label>
                                <input type="hidden" name="hr_termino" value="<?=$evento['hr_termino']?>">
                                <select class="form-control" type="text" name="hr_termino" value="<?=$evento['hr_termino']?>">
                                    <option disabled selected><?=$evento['hr_termino']?></option>
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
                            <div class="form-group col-md-6">
                                <label>Solicitação de Sala: </label>
                                <input type="hidden" name="nome_local" id="mySelect">
                                <select class="form-control" name="nome_local">
                                    <option disabled selected><?=$evento['nome_local']?></option>
                                    <option>Auditório - 9º andar | até 100 pessoas</option>
                                    <option>Auditório - 6º andar | até 300 pessoas</option>
                                    <option>Laboratório 8ª andar</option>
                                    <option>Laboratório Térreo</option>
                                    <option>Sala de Aula </option>
                                </select>
                            </div>
             
                            <div class="form-group col-md-6">    
                                <label>Sala: </label> 
                                <input class="form-control" type="text" name="outro_local" value="<?=$evento['outro_local']?>"/>
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
                        </div>
                        <div class="form-group col-md-3">
                            <label>Descrição:</label>
                            <textarea class="form-control" type="text" name="desc_evento"  style="width: 50em; height: 20em;"><?=$evento['desc_evento']?></textarea>
                        </div>
                        <!--UPLOAD-->
                        <div class="form-group col-md-10">
                            Arquivo: <input type="file" name="arquivo">  
                        </div>
                        <button type="submit" class="btn btn-primary" name="button" value="upEvento" style="float: left;">Atualizar</button>
                    </div>         
                </form>

<!--    <form action="reg-extra.php" method="post">
            <div class="card text-left">
                <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
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

                <button name="add" type="submit" class="btn btn-primary" value="atualiza">Adicionar</button>        
        </form>
        <form  action="reg-extra.php" method="post">
           
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
                            <td>
                                <button name="add" type="submit" class="btn btn-primary" style="float: left;" value="del_dt">Remover</button>
                            </td>
                        </tr>
                        <?php
                        }?>
                        
                    </table>
                </div>           
        </form> -->
                <?php    
                    }else{
                ?>
                    <h1>O evento não foi solicitado por você <?=$drt_solic?></h1>
                <?php }?>
        </div>
    </div>
</section>

<?php
    }
 }   

 include ("footer.php"); 