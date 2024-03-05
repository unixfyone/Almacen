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
<BODY>

<?Php
echo '<FORM ACTION="" method="Post">';

date_default_timezone_set('America/Caracas');

//===============================================================
//============== AGREGAR REGISTROS   ============================
if (isset($_POST['BotonAdd']))
{
$CDOCH = $_POST['mhid']; 		// Codigo de Cabezera Documento
$CIAX = $_POST['mhcia']; 		// Codigo de Compañia
$MHDOC = $_POST['mhdoc']; 		// Numero de Documento
$ALMCOD = $_POST['mhalm']; 		// Codigo del Almacen
$CMOV = $_POST['tmid']; 		// Codigo del Movimiento
$TMOV = $_POST['mhtm'];			// Tipo Movimiento (E/S)
$FECDOC = $_POST['mfdoc']; 		// Fecha del Documento
$AA = $_POST['mpera']; 			// Año del Ejercicio
$MM = $_POST['mperm']; 			// Mes o Periodo del Ejercicio
$PROID = $_POST['pid']; 		// ID. Producto
$PROD = $_POST['prod2']; 		// Codigo Producto
$CANT = $_POST['CANT'];			// Cantidad del Producto
$CANTXE = $_POST['CANTXE'];			// Cantidad Existencia del Producto
if(isset($_POST["CUNIME"]))$CostoUE = $_POST["CUNIME"];		//Costo Unitario ME
else $CostoUE = '0';
if(isset($_POST["movd_tasa_cambio"]))$tasac = $_POST["movd_tasa_cambio"];		//Tasa de cambio
else $tasac = '0';
//-----
$DMOV = $_POST['dmov'];			// Descripcion Movimiento
$TSAL = $_POST['tipsal'];		// Tipo de Salida
$CID = $_POST['c_id'];					// Condicion del Material
$movd_trans = $_POST['movd_trans'];		// Tipo de Transaccion
$USER = $_POST['user'];					// Usuario Creador
$consumo = $_POST['movd_id_cons'];			// ID del Consumo
$obs = $_POST['movd_obs'];				// Observaciones

$cia_receptor = $_POST['company_id'];
$dpt_receptor = $_POST['department_id2'];
$usr_receptor = $_POST['user_receptor'];
$dpt_aprobador = $_POST['department_id3'];
$usr_aprobador = $_POST['user_aprobador'];
$dpt_despachador = $_POST['department_id'];
$usr_despachador = $_POST['user_despachador'];
//--------------------------
if ($CANT > $CANTXE ) { 
//==========
 echo"<script type='text/javascript'>
alert('!ERROR CANTIDAD DE SALIDA MAYOR A LA EXISTENCIA DEL MATERIAL....')
window.history.go(-1)
</script>";
//==========
} else {
//--------------------------
$SQL = "INSERT INTO wh_movinvd 
(movh_id, movd_cia, movh_doc, movd_zone, tm_id, movd_tmov, movd_fecha, movd_ejer, movd_per, product_id, product_cod, movd_cant, movd_costou_me, movd_tasa_cambio, movd_desc, movd_tipsal, movd_cond, movd_id_cons, movd_trans, cia_receptor_d,  dep_receptor_d, user_receptor_d, dep_aprobador_d, user_aprobador_d, dep_despachador_d, user_despachador_d, user_id, movd_obs) 
VALUES 
('$CDOCH', '$CIAX', '$MHDOC', '$ALMCOD', '$CMOV', '$TMOV', '$FECDOC', '$AA', '$MM', '$PROID', '$PROD', '$CANT', '$CostoUE', '$tasac', '$DMOV', '$TSAL', '$CID', '$consumo', '$movd_trans', '$cia_receptor', '$dpt_receptor', '$usr_receptor', '$dpt_aprobador', '$usr_aprobador', '$dpt_despachador', '$usr_despachador', '$userid', '$obs')";
	
//-------------------------- 
mysqli_query ($link, $SQL);

//echo "<pre>"; print_r( $SQL); exit();

?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Movimientos de Productos</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Movimiento Agregado Correctamente.
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