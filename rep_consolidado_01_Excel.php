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

								//----------------------------
								$RegistroX2 = mysqli_query($link,$SQL);
								while($FilaX2 = mysqli_fetch_array($RegistroX2))
								{
								$mValore1X = '';
								$mValors1X= '';
								$mValorfp1X = '';
								$prodid2X = $FilaX2["matid"];
								
								$query = "SELECT * FROM wh_saldosm 
								WHERE product_id = '$prodid2X' and aa_s = '$AA' and zone_id = '$ZON' ";	
										
									$Registro1X = mysqli_query($link,$query);			
									while($row1X = mysqli_fetch_array($Registro1X))
									{
										$existencia1X = 0;
									//=======================================================
										$MM_ANT = $MM - 1; 		// Mes periodo actual en arreglo (12 Pos)
										$MM_PANT = $MM - 1;		// Mes para Saldo del Periodo anterior (13 Pos)
										
										$mValore=explode("|", $row1X["saldos_e"]);
										$exe1x = $mValore[$MM_ANT];

										$mValors=explode("|", $row1X["saldos_s"]);
										$exs1x = $mValors[$MM_ANT];

										$mValorfp=explode("|", $row1X["saldos_fp"]);
										$expa1x = $mValorfp[$MM_PANT];

										$existencia1X = ((int)$expa1x + (int)$exe1x - (int)$exs1x );
									
										$totale1X = $existencia1X * $FilaX2["cost_me"];
										$totale1XG = $totale1XG + ($existencia1X * $FilaX2["cost_me"]);
									}	

								} mysqli_free_result ($RegistroX2);
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

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
	$status = '';
	$accion = '';
	$btnVer = '';
	$total = '0';
	$COSTO = '0';
	$prodid2 = $Fila["matid"];
	//----------------------------
	$mValore = '';
	$mValors = '';
	$mValorfp = '';
	//----------------------------
	$query = "SELECT * FROM wh_saldosm 
	WHERE product_id = '$prodid2' and aa_s = '$AA' and zone_id = '$ZON' ";
	$Registro3 = mysqli_query($link,$query);			
	while($row3 = mysqli_fetch_array($Registro3))
	{
		//$CTA2 = $row3['Cuenta1'];
		//=======================================================
		if ($row3['sal_id'] != '0') 
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
		//$existencia = $expa + $exe - $exs;
		$existencia = ((int)$expa + (int)$exe - (int)$exs );

		//$COSTO = ((float)$Fila["cost_me"] );

		$totale = $existencia * $Fila["cost_me"];
	//=======================================================
	if ($existencia != 0) {
?>	

	<Tr height= '16px'>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['code_sap']; ?></font></td>
	<Td bgcolor='#FFFFFF'><span class="text-wrap"><font size="2px"><?php echo $Fila['description_m']; ?></font></span></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['nameum'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['namel'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['type_material_m'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['nametm2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $Fila['namecl2'];?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo number_format($Fila['cost_me'], 3, ',','.');?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo $existencia;?></font></td>
	<Td bgcolor='#FFFFFF'><font size="2px"><?php echo number_format($totale, 3, ',','.');?></font></td>
	</tr>

<?php
}
}
mysqli_free_result ($Registro);
echo "</Table>";
?>
</FORM>
</div>
</BODY>
</HTML> 