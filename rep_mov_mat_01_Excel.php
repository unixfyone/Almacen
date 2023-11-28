<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Movimientos_Materiales $AA-$MM.xls");
header("Pragma: no-cache");
header("Expires: 0");

//header('Cache-Control: max-age=0');
//------------------------------------
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
?>
<HTML>
<HEAD>
<TITLE>Stock de Materiales</TITLE>

</HEAD>

<BODY bgcolor=#FFFFFF>
<div align="Left">
<?php
echo '<FORM ACTION="">';

$Fecha = date('d-m-Y');
$CIA = $_GET['CIA']; 		// Codigo Compañia
$ZON = $_GET['ZON']; 		// Codigo del Almacen
$AA = $_GET['AA']; 			// Año
$MM = $_GET['MM']; 			// Mes
$MID = $_GET['MID'];		// Tipo Movimiento
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZON' ";
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
$SQL = "SELECT movd.*, mat.*, cat.category, um.name AS umname,
sal.sal_id, sal.saldos_e, sal.saldos_s, sal.saldos_fp
FROM wh_movinvd movd
INNER JOIN wh_materials mat ON mat.id = movd.product_id
INNER JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
INNER JOIN wh_saldosm sal ON sal.product_id = movd.product_id and sal.aa_s = movd.movd_ejer
WHERE movd.movd_cia = '$CIA' and movd.movd_zone = '$ZON' and movd.movd_ejer = '$AA' and movd.movd_per = '$MM' and movd.movd_tmov = '$MID'
ORDER BY movd.product_id ASC";
//---------------------------------------------------------------
//----------
echo "<font color='#660000' FACE='times new roman' size='5'><b>Movimientos de Materiales - $MID</b></font>";
echo "<br>";
echo "<font color='blue' FACE='times new roman' size='4'><b>$DCIA</b></font>";
echo "<br>";
echo "<font color='#990000' FACE='times new roman' size='4px'><b>$ZOND  Periodo: $AA - $MM</b></font>";
echo "<br>";

echo "<Table cellspacing='0' cellpadding='0' bgcolor=#6699FF border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>Codigo</th>";
echo "<th>Descripción</th>";
echo "<th>Uni-Med</th>";							
echo "<th>Cantidad</th>";
echo "<th>Costo_Unitario ME</th>";
echo "<th>Sub Total</th>";
echo "</tr>";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
	$stotale = $Fila['movd_cant'] * $Fila['movd_costou_me'];
	//=======================================================	
	echo "<tr bgcolor='#FFFFFF'>";
	echo "<td align=Center bgcolor='#FFFFFF'><font size=3>" . $Fila['code_sap'];	
	echo "<td Align=Left bgcolor='#FFFFFF'><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
	echo "<td align=Left bgcolor='#FFFFFF'><font size=2>" . $Fila['umname'];
	echo "<td align=Left bgcolor='#FFFFFF'><font size=2>" . $Fila['movd_cant'];
	echo "<td align=Center bgcolor='#FFFFFF'><font size=2>" . $Fila['movd_costou_me'];
	echo "<Td align='center' bgcolor='#FFFFFF'><font size='2px'>" . number_format($stotale, 2, ',', '.');
	echo "</tr>";
}
mysqli_free_result ($Registro);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 