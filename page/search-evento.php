<?php 
include ("head.php"); 
include ("connect.php");
include ("logic-user.php");

verifyUser();
// $participantes = listParticipantes($connect); 
 
 if(userIsLog()){
       include ("menu.php");
    }   
?>        

<section class="container">
    <form class="col-md-8" action="find-evento.php" method="post">
            <div class="form-row">
                <table class="table">
                <tr>
                    <td><label for="inputEvento">Código Evento:</label></td>
                    <td><input id="inputEvento" class="form-control" type="text" name="pesquisar"></td>
                </tr>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
   </form>
  
</section>

<?php include ("footer.php"); ?>