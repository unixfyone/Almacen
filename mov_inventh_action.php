<?php
include('database_connection.php');

if(isset($_POST['btn_action']))
{
	//echo "<pre>"; print_r($_POST['btn_action']); exit();
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO wh_movinvh (movh_cia, movh_zone, movh_doc, movh_tdoc, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_proce) 
		VALUES (:movh_cia, :movh_zone, :movh_doc, :movh_tdoc, :movh_tmov, :movh_fecha, :movh_ejer, :movh_per, :movh_proce)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':movh_cia'			=>	$_POST['movh_cia'],
				':movh_zone'		=>	$_POST['movh_zone'],
				':movh_doc'			=>	$_POST['movh_doc'],
				':movh_tdoc'		=>	$_POST['movh_tdoc'],
				':movh_tmov'		=>	$_POST['movh_tmov'],
				':movh_fecha'		=>	$_POST['movh_fecha'],
				':movh_ejer'		=>	$_POST['movh_ejer'],
				':movh_per'			=>	$_POST['movh_per'],
				':movh_proce'		=>	$_POST['movh_proce']
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Documento Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_movinvh WHERE movh_id = :movh_id";
				
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':movh_id'	=>	$_POST["movh_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['movh_doc'] = $row['movh_doc'];
			$output['movh_tdoc'] = $row['movh_tdoc'];
			$output['movh_fecha'] = $row['movh_fecha'];
			$output['movh_ejer'] = $row['movh_ejer'];
			$output['movh_per'] = $row['movh_per'];
			$output['movh_proce'] = $row['movh_proce'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "UPDATE wh_movinvh 
		set movh_doc = :movh_doc,
		movh_tdoc = :movh_tdoc,
		movh_fecha = :movh_fecha,
		movh_proce = :movh_proce,
		modified = :modified
		WHERE movh_id = :movh_id
		";
		
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':movh_doc'		=>	$_POST["movh_doc"],
				':movh_tdoc'	=>	$_POST["movh_tdoc"],
				':movh_fecha'	=>	$_POST["movh_fecha"],
				':movh_proce'	=>	$_POST["movh_proce"],
				':modified'		=>	date("Y-m-d"),
				':movh_id'		=>	$_POST["movh_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Documento Editado Correctamente...:' .$_POST["movh_doc"];
		}
	}
//===============================================
}

?>