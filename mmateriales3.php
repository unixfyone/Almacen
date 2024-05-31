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
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php

echo '<FORM ACTION="" method="">';
//---------------------------------------------------------------
if(isset($_GET["IDX"]))$IDX = $_GET["IDX"];
else $IDX = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//---------------------------------------------------------------
if(isset($_GET["code"]))$code = $_GET["code"];
else $code = '';
//-------------
if(isset($_GET["description"]))$description = $_GET["description"];
else $description = '';
//-------------
if(isset($_GET["description_a"]))$description_a = $_GET["description_a"];
else $description_a = '';
//-------------
if(isset($_GET["prefix"]))$prefix = $_GET["prefix"];
else $prefix = '';
//-------------
if(isset($_GET["code_sap"]))$code_sap = $_GET["code_sap"];
else $code_sap = '';
//-------------
if(isset($_GET["part_number"]))$part_number = $_GET["part_number"];
else $part_number = '';
//-------------
if(isset($_GET["SCAT"]))$SCAT = $_GET["SCAT"];
else $SCAT = '';
//-------------
if(isset($_GET["MARC"]))$MARC = $_GET["MARC"];
else $MARC = '';
//-------------
if(isset($_GET["UNID"]))$UNID = $_GET["UNID"];
else $UNID = '';
//-------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//-------------
if(isset($_GET["CAT"]))$CAT = $_GET["CAT"];
else $CAT = '';
//-------------
if(isset($_GET["type_material"]))$type_material = $_GET["type_material"];
else $type_material = '';
//-------------
if(isset($_GET["type_tm2_id"]))$type_tm2_id = $_GET["type_tm2_id"];
else $type_tm2_id = '';
//-------------
if(isset($_GET["clas_tm2_id"]))$clas_tm2_id = $_GET["clas_tm2_id"];
else $clas_tm2_id = '';
//-------------
if(isset($_GET["ubication"]))$ubication = $_GET["ubication"];
else $ubication = '';
//-------------
if(isset($_GET["cost"]))$cost = $_GET["cost"];
else $cost = '';
//-------------
if(isset($_GET["reorder"]))$reorder = $_GET["reorder"];
else $reorder = '';
//-------------
if(isset($_GET["fill"]))$fill = $_GET["fill"];
else $fill = '';
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_master_materials mmat
INNER JOIN wh_lines lin ON lin.id = mmat.wh_line_id
Where mmat.id = '$IDX' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$acronym = $row["acronym"];
$namel = $row["namel"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">

<Input Type="hidden" name="code" value="<?Php echo $code ?>" />
<Input Type="hidden" name="description" value="<?Php echo $description ?>" />
<Input Type="hidden" name="description_a" value="<?Php echo $description_a ?>" />
<Input Type="hidden" name="part_number" value="<?Php echo $part_number ?>" />
<Input Type="hidden" name="MARC" value="<?Php echo $MARC ?>" />
<Input Type="hidden" name="UNID" value="<?Php echo $UNID ?>" />
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>" />
<Input Type="hidden" name="CAT" value="<?Php echo $CAT ?>" />
<Input Type="hidden" name="SCAT" value="<?Php echo $SCAT ?>" />
<Input Type="hidden" name="type_material" value="<?Php echo $type_material ?>" />
<Input Type="hidden" name="type_tm2_id" value="<?Php echo $type_tm2_id ?>" />
<Input Type="hidden" name="clas_tm2_id" value="<?Php echo $clas_tm2_id ?>" />

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">

<?php
if ($CT1 == '1') {
$query = "SELECT mat.* FROM wh_master_materials mat
WHERE mat.id = '$IDX'";

$Registro = mysqli_query($link,$query);
while($row = mysqli_fetch_array($Registro))
{
$code = $row["code"];	
$description = $row["description"];
$description_a = $row["description_amp"];
$part_number = $row["part_number"];
$UNID = $row["wh_measurement_unit_id"];
$LIN = $row["wh_line_id"];
$CAT = $row["wh_category_id"];
$SCAT = $row["wh_subcategory_id"];
$MARC = $row["wh_brand_id"];
$type_material = $row["type_material"];
$type_tm2_id = $row["type_tm2_id"];
$clas_tm2_id = $row["clas_tm2_id"];
} 
mysqli_free_result ($Registro);
}
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Materiales Almacen
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Editar Materiales</font></b>
						</div>
						<!-- /.card-header -->

						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label><font color="blue" FACE="times new roman" size="4px">Linea del Material.:  </font></label>
											&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="4px"> <?Php echo $acronym ." / ". $namel; ?></font></label>
										</div>
									</div>
								</div>							
								<hr class="elevation-1" color="#CCCCCC" >
								<!-- =============================== -->
								<br>
								<div class="row">  
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">Código Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="code" id="code" class="form-control" value="<?Php echo $code; ?>" readonly />
											</div>
										</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Descripción del Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="200" name="description" id="description" class="form-control" value='<?Php echo $description; ?>' onkeyup="this.value = this.value.toUpperCase();" required />
											</div>
										</div>                                 
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Descripción Ampliada del Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="200" name="description_a" id="description_a" class="form-control" value='<?Php echo $description_a; ?>' placeholder="Descripción Ampliada del Material" onkeyup="this.value = this.value.toUpperCase();" />
											</div>
										</div>                                 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Número de Parte</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="part_number" id="part_number" class="form-control" value="<?Php echo $part_number; ?>" onkeyup="this.value = this.value.toUpperCase();" />
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Unidad de Medida</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="UNID" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>							
													<?php
													//---------------------------------------------------------------
													$SQLtm="select * From wh_measurement_units where statu = 'Activo' ORDER BY name ASC";
													$RegistroTM=mysqli_query($link,$SQLtm);
													//-------
													while ($FilaTM=mysqli_fetch_array($RegistroTM)){
													//-------
													echo '<option ';
													if($UNID == $FilaTM["id"])echo 'selected ';
													echo 'value=' . $FilaTM["id"] .'>'. $FilaTM["name"] . "\n";
													}
													mysqli_free_result ($RegistroTM);
													//---------------------------------------------------------------
													?>									
												</select>													
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">Marca</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="MARC" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>							
													<?php
													//---------------------------------------------------------------
													$SQLtm="Select * From wh_brands where brand_statu = 'Activo' ORDER BY brand_name ASC";
													$RegistroTM=mysqli_query($link,$SQLtm);
													//-------
													while ($FilaTM=mysqli_fetch_array($RegistroTM)){
													//-------
													echo '<option ';
													if($MARC == $FilaTM["brand_id"])echo 'selected ';
													echo 'value=' . $FilaTM["brand_id"] .'>'. $FilaTM["brand_name"] . "\n";
													}
													mysqli_free_result ($RegistroTM);
													//---------------------------------------------------------------
													?>									
												</select>												
											</div>
										</div> 
									</div>	
								
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Categoría</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="CAT" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>													
													<?php
													//---------------------------------------------------------------
													$SQLtm="select * From wh_categories where cat_statu = 'Activo' ORDER BY category ASC";
													$RegistroTM=mysqli_query($link,$SQLtm);
													//-------
													while ($Fila=mysqli_fetch_array($RegistroTM)){
													//-------
													echo '<option ';
													if($CAT == $Fila["cat_id"])echo 'selected ';
													echo 'value=' . $Fila["cat_id"] .'>'. $Fila["category"] . "\n";
													}
													mysqli_free_result ($RegistroTM);
													//---------------------------------------------------------------
													?>									
												</select>	
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">SubCategoría</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="SCAT" onChange="javascrip:form.submit()">
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>													
													<?php
													//---------------------------------------------------------------
													$SQLtm="select * From wh_subcategories where scat_statu = 'Activo' and wh_category_id ='$CAT' ORDER BY subcategory ASC";
													$RegistroTM=mysqli_query($link,$SQLtm);
													//-------
													while ($Fila=mysqli_fetch_array($RegistroTM)){
													//-------
													echo '<option ';
													if($SCAT == $Fila["scat_id"])echo 'selected ';
													echo 'value=' . $Fila["scat_id"] .'>'. $Fila["subcategory"] . "\n";
													}
													mysqli_free_result ($RegistroTM);
													//---------------------------------------------------------------
													?>									
												</select>									
											</div>
										</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Tipo Material</font></label>
											<div class="input-group-prepend">
												<select name="type_material" id="type_material" class="form-control" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												  echo '<option ';
													if($type_material == 'ACCESORIOS') echo 'selected ';
												  echo 'value=' . 'ACCESORIOS' .'>'. 'ACCESORIOS' . "\n";
													echo '<option ';
													if($type_material == 'CONSUMIBLES') echo 'selected ';
												  echo 'value=' . 'CONSUMIBLES' .'>'. 'CONSUMIBLES' . "\n";
													echo '<option ';
													if($type_material == 'INVENTARIO') echo 'selected ';
												  echo 'value=' . 'INVENTARIO' .'>'. 'INVENTARIO' . "\n";
												?>
												</select>												
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Tipo de Inventario</font></label>
											<div class="input-group-prepend">
												<select name="type_tm2_id" class="form-control" onChange="javascrip:form.submit()" required>
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>													
													<?php
													//---------------------------------------------------------------
													$SQLtm="select * From wh_type_material2 where statu = 'Activo' and type_material_id ='$type_material' ORDER BY name ASC";
													$Registro=mysqli_query($link,$SQLtm);
													//-------
													while ($Fila=mysqli_fetch_array($Registro)){
													//-------
													echo '<option ';
													if($type_tm2_id == $Fila["id"])echo 'selected ';
													echo 'value=' . $Fila["id"] .'>'. $Fila["name"] . "\n";
													}
													mysqli_free_result ($Registro);
													//---------------------------------------------------------------
													?>
												</select>
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Clasificacion Tipo Inventario</font></label>
											<div class="input-group-prepend">
												<select name="clas_tm2_id" class="form-control" onChange="javascrip:form.submit()" required>
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>													
													<?php
													//---------------------------------------------------------------
													$SQLtm="select * From wh_clasificacion_tm2 where statu = 'Activo' and id_tm2 ='$type_tm2_id' ORDER BY name ASC";
													$Registro=mysqli_query($link,$SQLtm);
													//-------
													while ($Fila=mysqli_fetch_array($Registro)){
													//-------
													echo '<option ';
													if($clas_tm2_id == $Fila["id"])echo 'selected ';
													echo 'value=' . $Fila["id"] .'>'. $Fila["name"] . "\n";
													}
													mysqli_free_result ($Registro);
													//---------------------------------------------------------------
													?>
												</select>
											</div>
										</div> 
									</div>	
								</div>
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
								
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" formaction="act_mmaterial_edit.php" formmethod="post" name="BotonEdit"><span class="fa fa-save"></span> Grabar Material</button>
								</form>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>				
</div>

</BODY>
</HTML> 