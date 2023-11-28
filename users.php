<?php
//users.php

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
 
 <link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
 
</head> 
<style type="text/css">
	
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

.border {
    border: 1px solid #<?=$ccolor;?>;
}
.btn-xs, .btn-group-xs > .btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
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
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
//---------------------------------------------------------------
//---------------------------------------------------------------

//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Usuarios del Sistema</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
						echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"users_2.php?MOP=$MOP \"><i class='fa fa-plus'></i> Agregar Usuario</a>";						
					} else {
					?>
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#usersModal" class="btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1" disabled><i class="fa
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
					<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Usuarios</font></b>
				</div>
				<!-- /.card-header -->
		
				<div class="card-body">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_user_details
								INNER JOIN companies ON companies.id = wh_user_details.company_id";
								//---------------------------------------------------------------
								?>	
								<table id="users_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1" border='1'>
									<thead><tr>
										<th>ID</th>
										<th>Usuario</th>
										<th>Compañia</th>
										<th>Correo</th>
										<th>Status</th>
										<th>Editar</th>
									</tr></thead>
									<tbody>
									<?php
									$Registro2 = mysqli_query($link,$SQL);
									while($Fila2 = mysqli_fetch_array($Registro2))
									{
									$status = '';
									$editar = '';
//<!-- =================================================================================== -->
	if($Fila2['user_statu'] == 'Activo')
	{
		if($del == '1' and $actua == '1')
		{
		$status = '<button type="button" name="delete" title="Cambiar Status del Usuario" id="'.$Fila2["user_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["user_statu"].'">Activo</button>';
		}
		else
		{
		$status = '<button type="button" name="delete" title="Cambiar Status del Usuario" id="'.$Fila2["user_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["user_statu"].'" disabled>Activo</button>';
		}		
	}
	else
	{
		if($del == '1' and $actua == '1')
		{	
		$status = '<button type="button" name="delete" title="Cambiar Status del Usuario" id="'.$Fila2["user_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["user_statu"].'">Inactivo</button>';
		}
		else
		{
		$status = '<button type="button" name="delete" title="Cambiar Status del Usuario" id="'.$Fila2["user_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["user_statu"].'" disabled>Inactivo</button>';
		}
	}
// ==============							
		if($Fila2['user_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
		{
		$editar = '<button type="button" name="update" title="Editar Usuario" id="'.$Fila2["user_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fa fa-edit"></i></button>';
		}
		else
		{
		$editar = '<button type="button" name="update" id="'.$Fila2["user_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fa fa-edit"></i></button>';	
		}
//<!-- =================================================================================== -->	
										?>								
										<Tr height= '16px'>
											<Td><font size="2px"><?php echo $Fila2['user_id']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['first_name'],' ',$Fila2['last_name'] ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['company']; ?></font></td>
											<Td><font size="2px"><?php echo $Fila2['user_email']; ?></font></td>
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
    <!-- /.content -->
 </div>
	<!-- =================================================================================== -->	
    <div id="usersModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="edit_profile_form">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px">Adicionar Usuario</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
					<div class="modal-body">
					
					<?php  include('function.php'); ?>
					
						<div class="form-group">
							<label class="col-sm-12 control-label">Compañia:</label>
							<div class="col-md-6">
								<select name="company_id" id="company_id" class="form-control" required>
									<option value="">Seleccionar Compañia</option>
									<?php echo fill_companies_list($connect); ?>
								</select>
							</div>

								<span class="input-group-addon"><b><font color="#303030">Compañia.:</font></b></span>
								<select class="form-control" name="CIA" id="CIA" onChange="javascrip:form.submit()">
									<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
									<?php
									//---------------------------------------------------------------
									$SQL="Select * FROM companies
									WHERE companies.statu = 'Activo'";
									
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
						<br /><br /><br />
						<div class="form-group">
							<label class="col-sm-6 control-label">Departamento:</label>
							<label class="col-sm-6 control-label">Usuario:</label>
							<div class="col-md-6">
								<select name="department_id" id="department_id" class="form-control" required>
									<option value="">Seleccionar Departamento</option>
									<?php echo fill_departments_list($connect, $_POST['company_id']); ?>
								</select>
							</div>
							<div class="col-lg-6">
								<select name="user_id" id="user_id" class="form-control"  required>
									<option value="">Seleccionar Usuario</option>
								</select>
							</div>							
						</div>
						<br><br><br>
						<div class="form-group">
							<label class="col-sm-6 control-label">Nombre</label>
							<label class="col-sm-6 control-label">Email</label>
							<div class="col-md-6">
								<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Nombre del Usuario" required />
							</div>
							<div class="col-md-6">
								<input type="email" name="user_email" id="user_email" class="form-control" placeholder="Correo del Usuario" required />
							</div>
						</div>	
						<br /><br />
						<hr />
						<label><font color="blue">Deje la contraseña en blanco si no desea cambiar</font></label>
						<br>
						<div class="form-group" align="right">
							<label class="col-sm-3 control-label">Password</label>
							<div class="col-md-3">
								<input type="password" name="user_new_password" id="user_new_password" class="form-control" />
							</div>
						</div>
						<br><br>
						<div class="form-group" align="right">
							<label class="col-sm-3 control-label">Re-enter Password</label>
							<div class="col-md-3">
								<input type="password" name="user_re_enter_password" id="user_re_enter_password" class="form-control" />
								<span id="error_password"></span>	
							</div>							
						</div>
					</div>
					<br />
					<!-- Modal Footer-->
    				<div class="modal-footer" style="background-color:#e6fff2">
    					<input type="hidden" name="user_id" id="user_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<!-- =================================================================================== -->
<script>
$(document).ready(function(){
<!-- ********************* Agregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#edit_profile_form')[0].reset();
		$('#error_password').html('');
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Usuario</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#edit_profile_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"users_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#edit_profile_form')[0].reset();
				$('#usersModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//usersdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"users_action.php",
			method:"POST",
			data:{user_id:user_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#usersModal').modal('show');
				$('#error_password').html('');
				$('#first_name').val(data.first_name);
				$('#user_email').val(data.user_email);
				$('#user_new_password').val('');
				$('#user_re_enter_password').val('');
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Usuario</b></font>");
				$('#user_id').val(user_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* Lista de Registros ******************************** -->
		$('#users_data').DataTable({
		
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
				"targets":[0,5],
				"orderable":false,
			},
		],
		"pageLength": 10
	});
<!-- ************************************************************************* -->
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Usuario?"))
		{
			$.ajax({
				url:"users_action.php",
				method:"POST",
				data:{user_id:user_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					//usersdataTable.ajax.reload();
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
<!-- ************************************************************************* -->
<!-- ************************************************************************* -->
<script>
$(document).ready(function(){
	$('#edit_profile_form').on('submit', function(event){
		event.preventDefault();
		if($('#user_new_password').val() != '')
		{
			if($('#user_new_password').val() != $('#user_re_enter_password').val())
			{
				$('#error_password').html('<label class="text-danger">Password Not Match</label>');
				return false;
			}
			else
			{
				$('#error_password').html('');
			}
		}
	});
});
<!-- ************************************************************************* -->
</script>
<?php
//include('footer.php');
?>



				