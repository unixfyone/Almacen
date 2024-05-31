<?php

include('database_connection.php');
//===============================================
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "INSERT INTO wh_suppliers (prove, rif, address, phone, contact_name, contact_phone) 
		VALUES (:prove, :rif, :address, :phone, :contact_name, :contact_phone)";
		
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':prove'		=>	$_POST["prove"],
				':rif'			=>	$_POST["rif"],
				':address'		=>	$_POST["address"],
				':phone'		=>	$_POST["phone"],
				':contact_name'	=>	$_POST["contact_name"],
				':contact_phone'		=>	$_POST["contact_phone"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Proveedor Agregado Correctamente';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_suppliers WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['prove'] = $row['prove'];
			$output['rif'] = $row['rif'];
			$output['address'] = $row['address'];
			$output['phone'] = $row['phone'];
			$output['contact_name'] = $row['contact_name'];
			$output['contact_phone'] = $row['contact_phone'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_suppliers set prove = :prove,
		rif = :rif,
		address = :address,
		phone = :phone,
		contact_name = :contact_name,
		contact_phone = :contact_phone
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':prove'	=>	$_POST["prove"],
				':rif'		=>	$_POST["rif"],
				':address'	=>	$_POST["address"],
				':phone'	=>	$_POST["phone"],
				':contact_name'	=>	$_POST["contact_name"],
				':contact_phone'	=>	$_POST["contact_phone"],
				':id'		=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Proveedor Editado Correctamente';
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
		UPDATE wh_suppliers 
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
			echo 'Proveedor cambiado de status a ' . $status;
		}
	}
}

?>