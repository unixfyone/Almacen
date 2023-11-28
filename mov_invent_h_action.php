<?php

//movinvh_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//=============================================== wh_movinvh
	if($_POST['btn_action'] == 'Add')
	{
		$query = "INSERT INTO wh_movinvh (movh_zone, movh_doc, movh_tdoc, movh_tmov, movh_fecha, movh_ejer, movh_per, movh_proce) 
		VALUES (:movh_zone, :movh_doc, :movh_tdoc, :movh_tmov, :movh_fecha, :movh_ejer, :movh_per, :movh_proce)";
		
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				
				':movh_zone'			=>	$_POST['movh_zone'],
				':movh_doc'			=>	$_POST['movh_doc'],
				':movh_tdoc'		=>	$_POST["movh_tdoc"],
				':movh_tmov'		=>	$_POST["movh_tmov"],
				':movh_fecha'		=>	$_POST["movh_fecha"],
				':movh_ejer'		=>	$_POST["movh_ejer"],
				':movh_per'			=>	$_POST["movh_per"],
				':movh_proce'		=>	$_POST["movh_proce"],
				':movh_fechap'		=>	date("Y-m-d")

			)
		);
		$result = $statement->fetchAll();

	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM movinv_h WHERE movh_id = :movh_id";
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
			$output['movh_prove'] = $row['movh_prove'];
			$output['movh_stotal'] = $row['movh_stotal'];
			$output['movh_iva'] = $row['movh_iva'];	
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE movinv_h 
		set movh_doc = :movh_doc,
		movh_tdoc = :movh_tdoc,
		movh_fecha = :movh_fecha,
		movh_ejer = :movh_ejer,
		movh_per = :movh_per,
		movh_prove = :movh_prove,
		movh_stotal = :movh_stotal,
		movh_iva = :movh_iva,
		movh_fechap = :movh_fechap
		WHERE movh_id = :movh_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':movh_doc'		=>	$_POST["movh_doc"],
				':movh_tdoc'	=>	$_POST["movh_tdoc"],
				':movh_fecha'	=>	$_POST["movh_fecha"],
				':movh_ejer'	=>	$_POST["movh_ejer"],
				':movh_per'		=>	$_POST["movh_per"],
				':movh_prove'	=>	$_POST["movh_prove"],
				':movh_stotal'	=>	$_POST["movh_stotal"],
				':movh_iva'		=>	$_POST["movh_iva"],
				':movh_fechap'	=>	date("Y-m-d"),
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