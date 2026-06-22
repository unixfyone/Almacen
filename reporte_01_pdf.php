<?php
ob_start();
require('fpdf/fpdf.php');
//--------------------
include('database_connection.php');
if(!isset($_SESSION['type']))
{
	header('location:login.php');
}
if($_SESSION['type'] != 'Master')
{
	header("location:index2.php");
}
include('unico.php');
$logo= $_SESSION['logo'];
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//-------------
if(isset($_GET["DCIA"]))$DCIA = $_GET["DCIA"];
else $DCIA = '';
if(isset($_GET["DZON"]))$DZON = $_GET["DZON"];
else $DZON = '';
if(isset($_GET["DLIN"]))$DLIN = $_GET["DLIN"];
else $DLIN = '';

//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where wh_zones.zone_id = '$ZON' ";

$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$DZON = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLtm="Select * FROM wh_lines  
	WHERE statu = 'Activo' and id = '$LIN'  
	ORDER BY acronym ASC";
	//------------------------------------------------------
	$RegistroTM=mysqli_query($link,$SQLtm);
	while ($FilaTM=mysqli_fetch_array($RegistroTM))
	{
	$DLIN= $FilaTM["namel"];
	}
	mysqli_free_result ($RegistroTM);

//---------------------------------------------------------------ob_end_clean();  'L','mm','LETTER'
//---------------------------------------------------------------ob_end_flush();
//---------------- ENCABEZADO Y PIE DE PAGINA ------------------
ob_end_clean();
ob_start();
class PDF extends FPDF
{
// ----------- Cabecera de página ------------------------------
//--------------------------------------------------------------

function Header()
{	
	$this->Image($_SESSION['logo'], 5.5, 3, -205);
	
    $this->SetXY(3,8);

	$this->SetX(60);
	$this->SetFont('Arial','B',10);
	$this->Cell(100,5,utf8_decode('UBICACIONES DE MATERIALES'),1,1,'C');

	$this->SetX(110);
	
	$this->SetY(17);
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(20,5,utf8_decode('EMPRESA:'),0,0,'C',1);
	$this->SetFont('Arial','',12);
	$this->Cell(28,5,utf8_decode ($GLOBALS['DCIA']),0,1,'L');
	//---------------	
	$this->SetY(22);
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(45,6,utf8_decode('ALMACEN:'),1,0,'C',1);
	$this->SetFont('Arial','',11);
	$this->Cell(149,6,utf8_decode ($GLOBALS['DZON']),1,0,'L');

	$this->SetY(28);			

	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(45,6,utf8_decode('LINEA DE MATERIALES:'),1,0,'C',1);
	$this->SetFont('Arial','',11);
	$this->Cell(149,6,utf8_decode ($GLOBALS['DLIN']),1,0,'L');
	
	
	$this->SetXY(84,38);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(255,255,255);
	$this->SetFont('Arial','B',12);
	$this->Cell(52,6,'MATERIALES',0,0,'C',1);
	//----------------------

	$this->SetY(43);
	$this->SetTextColor(255, 255, 255);
	$this->SetFillColor(80,80,80);
	$this->SetFont('Arial','B',10);
	$this->Cell(23,6,utf8_decode('CODIGO'),1,0,'C',1);
;	$this->Cell(138,6,'DESCRIPCION',1,0,'C',1);
	$this->Cell(32,6,'UBICACION',1,1,'C',1);	

}
//--------------------------------------------------------------
// Pie de página
function Footer()
{

	// Posición: a 1,5 cm del final
    //$this->SetY(-12);
	$this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//---------------------------------------------------------------
//---------------------------------------------------------------
	$pdf = new PDF('P','mm','LETTER');
	$pdf->SetTitle('Entradas Materiales');
	$pdf->AliasNbPages();
	$pdf->SetLeftMargin(10);
	$pdf->SetTopMargin(12);
	$pdf->SetRightMargin(10);
	$pdf->SetAutoPageBreak(true,12); 
	$pdf->AddPage();
	//---------------------------------------------------------------
	$SQL3 = "SELECT * FROM wh_materials 
	INNER JOIN wh_lines on wh_lines.id = wh_materials.wh_line_id_m
	Where wh_materials.zone_id = '$ZON' and wh_materials.company_id = '$CIA' and wh_materials.wh_line_id_m = '$LIN' and wh_materials.m_statu_m = 'Activo' 
	Order by wh_materials.code ASC";
	//---------------------------------------------------------------
	//---------------
			$Registro3 = mysqli_query($link,$SQL3);
			while($Fila3 = mysqli_fetch_array($Registro3))
			{ 
				$DESCORTA = substr($Fila3['movd_desc'], 0, 60);
			//---------------
				//$pdf->Cell(10);
				$pdf->SetFont('Arial','',10);
				$pdf->SetTextColor(0,0,0);				
				$pdf->Cell(23,5,utf8_decode($Fila3['code']),1,0,'C');
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(138,5,utf8_decode($Fila3['description_m']),1,0,'L');
				$pdf->Cell(32,5,utf8_decode($Fila3['ubication']),1,1,'C');
					
			}
			mysqli_free_result ($Registro3);
			// ************************************************************************** 

	ob_end_clean();
	$pdf->Output();
	ob_end_flush();
?>
