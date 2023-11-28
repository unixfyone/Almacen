<?php

//marcas_action.php

include('database_connection.php');
//===============================================
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_consumos (cia_cons, zone_cons, name_cons) 
		VALUES (:cia_cons, :zone_cons, :name_cons)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':cia_cons' => $_POST["cia_cons"],
				':zone_cons' => $_POST["zone_cons"],
				':name_cons'=> $_POST["name_cons"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Consumo Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_consumos WHERE id_cons = :id_cons";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id_cons' => $_POST["id_cons"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name_cons'] = $row['name_cons'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_consumos set 
		name_cons = :name_cons,
		modified = :modified
		WHERE id_cons = :id_cons
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':name_cons' =>	$_POST["name_cons"],
				':modified'	=> date("Y-m-d"),
				':id_cons' => $_POST["id_cons"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Consumo Editado';
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
		UPDATE wh_consumos 
		SET statu_cons = :statu_cons
		WHERE id_cons = :id_cons
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statu_cons' => $status,
				':id_cons' => $_POST["id_cons"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Consumo cambiado de status a ' . $status;
		}
	}
}

?>