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
        foreach ($eventos as $evento){
        $fk_solicitante = $evento['fk_solicitante'];

        $drt_solic = $evento['drt'];
        $email_solic = $evento['email'];
        $id_solic = $evento['id_solicitante'];
        $x_data = $evento['id_data'];
        
            $drt = userLog();
            $usuarios = buscaUser($connect, $drt);
                foreach ($usuarios as $usuario){
                    $email = $usuario['email'];
                    $nome = $usuario['nome'];
                    $setor = $usuario['setor'];
                }
        
   $solicitantes = listSolicitantes($connect); 
        foreach($solicitantes as $solicitante){
            $drt_solicitante = $solicitante['drt'];
            $id_solicitante = $solicitante['id_solicitante'];
        }

 /*   $solicitantes = buscaSolicitantes($connect, $drt); //listSolicitantes($connect); 
        foreach($solicitantes as $solicitante){
            $drt_solicitante = $solicitante['drt'];
            $id_solicitante = $solicitante['id_solicitante'];
            $email_solicitante = $solicitante['email'];
        }*/
    $arquivos = buscaArquivo($connect, $cod_evento);
    $datas = buscaDatas($connect, $x_data); 

   $emails = buscaConfirma_email($connect, $cod_evento); 
        foreach ($emails as $email) {
            $direcao    =   $email['direcao'];
            $coafi = $email['coafi'];
            $capelania = $email['capelania'];
            $secca = $email['secca'];
            $nutin = $email['nutin'];
            $nusop = $email['nusop'];
            $nucom = $email['nucom'];
        }

    $monitora = 'Monitoramento';        
    $monitoras = buscaMonitora($connect, $monitora);
        foreach ($monitoras as $monitora) {
                $nome_monitora = $monitora['nome'];
            }         
?>
    

<section class="container">
    <div class="row" style="opacity: .873;">                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
            <?php
                switch($setor){
                case 'Monitoramento':?>
                <!--ACESSO MONITORAMENTO-->
                <form action="email.php" method="post">
                    <input type="hidden" name="id" value="<?=$evento['id_evento']?>">

                    <div class="card-header bg-dark">
                        <h3 class="card-title text-info">Monitoramento de Evento</h3>
                    </div> 
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
                        <table class="table">
                           <tr> 
                                <td>
                                    <label>Nome do Evento: </label>
                                    <h5><?= $evento['nome_evento']?></h5>
                                </td>    
                            </tr>
                            
                            <tr> 
                                <td>
                                    <label>Data: </label>
                                    <h5><?= $evento['data']?></h5>
                                </td>
                                <td>
                                    <label>Hora Início: </label>
                                    <h5><?= $evento['hr_inicio']?></h5>
                                </td>
                                <td >
                                    <label>Hora Término: </label>
                                    <h5><?= $evento['hr_termino']?></h5>
                                </td>
                            </tr>
                        
                            <tr> 
                                <td>
                                    <label>Local do evento: </label>
                                    <h5><?= $evento['nome_local']?></h5>
                                </td>
                                <td>
                                    <label>Outro: </label>
                                    <h5><?= $evento['outro_local']?></h5>
                                </td>
                            </tr>

                             <?php foreach($datas as $data):?>
                                <tr> 
                                    <td>
                                        <label>Data: </label>
                                        <h5><?= $data['dt_extra']?></h5>
                                    </td>
                                    <td>
                                        <label>Hora Início: </label>
                                        <h5><?= $data['inicio_extra'] ?></h5>
                                    </td>
                                    <td >
                                        <label>Hora Término: </label>
                                        <h5><?= $data['termino_extra'] ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                <tr> 
                                    <td>
                                        <label>Local do evento: </label>
                                        <h5><?= $data['local_extra'] ?></h5>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                            <tr>
                                <td>
                                    <label>Quantidade de Pessoas: </label>
                                    <h5><?= $evento['quant_pessoa']?></h5>
                                </td> 
                                <td>
                                    <label>Quantidade de horas atribuídas: </label>
                                    <h5><?= $evento['hr_atribuida']?></h5>
                                </td>
                                <td>
                                    <label>Horas Complementares: </label>
                                    <h5><?= $evento['hr_complementar']?></h5>
                                </td>
                                <td>
                                    <label>Atribuição de Presença: </label>
                                    <h5><?= $evento['atr_presenca']?></h5>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <label>Descrição do Evento:</label>
                                    <h5><?= $evento['desc_evento']?></h5> 
                                </td>
                            </tr>
                            <?php foreach($arquivos as $arquivo):?>
                                <tr>
                                    <td>
                                        <label>Arquivo:</label>
                                        <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>    
                    </div> 
                    <div class="card-header bg-danger">
                        <h3 class="card-title">Material Solicitado: </h3>
                    </div>
                    <!--Nutin-->
                        <div class="form-row card-body">
                            <h3 class="card-title">Nutin: </h3>
                            <table class="table">
                                <?php 
                                    if ($evento['conf_projetor'] == 1){
                                    $evento['conf_projetor'] = 'Projetor e Tela';
                                ?>  
                                    <tr>
                                        <td>      
                                            <h5><?= $evento['conf_projetor']?></h5> 
                                        </td>    
                                    </tr>
                                <?php        
                                    }
                                ?>
                                <?php 
                                    if ($evento['conf_internet'] == 1){
                                    $evento['conf_internet'] = 'Internet';
                                ?>  
                                    <tr> 
                                        <td>     
                                            <h5><?= $evento['conf_internet']?></h5> 
                                        </td>
                                    </tr>
                                <?php        
                                    }
                                ?>
                                 <?php 
                                    if ($evento['conf_apoio'] == 1){
                                    $evento['conf_apoio'] = 'Apoio Tecnico';
                                ?>  
                                    <tr>
                                        <td>      
                                            <h5><?= $evento['conf_apoio']?></h5> 
                                        </td>
                                    </tr>
                                <?php        
                                    }
                                    if ($evento['conf_outro'] != null){
                                ?>  
                                <tr> 
                                    <td>     
                                        <h5><?= $evento['conf_outro']?></h5> 
                                    </td>    
                                </tr>
                                <?php        
                                    }
                                ?>
                            </table>    
                        </div> 
                    <!--Nusop-->
                        <div class="form-row card-body">
                            <h3 class="card-title">Nusop: </h3>
                            <table class="table">
                            <?php 
                                if ($evento['conf_toalha'] == 1){
                                $evento['conf_toalha'] = 'Toalhas';
                            ?>  
                                <tr>
                                    <td>      
                                        <h5><?= $evento['conf_toalha']?></h5> 
                                    </td>    
                                </tr>
                            <?php        
                                }
                                if ($evento['conf_bandeira'] == 1){
                                $evento['conf_bandeira'] = 'Bandeiras';
                            ?>  
                                <tr>
                                    <td>      
                                        <h5><?= $evento['conf_bandeira']?></h5> 
                                    </td>    
                                </tr>
                            <?php        
                                }
                                if ($evento['conf_pulpito'] == 1){
                                $evento['conf_pulpito'] = 'Púlpito';
                            ?>  
                                <tr>
                                    <td>      
                                        <h5><?= $evento['conf_pulpito']?></h5> 
                                    </td>    
                                </tr>
                            <?php        
                                }
                                if ($evento['conf_material'] == 1){
                                $evento['conf_material'] = 'Material para consumo (água, copos descartáveis, papel toalha)';
                            ?>
                                <tr>
                                    <td>      
                                        <h5><?= $evento['conf_material']?></h5> 
                                    </td>    
                                </tr>
                            <?php        
                                }
                               if ($evento['conf_cafe'] == 1){
                                $evento['conf_cafe'] = 'Café';
                            ?>
                                <tr>
                                    <td>      
                                        <h5><?= $evento['conf_cafe']?></h5> 
                                    </td>    
                                </tr>
                            <?php        
                                }
                                 if ($evento['outro_oper'] != null){
                            ?>
                                <tr> 
                                    <td>     
                                        <h5><?= $evento['outro_oper']?></h5> 
                                    </td>    
                                </tr>
                            <?php
                                }
                            ?>        
                            </table>    
                        </div>
                    <!--Nucom-->
                        <div class="form-row card-body">
                            <h3 class="card-title">Nucom: </h3>
                            <table class="table">
                                 <?php 
                                    if ($evento['conf_mesa'] == 1){
                                    $evento['conf_mesa'] = 'Mesa de Som';
                                ?>  
                                    <tr>
                                        <td>      
                                            <h5><?= $evento['conf_mesa']?></h5> 
                                        </td>    
                                    </tr>
                                <?php        
                                    }
                                    if ($evento['conf_divulgacao'] != null){          
                                ?>                                   
                                    <tr> 
                                        <td>     
                                            <h5><?= $evento['conf_divulgacao']?></h5> 
                                        </td>    
                                    </tr>
                                 
                                <?php        
                                    }
                                    if ($evento['conf_brinde'] != null){
                                ?>
                                    <tr>    
                                        <td>     
                                            <h5><?= $evento['conf_brinde']?></h5> 
                                        </td>    
                                    </tr>
                                <?php        
                                    }
                                     if ($evento['outro_mark'] != null){
                                ?>    
                                 <tr> 
                                    <td>     
                                        <h5><?= $evento['outro_mark']?></h5> 
                                    </td>    
                                </tr>
                                <?php
                                    }
                                ?>    
                            </table>    
                        </div>            

                    <div class="card-header bg-danger">
                        <h3 class="card-title">Participantes: </h3>
                    </div>   
                    <div class="form-row card-body">
                        <table class="table">
                            <?php 
                                $evento['conf_diretor'] = 'Direção Geral';
                                 if ($evento['pres_diretor'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_diretor']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_diretor'] == 'deferido'){
                            ?>
                                <tr> 
                                    <td>  
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_diretor']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_diretor']?></p>
                                        </article>                                                        
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_diretor'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_diretor']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_diretor']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                                
                            ?>

                            <?php        
                                
                                $evento['conf_coord'] = 'COAFI';
                                if ($evento['pres_coord'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_coord']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_coord'] == 'deferido'){
                            ?>
                                    <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_coord']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_coord']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_coord'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_coord']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_coord']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                            
                            ?>
       
                            <?php         
                           
                                $evento['conf_cap'] = 'Capelania';
                                if ($evento['pres_cap'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_cap']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_cap'] == 'deferido'){
                            ?>
                                    <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_cap']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_cap'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_cap']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                           
                            //SECCA 
                                $secca = 'Secretaria Acadêmica';
                                if ($evento['conf_secca'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'><?= $secca?></h5>
                                        </td>
                                    </tr>
                                <?php        
                                }
                                    if ($evento['conf_secca'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'><?= $secca ?></h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_secca']?></p>
                                                </article> 
                                            </td>
                                        </tr>     
                                    <?php
                                    }
                                        if ($evento['conf_secca'] == 'indeferido'){?>
                                            <tr> 
                                                <td>       
                                                   <article>
                                                        <h5 class='alert alert-success'><?= $secca ?></h5>
                                                        <h3>Justificativa: </h3><p><?= $evento['jus_secca']?></p>
                                                    </article> 
                                                </td>
                                            </tr>     
                                        <?php    
                                        }  
                                //NUSOP
                                    if ($evento['conf_nusop'] == 1){
                                       $setor_nusop = 'NUSOP - Núcleo de Suporte Operacional';
                                    if ($evento['pres_nusop'] == 'pendente'){?>
                                        <tr> 
                                            <td>       
                                                <h5 class='alert alert-warning'><?=  $setor_nusop ?></h5>
                                            </td>
                                        </tr>
                                    <?php        
                                        }
                                            if ($evento['pres_nusop'] == 'deferido'){?>
                                                <tr> 
                                                    <td>       
                                                        <article>
                                                            <h5 class='alert alert-success'><?=  $setor_nusop ?></h5>
                                                            <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                        </article> 
                                                    </td>
                                                </tr>     
                                            <?php
                                            }
                                                if ($evento['pres_nusop'] == 'indeferido'){?>
                                                    <tr> 
                                                        <td>       
                                                            <article>
                                                                <h5 class='alert alert-success'><?= $setor_nusop ?></h5>
                                                                <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                            </article> 
                                                        </td>
                                                    </tr>     
                                            <?php    
                                                }
                                             }   
                                //NUTIN
                                if ($evento['conf_nutin'] == 1){
                                     $setor_nutin = 'NUTIN - Núcleo de Tecnologia da Informação';
                                if ($evento['pres_nutin'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'><?= $setor_nutin  ?></h5>
                                        </td>
                                    </tr>
                                <?php        
                                }
                                    if ($evento['pres_nutin'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'><?= $setor_nutin  ?></h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nutin']?></p>
                                                </article>  
                                            </td>
                                        </tr>     
                                    <?php
                                    }
                                        if ($evento['pres_nutin'] == 'indeferido'){?>
                                             <tr> 
                                                <td>       
                                                    <h5 class='alert alert-danger'><?= $setor_nutin  ?></h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nutin']?></p>
                                                </td>
                                            </tr>     
                                        <?php    
                                            }
                                         } 
                                //NUCOM
                                if ($evento['conf_nucom'] == 1){
                                    $nucom = 'NUCOM - Núcleo de Comunicação e Marketing';
                                    if ($evento['pres_nucom'] == 'pendente'){?>
                                        <tr> 
                                            <td>       
                                                <h5 class='alert alert-warning'><?= $nucom ?></h5>
                                            </td>
                                        </tr>
                                    <?php        
                                        }
                                        if ($evento['pres_nucom'] == 'deferido'){?>
                                            <tr> 
                                                <td>       
                                                    <article>
                                                        <h5 class='alert alert-success'><?= $nucom ?></h5>
                                                        <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                    </article> 
                                                </td>
                                            </tr>     
                                        <?php
                                            }
                                            if ($evento['pres_nucom'] == 'indeferido'){?>
                                                <tr> 
                                                    <td>       
                                                        <article>
                                                            <h5 class='alert alert-success'><?= $nucom ?></h5>
                                                            <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                        </article> 
                                                    </td>
                                                </tr>     
                                            <?php    
                                                }
                                }       
                                ?>   
                        </table>
                    </div>           
                    <div>
                        <button type="submit" name="sendmail" class="btn btn-primary"  value="Direcao"> Direção Geral </button>
                        <?php 
                            if($evento['pres_diretor'] == 'deferido'){
                        ?> 
                            <button type="submit" name="sendmail" class="btn btn-primary"  value="Coafi" id="coafi"> COAFI </button>
                        <?php 
                            }
                        ?> 
                        <?php 
                            if($evento['pres_coord'] == 'deferido'){
                        ?> 
                           <button type="submit" name="sendmail" class="btn btn-primary"  value="Capelania" id="capelania"> Capelania </button> 
                        <?php 
                            }
                        ?>  
                        <?php 
                            if($evento['pres_cap'] == 'deferido'){
                        ?>   
                            <button type="submit" name="sendmail" class="btn btn-primary"  value="Secca"> Secretaria </button>
                        <?php 
                            }
                        ?>
                        <?php 
                            if($evento['conf_secca'] == 'deferido'){
                        ?>
                     </div>   
                        <div style="margin-top: .2em;">  
                            <?php  if($evento['conf_nutin'] == 1){?>
                                <button type="submit" name="sendmail" class="btn btn-primary"  value="Nutin"> NUTIN </button>
                            <?php  } if($evento['conf_nucom'] == 1 ){?>
                                <button type="submit" name="sendmail" class="btn btn-primary"  value="Nucom"> NUCOM </button>
                            <?php } if ($evento['conf_nusop'] = 1 ){?>
                                 <button type="submit" name="sendmail" class="btn btn-primary"  value="Nusop"> NUSOP </button>
                             <?php } ?>
                        </div>    
                    <?php 
                        }
                    ?>  
                </form> 
                <?php
                break;
                case 'Direcao':?>
                <!--ACESSO DIREÇÃO-->
                <form action="confirmaNutin.php" method="post">
                    <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                    <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                        <div class="card-header bg-dark">
                            <h3 class="card-title text-info">Direção Geral</h3>
                        </div> 
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
                            <table class="table">
                               <tr> 
                                    <td><h6>Nome do Evento: </h6>
                                        <h4><?= $evento['nome_evento']?></h4>
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <label>Data: </label>
                                        <h5><?= $evento['data']?></h5>
                                    </td>
                                    <td>
                                        <label>Hora Início: </label>
                                        <h5><?= $evento['hr_inicio']?></h5>
                                    </td>
                                    <td >
                                        <label>Hora Término: </label>
                                        <h5><?= $evento['hr_termino']?></h5>
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <label>Local do evento: </label>
                                        <h5><?= $evento['nome_local']?></h5>
                                    </td>
                                    <td>
                                        <label>Outro: </label>
                                        <h5><?= $evento['outro_local']?></h5>
                                    </td>
                                </tr>

                                <?php foreach($datas as $data):?>
                                    <tr> 
                                        <td>
                                            <label>Data: </label>
                                            <h5><?= $data['dt_extra']?></h5>
                                        </td>
                                        <td>
                                            <label>Hora Início: </label>
                                            <h5><?= $data['inicio_extra'] ?></h5>
                                        </td>
                                        <td >
                                            <label>Hora Término: </label>
                                            <h5><?= $data['termino_extra'] ?></h5>
                                        </td>
                                    </tr>
                                  
                                    <tr> 
                                        <td>
                                            <label>Local do evento: </label>
                                            <h5><?= $data['local_extra'] ?></h5></td>    
                                    </tr>
                                <?php endforeach ?>

                                
                                <tr> 
                                    <td>
                                        <label>Quantidade de Pessoas: </label>
                                        <h5><?= $evento['quant_pessoa']?></h5>
                                    </td>
                                    <td>
                                        <label>Horas Complementares: </label>
                                        <h5><?= $evento['hr_complementar']?></h5>
                                    </td>
                                    <td>
                                        <label>Atribuição de Presença: </label>
                                        <h5><?= $evento['atr_presenca']?></h5>
                                    </td>
                                    <td>
                                        <label>Quantidade de horas atribuídas: </label>
                                        <h5><?= $evento['hr_atribuida']?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Descrição do Evento:</label>
                                        <h5><?= $evento['desc_evento']?></h5> 
                                    </td>
                                </tr>
                                <?php foreach($arquivos as $arquivo):?>
                                    <tr>
                                        <td>
                                            <label>Arquivo:</label>
                                            <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>

                        </div>            
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Justificativa:</h3>
                        </div>  
                        <div class="form-row card-body">
                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_diretor"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="confirma" value="1">
                            Deferido
                        </button>
                        <button type="submit" class="btn btn-primary" name="confirma" value="0">
                            Indeferido
                        </button> 
                    </div>     
                </form>    
                <?php
                break;
                case 'Coafi':?>
                <!--ACESSO COAFI-->
                    <?php if($coafi == 'enviado'){?> 
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-info">Coordenação Acadêmica e Financeira (COAFI)</h3>
                                </div> 
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
                                    <table class="table">
                                                                      <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>

                                        
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Descrição do Evento:</label>
                                                <h5><?= $evento['desc_evento']?></h5> 
                                            </td>
                                        </tr>
                                        <?php foreach($arquivos as $arquivo):?>
                                            <tr>
                                                <td>
                                                    <label>Arquivo:</label>
                                                    <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table> 
                                   
                                </div>


                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Justificativa:</h3>
                                </div>  
                                <div class="form-row card-body">
                                    <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_coord"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                    Deferido
                                </button>
                                <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                    Indeferido
                                </button> 
                            </div>
                        </form>
                    <?php } else {?>

                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Aguardando aprovação do Diretor Geral</h1>
                            <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                          </div>
                        </div>
                    <?php }
                break;
                case 'Capelania':?>
                <!--ACESSO CAPELANIA-->
                    <?php if($capelania == 'enviado'){?> 
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-info">Capelania</h3>
                                </div> 
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
                                    <table class="table">
                                        <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>

                                        
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <label>Descrição do Evento:</label>
                                                <h5><?= $evento['desc_evento']?></h5> 
                                            </td>
                                        </tr>
                                        <?php foreach($arquivos as $arquivo):?>
                                            <tr>
                                                <td>
                                                    <label>Arquivo:</label>
                                                    <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>    
                                </div>
                                <?php
                                    $evento['conf_cap'] = 'Capelania';
                                        if ($evento['pres_cap'] == 'pendente'){
                                    ?>
                                        <tr> 
                                            <td>       
                                                <h5 class='alert alert-warning'>Pendente</h5>
                                            </td>
                                        </tr>
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_cap"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                            Deferido
                                        </button>
                                        <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                            Indeferido
                                        </button> 
                                    <?php        
                                        }
                                        if ($evento['pres_cap'] == 'deferido'){
                                    ?>
                                            <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'>Deferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                                </article> 
                                            </td>
                                        </tr>
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_cap"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                            Indeferido
                                        </button>      
                                    <?php
                                        }
                                        if ($evento['pres_cap'] == 'indeferido'){
                                    ?>
                                         <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-danger'>Indeferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                                </article> 
                                            </td>
                                        </tr> 
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_cap"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                            Deferido
                                        </button>
                                    <?php    
                                        }
                                ?>                       
                               
                            </div>     
                        </form>
                    <?php } else {?>
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Aguardando aprovação do COAFI</h1>
                            <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                          </div>
                        </div>
                     <?php }
                break;
                case 'Secca':?>
                <!--ACESSO SECCA-->
                    <?php if($secca == 'enviado'){?> 
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                            <div class="card-header bg-dark">
                                <h3 class="card-title text-info">Secretaria Acadêmica (SECCA)</h3>
                            </div> 
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
                                <table class="table">
                                        <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>

                                        
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            <label>Descrição do Evento:</label>
                                            <h5><?= $evento['desc_evento']?></h5> 
                                        </td>
                                    </tr>
                                    <?php foreach($arquivos as $arquivo):?>
                                        <tr>
                                            <td>
                                                <label>Arquivo:</label>
                                                <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>    
                            </div>            
                            <div class="card-header bg-danger">
                                <h3 class="card-title">Justificativa:</h3>
                            </div>  
                            <div class="form-row card-body">
                                <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_secca"></textarea>
                            </div>
                            <div class="card-header bg-danger">
                                <h3 class="card-title">Código Pai: </h3>
                            </div> 
                            <div class="form-row card-body">
                                <input id="inputCodpai" class="form-control" type="text" name="codpai" />
                            </div>

                            <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                Deferido
                            </button>
                            <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                Indeferido
                            </button>    
                        </form>
                            <?php if(($drt_solic == userLog()) and ($id_solic == $fk_solicitante)){
                            ?>
                               <form action="update-evento.php" method="post">
                                    <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                                    <button type="submit" class="btn btn-primary" >Editar Evento</button> 
                                </form>  
                           <?php 
                           }
                       } else {?>
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Aguardando aprovação da Direção Geral</h1>
                            <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                          </div>
                        </div>
                    <?php }
                break;
                case 'Nutin':?>
                <!--ACESSO NUTIN-->
                    <?php if($nutin == 'enviado'){?> 
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-info">Núcleo de Tecnologia da Informação (Nutin)</h3>
                                </div> 
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
                                    <table class="table">
                                        <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>                             
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <label>Descrição do Evento:</label>
                                                <h5><?= $evento['desc_evento']?></h5> 
                                            </td>
                                        </tr>
                                        <?php foreach($arquivos as $arquivo):?>
                                            <tr>
                                                <td>
                                                    <label>Arquivo:</label>
                                                    <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>    
                                </div>
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Código Pai</h3>
                                </div>   
                                <div class="form-row card-body">
                                    <table class="table">
                                         <tr> 
                                            <td>     
                                                <h5><?= $evento['cod_pai']?></h5> 
                                            </td>    
                                        </tr>
                                    </table>
                                </div> 
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Material Solicitado</h3>
                                </div>   
                                <div class="form-row card-body">
                                    <table class="table">
                                         <?php 
                                                if ($evento['conf_projetor'] == 1){
                                                    $evento['conf_projetor'] = 'Projetor e Tela';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_projetor']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                        <?php 
                                                if ($evento['conf_internet'] == 1){
                                                    $evento['conf_internet'] = 'Internet';
                                        ?>  
                                            <tr> 
                                                <td>     
                                                    <h5><?= $evento['conf_internet']?></h5> 
                                                </td>
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                         <?php 
                                                if ($evento['conf_apoio'] == 1){
                                                    $evento['conf_apoio'] = 'Apoio Tecnico';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_apoio']?></h5> 
                                                </td>
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                          
                                        <tr> 
                                            <td>     
                                                <h5><?= $evento['conf_outro']?></h5> 
                                            </td>    
                                        </tr>
                                        
                                    </table>    
                                </div>

                                <?php
                                    if ($evento['conf_nusop'] == 1){
                                        $evento['conf_nusop'] = 'NUSOP - Núcleo de Suporte Operacional';
                                        if ($evento['pres_nusop'] == 'pendente'){?>
                                            <tr> 
                                                <td>       
                                                    <h5 class='alert alert-warning'><?= $evento['conf_nusop']?></h5>
                                                </td>
                                            </tr>
                                        <?php        
                                        }
                                            if ($evento['pres_nusop'] == 'deferido'){?>
                                                <tr> 
                                                    <td>       
                                                        <article>
                                                            <h5 class='alert alert-success'><?= $evento['conf_nusop']?></h5>
                                                            <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                        </article> 
                                                    </td>
                                                </tr>     
                                            <?php
                                            }
                                                if ($evento['pres_nusop'] == 'indeferido'){?>
                                                    <tr> 
                                                        <td>       
                                                            <article>
                                                                <h5 class='alert alert-success'><?= $evento['conf_nusop']?></h5>
                                                                <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                            </article> 
                                                        </td>
                                                    </tr>     
                                                <?php    
                                                }
                                    }?>
                                    
                                <?php
                                    if ($evento['pres_nutin'] == 'pendente'){
                                    ?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'>Pendente</h5>
                                        </td>
                                    </tr>
                                     <div class="card-header bg-danger">
                                        <h3 class="card-title">Justificativa:</h3>
                                    </div> 

                                    <div class="form-row card-body">
                                        <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nutin"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                        Deferido
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                        Indeferido
                                    </button> 
                                    <?php        
                                    }
                                    if ($evento['pres_nutin'] == 'deferido'){
                                    ?>
                                    <tr> 
                                        <td>       
                                            <article>
                                                <h5 class='alert alert-success'>Deferido</h5>
                                                <h3>Justificativa: </h3><p><?= $evento['jus_nutin']?></p>
                                            </article> 
                                        </td>
                                    </tr>
                                    <div class="card-header bg-danger">
                                        <h3 class="card-title">Justificativa:</h3>
                                    </div>  
                                    <div class="form-row card-body">
                                        <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nutin"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                        Indeferido
                                    </button>      
                                    <?php
                                    }
                                    if ($evento['pres_nutin'] == 'indeferido'){
                                    ?>
                                     <tr> 
                                        <td>       
                                            <article>
                                                <h5 class='alert alert-danger'>Indeferido</h5>
                                                <h3>Justificativa: </h3><p><?= $evento['jus_nutin']?></p>
                                            </article> 
                                        </td>
                                    </tr> 
                                     <div class="card-header bg-danger">
                                        <h3 class="card-title">Justificativa:</h3>
                                    </div>  
                                    <div class="form-row card-body">
                                        <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nutin"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                        Deferido
                                    </button>
                                <?php    
                                    }
                                ?>                           
                            </div>     
                        </form>
                    <?php } else {?>
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Aguardando aprovação da SECCA</h1>
                            <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                          </div>
                        </div>
                    <?php }
                break;
                case 'Nucom':?>
                <!--ACESSO NUCOM-->

                    <?php if($nucom == 'enviado'){?>
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                            <div class="card-header bg-dark">
                                <h3 class="card-title text-info">Núcleo de Comunicação (Nucom)</h3>
                            </div> 
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
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
                                    <table class="table">
                                        <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>

                                        
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <label>Descrição do Evento:</label>
                                                <h5><?= $evento['desc_evento']?></h5> 
                                            </td>
                                        </tr>
                                        <?php foreach($arquivos as $arquivo):?>
                                            <tr>
                                                <td>
                                                    <label>Arquivo:</label>
                                                    <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>    
                                </div>
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Material Solicitado</h3>
                                </div>   
                                <div class="form-row card-body">
                                    <table class="table">
                                         <?php 
                                                if ($evento['conf_mesa'] == 1){
                                                    $evento['conf_mesa'] = 'Mesa de Som';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_mesa']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>                                  
                                        <tr> 
                                            <td>     
                                                <h5><?= $evento['conf_divulgacao']?></h5> 
                                            </td>    
                                        </tr>
                                         <tr> 
                                            <td>     
                                                <h5><?= $evento['conf_brinde']?></h5> 
                                            </td>    
                                        </tr>
                                         <tr> 
                                            <td>     
                                                <h5><?= $evento['outro_mark']?></h5> 
                                            </td>    
                                        </tr>
                                    </table>    
                                </div>

                                <?php if ($evento['pres_nucom'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'>Pendente</h5>
                                        </td>
                                    </tr>
                                     <div class="card-header bg-danger">
                                        <h3 class="card-title">Justificativa:</h3>
                                    </div>  
                                    <div class="form-row card-body">
                                        <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nucom"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                        Deferido
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                        Indeferido
                                    </button> 

                                    <?php } if ($evento['pres_nucom'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'>Deferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                </article> 
                                            </td>
                                        </tr>
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nucom"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                            Indeferido
                                        </button> 

                                    <?php } if ($evento['pres_nucom'] == 'indeferido'){?>
                                         <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-danger'>Indeferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                </article> 
                                            </td>
                                        </tr> 
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nucom"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                            Deferido
                                        </button>
                                    <?php } ?>                    
                            </div>     
                        </form>
                    <?php } if($evento['conf_nucom'] == 0 ){?>
                                <div class="jumbotron jumbotron-fluid">
                                  <div class="container">
                                    <h5 class="display-6">Não foi solicitado para esse evento participação ou apoio do Núcleo de Comunicação e Marketing</h5>
                                    <p class="lead">.</p>
                                  </div>
                                </div> 
                        <?php } if(($nucom != 'enviado') and ($evento['conf_nucom'] == 1 )){?>
                            <div class="jumbotron jumbotron-fluid">
                              <div class="container">
                                <h1 class="display-4">Aguardando aprovação da SECCA</h1>
                                <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                              </div>
                            </div>
                    <?php }
                break;
                case 'Nusop':?>
                <!--ACESSO NUSOP-->
                    <?php if($nusop == 'enviado'){?>
                        <form action="confirmaNutin.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
                            <input type="hidden" name="email_solicitante" value="<?= $email_solic ?>">
                            <div class="card-header bg-dark">
                                <h3 class="card-title text-info">Núcleo de Suporte Operacional (Nusop)</h3>
                            </div> 
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
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
                                    <table class="table">
                                        <tr> 
                                            <td><h6>Nome do Evento: </h6>
                                                <h4><?= $evento['nome_evento']?></h4>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Data: </label>
                                                <h5><?= $evento['data']?></h5>
                                            </td>
                                            <td>
                                                <label>Hora Início: </label>
                                                <h5><?= $evento['hr_inicio']?></h5>
                                            </td>
                                            <td >
                                                <label>Hora Término: </label>
                                                <h5><?= $evento['hr_termino']?></h5>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>
                                                <label>Local do evento: </label>
                                                <h5><?= $evento['nome_local']?></h5>
                                            </td>
                                            <td>
                                                <label>Outro: </label>
                                                <h5><?= $evento['outro_local']?></h5>
                                            </td>
                                        </tr>

                                        <?php foreach($datas as $data):?>
                                            <tr> 
                                                <td>
                                                    <label>Data: </label>
                                                    <h5><?= $data['dt_extra']?></h5>
                                                </td>
                                                <td>
                                                    <label>Hora Início: </label>
                                                    <h5><?= $data['inicio_extra'] ?></h5>
                                                </td>
                                                <td >
                                                    <label>Hora Término: </label>
                                                    <h5><?= $data['termino_extra'] ?></h5>
                                                </td>
                                            </tr>
                                          
                                            <tr> 
                                                <td>
                                                    <label>Local do evento: </label>
                                                    <h5><?= $data['local_extra'] ?></h5></td>    
                                            </tr>
                                        <?php endforeach ?>

                                        
                                        <tr> 
                                            <td>
                                                <label>Quantidade de Pessoas: </label>
                                                <h5><?= $evento['quant_pessoa']?></h5>
                                            </td>
                                            <td>
                                                <label>Horas Complementares: </label>
                                                <h5><?= $evento['hr_complementar']?></h5>
                                            </td>
                                            <td>
                                                <label>Atribuição de Presença: </label>
                                                <h5><?= $evento['atr_presenca']?></h5>
                                            </td>
                                            <td>
                                                <label>Quantidade de horas atribuídas: </label>
                                                <h5><?= $evento['hr_atribuida']?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <label>Descrição do Evento:</label>
                                                <h5><?= $evento['desc_evento']?></h5> 
                                            </td>
                                        </tr>
                                    </table>    
                                </div>
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Material Solicitado</h3>
                                </div>   
                                <div class="form-row card-body">
                                    <table class="table">
                                         <?php 
                                                if ($evento['conf_toalha'] == 1){
                                                    $evento['conf_toalha'] = 'Toalhas';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_toalha']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                        <?php 
                                            if ($evento['conf_bandeira'] == 1){
                                                $evento['conf_bandeira'] = 'Bandeiras';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_bandeira']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                        <?php 
                                            if ($evento['conf_pulpito'] == 1){
                                                $evento['conf_pulpito'] = 'Púlpito';
                                        ?>  
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_pulpito']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                        <?php 
                                            if ($evento['conf_material'] == 1){
                                                $evento['conf_material'] = 'Material para consumo (água, copos descartáveis, papel toalha)';
                                        ?>
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_material']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                        <?php 
                                            if ($evento['conf_cafe'] == 1){
                                                $evento['conf_cafe'] = 'Café';
                                        ?>
                                            <tr>
                                                <td>      
                                                    <h5><?= $evento['conf_cafe']?></h5> 
                                                </td>    
                                            </tr>
                                        <?php        
                                            }
                                        ?>

                                        <tr> 
                                            <td>     
                                                <h5><?= $evento['outro_oper']?></h5> 
                                            </td>    
                                        </tr>
                                        <?php foreach($arquivos as $arquivo):?>
                                            <tr>
                                                <td>
                                                    <label>Arquivo:</label>
                                                    <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>    
                                </div>
                                <?php if ($evento['pres_nusop'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'>Pendente</h5>
                                        </td>
                                    </tr>
                                     <div class="card-header bg-danger">
                                        <h3 class="card-title">Justificativa:</h3>
                                    </div>  
                                    <div class="form-row card-body">
                                        <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nusop"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                        Deferido
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                        Indeferido
                                    </button> 

                                    <?php } if ($evento['pres_nusop'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'>Deferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                </article> 
                                            </td>
                                        </tr>
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nusop"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                            Indeferido
                                        </button> 
                                             
                                    <?php } if ($evento['pres_nusop'] == 'indeferido'){?>
                                         <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-danger'>Indeferido</h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                </article> 
                                            </td>
                                        </tr> 
                                         <div class="card-header bg-danger">
                                            <h3 class="card-title">Justificativa:</h3>
                                        </div>  
                                        <div class="form-row card-body">
                                            <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="jus_nusop"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                            Deferido
                                        </button>
                                    <?php } ?>                                      
                                <div class="card-header bg-danger">
                                    <h3 class="card-title">Justificativa:</h3>
                                </div>  
                                <div class="form-row card-body">
                                    <textarea style="width: 800px; height: 300px; margin: 0 8em;" name="justifyNusop"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="confirma" value="1">
                                    Deferido
                                </button>
                                <button type="submit" class="btn btn-primary" name="confirma" value="0">
                                    Indeferido
                                </button> 
                            </div>     
                        </form>
                    <?php } else {?>
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Aguardando aprovação da SECCA</h1>
                            <p class="lead">Será encaminhado por e-mail a liberação para acesso a esse evento, pela monitora <?php echo $nome_monitora ?> responsável do sistema.</p>
                          </div>
                        </div>
                    <?php }
                break;
                default:?>
                <!--ACESSO COMUM -->
                    <?php
                        if(($drt_solic == userLog()) and ($id_solic == $fk_solicitante)){
                    ?>
                        <form action="update-evento.php" method="post">
                            <input type="hidden" name="id" value="<?=$evento['id_evento']?>">
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
                                <table class="table">
                                   <tr> 
                                        <td><h6>Nome do Evento: </h6></td>
                                        <td><h4><?= $evento['nome_evento']?></h4></td>
                                    </tr>
                                    <tr> 
                                        <td>
                                            <label>Data: </label>
                                            <h5><?= $evento['data']?></h5>
                                        </td>
                                        <td>
                                            <label>Hora Início: </label>
                                            <h5><?= $evento['hr_inicio']?></h5>
                                        </td>
                                        <td >
                                            <label>Hora Término: </label>
                                            <h5><?= $evento['hr_termino']?></h5>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td><label>Local do evento: </label></td>
                                        <td><h5><?= $evento['nome_local']?></h5></td>    
                                    </tr>


                                    <?php foreach($datas as $data){
                                        if($evento['id_data'] == $data['fk_id_data']){
                                    ?>

                                    <tr> 
                                        <td>
                                            <label>Data: </label>
                                            <h5><?= $data['dt_extra']?></h5>
                                        </td>
                                        <td>
                                            <label>Hora Início: </label>
                                            <h5><?= $data['inicio_extra'] ?></h5>
                                        </td>
                                        <td >
                                            <label>Hora Término: </label>
                                            <h5><?= $data['termino_extra'] ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr> 
                                        <td><label>Local do evento: </label></td>
                                        <td><h5><?= $data['local_extra'] ?></h5></td>    
                                    </tr>
                                    <?php  }
                                            } ?>    

                                        <td>
                                            <label>Quantidade de Pessoas: </label>
                                            <h5><?= $evento['quant_pessoa']?></h5>
                                        </td> 
                                        <td>
                                            <label>Horas Complementares: </label>
                                            <h5><?= $evento['hr_complementar']?></h5>
                                        </td>
                                        <td>
                                            <label>Atribuição de Presença: </label>
                                            <h5><?= $evento['atr_presenca']?></h5>
                                        </td>
                                        <td>
                                            <label>Quantidade de horas atribuídas: </label>
                                            <h5><?= $evento['hr_atribuida']?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Descrição do Evento:</label>
                                            <h5><?= $evento['desc_evento']?></h5> 
                                        </td>
                                    </tr>
                             
                                 <?php foreach($arquivos as $arquivo):?>
                                    <tr>
                                        <td>
                                            <label>Arquivo:</label>
                                            <a href="download.php?file=<?=$arquivo['nome']?>"><h5><?= $arquivo['nome']?></h5></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>    
                                <button type="submit" class="btn btn-primary" >Editar Evento</button>  
                            </div>           
                        </form>
                        <table class="table">
                            <?php 
                                $evento['conf_diretor'] = 'Direção Geral';
                                 if ($evento['pres_diretor'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_diretor']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_diretor'] == 'deferido'){
                            ?>
                                <tr> 
                                    <td>  
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_diretor']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_diretor']?></p>
                                        </article>                                                        
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_diretor'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_diretor']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_diretor']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                                
                            ?>

                            <?php        
                                
                                $evento['conf_coord'] = 'COAFI';
                                if ($evento['pres_coord'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_coord']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_coord'] == 'deferido'){
                            ?>
                                    <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_coord']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_coord']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_coord'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_coord']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_coord']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                            
                            ?>
       
                            <?php         
                           
                                $evento['conf_cap'] = 'Capelania';
                                if ($evento['pres_cap'] == 'pendente'){
                            ?>
                                <tr> 
                                    <td>       
                                        <h5 class='alert alert-warning'><?= $evento['conf_cap']?></h5>
                                    </td>
                                </tr>
                            <?php        
                                }
                                if ($evento['pres_cap'] == 'deferido'){
                            ?>
                                    <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_cap']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php
                                }
                                if ($evento['pres_cap'] == 'indeferido'){
                            ?>
                                 <tr> 
                                    <td>       
                                        <article>
                                            <h5 class='alert alert-success'><?= $evento['conf_cap']?></h5>
                                            <h3>Justificativa: </h3><p><?= $evento['jus_cap']?></p>
                                        </article> 
                                    </td>
                                </tr>     
                            <?php    
                                }
                           
                            //SECCA 
                                $secca = 'Secretaria Acadêmica';
                                if ($evento['conf_secca'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'><?= $secca?></h5>
                                        </td>
                                    </tr>
                                <?php        
                                }
                                    if ($evento['conf_secca'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'><?= $secca ?></h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_secca']?></p>
                                                </article> 
                                            </td>
                                        </tr>     
                                    <?php
                                    }
                                        if ($evento['conf_secca'] == 'indeferido'){?>
                                            <tr> 
                                                <td>       
                                                   <article>
                                                        <h5 class='alert alert-success'><?= $secca ?></h5>
                                                        <h3>Justificativa: </h3><p><?= $evento['jus_secca']?></p>
                                                    </article> 
                                                </td>
                                            </tr>     
                                        <?php    
                                        }  
                                //NUSOP
                                    if ($evento['conf_nusop'] == 1){
                                        $evento['conf_nusop'] = 'NUSOP - Núcleo de Suporte Operacional';
                                    if ($evento['pres_nusop'] == 'pendente'){?>
                                        <tr> 
                                            <td>       
                                                <h5 class='alert alert-warning'><?= $evento['conf_nusop']?></h5>
                                            </td>
                                        </tr>
                                    <?php        
                                        }
                                            if ($evento['pres_nusop'] == 'deferido'){?>
                                                <tr> 
                                                    <td>       
                                                        <article>
                                                            <h5 class='alert alert-success'><?= $evento['conf_nusop']?></h5>
                                                            <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                        </article> 
                                                    </td>
                                                </tr>     
                                            <?php
                                            }
                                                if ($evento['pres_nusop'] == 'indeferido'){?>
                                                    <tr> 
                                                        <td>       
                                                            <article>
                                                                <h5 class='alert alert-success'><?= $evento['conf_nusop']?></h5>
                                                                <h3>Justificativa: </h3><p><?= $evento['jus_nusop']?></p>
                                                            </article> 
                                                        </td>
                                                    </tr>     
                                            <?php    
                                                }
                                             }   
                                //NUTIN
                                if ($evento['conf_nutin'] == 1){
                                    $evento['conf_nutin'] = 'NUTIN - Núcleo de Tecnologia da Informação';
                                if ($evento['pres_nutin'] == 'pendente'){?>
                                    <tr> 
                                        <td>       
                                            <h5 class='alert alert-warning'><?= $evento['conf_nutin']?></h5>
                                        </td>
                                    </tr>
                                <?php        
                                }
                                    if ($evento['pres_nutin'] == 'deferido'){?>
                                        <tr> 
                                            <td>       
                                                <article>
                                                    <h5 class='alert alert-success'><?= $evento['conf_nutin']?></h5>
                                                    <h3>Justificativa: </h3><p><?= $evento['jus_nutin']?></p>
                                                </article>  
                                            </td>
                                        </tr>     
                                    <?php
                                    }
                                        if ($evento['pres_nutin'] == 'indeferido'){?>
                                             <tr> 
                                                <td>       
                                                    <h5 class='alert alert-danger'><?= $evento['conf_nutin']?></h5>
                                                </td>
                                            </tr>     
                                        <?php    
                                            }
                                         } 
                                //NUCOM
                                if ($evento['conf_nucom'] == 1){
                                    $nucom = 'NUCOM - Núcleo de Comunicação e Marketing';
                                    if ($evento['pres_nucom'] == 'pendente'){?>
                                        <tr> 
                                            <td>       
                                                <h5 class='alert alert-warning'><?= $nucom ?></h5>
                                            </td>
                                        </tr>
                                    <?php        
                                        }
                                        if ($evento['pres_nucom'] == 'deferido'){?>
                                            <tr> 
                                                <td>       
                                                    <article>
                                                        <h5 class='alert alert-success'><?= $nucom ?></h5>
                                                        <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                    </article> 
                                                </td>
                                            </tr>     
                                        <?php
                                            }
                                            if ($evento['pres_nucom'] == 'indeferido'){?>
                                                <tr> 
                                                    <td>       
                                                        <article>
                                                            <h5 class='alert alert-success'><?= $nucom ?></h5>
                                                            <h3>Justificativa: </h3><p><?= $evento['jus_nucom']?></p>
                                                        </article> 
                                                    </td>
                                                </tr>     
                                            <?php    
                                                }
                                }       
                                ?>   
                        </table>   
                    <?php    
                        }else{?>
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4"></h1>
                            <p class="lead">Evento não está vinculado ao seu DRT.</p>
                          </div>
                        </div>
                    <?php }
                break;
                } ?> 

        </div>
    </div>
</section>

<?php
    }
 }   

 include ("footer.php"); 