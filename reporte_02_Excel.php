<?php
$MID = $_GET['MID'].$_GET['AA'].$_GET['MM'];
$NOM1 = "Existencia_Materiales-Lineas";
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
<TITLE>EXISTENCIA DE MATERIALES POR LINEA</TITLE>

</HEAD>

<BODY bgcolor=#FFFFFF>
<div align="Left">
<?php
echo '<FORM ACTION="">';

$Fecha = date('d-m-Y');
$CIA = $_GET['CIA']; 		// Codigo Compañia
$ZON = $_GET['ZON']; 		// Codigo del Almacen
$LIN = $_GET['LIN']; 			// Año
//---------------------------------------------------------------
//===============================================================
	$SQLp = "SELECT * FROM wh_periodos 
	WHERE per_statu = 'Abierto' and zone_id = '$ZON' ";
	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA = $Filap["per_aa"];
		$MM = $Filap["per_mm"];
	}
	mysqli_free_result ($Registrop);
	//===============================================================
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
$SQLL="Select * FROM wh_lines  
WHERE statu = 'Activo' and id = '$LIN' ";								

$Registrol=mysqli_query($link,$SQLL);
//-------
while ($Filal=mysqli_fetch_array($Registrol))
{
	$DLIN =  $Filal["namel"];
}
mysqli_free_result ($Registrol);
//---------------------------------------------------------------
$SQL = "SELECT 
	m.id, m.code, m.description_m, m.ubication, m.wh_line_id_m, c.category,
	COALESCE(s.Entradas, 0) AS Entradas,
	COALESCE(s.Salidas, 0) AS Salidas,
	COALESCE(s.Stock, 0) AS Stock
FROM wh_materials m
LEFT JOIN wh_categories c ON c.cat_id = m.wh_category_id_m
LEFT JOIN (
	SELECT
		product_cod,
		SUM(CASE WHEN movd_tmov = 'ENTRADAS' THEN movd_cant ELSE 0 END) AS Entradas,
		SUM(CASE WHEN movd_tmov = 'SALIDAS' THEN movd_cant ELSE 0 END) AS Salidas,
		SUM(CASE WHEN movd_tmov = 'ENTRADAS' THEN movd_cant ELSE 0 END) -
		SUM(CASE WHEN movd_tmov = 'SALIDAS' THEN movd_cant ELSE 0 END) AS Stock
	FROM wh_movinvd
	WHERE movd_cia = '$CIA'
	GROUP BY product_cod
) s ON m.code = s.product_cod
WHERE
	m.zone_id = '$ZON'
	AND m.company_id = '$CIA'
	AND m.wh_line_id_m = '$LIN'
	AND m.m_statu_m = 'Activo'
ORDER BY m.code ASC";
//---------------------------------------------------------------
//----------
echo "<font color='#660000' size='5'><b>EXISTENCIA DE MATERIALES POR LINEA</b></font>";
echo "<br>";
echo "<font color='blue' size='5'><b>$DCIA</b></font>";
echo "<br>";
echo "<font color='#990000' size='4px'><b>ZONA: </b></font>";
echo "$ZOND";
echo "<br>";
echo "<font color='#990000' size='4px'><b>LINEA: </b></font>";
echo "$DLIN";
echo "<br>";

echo "<Table cellspacing='0' cellpadding='0' bgcolor=#6699FF border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>CODIGO MATERIAL</th>";
echo "<th>DESCRIPCION</th>";
//echo "<th>LINEA</th>";							
echo "<th>CATEGORIA</th>";
echo "<th>UBICACION</th>";
echo "<th>EXISTENCIA</th>";
echo "</tr>";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{

	//=======================================================	
	$existencia = 0;							
	$existencia = $Fila["Stock"];

	echo "<tr bgcolor='#FFFFFF'>";
	echo "<td align=Center><font size=3>" . $Fila['code']."</font></td>";	
	echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
	//echo "<td Align=Left><font size=2>" . $DLIN."</font></td>";
	echo "<td Align=Left><font size=2>" . $Fila['category']."</font></td>";
	echo "<td Align=Center><font size=2>" . $Fila['ubication']."</font></td>";
	echo "<td Align=Center><font size=2>" . $existencia."</font></td>";
	echo "</tr>";
	//---------------	

}
mysqli_free_result ($Registro);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 