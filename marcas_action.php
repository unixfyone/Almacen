<?php

//marcas_action.php

include('database_connection.php');
//===============================================
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_brands (brand_name) 
		VALUES (:brand_name)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':brand_name'	=>	$_POST["brand_name"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Marca Agregada';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_brands WHERE brand_id = :brand_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':brand_id'	=>	$_POST["brand_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['brand_name'] = $row['brand_name'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_brands set 
		brand_name = :brand_name,
		modified = :modified
		WHERE brand_id = :brand_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':brand_name'		=>	$_POST["brand_name"],
				':modified'	=>	date("Y-m-d"),
				':brand_id'		=>	$_POST["brand_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Marca Editada';
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
		UPDATE wh_brands 
		SET brand_statu = :brand_statu
		WHERE brand_id = :brand_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':brand_statu'	=>	$status,
				':brand_id'		=>	$_POST["brand_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Marca cambiada de status a ' . $status;
		}
	}
}

?>