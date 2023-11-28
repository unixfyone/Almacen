<?php
include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}
if($_SESSION['type'] != 'Master')
{
	header('location:index2.php');
}
include('function.php');
include('headerx.php');
//include('unico_1.php');
?>
