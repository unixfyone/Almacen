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
//include('headerx.php');
include('unico.php');
?>

<html>
<head>
<title>Movimientos de Almacen</title>

</head>
<BODY>

<?Php
echo '<FORM ACTION="" method="">';

$MID = $_POST['MID'];
if($MID == 'Entradas'){
//===============================================================
//============== ADD/EDITAR REGISTROS   ============================

if (isset($_POST['BotonAdd']))
{
$CIAX = $_POST['CIAX']; 	
$ZON = $_POST['ZON']; 	
$MDOC = $_POST['movh_doc']; 
$TMID = $_POST['tm_id'];		
$FEC = $_POST['movh_fecha'];
$MEJE = $_POST['movh_ejer'];
$MPER = $_POST['movh_per'];
$MPROC= $_POST['movh_proce'];
$MPROVE= $_POST['movh_prove_id'];
$ORCO= $_POST['movh_oc'];
$RECDEP= $_POST['department_id2'];
$RECUSR= $_POST['user_receptor'];
//--------------------------
$SQL = "
INSERT INTO wh_movinvh 
(movh_cia, movh_zone, movh_doc, movh_tmid, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_proce, movh_prove_id,  movh_oc, cia_receptor_es, dep_receptor_es, user_receptor_es, movh_user) 
VALUES 
('$CIAX', '$ZON', '$MDOC', '$TMID', '$MID', '$FEC', '$MEJE', '$MPER', '$MPROC', '$MPROVE', '$ORCO', '$CIAX', '$RECDEP', '$RECUSR', '$userid')
";
mysqli_query ($link, $SQL);
//--------------------------
//--------------------------
$SQL = "SELECT * FROM wh_zones
Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$idzon = $row["zone_id"];
$zone_doc_em = $row["zone_doc_em"];
} 
mysqli_free_result ($RegistroA);
//-----------------------------
$zone_doc_em = ($zone_doc_em + 1);

$query= "UPDATE wh_zones
set zone_doc_em = '$zone_doc_em' 
where zone_id = '$idzon'
";
mysqli_query ($link, $query);
//-----------------------------
//-----------------------------
header("location:entproduct_03V2.php?movh_doc=$MDOC&zone=$ZON");
}
//======================================================================
if (isset($_POST['BotonUpd']))
{
$IDX = $_POST['IDX']; 	
$TMID = $_POST['TMID'];
$FEC = $_POST['movh_fecha'];
$MPROC= $_POST['movh_proce'];
$MPROVE= $_POST['PROVE'];
$ORCO= $_POST['movh_oc'];
$ciarec = $_POST['ciarec'];
$dptrec = $_POST['dptrec'];
$usrrec = $_POST['usrrec'];
$MODIF = date('Y-m-d');
//--------------------------
		$query = "UPDATE wh_movinvh 
		set movh_tmid = '$TMID',
		movh_fecha = '$FEC',
		movh_proce = '$MPROC',
		movh_prove_id = '$MPROVE',
		movh_oc = '$ORCO',
		cia_receptor_es = '$ciarec',
		dep_receptor_es = '$dptrec',
		user_receptor_es = '$usrrec',
		movh_user_m = '$userid',
		modified = '$MODIF'
		WHERE movh_id = '$IDX'
		";

mysqli_query ($link, $query);

//echo "<pre>"; print_r($query); exit();

//--------------------------
 echo"<script type='text/javascript'>
alert('!Documento Editado Correctamente....')
window.history.go(-2)
</script>";
//==========
}
//<!--===============================================================  -->
//<!--  Agregar / Editar Salidas ====================================  -->
//<!--===============================================================  -->
} else {
 //=================   Agregar Salidas   ============================
 
if (isset($_POST['BotonAdd']))
{
$CIAX = $_POST['CIAX'];
$ZON = $_POST['ZON'];	
$MDOC = $_POST['movh_doc'];
$TMID = $_POST['tm_id'];
$FEC = $_POST['movh_fecha'];
$MEJE = $_POST['movh_ejer'];
$MPER = $_POST['movh_per']; 
$ORCO= $_POST['movh_oc'];
$movh_tentrega= $_POST['movh_tentrega'];
$recep_ext= $_POST['movh_receptor_e'];
$cia_recep= $_POST['cia_receptor_es'];
$dep_recep= $_POST['dep_receptor_es'];
$usr_recep= $_POST['user_receptor_es'];
$dep_desp= $_POST['dep_despachador'];
$usr_desp= $_POST['user_despachador'];
$dep_apro= $_POST['dep_aprobador'];
$usr_apro= $_POST['user_aprobador'];
//--------------------------
$SQL = "
		INSERT INTO wh_movinvh 
		(movh_cia, movh_zone, movh_doc, movh_tdoc, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_oc, movh_tentrega, movh_receptor_e, cia_receptor_es, dep_receptor_es, user_receptor_es, dep_despachador, user_despachador, dep_aprobador, user_aprobador) 
		VALUES 
		('$CIAX', '$ZON', '$MDOC', '$MTDOC', '$MID', '$FEC', '$MEJE', '$MPER', '$ORCO', '$movh_tentrega', '$recep_ext', '$cia_recep', '$dep_recep', '$usr_recep', '$dep_desp', '$usr_desp', '$dep_apro', '$usr_apro')
		";
mysqli_query ($link, $SQL);
//--------------------------
//--------------------------
$SQL = "SELECT * FROM wh_zones
Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$idzon = $row["zone_id"];
$zone_doc_sm = $row["zone_doc_sm"];
} 
mysqli_free_result ($RegistroA);
//-----------------------------
$zone_doc_sm = ($zone_doc_sm + 1);

$query= "UPDATE wh_zones
set zone_doc_sm = '$zone_doc_sm' 
where zone_id = '$idzon'
";
mysqli_query ($link, $query);
//-----------------------------
header("location:entproduct_03V2.php?movh_doc=$MDOC&zone=$ZON");
//-----------------------------
}
if (isset($_POST['BotonUpd']))
{
$IDX = $_POST['IDX']; 	
$MDOC = $_POST['movh_doc']; 
$MTDOC = $_POST['movh_tdoc'];
$FEC = $_POST['movh_fecha'];
$MPROC= $_POST['movh_proce'];
$MPROVE= $_POST['PROVE'];
$ORCO= $_POST['movh_oc'];
$movh_tentrega= $_POST['movh_tentrega'];
$movh_receptor= $_POST['movh_receptor'];
$movh_despachador= $_POST['movh_despachador'];
$MODIF = date('Y-m-d');
//--------------------------
		$query = "UPDATE wh_movinvh 
		set movh_doc = '$MDOC',
		movh_tdoc = '$MTDOC',
		movh_fecha = '$FEC',
		movh_proce = '$MPROC',
		movh_prove_id = '$MPROVE',
		movh_oc = '$ORCO',
		movh_tentrega = '$movh_tentrega',
		movh_receptor = '$movh_receptor',
		movh_despachador = '$movh_despachador',
		modified = '$MODIF'
		WHERE movh_id = '$IDX'
		";

mysqli_query ($link, $query);
//--------------------------
?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Movimientos de Materiales</b></font>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Documento Editado Correctamente.
				</div>
			</div>
			<div class="modal-footer" style="background-color:#FFFFFC">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='window.history.go(-2)' data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Aceptar</button>
			</div>
		</div>
    </div>
</div>
 <?Php 
 } 
 }
 ?>
<!--===============================================================  -->
<script>
function goBack() {
  window.history.go(-2);
}
</script>
</body>
</html>