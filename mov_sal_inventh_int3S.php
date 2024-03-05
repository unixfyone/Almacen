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

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
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

echo '<FORM ACTION="" method="">';
//---------------------------------------------------------------
if(isset($_GET["IDX"]))$IDX = $_GET["IDX"];
else $IDX = '';
//-------------
if(isset($_GET["TMID"]))$TMID = $_GET["TMID"];
else $TMID = '';
//-------------
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["MID"]))$MID = $_GET["MID"];
else $MID = '';
//--------------
if(isset($_GET["movh_tentrega"]))$movh_tentrega = $_GET["movh_tentrega"];
else $movh_tentrega = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh 
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
where movh_id = '$IDX'";

$Registro = mysqli_query($link,$SQL);
while($Fila = mysqli_fetch_array($Registro))
{
$CIA = $Fila["movh_cia"];
$ZON = $Fila["movh_zone"];
$DOC = $Fila["movh_doc"];
$TMID = $Fila["movh_tmid"];
$TDOC = $Fila["tm_desc"];
//$TDOC = $Fila["movh_tdoc"];
$FEC = $Fila["movh_fecha"];
$MPROC = $Fila["movh_proce"];
$PROVE = $Fila["movh_prove_id"];

if($CT1 == '0') {
$ORCO = $Fila["movh_oc"];
$movh_tentrega = $Fila["movh_tentrega"];
}

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
		$fechamin = $Filap["fec_min"];
		$fechamax = $Filap["fec_max"];		
	}
	mysqli_free_result ($Registrop);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="MID" value="<?Php echo $MID ?>">
<Input Type="hidden" name="movh_tentrega" value="<?Php echo $movh_tentrega ?>">

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
	<br>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
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
											&nbsp;&nbsp;<span><b><font color="red" size="4px"> <?Php echo $MID; ?></font></b></span>
										</div>
									</div>								
								</div>
								<hr class="elevation-2" color="#CCCCCC" >
								<?Php include_once('function.php'); ?>
								<!-- =============================== -->

								<div class="row">  
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Nro.Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="15" name="movh_doc" id="movh_doc" class="form-control" placeholder="Nra. del Documento" value="<?Php echo $DOC ?>" readonly />
											</div>
										</div> 
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Ejercicio-Periodo.:</font></label>
											<div class="input-group-prepend">
												<input type="text" name="movh_ejer" id="movh_ejer" style="text-align:center" class="form-control" value="<?Php echo $AA_P ?>" readonly ></input>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="text" name="movh_per" id="movh_per" style="text-align:center" class="form-control" value="<?Php echo $MM_P ?>" readonly ></input>
											</div>
										</div>
									</div>
									
									<?php if ($CTAR != '0') {  ?>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Fecha Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="date" name="movh_fecha" id="movh_fecha" id="movh_fecha" min="<?= $fechamin; ?>" max="<?= $fechamax; ?>" class="form-control" value="<?Php echo $FEC ?>" readonly />
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Tipo de Documento</font></label>
											<div class="input-group-prepend">
												<input type="text" name="TMID" id="TMID" class="form-control" value="<?Php echo $TDOC ?>" readonly />
											</div>
										</div> 									
									</div>
									<?php } else  {  ?>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Fecha Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="date" name="movh_fecha" id="movh_fecha" id="movh_fecha" min="<?= $fechamin; ?>" max="<?= $fechamax; ?>" class="form-control" value="<?Php echo $FEC ?>" readonly />
											</div>
										</div> 
									</div>									
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Tipo de Documento</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="TMID" >
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>							
													<?php
													//---------------------------------------------------------------
													$query="select * From wh_tipmov 
													where tm_statu = 'Activo' and tm_tipo = '$MID'
													ORDER BY tm_desc ASC";
													$Registro=mysqli_query($link,$query);
													//-------
													while ($row=mysqli_fetch_array($Registro)){
													//-------
													echo '<option ';
													if($TMID == $row["tm_id"])echo 'selected ';
													echo 'value=' . $row["tm_id"] .'>'. $row["tm_desc"] . "\n";
													}
													mysqli_free_result ($Registro);
													//---------------------------------------------------------------
													?>									
												</select>													
											</div>
										</div> 									
									</div>
									<?php } ?>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"><i class="fa fa-clock-o "></i> Orden de Salida.:</font></label>						
											<div class="input-group-prepend">
												<input type="text" name="movh_oc" id="movh_oc" maxlength="45" class="form-control" value="<?Php echo $ORCO ?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="input-group">
											<label class="input-group-text"><font color="#606060" size="3px"> Tipo de Entrega</font></label>
											<select name="movh_tentrega" id="movh_tentrega" class="form-control" required />
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?php
											  echo '<option ';
												if($movh_tentrega == "NO-APLICA") echo 'selected ';
											  echo 'value=' . "NO-APLICA" .'>'. "NO-APLICA" . "\n";
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
<!-- ====================================================== -->
				
<?php //echo "<pre>"; print_r($movh_tentrega); exit(); ?>

							<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">
					
							<div class="modal-footer" style="background-color:#FFFFFC">
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" formaction="act_sal_movinventh.php" formmethod="post" type="submit" id="BotonUpd" name="BotonUpd"><span class="fa fa-save"></span> Grabar Cambios</button>
								
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
							</div>			
						</div>
					</div>	
				</div>		
			</div>			
		</div>				
	</section>					
</div>
<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
		element2 = document.getElementById("content2");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
			element2.style.display='none';
        }
        else {
            element.style.display='none';
			element2.style.display='block';
        }
    }
</script>
</FORM>
</BODY>
</HTML> 