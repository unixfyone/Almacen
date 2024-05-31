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
if (isset($_POST['BotonEdit']))
{
$IDX = $_POST['IDX'];
$CT1 = $_POST['CT1'] + '1';

$code = $_POST["code"]; 		
$description = $_POST["description"];
$description_a = $_POST["description_a"];	
$part_number = $_POST["part_number"]; 
$UNID = $_POST["UNID"];
$CAT = $_POST["CAT"];
$SCAT = $_POST["SCAT"];
$MARC = $_POST["MARC"];
$type_material = $_POST["type_material"];
$wh_tinv_id = $_POST["type_tm2_id"];
$wh_clastm2_id = $_POST["clas_tm2_id"];
$fecha = date("Y-m-d");
//-------------------------- 
//--------------------------
$SQL = "UPDATE wh_master_materials set
description = '$description', 
description_amp = '$description_a', 
part_number = '$part_number', 
wh_measurement_unit_id = '$UNID', 
wh_category_id = '$CAT', 
wh_subcategory_id = '$SCAT', 
wh_brand_id = '$MARC', 
type_material = '$type_material',
type_tm2_id = '$wh_tinv_id',
clas_tm2_id = '$wh_clastm2_id',
modified = '$fecha'
WHERE id = '$IDX' ";
//--------------------------
mysqli_query ($link, $SQL);
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
					<strong>Info! </strong> Material Editado Correctamente.
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
}
//===============================================================
mysqli_close($link);
?>
<script>
function goBack() {
  window.history.go(-"<?Php echo $CT1; ?>" );
}
</script>
</body>
</html>