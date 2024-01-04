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
<title>Movimientos de Almacen</title>

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">

</head>
<BODY>

<?Php
echo '<FORM ACTION="" method="">';

$CT1 = $_POST['CT1'];
$CT1++;

 //=================   Agregar Salidas  Transito ============================
 
if (isset($_POST['BotonAdd']))
{
$CIAX = $_POST['CIAX'];
$ZON = $_POST['ZON'];	
$MDOC = $_POST['mth_doc']; 
$FEC = $_POST['mth_fecha'];
$MEJE = $_POST['mth_ejer'];
$MPER = $_POST['mth_per'];
		
if(isset($_POST["company_id"]))$cia_recep = $_POST["company_id"];		
else $cia_recep = '';
if(isset($_POST["department_id2"]))$dep_recep = $_POST["department_id2"];		
else $dep_recep = '';
if(isset($_POST["user_receptor"]))$usr_recep = $_POST["user_receptor"];		
else $usr_recep = '';
$dep_desp= $_POST['department_id'];
$usr_desp= $_POST['user_despachador'];
$dep_apro= $_POST['department_id3'];
$usr_apro= $_POST['user_aprobador'];
//--------------------------
	$SQL = "
		INSERT INTO wh_tranmovinvh 
		(mth_cia, mth_zone, mth_doc, mth_fecha, mth_ejer, mth_per, cia_receptor, dep_receptor, user_receptor, dep_despachador, user_despachador, dep_aprobador, user_aprobador, mth_user) 
		VALUES 
		('$CIAX', '$ZON', '$MDOC', '$FEC', '$MEJE', '$MPER', '$cia_recep', '$dep_recep', '$usr_recep', '$dep_desp', '$usr_desp', '$dep_apro', '$usr_apro', '$userid')
		";

mysqli_query ($link, $SQL);
//--------------------------
?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Agregar Salidas</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Documento de Salidas Agregado Correctamente.
				</div>
			</div>
			<div class="modal-footer">
				<?php
				echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"mov_transito3.php?mth_doc=$MDOC&zone=$ZON&CT1=$CT1 \"><i class='fa fa-check'></i> Aceptar</a>";
				?>
			</div>
		</div>
    </div>
</div>
 <?Php
 
 echo "<pre>"; print_r($SQL); exit();
 
//==========
}
if (isset($_POST['BotonUpd']))
{
$IDX = $_POST['IDX']; 	
//$MDOC = $_POST['movh_doc']; 
$TMID = $_POST['TMID'];
$ORCO= $_POST['movh_oc'];
$movh_tentrega= $_POST['movh_tentrega'];
$movh_receptor= $_POST['movh_receptor'];
if(isset($_POST["ciarec"]))$cia_recep = $_POST["ciarec"];		
else $cia_recep = '';
if(isset($_POST["dptrec"]))$dep_recep = $_POST["dptrec"];		
else $dep_recep = '';
if(isset($_POST["usrrec"]))$usr_recep = $_POST["usrrec"];		
else $usr_recep = '';
$dep_desp= $_POST['dptdes'];
$usr_desp= $_POST['usrdes'];
$dep_apro= $_POST['dptapr'];
$usr_apro= $_POST['usrapr'];
$MODIF = date('Y-m-d');

//echo "<pre>"; print_r($movh_tentrega); exit();
//--------------------------
		$query = "UPDATE wh_movinvh 
		set movh_tmid = '$TMID',
		movh_oc = '$ORCO',
		movh_tentrega = '$movh_tentrega',
		movh_receptor_e = '$movh_receptor',
		cia_receptor_es = '$cia_recep',
		dep_receptor_es = '$dep_recep',
		user_receptor_es = '$usr_recep',
		dep_despachador = '$dep_desp',
		user_despachador = '$usr_desp',
		dep_aprobador = '$dep_apro',
		user_aprobador = '$usr_apro',
		movh_user_m = '$userid',
		modified = '$MODIF'
		WHERE movh_id = '$IDX'
		";

mysqli_query ($link, $query);

//echo "<pre>"; print_r($query); exit();
//--------------------------
 echo"<script type='text/javascript'>
alert('!Documento Editado Correctamente....')
window.history.go(-$CT1)
</script>";
//==========
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