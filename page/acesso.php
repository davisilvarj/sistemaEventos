<?php 
include ("head.php"); 
include ("logic-user.php");

?>
    	<form action="login.php" method="post" class="col-md-6" style="opacity: .9;">
            <div class="card text-left">
                <div class="card-header bg-danger">
                    <h3 class="card-title">Login</h3>
                </div>
                <table class="table ">
                <tr>
                    <td>DRT</td>
                    <td><input class="form-control" type="text" name="drt"></td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td><input class="form-control" type="password" name="senha"></td>
                </tr>
                <tr>
                    <td><button type="submit" class="btn btn-primary">Login</button></td>
                </tr>
                </table>
            </div>  
        </form>
