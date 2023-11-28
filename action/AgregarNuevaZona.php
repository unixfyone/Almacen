<?php
//session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO wh_zones (zone_id, zcompany_id, zone_prefix, zone_desc, zone_ubic, zone_direc, zone_doc_em, zone_doc_sm) VALUES (:zone_id, :zcompany_id, :zone_prefix, :zone_desc, :zone_ubic, :zone_direc, :zone_doc_em, :zone_doc_sm)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':zone_id' => $_POST['zone_id'] , ':zcompany_id' => $_POST['zcompany_id'] , ':zone_prefix' => $_POST['zone_prefix'], ':zone_desc' => $_POST['zone_desc'], ':zone_ubic' => $_POST['zone_ubic'], ':zone_direc' => $_POST['zone_direc'], ':zone_doc_em' => '1', ':zone_doc_sm' => '1')) ) ? 'Zona guardada correctamente' : 'Algo salió mal. No se puede agregar';	
	
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