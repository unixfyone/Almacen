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
//include('unico_1.php');
?>

<HTML>
<HEAD>
	<title>Materiales</title>
	
	<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
	<link rel="stylesheet" type="text/css" href="cssi/styles.css" />
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

echo '<FORM ACTION="act_salpro_int_add.php" method="POST">';

//--------------
//---------------------------------------------------------------
$mhid = $_GET['IDH'];			// Id del Documento Cabezera
$prodid = $_GET['IDP'];			// ID. de Producto
$prod2 = $_GET['CP'];			// Codigo de Producto
//---------------------------------------------------------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';
//-------------
if(isset($_GET["CIAX"]))$CIAX = $_GET["CIAX"];
else $CIAX = '';
//-------------



//===============================================================
$SQL = "SELECT * FROM wh_movinvh 
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
WHERE movh_id = '$mhid'";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];
$tmid = $Fila1["movh_tmid"]; 
$mhtdoc = $Fila1["tm_desc"]; 
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
	$SQL = "SELECT * FROM wh_materials 
	INNER JOIN wh_measurement_units ON wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
	Where code = '$prod2' and zone_id = '$ZON' ";
	$Registrop = mysqli_query($link,$SQL);
	//----------------------------------------------------------------
	while($Filap = mysqli_fetch_array($Registrop))
	{
	// Asignar Datos a las variables
	//-------------------------------
	$DESCP = $Filap["description_m"];		// Descripcion del Producto
	$PRODP = $Filap["cost_me"];			// Precio A del Producto
	$UNIM = $Filap["name"];					// Nombre Unidad de Medida	
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
$MM = $mhper;
$MM_ANT = $MM - 1; 				// Mes periodo actual en arreglo (12 Pos)
$MM_PANT = $MM - 1;				// Mes para Saldo del Periodo anterior (13 Pos)
$existencia = 0;
//-------------------
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
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="mhdoc" value="<?Php echo $mhdoc ?>" />
<Input Type="hidden" name="CIAX" value="<?Php echo $CIAX ?>">
<Input Type="hidden" name="mhcia" value="<?Php echo $CIA ?>" />
<Input Type="hidden" name="mhalm" value="<?Php echo $ZON ?>" />
<Input Type="hidden" name="mhtm" value="<?Php echo $mhtmov ?>" />
<Input Type="hidden" name="tmid" value="<?Php echo $tmid ?>" />
<Input Type="hidden" name="mfdoc" value="<?Php echo $mhfecha ?>" />
<Input Type="hidden" name="mpera" value="<?Php echo $mhejer ?>" />
<Input Type="hidden" name="mperm" value="<?Php echo $mhper ?>" />
<Input Type="hidden" name="pid" value="<?Php echo $prodid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="mrecep" value="<?Php echo $mhreceptor ?>" />
<Input Type="hidden" name="user" value="<?Php echo $userid ?>" />

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<div class="content-wrapper">
    <!-- Main content -->
	<section class="content">
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" size="4px">Agregar Salidas Internas de Almacen</font></b>
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
									<div class="col-lg-5">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacen..:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-3">
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
											<?Php include_once('tasacambio.php'); ?>					
											<?Php include('function.php'); ?>
												
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
														<?php if ($existencia != 0) { ?>
															<label class="input-group-text"><font color="blue" size="3px">Existencia:</font></label>
														<?php } else {?>
															<label class="input-group-text"><font color="#FFFFFF" style="background-color:red;" size="3px">Existencia:</font></label>
														<?php } ?>
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
														<Input class="form-control" Type="Text" name="dmov" size="100" maxlength="100" value="<?Php echo $DESCP ?>" readonly />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Cantidad de Material.:</font></label>
														
														<?php if ($existencia != 0) { ?>
															<Input class="form-control" Type="Text" name="CANT" size='8' maxlength="8" value="" required />
														<?php } else {?>
															<Input class="form-control" Type="Text" name="CANT" size='8' maxlength="8" value="0" disabled />
														<?php } ?>
														
													</div>
												</div>

												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Costo Unitario Moneda Ext:</font></label>
														<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $PRODP ?>" readonly />
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tasa Cambio Bs..:</font></label>
														<Input class="form-control" Type="Text" name="movd_tasa_cambio" size='12' maxlength="12" value="<?Php echo $pdolar ?>" required />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tipo Salida Material..:</font></label>
														<select name="tipsal" class="form-control" required />						
															<option value=""></option>
															<option value="EQUIPO">EQUIPO</option>
															<option value="INTERNA">INTERNA</option>
															<option value="POZO">POZO</option>
														<select>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Condicion del Material...:</font></label>
														<select name="c_id" class="form-control" required />
															<option value=""></option>
															<?php echo fill_conditions_list($connect); ?>
														</select>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Tipo Transacción:</font></label>
														<select name="movd_trans" class="form-control" required />						
															<option value=""></option>
															<option value="N/A">N/A</option>
															<option value="INTERNA">INTERNA</option>
															<option value="PROPIA">PROPIA</option>
															<option value="PRESTAMO">PRESTAMO</option>
															<option value="NUEVA">NUEVA</option>
														<select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Nombre Consumo.....:</font></label>
														<select name="movd_id_cons" id="movd_id_cons" class="form-control" required>
															<option value="">Seleccionar Consumo</option>
															<?php echo fill_consumo_list($connect, $ZON); ?>
														</select>
													</div>
												</div>
											</div> 
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group">
														<label class="input-group-text"><font color="#505050" size="3px">Compañia del Receptor.:</font></label>
														<div class="input-group-prepend">
															<select name="company_id" id="company_id" class="form-control">
															<option value="">Seleccionar Compañia</option>
															<?php echo fill_companies_list($connect); ?>
															</select>
														</div>
													</div>
												</div>								
												<div class="col-lg-4">
													<div class="form-group">
														<label class="input-group-text"><font color="#505050" size="3px">Departamento del Receptor.:</font></label>
														<div class="input-group-prepend">
															<select name="department_id2" id="department_id2" class="form-control">
															<option value="">Seleccionar Departamento</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="input-group-text"><font color="#505050" size="3px"> Receptor...:</font></label>
														<div class="input-group-prepend">
															<select name="user_receptor" id="user_receptor" class="form-control" >
																<option value="">Seleccionar Usuario</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-group">
														<label class="input-group-text"><font color="#505050" size="3px">Departamento Aprobador:</font></label>
														<select name="department_id3" id="department_id3" class="form-control" required>
															<option value="">Seleccionar Departamento</option>
															<?php echo fill_departments_list($connect, $CIA); ?>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-group">
														<label class="input-group-text"><font color="#505050" size="3px">Usuario Aprobador:</font></label>
														<select name="user_aprobador" id="user_aprobador" class="form-control"  required>
															<option value="">Seleccionar Usuario</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-group">
														<label class="input-group-text"><font color="#505050" size="3px">Departamento Despachador:</font></label>
														<select name="department_id" id="department_id" class="form-control" required>
															<option value="">Seleccionar Departamento</option>
															<?php echo fill_departments_list($connect, $CIA); ?>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-group">
														<label class="input-group-text"><font color="#505050" size="3px">Usuario Despachador:</font></label>
														<select name="user_despachador" id="user_despachador" class="form-control"  required>
															<option value="">Seleccionar Usuario</option>
														</select>
													</div>
												</div>
											</div>
											</br>
											<div class="row">
												<div class="col-lg-12">
													<div class="input-group">
														<label class="input-group-text"><font color="#606060" size="3px">Observacion Salida...:</font></label>
														<Input class="form-control" Type="Text" name="movd_obs" size="100" maxlength="100" onkeyup="this.value = this.value.toUpperCase();" />
													</div>
												</div>
											</div>
											
											<Input Type="hidden" name="CANTXE" value="<?Php echo $existencia ?>" />

											<div class="modal-footer" style="background-color:#FFFFFC">
												<?php if ($existencia != 0 and $PRODP != 0) { ?>
													<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="Submit" id="BotonAdd" name="BotonAdd"><span class="fa fa-save"></span> Grabar</button>
												<?php } ?>
												
												<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
											</div>
										</div>
									</div>
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
<?php mysqli_close($link); ?>
<script>
$(document).ready(function(){
<!-- ********************* Lista para Usuarios/departamento **************** -->
$('#department_id').change(function(){
        var department_id = $('#department_id').val();
        var btn_action = 'load_usuarios';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id:department_id, btn_action:btn_action},
            success:function(data)
            {
                $('#user_despachador').html(data);
            }
        });
    });
$('#department_id2').change(function(){
        var department_id2 = $('#department_id2').val();
        var btn_action = 'load_usuarios2';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id2:department_id2, btn_action:btn_action},
            success:function(data)
            {
                $('#user_receptor').html(data);
            }
        });
    });
$('#department_id3').change(function(){
        var department_id3 = $('#department_id3').val();
        var btn_action = 'load_usuarios3';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id3:department_id3, btn_action:btn_action},
            success:function(data)
            {
                $('#user_aprobador').html(data);
            }
        });
    });
$('#company_id').change(function(){
        var company_id = $('#company_id').val();
        var btn_action = 'load_department';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{company_id:company_id, btn_action:btn_action},
            success:function(data)
            {
                $('#department_id2').html(data);
            }
        });
    });
//---------------
});	
//---------------
</script>
</BODY>
</HTML> 