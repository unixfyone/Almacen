<?php
	//session_start();
	include_once('../config/dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id_cons = $_POST['id'];
			$name_cons = $_POST['name_cons'];
			$modified = date('Y-m-d');

			$sql = "UPDATE wh_consumos SET 
			name_cons = '$name_cons', 
			modified = '$modified' 
			WHERE id_cons = '$id_cons'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Consumo actualizado correctamente' : 'No se puso actualizar Consumo';
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