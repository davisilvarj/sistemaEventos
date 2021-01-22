<?php
	require_once ("../fpdf181/fpdf.php");
	require_once("connect.php");
	include ("back-evento.php");

	$eventos 		= listEventos($connect);
	$quantidade 	= contEvento($connect);
	$deferidos 		= contDeferido($connect);
	$indeferidos	= contIndeferido($connect);
	$cancelado		= contCancelado($connect);

$pdf = new FPDF("L");
$pdf->AddPage();

$arquivo = "relatorio-evento.pdf";

$font = "Arial";
$estilo = "B";
$border = "1";
$alinhaL = "L";

$tipo_pdf = "I";
	
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(60,10, utf8_decode('Quantidade total de Evento: '), 0, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, $quantidade, 0, 1, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(60,10, utf8_decode('Deferidos: '), 0, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, $deferidos, 0, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(60,10, utf8_decode('Indeferidos: '), 0, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, $indeferidos, 0, 0, $alinhaL);
	$pdf->Cell(60,10, utf8_decode('Cancelados: '), 0, 0, $alinhaL);
	$pdf->Cell(20,10, $cancelado, 0, 1, $alinhaL);

	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, utf8_decode('Código'), $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(50,10, 'Nome Evento', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(35,10, 'Local', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(25,10, 'Data', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, 'Inicio', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(20,10, 'Termino', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(30,10, 'Quant', $border, 0, $alinhaL);
	$pdf->SetFont($font, $estilo, 11);
	$pdf->Cell(30,10, 'Hr.Atribuida', $border, 1, $alinhaL);

foreach ($eventos as $evento) {
		$pdf->SetFont($font, '', 10);
		$pdf->Cell(20,10, $evento['id_evento'], $border, 0, $alinhaL);
		$pdf->SetFont($font, '', 10);
		$pdf->Cell(50,10, utf8_decode(substr($evento['nome_evento'], 0, 20)), $border, 0, $alinhaL);
		$pdf->SetFont($font, $estilo, 10);
		if($evento['nome_local']== 'Sala de Aula'){
			$pdf->Cell(35,10, utf8_decode(substr($evento['outro_local'],0,17)), $border, 0, $alinhaL);
			$pdf->SetFont($font, $estilo, 10);
		}else{
			$pdf->Cell(35,10, utf8_decode(substr($evento['nome_local'],0,17)), $border, 0, $alinhaL);
			$pdf->SetFont($font, $estilo, 10);
		}

		$pdf->Cell(25,10, $evento['data'], $border, 0, $alinhaL);
		$pdf->SetFont($font, $estilo, 10);
		$pdf->Cell(20,10, $evento['hr_inicio'], $border, 0, $alinhaL);
		$pdf->SetFont($font, $estilo, 10);
		$pdf->Cell(20,10, $evento['hr_termino'], $border, 0, $alinhaL);
		$pdf->SetFont($font, $estilo, 10);
		$pdf->Cell(30,10, $evento['quant_pessoa'], $border, 0, $alinhaL);
		$pdf->SetFont($font, $estilo, 10);
		$pdf->Cell(30,10, $evento['hr_atribuida'], $border, 1, $alinhaL);


	}

$pdf->Output($arquivo, $tipo_pdf);