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
//-------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
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
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">

<!-- =================================================================================== -->
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Ubicaciones de Materiales</font></b></h1>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Ubicaciones de Materiales por Línea</font></b>
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
												$SQL="Select distinct  uz.user_id, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = $userid and uz.userz_statu = 'Activo' 
												ORDER BY co.id ASC
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
											<span class="input-group-text"><b>Línea del Material.:</b></span>
											<select class="form-control" name="LIN" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar Línea</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_lines  
												WHERE statu = 'Activo' and typel = 'LIN' 
												ORDER BY acronym ASC";								
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($LIN == $Fila["id"])echo 'selected ';
												echo 'value=' . $Fila["id"] .'>'. $Fila["namel"] . "\n";
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
	<?php if ($CIAX != '' and $ZON != '' and $LIN != '') { ?>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card card-<?= $cstyle; ?>-dark card-outline">
							<div class="card-header bg-light border-0">
								<h5 class="card-title text-<?= $cstyle; ?>-dark text-bold">Lista de Materiales </h5>
							</div>
						</div>
					<!-------------------------------------- -->
						<div class="container-fluid">
							<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="<?php echo "reporte_01_pdf.php?CIA=$CIAX&ZON=$ZON&LIN=$LIN "; ?> " target="_blank"> Imprimir en PDF</a>
							<br><br>
						<div class="container-fluid">
							<?php
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_materials 
							INNER JOIN wh_lines on wh_lines.id = wh_materials.wh_line_id_m
							LEFT JOIN wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
							Where wh_materials.zone_id = '$ZON' and wh_materials.company_id = '$CIAX' and wh_materials.wh_line_id_m = '$LIN' and wh_materials.m_statu_m = 'Activo' 
							Order by wh_materials.code ASC";
							//--------------------------------------------------------------								
							echo "<Table id='ubic_mat' class='table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer' role='grid' border='1'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th>Codigo</th>";
							echo "<th>Descripción</th>";
							echo "<th>Línea</th>";							
							echo "<th>Categoria</th>";
							echo "<th>Ubicacion</th>";
							echo "</tr>";
							echo "</thead>";

							$Registro2 = mysqli_query($link,$SQL);
							while($Fila = mysqli_fetch_array($Registro2))
							{
								//=============================
								echo "<tr>";
								echo "<td Align=Center><font size=3>" . $Fila['code'];	
								echo "<td Align=Left><span class='text-wrap'><font size=2>".$Fila['description_m']."</font></span></td>";
								echo "<td Align=Left><font size=2>" . $Fila['namel'];
								echo "<td Align=Left><font size=2>" . $Fila['category'];
								echo "<td Align=Center><font size=2>" . $Fila['ubication'];
								echo "</tr>";
								//---------------
							} 
							mysqli_free_result ($Registro2);
							echo "</table>";
							?>
							</FORM>
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
</div>

<script>
$(document).ready(function(){
// Inicializar DataTable
    $('#ubic_mat').DataTable({
        "language":{
            "zeroRecords": "No se encontraron registros.",
            "search" : "Buscar:",
            "processing": "Procesando...",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        },
        "processing":true,
        "order":[],
        "columnDefs":[
            {
                "targets":[0, 2],
                "orderable":false
            }
        ],
        "pageLength": 50
    });

});
</script>
