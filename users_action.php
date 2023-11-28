<?php

//users_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'Add')
	{
//==========		
		if(isset($_POST['user_name']))
		{	
			if($_POST["user_new_password"] != '')
			{
				$query = "
				INSERT INTO user_details (user_name, user_email, user_password) 
				VALUES (:user_name, :user_email, '".password_hash($_POST["user_new_password"], PASSWORD_DEFAULT)."' )
				";
				$statement = $connect->prepare($query);
				$statement->execute(
					array(
						':user_name'	=>	$_POST["user_name"],
						':user_email'	=>	$_POST["user_email"]
						)
				);
				$result = $statement->fetchAll();
				if(isset($result))
				{
					echo 'Usuario Agregado';
				}
			}
		}
//==========		
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_user_details WHERE user_id = :user_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id'	=>	$_POST["user_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['first_name'] = $row['first_name'];
			$output['user_email'] = $row['user_email'];
		}
		echo json_encode($output);
	}
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		if(isset($_POST['first_name']))
		{
			if($_POST["user_new_password"] != '')
			{
				$query = "
				UPDATE wh_user_details SET 
				first_name = '".$_POST["first_name"]."', 
				user_email = '".$_POST["user_email"]."', 
				user_password = '".password_hash($_POST["user_new_password"], PASSWORD_DEFAULT)."' 
				WHERE user_id = '".$_POST["user_id"]."'
				";
			}
			else
			{
				$query = "
				UPDATE wh_user_details SET 
				first_name = '".$_POST["first_name"]."', 
				user_email = '".$_POST["user_email"]."'
				WHERE user_id = '".$_POST["user_id"]."'
				";
			}
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll(); 
			if(isset($result))
			{
				echo 'Usuario Editado..:' .$_POST["user_name"];
			}
		}
	}
//===============================================
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_user_details 
		SET user_statu = :user_statu 
		WHERE user_id = :user_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_statu'	=>	$status,
				':user_id'		=>	$_POST["user_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Usuario cambio de status a ' . $status;
		}
	}
}
?>