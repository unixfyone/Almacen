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
include_once('unico_1.php');
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
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
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
if(isset($_GET["cost_me"]))$cost_me = $_GET["cost_me"];
else $cost_me = '';
//-------------
//if(isset($_GET["cost_ml"]))$cost_ml = $_GET["cost_ml"];
//else $cost_ml = '';
//-------------
if(isset($_GET["reorder"]))$reorder = $_GET["reorder"];
else $reorder = '';
//-------------
if(isset($_GET["fill"]))$fill = $_GET["fill"];
else $fill = '';
//-------------
if(isset($_GET["acronym"]))$acronym = $_GET["acronym"];
else $acronym = '';
//-------------
if(isset($_GET["namel"]))$namel = $_GET["namel"];
else $namel = '';
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
?>

<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="IDX" value="<?Php echo $IDX ?>">

<Input Type="hidden" name="code" value="<?Php echo $code ?>" />
<Input Type="hidden" name="description" value="<?Php echo $description ?>" />
<Input Type="hidden" name="description_a" value="<?Php echo $description_a ?>" />
<Input Type="hidden" name="prefix" value="<?Php echo $prefix ?>" />
<Input Type="hidden" name="code_sap" value="<?Php echo $code_sap ?>" />
<Input Type="hidden" name="part_number" value="<?Php echo $part_number ?>" />
<Input Type="hidden" name="MARC" value="<?Php echo $MARC ?>" />
<Input Type="hidden" name="UNID" value="<?Php echo $UNID ?>" />
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>" />
<Input Type="hidden" name="CAT" value="<?Php echo $CAT ?>" />
<Input Type="hidden" name="SCAT" value="<?Php echo $SCAT ?>" />
<Input Type="hidden" name="type_material" value="<?Php echo $type_material ?>" />
<Input Type="hidden" name="type_tm2_id" value="<?Php echo $type_tm2_id ?>" />
<Input Type="hidden" name="clas_tm2_id" value="<?Php echo $clas_tm2_id ?>" />
<Input Type="hidden" name="ubication" value="<?Php echo $ubication ?>" />
<Input Type="hidden" name="cost_me" value="<?Php echo $cost_me ?>" />
<Input Type="hidden" name="reorder" value="<?Php echo $reorder ?>" />
<Input Type="hidden" name="fill" value="<?Php echo $fill ?>" />	


<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">

<?php
if ($CT1 == '1') {
$query = "SELECT mat.*, mmat.* FROM wh_materials mat
INNER JOIN wh_master_materials mmat ON mmat.code = mat.code
WHERE mat.id = '$IDX'";

$Registro = mysqli_query($link,$query);
while($row = mysqli_fetch_array($Registro))
{
$code = $row["code"];
	
$description = $row["description"];
//$description = $row["description_m"];
$description_a = $row["description_amp_m"];
$prefix = $row["prefix"];
$code_sap = $row["code_sap"];
$part_number = $row["part_number_m"];

$UNID = $row["wh_measurement_unit_id"];
//$UNID = $row["wh_measurement_unit_id_m"];
$LIN = $row["wh_line_id_m"];
$CAT = $row["wh_category_id_m"];
$SCAT = $row["wh_subcategory_id_m"];
$MARC = $row["wh_brand_id_m"];
$type_material = $row["type_material_m"];
$type_tm2_id = $row["type_tm2_id"];
$clas_tm2_id = $row["clas_tm2_id"];
$ubication = $row["ubication"];
$cost_me = $row["cost_me"];
$cost_ml = $row["cost_ml"];
$reorder = $row["reorder"];
$fill = $row["fill"];
} 
mysqli_free_result ($Registro);
}
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_lines
Where id = '$LIN' ";
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
<Input Type="hidden" name="acronym" value="<?Php echo $acronym ?>" />
<Input Type="hidden" name="namel" value="<?Php echo $namel ?>" />
<Input Type="hidden" name="UNID" value="<?Php echo $UNID ?>" />
<Input Type="hidden" name="type_material" value="<?Php echo $type_material ?>" />
<Input Type="hidden" name="type_tm2_id" value="<?Php echo $type_tm2_id ?>" />
<Input Type="hidden" name="clas_tm2_id" value="<?Php echo $clas_tm2_id ?>" />	
<!--  ======================================================================================= -->

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Materiales Almacen </font></h2>
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
							<font color="#FFFFFF" size="5px">Editar Material</font>
						</div>
						<!-- /.card-header -->

						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Compañia.:  </font></label>
											&nbsp;&nbsp;<span><font color="#505050" size="4px"> <?Php echo $DCIA ; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacen.:  </font></label>
											&nbsp;&nbsp;<span><font color="#505050" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Linea.:  </font></label>
											&nbsp;&nbsp;<span><font color="#505050" size="4px"> <?Php echo $namel; ?></font></span>
										</div>
									</div>	
								</div>	
														
								<hr class="elevation-1" color="#CCCCCC" >
								<!-- =============================== -->
								<br>
								<div class="row">  
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Código Material</font></label>
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
												<input type="text" maxlength="200" name="description" id="description" class="form-control" value='<?Php echo $description; ?>'  readonly />
											</div>
										</div>                                 
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Descripción Ampliada del Material</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="200" name="description_a" id="description_a" class="form-control" value='<?Php echo $description_a; ?>' placeholder="Descripción Ampliada del Material" />
											</div>
										</div>                                 
									</div>
								</div>

								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Prefijo-Línea</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="25" name="prefix" id="prefix" class="form-control" value="<?Php echo $prefix; ?>" required />
											</div>
										</div>                                 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">  Código SAP</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="code_sap" id="code_sap" class="form-control" value="<?Php echo $code_sap; ?>" required />
											</div>
										</div>                                 
									</div>                
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Número de Parte</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="part_number" id="part_number" class="form-control" value="<?Php echo $part_number; ?>" />
											</div>
										</div> 
									</div>
								</div>	
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px"> Unidad de Medida</font></label>
											<div class="input-group-prepend">
												<select class="form-control" name="UNID" onChange="javascrip:form.submit()" disabled >
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
											<label><font color="#505050" FACE="times new roman" size="3px"> Ubicación</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="ubication" id="ubication" class="form-control" value="<?Php echo $ubication; ?>" required />
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
											<label><font color="#505050" FACE="times new roman" size="3px"> Tipo Material</font></label>
											<div class="input-group-prepend">
												<select name="type_material" id="type_material" class="form-control" disabled>
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
											<label><font color="#505050" FACE="times new roman" size="3px"> Costo Moneda Extranjera</font></label>
											<div class="input-group-prepend">
												<input type="text" name="cost_me" id="cost_me" class="form-control" value="<?Php echo $cost_me; ?>" />
											</div>								
										</div> 
									</div>
								
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">Stock Minimo</font></label>
											<div class="input-group-prepend">
												<input type="text" name="reorder" id="reorder" class="form-control" value="<?Php echo $reorder; ?>" />
											</div>	
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" FACE="times new roman" size="3px">Stock Maximo</font></label>
											<div class="input-group-prepend">
												<input type="text" name="fill" id="fill" class="form-control" value="<?Php echo $fill; ?>" />
											</div>	
										</div> 
									</div> 
								</div>	
								
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" formaction="act_material_edit.php" formmethod="post" name="BotonEdit"><span class="fa fa-save"></span> Grabar Material</button>
									
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>

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
<script>

$(document).ready(function(){
<!-- ********************* status del Registros ******************************** -->

<!-- ************************************************************************* -->
<!-- ********************* Lista para SubCategorias ****************************** -->

<!-- ************************************************************************* -->
})
</script>
</HTML> 