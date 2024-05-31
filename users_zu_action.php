<?php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//========================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_user_zones(user_id, zone_id, uzcompany_id) 
		VALUES (:user_id, :zone_id, :uzcompany_id)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id'			=>	$_POST['user_id'],
				':uzcompany_id'		=>	$_POST['uzcompany_id'],
				':zone_id'			=>	$_POST['zone_id']
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Registro Agregado Código..:';
		}
	}
//========================================
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_user_zones 
		SET userz_statu = :userz_statu
		WHERE ID_reg = :ID_reg
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':userz_statu'	=>	$status,
				':ID_reg'		=>	$_POST["ID_reg"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Usuario Zona Ubicación cambio de status a ' . $status;
		}
	}
//========================================
}
//========================================
?>