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

echo '<FORM ACTION="act_mmaterial_add.php" method="POST">';
//---------------------------------------------------------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_lines
Where id = '$LIN' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$acronym = $row["acronym"];
$namel = $row["namel"];
$cont_cod = $row["cont_cod"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------

 if ($cont_cod < 10000 ) {
 $cont_cod1 = str_pad($cont_cod, 5, "0", STR_PAD_LEFT);
 } else { 
 $cont_cod1 = $cont_cod;
 }

?>
<Input Type="hidden" name="code" value="<?Php echo $cont_cod1 ?>">
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><font color="#<?=$ccolor;?>">Materiales Almacen</font></h1>
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
									<div class="col-lg-6">
										<div class="form-group">
											<label><font color="blue" size="4px">Linea del Material.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $acronym ." / ". $namel; ?></font></span>
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
												<input type="text" maxlength="45" name="code" id="code" class="form-control" value = "<?= $cont_cod1; ?>" readonly />
											</div>
										</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Descripción del Material</font></label>
											<div class="input-group-prepend">
												<textarea maxlength="200" name="description" id="description" class="form-control" rows="2" placeholder="Nombre / Descripción del Material" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
											</div>
										</div>                                 
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Descripción Ampliada del Material</font></label>
											<div class="input-group-prepend">
												<textarea maxlength="200" name="description_a" id="description_a" class="form-control" rows="2" placeholder="Descripción Ampliada del Material"  onkeyup="this.value = this.value.toUpperCase();"></textarea>
											</div>
										</div>                                 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Número de Parte</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="45" name="part_number" id="part_number" class="form-control" onkeyup="this.value = this.value.toUpperCase();" />
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Unidad de Medida</font></label>
											<div class="input-group-prepend">
												<select name="wh_measurement_unit_id" id="wh_measurement_unit_id" class="form-control" required>
													<option value="">Seleccionar Unidad</option>
													<?php echo fill_unit_list($connect); ?>
												</select>
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Marca</font></label>
											<div class="input-group-prepend">
												<select name="wh_brand_id" id="wh_brand_id" class="form-control" >
													<option value="">Seleccionar Marca</option>
													<?php echo fill_marcas_list($connect); ?>
												</select>									
											</div>
										</div> 
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px"> Categoría</font></label>
											<div class="input-group-prepend">
												<select name="wh_category_id" id="wh_category_id" class="form-control" required>
													<option value="">Seleccionar Categoria</option>
													<?php echo fill_categories_list($connect); ?>
												</select>									
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">SubCategoría</font></label>
											<div class="input-group-prepend">
												<select name="wh_subcategory_id" id="wh_subcategory_id" class="form-control" required>
													<option value="">Seleccionar SubCategoria</option>
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
												<select name="wh_type_material" id="wh_type_material" class="form-control" required>
													<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Seleccionar Tipo</option>
													<option value="ACCESORIOS">ACCESORIOS</option>
													<option value="CONSUMIBLES">CONSUMIBLES</option>
													<option value="INVENTARIO">INVENTARIO</option>
												<select>									
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Tipo de Inventario</font></label>
											<div class="input-group-prepend">
												<select name="wh_tinv_id" id="wh_tinv_id" class="form-control" required>
													<option value="">Seleccionar Tipo</option>
												</select>									
											</div>
										</div> 
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#505050" size="3px">Clasificacion Tipo Inventario</font></label>
											<div class="input-group-prepend">
												<select name="wh_clastm2_id" id="wh_clastm2_id" class="form-control" required>
													<option value="">Seleccionar Clasificacion</option>
												</select>									
											</div>
										</div> 
									</div>										
								</div>
					
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
									
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" id="BotonAdd" name="BotonAdd"><span class="fa fa-save"></span> Grabar Material</button>

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
<script>
$(document).ready(function(){

<!-- ********************* Lista para SubCategorias ****************************** -->
    $('#wh_category_id').change(function(){
        var wh_category_id = $('#wh_category_id').val();
        var btn_action = 'load_subcategories';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{wh_category_id:wh_category_id, btn_action:btn_action},
            success:function(data)
            {
                $('#wh_subcategory_id').html(data);
            }
        });
    });
<!-- ************************************************************************* -->
    $('#wh_type_material').change(function(){
        var wh_type_material = $('#wh_type_material').val();
        var btn_action = 'load_typematerial';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{wh_type_material:wh_type_material, btn_action:btn_action},
            success:function(data)
            {
                $('#wh_tinv_id').html(data);
            }
        });
    });
<!-- ************************************************************************* -->
    $('#wh_tinv_id').change(function(){
        var wh_tinv_id = $('#wh_tinv_id').val();
        var btn_action = 'load_ctypematerial';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{wh_tinv_id:wh_tinv_id, btn_action:btn_action},
            success:function(data)
            {
                $('#wh_clastm2_id').html(data);
            }
        });
    });
<!-- ************************************************************************* -->
})
</script>
</HTML> 