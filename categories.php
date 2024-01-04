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
					<h2 class="m-0"><font color="#<?=$ccolor;?>">Categorias</font></h2>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#categoriesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Categoria</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#categoriesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Categoria</button></a>
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
				<font color="#FFFFFF" size="5px">Lista de Categorias</font>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<div class="panel-body">
					<?php
					//---------------------------------------------------------------
					$SQL = "SELECT * FROM wh_categories";
					//---------------------------------------------------------------
					?>
					<table id="categories_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
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
						if($Fila2['cat_statu'] == 'Activo')
						{
							if($del == '1' and $actua == '1')
							{
							$status = '<b><font color=green size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Categoria" id="'.$Fila2["cat_id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["cat_statu"].'">Activo</button></a><font></b>';
							}
							else
							{
							$status = '<b><font color=green size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Categoria" id="'.$Fila2["cat_id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["cat_statu"].'" disabled>Activo</button></a><font></b>';
							}		
						}
						else
						{
							if($del == '1' and $actua == '1')
							{	
							$status = '<b><font color=red size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Categoria" id="'.$Fila2["cat_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["cat_statu"].'">Inactivo</button></a><font></b>';
							}
							else
							{
							$status = '<b><font color=red size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Categoria" id="'.$Fila2["cat_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["cat_statu"].'" disabled>Inactivo</button></a><font></b>';
							}
						}
						// ==============							

						if($Fila2['cat_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
						{
						$accion = '<button type="button" name="update" title="Editar Categoria" id="'.$Fila2["cat_id"].'" 
						class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
						}
						else
						{
						$accion = '<button type="button" name="update" id="'.$Fila2["cat_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
						}

	//<!-- =================================================================================== -->
						$newDate = date("Y-m-d", strtotime($Fila2['created']));
						?>								
						<Tr height= '16px'>
							<Td><?php echo $Fila2['cat_id']; ?></td>
							<Td><?php echo $newDate;?></td>
							<Td><?php echo $Fila2['acronym'];?></td>
							<Td><?php echo $Fila2['category'];?></td>
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
     <div id="categoriesModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="categories_form">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" size="5px"><i class="fa fa-plus"></i> Adicionar Categoria</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font size="3px">Sigla</font></label>
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-spell-check"></i></span>
												<input type="text" name="acronym" id="acronym" maxlength="4" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required />
											</div>
										</div> 
									</div>                        
									<div class="col-sm-8">
										<div class="form-group">
											<label><font size="3px">Descripción de la Categoria</font></label>
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-object-ungroup"></i></span>
													<input type="text" name="category" id="category" maxlength="100" class="form-control" onkeyup="this.value = this.value.toUpperCase();" required />
											</div>
										</div>                                 
									</div>
								</div>
							</div>
						</div>					
					</div>
					<br>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="cat_id" id="cat_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><i class="fa fa-right-from-bracket "></i>Cancelar</button>	
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
		$('#categories_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' size='5px'>Agregar Categoria</font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#categories_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"categories_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#categories_form')[0].reset();
				$('#categoriesModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//groupsdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var cat_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"categories_action.php",
			method:"POST",
			data:{cat_id:cat_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#categoriesModal').modal('show');
				$('#category').val(data.category);
				$('#acronym').val(data.acronym);
				$('.modal-title').html("<font color='#FFFFFF' size='5px'>Editar Categoria</font>");
				$('#cat_id').val(cat_id);
				$('#action').val('Actualizar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var cat_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Categoria?"))
		{
			$.ajax({
				url:"categories_action.php",
				method:"POST",
				data:{cat_id:cat_id, status:status, btn_action:btn_action},
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
	$('#categories_data').DataTable({
		
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

 <?php
 //include('footer.php');
?>



			