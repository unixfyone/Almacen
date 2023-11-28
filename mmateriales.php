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
.border {
    border: 1px solid #<?=$ccolor;?>;
}
.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #<?=$ccolor;?>;
    border-color: #<?=$ccolor2;?>;
}
.btn-prima:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
    border-color: #<?=$ccolor;?>;
}
.butt-mesas {
	background: transparent;
	-moz-border-radius: 4;
	border-radius: 4px;
	border: solid #<?=$ccolor;?> 1px;
	font-family: Arial;
	color: #909090;
	font-size: 15px;
	line-height: 18px;
	text-align: center;
	width: 42px;
	height: 25px;
	border-color: #<?=$ccolor;?>;
}
.dropdown-menu > li > a:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
}
</style>

<?php

//---------------------------------------------------------------
echo '<FORM ACTION="" method="GET">';

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//---------------------------------------------------------------
if(isset($_GET["CT2"]))$CT2 = $_GET["CT2"];
else $CT2 = '0';
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
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
<Input Type="hidden" name="EDO" value="<?Php echo $EDO ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><font color="#<?=$ccolor;?>" >Maestro de Materiales</font></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1' and $LIN != '')
					{
						echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"mmateriales2.php?LIN=$LIN \"><i class='fa fa-plus'></i> Agregar Material</a>";
					} else {
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#materialsModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled /><i class='fa fa-plus'></i> Agregar Material</button></a>
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
							<font color="#FFFFFF" size="5px">Lista de Materiales</font>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-5">
										<div class="input-group">
											<span class="input-group-text"><b>Línea:</b></span>
											<select class="form-control" name="LIN" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Seleccionar Línea</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_lines WHERE statu = 'Activo' ORDER BY acronym ASC";
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												$LIND = $Fila["acronym"] ."&nbsp;&nbsp; / &nbsp;&nbsp;". $Fila["namel"];
												//----
												echo '<option ';
												if($LIN == $Fila["id"])echo 'selected ';
												echo 'value=' . $Fila["id"] .'>'. $LIND . "\n";
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
							if ($LIN != '')
							{ ?>
							<hr class="elevation-2" color="#CCCCCC" >		
							<div class="panel-body">
								<?php
								
								//---------------------------------------------------------------
								$SQL = "SELECT mat.*, um.id AS umid, um.name, cat.cat_id, cat.category FROM wh_master_materials mat
								INNER JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id
								INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id
								WHERE mat.wh_line_id = '$LIN' 
								ORDER BY mat.code DESC
								";
								//---------------------------------------------------------------
								$query = "SELECT * FROM wh_lines
								Where id = '$LIN' ";
								$RegistroA = mysqli_query($link,$query);
								while($row = mysqli_fetch_array($RegistroA))
								{
								$LID = $row["id"];
								$acronym = $row["acronym"];
								$namel = $row["namel"];
								}
								$LIND2 = $acronym ."&nbsp;&nbsp; / &nbsp;&nbsp;". $namel;
								mysqli_free_result ($RegistroA);
								?>
								
								<table id="materials_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
								  <thead>
								  <tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Categoria</th>
									<th>Uni-Med</th>
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
									$btnVer = '';
//<!-- =================================================================================== -->
if($Fila2['m_statu'] == 'Activo')
{
	if($del == '1' and $actua == '1')
	{
	$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["m_statu"].'">Activo</button></a><font></b>';
	}
	else
	{
	$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["m_statu"].'" disabled>Activo</button></a><font></b>';
	}		
}
else
{
	if($del == '1' and $actua == '1')
	{	
	$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["m_statu"].'">Inactivo</button></a><font></b>';
	}
	else
	{
	$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["m_statu"].'" disabled>Inactivo</button></a><font></b>';
	}
}
// ==============							

if($Fila2['m_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
{
$accion = '<ul class="navbar-nav ml-auto">
<li class="dropdown btn-group">
<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>

<ul class="dropdown-menu dropdown-menu-right">
	
	<li><a href="mmateriales3.php?IDX='.$Fila2['id'].' "><i class="fa fa-edit"></i> Editar Material</a></li>

	<li role="presentation" class="divider"></li>

	<li><a <button type="button" name="view" id="'.$Fila2['id'].'" class="view"><i class="fa fa-list"></i> Detalle del Material</button></a></li>
				
</ul></li></ul>';
}
else
{
$accion = '<ul class="nav navbar-nav">
<li class="dropdown btn-group">
<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

<ul class="dropdown-menu dropdown-menu-right">
	
	<li class="disabled"><a href="mmateriales3.php?IDX='.$Fila2['id'].' "><i class="fa fa-edit"></i> Editar Material</a></li>

	<li role="presentation" class="divider"></li>

	<li><a <button type="button" name="view" id="'.$Fila2['id'].'" class="view"><i class="fa fa-list"></i> Detalle del Material</button></a></li>
				
</ul></li></ul>';	
}

//<!-- =================================================================================== -->	
								?>								
									<Tr height= '16px'>
									<Td><font size="2px"><?php echo $Fila2['code']; ?></font></td>
									<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['description']; ?></font></span></td>
									<Td><font size="2px"><?php echo $Fila2['category'];?></font></td>
									<Td><font size="2px"><?php echo $Fila2['name'];?></font></td>
									<td align="center"><?php echo $status; ?></td>
									<td><?php echo $accion; ?></td>
									</tr>
									<?php } mysqli_free_result ($Registro2); ?>
									</tbody>
								</table>
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
</form>
<!-- =================================================================================== -->
<div id="materialsdetailsModal" class="modal fade">
	<div class="modal-dialog modal-xl">
		<form method="post" id="materials_form">
			<div class="modal-content  w3-animate-zoom">
				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
					<h4 class="modal-title">Detalle del Material</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label><font color="#660000" size="4px">Línea del Material.:  </font></label>
						&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $LIND2; ?></font></span>
					</div>

					<Div id="materials_details"></Div>
					
				</div>
				<div class="modal-footer" style="background-color:#FFFFFC">
					<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- =================================================================================== -->
 <!-- /.content-wrapper -->
 <?php
 //include('footer.php');
?>

<script>
$(document).ready(function(){
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Material.?"))
		{
			$.ajax({
				url:"mmateriales_action.php",
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
            url:"mmateriales_action.php",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data){
                $('#materialsdetailsModal').modal('show');
				$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Detalle del Material</b></font>");
				
                $('#materials_details').html(data);
            }
        })
	});

<!-- ************************************************************************* -->
})
</script>



			