<?php
	//session_start();
	include_once('../config/dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$zone_id = $_GET['id'];
			$zone_prefix = $_POST['zone_prefix'];
			$zone_desc = $_POST['zone_desc'];
			$zone_ubic = $_POST['zone_ubic'];
			$zone_direc = $_POST['zone_direc'];
			$zone_doc_sm = $_POST['zone_doc_sm'];
			$zone_doc_em = $_POST['zone_doc_em'];
			$modified = date('Y-m-d');

			$sql = "UPDATE wh_zones SET 
			zone_prefix = '$zone_prefix', 
			zone_desc = '$zone_desc', 
			zone_ubic = '$zone_ubic', 
			zone_direc = '$zone_direc', 
			zone_doc_sm = '$zone_doc_sm', 
			zone_doc_em = '$zone_doc_em', 
			modified = '$modified' 
			WHERE zone_id = '$zone_id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Zona actualizada correctamente' : 'No se puso actualizar la Zona';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

?>
  <script>
    'use strict';
    //window.alert("Zona Editada Correctamente...");
	window.history.go(-1 );
  </script>