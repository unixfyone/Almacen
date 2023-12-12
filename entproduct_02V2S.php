<?php
//entproduct.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

if($_SESSION['type'] != 'Master')
{
	header("location:index2.php");
}
include('headerx.php');
include('unico.php');
?>

	<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
	<link rel="stylesheet" href="cssi/styles.css">
	<link rel="stylesheet" href="css/styles-wh.css">

<style type="text/css">
.form-controlX2 {
	background-color: #e9ecef;
	border: #<?=$ccolor;?>; 
	border-style: solid; 
	border-top-width: 0px; 
	border-right-width: 2px; 
	border-bottom-width: 1px; 
	border-left-width: 0px; 
}	
.form-control2 {
  display: block;
  width: 100%;
  height: 38px;
  padding: 8px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #e9ecef;
  background-image: none;
  border: #<?=$ccolor;?>;
  border-radius: 4px;
  	border-style: solid; 
	border-top-width: 0px; 
	border-right-width: 2px; 
	border-bottom-width: 1px; 
	border-left-width: 0px; 
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control2:focus {
  border-color: #<?=$ccolor2;?>;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
.form-control {
	border: #a6a6a6; 
	border-style: solid; 
	border-top-width: 1px; 
	border-right-width: 2px; 
	border-bottom-width: 2px; 
	border-left-width: 1px; 
}
.form-control:focus {
	border: #a6a6a6; 
	border-style: solid; 
	border-top-width: 1px; 
	border-right-width: 2px; 
	border-bottom-width: 3px; 
	border-left-width: 1px;
}
th {
    color: white;
	font-size:14px;
	background-color:#<?=$ccolor;?>;
	}

table, th, td {
    border: 1px solid #a6a6a6;
    border-collapse: collapse;
}

.border {
    border: 1px solid #<?=$ccolor;?>;
}

table.border, td.border {border: 0px;}
btn-prima {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
    border-color: #<?=$ccolor;?>;
}
.btn-prima:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
    border-color: #<?=$ccolor;?>;
}

.butt-mesas {
	background: transparent;
	-moz-border-radius: 4;
	border-radius: 4px;
	border: solid #<?=$ccolor;?> 1px;
	font-family: Arial;
	color: #909090;
	font-size: 15px;
	line-height: 18px;
	text-align: center;
	width: 42px;
	height: 25px;
	border-color: #<?=$ccolor;?>;
}

.dropdown-menu > li > a:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
}

.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}
</style>
<?php

echo '<FORM name="" ACTION="" method="">';
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["movd_id"]))$IDM = $_GET["movd_id"];
else $IDM = $_GET["IDM2"];
//---------------------------------------------------------------
if(isset($_GET["prod2"]))$prod2 = $_GET["prod2"];
else $prod2 = '';
//--------------
if(isset($_GET["prod"]))$prod = $_GET["prod"];
else $prod = '';
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["tmcod"]))$tmcod = $_GET["tmcod"];
else $tmcod = '';
if(isset($_GET["dmov"]))$dmov = $_GET["dmov"];
else $dmov = '';
if(isset($_GET["CANT"]))$mdcant = $_GET["CANT"];
else $mdcant = '0';
if(isset($_GET["CUNIME"]))$mdcostoue = $_GET["CUNIME"];
else $mdcostoue = '0';
if(isset($_GET["TASA"]))$tasa = $_GET["TASA"];
else $tasa = '0';
if(isset($_GET["rec"]))$rprod = $_GET["rec"];
else $rprod = '';

if(isset($_GET["tmtipo"]))$tmtipo = $_GET["tmtipo"];
else $tmtipo = '';
if(isset($_GET["mdtipent"]))$mdtipent = $_GET["mdtipent"];
else $mdtipent = '';
if(isset($_GET["mdtipsal"]))$mdtipsal = $_GET["mdtipsal"];
else $mdtipsal = '';
if(isset($_GET["CID"]))$CID = $_GET["CID"];
else $CID = '';
if(isset($_GET["CONDI"]))$CONDI = $_GET["CONDI"];
else $CONDI = '';
//-------------
if(isset($_GET["trans"]))$trans = $_GET["trans"];
else $trans = '';
if(isset($_GET["movd_id_cons"]))$idconsumo = $_GET["movd_id_cons"];
else $idconsumo = '';
if(isset($_GET["obs"]))$movd_obs = $_GET["obs"];
else $movd_obs = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//===============================================================

