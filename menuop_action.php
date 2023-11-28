<?php

//menuop_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_menu_options (menugr_id, menuop_desc, menuop_run_mn, menuop_act) 
		VALUES (:menugr_id, :menuop_desc, :menuop_run_mn, :menuop_act)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_id'		=>	$_POST["menugr_id"],
				':menuop_desc'		=>	$_POST["menuop_desc"],
				':menuop_run_mn'	=>	$_POST["menuop_run_mn"],
				':menuop_act'		=>	$_POST["menuop_act"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Opción Agregada..: ' .$_POST["menuop_desc"];
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_menu_options WHERE menuop_id = :menuop_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menuop_id'	=>	$_POST["menuop_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['menugr_id'] = $row['menugr_id'];
			$output['menuop_desc'] = $row['menuop_desc'];
			$output['menuop_run_mn'] = $row['menuop_run_mn'];
			$output['menuop_act'] = $row['menuop_act'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_menu_options 
		set menugr_id = :menugr_id,
		menuop_desc = :menuop_desc,
		menuop_run_mn = :menuop_run_mn,
		menuop_act = :menuop_act
		WHERE menuop_id = :menuop_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menugr_id'	=>	$_POST["menugr_id"],
				':menuop_desc'	=>	$_POST["menuop_desc"],
				':menuop_run_mn'	=>	$_POST["menuop_run_mn"],
				':menuop_act'	=>	$_POST["menuop_act"],
				':menuop_id'	=>	$_POST["menuop_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Opción Editada...:' .$_POST["menuop_desc"];
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
		UPDATE wh_menu_options
		SET menuop_statu = :menuop_statu 
		WHERE menuop_id = :menuop_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':menuop_statu'	=>	$status,
				':menuop_id'		=>	$_POST["menuop_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Opción cambio de status a ' . $status;
		}
	}
}

?>