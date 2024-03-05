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
							<b><font color="#FFFFFF" size="4px">Inventario Consolidado General</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-3">
										<div class="input-group">
											<span class="input-group-text"><b>Ejercicio...:</b></span>
											<select class="form-control" name="AA" id = "xaa" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * From wh_ejercicios 
												group by ej_aa";
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
												WHERE per_aa = '$AA' group by per_mm ";
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
							if ($AA != '' and $MM != '')
							{ 
							?>
							<hr>						
							<div class="panel-body">
								<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="<?php echo "rep_consolidado_02_Excel.php?AA=$AA&PER=$MM"; ?> "> Descargar en Excel</a>
								<br><br>
								<?php
								$SQL = "SELECT *, wh_measurement_units.name AS nameum, wh_lines.namel, wh_materials.id AS matid,  wh_categories.category, wh_type_material2.name AS nametm2, wh_clasificacion_tm2.name AS namecl2
								FROM wh_materials 
								INNER join companies on companies.id = wh_materials.company_id
								left join wh_measurement_units on wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
								left join wh_lines on wh_lines.id = wh_materials.wh_line_id_m
								left join wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
								left join wh_type_material2 on wh_type_material2.id = wh_materials.type_tm2_id
								left join wh_clasificacion_tm2 on wh_clasificacion_tm2.id = wh_materials.clas_tm2_id
								ORDER BY wh_materials.zone_id DESC, wh_materials.code ASC
								";
								//----------------------------
								?>
								<div class="table">
								<table id="materials_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
								  <thead>
								  <tr>
									<th>Empresa</th>
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
									$Registro2 = mysqli_query($link,$SQL);
									while($Fila2 = mysqli_fetch_array($Registro2))
									{
										$status = '';
										$accion = '';
										$btnVer = '';
										$total = '0';
										//$existencia = 0 * 1;
										$prodid2 = $Fila2["matid"];
										$ZON = $Fila2["zone_id"];
										//----------------------------
										$mValore = '';
										$mValors = '';
										$mValorfp = '';
										//----------------------------
										$query = "SELECT *, Count(sal_id) AS Cuenta1 FROM wh_saldosm 
										WHERE product_id = '$prodid2' and aa_s = '$AA' and zone_id = '$ZON' ";	
										
										$Registro3 = mysqli_query($link,$query);			
										while($row3 = mysqli_fetch_array($Registro3))
										{
											$CTA2 = $row3['Cuenta1'];
											//=======================================================
											if ($CTA2 > '0') 
											{ 
												$MM_ANT = $MM - 1; 		// Mes periodo actual en arreglo (12 Pos)
												$MM_PANT = $MM - 1;		// Mes para Saldo del Periodo anterior (13 Pos)
												
												$mValore=explode("|", $row3["saldos_e"]);
												$exe = $mValore[$MM_ANT];

												$mValors=explode("|", $row3["saldos_s"]);
												$exs = $mValors[$MM_ANT];

												$mValorfp=explode("|", $row3["saldos_fp"]);
												$expa = $mValorfp[$MM_PANT];	
												
											}	else	{
												$exe = 0;
												$exs = 0;
												$expa = 0;
											}
										}
										$existencia = ((int)$expa + (int)$exe - (int)$exs );
										$totale = $existencia * $Fila2["cost_me"];
										//=======================================================	
										if ($existencia != 0) {
										?>								
										<Tr height= '16px'>
										<Td><font size="2px"><?php echo $Fila2['company']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['code_sap']; ?></font></td>
										<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['description_m']; ?></font></span></td>
										<Td><font size="2px"><?php echo $Fila2['nameum'];?></font></td>
										<Td><font size="2px"><?php echo $Fila2['namel'];?></font></td>
										<Td><font size="2px"><?php echo $Fila2['type_material_m'];?></font></td>
										<Td><font size="2px"><?php echo $Fila2['nametm2'];?></font></td>
										<Td><font size="2px"><?php echo $Fila2['namecl2'];?></font></td>
										<Td><font size="2px"><?php echo $Fila2['cost_me'];?></font></td>
										<Td><font size="2px"><?php echo $existencia;?></font></td>
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



			