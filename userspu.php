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
?>
	<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">	
<style type="text/css">

table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #FFFFFC;
	color: 404040;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}

.w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}
</style>
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

echo '<FORM ACTION="">';

if(isset($_GET["USR"]))$USR = $_GET["USR"];
else $USR = '';
//---------------------------------------------------------------
if(isset($_GET["CT2"]))$CT2 = $_GET["CT2"];
else $CT2 = '0';
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Permisos de Usuarios
					</font></b></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>	
<!-- ======================================================================= -->
    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Permisos de Usuarios: Opciones de Menús</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
<!-- =================================================================================== -->
								<!--<div class="row"> -->
								<div class="col-lg-6">
									<!--<div class="form-group"> -->
										<div class="input-group">
											<span class="input-group-addon"><b><font color="#303030">Usuario del Sistema.:</font></b></span>
											<select class="form-control" name="USR" onChange="javascrip:form.submit()" autofocus>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?php
											//---------------------------------------------------------------
											$SQL="Select * FROM wh_user_details ORDER BY first_name";
											$Registro=mysqli_query($link,$SQL);
											//-------
											while ($Fila=mysqli_fetch_array($Registro)){
											//----
											echo '<option ';
											if($USR == $Fila["user_id"])echo 'selected ';
											echo 'value=' . $Fila["user_id"] .'>' . $Fila["first_name"] . ' ' . $Fila["last_name"] . "\n";
											}
											mysqli_free_result ($Registro);
											//---------------------------------------------------------------
											?>									
											</select>
										</div>
									<!--</div> -->
								</div>
								<br><br>
							</div>	
