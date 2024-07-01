<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Consolidado_Materiales $AA-$MM.xls");
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
<TITLE>Consolidado de Materiales</TITLE>

</HEAD>
<meta charset="UTF-8">
<BODY bgcolor=#FFFFFF>
<div align="Left">
<?php
echo '<FORM ACTION="">';

$Fecha = date('d-m-Y');
$CIA = $_GET['CIA']; 		// Codigo Compañia
$ZON = $_GET['ZON']; 		// Codigo del Almacen
$AA = $_GET['AA']; 			// Ejercicio
$MM = $_GET['PER']; 		// Año del Periodo
//---------------------------------------------------------------
//---------------------------------------------------------------
//	$SQLp = "SELECT * FROM wh_periodos WHERE per_id = '$PER' ";
//	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
//	while ($Filap=mysqli_fetch_array($Registrop))
//	{	
//		$AA = $Filap["per_aa"];
//		$MM = $Filap["per_mm"];
//		$AA2 = $Filap["per_aa"];
//	}
//	mysqli_free_result ($Registrop);
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
$totale1XG = 0;
//---------------------------------------------------------------
$query1 = "SELECT co.company, mat.code_sap, mat.code, mat.description_m, um.name as nameum, li.namel, 
mat.type_material_m, tm2.name as nametm2, tm2.name as namecl2, mat.cost_me, sal.saldos_fp,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
FROM wh_materials mat
inner join companies co on co.id = mat.company_id
left join wh_measurement_units um on um.id = mat.wh_measurement_unit_id_m
left join wh_lines li on li.id = mat.wh_line_id_m
left join wh_type_material2 tm2 on tm2.id = mat.type_tm2_id
left join wh_clasificacion_tm2  cla on cla.id = mat.clas_tm2_id
inner join wh_saldosm sal on sal.product_id = mat.id
where sal.aa_s = '$AA' and mat.zone_id = '$ZON' and mat.company_id = '$CIA'
ORDER BY mat.company_id ASC, mat.code ASC
";
//---------------------------------------------------------------

echo "<font size='5'><b>Consolidado de Materiales</b></font>";
echo "<br>";
echo "<font size='4'><b>$DCIA</b></font>";
echo "<br>";
echo "<font size='3'><b>ALMACEN:</b></font>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<font size='4px'><b>$ZOND</b></font>";
echo "<br>";
echo "<font size='3'><b>PERIODO:</b></font>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<font size='4px'><b>$AA</b></font>";
echo "<font size='4px'><b>/</b></font>";
echo "<font size='4px'><b>$MM</b></font>";
echo "<br>";

$totale1X = 0;
//=======================================================
$Registro1 = mysqli_query($link,$query1);			
while($row1 = mysqli_fetch_array($Registro1))
{
	$cost = $row1["cost_me"];

	if ($MM == '1'){$TMX = $row1["ENE"]; }
	if ($MM == '2'){$TMX = $row1["FEB"]; }
	if ($MM == '3'){$TMX = $row1["MAR"]; }
	if ($MM == '4'){$TMX = $row1["ABR"]; }
	if ($MM == '5'){$TMX = $row1["MAY"]; }
	if ($MM == '6'){$TMX = $row1["JUN"]; }
	if ($MM == '7'){$TMX = $row1["JUL"]; }
	if ($MM == '8'){$TMX = $row1["AGO"]; }
	if ($MM == '9'){$TMX = $row1["SEP"]; }
	if ($MM == '10'){$TMX = $row1["OCT"]; }
	if ($MM == '11'){$TMX = $row1["NOV"]; }
	if ($MM == '12'){$TMX = $row1["DIC"]; }

	$totale1X = $TMX * $cost;
	$totale1XG = $totale1XG + $totale1X;

} mysqli_free_result ($Registro1);
//======================================================= 
?>
	<div class="col-lg-12" align = "right">
			<div class="form-group">
				&nbsp;&nbsp;<span><b><font size="4px">
				<?php echo number_format($totale1XG, 3, ',','.');?>
				</font></b></span>
			</div>
	</div>	
<?php
echo "<Table cellspacing='0' cellpadding='0' border color= 000000>";
//-------------------------------
echo "<tr>";
echo "<th>CODIGO</th>";
echo "<th>DESCRIPCION</th>";
echo "<th>UNI-MED</th>";
echo "<th>LINEA</th>";
echo "<th>TIPO</th>";
echo "<th>TIPO INV</th>";
echo "<th>CLASIFICACION</th>";
echo "<th>COSTO/UNITARIO ME</th>";
echo "<th>EXISTENCIA</th>";
echo "<th>TOTAL ME</th>";
echo "</tr>";

//=======================================================
$totale = 0;
$Registro2 = mysqli_query($link,$query1);			
while($row2 = mysqli_fetch_array($Registro2))
{
	$cost = $row2["cost_me"];

	if ($MM == '1'){$TMX = $row2["ENE"]; }
	if ($MM == '2'){$TMX = $row2["FEB"]; }
	if ($MM == '3'){$TMX = $row2["MAR"]; }
	if ($MM == '4'){$TMX = $row2["ABR"]; }
	if ($MM == '5'){$TMX = $row2["MAY"]; }
	if ($MM == '6'){$TMX = $row2["JUN"]; }
	if ($MM == '7'){$TMX = $row2["JUL"]; }
	if ($MM == '8'){$TMX = $row2["AGO"]; }
	if ($MM == '9'){$TMX = $row2["SEP"]; }
	if ($MM == '10'){$TMX = $row2["OCT"]; }
	if ($MM == '11'){$TMX = $row2["NOV"]; }
	if ($MM == '12'){$TMX = $row2["DIC"]; }

	$totale = $TMX * $cost;
//======================================================= 
if ($TMX != 0) {
?>
	<Tr height= '16px'>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['code_sap']; ?></font></td>
	<Td bgcolor='#FFFFFF'><span class="text-wrap"><font size="2px"><?php echo $row2['description_m']; ?></font></span></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['nameum'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['namel'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['type_material_m'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['nametm2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $row2['namecl2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo number_format($row2['cost_me'], 3, ',','.');?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $TMX;?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo number_format($totale, 3, ',','.');?></font></td>
	</tr>

<?php
}
}
mysqli_free_result ($Registro2);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 