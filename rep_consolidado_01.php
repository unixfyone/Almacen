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
include('unico_1.php');
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>

 <link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
 <link rel="stylesheet" href="css/styles-wh.css">
 
<style>

.dropdown-menu > li > a:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
	
table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    border-collapse: separate !important;
    border-spacing: 0;
}	
.text-nowrap {
    white-space: nowrap !important;
}
</style>

<?php

//---------------------------------------------------------------
echo '<FORM ACTION="" method="GET">';

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
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
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//-------------
if(isset($_GET["PER"]))$PER = $_GET["PER"];
else $PER = '';
//---------------------------------------------------------------
if(isset($_GET["CT2"]))$CT2 = $_GET["CT2"];
else $CT2 = '0';
//---------------------------------------------------------------
//---------------------------------------------------------------
//	$SQLp = "SELECT * FROM wh_periodos WHERE per_id = '$PER' ";
//	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
//	while ($Filap=mysqli_fetch_array($Registrop))
//	{	
//		$AA = $Filap["per_aa"];
//		$MM = $Filap["per_mm"];
//	}
//	mysqli_free_result ($Registrop);
//---------------------------------------------------------------
//---------------------------------------------------------------
//$SQL = "SELECT * FROM wh_zones
//INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
//Where zone_id = '$ZON' ";
//$RegistroA = mysqli_query($link,$SQL);
//while($FilaA = mysqli_fetch_array($RegistroA))
//{
//$ZOND = $FilaA["zone_desc"];
//$ZONU = $FilaA["zone_ubic"];
//$DCIA = $FilaA["company"];
//} 
//mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">
<Input Type="hidden" name="PER" value="<?Php echo $PER ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" size="5px">Reportes Materiales</font></b></h1>
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
							<b><font color="#FFFFFF" size="4px">Inventario Consolidado</font></b>
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
												$SQL="Select distinct ej_aa From wh_ejercicios 
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
								</div>
							</div>
							<br>
							<?php
							if ($CIA != '' and $ZON != '' and $AA != '' and $MM != '')
							{ 
							$totale1XG = 0;
							?>
							<hr>						
							<div class="panel-body">
								<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="<?php echo "rep_consolidado_01_Excel.php?CIA=$CIA&ZON=$ZON&AA=$AA&PER=$MM"; ?> "> Descargar en Excel</a>
								<br><br>
								<?php
								$query1 = "SELECT co.company, mat.code_sap, mat.code, mat.description_m, um.name as nameum, li.namel, 
								mat.type_material_m, tm2.name as nametm2, tm2.name as namecl2, mat.cost_me, sal.saldos_fp,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
								SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
								FROM wh_materials mat
								inner join companies co on co.id = mat.company_id
								left join wh_measurement_units um on um.id = mat.wh_measurement_unit_id_m
								left join wh_lines li on li.id = mat.wh_line_id_m
								left join wh_type_material2 tm2 on tm2.id = mat.type_tm2_id
								left join wh_clasificacion_tm2  cla on cla.id = mat.clas_tm2_id
								inner join wh_saldosm sal on sal.product_id = mat.id
								where sal.aa_s = '$AA' and mat.zone_id = '$ZON' and mat.company_id = '$CIA'
								ORDER BY mat.company_id ASC, mat.code ASC
								";
								$totale1X = 0;
								//=======================================================
								$Registro1 = mysqli_query($link,$query1);			
								while($row1 = mysqli_fetch_array($Registro1))
								{
									$cost = $row1["cost_me"];

									if ($MM == '1'){$TMX = $row1["ENE"]; }
									if ($MM == '2'){$TMX = $row1["FEB"]; }
									if ($MM == '3'){$TMX = $row1["MAR"]; }
									if ($MM == '4'){$TMX = $row1["ABR"]; }
									if ($MM == '5'){$TMX = $row1["MAY"]; }
									if ($MM == '6'){$TMX = $row1["JUN"]; }
									if ($MM == '7'){$TMX = $row1["JUL"]; }
									if ($MM == '8'){$TMX = $row1["AGO"]; }
									if ($MM == '9'){$TMX = $row1["SEP"]; }
									if ($MM == '10'){$TMX = $row1["OCT"]; }
									if ($MM == '11'){$TMX = $row1["NOV"]; }
									if ($MM == '12'){$TMX = $row1["DIC"]; }

									$totale1X = $TMX * $cost;
									$totale1XG = $totale1XG + $totale1X;

								} mysqli_free_result ($Registro1);
								//======================================================= 
							    ?>
									<div class="col-lg-12" align = "right">
										<div class="form-group">
											<label><font color="blue" size="4px">Total General..:  </font></label>
											&nbsp;&nbsp;<span><b><font size="4px">
											<?php echo number_format($totale1XG, 2, ", ", ".");?>
											</font></b></span>
										</div>
									</div>								
								
								
								<div class="table">
								<table id="materials_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
								  <thead>
								  <tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Uni-Med</th>
									<th>Línea</th>
									<th>Tipo</th>
									<th>Tipo Inv</th>
									<th>Clasificación</th>
									<th>Costo</th>
									<th>Existencia</th>
									<th>Total</th>
								  </tr>
								  </thead>
								  <tbody>

								  <?php
									//=======================================================
									$totale = 0;
									$Registro2 = mysqli_query($link,$query1);			
									while($row2 = mysqli_fetch_array($Registro2))
									{
										$cost = $row2["cost_me"];

										if ($MM == '1'){$TMX = $row2["ENE"]; }
										if ($MM == '2'){$TMX = $row2["FEB"]; }
										if ($MM == '3'){$TMX = $row2["MAR"]; }
										if ($MM == '4'){$TMX = $row2["ABR"]; }
										if ($MM == '5'){$TMX = $row2["MAY"]; }
										if ($MM == '6'){$TMX = $row2["JUN"]; }
										if ($MM == '7'){$TMX = $row2["JUL"]; }
										if ($MM == '8'){$TMX = $row2["AGO"]; }
										if ($MM == '9'){$TMX = $row2["SEP"]; }
										if ($MM == '10'){$TMX = $row2["OCT"]; }
										if ($MM == '11'){$TMX = $row2["NOV"]; }
										if ($MM == '12'){$TMX = $row2["DIC"]; }

										$totale = $TMX * $cost;
										//======================================================= 
										if ($TMX != 0) {
										?>								
										<Tr height= '16px'>
										<Td><font size="2px"><?php echo $row2['code_sap']; ?></font></td>
										<Td><span class="text-wrap"><font size="2px"><?php echo $row2['description_m']; ?></font></span></td>
										<Td><font size="2px"><?php echo $row2['nameum'];?></font></td>
										<Td><font size="2px"><?php echo $row2['namel'];?></font></td>
										<Td><font size="2px"><?php echo $row2['type_material_m'];?></font></td>
										<Td><font size="2px"><?php echo $row2['nametm2'];?></font></td>
										<Td><font size="2px"><?php echo $row2['namecl2'];?></font></td>
										<Td><font size="2px"><?php echo $row2['cost_me'];?></font></td>
										<Td><font size="2px"><?php echo $TMX;?></font></td>
										<Td><font size="2px"><?php echo $totale;?></font></td>
										</tr>
									<?php
										}
									} mysqli_free_result ($Registro2); ?>
									</tbody>
								</table>
								</div>
							</div>
							<?php } ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
 <!-- /.content-wrapper -->

