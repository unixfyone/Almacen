<!DOCTYPE html>
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
th {
    color: white;
	font-size:15px;
	background-color:#<?=$ccolor;?>;
	}

table, th, td {
    border: 1px solid #cccccc;
    border-collapse: collapse;
}
.thx {
    color: black;
	font-size:15px;
	background-color:#cccccc;
	border-color: white;
	text-align:center;
	}
.thy {
    color: black;
	font-size:15px;
	background-color:#f8f8f8;
	text-align:center;
	border: 1px solid #cccccc;
    border-collapse: collapse;
	}

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
.dropdown-menu > li > a:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
}
.dropdown-menu > .disabled > a,
.dropdown-menu > .disabled > a:hover,
.dropdown-menu > .disabled > a:focus {
  color: #999999;
}
.dropdown-menu > .disabled > a:hover,
.dropdown-menu > .disabled > a:focus {
  text-decoration: none;
  background-color: transparent;
  background-image: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  cursor: not-allowed;
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
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus {
  text-decoration: none;
  color: #ffffff;
  background-color: #2fa4e7;
}
.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}

.div2 {
  background-color: #fbf0e6;
  width: 600px;
  height: 300px;
  border: 2px solid #cccccc;
  padding: 10px;
  margin: 20px;
}
</style>

<?php
//---------------------------------------------------------------
echo '<FORM ACTION="" method="">';
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["IDM"]))$IDM = $_GET["IDM"];
else $IDM = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
$abiertos = '';	
$cerrados = '';

//---------------------------------------------------------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//===============================================================
$SQL = "SELECT * FROM wh_user_menus 
INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
Where wh_user_menus.user_id = '$userid' and wh_user_menus.menuop_id = '$MOP' ";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$add = $Fila1["usermn_add"];
$edit = $Fila1["usermn_edit"];
$del = $Fila1["usermn_del"];
$actua = $Fila1["menuop_act"];
} 
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh 
Where wh_movinvh.movh_id = '$IDM' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$IDM = $Fila1["movh_id"];			// Id de Documento
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];		// Nro. de Documento
$mhtdoc = $Fila1["movh_tdoc"];		// Tipo de Documento
$mhtmov = $Fila1["movh_tmov"];		// Tipo Movimiento (E/S)
$mhfecha = $Fila1["movh_fecha"];	// Fecha del Documento
$mhejer = $Fila1["movh_ejer"];		// Ejercicio / Año
$mhper = $Fila1["movh_per"];		// Periodo / Mes
$mhproce = $Fila1["movh_proce"];	// Procedencia
}
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where wh_zones.zone_id = '$ZON' ";

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
$query = "SELECT *, COUNT(movh_id) AS renglones FROM wh_movinvd 
WHERE movh_id = '$IDM' GROUP BY movd_statu";

$Registro3 = mysqli_query($link,$query);
while($row = mysqli_fetch_array($Registro3))
{

if (is_null($row["movd_statu"])) {

} else {
if($row["movd_statu"] == 'Abierto' ){	
$abiertos = $row["renglones"]; 
} else {
$cerrados = $row["renglones"];
}
}
	
}
mysqli_free_result ($Registro3);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="IDM" value="<?Php echo $IDM ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">

<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />

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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Cerrar Documento de Movimientos</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="form-group">
									<label><font color="#660000" FACE="times new roman" size="2px">Almacen..:  </font></label>
									&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
									<br>
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
									<th class="thx"><p>Procedencia</p></th>				
								</tr></thead>
								<tr>
									<td><b><input class="form-control2" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='12'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
									<td><b><input class="form-control2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
									<td><b><input class="form-control2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
									<td><input class="form-control2" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
									<td><input class="form-control2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' maxlength="4" value="<?Php echo $mhejer; ?>" readonly></td>
									<td><input class="form-control2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
									<td><input class="form-control2" type="text2" name="movh_proce" id="movh_prove" size="40" value="<?Php echo $mhproce; ?>" readonly></td>
								</tr>
								</table>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>		
	</section>

	<div class="panel-body">	
		<?Php
		$query4 = "
		SELECT *, Count(movh_id) AS Cuenta1 FROM wh_movinvd 
		WHERE movh_id = '$IDM' and movd_statu = 'Abierto'
		";	
		$Registro4 = mysqli_query($link,$query4);
		while($row4 = mysqli_fetch_array($Registro4))
		{
			$CTA1 = $row4['Cuenta1'];
		}
		mysqli_free_result ($Registro4);
		//========
		?>
		<Input Type="hidden" name="IDM" value="<?Php echo $IDM ?>" />
		<?Php
		if ($CTA1 > '0')			// Existen Renglones Abiertos
		{
		//==========
		?>

		<div class="modal-dialog modal-md"">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Documentos Movimientos de Productos</h4>
				</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<strong>Atencion.! </strong> Existen Renglones Abiertos en el Documento.
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm' type='Button' name='Cancel' onclick='window.history.go(-2)' data-dismiss="modal"><span class="fa fa-remove"></span> Cerrar</button>
			</div>
		</div>
		<?Php
			//==========
		} else {
			
		echo "<div align='center'>";	
		echo "<BR>";
		echo "<div class = 'div2'>";
		echo "<H4>";
		echo "<p Align=Center>";
		echo "<font color=RED>Proceso para Cerrar Documento Movimiento de Materiales</font>";
		echo "<BR>";
		echo "<b><font color=RED>Esta seguro que desea continuar</font></b>";
		echo "<br><br>";
		?>
		<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="button" name="BotonCancelar" onclick='window.history.go(-2)'><span class="fa fa-remove"></span>  Cancelar</button>
		<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="Submit" name="BtnOK" ><span class="fa fa-ok"></span> Aceptar</button>
		</div>
		</div>
		<?php
		if (isset($_GET['BtnOK']))
		{
			//==============================================================
			$query6 = "
			UPDATE wh_movinvh 
			SET movh_statu = 'Cerrado'
			WHERE movh_id = '$IDM'
			";
				mysqli_query($link,$query6);
				//==========
				echo"<script type='text/javascript'>
				alert('!Documento Cerrado Correctamente...')
				window.history.go(-3)
				</script>";
				//==========
		}

		} ?>

	</div>
</div>	

<?php
//-------------------------------------------------------
mysqli_close($link);
//include('footer.php');
//----------------------------------------------------------------
?>