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
if(isset($_GET["USR"]))$USR = $_GET["USR"];
else $USR = '';
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["IDM"]))$IDM = $_GET["IDM"];
else $IDM = '';

//---------------------------------------------------------------ob_end_clean();  'L','mm','LETTER'
//---------------------------------------------------------------ob_end_flush();
//---------------- ENCABEZADO Y PIE DE PAGINA ------------------
ob_end_clean();
//ob_start();
class PDF extends FPDF
{
// ----------- Cabecera de página ------------------------------
//--------------------------------------------------------------

function Header()
{
    $this->SetXY(3,8);
	$this->SetX(60);
	$this->SetFont('Arial','B',10);
	$this->Cell(100,5,utf8_decode('MOVIMIENTOS DE MATERIALES'),0,0,'C');

	$this->SetX(110);
    // Salto de línea
    //$this->Ln(4);
}
//--------------------------------------------------------------
// Pie de página
function Footer()
{
	// Posición: a 1,5 cm del final
    $this->SetY(-12);
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
//----------------------
	$pdf->Image($logo,5.5,3,-205);
//----------------------

//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh 
Where wh_movinvh.movh_id = '$IDM' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$IDM = $Fila1["movh_id"];				// Id de Documento
$ZON = $Fila1["movh_zone"];				// Código del Almacen
$mhdoc = $Fila1["movh_doc"];			// Nro. de Documento
$mhtdoc = $Fila1["movh_tdoc"];			// Tipo de Documento
$tmcod = $Fila1["movh_tmid"];			// Tipo de Movimiento
$mhtmov = $Fila1["movh_tmov"];			// Tipo Movimiento (E/S)
$mhfecha = $Fila1["movh_fecha"];		// Fecha del Documento
$mhejer = $Fila1["movh_ejer"];			// Ejercicio / Año
$mhper = $Fila1["movh_per"];			// Periodo / Mes
$mhproce = $Fila1["movh_proce"];		// Procedencia
$mhorden = $Fila1["movh_oc"];			// Orden Compra
$mhprove = $Fila1["movh_prove_id"];		// Proveedor
$mhdrec = $Fila1["dep_receptor_es"];		// Departamento Receptor
$mhurec = $Fila1["user_receptor_es"];		// Usuario Receptor
}
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where wh_zones.zone_id = '$ZON' ";

$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLtm="Select * From wh_tipmov where tm_id = '$tmcod' ";
	$RegistroTM=mysqli_query($link,$SQLtm);
	//------------------------------------------------------
	while ($FilaTM=mysqli_fetch_array($RegistroTM))
	{
	$DESCTM= $FilaTM["tm_desc"];
	}
	mysqli_free_result ($RegistroTM);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLpr = "SELECT * FROM wh_suppliers where id = '$mhprove' ";
	$Registropr=mysqli_query($link,$SQLpr);
	//------------------------------------------------------
	while ($Filapr=mysqli_fetch_array($Registropr))
	{
	$DPROVE= $Filapr["prove"];
	}
	mysqli_free_result ($Registropr);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQL = "SELECT * FROM departments where id = '$mhdrec' ";
	$Registro=mysqli_query($link,$SQL);
	//------------------------------------------------------
	while ($Fila=mysqli_fetch_array($Registro))
	{
	$DRECEP= $Fila["department"];
	}
	mysqli_free_result ($Registro);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQL = "SELECT * FROM users where id = '$mhurec' ";
	$Registro=mysqli_query($link,$SQL);
	//------------------------------------------------------
	while ($Fila=mysqli_fetch_array($Registro))
	{
	$URECEP= $Fila["first_name"] .' '. $Fila["last_name"];
	}
	mysqli_free_result ($Registro);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$pdf->SetY(17);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(244,244,255);
	$pdf->Cell(20,5,utf8_decode('Empresa:'),0,0,'C',1);
	$pdf->Cell(28,5,utf8_decode($DCIA),0,1,'L');
	//----------------------
	
