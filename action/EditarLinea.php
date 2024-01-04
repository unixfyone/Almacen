<?php
	//session_start();
	include_once('../config/dbconect.php');
	
//echo "<pre>"; print_r($_GET['id']); exit();

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$acronym = $_POST['acronym'];
			$namel = $_POST['namel'];
			$typel = $_POST['typel'];
			$cont_cod = $_POST['cont_cod'];
			$modified = date('Y-m-d');

			$sql = "UPDATE wh_lines SET 
			acronym = '$acronym', namel = '$namel', typel = '$typel', cont_cod = '$cont_cod', modified = '$modified' 
			WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Linea actualizada correctamente' : 'No se puso actualizar la Linea';
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
	window.history.go(-1 );
  </script>