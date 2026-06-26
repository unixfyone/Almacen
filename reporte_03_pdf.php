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
if(isset($_GET["AA"]))$AA = $_GET["AA"];
else $AA = '';
//-------------
if(isset($_GET["MM"]))$MM = $_GET["MM"];
else $MM = '';
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

	$this->SetX(90);
	$this->SetFont('Arial','B',10);
	$this->Cell(100,5,utf8_decode('CONSUMOS POR LINEAS DE SERVICIOS'),1,1,'C');

	//$this->SetX(110);
	
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
	$this->Cell(25,6,utf8_decode('ALMACEN:'),1,0,'R',1);
	$this->SetFont('Arial','',11);
	$this->Cell(80,6,utf8_decode ($GLOBALS['DZON']),1,0,'L');
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(41,6,utf8_decode('LINEA DE SERVICIO:'),1,0,'R',1);
	$this->SetFont('Arial','',11);
	$this->Cell(62,6,utf8_decode ($GLOBALS['DLIN']),1,0,'L');
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(33,6,utf8_decode('AÑO / PERIODO:'),1,0,'R',1);
	$this->SetFont('Arial','',11);
	$this->Cell(15,6,utf8_decode ($GLOBALS['AA']),1,0,'C');
	$this->Cell(10,6,utf8_decode ($GLOBALS['MM']),1,0,'C');
	
	
	$this->SetXY(115,32);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(255,255,255);
	$this->SetFont('Arial','B',12);
	$this->Cell(52,6,'MATERIALES CONSUMIDOS',0,0,'C',1);
	//----------------------

	$this->SetY(38);
	$this->SetTextColor(255, 255, 255);
	$this->SetFillColor(80,80,80);
	$this->SetFont('Arial','B',10);
	$this->Cell(18,6,('FECHA'),1,0,'C',1);
	$this->Cell(26,6,('DOCUMENTO'),1,0,'C',1);
	$this->Cell(18,6,('CODIGO'),1,0,'C',1);
	$this->Cell(130,6,'DESCRIPCION',1,0,'C',1);
	$this->Cell(20,6,'UNI-MED',1,0,'C',1);
	$this->Cell(14,6,'CANT.',1,0,'C',1);
	$this->Cell(20,6,'COSTO',1,0,'C',1);
	$this->Cell(20,6,'TOTAL',1,1,'C',1);	

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
	$pdf = new PDF('L','mm','LETTER');
	$pdf->SetTitle('Consumos');
	$pdf->AliasNbPages();
	$pdf->SetLeftMargin(5);
	$pdf->SetTopMargin(12);
	$pdf->SetRightMargin(5);
	$pdf->SetAutoPageBreak(true,12); 
	$pdf->AddPage();
	//---------------------------------------------------------------
	$SQL3 = "SELECT movd.*, mat.*, um.name AS umname, li.namel
		FROM wh_movinvd movd
		INNER JOIN wh_materials mat ON mat.id = movd.product_id
		INNER JOIN wh_lines li ON li.id = mat.wh_line_id_m
		LEFT JOIN wh_movinvh movh ON movh.movh_id = movd.movh_id
		LEFT JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
		WHERE movd.movd_cia = '$CIA' and movd.movd_zone = '$ZON' and movd.movd_ejer = '$AA' and movd_statu = 'Cerrado' and movd.movd_per = '$MM' and li.id = '$LIN' and movd.movd_tmov = 'SALIDAS'
		ORDER BY movd.product_id ASC";
	//---------------------------------------------------------------
	//---------------
			$Registro3 = mysqli_query($link,$SQL3);
			while($Fila3 = mysqli_fetch_array($Registro3))
			{ 
				$stotale = $Fila3['movd_cant'] * $Fila3['movd_costou_me'];
				
				//$pdf->Cell(10);
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0,0,0);
				$pdf->Cell(18,6,utf8_decode($Fila3['movd_fecha']),1,0,'C');
				$pdf->Cell(26,6,utf8_decode($Fila3['movh_doc']),1,0,'C');
				$pdf->Cell(18,6,utf8_decode($Fila3['product_cod']),1,0,'C');
				$pdf->Cell(130,6,utf8_decode($Fila3['description_m']),1,0,'L');
				$pdf->Cell(20,6,utf8_decode($Fila3['umname']),1,0,'C');
				$pdf->Cell(14,6,utf8_decode($Fila3['movd_cant']),1,0,'C');
				$pdf->Cell(20,6,utf8_decode($Fila3['movd_costou_me']),1,0,'C');
				$pdf->Cell(20,6,number_format($stotale, 2, ',', '.'),1,1,'C');
					
			}
			mysqli_free_result ($Registro3);
			// ************************************************************************** 

	ob_end_clean();
	$pdf->Output();
	ob_end_flush();
?>
