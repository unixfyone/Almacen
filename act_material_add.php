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

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
</head>
<BODY>

<?Php
echo '<FORM ACTION="" method="Post">';

date_default_timezone_set('America/Caracas');

//echo "<pre>"; print_r($_POST["description_m"]); exit();
//echo "<pre>"; print_r($_POST["description_amp_m"]); exit();
//===============================================================
//============== AGREGAR REGISTROS   ============================
if (isset($_POST['BotonAdd']))
{
$company_id = $_POST['IDX']; 		// Codigo de Compañia
$zone_id = $_POST['ZOX']; 		// Codigo del Almacen

$code = $_POST["code"]; 		
$description = $_POST["description_m"];
$description_a = $_POST["description_amp_m"];	
$prefix = $_POST["prefix"];	
$code_sap = $_POST["code_sap"]; 		
$part_number = $_POST["part_number_m"]; 
$UNID = $_POST["UNID"];
$wh_line_id = $_POST["LIX"];
$CAT = $_POST["CAT"];
$SCAT = $_POST["SCAT"];
$MARC = $_POST["MARC"];
$type_material = $_POST["type_material"];
$type_tm2_id = $_POST["type_tm2_id"];
$clas_tm2_id = $_POST["clas_tm2_id"];

$ubication = $_POST["ubication"];
$cost_me = $_POST["cost_me"];	
//$cost_ml = $_POST["cost_ml"];
$reorder = $_POST["reorder"];
$fill = $_POST["fill"];	
//-------------------------- 
$query = "select *, COUNT(code) AS ctacode from wh_materials
where company_id = '$company_id' and zone_id = '$zone_id' and code = '$code'
";
		$Registro = mysqli_query($link,$query);
		while($row = mysqli_fetch_array($Registro))
		{
			$CTA1 = $row['ctacode'];
		}
		mysqli_free_result ($Registro);
		//========
		if ($CTA1 == '0')			// Existen el Material
		{
//-------------------------- 
$SQL = "INSERT INTO wh_materials (company_id, zone_id, code, description_m, description_amp_m, prefix, code_sap, part_number_m, wh_measurement_unit_id_m, wh_line_id_m, wh_category_id_m, wh_subcategory_id_m, wh_brand_id_m, type_material_m, type_tm2_id, clas_tm2_id, ubication, cost_me, reorder, fill) VALUES ('$company_id', '$zone_id', '$code', '$description', '$description_a', '$prefix', '$code_sap', '$part_number', '$UNID', '$wh_line_id', '$CAT', '$SCAT', '$MARC', '$type_material', '$type_tm2_id', '$clas_tm2_id', '$ubication', '$cost_me', '$reorder', '$fill')";
//--------------------------
mysqli_query ($link, $SQL);
//---------------------------

//echo "<pre>"; print_r($SQL); exit();

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
					<h5><strong>Info! </strong> Favor Verificar, el Material Existe en la Compañia/Almacen..
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