<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

?>
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
//---------------------------------------------------------------
echo '<FORM ACTION="" method="">';

if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = $_POST["ZON"];
//-----------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = $_POST["CIA"];
//-----------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

$CTA = '0';
$CTAE = '0';
//===============================================================
$SQLx = "SELECT Count(per_aa) AS Cuenta FROM wh_periodos WHERE per_statu = 'Abierto' ";

$Registro2 = mysqli_query($link, $SQLx);
while ($Fila2=mysqli_fetch_array($Registro2))
//-------------------------------------------
{
$CTA = $Fila2["Cuenta"];
}
//--------------------------------------------
mysqli_free_result ($Registro2);
//===============================================================
$SQL1 = "SELECT *, Count(ej_aa) AS Cuenta2 FROM wh_ejercicios WHERE ej_statu = 'Abierto' ";

$Registro1 = mysqli_query($link, $SQL1);
//-----------------------------
while($Fila1 = mysqli_fetch_array($Registro1))
{
$AA = $Fila1['ej_aa'];
$CTAE = $Fila1["Cuenta2"];
}	
mysqli_free_result ($Registro1);	
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$DCIA = $FilaA["company"];
$CIA = $FilaA["id"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
if ($CTAE > '0')
{
if ($CTA > '0')
{
		echo'<script type="text/javascript">
		alert("!** ERROR ya existe un periodo Abierto **")
		window.history.back()
		</script>';	
//--------------------------------------------
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
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Périodos
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
								<div class="form-group">
									<label><font color="#660000" FACE="times new roman" size="3px">Almacen..:  </font></label>
									&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $DCIA ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
								</div>							
								<hr>
								<br>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<span class="input-group-addon"><b><font color="#303030">Año de Ejercicio.:</font></b></span>
											<input type="text" name="AA" id="AA" maxlength="4" class="form-control"  value="<?Php echo $AA?>" readonly />
										</div>
									</div>
									<div class="col-sm-8">
										<div class="form-group">
											<span class="input-group-addon"><b><font color="#303030">Mes de Ejercicio.:</font></b></span>
											<select class="form-control" name="mes" id="mes">
												<?php    
												$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
												'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

												for ($i=1; $i<=12; $i++) {
														if ($i == date('m'))
														echo '<option value="'.$i.'"selected>'.$Meses[($i)-1].'</option>';
													else
														echo '<option value="'.$i.'">'.$Meses[($i)-1].'</option>';
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="modal-footer" style="background-color:#FFFFFC">
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
								
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" type="Submit" name="BtnOK" ><span class="fa fa-save"></span> Grabar Periodo</button>
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
		$MES = $_GET["mes"];
		//=======================================================		
		//==============================================================		
		$SQL = "INSERT INTO wh_periodos (per_aa, per_mm, company_id, zone_id) value ('$AA', '$MES', '$CIA', '$ZON')";
		mysqli_query ($link, $SQL);
		//--------------------------
			echo"<script type='text/javascript'>
			alert('!Periodo Agregado correctamente...','$MES')
			window.history.go(-2)
			</script>";
		}
	//========		
	}
	} else {
		echo'<script type="text/javascript">
		alert("!** ERROR No hay ningun Ejercicio Abierto ********")
		window.history.back()
		</script>';	
//--------------------------------------------
}
mysqli_close($link);
?>
</div>
</form>