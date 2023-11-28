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
include('headerx.php');
include('unico.php');
?>

<html>
<head>
<title>Equipos</title>

</head>
<BODY>

<?Php
echo '<FORM ACTION="" method="">';

//===============================================================
//============== EDITAR REGISTROS   ============================ 
if (isset($_POST['BotonEdit']))
{
$CIA = $_POST['CIA']; 	
$DEP = $_POST['DEP']; 	
$ASU = $_POST['ASU']; 
$RGB = $_POST['corporate_rgb']; 
$COLOR2 = $_POST['corporate_color2'];
$logo = $_POST['logo'];
$modi = date('Y-m-d');
//--------------------------
$SQL = "SELECT * FROM users 
Where id = '$ASU' ";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$lname = $Fila1["first_name"];
$fname = $Fila1["last_name"];
$email = $Fila1["email"];

} 
mysqli_free_result ($Registro1);

//--------------------------
$query = "INSERT INTO wh_user_details (user_id, company_id, first_name, last_name, user_email, corporate_color2, corporate_rgb, logo, modified) VALUES ('$ASU', '$CIA', '$lname', '$fname', '$email', '$COLOR2', '$RGB', '$logo', '$modi')";
mysqli_query ($link, $query);
?>
<div class="container">
<!-- Modal -->
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Usuarios del Sistema</b></font>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Info! </strong> Usuario Agregado Correctamente.
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='window.history.go(-3)' data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
			</div>
		</div>
    </div>
</div>
 <?Php
//==========
}
//==========
mysqli_close($link);
?>
<script>
function goBack() {
  window.history.go(-3);
}
</script>
</body>
</html>