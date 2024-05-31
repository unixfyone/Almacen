<?php
//marcas.php

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
include('unico_2.php');
?>
<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
<link rel="stylesheet" href="css/styles-wh.css">
<style>

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

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Condiciones</font></h2>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#conditionsModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Condición</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#conditionsModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Condición</button></a>
					<?php	 
					}
					?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<font color="#FFFFFF" size="5px">Lista de Condiciones</font>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_conditions";
								//---------------------------------------------------------------
								?>						
								<table id="conditions_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1''>
									<thead>
									<tr>
										<th><p>ID</p></th>
										<th><p>Fecha</p></th>
										<th><p>Descripción</p></th>
										<th><p>Status</p></th>
										<th><p>Editar</p></th>
									</tr>
									</thead>
									<tbody>
									<?php
									$Registro2 = mysqli_query($link,$SQL);
									while($Fila2 = mysqli_fetch_array($Registro2))
									{
									$status = '';
									$editar = '';
//<!-- =================================================================================== -->							
									if($Fila2['c_statu'] == 'Activo')
									{
										if($del == '1' and $actua == '1')
										{
										$status = '<button type="button" name="delete" title="Cambiar Status de la Condicion" id="'.$Fila2["c_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["c_statu"].'">Activo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Status de la Condicion" id="'.$Fila2["c_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["c_statu"].'" disabled>Activo</button>';
										}		
									}
									else
									{
										if($del == '1' and $actua == '1')
										{	
										$status = '<button type="button" name="delete" title="Cambiar Status de la Condicion" id="'.$Fila2["c_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["c_statu"].'">Inactivo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Status de la Condicion" id="'.$Fila2["c_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["c_statu"].'" disabled>Inactivo</button>';
										}
									}
									// ==============							
									if($Fila2['c_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
									{
										$editar = '<button type="button" name="update" title="Editar Condicion" id="'.$Fila2["c_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
									}
									else
									{
										$editar = '<button type="button" name="update" id="'.$Fila2["c_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';
									}
//<!-- =================================================================================== -->
									$newDate = date("Y-m-d", strtotime($Fila2['created']));
									?>								
									<Tr height= '16px'>
										<Td><?php echo $Fila2['c_id']; ?></td>
										<Td><?php echo $newDate;?></td>
										<Td><?php echo $Fila2['c_description']; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $editar; ?></td>
									</tr>
									<?php } mysqli_free_result ($Registro2); ?>
									</tbody>								
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </section>
 </div>
 <!-- =================================================================================== -->
    <div id="conditionsModal" class="modal fade" data-backdrop="static">
    	<div class="modal-dialog">
    		<form method="post" id="conditions_form">
    			<div class="modal-content">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" size="5px"><i class="fa fa-plus"></i> Adicionar Condicion</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
    					<label>Incluya Descripcion de la Condicion</label>
						<input type="text" name="c_description" id="c_description" maxlength="45" class="form-control" required />
    				</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="c_id" id="c_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="fa fa-remove"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#conditions_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' size='5px'><b> Agregar Condicion</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->

	$(document).on('submit','#conditions_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"conditions_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#conditions_form')[0].reset();
				$('#conditionsModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//marcasdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var c_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"conditions_action.php",
			method:"POST",
			data:{c_id:c_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#conditionsModal').modal('show');
				$('#c_description').val(data.c_description);
				$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Editar Condicion</b></font>");
				$('#c_id').val(c_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ************************************************************************* -->
<!-- ********************* Lista de Registros ******************************** -->
	$('#conditions_data').DataTable({


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
				"targets":[0,1,4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});
<!-- ************************************************************************* -->
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var c_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Descripcion?"))
		{
			$.ajax({
				url:"conditions_action.php",
				method:"POST",
				data:{c_id:c_id, status:status, btn_action:btn_action},
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
});
</script>

<?php
//include('footer.php');
?>


				