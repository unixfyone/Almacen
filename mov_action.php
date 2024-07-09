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
		
	if ($_POST['btn_action'] == 'load_usuarios2') {

		if (isset($_POST['department_id2']) && !empty($_POST['department_id2']) && isset($_POST['cia']) && !empty($_POST['cia'])) {
			echo fill_user_department_list($connect, $_POST['department_id2'], $_POST['cia']);
		} else {
			echo 'Error: Parámetros inválidos';
		}
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