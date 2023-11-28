<?php

//almacenes_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//========================================
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_zones 
		SET zone_statu = :zone_statu 
		WHERE zone_id = :zone_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':zone_statu'	=>	$status,
				':zone_id'		=>	$_POST["zone_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Zona de Ubicación cambio de status a ..:' . $status;
		}
	}
}
//========================================
if(isset($_POST['btn_action1']))
{
//========================================
	if($_POST['btn_action1'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_zones WHERE zone_id = :zone_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':zone_id'	=>	$_POST['zone_id']
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['zone_id'] = $row['zone_id'];
			$output['zcompany_id'] = $row['zcompany_id'];
			$output['zone_prefix1'] = $row['zone_prefix'];
			$output['zone_desc1'] = $row['zone_desc'];
			$output['zone_ubic1'] = $row['zone_ubic'];
			$output['zone_direc1'] = $row['zone_direc'];
			$output['zone_doc_em'] = $row['zone_doc_em'];
			$output['zone_doc_sm'] = $row['zone_doc_sm'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action1'] == 'Edit')
	{
		$query = "UPDATE wh_zones
		set zone_desc = :zone_desc,
		zone_prefix = :zone_prefix, 
		zone_ubic = :zone_ubic, 
		zone_direc = :zone_direc,
		zone_doc_em = :zone_doc_em,
		zone_doc_sm = :zone_doc_sm,
		modified = :modified
		WHERE zone_id = :zone_id";
		
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':zone_desc'	=>	$_POST["zone_desc1"],
				':zone_prefix'	=>	$_POST["zone_prefix1"],
				':zone_ubic'	=>	$_POST["zone_ubic1"],
				':zone_direc'	=>	$_POST["zone_direc1"],
				':zone_doc_em'	=>	$_POST["zone_doc_em"],
				':zone_doc_sm'	=>	$_POST["zone_doc_sm"],
				':modified'		=>	date("Y-m-d"),
				':zone_id'		=>	$_POST["zone_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Zona de Ubicación Editado Correctamente ...';
		}
	}
//===============================================
}
?>