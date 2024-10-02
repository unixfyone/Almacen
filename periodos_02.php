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
<link rel="stylesheet" type="text/css" href="cssi/styles.css" />

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

//---------------------------------------------------------------
if(isset($_GET["AA"]))$AA = $_GET["AA"];
else $AA = $_POST["AA"];

if(isset($_GET["MM"]))$MM = $_GET["MM"];
else $MM = $_POST["MM"];
//-------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//===============================================================

//===============================================================
	$query2 = "
	SELECT Count(movh_id) AS Cuenta1 FROM wh_movinvh 
	WHERE movh_statu = 'Abierto' and movh_cia = '$CIA' and movh_zone = '$ZON'
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
<Input Type="hidden" name="MM" value="<?Php echo $MM ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<?Php
	if ($CTA2 > '0')			// Existen Renglones Abiertos
	{
?>
		<div class="modal-dialog modal-md"">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cierre de Periodo del Ejercicio</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<strong>Atencion.! </strong> Existen Documentos de Movimientos de productos Abiertos .....
				</div>
			</div>
			<div class="modal-footer">
				<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='Button' name='Cancel' onclick='window.history.go(-1)' data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</button>
			</div>
		</div>
		<?Php 
	} else {
		
		echo "<div align='center'>";	
			echo "<BR><BR>";
			echo "<div class = 'div2 elevation-2'>";
				echo "<H4>";
				echo "<p Align=Center>";
				echo "<font color=RED>Proceso para Cerrar el Periodo o mes activo</font>";
				echo "<BR>";
				echo "<b><font color=RED>Esta seguro que desea continuar</font></b>";
				echo "<br><br>";
				//========
				echo "<font color=0066FF> Periodo...: ";
				echo "</font>&nbsp &nbsp<font color=#000000>$AA</font>&nbsp<font color=#000000>-</font>&nbsp<font color=#000000>$MM</font>";
				?>
				<br><br><br>
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="button" name="BotonCancelar" onclick='window.history.go(-1)'><span class="fa fa-remove"></span>  Cancelar</button>
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="Submit" name="BtnOK" ><span class="fa fa-ok"></span> Aceptar</button>
			</div>
		</div>		
		<?php
		if (isset($_GET['BtnOK']))
		{
		$query = "SELECT * FROM wh_saldosm 
		WHERE aa_s = '$AA' and company_id = '$CIA' and zone_id = '$ZON' ";	
		$Registro2 = mysqli_query($link,$query);
		while($row2 = mysqli_fetch_array($Registro2))
		{
		//=======================================================
		$PROD = $row2["product_cod"];

		$exe = 0;
		$exs = 0;
		$expa = 0;
		$mValorfp2 = 0;
		//--------------------------------
		$mValorfp=explode("|", $row2["saldos_fp"]);
		$expa = $mValorfp[$MM-1];

		$mValore=explode("|", $row2["saldos_e"]);
		$exe = $mValore[$MM-1];

		$mValors=explode("|", $row2["saldos_s"]);
		$exs = $mValors[$MM-1];
		//--------------------------------

		$mValorfp2 = ((int)$expa + (int)$exe - (int)$exs );

		$mValorfp[$MM]=((int)$mValorfp2);

		$mValorfp2=implode("|", $mValorfp);
		//--------------------------------				
		$query4 = "UPDATE wh_saldosm SET 
		saldos_fp = '$mValorfp2'
		WHERE aa_s = '$AA' and product_cod = '$PROD' and company_id = '$CIA' and zone_id = '$ZON'
		";
		mysqli_query($link,$query4);
		}
		mysqli_free_result ($Registro2);
		//=======================================================
		$SQLx = "UPDATE wh_periodos 
		SET per_statu ='Cerrado' 
		WHERE per_aa = '$AA' and per_mm = '$MM' and per_statu ='Abierto' and company_id = '$CIA' and zone_id = '$ZON' ";
		mysqli_query ($link, $SQLx);
		//--------------------------
			echo"<script type='text/javascript'>
			alert('!Periodo Cerrado correctamente...','$AA')
			window.history.go(-2)
			</script>";
		}
	//========		
	}
//===============================================================
mysqli_close($link);
?>
</form>