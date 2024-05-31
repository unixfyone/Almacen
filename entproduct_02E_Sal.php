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
include('unico_1.php');
?>

<HTML>
<HEAD>
	<title>Repuestos</title>
	
	<link rel="stylesheet" type="text/css" href="cssi/styles.css" />
	
<style>
p {
    margin-top: 0em;
    margin-bottom: 0em;
	height: 20px;
}
.form-control {
	border: #<?=$ccolor;?>; 
	border-style: solid; 
	border-top-width: 0px; 
	border-right-width: 2px; 
	border-bottom-width: 1px; 
	border-left-width: 0px; 
}
.form-control:focus {
  border-color: #<?=$ccolor2;?>;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
</style>

<style type="text/css">
table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #005266;
	color: white;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}

input[type=text2], input[type=date] {
  font-size: 16px;
  color: #990000;
}
</style>
<style type="text/css">
p {
    margin-top: 0em;
    margin-bottom: 0em;
	height: 12px;
}

table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #<?=$ccolor;?>;
	color: white;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}

.w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}

input[type=text2], input[type=date] {
  font-size: 16px;
  color: #000000;
}
</style>
<style type="text/css">

.dataTables_filter{text-align:right}

.dataTables_filter label {
  font-weight: normal;
  white-space: nowrap;
  text-align: left;
}

.dataTables_filter input {
  margin-left: 0.5em;
  display: inline-block;
  width: auto;
}

.dataTables_length label {  font-weight:  normal; text-align: left;   white-space: nowrap;}
dataTables_length select {  width: auto;  display: inline-block;}

