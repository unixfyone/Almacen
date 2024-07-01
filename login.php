<?php

include('database_connection.php');
require_once 'vendor/autoload.php';
use Carbon\Carbon;

$secret = getenv('SECRET'); // Define the secret key

$token = $_GET["xr1"];
$tokenParts = explode('.', $token);
$header = base64_decode($tokenParts[0]);
$payload = base64_decode($tokenParts[1]);

$jsonDecoded = json_decode($payload, true);
$id = $jsonDecoded['id'];

$expiration = Carbon::createFromTimestamp(json_decode($payload)->exp);
$tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) < 0);

// Define the base64UrlEncode function

function base64UrlEncode($input) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
}

$base64UrlHeader = base64UrlEncode($header);
$base64UrlPayload = base64UrlEncode($payload);
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
$base64UrlSignature = base64UrlEncode($signature);

$signatureProvided = $tokenParts[2];
$signatureValid = ($base64UrlSignature === $signatureProvided);

echo "Header:\n" . $header . "\n";
echo "Payload:\n" . $payload . "\n";


if ($tokenExpired) {
    echo "Token has expired.\n";
	//echo "<pre>"; print_r("Token has expired.\n"); exit();
} else {
    echo "Token has not expired yet.\n";
	//echo "<pre>"; print_r("Token has not expired yet.\n"); exit();
}
if ($signatureValid) {
    echo "The signature is valid.\n";
	//echo "<pre>"; print_r("The signature is valid.\n"); exit();
} else {
    echo "The signature is NOT valid\n";
	//echo "<pre>"; print_r("The signature is NOT valid\n"); exit();
}

$message = '';
//echo 'Usuario no Autorizado';
//$USR = $_GET["xr1"];
$USR = $id;

//echo "<pre>"; print_r($id); exit();
//****************************************
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
				$_SESSION['time'] = time();
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