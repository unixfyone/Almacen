<?php
//login.php
include('database_connection.php');

$message = '';
//echo 'Usuario no Autorizado';
$USR = $_GET["xr1"];
//{
	$query = "
	SELECT * FROM wh_user_details 
	WHERE user_id = $USR;
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_id'	=>	$USR
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_statu'] == 'Activo')
			{
				$_SESSION['type'] = $row['user_type'];
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$_SESSION['user_email'] = $row['user_email'];
				$_SESSION['company_id'] = $row['company_id'];
				$_SESSION['corporate_color2'] = $row['corporate_color2'];
				$_SESSION['corporate_rgb'] = $row['corporate_rgb'];
				$_SESSION['logo'] = $row['logo'];
				header("location:index2.php");
			}
			else
			{
				$message = "<label>Your account is disabled, Contact Master</label>";
			}
		}
	}
	else
	{
		//$message = "<label>Wrong User</labe>";
		?>
				<div class="alert alert-info">
					<h2>
					<strong>Info! </strong> Usuario no Autorizado.
					</h2>
				</div>
		<?Php
	}

//}

?>

<!DOCTYPE html>
<html lang="es">
<head>

</head>
<body>

</body>
		<!-- vinculando a libreria Jquery-->
		<script src="js/jquery-3.5.1.min.js"></script>
		<!-- Libreria java scritp de bootstrap -->
		<script src="js/bootstrap.min.js"></script>
</html>