	$pdf->SetY(22);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(244,244,255);
	$pdf->Cell(28,5,utf8_decode('Documento'),1,0,'C',1);
	$pdf->Cell(70,5,utf8_decode('Tipo Documento'),1,0,'C',1);
	$pdf->Cell(30,5,utf8_decode('T.M.'),1,0,'C',1);
	$pdf->Cell(30,5,utf8_decode('Fecha Doc.'),1,0,'C',1);
	$pdf->Cell(20,5,utf8_decode('Ejercicio'),1,0,'C',1);
	$pdf->Cell(17,5,utf8_decode('Periodo'),1,1,'C',1);	

	$pdf->SetY(27);			
	$pdf->SetTextColor(0,0,0);
	$pdf->setFillColor(255,255,255);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(28,5,utf8_decode($mhdoc),1,0,'L');	
	$pdf->Cell(70,5,utf8_decode($DESCTM),1,0,'L');
	$pdf->SetTextColor(20,14,186);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,5,utf8_decode($mhtmov),1,0,'C');
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,5,utf8_decode($mhfecha),1,0,'C');
	$pdf->Cell(20,5,utf8_decode($mhejer),1,0,'C');
	$pdf->Cell(17,5,utf8_decode($mhper),1,0,'C');
	//----------------------
	$pdf->SetY(32);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(244,244,255);
	$pdf->Cell(70,5,utf8_decode('Procedencia'),1,0,'C',1);
	$pdf->Cell(86,5,utf8_decode('Proveedor'),1,0,'C',1);
	$pdf->Cell(39,5,utf8_decode('Orden Compra'),1,0,'C',1);

	$pdf->SetY(37);			
	$pdf->SetTextColor(3,3,3);
	$pdf->setFillColor(255,255,255);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(70,5,utf8_decode($mhproce),1,0,'L');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(86,5,utf8_decode($DPROVE),1,0,'L');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(39,5,utf8_decode($mhorden),1,0,'R');
	//----------------------
	$pdf->SetY(42);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(244,244,255);
	$pdf->Cell(97,5,utf8_decode('Departamento Receptor'),1,0,'L',1);
	$pdf->Cell(98,5,utf8_decode('Usuario Receptor'),1,0,'L',1);

	$pdf->SetY(47);			
	$pdf->SetTextColor(3,3,3);
	$pdf->setFillColor(255,255,255);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(97,5,utf8_decode($DRECEP),1,0,'L');	
	$pdf->Cell(98,5,utf8_decode($URECEP),1,0,'L');
	//----------------------
	
	$pdf->SetXY(60,55);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(100,6,'DETALLE DE RENGLONES',0,0,'C',1);
	//----------------------

	$pdf->SetY(61);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFillColor(80,80,80);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(28,6,utf8_decode('MATERIAL'),1,0,'C',1);
	$pdf->Cell(100,6,'DESCRIPCION',1,0,'C',1);
	$pdf->Cell(23,6,'CANTIDAD',1,0,'C',1);
	$pdf->Cell(24,6,'COSTO',1,0,'C',1);
	$pdf->Cell(20,6,'STATUS',1,1,'C',1);

	//---------------------------------------------------------------
	$SQL3 = "SELECT * FROM wh_movinvh 
	INNER JOIN wh_movinvd ON wh_movinvd.movh_id = wh_movinvh.movh_id
	INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id
	INNER JOIN wh_materials ON wh_materials.zone_id = wh_movinvd.movd_zone and wh_materials.code = wh_movinvd.product_cod
	Where wh_movinvh.movh_id = '$IDM' ORDER BY wh_movinvd.movd_id ASC";
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
				$pdf->Cell(28,5,utf8_decode($Fila3['product_cod']),1,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(100,5,utf8_decode($DESCORTA),1,0,'L');
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(23,5,number_format($Fila3['movd_cant'], 2, ",", "."),1,0,'R');
				$pdf->Cell(24,5,number_format($Fila3['movd_costou_me'], 3, ",", "."),1,0,'R');
				$pdf->Cell(20,5,utf8_decode($Fila3['movd_statu']),1,1,'C');
				
			}
			mysqli_free_result ($Registro3);
			// ************************************************************************** 

	ob_end_clean();
	$pdf->Output();
	ob_end_flush();

?>
