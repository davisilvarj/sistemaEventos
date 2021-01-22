<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    include("alertShow.php");
?>

<html>
	<head>
    <title>Solicitação de Evento Mackenzie</title>
    <meta charset="utf-8"/>
    
    <link rel="stylesheet" href="../css/estilo.css"/>
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
   <!--  <link rel="stylesheet" href="../css/jquery-ui.css"/> -->
    
    <script src="../js/bootstrap.bundle.js"></script>

 <!--    <script src="../js/jquery-1.8.2.js"></script>
    <script src="../js/jquery-ui.js"></script> -->
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

 

</head>

<body>
    <div class="container principal">
    	<img class="img-fluid" src="imagem/img.jpg"/>
    </div>
    <div class="container">
        <div class="principal">
            <div class="bg"></div>
            <?php  mostraAlerta("success"); ?>
            <?php mostraAlerta("danger"); ?>

      