$SQL = "SELECT * FROM wh_movinvd 
INNER JOIN wh_movinvh ON wh_movinvh.movh_id = wh_movinvd.movh_id
INNER JOIN wh_conditions ON wh_conditions.c_id = wh_movinvd.movd_cond
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
Where wh_movinvd.movd_id = '$IDM' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];			// Id de Documento
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];		// Nro. de Documento
//$mhtdoc = $Fila1["movh_tdoc"];		// Tipo de Documento
$mhtdoc = $Fila1["tm_desc"]; 
$mhtmov = $Fila1["movh_tmov"];		// Tipo Movimiento (E/S)
$mhfecha = $Fila1["movh_fecha"];	// Fecha del Documento
$mhejer = $Fila1["movh_ejer"];		// Ejercicio / Año
$mhper = $Fila1["movh_per"];		// Periodo / Mes
$mhproce = $Fila1["movh_proce"];	// Procedencia
if ($CT1 == '0') {
$mdid = $Fila1["movd_id"];			// ID de Detalle
$tmcod = $Fila1["tm_id"];			// ID Tipo de Movimiento
$tmtipo = $Fila1["movd_tmov"];		// Tipo de Movimiento
$prod = $Fila1["product_id"];		// Codigo de Producto
$prod2 = $Fila1["product_cod"];		// Codigo de Producto
$mdcant = $Fila1["movd_cant"];		// Cantidad Producto
$mdcostoue = $Fila1["movd_costou_me"];	// Costo Unitario Producto moneda Extranjera
$tasa  = $Fila1["movd_tasa_cambio"];
$mdtipent = $Fila1["movd_tipent"];	// Tipo de Entrada
$mdtipsal = $Fila1["movd_tipsal"];	// Tipo de Salida
$CID = $Fila1["c_id"];				// ID Condidion del Material
$CONDI = $Fila1["c_description"];	// Condidion del Material
$dmov = $Fila1["movd_desc"];		// Descripcion del Movimiento
$rprod = $Fila1["movd_recprod"];	// Persona que recibe producto
$trans = $Fila1["movd_trans"];
$idconsumo = $Fila1["movd_id_cons"];
$movd_obs = $Fila1["movd_obs"];
} 
}
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------

//===============================================================
	$SQL = "SELECT * FROM wh_materials 
	INNER JOIN wh_measurement_units ON wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
	Where code = '$prod2' and zone_id = '$ZON' ";
	$Registrop = mysqli_query($link,$SQL);
	//----------------------------------------------------------------
	while($Filap = mysqli_fetch_array($Registrop))
	{
	// Asignar Datos a las variables
	//-------------------------------
	$DESCP= $Filap["description_m"];
	$PRODP = $Filap["cost_me"];
	$UNIM = $Filap["name"];
	}
	mysqli_free_result ($Registrop);
