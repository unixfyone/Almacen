<?php

//menugr_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_menu_groups (menugr_name) 
		VALUES (:menugr_name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_name'	=>	$_POST["menugr_name"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Grupo de Opciones Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_menu_groups WHERE menugr_id = :menugr_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_id'	=>	$_POST["menugr_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['menugr_name'] = $row['menugr_name'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_menu_groups set menugr_name = :menugr_name  
		WHERE menugr_id = :menugr_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_name'	=>	$_POST["menugr_name"],
				':menugr_id'	=>	$_POST["menugr_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Grupo de Opciones Editado';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_menu_groups 
		SET menugr_statu = :menugr_statu 
		WHERE menugr_id = :menugr_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_statu'	=>	$status,
				':menugr_id'		=>	$_POST["menugr_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Grupo cambio de status a ' . $status;
		}
	}
}

?>