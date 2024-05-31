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



					$query9 = "
					UPDATE wh_materials SET existence = '0'
					WHERE company_id = '1'
					";
					mysqli_query($link,$query9);
								
								
								
?>