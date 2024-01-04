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

<div class="content-wrapper">

		<!-- Content Header (Page header)  -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Tipos de Movimientos</font></b></h1>
					</div>
					<div class="col-sm-6" align='right'>
						<?php
						if($add == '1' and $actua == '1')
						{
						?>
						<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#tipmovModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar Tipo</button></a>
						<?php
						} else {
						?>
						<a>
						<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#tipmovModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Tipo</button></a>
						<?php	 
						}
						?>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
<!-- =================================================================================== -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-<?= $cstyle; ?> elevation-2">
							<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
								<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Tipos de Movimientos</font></b>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="panel-body">
									<?php
									//---------------------------------------------------------------
									$SQL = "SELECT * FROM wh_tipmov ";
									//---------------------------------------------------------------
									?>						
									<table id="tipmov_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" border='1'>
										<thead>
										<tr>
											<th>Código</th>
											<th>Descripción Movimiento</th>
											<th>Tipo</th>
											<th>Act Costo</th>
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
										//======================================= -->
										$tipo = '';
										if($Fila2['tm_tipo'] == 'ENTRADAS')
										{
											$tipo = '<span><font color="blue" size="3px">ENTRADAS</font></span>';
										}
										else
										{
											$tipo = '<span><font color="red" size="3px">SALIDAS</font></span>';
										}
										//==========
										$actc = '';
										if($Fila2['tm_actcost'] == 'Si')
										{
											$actc = '<span><font color="blue" size="3px">Si</font></span>';
										}
										else
										{
											$actc = '<span><font color="black" size="3px">No</font></span>';
										}
										//==========
										if($Fila2['tm_statu'] == 'Activo')
										{
											if($del == '1' and $actua == '1')
											{
											$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["tm_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["tm_statu"].'">Activo</button>';
											}
											else
											{
											$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["tm_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["tm_statu"].'" disabled>Activo</button>';
											}		
										}
										else
										{
											if($del == '1' and $actua == '1')
											{	
											$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["tm_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["tm_statu"].'">Inactivo</button>';
											}
											else
											{
											$status = '<button type="button" name="delete" title="Cambiar Status del Proveedor" id="'.$Fila2["tm_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["tm_statu"].'" disabled>Inactivo</button>';
											}
										}
										// ==============							
										if($Fila2['tm_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
										{
										$editar = '<button type="button" name="update" title="Editar Tipos" id="'.$Fila2["tm_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
										}
										else
										{
										$editar = '<button type="button" name="update" id="'.$Fila2["tm_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
										}
										//======================================= -->						
											?>								
											<Tr height= '16px'>
												<Td><font size="3px"><?php echo $Fila2['tm_cod']; ?></font></td>
												<Td><font size="3px"><?php echo $Fila2['tm_desc']; ?></font></td>
												<td><?php echo $tipo; ?></td>
												<td><?php echo $actc; ?></td>
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
<!-- ================= -->	

</div>	
<!-- =================================================================================== -->	
    <div id="tipmovModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="tipmov_form">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Tipo de Movimiento</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
					<!-- =============================================================== --> 
					    <div class="row">  
	                        <div class="col-sm-6">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-cogs"></i> Tipo Movimiento</font></label>
									<div class="input-group-prepend">
										<select name="tm_tipo" id="tm_tipo" class="form-control" required> 
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Seleccionar Tipo</option>
											<option value="ENTRADAS">Entradas de Materiales</option>
											<option value="SALIDAS">Salidas de Materiales</option>
										<select>									
									</div>
								</div> 
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-code"></i> Código Movimiento</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="3" name="tm_cod" id="tm_cod" class="form-control" placeholder="Código del Movimiento" required />
									</div>
								</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-file-text"></i> Descripción del Movimiento</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="60" name="tm_desc" id="tm_desc" class="form-control" placeholder="Nombre / Descripción Movimiento" onkeyup="this.value = this.value.toUpperCase();" required />
									</div>
								</div>                                 
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-file-text"></i> Actualiza Costo</font></label>
									<div class="input-group-prepend">
										<select class="form-control"  name="tm_actcost" id="tm_actcost" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<option value="Si">Si Actualiza</option>
											<option value="No">No Actualiza</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="tm_id" id="tm_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<!-- =================================================================================== -->
<!-- =================================================================================== -->	
    <div id="tipmovModalE" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="tipmov_formE">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Tipo de Movimiento</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
					<!-- =============================================================== --> 
					    <div class="row">  
	                        <div class="col-sm-6">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-cogs"></i> Tipo Movimiento</font></label>
									<div class="input-group-prepend">
										<select name="tm_tipo1" id="tm_tipo1" class="form-control" required> 
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Seleccionar Tipo</option>
											<option value="ENTRADAS">Entradas de Materiales</option>
											<option value="SALIDAS">Salidas de Materiales</option>
										<select>									
									</div>
								</div> 
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-code"></i> Código Movimiento</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="3" name="tm_cod1" id="tm_cod1" class="form-control" placeholder="Código del Movimiento" disabled />
									</div>
								</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-file-text"></i> Descripción del Movimiento</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="60" name="tm_desc1" id="tm_desc1" class="form-control" placeholder="Nombre / Descripción Movimiento" onkeyup="this.value = this.value.toUpperCase();" required />
									</div>
								</div>                                 
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label><font color="#606060" FACE="times new roman" size="3px"><i class="fas fa-file-text"></i> Actualiza Costo</font></label>
									<div class="input-group-prepend">
										<select class="form-control"  name="tm_actcost1" id="tm_actcost1" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<option value="Si">Si Actualiza</option>
											<option value="No">No Actualiza</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="tm_id1" id="tm_id1"/>
    					<input type="hidden" name="btn_action1" id="btn_action1"/>
    					<input type="submit" name="action1" id="action1" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$("#tipmov_form").trigger('reset');
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Tipo de Movimiento</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#tipmov_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"tipmov_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#tipmov_form')[0].reset();
				$('#tipmovModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				location.reload();
			}
		})
	});
<!-- ************* -->	
    $(document).on('submit', '#tipmov_formE', function(event){
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"tipmov_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#tipmov_formE')[0].reset();
				$('#tipmovModalE').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
				location.reload();
            }
        })
    });
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var tm_id1 = $(this).attr("id");
		var btn_action1 = 'fetch_single';
		$.ajax({
			url:"tipmov_action.php",
			method:"POST",
			data:{tm_id1:tm_id1, btn_action1:btn_action1},
			dataType:"json",
			success:function(data)
			{
				$('#tipmovModalE').modal('show');
				$('#tm_cod1').val(data.tm_cod1);
				$('#tm_tipo1').val(data.tm_tipo1);
				$('#tm_desc1').val(data.tm_desc1);
				$('#tm_actcost1').val(data.tm_actcost1);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Tipo de Movimiento</b></font>");
				$('#tm_id1').val(tm_id1);
				$('#action1').val('Grabar');
				$('#btn_action1').val("Edit");
			}
		})
	});
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var tm_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Tipo de Movimiento?"))
		{
			$.ajax({
				url:"tipmov_action.php",
				method:"POST",
				data:{tm_id:tm_id, status:status, btn_action:btn_action},
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
<!-- ********************* Lista de Registros ******************************** -->
	$('#tipmov_data').DataTable({
		
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
})
</script>
</form>


				