.btn-xs, .btn-group-xs > .btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.btn-warning {
    color: #ffffff;
    background-color: #dd5600;
    border-color: #dd5600;
}
.border {
    border: 1px solid #<?=$ccolor;?>;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
    box-shadow: none;
}
.btn-success {
    color: #fff;
    background-color: #218838;
    border-color: #1e7e34;
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

.navbar-nav .open .dropdown-menu {
    position: static;
    float: none;
    width: auto;
    margin-top: 0;
    background-color: transparent;
    border: 0;
    box-shadow: none;
}
.navbar-nav .open .dropdown-menu > li > a {
    line-height: 20px;
}
.navbar-nav .open .dropdown-menu > li > a, .navbar-nav .open .dropdown-menu .dropdown-header {
    padding: 5px 15px 5px 25px;
}
.dropdown-menu > li > a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333333;
    white-space: nowrap;
}
.dropdown-menu .divider {
    height: 1px;
    margin: 9px 0;
    overflow: hidden;
    background-color: #e5e5e5;
.navbar-nav > li > .dropdown-menu {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
}
.open > .dropdown-menu {
    display: block;
}
.dropdown-menu-right {
    left: auto;
    right: 0;
}
.dropdown-menu {
    top: 100%;
    left: 0;
    z-index: 1000;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    font-size: 14px;
    text-align: left;
    border-radius: 4px;
    background-clip: padding-box;
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
if(isset($_GET["TE"]))$mdtipent = $_GET["TE"];
else $mdtipent = '';
if(isset($_GET["TS"]))$mdtipsal = $_GET["TS"];
else $mdtipsal = '';
if(isset($_GET["CD"]))$CID = $_GET["CD"];
else $CID = '';
//-------------
$dmov = $_GET['DE'];			// Descripcion del Movimiento
$mdcant = $_GET['CNT'];			// Cantidad del Producto
//$mdcostoue = $_GET['ME'];		// Costo Unitario Producto M Extranjera
//$mdcostoul = $_GET['ML'];		// Costo Unitario Producto M Local
$mdcostoue = $_GET["UNI"];
$tasa = $_GET["TC"];
$rprod = $_GET['REC'];			// Persona que recibe producto
//---------------------------------------------------------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';
//===============================================================
$SQL = "SELECT * FROM wh_movinvh 
Where wh_movinvh.movh_id = '$mhid' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];		// Nro. de Documento
$mhtdoc = $Fila1["movh_tdoc"];		// Tipo de Documento
$mhtmov = $Fila1["movh_tmov"];		// Tipo Movimiento (E/S)
$mhfecha = $Fila1["movh_fecha"];	// Fecha del Documento
$mhejer = $Fila1["movh_ejer"];		// Ejercicio / Año
$mhper = $Fila1["movh_per"];		// Periodo / Mes
$mhproce = $Fila1["movh_proce"];	// Proveedor
}
mysqli_free_result ($Registro1);
//===============================================================
	$SQL = "SELECT * FROM wh_materials Where code = '$prod2' ";
	$Registrop = mysqli_query($link,$SQL);
	//----------------------------------------------------------------
	while($Filap = mysqli_fetch_array($Registrop))
	{
	// Asignar Datos a las variables
	//-------------------------------
	$prodid = $Filap["id"];
	$DESCP= $Filap["description_m"];
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
?>
<Input Type="hidden" name="mdid" value="<?Php echo $mdid ?>">
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="pid" value="<?Php echo $prodid ?>" />
<Input Type="hidden" name="tmid" value="<?Php echo $tmid ?>" />
<Input Type="hidden" name="mhtm" value="<?Php echo $mhtmov ?>" />
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Movimiento Almacen
					</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
				
					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Cancelar</button>

					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="Submit" id="BotonEdit" name="BotonEdit"><span class="fa fa-save"></span> Grabar Cambios</button>
										
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	
	
<div class="container-fluid">	
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-6">
					<div class="row">
						<b><font color="#990000" FACE="times new roman" size="4px">Movimientos de Productos.: </font></b>
                        <b><font color="blue" FACE="times new roman" size="4px">&nbsp; Modificar Renglon</font></b>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
<!-- =================================================================================== -->			

				<!-- =========================== -->
				<div class="form-group">
					<label><font color="#990000" FACE="times new roman" size="2px">Almacen..:  </font></label>
					&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
					<br>
				</div>
				<!-- =========================== -->
				<table border="1" width="100%">
				<thead><tr>
					<th><p style='text-align:center'>Nro. Documento</p></th>
					<th><p style='text-align:center'>Tipo Documento</p></th>
					<th><p style='text-align:center'>T.M.</p></th>
					<th><p style='text-align:center'>Fecha Doc.</p></th>
					<th><p style='text-align:center'>Ejercicio</p></th>
					<th><p style='text-align:center'>Periodo</p></th>
				</tr></thead>
				<tr>
					<td><b><input class="form-control elevation-2" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
					<td><b><input class="form-control elevation-2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
					<td><b><input class="form-control elevation-2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
					<td><input class="form-control elevation-2" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
					<td><input class="form-control elevation-2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' maxlength="4" value="<?Php echo $mhejer; ?>" readonly></td>
					<td><input class="form-control elevation-2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
				</tr>
				</table>
				<br>
<!--  ======================================================================================= -->
				<div class="container-fluid">
					
					<div class="form-group">
					
						<label><font color="blue" FACE="times new roman" size="3px">Datos del Producto...:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $prod2 ?></font>
						<label class="control-label"><font color="blue" FACE="times new roman" size="3px">--</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $DESCP ?></font>
						<br>

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Movimiento..:</font></span>
									<select class="form-control" name="tmid" onChange="javascrip:form.submit()">
										<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>							
										<?php
										//---------------------------------------------------------------
										$SQLtm="Select * From wh_tipmov where tm_tipo = '$mhtmov ' and tm_statu = 'Activo' ORDER BY tm_id";
										$RegistroTM=mysqli_query($link,$SQLtm);
										//-------
										while ($FilaTM=mysqli_fetch_array($RegistroTM)){
										//-------
										echo '<option ';
										if($tmid == $FilaTM["tm_id"])echo 'selected ';
										echo 'value=' . $FilaTM["tm_id"] .'>'. $FilaTM["tm_desc"] . "\n";
										}
										mysqli_free_result ($RegistroTM);
										//---------------------------------------------------------------
										?>									
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-10">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Descripción Renglon.:</font></span>
									<Input class="form-control" Type="Text" name="dmov" size="100" maxlength="200" value="<?Php echo $DESCP ?>" required />
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Cantidad de Material.:</font></span>
									<Input class="form-control" Type="Text" name="CANT" size='8' maxlength="8" value="<?Php echo $mdcant ?>" required />
								</div>
							</div>
						</div>
						<div class="row">
							<?Php if($mhtmov == 'Entradas'){ ?>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Unitario Moneda Extranjera:</font></span>
									<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $mdcostoue ?>" required />
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tasa de Cambio Bs:</font></span>
									<Input class="form-control" Type="Text" name="tasa" size='12' maxlength="12" value="<?Php echo $tasa ?>" required />
								</div>
							</div>							
							<?Php } ?>
						</div>
						
						<div class="row">
							<?Php if($mhtmov == 'Entradas'){ ?>
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Entrada Material:</font></span>
									<select name="tipent" id="tipent" class="form-control" required />
									<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
									<?php
									  echo '<option ';
										if($mdtipent == 'Nacional') echo 'selected ';
									  echo 'value=' . 'Nacional' .'>'. 'Nacional' . "\n";
										echo '<option ';
										if($mdtipent == 'Internacional') echo 'selected ';
									  echo 'value=' . 'Internacional' .'>'. 'Internacional' . "\n";
										echo '<option ';
										if($mdtipent == 'Transferencia') echo 'selected ';
									  echo 'value=' . 'Transferencia' .'>'. 'Transferencia' . "\n";
										echo '<option ';
										if($mdtipent == 'Inv-Inicial') echo 'selected ';
									  echo 'value=' . 'Inv-Inicial' .'>'. 'Inv-Inicial' . "\n";										  
									?>
									</select>
								</div>
							</div>
							<Input Type="hidden" name="tipsal" />
							<?Php } else { ?>
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Salida Material..:</font></span>
									<select name="tipsal" id="tipsal" class="form-control" required />
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
									<Input Type="hidden" name="tipent" />
								</div>
							</div>
							<?Php } ?>							
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Condicion del Material...:</font></span>
									<select name="c_id" class="form-control" required >
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
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Despachador / Receptor..:</font></span>
									<Input class="form-control" Type="Text" name="rec" size="30" maxlength="45" value="<?Php echo $rprod ?>" required />
								</div>
							</div>
						</div>

						<br><br>
					</div>
    			</div>
			</div>
<!-- =================================================================================== -->	
		</div>
	</div>
</div>

</form>
<!--  ======================================================================================= -->

<?php mysqli_close($link); ?>
</BODY>
</HTML> 