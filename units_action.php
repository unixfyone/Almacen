<?php
include('database_connection.php');
if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_measurement_units (acronym, name) 
		VALUES (:acronym, :name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':acronym'	=>	$_POST["acronym"],
				':name'	=>	$_POST["name"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Unidad Agregada';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_measurement_units WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['acronym'] = $row['acronym'];
			$output['name'] = $row['name'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_measurement_units 
		set acronym = :acronym,
		name = :name,
		modified = :modified
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':acronym'		=>	$_POST["acronym"],
				':name'		=>	$_POST["name"],
				':modified'		=>	date("Y-m-d"),
				':id'		=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Unidad Editada';
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
		UPDATE wh_measurement_units 
		SET statu = :statu
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statu'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Unidad cambio de status a ' . $status;
		}
	}
}

?>