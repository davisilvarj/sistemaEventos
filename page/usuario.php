<?php 
include ("head.php");  
include ("connect.php");
include ("logic-user.php");
include ("back-evento.php");

verifyUser();
// $participantes = listParticipantes($connect); 
 
    if(userIsLog()){
       include ("menu.php"); 
    }    

    $usuarios = buscaUsuario($connect);

    
        if(userlog() == 'administrator'){
        
            foreach ($usuarios as $usuario){?> 
            	<section class="container">
            	    <div class="row" style="opacity: .873;">                
            	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
            	        	<form action="reg-usuario.php" method="post">
            	                <div class="card text-left">
                                    <div class="card-header bg-danger">
                                        <input type="hidden" name="setor" value="<?= utf8_encode($usuario['setor']) ?>">
                                    	<h3 class="card-title"><?= utf8_encode($usuario['setor'])?></h3>
                                    </div>    
                                        <div class="form-row card-body">
                                            <div class="form-group col-md-10">    
                                                <label for="inputNome">Nome: </label>
                                                <input id="inputNome" class="form-control" type="text" name="nome" value='<?= $usuario['nome']?>'>
                                                <label for="inputNome">DRT: </label>
                                                <input id="inputNome" class="form-control" type="text" name="drt" value='<?= $usuario['drt']?>'>
                                                <label for="inputArea">E-mail </label>
                                                <input id="inputArea" class="form-control"  type="text" name="email" value='<?= $usuario['email'] ?>'>
                                            </div>
                                            <div class="form-group col-md-6"> 
                                                <button type="submit" class="btn btn-primary" style="float: left;">Atualizar</button>
                                            </div>
                                        </div>    
                                    </div>
            	                </div>
            	            </form>    	    
            	        </div>
            	    </div>
            	</section>
            <?php
            }
        }   

               	