<?php

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

<HTML>
<HEAD>
	<title>Materiales</title>
	
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
</HEAD>
<BODY bgcolor=#FFFFFF>

<?php

echo '<FORM ACTION="act_salpro_edit.php" method="POST">';

//--------------
//---------------------------------------------------------------
$mdid = $_GET['IDM'];			// Id del Renglon
$mhid = $_GET['IDH'];			// Id del Documento Cabezera
$prod2 = $_GET['CP'];			// Codigo de Producto
//--------------
if(isset($_GET["TMC"]))$tmid = $_GET["TMC"];	
else $tmid = '0';								// Codigo Tipo de Movimiento
//--------------
if(isset($_GET["TS"]))$mdtipsal = $_GET["TS"];
else $mdtipsal = '';
if(isset($_GET["CD"]))$CID = $_GET["CD"];
else $CID = '';
//-------------
$dmov = $_GET['DE'];			// Descripcion del Movimiento
$mdcant = $_GET['CNT'];			// Cantidad del Producto
$mdcostoue = $_GET["UNI"];
$tasa = $_GET["TC"];
if(isset($_GET["TT"]))$trans = $_GET["TT"];
else $trans = '';
$idconsumo = $_GET['TCON'];
$OBS = $_GET['OBS'];			
//---------------------------------------------------------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';
//===============================================================
$SQL = "SELECT * FROM wh_movinvh
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
Where wh_movinvh.movh_id = '$mhid' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];		// Nro. de Documento
//$mhtdoc = $Fila1["movh_tdoc"];		// Tipo de Documento
$mhtdoc = $Fila1["tm_desc"];
$mhtmov = $Fila1["movh_tmov"];		// Tipo Movimiento (E/S)
$mhfecha = $Fila1["movh_fecha"];	// Fecha del Documento
$mhejer = $Fila1["movh_ejer"];		// Ejercicio / Año
$mhper = $Fila1["movh_per"];		// Periodo / Mes
$mhproce = $Fila1["movh_proce"];	// Proveedor	
}
mysqli_free_result ($Registro1);
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
	$prodid = $Filap["id"];
	$DESCP= $Filap["description_m"];
	$PRODP = $Filap["cost_me"];
	$UNIM = $Filap["name"];
	}
	mysqli_free_result ($Registrop);
//===============================================================
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
//===============================================================
	$SQLtm="Select * From wh_tipmov where tm_id = '$tmid' ";
	$RegistroTM=mysqli_query($link,$SQLtm);
	//----------------------------------------------------------------
	while ($FilaTM=mysqli_fetch_array($RegistroTM))
	{
	$DESCTM= $FilaTM["tm_desc"];
	}
	mysqli_free_result ($RegistroTM);
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
<Input Type="hidden" name="mdid" value="<?Php echo $mdid ?>">
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="pid" value="<?Php echo $prodid ?>" />
<Input Type="hidden" name="tmid" value="<?Php echo $tmid ?>" />
<Input Type="hidden" name="mhtm" value="<?Php echo $mhtmov ?>" />

