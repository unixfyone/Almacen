<!-- Manual de PHP de WebEstilo.com --> 
<?php 
function Conectarse() 
{
   if (!($link=mysqli_connect("68.178.207.10:3306","unixfyonecom_creverol","+y&xZ%AunyNZ"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysqli_select_db($link,'unixfyonecom_db'))
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
