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
		INSERT INTO wh_subcategories (wh_category_id, subcategory) 
		VALUES (:wh_category_id, :subcategory)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':wh_category_id'	=>	$_POST["wh_category_id"],
				':subcategory'	=>	$_POST["subcategory"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'SubCategoria Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_subcategories WHERE scat_id = :scat_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':scat_id'	=>	$_POST["scat_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['wh_category_id'] = $row['wh_category_id'];
			$output['subcategory'] = $row['subcategory'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_subcategories 
		set wh_category_id = :wh_category_id,
		subcategory = :subcategory,
		modified = :modified
		WHERE scat_id = :scat_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':wh_category_id'		=>	$_POST["wh_category_id"],
				':subcategory'		=>	$_POST["subcategory"],
				':modified'		=>	date("Y-m-d"),
				':scat_id'		=>	$_POST["scat_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'SubCategoria Editado';
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
		UPDATE wh_subcategories 
		SET scat_statu = :scat_statu 
		WHERE scat_id = :scat_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':scat_statu'	=>	$status,
				':scat_id'		=>	$_POST["scat_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'SubCategoria cambio de status a ' . $status;
		}
	}
}

?>