<Input Type="hidden" name="TCON" value="<?Php echo $idconsumo ?>" />
<Input Type="hidden" name="OBS" value="<?Php echo $OBS ?>" />
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<div class="content-wrapper">
	<section class="content">
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
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
							<div class="form-group">
								<label><font color="blue" size="3px">Datos del Producto...:</font></label>
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
									<div class="col-lg-10">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Descripción Renglon.:</font></label>
											<Input class="form-control" Type="Text" name="dmov" size="100" maxlength="200" value="<?Php echo $DESCP ?>" readonly />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-5">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Cantidad de Material.:</font></label>
											<Input class="form-control" Type="Text" name="CANT" size='8' maxlength="8" value="<?Php echo $mdcant ?>" required />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-5">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Costo Unitario Moneda Ext:</font></label>
											<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $mdcostoue ?>" required />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Tasa de Cambio Bs:</font></label>
											<Input class="form-control" Type="Text" name="tasa" size='12' maxlength="12" value="<?Php echo $tasa ?>" required />
										</div>
									</div>							
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Tipo Salida Material..:</font></label>
											<select name="mdtipsal" id="mdtipsal" class="form-control" required />
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?php
											  echo '<option ';
												if($mdtipsal == 'Equipo') echo 'selected ';
											  echo 'value=' . 'Equipo' .'>'. 'Equipo' . "\n";
												echo '<option ';
												if($mdtipsal == 'Interna') echo 'selected ';
											  echo 'value=' . 'Interna' .'>'. 'Interna' . "\n";
												echo '<option ';
												if($mdtipsal == 'Pozo') echo 'selected ';
											  echo 'value=' . 'Pozo' .'>'. 'Pozo' . "\n";						  
											?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Condicion del Material...:</font></label>
											<select name="CONDI" class="form-control" required >
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
										<?PHP
										//---------------------------------------------------------------
										$SQL="SELECT * FROM wh_conditions where c_statu = 'Activo' ORDER BY c_description ASC ";
										$Registro=mysqli_query($link,$SQL);
										//-------
										while ($Fila=mysqli_fetch_array($Registro)){
										//-------
										echo '<option ';
										if($CID == $Fila["c_id"])echo 'selected ';
										echo 'value=' . $Fila["c_id"] .'>'. $Fila["c_description"] . "\n";
										}
										mysqli_free_result ($Registro);
										//---------------------------------------------------------------
										?>
										</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Tipo Transacción:</font></label>
											<select name="movd_trans" id="movd_trans" class="form-control" required />
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?php
											  echo '<option ';
												if($trans == 'N/A') echo 'selected ';
											  echo 'value=' . 'N/A' .'>'. 'N/A' . "\n";
												echo '<option ';
												if($trans == 'INTERNA') echo 'selected ';
											  echo 'value=' . 'INTERNA' .'>'. 'INTERNA' . "\n";
												echo '<option ';
												if($trans == 'PROPIA') echo 'selected ';
											  echo 'value=' . 'PROPIA' .'>'. 'PROPIA' . "\n";
												echo '<option ';
												if($trans == 'PRESTAMO') echo 'selected ';
											  echo 'value=' . 'PRESTAMO' .'>'. 'PRESTAMO' . "\n";
												echo '<option ';
												if($trans == 'NUEVA') echo 'selected ';
											  echo 'value=' . 'NUEVA' .'>'. 'NUEVA' . "\n";											  
											?>
											</select>
										</div>
									</div>
								</div>									
								<div class="row">
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Nombre Consumo.....:</font></label>
											<select name="TCON" id="TCON" class="form-control" required />
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>											
											<?php
											$query = "SELECT * FROM wh_consumos WHERE statu_cons = 'Activo' ";
												
											$Registro=mysqli_query($link,$query);
											//-------
											while ($row=mysqli_fetch_array($Registro)) {
											//-------
											echo '<option ';
											if($idconsumo == $row["id_cons"])echo 'selected ';
											echo 'value=' . $row["id_cons"] .'>'. $row["name_cons"] . "\n";
											}
											mysqli_free_result ($Registro);										
											?>
											</select>
										</div>
									</div>
								</div> 									
	

								<div class="row">
									<div class="col-lg-12">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px">Observacion Salida...:</font></label>
											<Input class="form-control" Type="Text" name="OBS" value="<?Php echo $OBS ?>" >
										</div>
									</div>
								</div>	
											
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Cancelar</button>

									<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="Submit" id="BotonEdit" name="BotonEdit"><span class="fa fa-save"></span> Grabar Cambios</button>
								</div>
							</div>
						</div>
					</div>
    			</div>
			</div>
		</div>
	</section>
</div>

</form>
<!--  ======================================================================================= -->

<?php mysqli_close($link); ?>
</BODY>
</HTML> 