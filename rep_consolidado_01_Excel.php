<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Consolidado_Materiales $AA-$MM.xls");
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
<TITLE>Consolidado de Materiales</TITLE>

</HEAD>

<BODY bgcolor=#FFFFFF>
<div align="Left">
<?php
echo '<FORM ACTION="">';

$Fecha = date('d-m-Y');
$CIA = $_GET['CIA']; 		// Codigo Compañia
$ZON = $_GET['ZON']; 		// Codigo del Almacen
//$LIN = $_GET['LIN']; 		// Linea
$PER = $_GET['PER']; 		// Año del Periodo
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLp = "SELECT * FROM wh_periodos WHERE per_id = '$PER' ";
	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA = $Filap["per_aa"];
		$MM = $Filap["per_mm"];
		$AA2 = $Filap["per_aa"];
	}
	mysqli_free_result ($Registrop);
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
$SQL = "SELECT *, wh_measurement_units.name AS nameum, wh_lines.namel, wh_materials.id AS matid,  wh_categories.category, wh_type_material2.name AS nametm2, wh_clasificacion_tm2.name AS namecl2
FROM wh_materials 
left join wh_measurement_units on wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
left join wh_lines on wh_lines.id = wh_materials.wh_line_id_m
left join wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
left join wh_type_material2 on wh_type_material2.id = wh_materials.type_tm2_id
left join wh_clasificacion_tm2 on wh_clasificacion_tm2.id = wh_materials.clas_tm2_id
WHERE wh_materials.zone_id = '$ZON' and wh_materials.company_id = '$CIA'
ORDER BY wh_materials.code ASC
";
//---------------------------------------------------------------

echo "<font color='#FF6600' FACE='times new roman' size='5'><b>Consolidado de Materiales</b></font>";
echo "<br>";
echo "<font color='blue' FACE='times new roman' size='4'><b>$DCIA</b></font>";
echo "<br>";
echo "<font color='#b35900' FACE='times new roman' size='4px'><b>$ZOND</b></font>";
echo "<br>";

echo "<Table cellspacing='0' cellpadding='0' bgcolor=#6699FF border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>Código</th>";
echo "<th>Descripción</th>";
echo "<th>Línea</th>";
echo "<th>Uni-Med</th>";
echo "<th>Tipo</th>";
echo "<th>Tipo Inv</th>";
echo "<th>Clasificación</th>";
echo "<th>Costo/Unitario ME</th>";
echo "<th>Existencia</th>";
echo "<th>Ubicacion</th>";
echo "<th>Total ME</th>";
echo "</tr>";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
	$status = '';
	$accion = '';
	$btnVer = '';
	$total = '0';
	$prodid2 = $Fila["matid"];
	//----------------------------
	$mValore = '';
	$mValors = '';
	$mValorfp = '';
	//----------------------------
	$query = "SELECT *, Count(sal_id) AS Cuenta1 FROM wh_saldosm WHERE product_id = '".$prodid2."' and aa_s = '".$AA2."' ";	

	$Registro3 = mysqli_query($link,$query);			
	while($row3 = mysqli_fetch_array($Registro3))
	{
		$CTA2 = $row3['Cuenta1'];
		//=======================================================
		if ($CTA2 > '0') 
		{ 
			$MM_ANT = $MM - 1; 		// Mes periodo actual en arreglo (12 Pos)
			$MM_PANT = $MM - 1;		// Mes para Saldo del Periodo anterior (13 Pos)
			
			$mValore=explode("|", $row3["saldos_e"]);
			$exe = $mValore[$MM_ANT];

			$mValors=explode("|", $row3["saldos_s"]);
			$exs = $mValors[$MM_ANT];

			$mValorfp=explode("|", $row3["saldos_fp"]);
			$expa = $mValorfp[$MM_PANT];	
			
		}	else	{
			$exe = 0;
			$exs = 0;
			$expa = 0;
		}
	}
	$existencia = $expa + $exe - $exs;
	$totale = $existencia * $Fila["cost_me"];
	$totall = $existencia * $Fila["cost_ml"];
	//=======================================================	
?>	

	<Tr height= '16px'>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['code_sap']; ?></font></td>
	<Td bgcolor='#FFFFFF'><span class="text-wrap"><font size="2px"><?php echo $Fila['description_m']; ?></font></span></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['nameum'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['namel'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['type_material_m'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['nametm2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['namecl2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['cost_me'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $existencia;?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['ubication'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $totale;?></font></td>
	</tr>

<?php
}
mysqli_free_result ($Registro);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 