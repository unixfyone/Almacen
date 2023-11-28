<?php
include('database_connection.php');
	
if(isset($_POST['btn_action']))
{
//===============================================

//===============================================	

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_lines 
		SET statu = :statu 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statu'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Linea cambio de status a ' . $status;
		}
	}
}
//===============================================
?>