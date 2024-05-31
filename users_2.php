<?php
//users.php

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
<title>Equipos</title>
	
	<link rel="stylesheet" type="text/css" href="cssi/styles.css" />
	<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
	
<style type="text/css">
{color:#fff;background-color:#154889}

.panel-default > .panel-heading {
    color: #555555;
    background-color: #f5f5f5;
    border-color: #dddddd;
}
.panel-default {
    border-color: #dddddd;
}

p {
    margin-top: 0em;
    margin-bottom: 0em;
	height: 20px;
}

table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #FFFFFC;
	color: #404040;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php

echo '<FORM ACTION="" method="">';
//---------------------------------------------------------------
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//--------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["DEP"]))$DEP = $_GET["DEP"];
else $DEP = '';
//-------------
if(isset($_GET["ASU"]))$ASU = $_GET["ASU"];
else $ASU = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
?>
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="DEP" value="<?Php echo $DEP ?>">
<Input Type="hidden" name="ASU" value="<?Php echo $ASU ?>">
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Usuarios del Sistema</font></b></h1>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Agregar Usuarios del Sistema</font></b>
						</div>
						<!-- /.card-header -->	
<!-- =================================================================================== -->
						<div class="card-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Compañia</label>
											<div class="input-group-prepend">
												<select class="form-control" name="CIA" id="CIA" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
													<?php
													//------------------------------------
													$SQL="Select * FROM companies WHERE companies.statu = 'Activo'
													ORDER BY company ASC ";
													
													$Registro=mysqli_query($link,$SQL);
													//-------
													while ($Fila=mysqli_fetch_array($Registro)){
													//----
													echo '<option ';
													if($CIA == $Fila["id"])echo 'selected ';
													echo 'value=' . $Fila["id"] .'>'. $Fila["company"] . "\n";
													}
													mysqli_free_result ($Registro);
													//--------------------------------------
													?>									
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Departamento</label>
											<div class="input-group-prepend">							
												<select class="form-control" name="DEP" id="DEP" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
													<?php
													//---------------------------------------------------------------
													$SQL="SELECT * FROM departments 
													WHERE statu = 'Activo' and company_id = '$CIA'
													ORDER BY department ASC";
													
													$Registro=mysqli_query($link,$SQL);
													//-------
													while ($Fila=mysqli_fetch_array($Registro)){
													//----
													echo '<option ';
													if($DEP == $Fila["id"])echo 'selected ';
													echo 'value=' . $Fila["id"] .'>'. $Fila["department"] . "\n";
													}
													mysqli_free_result ($Registro);
													//---------------------------------------------------------------
													?>									
												</select>
											</div>
										</div>							
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Usuario</label>
											<div class="input-group-prepend">
												<select class="form-control" name="ASU" id="ASU" onChange="javascrip:form.submit()" tal:define="prev request/previous">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
													<?php
													//---------------------------------------------------------------
													$SQL="SELECT  *, users.id as idu FROM positions
													inner join departments on departments.id = positions.department_id
													inner join users on users.position_id = positions.id
													where departments.statu = 'Activo' and positions.department_id = '$DEP' 
													";
													$Registro=mysqli_query($link,$SQL);
													//-------
													while ($Fila=mysqli_fetch_array($Registro)){
													$fullname = $Fila["first_name"] ." ". $Fila["last_name"];
													//----
													echo '<option ';
													if($ASU == $Fila["idu"])echo 'selected ';
													echo 'value=' . $Fila["idu"] .'>'. $fullname . "\n";
													}
													mysqli_free_result ($Registro);
													//---------------------------------------------------------------
													?>									
												</select>
											</div>
										</div>
									</div>	
								</div>
								</FORM>			
								<FORM ACTION="act_users.php" method="Post">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>RGB Color 2</label>
												<div class="input-group-prepend">
													<input type="text" maxlength="13" name="corporate_rgb" id="corporate_rgb" class="form-control" placeholder="Corporate RGB Color" required />
												</div>							
											</div>	
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Color 2</label>
												<div class="input-group-prepend">									
													<input type="text" maxlength="6" name="corporate_color2" id="corporate_color2" class="form-control" placeholder="Desplegable Color 2" required />
												</div>							
											</div>	
										</div>									
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Ruta Logo</label>
												<div class="input-group-prepend">
													<input type="text" maxlength="100" name="logo" id="logo" class="form-control" placeholder="Ruta Ubicación Logo" required />
												</div>							
											</div>					
										</div>
									</div>
				
									<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
									<Input Type="hidden" name="DEP" value="<?Php echo $DEP ?>">
									<Input Type="hidden" name="ASU" id="ASU" value="<?Php echo $ASU ?>">
											
									<div class="modal-footer" style="background-color:#FFFFFC">
										<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
										<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" id="BotonEdit" name="BotonEdit"><span class="fa fa-save"></span> Grabar Usuario</button>
									</div>			
								</FORM>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>