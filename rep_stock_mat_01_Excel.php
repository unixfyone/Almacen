<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Stock_Materiales $AA-$MM.xls");
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
$LIN = $_GET['LIN']; 		// Linea
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
if ($LIN != '') {
//---------------------------------------------------------------
$SQL = "SELECT mat.*, mat.id AS matid, um.id AS umid, um.name, lin.id, lin.acronym FROM wh_materials mat
INNER JOIN wh_lines lin ON lin.id = mat.wh_line_id_m
INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
WHERE mat.zone_id = '$ZON' and mat.wh_line_id_m = '$LIN' and mat.company_id = '$CIA'
ORDER BY mat.code DESC
";
//---------------------------------------------------------------
} else {
//---------------------------------------------------------------
$SQL = "SELECT mat.*, mat.id AS matid, um.id AS umid, um.name, lin.id, lin.acronym FROM wh_materials mat
INNER JOIN wh_lines lin ON lin.id = mat.wh_line_id_m
INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
WHERE mat.zone_id = '$ZON' and mat.company_id = '$CIA' 
ORDER BY mat.code DESC
";
//---------------------------------------------------------------
}
//----------
echo "<font color='#FF6600' size='5'><b>Stock de Materiales</b></font>";
echo "<br>";
echo "<font color='blue' size='4'><b>$DCIA</b></font>";
echo "<br>";
echo "<font color='#b35900' size='4px'><b>$ZOND</b></font>";
echo "<br>";

echo "<Table cellspacing='0' cellpadding='0' bgcolor=#6699FF border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>Código</th>";
echo "<th>Descripción</th>";
echo "<th>Línea</th>";
echo "<th>Uni-Med</th>";
echo "<th>Tipo</th>";
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
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['acronym'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['name'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['type_material_m'];?></font></td>
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