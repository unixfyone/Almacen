<?php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

if($_SESSION['type'] != 'Master')
{
	header("location:index2.php");
}
include('headerx.php');
include('unico.php');
?>
<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">

<style type="text/css">

.div2 {
  background-color: #f2f2f2;
  width: 600px;
  height: 200px;
  border: 3px solid #cccccc;
  padding: 50px;
  margin: 20px;
}

</style>

<?Php
echo '<FORM ACTION="" method="GET">';


if(isset($_GET["AA"]))$AA = $_GET["AA"];
else $AA = $_POST["AA"];
//-------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = $_POST["CIA"];
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = $_POST["ZON"];

//===============================================================

//===============================================================
	$query2 = "
	SELECT *, Count(per_id) AS Cuenta1 FROM wh_periodos
	WHERE per_statu = 'Abierto' and company_id = '$CIA' and zone_id = '$ZON'
	";	
	$Registro2 = mysqli_query($link,$query2);
	while($row2 = mysqli_fetch_array($Registro2))
	{
		$CTA2 = $row2['Cuenta1'];
	}
	mysqli_free_result ($Registro2);
//========
?>
<Input Type="hidden" name="AA" value="<?Php echo $AA ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">

<?Php
	if ($CTA2 > '0')			// Existen Renglones Abiertos
	{
?>
		<div class="modal-dialog modal-md"">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cierre de Ejercicio </h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<strong>Atencion.! </strong> Existe Periodo Abierto .....
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='window.history.go(-1)' data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</button>
			</div>
		</div>

<?Php
//==========
	} else {
		
		echo "<div align='center'>";	
			echo "<BR>";
			echo "<div class = 'div2 elevation-2'>";
				echo "<H4>";
				echo "<p Align=Center>";
				echo "<font color=RED>Proceso para Cerrar el Ejercicio o Año Activo</font>";
				echo "<BR>";
				echo "<b><font color=RED>Esta seguro que desea continuar</font></b>";
				echo "<br><br>";
				//========
				echo "<font color=0066FF> Ejercicio...: ";
				echo "</font>&nbsp &nbsp<font color=#000000>$AA</font>";
				?>
				<br><br><br>
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-1)'><span class="fa fa-times"></span>  Cancelar</button>
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="Submit" name="BtnOK" ><span class="fa fa-check"></span> Aceptar</button>
			</div>
		</div>		
		<?php
		if (isset($_GET['BtnOK']))
		{
		//--------------------------
		$SQL = "UPDATE wh_ejercicios SET 
		ej_statu = 'Cerrado' 
		WHERE ej_aa = '$AA' and ej_statu ='Abierto' and company_id = '$CIA' and zone_id = '$ZON'";
		mysqli_query ($link, $SQL);
		//--------------------------
			echo"<script type='text/javascript'>
			alert('!Ejercicio Cerrado correctamente...','$AA')
			window.history.go(-2)
			</script>";
		}
	//========		
	}
//===============================================================
mysqli_close($link);
?>
</form>