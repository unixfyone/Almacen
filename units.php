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
include('unico_2.php');
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  
 
</head> 
<style>
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
.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}
</style>

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Medidas </font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#unidadesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Unidad</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#unidadesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Unidad</button></a>
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
          <div class="col-12">
            <div class="card card-<?= $cstyle; ?> elevation-2">
              <div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
				<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Unidades de Medidas</font></b>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<div class="panel-body">
					<?php
					//---------------------------------------------------------------
					$SQL = "SELECT * FROM wh_measurement_units";
					//---------------------------------------------------------------
					?>
					<table id="unidades_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
					  <thead>
						<tr>
						<th>ID</th>
						<th>Fecha</th>
						<th>Sigla</th>
						<th>Descripción</th>
						<th>Status</th>
						<th>Acciones</th>
						</tr>
					  </thead>
					  <tbody>			  
						<?php
						$Registro2 = mysqli_query($link,$SQL);
						while($Fila2 = mysqli_fetch_array($Registro2))
						{
						$status = '';
						$accion = '';			  
						//<!-- ================================== -->
						if($Fila2['statu'] == 'Activo')
						{
							if($del == '1' and $actua == '1')
							{
							$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status de la Unidad" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'">Activo</button></a><font></b>';
							}
							else
							{
							$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status de la Unidad" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Activo</button></a><font></b>';
							}		
						}
						else
						{
							if($del == '1' and $actua == '1')
							{	
							$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status de la Unidad" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'">Inactivo</button></a><font></b>';
							}
							else
							{
							$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status de la Unidad" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Inactivo</button></a><font></b>';
							}
						}
						// ==============							

						if($Fila2['statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
						{
						$accion = '<button type="button" name="update" title="Editar Unidad" id="'.$Fila2["id"].'" 
						class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
						}
						else
						{
						$accion = '<button type="button" name="update" id="'.$Fila2["id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
						}

	//<!-- =================================================================================== -->	
						?>								
						<Tr height= '16px'>
							<Td><font size="2px"><?php echo $Fila2['id']; ?></font></td>
							<Td><font size="2px"><?php echo $Fila2['created'];?></font></td>
							<Td><font size="2px"><?php echo $Fila2['acronym'];?></font></td>
							<Td><font size="2px"><?php echo $Fila2['name'];?></font></td>
							<td align="center"><?php echo $status; ?></td>
							<td><?php echo $accion; ?></td>
						</tr>
						<?php } mysqli_free_result ($Registro2); ?>
						</tbody>
					</table>
				</div>
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
 <!-- =================================================================================== -->
     <div id="unidadesModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="unidades_form">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Unidad</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px">Sigla</font></label>
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-spell-check"></i></span>
												<input type="text" name="acronym" id="acronym" maxlength="4" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required />
											</div>
										</div> 
									</div>                        
									<div class="col-sm-8">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px">Descripción Unidad de Medida</font></label>
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-object-ungroup"></i></span>
												<input type="text" name="name" id="name" maxlength="100" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required />
											</div>
										</div>                                 
									</div>
								</div>
							</div>
						</div>					
					</div>
					<br>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="id" id="id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><i class="fa fa-right-from-bracket "></i>Cerrar</button>	
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

 <!-- /.content-wrapper -->
  
  
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#unidades_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Unidades</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#unidades_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"units_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#unidades_form')[0].reset();
				$('#unidadesModal').modal('hide');
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
			url:"units_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#unidadesModal').modal('show');
				$('#name').val(data.name);
				$('#acronym').val(data.acronym);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Unidades</b></font>");
				$('#id').val(id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Unidad de Medida?"))
		{
			$.ajax({
				url:"units_action.php",
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
	$('#unidades_data').DataTable({
		
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
				"targets":[0, 5],
				"orderable":false,
			},
		],
		"pageLength": 10
	});
<!-- ************************************************************************* -->
});
</script>
		