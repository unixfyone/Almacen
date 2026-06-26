<?php
$MID = $_GET['MID'].$_GET['AA'].$_GET['MM'];
$NOM1 = "Ubicacion_Materiales-Lineas";
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
<TITLE>UBICACION DE MATERIALES POR LINEA</TITLE>

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
$SQL = "SELECT * FROM wh_materials 
INNER JOIN wh_lines on wh_lines.id = wh_materials.wh_line_id_m
LEFT JOIN wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
Where wh_materials.zone_id = '$ZON' and wh_materials.company_id = '$CIA' and wh_materials.wh_line_id_m = '$LIN' and wh_materials.m_statu_m = 'Activo' 
Order by wh_materials.code ASC";
//---------------------------------------------------------------
//----------
echo "<font color='#660000' size='5'><b>Ubicaciones de Materiales por Linea</b></font>";
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
echo "<th>CATEGORIA</th>";
echo "<th>UBICACION</th>";
echo "</tr>";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{

	//=======================================================	
	echo "<tr bgcolor='#FFFFFF'>";
	echo "<td align=Center><font size=3>" . $Fila['code']."</font></td>";	
	echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
	echo "<td Align=Left><font size=2>" . $Fila['category']."</font></td>";
	echo "<td Align=Center><font size=2>" . $Fila['ubication']."</font></td>";
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