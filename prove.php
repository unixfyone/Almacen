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
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
 
</head> 
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

<div class="content-wrapper">
	
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Proveedores</font></b></h1>
				</div>
				
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#proveModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Proveedor</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#proveModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Proveedor</button></a>
					<?php	 
					}
					?>
				</div>
			</div>
			
			<span id="alert_action"></span>
			
		</div><!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Proveedores</font></b>
						</div>
						<!-- /.card-header -->	
						<div class="card-body">
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_suppliers";
								//---------------------------------------------------------------
								?>						
								<table id="prove_data" class="table table-bordered table-striped" border='1'>
									<thead>
									<tr>
										<th>ID</th>
										<th>Descripción</th>
										<th>RIF</th>
										<th>Teléfono</th>
										<th>Contacto</th>
										<th>Tel.Contacto</th>
										<th>Status</th>
										<th>Editar</th>
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
		if($Fila2['statu'] == 'Activo')
		{
			if($del == '1' and $actua == '1')
			{
			$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'">Activo</button></a><font></b>';
			}
			else
			{
			$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Activo</button>';
			}		
		}
		else
		{
			if($del == '1' and $actua == '1')
			{	
			$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'">Inactivo</button>';
			}
			else
			{
			$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Inactivo</button>';
			}
		}
	// ==============							
			if($Fila2['statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
			{
			$editar = '<button type="button" name="update" title="Editar Proveedor" id="'.$Fila2["id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
			}
			else
			{
			$editar = '<button type="button" name="update" id="'.$Fila2["id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';
			}
	//<!-- =================================================================================== -->								
										?>								
										<Tr height= '16px'>
											<Td><font size="2px"><?php echo $Fila2['id']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['prove']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['rif']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['phone']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['contact_name']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['contact_phone']; ?></font></td>
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
    
    <div id="proveModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="prove_form">
    			<div class="modal-content">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Marca</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Razón Social</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-address-card"></i></span>
										<input type="text" name="prove" id="prove" maxlength="80" class="form-control"  placeholder="Descripción del Proveedor" required />
									</div>
								</div> 
							</div> 
							<div class="col-sm-4">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Nro. de RIF</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-spell-check"></i></span>
										<input type="text" name="rif" id="rif" maxlength="20" class="form-control" required />
									</div>
								</div> 
							</div> 
						</div>	
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Dirección</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-globe"></i></span>
										<textarea maxlength="100" name="address" id="address" class="form-control" rows="1" placeholder="Dirección del Proveedor" required></textarea>
									</div>
								</div> 
							</div>
						</div> 	
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Telefonos Proveedor</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone"></i></span>
										<input type="text" name="phone" id="phone" maxlength="60" class="form-control" required />
									</div>
								</div> 
							</div> 
						</div>	
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Persona Contacto</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-address-book"></i></span>
										<input type="text" name="contact_name" id="contact_name" maxlength="60" class="form-control" placeholder="Nombre del contacto" required />
									</div>
								</div> 
							</div> 
							<div class="col-sm-6">
								<div class="form-group">
									<label><font FACE="times new roman" size="3px">Telf. Contacto</font></label>
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone"></i></span>
										<input type="text" name="contact_phone" id="contact_phone" maxlength="60" class="form-control" />
									</div>
								</div> 
							</div> 
						</div>
    				</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="id" id="id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="fa fa-right-from-bracket"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#prove_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b> Agregar Proveedor</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->

	$(document).on('submit','#prove_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"prove_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#prove_form')[0].reset();
				$('#proveModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//marcasdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"prove_action.php",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#proveModal').modal('show');
				$('#prove').val(data.prove);
				$('#rif').val(data.rif);
				$('#address').val(data.address);
				$('#phone').val(data.phone);
				$('#contact_name').val(data.contact_name);
				$('#contact_phone').val(data.contact_phone);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Proveedor</b></font>");
				$('#id').val(id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ************************************************************************* -->
<!-- ********************* Lista de Registros ******************************** -->
	$('#prove_data').DataTable({


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
		"pageLength": 8
	});
<!-- ************************************************************************* -->
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Proveedor?"))
		{
			$.ajax({
				url:"prove_action.php",
				method:"POST",
				data:{id:id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
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


				