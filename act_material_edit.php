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

//===============================================================
//============== AGREGAR REGISTROS   ============================
if (isset($_POST['BotonEdit']))
{
$CIA = $_POST['CIA']; 		// Codigo de Compañia
$ZON = $_POST['ZON']; 		// Codigo del Almacen
$IDX = $_POST['IDX'];
$CT1 = $_POST['CT1'] + '1';

$code = $_POST["code"]; 		
$description_a = $_POST["description_a"];	
$prefix = $_POST["prefix"]; 	
$code_sap = $_POST["code_sap"]; 		
$part_number = $_POST["part_number"]; 
$CAT = $_POST["CAT"];
$SCAT = $_POST["SCAT"];
$MARC = $_POST["MARC"];
$ubication = $_POST["ubication"];
$cost_me = $_POST["cost_me"];	
//$cost_ml = $_POST["cost_ml"];
$reorder = $_POST["reorder"];
$fill = $_POST["fill"];	
//-------------------------- 
$SQL = "UPDATE wh_materials set
description_amp_m = '$description_a', prefix = '$prefix', code_sap = '$code_sap', part_number_m = '$part_number', wh_category_id_m = '$CAT', wh_subcategory_id_m = '$SCAT', wh_brand_id_m = '$MARC', ubication = '$ubication', cost_me = '$cost_me', reorder = '$reorder', fill = '$fill'
WHERE id = '$IDX' ";
//--------------------------
//echo "<pre>"; print_r($SQL); exit();
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