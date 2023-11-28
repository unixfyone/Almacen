<?php
//session_start();
include_once('../config/dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO wh_lines (acronym, namel, typel, cont_cod) VALUES (:acronym, :namel, :typel, :cont_cod)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':acronym' => $_POST['acronym'] , ':namel' => $_POST['namel'] , ':typel' => $_POST['typel'], ':cont_cod' => $_POST['cont_cod'])) ) ? 'Linea guardada correctamente' : 'Algo salió mal. No se puede agregar';	
	
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