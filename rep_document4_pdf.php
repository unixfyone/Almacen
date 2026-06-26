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
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["IDM"]))$IDM = $_GET["IDM"];
else $IDM = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["DCIA"]))$DCIA = $_GET["DCIA"];
else $DCIA = '';
if(isset($_GET["mhdoc"]))$mhdoc = $_GET["mhdoc"];
else $mhdoc = '';
if(isset($_GET["DESCTM"]))$DESCTM = $_GET["DESCTM"];
else $DESCTM = '';
if(isset($_GET["mhtmov"]))$mhtmov = $_GET["mhtmov"];
else $mhtmov = '';
if(isset($_GET["mhfecha"]))$mhfecha = $_GET["mhfecha"];
else $mhfecha = '';
if(isset($_GET["mhejer"]))$mhejer = $_GET["mhejer"];
else $mhejer = '';
if(isset($_GET["mhper"]))$mhper = $_GET["mhper"];
else $mhper = '';
if(isset($_GET["mhtipent"]))$mhtipent = $_GET["mhtipent"];
else $mhtipent = '';
if(isset($_GET["mhorden"]))$mhorden = $_GET["mhorden"];
else $mhorden = '';
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
$mhtipent = $Fila1["movh_tentrega"];		// Tipo de Entrega
$mhorden = $Fila1["movh_oc"];			// Orden Compra
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
	$this->Cell(100,5,utf8_decode('MOVIMIENTOS DE MATERIALES'),1,1,'C');

	$this->SetX(110);
	
	$this->SetY(17);
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(20,5,utf8_decode('Empresa:'),0,0,'C',1);
	$this->Cell(28,5,utf8_decode ($GLOBALS['DCIA']),0,1,'L');
	//---------------	
	$this->SetY(22);
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(30,5,utf8_decode('Documento'),1,0,'C',1);
	$this->Cell(70,5,utf8_decode('Tipo Documento'),1,0,'C',1);
	$this->Cell(27,5,utf8_decode('T.M.'),1,0,'C',1);
	$this->Cell(30,5,utf8_decode('Fecha Doc.'),1,0,'C',1);
	$this->Cell(20,5,utf8_decode('Ejercicio'),1,0,'C',1);
	$this->Cell(17,5,utf8_decode('Periodo'),1,0,'C',1);

	$this->SetY(27);			
	$this->SetTextColor(0,0,0);
	$this->setFillColor(255,255,255);
	$this->SetFont('Arial','',10);
	$this->Cell(30,5,utf8_decode ($GLOBALS['mhdoc']),1,0,'C');
	
	$this->Cell(70,5,utf8_decode ($GLOBALS['DESCTM']),1,0,'L');
	$this->SetTextColor(20, 14,186);
	$this->SetFont('Arial','B',10);
	$this->Cell(27,5,utf8_decode ($GLOBALS['mhtmov']),1,0,'C');
	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','',10);
	$this->Cell(30,5,utf8_decode($GLOBALS['mhfecha']),1,0,'C');
	$this->Cell(20,5,utf8_decode($GLOBALS['mhejer']),1,0,'C');
	$this->Cell(17,5,utf8_decode($GLOBALS['mhper']),1,0,'C');
	
	$this->SetY(32);
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);
	$this->Cell(45,5,utf8_decode('Tipo de Entrega .....:'),1,0,'C',1);
	$this->setFillColor(255,255,255);
	$this->SetFont('Arial','',10);
	$this->Cell(55,5,utf8_decode($GLOBALS['mhtipent']),1,0,'L');	

	$this->SetFont('Arial','B',10);
	$this->SetFillColor(244,244,255);	
	$this->Cell(44,5,utf8_decode('Orden de Salida .....:'),1,0,'C',1);	
	$this->setFillColor(255,255,255);
	$this->SetFont('Arial','',10);
	$this->Cell(50,5,utf8_decode($GLOBALS['mhorden']),1,0,'C');
	
	$this->SetXY(85,42);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(255,255,255);
	$this->SetFont('Arial','B',10);
	$this->Cell(52,6,'DETALLE DE RENGLONES',0,0,'C',1);
	//----------------------

	$this->SetY(47);
	$this->SetTextColor(255, 255, 255);
	$this->SetFillColor(80,80,80);
	$this->SetFont('Arial','B',11);
	$this->Cell(25,6,utf8_decode('MATERIAL'),1,0,'C',1);
	$this->Cell(95,6,'DESCRIPCION',1,0,'C',1);
	$this->Cell(25,6,'CANTIDAD',1,0,'C',1);
	$this->Cell(25,6,'COSTO',1,0,'C',1);
	$this->Cell(25,6,'STATUS',1,1,'C',1);	

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
	$pdf->SetTitle('MOVIMIENTOS');
	$pdf->AliasNbPages();
	$pdf->SetLeftMargin(10);
	$pdf->SetTopMargin(12);
	$pdf->SetRightMargin(10);
	$pdf->SetAutoPageBreak(true,12); 
	$pdf->AddPage();
	//---------------------------------------------------------------
	$SQL3 = "SELECT * FROM wh_movinvh 
	INNER JOIN wh_movinvd ON wh_movinvd.movh_id = wh_movinvh.movh_id
	INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id
	INNER JOIN departments ON departments.id = wh_movinvd.dep_receptor_d
	INNER JOIN users ON users.id = wh_movinvd.user_receptor_d	
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
				$pdf->Cell(25,5,utf8_decode($Fila3['product_cod']),1,0,'C');
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(95,5,utf8_decode($DESCORTA),1,0,'L');
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(25,5,number_format($Fila3['movd_cant'], 2, ",", "."),1,0,'R');
				$pdf->Cell(25,5,number_format($Fila3['movd_costou_me'], 3, ",", "."),1,0,'R');
				$pdf->Cell(25,5,utf8_decode($Fila3['movd_statu']),1,1,'C');
				
				$pdf->SetX(15);
				$pdf->SetFont('Arial','',9);
				$pdf->SetFillColor(244,244,255);
				$pdf->Cell(43,5,utf8_decode('Departamento Receptor:'),1,0,'C',1);
				$pdf->Cell(60,5,utf8_decode($Fila3['department']),1,0,'L');
				$pdf->Cell(18,5,utf8_decode('Usuario:'),1,0,'C',1);
				$pdf->Cell(69,5,utf8_decode($Fila3["first_name"] .' '. $Fila3["last_name"]),1,1,'L');
				
				$pdf->SetX(15);
				$pdf->SetFont('Arial','',9);
				$pdf->SetFillColor(244,244,255);
				$pdf->Cell(43,5,utf8_decode('Observación:'),1,0,'C',1);
				$pdf->Cell(147,5,utf8_decode($Fila3['movd_obs']),1,1,'L');
					
			}
			mysqli_free_result ($Registro3);
			// ************************************************************************** 

	ob_end_clean();
	$pdf->Output();
	ob_end_flush();
?>
