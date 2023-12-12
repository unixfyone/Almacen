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

$CT1 = $_POST['CT1'];
$CT1++;

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
//--------------------------
 echo"<script type='text/javascript'>
alert('!Documento Editado Correctamente....')
window.history.go(-$CT1)
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
$recep_ext = $_POST["movh_receptor"];		
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
if ($recep_ext == '') {
	$SQL = "
		INSERT INTO wh_movinvh 
		(movh_cia, movh_zone, movh_doc, movh_tmid, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_oc, movh_tentrega, movh_receptor_e, cia_receptor_es, dep_receptor_es, user_receptor_es, dep_despachador, user_despachador, dep_aprobador, user_aprobador, movh_user) 
		VALUES 
		('$CIAX', '$ZON', '$MDOC', '$TMID', '$MID', '$FEC', '$MEJE', '$MPER', '$ORCO', '$movh_tentrega', '$recep_ext', '$cia_recep', '$dep_recep', '$usr_recep', '$dep_desp', '$usr_desp', '$dep_apro', '$usr_apro', '$userid')
		";
} else {
	$SQL = "
		INSERT INTO wh_movinvh 
		(movh_cia, movh_zone, movh_doc, movh_tmid, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_oc, movh_tentrega, movh_receptor_e, dep_despachador, user_despachador, dep_aprobador, user_aprobador, movh_user) 
		VALUES 
		('$CIAX', '$ZON', '$MDOC', '$TMID', '$MID', '$FEC', '$MEJE', '$MPER', '$ORCO', '$movh_tentrega', '$recep_ext', '$dep_desp', '$usr_desp', '$dep_apro', '$usr_apro', '$userid')
		";
}
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
header("location:entproduct_03V2S.php?movh_doc=$MDOC&zone=$ZON");
//-----------------------------
//-----------------------------
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