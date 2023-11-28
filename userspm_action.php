<?php

//userspm_action.php

include('database_connection.php');
include('function.php');

if(isset($_POST['btn_action']))
{
//========================================
		if($_POST['btn_action'] == 'load_opciones')
	{
		echo fill_menuop_list($connect, $_POST['menugr_id']);
	}
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_user_menus (user_id, menugr_id, menuop_id, usermn_add, usermn_edit, usermn_del) 
		VALUES (:user_id, :menugr_id, :menuop_id, :usermn_add, :usermn_edit, :usermn_del)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id'			=>	$_POST["user_id"],
				':menugr_id'		=>	$_POST["menugr_id"],
				':menuop_id'		=>	$_POST["menuop_id"],
				':usermn_add'		=>	'0',
				':usermn_edit'		=>	'0',
				':usermn_del'		=>	'0'
				
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{

		}
	}
//===============================================	
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_user_menus
		SET usermn_statu = :usermn_statu 
		WHERE usermn_id = :usermn_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':usermn_statu'	=>	$status,
				':usermn_id'		=>	$_POST["usermn_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{

		}
	}
}

?>