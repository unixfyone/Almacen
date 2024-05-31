
<style type="text/css">
.w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}

table thead th {
    vertical-align: bottom;
    border-bottom: 3px solid #cccccc;
}
table th, table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 2px solid #dee2e6;
}

th {background-color: transparent;
	color: #343a40;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}
</style>
<?php

$MOP = $_GET["MOP"];
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_user_menus 
INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
Where wh_user_menus.user_id = '$userid' and wh_user_menus.menuop_id = '$MOP' ";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$add = $Fila1["usermn_add"];
$edit = $Fila1["usermn_edit"];
$del = $Fila1["usermn_del"];
$actua = $Fila1["menuop_act"];
} 
mysqli_free_result ($Registro1);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>