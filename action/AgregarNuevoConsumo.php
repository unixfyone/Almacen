<?php
//session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){

	$database = new Connection();
	$db = $database->open();
	try{
			$cia_cons = $_POST['cia_cons'];
			$zone_cons = $_POST['zone_cons'];
			$name_cons = $_POST['name_cons'];

			$sql = "INSERT INTO wh_consumos (cia_cons, zone_cons, name_cons) 
			VALUES ('$cia_cons', '$zone_cons', '$name_cons')";

			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Consumo agregado correctamente' : 'No se puso agregar Consumo';
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();
	
} else{
	$_SESSION['message'] = 'Llene el formulario';
}

	
?>
  <script>
	window.history.go(-1 );
  </script>