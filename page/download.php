<?php

	echo $_GET['file'];
	
	$pasta = "upload";

	if(isset($_GET['file']) and file_exists("{$pasta}/".$_GET['file'])){
		$file = $_GET['file'];
		$type = filetype("{$pasta}/{$file}");
		$size = filesize("{$pasta}/{$file}");
		header("Content-Description: File Transfer");
		header("Content-Type: {$type}");
		header("Content-Length: {$size}");
		header("Content-Disposition: attachment; filename= $file");
		readfile("{$pasta}/{$file}");
		exit;
	}