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
include('header.php');

$userid= $_SESSION['user_id'];
$usr_email = $_SESSION['user_email'];
$ccolor2= $_SESSION['corporate_color2'];

?>

<HTML>
<HEAD>
<TITLE>Opciones </TITLE>

<style type="text/css">
table, td, th {border: 2px solid #CCCCCC;}

th {background-color: <?=$ccolor2;?>;
	color: white;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 13px;
}
td {font-size: 13px;}

table.border, td.border {border: 0px;}
p {
	margin-top: 5px;
    margin-bottom: 0em;
	height: 20px;
}
a {
    color: #303030;
    text-decoration: none;
}
</style>

</HEAD>

<?Php

//Conexion con la base ------------------------------------------
   include_once("Conex.php"); 
   $link=Conectarse(); 
//---------------------------------------------------------------
$GRPX= $_GET['GRP'];
//---------------------------------------------------------------
$SQLx = "SELECT * FROM ait_user_menus
INNER JOIN ait_user_details ON ait_user_details.user_id = ait_user_menus.user_id
INNER JOIN ait_menu_groups ON ait_menu_groups.menugr_id = ait_user_menus.menugr_id
INNER JOIN ait_menu_options ON ait_menu_options.menuop_id = ait_user_menus.menuop_id
WHERE ait_user_details.user_id = '$userid' and ait_menu_groups.menugr_name = '$GRPX' and ait_user_menus.usermn_statu = 'Activo' ORDER BY ait_menu_options.menuop_desc";
//--------

echo "<Table bgcolor=CCCCCC Align=Left width=25%>";
echo "<TR>";
echo "<TH bgcolor=#00CCFF ><p><font color=#FFFFFF> $GRPX </font></p>";
echo "</TR>";
$contador = 0;

$Registro = mysqli_query($link,$SQLx);
while ($Fila=mysqli_fetch_array($Registro))
{
echo "<Tr>";
echo "<td bgcolor=FFFFFF align=Left><p>&nbsp;&nbsp;<font ><b><A HREF={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. ">";
echo $Fila['menuop_desc']."</a></b></font></p></td>";
}
mysqli_free_result ($Registro);
echo "</Table>";
//================================================
mysqli_close($link);

?>
<BR>

</HTML> 