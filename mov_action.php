<?php
include('database_connection.php');
include('function.php');

//===============================================
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'load_usuarios')
	{
		echo fill_user_department_list($connect, $_POST['department_id']);
	}
		
	if($_POST['btn_action'] == 'load_usuarios2')
	{
		echo fill_user_department_list($connect, $_POST['department_id2']);
	}
		
	if($_POST['btn_action'] == 'load_usuarios3')
	{
		echo fill_user_department_list($connect, $_POST['department_id3']);
	}
	
	if($_POST['btn_action'] == 'load_department')
	{
		echo fill_departments_list($connect, $_POST['company_id']);
	}	
//===============================================
}
?>