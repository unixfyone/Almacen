<?php

//marcas_action.php

include('database_connection.php');
//===============================================
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_conditions (c_description) 
		VALUES (:c_description)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':c_description'	=>	$_POST["c_description"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Description Agregada';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_conditions WHERE c_id = :c_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':c_id'	=>	$_POST["c_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['c_description'] = $row['c_description'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_conditions set 
		c_description = :c_description,
		modified = :modified
		WHERE c_id = :c_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':c_description'		=>	$_POST["c_description"],
				':modified'	=>	date("Y-m-d"),
				':c_id'		=>	$_POST["c_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Condicion Editada';
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
		UPDATE wh_conditions 
		SET c_statu = :c_statu
		WHERE c_id = :c_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':c_statu'	=>	$status,
				':c_id'		=>	$_POST["c_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Description cambiada de status a ' . $status;
		}
	}
}

?>