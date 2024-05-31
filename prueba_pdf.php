<?php
require('fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
//$pdf->SetFont('Arial','B',16);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(244,244,255);
//$pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
	$pdf->Cell(30,5,utf8_decode('Documento'),1,0,'C',1);
	$pdf->Cell(70,5,utf8_decode('Tipo Documento'),1,0,'C',1);
$pdf->Output();
?>