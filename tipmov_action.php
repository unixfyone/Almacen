<?php
include('database_connection.php');

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "INSERT INTO wh_tipmov (tm_cod, tm_cia, tm_zone, tm_desc, tm_tipo, tm_actcost, tm_statu) 
		VALUES (:tm_cod, :tm_cia, :tm_zone, :tm_desc, :tm_tipo, :tm_actcost, :tm_statu)";
		
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':tm_cod'		=>	$_POST["tm_cod"],
				':tm_cia'		=>	$_POST["tm_cia"],
				':tm_zone'		=>	$_POST["tm_zone"],
				':tm_desc'		=>	$_POST["tm_desc"],
				':tm_tipo'		=>	$_POST["tm_tipo"],
				':tm_statu'		=>	'Activo',
				':tm_actcost'	=>	$_POST["tm_actcost"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Tipo de Movimiento Agregado...' .$_POST["tm_desc"]; 
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
		UPDATE wh_tipmov 
		SET tm_statu = :tm_statu 
		WHERE tm_id = :tm_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':tm_statu'	=>	$status,
				':tm_id'		=>	$_POST["tm_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Tipo de Movimiento cambio de status a ' . $status;
		}
	}
}
//===============================================
if(isset($_POST['btn_action1']))
{
//===============================================
	if($_POST['btn_action1'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_tipmov WHERE tm_id = :tm_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':tm_id'	=>	$_POST["tm_id1"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['tm_cod1'] = $row['tm_cod'];
			$output['tm_desc1'] = $row['tm_desc'];
			$output['tm_tipo1'] = $row['tm_tipo'];
			$output['tm_actcost1'] = $row['tm_actcost'];
		}
		echo json_encode($output);
	}		
//===========		
	if($_POST['btn_action1'] == 'Edit')
	{
		$query = "
		UPDATE wh_tipmov 
		set tm_tipo = :tm_tipo,
		tm_desc = :tm_desc,
		tm_actcost = :tm_actcost,
		modified = :modified
		WHERE tm_id = :tm_id";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':tm_tipo'		=>	$_POST["tm_tipo1"],
				':tm_desc'		=>	$_POST["tm_desc1"],
				':tm_actcost'	=>	$_POST["tm_actcost1"],
				':modified'		=>	date("Y-m-d"),
				':tm_id'		=>	$_POST["tm_id1"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Tipo Editado';
		}
	}		
//===========		
}		
//===============================================
?>