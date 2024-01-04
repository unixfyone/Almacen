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

echo '<FORM ACTION="act_material_add.php" method="POST">';
//---------------------------------------------------------------
if(isset($_GET["IDX"]))$IDX = $_GET["IDX"];
else $IDX = '';
//-------------
if(isset($_GET["ZOX"]))$ZOX = $_GET["ZOX"];
else $ZOX = '';
//-------------
if(isset($_GET["LIX"]))$LIX = $_GET["LIX"];
else $LIX = '';
//-------------
if(isset($_GET["CP"]))$CP = $_GET["CP"];
else $CP = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZOX' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$DCIA = $FilaA["company"];
$PREFIX = $FilaA["zone_prefix"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_lines
Where id = '$LIX' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$acronym = $row["acronym"];
$namel = $row["namel"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
$query = "SELECT mmat.* FROM wh_master_materials mmat
WHERE mmat.code = '$CP'";

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
//---------------------------------------------------------------
//---------------------------------------------------------------
$PREFIX1 = $PREFIX.'-'.$acronym;
$CODSAP = $PREFIX1.'-'.$code;
?>
<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">
<Input Type="hidden" name="ZOX" value="<?Php echo $ZOX ?>">
<Input Type="hidden" name="LIX" value="<?Php echo $LIX ?>">

<Input Type="hidden" name="description_m" value="<?Php echo $description ?>">
<Input Type="hidden" name="description_amp_m" value="<?Php echo $description_a ?>">

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Materiales Almacen
					</font></h2>
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
							<font color="#FFFFFF" size="5px">Agregar Material</font>
						</div>
						<!-- /.card-header -->

						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" ize="4px">Compañia.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $DCIA ; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacén.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Línea.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $namel; ?></font></span>
										</div>
									</div>	
								</div>	
								<hr class="elevation-1" color="#CCCCCC" >
								<!-- =============================== -->
								<?Php include('function.php'); ?>
								<div class="row">  
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Código Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="code" id="code" class="form-control" placeholder="Código del Material" value="<?Php echo $code ?>" readonly />
											</div>
										</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Descripción del Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="200" name="description_m" id="description_m" class="form-control" value="<?Php echo $description; ?>"  readonly />
											</div>
										</div>                                 
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Descripción Ampliada del Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="200" name="description_amp_m" id="description_amp_m" class="form-control" value="<?Php echo $description_a; ?>" placeholder="Descripción Ampliada del Material" readonly />
											</div>
										</div>                                 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Prefijo-Línea</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="25" name="prefix" id="prefix" class="form-control" placeholder="Prefijo de la línea" value="<?Php echo $PREFIX1; ?>" required />	
											</div>
										</div>                                 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">  Código SAP</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="code_sap" id="code_sap" class="form-control" value="<?Php echo $CODSAP; ?>" required />
											</div>
										</div>                                 
									</div>                
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Número de Parte</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="part_number_m" id="part_number_m" class="form-control" value="<?Php echo $part_number; ?>" readonly />
											</div>
										</div> 
									</div>

								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Unidad de Medida</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="UNID" readonly >
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
											<label><font color="#505050" size="3px"> Categoría</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="CAT" readonly >
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
											<label><font color="#505050" size="3px">SubCategoría</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="SCAT" readonly >
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
											<label><font color="#505050" size="3px"> Ubicación</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="ubication" id="ubication" class="form-control"  required />
											</div>
										</div> 
									</div>  
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Marca</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="MARC" readonly >
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
											<label><font color="#505050" size="3px"> Tipo Material</font></label>
											<div class="input-group-prepend">
												<select name="type_material" id="type_material" class="form-control" readonly>
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
												<select name="type_tm2_id" class="form-control" onChange="javascrip:form.submit()" disabled>
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
												<select name="clas_tm2_id" class="form-control" onChange="javascrip:form.submit()" disabled>
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
								<div class="row">                                
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Costo Moneda Extranjera</font></label>
											<div class="input-group-prepend">
												<input type="text" name="cost_me" id="cost_me" class="form-control" value="0" />
											</div>								
										</div> 
									</div>

									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Stock Minimo</font></label>
											<div class="input-group-prepend">
												<input type="text" name="reorder" id="reorder" class="form-control" value="0"/>
											</div>	
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Stock Maximo</font></label>
											<div class="input-group-prepend">
												<input type="text" name="fill" id="fill" class="form-control" value="1"/>
											</div>	
										</div> 
									</div> 
								</div>	
					
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" id="BotonAdd" name="BotonAdd"><span class="fa fa-save"></span> Grabar Material</button>								
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
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