<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#materials_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Agregar Material</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#materials_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"materiales_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#materials_form')[0].reset();
				$('#materialseditModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//groupsdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"materiales_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#materialseditModal').modal('show');
				$('#code').val(data.code);
				$('#description').val(data.description);
				$('#prefix').val(data.prefix);
				$('#code_sap').val(data.code_sap);
				$('#part_number').val(data.part_number);
				$('#wh_measurement_unit_id').val(data.wh_measurement_unit_id);
				$('#wh_line_id').val(data.wh_line_id);
				$('#wh_category_id').val(data.wh_category_id);
				$('#wh_subcategory_id').html(data.subcategory_select_box);
				$('#wh_subcategory_id').val(data.wh_subcategory_id);				
				$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Editar Material</b></font>");
				$('#id').val(id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	
	});
<!-- ********************* Lista de Subcategorias **************** -->
    $('#wh_category_id').change(function(){
        var wh_category_id = $('#wh_category_id').val();
        var btn_action = 'load_subcategories';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{wh_category_id:wh_category_id, btn_action:btn_action},
            success:function(data)
            {
                $('#wh_subcategory_id').html(data);
            }
        });
    });	
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Material.?"))
		{
			$.ajax({
				url:"materiales_action.php",
				method:"POST",
				data:{id:id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					//marcasdataTable.ajax.reload();
					location.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});
<!-- ********************* Lista de Registros ******************************** -->
	$('#materials_data').DataTable({
		
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
				"targets":[0, 3],
				"orderable":false,
			},
		],
		"pageLength": 50
	});
<!-- ************************************************************************* -->
    $(document).on('click', '.view', function(){
        var id = $(this).attr("id");
        var btn_action = 'materials_details';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data){
                $('#materialsdetailsModal').modal('show');
				$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Detalle del Material</b></font>");
				
                $('#materials_details').html(data);
            }
        })
	});
<!-- ********************* Lista para SubCategorias ****************************** -->
    $('#wh_category_id').change(function(){
        var wh_category_id = $('#wh_category_id').val();
        var btn_action = 'load_subcategories';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{wh_category_id:wh_category_id, btn_action:btn_action},
            success:function(data)
            {
                $('#wh_subcategory_id').html(data);
            }
        });
    });
<!-- ************************************************************************* -->
})
</script>



			