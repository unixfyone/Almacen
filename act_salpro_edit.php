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
<title>Movimientos Almacen</title>


</head>
<BODY bgcolor=FFFFFF>

<?Php
echo '<FORM ACTION="" method="Post">';

date_default_timezone_set('America/Caracas');

//echo 'AAAAAAAAAAAAAAAAAAAAAAAA';
//echo $_POST['drecibe'];
//echo $_POST['recibe'];
//===============================================================
//============== Editar REGISTROS   ============================
if (isset($_POST['BotonEdit']))
{
$CDOCD = $_POST['IDM2'];		// Codigo de Detalle Documento
$CDOCH = $_POST['mhid']; 		// Codigo de Cabezera Documento
$CMOV = $_POST['tmcod']; 		// Codigo del Movimiento
$TMOV = $_POST['mhtm'];			// Tipo Movimiento (E/S)
$PROID = $_POST['pid']; 		// ID. Producto
$PROD = $_POST['prod2']; 		// Codigo Producto
$CANT = $_POST['mdcant'];			// Cantidad del Producto
$CostoUE = $_POST["CUNIME"];		//Costo Unitario ME
$tasac = $_POST["tasa"];		//Tasa de cambio
//-----
$DMOV = $_POST['dmov'];			// Descripcion Movimiento
$TSAL = $_POST['tipsal'];		// Tipo de Salida
$CID = $_POST['c_id'];					// Condicion del Material
$movd_trans = $_POST['movd_trans'];		// Tipo de Transaccion
$DEPREC = $_POST['drecibe'];		// Depart Receptor
$USERREC = $_POST['recibe'];		// Usuario Receptor
$DEPAPR = $_POST['daprueba'];		// Depart Aprobador
$USERAPR = $_POST['aprueba'];	// Usuario Aprobador
$consumo = $_POST['consumo'];		// ID del Consumo
$obs = $_POST['movd_obs'];				// Observaciones
$FECMOD = date("Y-m-d");		// Fecha de Modificar
//--------------------------
$SQL = "UPDATE wh_movinvd SET 
tm_id = '$CMOV',
movd_tmov = '$TMOV',
product_id = '$PROID',
product_cod = '$PROD',
movd_cant = '$CANT',
movd_costou_me = '$CostoUE',
movd_tasa_cambio = '$tasac',
movd_desc = '$DMOV',
movd_tipsal = '$TSAL',
movd_cond = '$CID',
movd_id_cons = '$consumo',
movd_trans = '$movd_trans',
dep_receptor = '$DEPREC',
user_receptor = '$USERREC',
dep_aprobador = '$DEPAPR',
user_aprobador = '$USERAPR',
modified = '$FECMOD'
WHERE movd_id = '$CDOCD' ";

//echo 'AAAAAAAAAAAAAAAAAAAAAAAA';
//echo $DEPREC;
//echo $USERREC;
//echo $DEPAPR;
//echo $USERAPR;  
//echo "<pre>"; print_r($SQL); exit();

//--------------------------
mysqli_query ($link, $SQL);

?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Entradas de Productos</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Entrada Modificada Correctamente.
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='goBack()' data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Aceptar</button>

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
  window.history.go(-3);
}
</script>
</body>
</html>