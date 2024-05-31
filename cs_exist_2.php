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
$userid= $_SESSION['user_id'];

include('headerx.php');
include('unico.php');
include('unico_1.php');
?>

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">

<style type="text/css">
.button {
    display: block;
    width: 115px;
    height: 25px;
    background: #343a40;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    line-height: 25px;
}
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
</style>

<?php
echo '<FORM ACTION="">';

if(isset($_GET["CIAX"]))$CIAX = $_GET["CIAX"];
else $CIAX = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["CAT"]))$CAT = $_GET["CAT"];
else $CAT = '';
//--------------

//===============================================================
	$SQLp = "SELECT * FROM wh_periodos 
	WHERE per_statu = 'Abierto' and zone_id = '$ZON' ";
	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA = $Filap["per_aa"];
		$MM = $Filap["per_mm"];
	}
	mysqli_free_result ($Registrop);
	//===============================================================
?>
	

<Input Type="hidden" name="CIAX" value="<?Php echo $CIAX ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="CAT" value="<?Php echo $CAT ?>">

<!-- =================================================================================== -->
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Existencia de Materiales</font></b></h1>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Existencia de Materiales por Categorias</font></b>
						</div>
						<!-- /.card-header -->
<!-- =================================================================================== -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia:</b></span>
											<select class="form-control" name="CIAX" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select uz.*, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo' 
												GROUP BY uz.uzcompany_id
												";
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($CIAX == $Fila["id"])echo 'selected ';
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
											<span class="input-group-text"><b>Almacen.:</b></span>
											<select class="form-control" name="ZON" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar la Ubicación</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_user_zones 
												INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIAX' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
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
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Categorias Materiales.:</b></span>
											<select class="form-control" name="CAT" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_categories WHERE cat_statu = 'Activo' 
												ORDER BY category";								
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($CAT == $Fila["cat_id"])echo 'selected ';
												echo 'value=' . $Fila["cat_id"] .'>'. $Fila["category"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>						
								</div>
								<br>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ========================================================== -->
	<?php if ($CIAX != '' and $ZON != '' and $CAT != '') { ?>
	
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
						<div class="container-fluid">
							<?php
							//if ($CAT != '') {
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_materials 
							left JOIN wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
							left JOIN wh_saldosm on wh_saldosm.product_id = wh_materials.id
							Where wh_materials.zone_id = '$ZON' and wh_materials.company_id = '$CIAX' and wh_materials.wh_category_id_m = '$CAT' and wh_materials.m_statu_m = 'Activo' and wh_saldosm.aa_s = '$AA'
							Order by wh_materials.code ASC";
							//---------------------------------------------------------------
							//} else {
							//---------------------------------------------------------------
//echo "<pre>"; print_r($SQL); exit();
							//--------------------------------------------------------------								
							//} 
							echo "<b><font color='#0066FF' FACE='times new roman' size='4px'>Lista de Materiales</font></b>";
							echo "<Table class='table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer' role='grid' border='1'>";

							echo "<thead>";
							echo "<tr>";
							echo "<th>Codigo</th>";
							echo "<th>Descripción</th>";
							echo "<th>Categoria</th>";							
							echo "<th>Ubicación</th>";
							echo "<th>Statu</th>";
							echo "<th>Existencia</th>";
							echo "</tr>";
							echo "</thead>";

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
								$GRPXD = '';
								$prodid = $Fila["id"];
								$prod2X = $Fila["code"];
								$GRPXD =  $Fila["category"];
								
								$MM_ANT = $MM - 1; 				// Mes periodo actual en arreglo
								$MM_PANT = $MM - 1;				// Mes para Saldo del Periodo anterior (13 Pos)
		
									if($Fila['sal_id'] != null)
									{
										$mValore = '';
										$mValors = '';
										$mValorfp = '';
										
										$mValore=explode("|", $Fila["saldos_e"]);
										$exe = $mValore[$MM_ANT];

										$mValors=explode("|", $Fila["saldos_s"]);
										$exs = $mValors[$MM_ANT];

										$mValorfp=explode("|", $Fila["saldos_fp"]);
										$expa = $mValorfp[$MM_PANT];	
										
									}	else	{
										$exe = 0;
										$exs = 0;
										$expa = 0;
									}
									$existencia = $expa + $exe - $exs;
								//=============================
								echo "<tr>";
								if($Fila['m_statu_m'] != 'Activo')
								{
									echo "<td Align=Center><font size=3>" . $Fila['code'];	
								} else {	
									echo "<td bgcolor=eeeeee align=Center><font size=3><a <button type='button' name='view' data-aa=".$AA." 
									data-mm=".$MM." 
									data-expa=".$expa."
									data-exe=".$exe."
									data-exs=".$exs."
									id=".$Fila['id']." class='view'>".$Fila['code']."</button></a></td>"; 
								}
								echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
								echo "<td Align=Left><font size=2>" . $Fila['category'];
								echo "<td Align=Left><font size=2>" . $Fila['ubication'];
								echo "<td Align=Center><font size=2>" . $status;
								echo "<td Align=Center><font size=2>" . $existencia;
								echo "</tr>";
								//---------------
							} 
							mysqli_free_result ($Registro2);
							echo "</table>";
							?>
							</FORM>
							<br><br>
<!-- ============================== -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
</div>
<!-- =================================================================================== -->	
        <div id="productdetailsModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <form method="post" id="productdetails_form">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#<?=$ccolor;?>">
							<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Detalle del Material</font></h4>
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
<!-- ********************* Detalle del Producto ***************************** -->
    $(document).on('click', '.view', function(){
        var id = $(this).attr("id");
		var aa = $(this).data("aa");
		var mm = $(this).data("mm");
		var expa = $(this).data("expa");
		var exe = $(this).data("exe");
		var exs = $(this).data("exs");
        var btn_action = 'product_details';
        $.ajax({
            url:"cs_exist_1_action.php",
            method:"POST",
            data:{id:id, 
			aa:aa,
			mm:mm,
			expa:expa,
			exe:exe,
			exs:exs,
			btn_action:btn_action},
            success:function(data){
                $('#productdetailsModal').modal('show');
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Detalle del Material</b></font>");
                $('#product_details').html(data);
            }
        })
    });
<!-- ************************************************************************* -->	
});
</script>
