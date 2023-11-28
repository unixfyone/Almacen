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
include('unico_1.php');
?>

	<link rel="stylesheet" href="cssi/styles.css">
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
<?php

echo '<FORM ACTION="" method="">';
//echo '<FORM ACTION="entproduct_02ED_Sal.php" method="POST">';
//---------------------------------------------------------------
//---------------------------------------------------------------
if(isset($_GET["movd_id"]))$IDM = $_GET["movd_id"];
else $IDM = $_GET["IDM2"];
//--------------
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
if(isset($_GET["drecibe"]))$drecibe = $_GET["drecibe"];
else $drecibe = '';
if(isset($_GET["recibe"]))$recibe = $_GET["recibe"];
else $recibe = '';
if(isset($_GET["daprueba"]))$daprueba = $_GET["daprueba"];
else $daprueba = '';
if(isset($_GET["aprueba"]))$aprueba = $_GET["aprueba"];
else $aprueba = '';
if(isset($_GET["trans"]))$trans = $_GET["trans"];
else $trans = '';
if(isset($_GET["consumo"]))$consumo = $_GET["consumo"];
else $consumo = '';
//-------------
if(isset($_GET["obs"]))$obs = $_GET["obs"];
else $obs = '';


if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//===============================================================

$SQL = "SELECT * FROM wh_movinvd 
INNER JOIN wh_movinvh ON wh_movinvh.movh_id = wh_movinvd.movh_id
INNER JOIN wh_conditions ON wh_conditions.c_id = wh_movinvd.movd_cond
Where wh_movinvd.movd_id = '$IDM' ";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];			// Id de Documento
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];		// Nro. de Documento
$mhtdoc = $Fila1["movh_tdoc"];		// Tipo de Documento
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
$mdtipsal = $Fila1["movd_tipsal"];	// Tipo de Salida
$CID = $Fila1["c_id"];				// ID Condidion del Material
$CONDI = $Fila1["c_description"];	// Condidion del Material
$dmov = $Fila1["movd_desc"];		// Descripcion del Movimiento
$rprod = $Fila1["movd_recprod"];	// Persona que recibe producto
$trans = $Fila1["movd_trans"];
$drecibe = $Fila1["dep_receptor"];	
$recibe = $Fila1["user_receptor"];
$daprueba = $Fila1["dep_aprobador"];
$aprueba = $Fila1["user_aprobador"];	
$consumo = $Fila1["movd_id_cons"];
$obs = $Fila1["movd_obs"];	
} 
}
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------

