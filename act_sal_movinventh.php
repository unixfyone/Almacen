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

$MID = $_POST['MID'];

//<!--===============================================================  -->
//<!--  Agregar / Editar Salidas ====================================  -->
//<!--===============================================================  -->

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
$recep_ext = 'RECEPTORES INTERNOS';		
if(isset($_POST["company_id"]))$cia_recep = $_POST["company_id"];		
else $cia_recep = '';
if(isset($_POST["department_id2"]))$dep_recep = $_POST["department_id2"];		
else $dep_recep = '';
if(isset($_POST["user_receptor"]))$usr_recep = $_POST["user_receptor"];		
else $usr_recep = '';
$dep_desp= '';
$usr_desp= '';
$dep_apro= '';
$usr_apro= '';
//--------------------------
	$SQL = "
		INSERT INTO wh_movinvh 
		(movh_cia, movh_zone, movh_doc, movh_tmid, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_oc, movh_tentrega, movh_receptor_e, movh_user, movh_salint) 
		VALUES 
		('$CIAX', '$ZON', '$MDOC', '$TMID', '$MID', '$FEC', '$MEJE', '$MPER', '$ORCO', '$movh_tentrega', '$recep_ext', '$userid', '1')
		";

mysqli_query ($link, $SQL);
//--------------------------
//echo "<pre>"; print_r($SQL); exit();
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
				echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"entproduct_03V2S.php?movh_doc=$MDOC&zone=$ZON&CT1=$CT1 \"><i class='fa fa-check'></i> Aceptar</a>";
				?>
			</div>
		</div>
    </div>
</div>
 <?Php
//==========
}
if (isset($_POST['BotonUpd']))
{
$IDX = $_POST['IDX']; 	
$TMID = $_POST['TMID'];
$ORCO= $_POST['movh_oc'];
$movh_tentrega= $_POST['movh_tentrega'];
$MODIF = date('Y-m-d');
//--------------------------
		$query = "UPDATE wh_movinvh 
		set movh_oc = '$ORCO',
		movh_tentrega = '$movh_tentrega',
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