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
<title>Materiales</title>

<link rel="stylesheet" href="css/styles-wh.css">
	
<style type="text/css">

.border {
    border: 1px solid #<?=$ccolor;?>;
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
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php

echo '<FORM ACTION="act_movinventh.php" method="Post">';
//---------------------------------------------------------------
$IDX = $_GET["IDX"];
$MOP = $_GET["MOP"];
$MID = $_GET["MID"];
//-------------
//if(isset($_GET["movh_tentrega"]))$movh_tentrega = $_GET["movh_tentrega"];
//else $movh_tentrega = '';
//-------------
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh where movh_id = '$IDX'";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
$ZON = $Fila["movh_zone"];
$DOC = $Fila["movh_doc"];
$TDOC = $Fila["movh_tdoc"];
$FEC = $Fila["movh_fecha"];
$MPROC = $Fila["movh_proce"];
$PROVE = $Fila["movh_prove_id"];
$ORCO = $Fila["movh_oc"];
$movh_tentrega= $Fila['movh_tentrega'];
$movh_receptor= $Fila['movh_receptor'];
$movh_despachador= $Fila['movh_despachador'];
} 
mysqli_free_result ($Registro);
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT *, COUNT(movh_id) AS renglones FROM wh_movinvd where movh_id = '$IDX'";
$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
$CTAR = $Fila['renglones'];	
} 
mysqli_free_result ($Registro);
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
	$SQLp = "SELECT * FROM wh_periodos WHERE per_statu = 'Abierto' ";
	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA_P = $Filap["per_aa"];
		$MM_P = $Filap["per_mm"];
	}
	mysqli_free_result ($Registrop);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="MID" value="<?Php echo $MID ?>">

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Movimiento Almacen
					</font></b></h1>
				</div>
			</div>

		</div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Editar Documento Movimientos Almacen</font></b>
						</div>
						<!-- /.card-header -->

						<div class="card-body">
							<div class="panel-body">						
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label><font color="blue" FACE="times new roman" size="4px">Compañia..:  </font></label>
											&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="4px"> <?Php echo $DCIA ; ?></font></label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label><font color="blue" FACE="times new roman" size="4px">Almacen..:  </font></label>
											&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></label>
										</div>
									</div>
								</div>						
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label><font color="blue" FACE="times new roman" size="4px">Tipo Documento..:  </font></label>
											&nbsp;&nbsp;<label><font color="red" FACE="times new roman" size="4px"> <?Php echo $MID; ?></font></label>
										</div>
									</div>								
								</div>
								<hr class="elevation-2" color="#CCCCCC" >
								<?Php include_once('function.php'); ?>
								<!-- =============================== -->
								
								<div class="row">  
									<div class="col-sm-4">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Nro.Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="15" name="movh_doc" id="movh_doc" class="form-control" placeholder="Nra. del Documento" value="<?Php echo $DOC ?>" readonly />
											</div>
										</div> 
									</div>
									<div class="col-sm-8">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Tipo de Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="80" name="movh_tdoc" id="movh_tdoc" class="form-control" placeholder="Tipo de Documento" value="<?Php echo $TDOC ?>" required />
											</div>
										</div>                                 
									</div>
								</div>							
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"><i class="fa fa-clock-o "></i> Orden de Compra.:</font></label>						
											<div class="input-group-prepend">
												<input type="text" name="movh_oc" id="movh_oc" maxlength="45" class="form-control" placeholder="Nro. de Orden de Compra" value="<?Php echo $ORCO ?>" />
											</div>
										</div>
									</div>
									
									<?php if ($CTAR != '0') {  ?>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Fecha del Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="date" name="movh_fecha" id="movh_fecha" class="form-control" value="<?Php echo $FEC ?>" readonly />
											</div>
										</div> 
									</div>
									
									<?php } else  {  ?>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Fecha del Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="date" name="movh_fecha" id="movh_fecha" class="form-control" value="<?Php echo $FEC ?>"  />
											</div>
										</div> 
									</div>									
									<?php } ?>
									
									<div class="col-sm-3">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Ejercicio-Periodo.:</font></label>
											<div class="input-group-prepend">
												<input type="text" name="movh_ejer" id="movh_ejer" style="text-align:center" class="form-control" value="<?Php echo $AA_P ?>" readonly ></input>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="text" name="movh_per" id="movh_per" style="text-align:center" class="form-control" value="<?Php echo $MM_P ?>" readonly ></input>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"><i class="fa fa-clock-o "></i> Procedencia.:</font></label>						
											<div class="input-group-prepend">
												<input type="text" name="movh_proce" id="movh_proce" maxlength="60" class="form-control" placeholder="Procedencia / Proveedor / Cliente" value="<?Php echo $MPROC ?>" required />
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"><i class="fa fa-clock-o "></i> Proveedor.:</font></label>
											<select name="PROVE" class="form-control" required >
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?PHP
											//---------------------------------------------------------------
											$query = " SELECT * FROM wh_suppliers WHERE statu = 'Activo' ORDER BY prove ASC";
											$Registro=mysqli_query($link,$query);
											//-------
											while ($Fila=mysqli_fetch_array($Registro)){
											//-------
											echo '<option ';
											if($PROVE == $Fila["id"])echo 'selected ';
											echo 'value=' . $Fila["id"] .'>'. $Fila["prove"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
											?>
											</select>
										</div>											
									</div>									
								</div>
								
								<?Php if($MID == 'Salidas'){ ?>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Tipo de Entrega</font></label>
											<div class="input-group-prepend">
												<select name="movh_tentrega" id="movh_tentrega" class="form-control" required>
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												  echo '<option ';
													if($movh_tentrega == 'NO APLICA') echo 'selected ';
												  echo 'value=' . 'NO APLICA' .'>'. 'NO APLICA' . "\n";
													echo '<option ';
													if($movh_tentrega == 'TRASLADO') echo 'selected ';
												  echo 'value=' . 'TRASLADO' .'>'. 'TRASLADO' . "\n";
													echo '<option ';
													if($movh_tentrega == 'DEVOLUCION') echo 'selected ';
												  echo 'value=' . 'DEVOLUCION' .'>'. 'DEVOLUCION' . "\n";
													echo '<option ';
													if($movh_tentrega == 'DESINCORPORACION') echo 'selected ';
												  echo 'value=' . 'DESINCORPORACION' .'>'. 'DESINCORPORACION' . "\n";
												?>
												</select>												
											</div>
										</div>  
									</div>								
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Material Recibido por.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="60" name="movh_receptor" id="movh_receptor" class="form-control" placeholder="Receptor del Material" value="<?Php echo $movh_receptor ?>" required />
											</div>
										</div>                                 
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Material Despachador por.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="60" name="movh_despachador" id="movh_despachador" class="form-control" placeholder="Despachador del Material" value="<?Php echo $movh_despachador ?>" required />
											</div>
										</div>                                 
									</div>
								</div>
								<?php } ?>
								
								<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">
						
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" id="BotonUpd" name="BotonUpd"><span class="glyphicon glyphicon-save"></span> Grabar Documento</button>
								</div>			
							</div>
						</div>
					</div>	
				</div>		
			</div>			
		</div>				
	</section>					
</div>
</FORM>
</BODY>
</HTML> 