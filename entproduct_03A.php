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
$userid= $_SESSION['user_id'];

include('headerx.php');
include('unico.php');
include('unico_1.php');
?>

<HTML>
<HEAD>
	<title>Repuestos</title>
	
	<link rel="stylesheet" type="text/css" href="cssi/styles.css" />
	<link rel="stylesheet" href="css/styles-wh.css">
	
<style type="text/css">

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
.border {
    border: 1px solid #<?=$ccolor;?>;
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

</HEAD>
<BODY bgcolor=#FFFFFF>

<?php

echo '<FORM ACTION="act_entpro_add.php" method="POST">';

//--------------
//---------------------------------------------------------------
$mhid = $_GET['IDH'];			// Id del Documento Cabezera
$prodid = $_GET['IDP'];			// ID. de Producto
$prod2 = $_GET['CP'];			// Codigo de Producto
//---------------------------------------------------------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';
//===============================================================
$SQL = "SELECT * FROM wh_movinvh where movh_id = '$mhid'";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];
$mhtdoc = $Fila1["movh_tdoc"];
$mhtmov = $Fila1["movh_tmov"];
$mhfecha = $Fila1["movh_fecha"];
$mhejer = $Fila1["movh_ejer"];
$mhper = $Fila1["movh_per"];
$mhproce = $Fila1["movh_proce"];
$mhstatu = $Fila1["movh_statu"];
}
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQL = "SELECT * FROM wh_materials Where code = '$prod2' and zone_id = '$ZON' ";
	$Registrop = mysqli_query($link,$SQL);
	//----------------------------------------------------------------
	while($Filap = mysqli_fetch_array($Registrop))
	{
	// Asignar Datos a las variables
	//-------------------------------
	$DESCP = $Filap["description_m"];		// Descripcion del Producto
	$PRODP = $Filap["cost_me"];			// Precio A del Producto
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
$CIA = $FilaA["zcompany_id"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
	
?>
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="mhcia" value="<?Php echo $CIA ?>" />
<Input Type="hidden" name="mhalm" value="<?Php echo $ZON ?>" />
<Input Type="hidden" name="mhtm" value="<?Php echo $mhtmov ?>" />
<Input Type="hidden" name="mfdoc" value="<?Php echo $mhfecha ?>" />
<Input Type="hidden" name="mpera" value="<?Php echo $mhejer ?>" />
<Input Type="hidden" name="mperm" value="<?Php echo $mhper ?>" />
<Input Type="hidden" name="pid" value="<?Php echo $prodid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="user" value="<?Php echo $userid ?>" />

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

					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
					
					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="Submit" id="BotonAdd" name="BotonAdd"><span class="glyphicon glyphicon-save"></span> Grabar</button>

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
								<b><font color="#990000" FACE="times new roman" size="4px">Movimientos de Materiales.: </font></b>
								<b><font color="blue" FACE="times new roman" size="4px">&nbsp; Agregar Renglones a Documentos</font></b>
							</div>
						</div>
					</div>
			<!-- ============================================ -->			
					<div class="form-group">
						<label><font color="#990000" FACE="times new roman" size="3px">Almacen..:  </font></label>
						&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $DCIA ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
						<br>
					</div>
			<!-- ============================== -->			
					<table border="1" width="100%">
					<thead><tr>
						<th><p style='text-align:center'>Documento</p></th>
						<th><p style='text-align:center'>Tipo Documento</p></th>
						<th><p style='text-align:center'>T.M.</p></th>
						<th><p style='text-align:center'>Fecha Doc.</p></th>
						<th><p style='text-align:center'>Ejercicio</p></th>
						<th><p style='text-align:center'>Periodo</p></th>
			
					</tr></thead>
					<tr>
						<td><b><input class="form-control" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
						<td><b><input class="form-control" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
						<td><b><input class="form-control" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
						<td><input class="form-control" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
						<td><input class="form-control" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' value="<?Php echo $mhejer; ?>" readonly></td>
						<td><input class="form-control" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
						
					</tr>
					</table>
					<br>
			<!--  ============================================ -->
					<div class="container-fluid">
						<?Php include_once('tasacambio.php'); ?>					
						<?Php include('function.php'); ?>
							
						<label><font color="blue" FACE="times new roman" size="3px">Datos del Material...:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $prod2 ?></font>
						<label class="control-label"><font color="blue" FACE="times new roman" size="3px">--</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $DESCP ?></font>
						<br>

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<b><span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Movimiento..:</font></span></b>
									<select name="tm_id" class="form-control" required />
										<option value=""></option>
										<?php echo fill_tipmov_list($connect, $mhtmov); ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-8">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Descripción Renglon.:</font></span>
									<Input class="form-control" Type="Text" name="dmov" size="100" maxlength="100" value="<?Php echo $DESCP ?>" required />
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Cantidad de Material.:</font></span>
									<Input class="form-control" Type="Text" name="CANT" size='8' maxlength="8" value="" required />
								</div>
							</div>
						</div>
						
						<div class="row">
							<?Php if($mhtmov == 'Entradas'){ ?>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Unitario Moneda Extranjera:</font></span>
									<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="0.00" required />
								</div>
							</div>
							<?Php } else {?>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Unitario Moneda Extranjera:</font></span>
									<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $PRODP ?>" readonly />
								</div>
							</div>
							<?Php } ?>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tasa de Cambio Bs:</font></span>
									<Input class="form-control" Type="Text" name="movd_tasa_cambio" size='12' maxlength="12" value="<?Php echo number_format($dolarHoy, 2) ?>" required />
								</div>
							</div>
						</div>
						
						<div class="row">
							<?Php if($mhtmov == 'Entradas') { ?>
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Entrada Material:</font></span>
									<select name="tipent" class="form-control" required />						
										<option value=""></option>
										<option value="Nacional">Nacional</option>
										<option value="Internacional">Internacional</option>
										<option value="Transferencia">Transferencia</option>
									<select>
									<Input Type="hidden" name="tipsal" />
								</div>
							</div>
							<?Php } else { ?>
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Salida Material..:</font></span>
									<select name="tipsal" class="form-control" required />						
										<option value=""></option>
										<option value="Equipo">Equipo</option>
										<option value="Interna">Interna</option>
										<option value="Pozo">Pozo</option>
									<select>
									<Input Type="hidden" name="tipent" />
								</div>
							</div>
							<?Php } ?>
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Condicion del Material...:</font></span>
									<select name="c_id" class="form-control" required />
										<option value=""></option>
										<?php echo fill_conditions_list($connect); ?>
									</select>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Despachador / Receptor..:</font></span>
									<Input class="form-control" Type="Text" name="rec" size="30" maxlength="45" value="" required />
								</div>
							</div>
						</div>
						<br>

					</div>
				</div>
	<!-- =================================================================================== -->	
			</div>
		</div>
	</div>
</div>
</form>
<!--  ======================================================================================= -->
<?php mysqli_close($link); ?>
</BODY>
</HTML> 