//===============================================================
	$SQLtm="Select * From wh_tipmov where tm_id = '$tmcod' ";
	$RegistroTM=mysqli_query($link,$SQLtm);
	//----------------------------------------------------------------
	while ($FilaTM=mysqli_fetch_array($RegistroTM))
	{
	$DESCTM= $FilaTM["tm_desc"];
	}
	mysqli_free_result ($RegistroTM);
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
$CIA = $FilaA["zcompany_id"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
$MM = $mhper;
$MM_ANT = $MM - 1; 				// Mes periodo actual en arreglo (12 Pos)
$MM_PANT = $MM - 1;				// Mes para Saldo del Periodo anterior (13 Pos)
$existencia = 0;
//------------------
$SQL = "SELECT * FROM wh_saldosm
Where product_cod = '$prod2' and zone_id = '$ZON' and company_id = '$CIA' and aa_s = '$mhejer' 
";
$Registro = mysqli_query($link,$SQL);
//-----------------------------
while ($row=mysqli_fetch_array($Registro))
{
	if($row['sal_id'] != null)
	{
		$mValore = '';
		$mValors = '';
		$mValorfp = '';
		
		$mValore=explode("|", $row["saldos_e"]);
		$exe = $mValore[$MM_ANT];

		$mValors=explode("|", $row["saldos_s"]);
		$exs = $mValors[$MM_ANT];

		$mValorfp=explode("|", $row["saldos_fp"]);
		$expa = $mValorfp[$MM_PANT];
	
	}	else	{
		$exe = 0;
		$exs = 0;
		$expa = 0;
	}
	$existencia = $expa + $exe - $exs;
}
mysqli_free_result ($Registro);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />
<Input Type="hidden" name="IDM2" value="<?Php echo $IDM ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="prod" value="<?Php echo $prod ?>">
<Input Type="hidden" name="prodid" value="<?Php echo $prodid ?>">
<Input Type="hidden" name="tmcod" value="<?Php echo $tmcod ?>" />
<Input Type="hidden" name="tmtipo" value="<?Php echo $tmtipo ?>" />
<Input Type="hidden" name="CID" value="<?Php echo $CID ?>" />

<Input Type="hidden" name="trans" value="<?Php echo $trans ?>" />
<Input Type="hidden" name="movd_id_cons" value="<?Php echo $idconsumo ?>" />
<Input Type="hidden" name="obs" value="<?Php echo $movd_obs ?>" />

<div class="content-wrapper">
	<section class="content">
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" size="4px">Agregar Documento Movimientos Almacen</font></b>
						</div>
						<!-- /.card-header -->			
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Compañia..:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $DCIA ; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacen..:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Tipo Documento..:  </font></label>
											&nbsp;&nbsp;<span><b><font color="red" size="4px"> <?Php echo $mhtmov; ?></font></b></span>
										</div>
									</div>								
								</div>
								<!-- =========================== -->			
								<table border="1" width="100%">
								<thead><tr>
									<th class="thx"><p>Nro. Documento</p></th>
									<th class="thx"><p>Tipo Documento</p></th>
									<th class="thx"><p>T.M.</p></th>
									<th class="thx"><p>Fecha Doc.</p></th>
									<th class="thx"><p>Ejercicio</p></th>
									<th class="thx"><p>Periodo</p></th>
								</tr></thead>
								<tr>
									<td><b><input class="form-control2" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
									<td><b><input class="form-control2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
									<td><b><input class="form-control2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
									<td><input class="form-control2" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
									<td><input class="form-control2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' value="<?Php echo $mhejer; ?>" readonly></td>
									<td><input class="form-control2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
								</tr>
								</table>
							</div>
						</div>
						<!--================================================== -->			
						<div class="container-fluid">	
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default">
										<div class="container-fluid">

											<label><font color="blue" size="3px">Datos del Material...:</font></label>
											&nbsp;&nbsp;
											<font color='black' size="3px"><?Php echo $prod2 ?></font>
											<label class="control-label"><font color="blue" size="3px">--</font></label>
											<font color='black' size="3px"><?Php echo $DESCP ?></font>

											<div class="row">
												<div class="col-lg-11">
													<div class="input-group">
														<label class="input-group-text"><font color="blue" size="3px">Unidad de Medida.:</font></label>
														<label class="input-group-text"><font color="#990000" size="3px"><?Php echo $UNIM ?></font></label>												
														&nbsp;&nbsp;
														<label class="input-group-text"><font color="blue" size="3px">Existencia:</font></label>
														<label class="input-group-text"><font color="#990000" size="3px"><?Php echo number_format($existencia, 2, '.', '') ?></font></label>
															
														&nbsp;&nbsp;
														<label class="input-group-text"><font color="blue" size="3px">Ultimo Costo:</font></label>
														<label class="input-group-text"><font color="#990000" size="3px"><?Php echo $PRODP ?></font></label>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-8">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Descripción Renglon.:</font></label>
														<Input class="form-control" Type="Text" name="dmov" maxlength="200" size="100" value="<?Php echo $dmov ?>" readonly>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Cantidad de Material.:</font></label>
														<Input class="form-control" Type="Text" name="CANT" size='8' value="<?Php echo $mdcant ?>" readonly></font>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Costo Unitario Moneda Ext:</font></label>
														<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $mdcostoue ?>" readonly />
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tasa de Cambio Bs:</font></label>
														<Input class="form-control" Type="Text" name="TASA" size='12' maxlength="12" value="<?Php echo $tasa ?>" readonly />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tipo Salida Material..:</font></label>
														<Input class="form-control" Type="Text" name="mdtipsal" size="40" value="<?Php echo $mdtipsal ?>" readonly>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Condicion del Material...:</font></label>
														<Input class="form-control" Type="Text" name="CONDI" value="<?Php echo $CONDI ?>" readonly>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tipo Transacción:</font></label>
														<Input class="form-control" Type="Text" name="movd_trans" value="<?Php echo $trans ?>" readonly>
													</div>
												</div>
											</div>											
											<div class="row">
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Nombre Consumo.....:</font></label>
														<?php
														$query = "SELECT * FROM wh_consumos 
														WHERE statu_cons = 'Activo'
														";
															
														$Registro=mysqli_query($link,$query);
														//-------
														while ($row=mysqli_fetch_array($Registro))
														{
														$idconsumo= $row["id_cons"];
														$nconsumo= $row["name_cons"];
														}
														mysqli_free_result ($Registro);										
														?>
														<Input class="form-control" Type="Text" name="nconsumo" value="<?Php echo $nconsumo ?>" readonly>
													</div>
												</div>
											</div> 																
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Observacion Salida...:</font></label>
														<Input class="form-control" Type="Text" name="obs" value="<?Php echo $movd_obs ?>" readonly>
													</div>
												</div>
											</div>											
											<br>
											<!-- ==================================================== -->
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-text"><b><font color="#cc3300">Cambiar Material Renglon:</font></b></span>
															<b><input class="form-control" type="text" name="prod" size="20" maxlength="45" value="" placeholder="Palabra de busqueda" ></b>
															<span class="input-group-btn">
															<button class="btn btn-default" name="boton1" type="bottom"><i class="w3-margin-left fa fa-search"> Buscar</i></button></span>
														</div>
													</div>
												</div>
												
												<div class="col-sm-6" align="right">
													<?php
													echo "<a type='button' class='btn btn-outline-<?php echo $classButtonFooter;?> btn-xs elevation-1' href=\"entproduct_02EV2S.php?IDM=$IDM&IDH=$mhid&CP=$prod2&TMC=$tmcod&CNT=$mdcant&UNI=$mdcostoue&TC=$tasa&REC=$rprod&TS=$mdtipsal&CD=$CID&DE=$dmov&TT=$trans&TCON=$idconsumo&OBS=$movd_obs \"><i class='fa fa-edit'></i> Editar Renglon</a>";
													?> &nbsp;&nbsp;&nbsp;&nbsp;
													<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-xs elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
												</div>											
											</div>
										</div>
										<HR style="border-color:#cccccc;">
									</div>		
								</div>			
							</div>				
						</div>
						<div class="container-fluid">
							<?php
							//**************************************************
							if (isset($_GET["boton1"])  and $_GET["prod"] != '')
							{
							//---------------------------------------------------------------
							$aKeyword = explode(" ", $_GET['prod']);
							$SQL ="SELECT * FROM wh_materials 
							INNER JOIN wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
							WHERE wh_materials.zone_id = '$ZON' and 
							wh_materials.company_id = '$CIA' and 
							wh_materials.m_statu_m = 'Activo' and
							wh_materials.code like '%" . $aKeyword[0] . "%' or 
							
							wh_materials.zone_id = '$ZON' and 
							wh_materials.company_id = '$CIA' and 
							wh_materials.m_statu_m = 'Activo' and										
							wh_materials.description_m like '%" . $aKeyword[0] . "%' OR
							
							wh_materials.zone_id = '$ZON' and 
							wh_materials.company_id = '$CIA' and 
							wh_materials.m_statu_m = 'Activo' and									
							wh_categories.category like '%" . $aKeyword[0] . "%'
							";
							//---------------------------------------------------------------
							//echo "<br>";

							echo "<b><font color='#0066FF' FACE='times new roman' size='4px'>Lista de Materiales</font></b>";
							echo "<Table class='table-hover' border='1' width='100%'>";
							//-----------------------------
							echo "<TR>";
							echo "<TH><p style='text-align:center'>" . "Codigo";
							echo "<TH><p style='text-align:Left'>" . "Descripción";
							echo "<TH><p style='text-align:center'>" . "Categoria";
							echo "<TH><p style='text-align:center'>" . "Status";

							$Registro2 = mysqli_query($link,$SQL);
							while($Fila = mysqli_fetch_array($Registro2))
							{
							//=============================
							if($Fila['m_statu_m'] == 'Activo')
							{
								$status = '<span class=""><font color="blue" size="3px">Activo</font></span>';
							}	else	{
								$status = '<span class=""><font color="red" size="3px">Inactivo</font></span>';
							}
							//=============================
							$GRPXD = '';
							$prodid = $Fila["id"];
							$prod2X = $Fila["code"];
							$GRPXD =  $Fila["category"];
							//=============================
							echo "<Tr>";
							//-------
							if($Fila['m_statu_m'] != 'Activo')
							{
							echo "<Td Align=Left><font size=2>" . $Fila['code'];	
							}	else	{	
							echo "<td><a href=\"entproduct_02EV2S.php?IDM=$IDM&IDH=$mhid&CP=$prod2X&TMC=$tmcod&DE=$dmov&CNT=$mdcant&UNI=$mdcostoue&TC=$tasa&REC=$rprod&TS=$mdtipsal&CD=$CID&TT=$trans&TCON=$idconsumo&OBS=$movd_obs \">$prod2X</a></td>"; 
							}
							echo "<Td Align=Left><span class=text-wrap><font size=2>" . $Fila['description_m'];
							echo "<Td Align=Center><font size=2>" . $GRPXD;
							echo "<Td Align=Center><font size=2>" . $status;
							echo "</TR>";
							//---------------
							}
							//---------------
							mysqli_free_result ($Registro2);

							echo "</Table>";
							//---------------
							?>

							</FORM>
							<br><br>

							<?php } ?>
						<!-- ======================================= -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
	<!-- ======================================= -->
<?php
//-------------------------------------------------------
mysqli_close($link);
//include('footer.php');
//----------------------------------------------------------------
?>