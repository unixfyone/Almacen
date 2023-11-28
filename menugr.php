<?php
//menugr.php

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
.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
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
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Grupos de Opciones</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#menugrModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Grupo</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#menugrModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Grupo</button></a>
					<?php	 
					}
					?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista Grupos de Opciones</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_menu_groups";
								//---------------------------------------------------------------
								?>	
								<table id="menugr_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
									<thead>
									<tr>
										<th>ID</th>
										<th>Descripción</th>
										<th>Status</th>
										<th>Opciones</th>
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
									if($Fila2['menugr_statu'] == 'Activo')
									{
										if($del == '1' and $actua == '1')
										{
										$status = '<button type="button" name="delete" title="Cambiar Statu del Grupo" id="'.$Fila2["menugr_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["menugr_statu"].'">Activo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Statu del Grupo" id="'.$Fila2["menugr_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["menugr_statu"].'" disabled>Activo</button>';
										}		
									}
									else
									{
										if($del == '1' and $actua == '1')
										{	
										$status = '<button type="button" name="delete" title="Cambiar Statu del Grupo" id="'.$Fila2["menugr_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["menugr_statu"].'">Inactivo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Status del Grupo" id="'.$Fila2["menugr_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["menugr_statu"].'" disabled>Inactivo</button>';
										}
									}
									// ==============							
									if($Fila2['menugr_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
									{
										$editar = '<button type="button" name="update" title="Editar Grupo" id="'.$Fila2["menugr_id"].'" 
										class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
									}
									else
									{
										$editar = '<button type="button" name="update" id="'.$Fila2["menugr_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
									}
//<!-- =================================================================================== -->								
									?>
									<Tr height= '16px'>
										<Td><font size="3px"><?php echo $Fila2['menugr_id']; ?></font></td>
										<Td><font size="3px"><?php echo $Fila2['menugr_name']; ?></font></td>
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
    <div id="menugrModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="menugr_form">
    			<div class="modal-content">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Grupo de Opciones</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
    					<label>Nombre del Grupo</label>
						<input type="text" name="menugr_name" id="menugr_name" maxlength="50" class="form-control" placeholder="Nombre Grupo de Opciones" required />
    				</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="menugr_id" id="menugr_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</span></button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#menugr_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Grupos de Opciones</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->

	$(document).on('submit','#menugr_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"menugr_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#menugr_form')[0].reset();
				$('#menugrModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//menugrdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var menugr_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"menugr_action.php",
			method:"POST",
			data:{menugr_id:menugr_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#menugrModal').modal('show');
				$('#menugr_name').val(data.menugr_name);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Grupo de Opciones</b></font>");
				$('#menugr_id').val(menugr_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ************************************************************************* -->
<!-- ********************* Lista de Registros ******************************** -->
	$('#menugr_data').DataTable({
		
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
		"pageLength": 10
	});
<!-- ************************************************************************* -->
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var menugr_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Grupo?"))
		{
			$.ajax({
				url:"menugr_action.php",
				method:"POST",
				data:{menugr_id:menugr_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					//menugrdataTable.ajax.reload();
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


				