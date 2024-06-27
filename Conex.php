<!-- Manual de PHP de WebEstilo.com --> 
<?php 
// Carga las variables de entorno desde el archivo .env
$env = parse_ini_file('.env');

// Asigna las variables de entorno a constantes
define('DB_HOST', $env['DB_HOST']);
define('DB_PORT', $env['DB_PORT']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
 
function Conectarse()
{
   if (!($link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysqli_select_db($link, DB_NAME))
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
	if (!mysqli_set_charset($link,'utf8')) 
	{
		echo "Error: No se pudo establecer el conjunto de caracteres.\n";
		exit();
	}
   return $link; 
} 
?>
