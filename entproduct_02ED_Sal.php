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
	<link rel="stylesheet" href="css/styles-wh.css">

<style>

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

td {font-size: 15px;}

table.border, td.border {border: 0px;}

input[type=text2], input[type=date] {
  font-size: 16px;
  color: #990000;
}

th {background-color: #<?=$ccolor;?>;
	color: white;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
</style>

</HEAD>
<BODY bgcolor=#FFFFFF>

<?php

echo '<FORM ACTION="" method="POST">';
//---------------------------------------------------------------
$mdid = $_POST['IDM2'];			// Id del Renglon
$mhid = $_POST['mhid'];			// Id del Documento Cabezera
$prod2 = $_POST['prod2'];		// Codigo de Producto
//--------------
$tmid = $_POST["tmcod"];		// Codigo Tipo de Movimiento
//--------------
$mdtipsal = $_POST['mdtipsal'];
$CID = $_POST['CID'];
//-------------
$dmov = $_POST['dmov'];			// Descripcion del Movimiento

if(isset($_GET["mdcant"]))$mdcant = $_GET["mdcant"];
else $mdcant = $_POST["mdcant"];

$mdcostoue = $_POST['mdcostoue'];		// Costo Unitario Producto M Extranjera
$tasa = $_POST["tasa"];
$trans = $_POST['trans'];
$drecibe = $_POST['drecibe'];
$recibe = $_POST['recibe'];
$daprueba = $_POST['daprueba'];
$aprueba = $_POST['aprueba'];	
$consumo = $_POST['consumo'];	
$obs = $_POST['obs'];
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
<Input Type="hidden" name="IDM2" value="<?Php echo $mdid ?>">
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="pid" value="<?Php echo $prodid ?>" />
<Input Type="hidden" name="tmcod" value="<?Php echo $tmid ?>" />
<Input Type="hidden" name="mhtm" value="<?Php echo $mhtmov ?>" />
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">

<Input Type="hidden" name="mdtipsal" value="<?Php echo $mdtipsal ?>" />
<Input Type="hidden" name="CID" value="<?Php echo $CID ?>" />
<Input Type="hidden" name="mdcant" value="<?Php echo $mdcant ?>" />
<Input Type="hidden" name="mdcostoue" value="<?Php echo $mdcostoue ?>" />
<Input Type="hidden" name="tasa" value="<?Php echo $tasa ?>" />
<Input Type="hidden" name="trans" value="<?Php echo $trans ?>" />
<Input Type="hidden" name="obs" value="<?Php echo $obs ?>" />
<Input Type="hidden" name="drecibe" value="<?Php echo $drecibe ?>" />
<Input Type="hidden" name="recibe" value="<?Php echo $recibe ?>" />
<Input Type="hidden" name="daprueba" value="<?Php echo $daprueba ?>" />
<Input Type="hidden" name="aprueba" value="<?Php echo $aprueba ?>" />
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

					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="Submit" id="BotonEdit" name="BotonEdit" formaction="act_salpro_edit.php" formmethod="POST"><span class="fa fa-save"></span> Grabar Cambios</button>
										
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
							<br>
							<div class="row">
								<div class="col-lg-4">
									<div class="input-group">
										<span class="input-group-text"><font color="#990000" FACE="times new roman" size="3px">Cantidad de Material.:</font></span>
										<Input class="form-control" Type="Text" name="mdcant" size='8' value="<?Php echo $mdcant ?>" required></font>
									</div>
								</div>
								<div class="col-lg-4">
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
							</div>	
							<div class="row">
								<div class="col-lg-4">
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
								<div class="col-lg-4">
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
								<div class="col-lg-4">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo Transacción:</font></span>
										<Input class="form-control" Type="Text" name="movd_trans" value="<?Php echo $trans ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-1">
									<div  align="right" class="form-group">
										<label><font color="red" FACE="times new roman" size="4px">Receptor: </font></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Departamento:</font></span>
										<select class="form-control" name="drecibe" onChange="javascrip:form.submit()" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>									
											<?php
											//---------------------------------------------------------------
											$SQL="select * From departments where company_id = '$CIA'";
											
											$Registro=mysqli_query($link,$SQL);
											//-------
											while ($row=mysqli_fetch_array($Registro))
											{
												echo '<option ';
												if($drecibe == $row["id"])echo 'selected ';
												echo 'value=' . $row["id"] .'>'. $row["department"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Receptor:</font></span>
										<select class="form-control" name="recibe" onChange="javascrip:form.submit()" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" ></option>									
											<?php
											//---------------------------------------------------------------
											$query = "SELECT *, users.id as iduser, users.first_name, users.first_name, departments. * FROM positions
											inner join departments on departments.id = positions.department_id
											inner join users on users.position_id = positions.id
											where positions.department_id = '$drecibe'
											";
											$Registro=mysqli_query($link,$query);
											//-------
											while ($row2=mysqli_fetch_array($Registro))
											{
												echo '<option ';
												if($recibe == $row2["iduser"])echo 'selected ';
												echo 'value=' . $row2["iduser"] .'>'. $row2["first_name"].' '.$row2["last_name"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
										?>
										</select>	
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-1">
									<div  align="right" class="form-group">
										<label><font color="red" FACE="times new roman" size="4px">Aprobador: </font></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Departamento:</font></span>
										<select class="form-control" name="daprueba" onChange="javascrip:form.submit()" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>									
											<?php
											//---------------------------------------------------------------
											$SQL="select * From departments where company_id = '$CIA'";
											
											$Registro=mysqli_query($link,$SQL);
											//-------
											while ($row3=mysqli_fetch_array($Registro))
											{
												echo '<option ';
												if($daprueba == $row3["id"])echo 'selected ';
												echo 'value=' . $row3["id"] .'>'. $row3["department"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Aprobador:</font></span>
										<select class="form-control" name="aprueba" onChange="javascrip:form.submit()" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>									
											<?php
											//---------------------------------------------------------------
											$query = "SELECT *, users.id as iduser, users.first_name, users.first_name, departments. * FROM positions
											inner join departments on departments.id = positions.department_id
											inner join users on users.position_id = positions.id
											where positions.department_id = '$daprueba'
											";
											$Registro=mysqli_query($link,$query);
											//-------
											while ($row4=mysqli_fetch_array($Registro))
											{
												echo '<option ';
												if($aprueba == $row4["iduser"])echo 'selected ';
												echo 'value=' . $row4["iduser"] .'>'. $row4["first_name"].' '.$row4["last_name"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
										?>
										</select>	
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="input-group">
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Consumo:</font></span>
										<select class="form-control" name="consumo" onChange="javascrip:form.submit()" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>									
											<?php
											$query = "SELECT * FROM wh_consumos WHERE zone_cons = '".$ZON."' ";
												
											$Registro=mysqli_query($link,$query);
											//-------
											while ($row=mysqli_fetch_array($Registro))
											{
												echo '<option ';
												if($consumo == $row["id_cons"])echo 'selected ';
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
										<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Observacion:</font></span>
										<Input class="form-control" Type="Text" name="movd_obs" value="<?Php echo $obs ?>" required />
									</div>
								</div>
							</div>
							<br><br>
						</div>
					</div>
				</div>
				
				<?php //echo "<pre>"; print_r($USERREC); exit(); ?>
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