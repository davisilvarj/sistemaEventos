<?php 
include ("head.php"); 
include ("connect.php"); 
include ("logic-user.php");

verifyUser();

 if(userIsLog()){
        include ("menu.php");
    }
?> 


<section class="container">
    <div class="row" style="opacity: .873;">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">        
            <form action="reg-evento.php" method="post" enctype="multipart/form-data">
                <div class="card text-left">
                    <input type="hidden" name="drt" value="<?= userLog()?>">
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Dados Solicitante</h3>
                        </div>    
                        <div class="form-row card-body">
                            <div class="form-group col-md-6">    
                                <label for="inputNome">Nome: </label>
                                <input id="inputNome" class="form-control" type="text" name="nome_solicitante">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputArea">Coordenador/Núcleo/Setor: </label>
                                <input id="inputArea" class="form-control"  type="text" name="area">
                            </div>
                             <div class="form-group col-md-6"> 
                                <label for="inputEmail">E-mail:</label>
                                <input id="inputEmail" class="form-control" type="e-mail" name="email" />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="inputTel">Telefone:</label>
                                <input id="inputTel" class="form-control" type="text" name="telefone" />
                            </div>    
                        </div>
                </div>    
                    
                <div class="card text-left">
                    <div class="card-header bg-danger">
                        <h3 class="card-title">Dados do Evento</h3>
                    </div>    
                    <div class="form-row card-body">
                            <div class="form-group col-md-6">
                                <label>Nome do Evento:</label>
                                <input class="form-control" type="text" name="nome_evento">
                            </div>
                            <div class="form-group col-md-3">    
                                <label>Horas Complementares: </label>
                                <select class="form-control" name="hr_complementar">
                                    <option disabled selected>--</option>
                                    <option> Sim </option>
                                    <option> Não </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">    
                                <label>Atribuição de Presença: </label>
                                <select class="form-control" name="atr_presenca">
                                    <option disabled selected>--</option>
                                    <option> Sim </option>
                                    <option> Não </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="hrAtr">Quantidade de horas atribuídas:</label>
                                <input id="hrAtr" class="form-control" type="text" name="hr_atribuida" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Quantidade de pessoas:</label>
                                <input class="form-control" type="text" name="quant_pessoa"/>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Solicitação de Sala: </label>
                                <select class="form-control" name="nome_local" id="mySelect">
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
                                <input class="form-control" type="text" name="outro_local"/>
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

                    <div class="form-row card-body">    
                        <div id="origem" class="form-row col-md-8">    
                            <div class="form-group col-5">
                                <label for="data">Data:</label>
                                <input id="data" type="text" class="form-control" name="data"/>
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
                            <div class="form-group col-md-3">
                                <label>Hora Início: </label>
                                <select class="form-control" type="text" name="hr_inicio">
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
                                <select class="form-control" type="text" name="hr_termino">
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

                        <!-- <div class="form-group col-md-4"> 
                            <img  src="../img/add_red.png" style="margin-top: 1em; width: 3em; height: 3em; cursor: pointer;" onclick="duplicarCampos();" title="Adicionar Datas">
                            <img  src="../img/cross_red.png" style="margin-top: 1em; width: 3em; height: 3em; cursor: pointer;" onclick="removerCampos(this);" title="Remover Datas">        
                        </div>

                        <script type="text/javascript">
                                    function duplicarCampos(){
                                        var clone = document.getElementById('origem').cloneNode(true);
                                        var destino = document.getElementById('destino');
                                        destino.appendChild (clone);
                                        var camposClonados = clone.getElementsByTagName('input');
                                    
                                        for(i=0; i<camposClonados.length;i++){
                                            camposClonados[i].value = '';
                                        }
                                    }
                                    
                                    function removerCampos(id){
                                         var node1 = document.getElementById('destino');
                                         node1.removeChild(node1.childNodes[0]);
                                    }
                        </script>
                    </div>
                    <div id="destino" class="form-row card-body">
                    </div> -->

                    <div class="form-row card-body">
                        <div class="form-group col-md-10">
                            <label>Descrição do Evento:</label>
                            <textarea class="form-control" type="text" name="desc_evento" style="width: 50em; height: 20em;"></textarea>
                        </div>
                        <!--UPLOAD-->
                        <div class="form-group col-md-10">
                            Arquivo: <input type="file" name="arquivo">  
                        </div>
                    </div>            
                </div>    
                   
                <div class="card text-left" >
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Participantes</h3>
                        </div>    
                        <div class="form-row card-body" style="text-align: justify;">
                            <div class="form-group col-md-12" style="padding-left: 2em">             
                                <input class="form-check-input" type="checkbox" name="conf_diretor" value="true"> Diretor</br>
                                <input class="form-check-input" type="checkbox" name="conf_coord" value="true"> Coordenador de Curso</br>
                                <input class="form-control col-12" type="text" name="nome_coord"/>
                                <input class="form-check-input" type="checkbox" name="conf_cap" value="true"> Capelania</br> 
                                <div class="form-group">
                                    <label class="col-md-6">Outros (Professores, Núcleo de Novos Alunos e etc): </label>
                                    <input class="form-control col-md-12" type="text" name="nome_participante"/>
                                </div>
                            </div>                           
                        </div>
                </div>

            

                    <div class="card text-left">
                        <div class="card-header bg-danger">
                            <h3 class="card-title">NUSOP - Núcleo de Suporte Operacional</h3>
                        </div>
                        <div class="form-row card-body"  style="text-align: justify;">
                            <div class="form-group col-md-6" style="padding-left: 2em">
                                <input class="form-check-input" type="checkbox" name="conf_toalha" value="true"> Toalhas</br>
                                <input class="form-check-input" type="checkbox" name="conf_bandeira" value="true"> Bandeiras</br>
                                <input class="form-check-input" type="checkbox" name="conf_pulpito" value="true"> Púlpito</br>
                                <input class="form-check-input" type="checkbox" name="conf_cafe" value="true"> Café</br>
                                <input class="form-check-input" type="checkbox" name="conf_material" value="true"> Material para consumo (água, copos descartáveis, papel toalha)</br>
                                <label class="col-md-6">Outros: </label>
                                <input class="form-control col-12" type="text" name="outro_oper"/>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="card text-left">
                       <div class="card-header bg-danger">
                            <h3 class="card-title">NUTIN - Núcleo de Tecnologia da Informação </h3>
                        </div>
                        <div class="form-row card-body" style="text-align: justify;">
                            <div class="form-group col-md-6" style="padding-left: 2em">
                                <input class="form-check-input" type="checkbox" name="conf_projetor" value="true"> Projetor + tela de projeção</br>
                                <input class="form-check-input" type="checkbox" name="conf_internet" value="true"> Internet + usuário provisório</br>
                                <input class="form-check-input" type="checkbox" name="conf_apoio" value="true"> Apoio Técnico</br>                  
                                <label class="col-md-6">Outros:</label>
                                <input class="form-control col-12" type="text" name="outro_info"/>
                            </div>
                        </div>
                    </div>
                    <div class="card text-left">
                       <div class="card-header bg-danger">
                            <h3 class="card-title">NUCOM - Núcleo de Comunicação e Marketing</h3>
                        </div>
                        <div class="form-row card-body" style="text-align: justify;">
                            <div class="form-group col-md-6" style="padding-left: 2em">
                                <input class="form-check-input" type="checkbox" name="conf_mesa" value="true"> Mesa de som + microfone</br>                    
                                <label class="col-md-12">Divulgação (especifique: mídias indoors, site, redes sociais): </label>
                                <input class="form-control col-12" type="text" name="conf_divulgacao"/>
                                <label class="col-md-12">Brinde (especifique: canetas, botons, camisas e etc): </label>
                                <input class="form-control col-12" type="text" name="conf_brinde"/>                  
                                <label class="col-md-10">Outros: </label>
                                <input class="form-control col-12" type="text" name="outro_mark"/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="sendmail"  value="Monitoramento" class="btn btn-primary" style="float: right;">Solicitar</button>        
            </form>
        </div>
    </div>        
   
   

</section>

<?php 
include ("footer.php");