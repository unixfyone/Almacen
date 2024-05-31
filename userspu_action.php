<?php

//userspm_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//===============================================

//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_user_menus
		INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
		INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
		INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
		Where wh_user_menus.usermn_id = :usermn_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':usermn_id'	=>	$_POST["usermn_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['user_name'] = $row["first_name"] .' '. $row["last_name"];
			$output['user_email'] = $row['user_email'];
			$output['menugr_name'] = $row['menugr_name'];
			$output['menuop_desc'] = $row['menuop_desc'];
			$output['usermn_add'] = $row['usermn_add'];
			$output['usermn_edit'] = $row['usermn_edit'];
			$output['usermn_del'] = $row['usermn_del'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_user_menus 
		SET usermn_add = :usermn_add,
		usermn_edit = :usermn_edit,
		usermn_del = :usermn_del
		WHERE usermn_id = :usermn_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':usermn_add' 		=>	$_POST["usermn_add"],
				':usermn_edit' 		=>	$_POST["usermn_edit"],
				':usermn_del' 		=>	$_POST["usermn_del"],
				':usermn_id'		=>	$_POST["usermn_id"]
			)
		);
		$result = $statement->fetchAll(); 
		if(isset($result))
		{
			echo 'Permisos Asignados a Usuario ..:' .$_POST["user_name"];
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
				':usermn_id'	=>	$_POST["usermn_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{

		}
	}
}

?>