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
$userid= $_SESSION['user_id'];
include('headerx.php');
include('unico.php');
?>

<html>
<head>
<title>Materiales Almacen</title>


</head>
<BODY>

<?Php
echo '<FORM ACTION="" method="Post">';

date_default_timezone_set('America/Caracas');

//===============================================================
//============== AGREGAR REGISTROS   ============================
if (isset($_POST['BotonAdd']))
{
$code = $_POST["code"]; 		
$description = $_POST["description"];
$description_a = $_POST["description_a"];	
$part_number = $_POST["part_number"]; 
$wh_measurement_unit_id = $_POST["wh_measurement_unit_id"];
$wh_line_id = $_POST["LIN"];
$wh_category_id = $_POST["wh_category_id"];
$wh_subcategory_id = $_POST["wh_subcategory_id"];
$wh_brand_id = $_POST["wh_brand_id"];
$type_material = $_POST["wh_type_material"];
$wh_tinv_id = $_POST["wh_tinv_id"];
$wh_clastm2_id = $_POST["wh_clastm2_id"];
//-------------------------- 
$query = "select code, COUNT(code) AS ctacode from wh_master_materials
where code = '$code'
";
		$Registro = mysqli_query($link,$query);
		while($row = mysqli_fetch_array($Registro))
		{
			$CTA1 = $row['ctacode'];
		}
		mysqli_free_result ($Registro);
		//========
		if ($CTA1 == '0')			// Existe el Material
		{
//-------------------------- 
$SQL = "INSERT INTO wh_master_materials (code, description, description_amp, part_number, wh_measurement_unit_id, wh_line_id, wh_category_id, wh_subcategory_id, wh_brand_id, type_material, type_tm2_id, clas_tm2_id) VALUES ('$code', '$description', '$description_a', '$part_number', '$wh_measurement_unit_id', '$wh_line_id', '$wh_category_id', '$wh_subcategory_id', '$wh_brand_id', '$type_material', '$wh_tinv_id', '$wh_clastm2_id')";
//--------------------------
mysqli_query ($link, $SQL);
//--------------------------
//--------------------------
$SQL = "SELECT * FROM wh_lines
Where id = '$wh_line_id' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$idlin = $row["id"];
$cont_cod = $row["cont_cod"] + '1';
} 
mysqli_free_result ($RegistroA);
//------------------------------
//------------------------------
$query= "UPDATE wh_lines 
set cont_cod = '$cont_cod' 
where id = '$idlin'
";
mysqli_query ($link, $query);
//================================
?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Materiales</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Material Agregado Correctamente.
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='goBack()' data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
			</div>
		</div>
    </div>
</div>
 <?Php
//==========
} else {
?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Materiales</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<h5><strong>Info! </strong> Favor Verificar, el Material Existe en Maestro de Materiales..
					</h5>
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='goBack()' data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
			</div>
		</div>
    </div>
</div>
 <?Php	
}
}
//===============================================================
mysqli_close($link);
?>
<script>
function goBack() {
  window.history.go(-2);
}
</script>
</body>
</html>