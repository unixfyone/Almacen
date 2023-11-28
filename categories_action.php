<?php

//groups_action.php

include('database_connection.php');
$cia= $_SESSION['company_id'];

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_categories (acronym, category) 
		VALUES (:acronym, :category)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':acronym'	=>	$_POST["acronym"],
				':category'	=>	$_POST["category"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Categoria Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_categories WHERE cat_id = :cat_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':cat_id'	=>	$_POST["cat_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['acronym'] = $row['acronym'];
			$output['category'] = $row['category'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_categories 
		set acronym = :acronym,
		category = :category,
		modified = :modified
		WHERE cat_id = :cat_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':acronym'		=>	$_POST["acronym"],
				':category'		=>	$_POST["category"],
				':modified'		=>	date("Y-m-d"),
				':cat_id'		=>	$_POST["cat_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Categoria Editado';
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
		UPDATE wh_categories 
		SET cat_statu = :cat_statu 
		WHERE cat_id = :cat_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':cat_statu'	=>	$status,
				':cat_id'		=>	$_POST["cat_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Categoria cambio de status a ' . $status;
		}
	}
}

?>