<!-- =================================================================================== -->
							<?php
							if ($USR != '') 
							{ ?>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-12 table-responsive">
										<!-- <div class="box-body"> -->
										<?php
										//---------------------------------------------------------------
										$SQL = "SELECT * FROM wh_user_menus 
										INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
										INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
										INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
										Where wh_user_menus.user_id = '$USR' and wh_menu_options.menuop_act = '1' ORDER BY wh_menu_groups.menugr_name ASC, wh_menu_options.menuop_desc ASC ";
										//---------------------------------------------------------------
										?>
										<table id="userspu_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1" border='1'>
										<thead>
										<tr>
											<th>ID</th>
											<th>Grupo Menú</th>
											<th>Descripción Opción</th>
											<th>Agregar</th>
											<th>Editar</th>
											<th>C.Status</th>
											<th>Opciones</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$contador = 0;
										$Registro2 = mysqli_query($link,$SQL);
										while($Fila2 = mysqli_fetch_array($Registro2))
										{
										$USRN = $Fila2["first_name"] ."&nbsp;". $Fila2["last_name"];
										$_POST["user_id"] = $USR;
										$_POST["user_name"] = $Fila2["first_name"] ."&nbsp;". $Fila2["last_name"];
										$_POST["user_email"] = $Fila2["user_email"];
										$_POST["menugr_name"] = $Fila2["menugr_name"];
										$_POST["menuop_desc"] = $Fila2["menuop_desc"];		
										$contador++;
										$status = '';
										$editar = '';
//<!-- =================================================================================== -->	
	if($Fila2['usermn_statu'] == 'Activo')
	{
		$status = '<span class="label label-success">Activo</span>';
			
		$editar = '<button type="button" name="update" title="Editar Permisos" id="'.$Fila2["usermn_id"].'"class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true"><i class="fas fa-edit"></i></button>';
	}
	else
	{
		$status = '<span class="label label-danger">Inactivo</span>';
			
		$editar = '<button type="button" name="update" id="'.$Fila2["usermn_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled></i></button>';
	}
//<!-- =================================================================================== -->							
										?>
										<Tr>
										<Td><font size="2px"><?php echo $Fila2['usermn_id']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['menugr_name']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['menuop_desc']; ?></font></td>
										<Td align = "center"><b><font size="2px"><?php echo $Fila2['usermn_add']; ?></font></b></td>
										<Td align = "center"><b><font size="2px"><?php echo $Fila2['usermn_edit']; ?></font></b></td>
										<Td align = "center"><b><font size="2px"><?php echo $Fila2['usermn_del']; ?></font></b></td>
										<td align = "center"><?php echo $editar; ?></td>
<!-- =================================================================================== -->		
										</tr>
										<?php } mysqli_free_result ($Registro2); ?>
										</tbody>
										</table>
									</div>
								</div>						
							</div>
<!-- =================================================================================== -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php } mysqli_close($link); ?>
</FORM>			
<!-- =================================================================================== -->	
<div id="userspuModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">>
	<div class="modal-dialog modal-lg">
		<form method="post" id="userspu_form">
			<div class="modal-content w3-animate-zoom">
				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
					<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"> Adicionar Puntos de Menú</font></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
				<!-- =============================================================== -->
					<div class="col-md-12">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<span class="input-group-text"><font color="blue"><b>Nombre del Usuario</b></font></span>
									<div class="col-md-12">
										<b><input type="text" name="user_name" id="user_name" value="<?Php echo $_POST["user_name"]?>" class="form-control" readonly /></b>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<span class="input-group-text"><font color="blue"><b>Email del Usuario</b></font></span>
									<div class="col-md-12">
										<b><input type="email" name="user_email" id="user_email" value="<?Php echo $_POST["user_email"]?>" class="form-control" readonly /></b>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="input-group-text"><font color="blue"><b>Grupo de Opción</b></font></span>
									<div class="col-md-12">
										<b><input type="text" name="menugr_name" id="menugr_name" value="<?Php echo $_POST["menugr_name"]?>" class="form-control" readonly /></b>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="input-group-text"><font color="blue"><b>Descripción Opción</b></font></span>
									<div class="col-md-12">
										<b><input type="email" name="menuop_desc" id="menuop_desc" value="<?Php echo $_POST["menuop_desc"]?>" class="form-control" readonly /></b>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" align="center">
									<label><font color="black">Permisos del Usuario</font></label>
								</div>
							</div>
						</div>								
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">						
									<span class="input-group-text"><b>Agregar Registros:</b></span>
									<select name="usermn_add" id="usermn_add" class="form-control" required>
										<option value="1">Activado</option>
										<option value="0">No-Activo</option>
									</select>
								</div>
							</div>						
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-text"><b>Editar Registros....:</b></span>
									<select name="usermn_edit" id="usermn_edit" class="form-control" required>
										<option value="1">Activado</option>
										<option value="0">No-Activo</option>
									</select>
								</div>
							</div>						
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-text"><b>Cambiar Status......:</b></span>
									<select name="usermn_del" id="usermn_del" class="form-control" required>
										<option value="1">Activado</option>
										<option value="0">No-Activo</option>
									</select>
								</div>
							</div>						
						</div>
					</div>
				</div>
				<br />
				<div class="modal-footer" style="background-color:#FFFFFC">
					<input type="hidden" name="usermn_id" id="usermn_id"/>
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
<!-- ********************* Egregar Registro ******************************** -->

<!-- ************************************************************************* -->
	$(document).on('submit','#userspu_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"userspu_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#userspu_form')[0].reset();
				$('#userspuModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				location.reload();
			}
		})
	});
<!-- ********************* Lista para Opciones de menú *********************** -->

<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var usermn_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"userspu_action.php",
			method:"POST",
			data:{usermn_id:usermn_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#userspuModal').modal('show');
				$('#user_name').val(data.user_name);
				$('#user_email').val(data.user_email);
				$('#menugr_name').val(data.menugr_name);
				$('#menuop_desc').val(data.menuop_desc);
				$('#usermn_add').val(data.usermn_add);
				$('#usermn_edit').val(data.usermn_edit);
				$('#usermn_del').val(data.usermn_del);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Permisos</b></font>");
				$('#usermn_id').val(usermn_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ************************************************************************* -->	
    $('#userspu_data').DataTable({
		
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
				"targets":[0, 2, 3, 4, 5, 6],
				"orderable":false,
			},
		],
		"pageLength": 10
    });	
<!-- ******
});
<!-- ************************************************************************* -->
</script>
