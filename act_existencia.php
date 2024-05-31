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

include('unico.php');

$query = "SELECT * FROM wh_movinvd
where movd_cia = '16' and movd_statu = 'Cerrado' and movd_tmov = 'SALIDAS'
";
$Registro2 = mysqli_query($link,$query);
while($row2 = mysqli_fetch_array($Registro2))
{	
	$cia = $row2["movd_cia"];
	$pcod = $row2["product_cod"];
	$movid = 0;

	if ($row2["movd_tmov"] == 'ENTRADAS' ) {
		$movid = $row2["movd_cant"];
	} else {
		$movid = $row2["movd_cant"] * -1;
	}
	//=======================================
	$SQL1 = "SELECT * FROM wh_materials
	where company_id = '16' and code = '$pcod'
	";
	$Registro1 = mysqli_query($link,$SQL1);
	while($row1 = mysqli_fetch_array($Registro1))
	{	
		$exist = $row1["existence"] + $movid;
	}
	mysqli_free_result ($Registro1);
	//=======================================	
	$query9 = "
	UPDATE wh_materials SET existence = '$exist'
	WHERE company_id = '$cia' and code = '$pcod'
	";
	mysqli_query($link,$query9);	
	
	
}
mysqli_free_result ($Registro2);
	
?>