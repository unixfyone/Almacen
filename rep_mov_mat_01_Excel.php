<?php
$MID = $_GET['MID'].$_GET['AA'].$_GET['MM'];
$NOM1 = "Movimientos_Materiales-";
$NOM2 = ".xls";
$nombreDelDocumento = $NOM1.$MID.$NOM2;

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $nombreDelDocumento . '" ');
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html; charset=utf-8");

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
sal.sal_id, sal.saldos_e, sal.saldos_s, sal.saldos_fp, li.acronym, su.prove
FROM wh_movinvd movd
LEFT JOIN wh_materials mat ON mat.id = movd.product_id
LEFT JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
LEFT JOIN wh_lines li ON li.id = mat.wh_line_id_m
INNER JOIN wh_movinvh movh ON movh.movh_id = movd.movh_id
LEFT JOIN wh_suppliers su ON su.id = movh.movh_prove_id
LEFT JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
LEFT JOIN wh_saldosm sal ON sal.product_id = movd.product_id and sal.aa_s = movd.movd_ejer
WHERE movd.movd_cia = '$CIA' and movd.movd_zone = '$ZON' and movd.movd_ejer = '$AA' and movd.movd_per = '$MM' and movd.movd_tmov = '$MID'
ORDER BY movd.product_id ASC";
//---------------------------------------------------------------
//----------
echo "<font color='#660000' size='5'><b>Movimientos de Materiales - $MID</b></font>";
echo "<br>";
echo "<font color='blue' size='4'><b>$DCIA</b></font>";
echo "<br>";
echo "<font color='#990000' size='4px'><b>$ZOND  Periodo: $AA - $MM</b></font>";
echo "<br>";

echo "<Table cellspacing='0' cellpadding='0' bgcolor=#6699FF border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>Fecha</th>";
echo "<th>Prefijo-Codigo</th>";
echo "<th>Descripción</th>";
echo "<th>Uni-Med</th>";
echo "<th>Línea</th>";														
echo "<th>Cantidad</th>";
echo "<th>C/U</th>";
echo "<th>Proveedor</th>";
echo "<th>Sub Total</th>";
echo "</tr>";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
	$stotale = $Fila['movd_cant'] * $Fila['movd_costou_me'];
	//=======================================================	
	echo "<tr bgcolor='#FFFFFF'>";
	echo "<td align=Center><font size=3>" . $Fila['movd_fecha'];	
	echo "<td align=Center><font size=3>" . $Fila['code_sap'];	
	echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
	echo "<td align=Left><font size=2>" . $Fila['umname'];
	echo "<td align=Left><font size=2>" . $Fila['acronym'];
	echo "<td><font size=2>" . number_format($Fila['movd_cant'], 3, ',','.');
	echo "<td><font size=2>" . number_format($Fila['movd_costou_me'], 3, ',','.');
	echo "<td align=Center><span class='text-wrap'><font size=2>" . $Fila['prove'];
	echo "<Td><font size='2px'>" . number_format($stotale, 3, ',','.');
	echo "</tr>";
}
mysqli_free_result ($Registro);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 