//===============================================================
	$SQL = "SELECT * FROM wh_materials Where code = '$prod2' ";
	$Registrop = mysqli_query($link,$SQL);
	//----------------------------------------------------------------
	while($Filap = mysqli_fetch_array($Registrop))
	{
	// Asignar Datos a las variables
	//-------------------------------
	$DESCP= $Filap["description_m"];
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
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />
<Input Type="hidden" name="IDM2" value="<?Php echo $IDM ?>" />
<Input Type="hidden" name="mhid" value="<?Php echo $mhid ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="dmov" value="<?Php echo $dmov ?>" />
<Input Type="hidden" name="mdcant" value="<?Php echo $mdcant ?>" />
<Input Type="hidden" name="mdcostoue" value="<?Php echo $mdcostoue ?>" />
<Input Type="hidden" name="tasa" value="<?Php echo $tasa ?>" />

<Input Type="hidden" name="tmcod" value="<?Php echo $tmcod ?>" />
<Input Type="hidden" name="tmtipo" value="<?Php echo $tmtipo ?>" />
<Input Type="hidden" name="CID" value="<?Php echo $CID ?>" />

<Input Type="hidden" name="trans" value="<?Php echo $trans ?>" />
<Input Type="hidden" name="drecibe" value="<?Php echo $drecibe ?>" />
<Input Type="hidden" name="recibe" value="<?Php echo $recibe ?>" />
<Input Type="hidden" name="daprueba" value="<?Php echo $daprueba ?>" />
<Input Type="hidden" name="aprueba" value="<?Php echo $aprueba ?>" />
<Input Type="hidden" name="consumo" value="<?Php echo $consumo ?>" />
<Input Type="hidden" name="obs" value="<?Php echo $obs ?>" />

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Movimiento Almacen
					</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
				
					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
					
					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="Submit" id="BotonEdit" name="BotonEdit" formaction="entproduct_02ED_Sal.php" formmethod="POST"><span class="fa fa-edit"></span> Editar Renglon</button>
					
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
								<b><font color="blue" FACE="times new roman" size="4px">&nbsp; Modificar Renglon</font></b>
							</div>
						</div>
						<div style="clear:both"></div>
					</div>
					<!-- =================================================================================== -->

					<!-- =========================== -->
					<div class="form-group">
						<label><font color="#660000" FACE="times new roman" size="3px">Almacen..:  </font></label>
						&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $DCIA ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
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
						<td><b><input class="form-control" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
						<td><b><input class="form-control" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
						<td><b><input class="form-control" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
						<td><input class="form-control" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
						<td><input class="form-control" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' maxlength="4" value="<?Php echo $mhejer; ?>" readonly></td>
						<td><input class="form-control" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
					</tr>
					</table>
					<br>
					<!--  ======================================================================================= -->
					<div class="container-fluid">
						
						<label><font color="blue" FACE="times new roman" size="3px">Datos del Material...:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $prod2 ?></font>
						<label class="control-label"><font color="blue" FACE="times new roman" size="3px">--</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $DESCP ?></font>
						<br>

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
									<b><span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Movimiento..:</font></span></b>
									<Input class="form-control" Type="Text" name="tmdesc" size="30" value="<?Php echo $DESCTM ?>" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Descripción Renglon.:</font></span>
									<Input class="form-control" Type="Text" name="dmov" maxlength="200" size="100" value="<?Php echo $dmov ?>" readonly>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#990000" FACE="times new roman" size="3px">Cantidad de Material.:</font></span>
									<Input class="form-control" Type="Text" name="CANT" size='8' value="<?Php echo $mdcant ?>" readonly></font>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Unitario Moneda Extranjera:</font></span>
									<Input class="form-control" Type="Text" name="CUNIME" size='12' maxlength="12" value="<?Php echo $mdcostoue ?>" readonly />
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tasa de Cambio Bs:</font></span>
									<Input class="form-control" Type="Text" name="TASA" size='12' maxlength="12" value="<?Php echo $tasa ?>" readonly />
								</div>
							</div>
						</div>						
					
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Salida Material..:</font></span>
									<Input class="form-control" Type="Text" name="mdtipsal" size="40" value="<?Php echo $mdtipsal ?>" readonly>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Condicion del Material...:</font></span>
									<Input class="form-control" Type="Text" name="CONDI" value="<?Php echo $CONDI ?>" readonly>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo Transacción:</font></span>
									<Input class="form-control" Type="Text" name="movd_trans" value="<?Php echo $trans ?>" readonly>
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
									<?php
									//---------------------------------------------------------------
									$SQL="select * From departments where company_id = '$CIA' and id = '".$drecibe."' ";
									
									$Registro=mysqli_query($link,$SQL);
									//-------
									while ($row=mysqli_fetch_array($Registro))
									{
									$duname= $row["department"];
									}
									mysqli_free_result ($Registro);
									//---------------------------------------------------------------
									?>
									<Input class="form-control" Type="Text" name="dep_receptor" value="<?Php echo $duname ?>" readonly>										
								</div>
							</div>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Receptor:</font></span>
									<?php
									//---------------------------------------------------------------
									$query = "SELECT *, users.id as iduser, users.first_name, users.first_name, departments. * FROM positions
									inner join departments on departments.id = positions.department_id
									inner join users on users.position_id = positions.id
									where positions.department_id = '".$drecibe."' and users.id = '".$recibe."'
									";
									$RegistroTM=mysqli_query($link,$query);
									//-------
									while ($row=mysqli_fetch_array($RegistroTM))
									{
									$uname= $row["first_name"].' '.$row["last_name"];
									}
									mysqli_free_result ($RegistroTM);
									//---------------------------------------------------------------
									?>									
									<Input class="form-control" Type="Text" name="user_receptor" value="<?Php echo $uname ?>" readonly>
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
									<?php
									//---------------------------------------------------------------
									$SQL="select * From departments where company_id = '$CIA' and id = '".$daprueba."' ";
									
									$Registro=mysqli_query($link,$SQL);
									//-------
									while ($row=mysqli_fetch_array($Registro))
									{
									$duaname= $row["department"];
									}
									mysqli_free_result ($Registro);
									//---------------------------------------------------------------
									?>
									<Input class="form-control" Type="Text" name="dep_aprobador" value="<?Php echo $duaname ?>" readonly>									
								</div>
							</div>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Aprobador:</</font></span>
									<?php
									//---------------------------------------------------------------
									$query = "SELECT *, users.id as iduser, users.first_name, users.first_name, departments. * FROM positions
									inner join departments on departments.id = positions.department_id
									inner join users on users.position_id = positions.id
									where positions.department_id = '".$daprueba."' and users.id = '".$aprueba."'
									";
									$RegistroTM=mysqli_query($link,$query);
									//-------
									while ($row=mysqli_fetch_array($RegistroTM))
									{
									$uaname= $row["first_name"].' '.$row["last_name"];
									}
									mysqli_free_result ($RegistroTM);
									//---------------------------------------------------------------
									?>									
									<Input class="form-control" Type="Text" name="user_aprobador" value="<?Php echo $uaname ?>" readonly>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Consumo:</font></span>
									<?php
									$query = "SELECT * FROM wh_consumos 
									WHERE id_cons = '".$consumo."'
									";
										
									$Registro=mysqli_query($link,$query);
									//-------
									while ($row=mysqli_fetch_array($Registro))
									{
									$nconsumo= $row["name_cons"];
									}
									mysqli_free_result ($Registro);										
									?>
									<Input class="form-control" Type="Text" name="movd_id_cons" value="<?Php echo $nconsumo ?>" readonly>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-lg-12">
								<div class="input-group">
									<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Observacion:</font></span>
									<Input class="form-control" Type="Text" name="movd_obs" value="<?Php echo $obs ?>" readonly />
								</div>
							</div>
						</div>
						
						<!-- ======================================================================================= -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-text"><b><font color="#cc3300">Cambiar Material:</font></b></span>
										<b><input class="form-control" type="text" name="prod" size="20" maxlength="45" value="" placeholder="Palabra de busqueda" ></b>
										<span class="input-group-btn">
										<button class="btn btn-default" name="boton1" type="bottom"><i class="w3-margin-left fa fa-search"> Buscar</i></button></span>
									</div>
								</div>
							</div>
						</div>	
						<HR style="border-color:#cccccc;">
					</div>
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
	wh_materials.code like '%" . $aKeyword[0] . "%' OR 
	wh_materials.description_m like '%" . $aKeyword[0] . "%' OR
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
		$status = '<span class=""><font color="blue" FACE="times new roman" size="3px">Activo</font></span>';
	}	else	{
		$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Inactivo</font></span>';
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
	echo "<td><a href=\"entproduct_02E_Sal.php?IDM=$IDM&IDH=$mhid&CP=$prod2X&TMC=$tmcod&DE=$dmov&CNT=$mdcant&UNI=$mdcostoue&TC=$tasa&REC=$rprod&TE=$mdtipent&TS=$mdtipsal&CD=$CID \">$prod2X</a></td>";
	
	}
	echo "<Td Align=Left><font size=2>" . $Fila['description_m'];
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
	<!-- ======================================= -->

<?php
//-------------------------------------------------------
mysqli_close($link);

//----------------------------------------------------------------
?>