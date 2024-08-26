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

.dataTables_filter{text-align:right}

.dataTables_filter label {
  font-weight: normal;
  white-space: nowrap;
  text-align: left;
}

.dataTables_filter input {
  margin-left: 0.5em;
  display: inline-block;
  width: auto;
}

.dataTables_length label {  font-weight:  normal; text-align: left;   white-space: nowrap;}
dataTables_length select {  width: auto;  display: inline-block;}

.btn-xs, .btn-group-xs > .btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-warning {
    color: #ffffff;
    background-color: #dd5600;
    border-color: #dd5600;
}
.border {
    border: 1px solid #<?=$ccolor;?>;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
    box-shadow: none;
}
.btn-success {
    color: #fff;
    background-color: #218838;
    border-color: #1e7e34;
}
.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}

.navbar-nav .open .dropdown-menu {
    position: static;
    float: none;
    width: auto;
    margin-top: 0;
    background-color: transparent;
    border: 0;
    box-shadow: none;
}
.navbar-nav .open .dropdown-menu > li > a {
    line-height: 20px;
}
.navbar-nav .open .dropdown-menu > li > a, .navbar-nav .open .dropdown-menu .dropdown-header {
    padding: 5px 15px 5px 25px;
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
//---------------------------------------------------------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';
//-------------
if(isset($_GET["prod"]))$prod = $_GET["prod"];
else $prod = '';

//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>" />
<Input Type="hidden" name="prod" value="<?Php echo $prod ?>">
<Input Type="hidden" name="AA" value="<?Php echo $AA ?>">
<Input Type="hidden" name="MM" value="<?Php echo $MM ?>">
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
												$SQL="Select distinct  uz.user_id, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = $userid and uz.userz_statu = 'Activo' 
												ORDER BY co.id ASC
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
												WHERE zone_id = '$ZON' ";
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
								</div><br>
							</div>
						</div>
					</div>		
				</div>			
			</div>				
		</div>					
	</section>						
	<!-- ========================================================== -->
	<?php if ($CIA != '' and $ZON != '' and $AA != '' and $MM != '') { ?>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card card-<?= $cstyle; ?>-dark card-outline">
							<div class="card-header bg-light border-0">
								<h5 class="card-title text-<?= $cstyle; ?>-dark text-bold">Materiales </h5>
							</div>
						</div>
					<!-------------------------------------- -->
						<FORM>
						<?php
							if(isset($_GET["prod"]))$prod = $_GET["prod"];
							else $prod = '';
						?>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-text"><b>Código Material:</b></span>
										<b><input class="form-control" type="text" id="prod" name="prod" size="20" maxlength="45" value="<?Php echo $prod ?>"  placeholder="Cod. Material"></b>
										<span class="input-group-btn">
										<button class="btn btn-default" name="boton1" type="submit"><i class="w3-margin-left fa fa-search"> Buscar</i></button></span>
									</div>
								</div>
							</div>
						</div>	

						</FORM>	
						<?php } ?>
					<!-- *********************************** -->	
						<div class="container-fluid">
							<?php
							if (isset($_GET["boton1"])){
							if ($prod == ""	) {
							//---------------------------------------------------------------
							$SQL = "SELECT movd.product_cod, movd.product_id, mat.description_m, mat.m_statu_m, 
							cat.category, um.name AS umname, sal.sal_id, sal.product_id AS sproduct_id, sal.aa_s, 
							sal.saldos_e, sal.saldos_s, sal.saldos_fp
							FROM wh_movinvd movd
							LEFT JOIN wh_materials mat ON mat.id = movd.product_id
							LEFT JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
							INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
							LEFT JOIN wh_saldosm sal ON sal.product_id = movd.product_id AND sal.aa_s = movd.movd_ejer
							WHERE movd.movd_cia = '$CIA' AND movd.movd_zone = '$ZON' AND movd.movd_ejer = '$AA' 
							AND sal.zone_id = '$ZON'
							GROUP BY movd.product_cod, movd.product_id, mat.description_m, mat.m_statu_m, cat.category, um.name, sal.sal_id, sal.product_id, sal.aa_s, sal.saldos_e, sal.saldos_s, sal.saldos_fp
							ORDER BY  movd.product_id ASC" ;
							
							}  else  {
								
							$SQL = "SELECT DISTINCT movd.product_cod, movd.product_id, mat.description_m, mat.m_statu_m, cat.category, um.name AS umname,
							sal.sal_id, sal.product_id AS sproduct_id, sal.aa_s, sal.saldos_e, sal.saldos_s, sal.saldos_fp
							FROM wh_movinvd movd
							INNER JOIN wh_materials mat ON mat.id = movd.product_id
							LEFT JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
							INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
							LEFT JOIN wh_saldosm sal ON sal.product_id = movd.product_id and sal.aa_s = movd.movd_ejer
							WHERE movd.product_cod LIKE '%$prod%' and movd.movd_cia = '$CIA' and movd.movd_zone = '$ZON' and movd.movd_ejer = '$AA' and movd.movd_per = '$MM' and sal.zone_id = '$ZON'
							ORDER BY movd.product_id ASC";								
							}
							//---------------------------------------------------------------
							echo "<b><font color='#0066FF' FACE='times new roman' size='4px'>Lista de Materiales</font></b>";
							echo "<br>";
							echo "<Table id='product_data' class='table table-bordered table-hover'>";

							echo "<thead>";
							echo "<tr>";
							echo "<th>Codigo</th>";
							echo "<th>Descripción</th>";
							echo "<th>Categoria</th>";							
							echo "<th>UniMed</th>";
							echo "<th>Statu</th>";
							echo "<th>Cantidad</th>";
							echo "</tr>";
							echo "</thead>";
							//--------
							$MM_ANT = $MM - 1; 			// Mes periodo actual en arreglo
							$MM_PANT = $MM;				// Mes para Saldo del Periodo anterior (13 Pos)
							$exe = 0;
							$exs = 0;
							$expa = 0;
							//--------
							$Registro2 = mysqli_query($link,$SQL);
							while($Fila = mysqli_fetch_array($Registro2))
							{
								if($Fila['m_statu_m'] == 'Activo')
								{
									$status = '<span class=""><font color="blue" FACE="times new roman" size="3px">Activo</font></span>';
								}	else	{
									$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Inactivo</font></span>';
								}	
								//=============================
								$mValore = '';
								$mValors = '';
								$mValorfp = '';
								
								if($MM == 1)
								{
									$MM_PANT = $MM - 1;	
									$mValorfp=explode("|", $Fila["saldos_fp"]);
									$expa = $mValorfp[$MM_PANT];
								}
								$mValore=explode("|", $Fila["saldos_e"]);
								$exe = $mValore[$MM_ANT];

								$mValors=explode("|", $Fila["saldos_s"]);
								$exs = $mValors[$MM_ANT];

								$existencia = $expa + $exe - $exs;
								$CPROD = $Fila['product_cod'];
								$DPROD = $Fila['description_m'];
								//=============================
								echo "<tr>";
								if($Fila['m_statu_m'] != 'Activo')
								{
									echo "<td align=Center><font size=3>" . $Fila['product_cod'];	
								} else {	
									echo "<td bgcolor=eeeeee align=Center><font size=3><a <button type='button' name='view'
									data-expa=".$expa."
									data-desc='".$Fila["description_m"]."'
									data-pcod='".$Fila["product_cod"]."'
									id=".$Fila['product_id']." class='view'>".$Fila['product_cod']."</button></a></td>"; 
								}
								echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
								echo "<td align=Left><font size=2>" . $Fila['category'];
								echo "<td align=Left><font size=2>" . $Fila['umname'];
								echo "<td align=Center><font size=2>" . $status;
								echo "<Td align='center'><font size='2px'>" . number_format($existencia, 2, ',', '.');
								echo "</tr>";
								//---------------
							} 
							mysqli_free_result ($Registro2);
							echo "</table>";
							} 
							//}
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
<!-- =================================================================================== -->	
        <div id="productdetailsModal" class="modal fade">
            <div class="modal-dialog modal-xl">
                <form method="post" id="productdetails_form">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#<?=$ccolor;?>">
							<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Detalle de Movimientos</font></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <Div id="product_details"></Div>
                        </div>
                        <div class="modal-footer" style="background-color:#FFFFFC">
							<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<!--  ======================================================================================= -->
<script>
$(document).ready(function(){
<!-- ********************* Lista de Registros ******************************** -->
	$('#product_data').DataTable({
		
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
				"targets":[0, 4, 5],
				"orderable":false,
			},
		],
		"pageLength": 50
	});
<!-- ********************* Detalle del Producto ***************************** -->
    $(document).on('click', '.view', function(){
        var product_id = $(this).attr("id");
        var btn_action = 'product_details';
		var xaa = $("#xaa").val();
		var xmm = $("#xmm").val();
		var expa = $(this).data("expa");
		var desc = $(this).data("desc");
		var pcod = $(this).data("pcod");
        $.ajax({
            url:"cs_product_M01_action.php",
            method:"POST",
            data:{
			product_id:product_id, 
			btn_action:btn_action, 
			xaa:xaa, 
			xmm:xmm, 
			expa:expa, 
			desc:desc,
			pcod:pcod
			},
            success:function(data){
                $('#productdetailsModal').modal('show');
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Detalle de Movimientos</b></font>");
                $('#product_details').html(data);
            }
        })
    });
<!-- ************************************************************************* -->	
});
</script>
