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

	<link rel="stylesheet" href="cssi/styles.css">
	<link rel="stylesheet" href="css/styles-wh.css">
	
<style>

th {
    color: white;
	font-size:15px;
	background-color:#<?=$ccolor;?>;
	}
table, th, td {
    border: 1px solid #cccccc;
    border-collapse: collapse;
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
</style>
<?php

echo '<FORM name="" ACTION="" method="">';
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
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//===============================================================
//if ($CT1 == '0') {
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
$mdcostoue = $Fila1["movd_costou_me"];	// Costo Unitario Producto
$tasa = $Fila1["movd_tasa_cambio"];
$mdtipent = $Fila1["movd_tipent"];	// Tipo de Entrada
$mdtipsal = $Fila1["movd_tipsal"];	// Tipo de Salida
$CONDI = $Fila1["c_description"];		// Condidion del Material
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
//===============================================================
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ALMD = $FilaA["zone_desc"];
$ALMU = $FilaA["zone_ubic"];
$CIA = $FilaA["zcompany_id"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />
<Input Type="hidden" name="IDM2" value="<?Php echo $IDM ?>" />
<Input Type="hidden" name="prod2" value="<?Php echo $prod2 ?>" />
<Input Type="hidden" name="tmcod" value="<?Php echo $tmcod ?>" />

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Movimiento de Almacen
					</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
				
					<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>

					<?php
					echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1' href=\"act_cerrar_renglon.php?IDM=$IDM \"><i class='fa fa-edit'></i> Cerrar Renglon</a>"; 
					?>
					
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	
	
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
            <div class="panel-heading">
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-6">
                    <div class="row">
						<b><font color="#990000" FACE="times new roman" size="4px">Movimientos de Productos.: </font></b>
                        <b><font color="blue" FACE="times new roman" size="4px"> Cerrar Renglon</font></b>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>

			<!-- =================================================================================== -->
			<div class="container-fluid">
				<!-- =========================== -->
				<div class="form-group">
					<label><font color="#660000" FACE="times new roman" size="2px">Almacen..:  </font></label>
					&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $ALMD ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ALMU; ?></font></label>
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
						<td><b><input class="form-control2" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
						<td><b><input class="form-control2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
						<td><b><input class="form-control2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
						<td><input class="form-control2" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
						<td><input class="form-control2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' maxlength="4" value="<?Php echo $mhejer; ?>" readonly></td>
						<td><input class="form-control2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
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
								<Input class="form-control" Type="Text" name="tmdesc" value="<?Php echo $DESCTM ?>" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8">
							<div class="input-group">
								<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Descripción Renglon.:</font></span>
								<Input class="form-control" Type="Text" name="dmov" value="<?Php echo $dmov ?>" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-text"><font color="#990000" FACE="times new roman" ">Cantidad de Material.:</font></span>
								<Input class="form-control" Type="Text" name="CANT" value="<?Php echo $mdcant ?>" readonly></font>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Unitario Moneda Extranjera:</font></span>
								<Input class="form-control" Type="Text" name="CUNIME" value="<?Php echo $mdcostoue ?>" readonly />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tasa de Cambio Bs:</font></span>
								<Input class="form-control" Type="Text" name="tasa" value="<?Php echo $tasa ?>" readonly />
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-text"><font color="#660000" FACE="times new roman" size="3px">Tipo de Salida Material..:</font></span>
								<Input class="form-control" Type="Text" name="mdtipsal" value="<?Php echo $mdtipsal ?>" readonly>
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
				</div>				
			</div>
		</div>
	</div>
</div>
<!-- =================================================================================== -->
<?php
//-------------------------------------------------------
mysqli_close($link);
//include('footer.php');
//----------------------------------------------------------------
?>