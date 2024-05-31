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
include('unico_1.php');
//===============================
?>
	
	<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">

<style>
	
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
//---------------------------------------------------------------
echo '<FORM ACTION="">';

if(isset($_GET["USR"]))$USR = $_GET["USR"];
else $USR = '';
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_user_menus 
INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
Where wh_user_menus.user_id = '$userid' and wh_user_menus.menuop_id = '$MOP' ";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$add = $Fila1["usermn_add"];
$edit = $Fila1["usermn_edit"];
$del = $Fila1["usermn_del"];
$actua = $Fila1["menuop_act"];
} 
mysqli_free_result ($Registro1);
//---------------------------------------------------------------

?>

<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="USR" value="<?Php echo $USR ?>">

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Opciones de Menú
					</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php if($USR !='') { ?>
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userspmModal" class="btn btn-outline-<?php echo $classButtonHeader; ?>"><i class="fa fa-plus"></i> Agregar Opción</button> 
					<?php } else { ?>
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userspmModal"  class="btn btn-outline-<?php echo $classButtonHeader; ?>" disabled><i class="fa fa-plus"></i> Agregar Opción</button>
					<?php } ?>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Opciones de Menú: Usuarios del Sistema</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
<!-- =================================================================================== -->
								<div class="col-lg-6">
									<!--<div class="form-group"> -->
										<div class="input-group">
											<span class="input-group-text"><b><font color="#303030">Usuario del Sistema.:</font></b></span>
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
										<?php
										//---------------------------------------------------------------
										//---------------------------------------------------------------
										$SQLN = "SELECT first_name, last_name FROM wh_user_details Where user_id = '$USR' ";
										
										$RegistroN = mysqli_query($link,$SQLN);
										while($FilaN = mysqli_fetch_array($RegistroN))
										{
										$USRN2 = $FilaN["first_name"] ."&nbsp;". $FilaN["last_name"];
										} 
										mysqli_free_result ($RegistroN);
										//---------------------------------------------------------------
										//---------------------------------------------------------------
										$SQL = "SELECT * FROM wh_user_details 
										INNER JOIN wh_user_menus ON wh_user_menus.user_id = wh_user_details.user_id
										INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
										INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
										WHERE wh_user_details.user_id = '$USR' 
										ORDER BY wh_menu_groups.menugr_name ASC";
										//--------------------------------------------------------------- 
										?>
										<table id="userspm_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1" border='1'>
										<thead>
										<tr>
											<th>ID</th>
											<th>Grupo Menú</th>
											<th>Descripción Opción</th>
											<th>Status</th>
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
										$_POST["first_name"] = $Fila2["first_name"];
										$_POST["user_email"] = $Fila2["user_email"];
												
										$contador++;
										$status = '';
										$editar = '';
//<!-- =================================================================================== -->	
	if($Fila2['usermn_statu'] == 'Activo')
	{
		if($del == '1' and $actua == '1')
		{
		$status = '<button type="button" name="delete" title="Cambiar Status opción de menú" id="'.$Fila2["usermn_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["usermn_statu"].'">Activo</button>';
		}
		else
		{
		$status = '<button type="button" name="delete" id="'.$Fila2["usermn_id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["usermn_statu"].'" disabled>Activo</button>';
		}		
	} else {
		if($del == '1' and $actua == '1')
		{	
		$status = '<button type="button" name="delete" title="Cambiar Status Opción de Menú" id="'.$Fila2["usermn_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["usermn_statu"].'">Inactivo</button>';
		} else {
		$status = '<button type="button" name="delete" id="'.$Fila2["usermn_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["usermn_statu"].'" disabled>Inactivo</button>';
		}
	}
//<!-- =================================================================================== -->								
										?>
										<Tr height= '16px'>
										<Td><font size="2px"><?php echo $Fila2['usermn_id']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['menugr_name']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['menuop_desc']; ?></font></td>
										<td><?php echo $status; ?></td>
										</tr>
										<?php } mysqli_free_result ($Registro2); ?>
										</tbody>
										</table>
									</div>
								</div>						
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</section>	
</div>
</FORM>			
<!-- =================================================================================== -->	
			<div id="userspmModal" class="modal fade">
				<div class="modal-dialog modal-md">
					<form method="post" id="userspm_form">
						<div class="modal-content w3-animate-zoom">
							<div class="modal-header" style="background-color:#<?=$ccolor;?>">
								<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"> Adicionar Puntos de Menú</font></h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
							
								<?php include ('function.php'); ?>
								
								<Input Type="hidden" name="user_id" value="<?Php echo $USR; ?>">
																
								<div class="form-group">
									<label>Usuario de Sistema:</label>
									<input type="text" name="user_name" id="user_name" value="<?Php echo $USRN2; ?>" class="form-control" readonly />
								</div>
								<div class="form-group">
									<label>Grupo de Menú:</label>
									<select name="menugr_id" id="menugr_id" class="form-control" required>
										<option value="">Seleccionar Grupo</option>
										<?php echo fill_menugr_list($connect); ?>
									</select>
								</div>
								<div class="form-group">
									<label>Opciones de Menú:</label>
									<select name="menuop_id" id="menuop_id" class="form-control" required>
										<option value="">Seleccionar opción de menú</option>
									</select>
								</div>
							</div>

							<div class="modal-footer" style="background-color:FFFFFC">
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
	$('#add_button').click(function(){
		$('#userspm_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Puntos de Menú</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});	
<!-- ************************************************************************* -->
	$(document).on('submit','#userspm_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"userspm_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#userspm_form')[0].reset();
				$('#userspmModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//usersdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Lista para Opciones de menú *********************** -->
    $('#menugr_id').change(function(){
        var menugr_id = $('#menugr_id').val();
        var btn_action = 'load_opciones';
        $.ajax({
            url:"userspm_action.php",
            method:"POST",
            data:{menugr_id:menugr_id, btn_action:btn_action},
            success:function(data)
            {
                $('#menuop_id').html(data);
            }
        });
    });
<!-- ********************* Editar el Registro ******************************** -->

<!-- ************************************************************************* -->	
    $('#userspm_data').DataTable({
		
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
				"targets":[0, 2, 3],
				"orderable":false,
			},
		],
		"pageLength": 10
    });	
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var usermn_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Opción del Usuario?"))
		{
			$.ajax({
				url:"userspm_action.php",
				method:"POST",
				data:{usermn_id:usermn_id, status:status, btn_action:btn_action},
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

<!-- ******
});
<!-- ************************************************************************* -->
</script>
