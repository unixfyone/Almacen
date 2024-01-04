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
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<?php
//---------------------------------------------------------------
echo '<FORM ACTION="" method="">';

//$MM= date('m');
//$AA= date('Y');
$year = date("Y");

$CIA = $_POST["CIA"];
//-------------
$ZON = $_POST["ZON"];
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

//echo "<pre>"; print_r($ZON); exit();

$CTA = '0';
//===============================================================
$SQLx = "SELECT Count(ej_aa) AS Cuenta FROM wh_ejercicios 
WHERE ej_statu = 'Abierto' and company_id = '$CIA' and zone_id = '$ZON' ";

$Registro2 = mysqli_query($link,$SQLx);
while ($Fila2=mysqli_fetch_array($Registro2))
//---------------------------------------------------------------
{
$CTA = $Fila2["Cuenta"];
}
//---------------------------------------------------------------
mysqli_free_result ($Registro2);
//==============================
if ($CTA > '0')
{
		echo'<script type="text/javascript">
		alert("!** ERROR ya existe el Año de Ejercicio Abierto **")
		window.history.back()
		</script>';	
//==============================
} else {
?>
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Ejercicos
					</font></b></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Control de Périodos</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<span class="input-group-addon"><b><font color="#303030">Año del Ejercicio.:</font></b></span>
											<input type="number" placeholder="YYYY" min="2023" max="2030" name="AA" id="AA"value="<?= $year; ?>" class="form-control" />
										</div>
									</div>	
								</div>
							</div>
							<br>
							<div class="modal-footer" style="background-color:#FFFFFC">
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
								
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="Submit" name="BtnOK" ><span class="fa fa-save"></span> Grabar Ejercicio</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	if (isset($_GET['BtnOK']))
	{
		$AA = $_GET["AA"];		//Ejercicio Nuevo
		$AA_ANT = $AA - 1;		//Ejercicio Cerrado
		$MM = '12';				//Ultimo Mes Arreglo
		$MM_SIG = 0;			//Primera Posicion del Arreglo
		$saldos = '0|0|0|0|0|0|0|0|0|0|0|0';
		$saldos13 = '0|0|0|0|0|0|0|0|0|0|0|0|0';	
	//=======================================================
		$query = "SELECT * FROM wh_saldosm WHERE aa_s = '".$AA_ANT."'";	
		$Registro2 = mysqli_query($link,$query);			
		while($row2 = mysqli_fetch_array($Registro2))
		{	
			$prodid = $row2["product_id"];					// id Producto del Registro Ejercicio cerrado
			$cia = $row2["company_id"];
			$zone = $row2["zone_id"];
			$prodcod = $row2["product_cod"];

			//--------------------------------
			$mValorfp=explode("|", $row2["saldos_fp"]);		// Arreglo Ejercicio cerrado
			//--------------------------------
			$vefp12 = $mValorfp[$MM];						//Valor Saldo ultimo mes ejercicio cerrado
			
			if ($vefp12 != '0')								// insertar 
			{
				$query2 = "INSERT INTO wh_saldosm (aa_s, company_id, zone_id, product_id, product_cod, saldos_e, saldos_s, saldos_fp) VALUES ('$AA', '$cia', '$zone', '$prodid', '$prodcod', '$saldos', '$saldos', '$saldos13')";
				//--------------------------------		
				mysqli_query($link,$query2);
		
				//--------------------------------				
				$query3 = "SELECT * FROM wh_saldosm WHERE aa_s = '".$AA."' and product_id = '".$prodid."' ";	
				$Registro3 = mysqli_query($link,$query3);			
				while($row3 = mysqli_fetch_array($Registro3))			
				{
					$prodid3 = $row3["product_id"];
					//--------------------------------
					$mValornp=explode("|", $row3["saldos_fp"]);		// Arreglo Ejercicio cerrado
					//--------------------------------
				
					$mValornp[0]=$vefp12;
					
					//--------------------------------
					$mValornp2=implode("|", $mValornp);
					//--------------------------------	
					$query4 = "UPDATE wh_saldosm SET 
					saldos_fp = '$mValornp2'
					WHERE aa_s = '$AA' and product_id = '$prodid3'";
					mysqli_query($link,$query4);			
				}
				mysqli_free_result ($Registro3);
			}
		}
		mysqli_free_result ($Registro2);
		//=======================================================
	
		$SQL = "INSERT INTO wh_ejercicios (ej_aa, company_id, zone_id) value ('$AA', '$cia', '$zone')";
		mysqli_query ($link, $SQL);
		//--------------------------
		echo"<script type='text/javascript'>
		alert('!Ejercicio Agregado correctamente...','$AA')
		window.history.go(-2)
		</script>";
		//========	
	}
	mysqli_close($link);
}
?>
</div>
</form>
<script>
      document.querySelector("input[type=number]")
      .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>
