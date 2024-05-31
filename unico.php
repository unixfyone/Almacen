<style type="text/css">
p {
    margin-top: 0em;
    margin-bottom: 0em;
    height: 18px;
}
</style>
<?php
$userid= $_SESSION['user_id'];
$ccolor2= $_SESSION['corporate_color2'];
$cia= $_SESSION['company_id'];
//===============================
include_once 'Conex.php';
$link=Conectarse();
//===============================
$SQL = "SELECT * FROM wh_user_details 
INNER JOIN companies ON companies.id = wh_user_details.company_id
Where wh_user_details.user_id = '$userid'";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$ccolor = $Fila1["corporate_color"];
$cstyle = $Fila1["corporate_style"];
} 
mysqli_free_result ($Registro1);
//===============================
?>