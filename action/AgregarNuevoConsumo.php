<?php
//session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO wh_consumos (cia_cons, zone_cons, name_cons) VALUES (:cia_cons, :zone_cons, :name_cons)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':cia_cons' => $_POST['cia_cons'] , ':zone_cons' => $_POST['zone_cons'] , ':name_cons' => $_POST['name_cons'])) ) ? 'Consumo guardado correctamente' : 'Algo salió mal. No se puede agregar';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}
	
?>
  <script>
	window.history.go(-1 );
  </script>