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
	 <link rel="stylesheet" href="css/styles-wh.css">
	 
<style type="text/css">

.border {
    border: 1px solid #<?=$ccolor;?>;
}

.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}

</style>

<?php
//---------------------------------------------------------------
echo '<FORM ACTION="">';

if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["AA"]))$AA = $_GET["AA"];
else $AA = '0';
//-------------
if(isset($_GET["MM"]))$MM = $_GET["MM"];
else $MM = '0';
//-------------
if(isset($_GET["MID"]))$MID = $_GET["MID"];
else $MID = '';

//---------------------------------------------------------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//-------------


//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />

<Input Type="hidden" name="AA" value="<?Php echo $AA ?>">
<Input Type="hidden" name="MM" value="<?Php echo $MM ?>">
<Input Type="hidden" name="MID" value="<?Php echo $MID; ?>">
<!-- =================================================================================== -->
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Movimientos Almacenes</font></b></h1>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Movimientos por Periodos</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia:</b></span>
											<select class="form-control" name="CIA" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select uz.*, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo' 
												GROUP BY uz.uzcompany_id
												";
												//---------------------------------------------------------------
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($CIA == $Fila["id"])echo 'selected ';
												echo 'value=' . $Fila["id"] .'>'. $Fila["company"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>				
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Zona Ubicación:</b></span>
											<select class="form-control" name="ZON" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar la Ubicación</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_user_zones 
												INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIA' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
												ORDER BY wh_zones.zone_desc";								
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												$UBIC = $Fila["zone_desc"] ."&nbsp;&nbsp; / &nbsp;&nbsp;". $Fila["zone_ubic"];
												//----
												echo '<option ';
												if($ZON == $Fila["zone_id"])echo 'selected ';
												echo 'value=' . $Fila["zone_id"] .'>'. $UBIC . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>			  
								</div>
								<div class="row">								
									<div class="col-lg-3">
										<div class="input-group">
											<span class="input-group-text"><b>Ejercicio...:</b></span>
											<select class="form-control" name="AA" id = "xaa" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * From wh_ejercicios 
												where zone_id = '$ZON' ";
												$Registro=mysqli_query($link, $SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($AA == $Fila["ej_aa"])echo 'selected ';
												echo 'value=' . $Fila["ej_aa"] .'>'. $Fila["ej_aa"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="input-group">
											<span class="input-group-text"><b>Periodo.:</b></span>
											<select class="form-control" name="MM" id = "xmm" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * From wh_periodos 
												WHERE zone_id = '$ZON' and per_aa = '$AA' ";
												$Registro=mysqli_query($link, $SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($MM == $Fila["per_mm"])echo 'selected ';
												echo 'value=' . $Fila["per_mm"] .'>'. $Fila["per_mm"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Tipo de Movimiento.:</b></span>
											<select class="form-control" name="MID" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar Movimientos</option>							
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_tipmov group by tm_tipo";
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($MID == $Fila["tm_tipo"])echo 'selected ';
												echo 'value=' . $Fila["tm_tipo"] .'>'. $Fila["tm_tipo"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>									
								</div><br>
							</div>
						</div>
					</div>		
				</div>			
			</div>				
		</div>					
	</section>						
	<!-- ========================================================== -->
	<?php if ($CIA != '' and $ZON != '' and $AA != '' and $MM != '' and $MID != '') { ?>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card card-<?= $cstyle; ?>-dark card-outline">
							<div class="card-header bg-light border-0">
								<h5 class="card-title text-<?= $cstyle; ?>-dark text-bold">Movimientos </h5>
							</div>
						</div>

					<!-- *********************************** -->	
						<div class="container-fluid">
							<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="<?php echo "rep_mov_mat_01_Excel.php?CIA=$CIA&ZON=$ZON&AA=$AA&MM=$MM&MID=$MID "; ?> "> Descargar en Excel</a>
							<br><br>
						
							<?php
							//---------------------------------------------------------------
							$SQL = "SELECT movd.*, mat.*, cat.category, um.name AS umname,
							sal.sal_id, sal.saldos_e, sal.saldos_s, sal.saldos_fp, li.namel, su.prove
							FROM wh_movinvd movd
							INNER JOIN wh_materials mat ON mat.id = movd.product_id
							LEFT JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
							INNER JOIN wh_lines li ON li.id = mat.wh_line_id_m
							LEFT JOIN wh_movinvh movh ON movh.movh_id = movd.movh_id
							LEFT JOIN wh_suppliers su ON su.id = movh.movh_prove_id
							LEFT JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
							LEFT JOIN wh_saldosm sal ON sal.product_id = movd.product_id and sal.aa_s = movd.movd_ejer
							WHERE movd.movd_cia = '$CIA' and movd.movd_zone = '$ZON' and movd.movd_ejer = '$AA' and movd.movd_per = '$MM' and movd.movd_tmov = '$MID'and sal.aa_s = '$AA' and sal.zone_id = '$ZON'
							ORDER BY movd.product_id ASC";

							//---------------------------------------------------------------
							echo "<Table id='movimientos_data' class='table table-bordered table-hover' >";

							echo "<thead>";
							echo "<tr>";
							echo "<th>Fecha</th>";
							echo "<th>Codigo</th>";
							echo "<th>Descripción</th>";
							echo "<th>Uni-Med</th>";
							echo "<th>Línea</th>";														
							echo "<th>Cantidad</th>";
							echo "<th>C/U</th>";
							if ($MID == 'ENTRADAS') {
								echo "<th>Proveedor</th>";
							} 
							echo "<th>Sub Total</th>";
							echo "</tr>";
							echo "</thead>";

							$Registro2 = mysqli_query($link,$SQL);
							while($Fila = mysqli_fetch_array($Registro2))
							{
								$stotale = $Fila['movd_cant'] * $Fila['movd_costou_me'];
								//=============================
								echo "<tr>";
								echo "<td align=Center><font size=3>" . $Fila['movd_fecha'];	
								echo "<td align=Center><font size=3>" . $Fila['product_cod'];	
								echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
								echo "<td align=Left><font size=2>" . $Fila['umname'];
								echo "<td align=Left><font size=2>" . $Fila['namel'];
								echo "<td align=Left><font size=2>" . $Fila['movd_cant'];
								echo "<td align=Center><font size=2>" . $Fila['movd_costou_me'];
								if ($MID == 'ENTRADAS') {
									echo "<td align=Center><span class='text-wrap'><font size=2>" . $Fila['prove'];
								}
								echo "<Td align='center'><font size='2px'>" . number_format($stotale, 2, ',', '.');
								echo "</tr>";
								//---------------
							} 
							mysqli_free_result ($Registro2);
							echo "</table>";
							}
							?>
							</FORM>
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!--  ======================================================================================= -->
<script>
$(document).ready(function(){
<!-- ********************* Lista de Registros ******************************** -->
	$('#movimientos_data').DataTable({
		
		"language":{
			"zeroRecords": "No se encontraron registros.",
            "search" : "Buscar:",
            "Processing": "Procesando...",
            "paginate": {
				"previous": "Anterior",
				"next": "Siguiente", 
			}
		},
		
		"processing":true,
		"order":[],

		"columnDefs":[
			{
				"targets":[8],
				"orderable":false,
			},
		],
		"pageLength": 50
	});
<!-- ************************************************************************* -->	
});
</script>
