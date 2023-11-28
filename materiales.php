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
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
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
$SQL = "SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">
<Input Type="hidden" name="EDO" value="<?Php echo $EDO ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Materiales</font></h2>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1' and $CIA != '' and $ZON !='' and $LIN != '')
					{
						echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"materiales2.php?CIA=$CIA&ZON=$ZON&LIN=$LIN \"><i class='fa fa-plus'></i> Agregar Material</a>";
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
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia.:</b></span>
											<select class="form-control" name="CIA" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select uz.*, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo' 
												GROUP BY uz.uzcompany_id
												";
												//---------------------------------------------------------------
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
									</div>				
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Almacén / Zona.:</b></span>
											<select class="form-control" name="ZON" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar la Ubicación</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_user_zones 
												INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIA' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
												ORDER BY wh_zones.zone_desc";								
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												$UBIC = $Fila["zone_desc"] ."&nbsp;&nbsp; / &nbsp;&nbsp;". $Fila["zone_ubic"];
												//----
												echo '<option ';
												if($ZON == $Fila["zone_id"])echo 'selected ';
												echo 'value=' . $Fila["zone_id"] .'>'. $UBIC . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
									</div>			  
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Línea del Material.:</b></span>
											<select class="form-control" name="LIN" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar Línea</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_lines  
												WHERE statu = 'Activo'
												ORDER BY acronym ASC";								
												
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
							if ($CIA != '' and $ZON != '' and $LIN != '')
							{ ?>
							<hr class="elevation-2" color="#CCCCCC" >						
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT mat.*, mat.id AS idmat, mmat.*, mmat.id AS idmmat, um.id AS umid, um.name, cat.cat_id, cat.category FROM wh_materials mat
								INNER JOIN wh_master_materials mmat ON mmat.code = mat.code
								INNER JOIN wh_categories cat ON cat.cat_id = mat.wh_category_id_m
								INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
								WHERE mat.zone_id = '$ZON' and mat.wh_line_id_m = '$LIN' and mat.company_id = '$CIA'
								ORDER BY mat.code DESC
								";
								//---------------------------------------------------------------
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
if($Fila2['m_statu_m'] == 'Activo')
{
	if($del == '1' and $actua == '1')
	{
	$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["idmat"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["m_statu_m"].'">Activo</button></a><font></b>';
	}
	else
	{
	$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["idmat"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["m_statu_m"].'" disabled>Activo</button></a><font></b>';
	}		
}
else
{
	if($del == '1' and $actua == '1')
	{	
	$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["idmat"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["m_statu_m"].'">Inactivo</button></a><font></b>';
	}
	else
	{
	$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status del Material" id="'.$Fila2["idmat"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["m_statu_m"].'" disabled>Inactivo</button></a><font></b>';
	}
}
// ==============							

if($Fila2['m_statu_m'] == 'Activo' and ($edit == '1') and ($actua == '1'))
{
$accion = '<ul class="navbar-nav ml-auto">
<li class="dropdown btn-group">
<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>

<ul class="dropdown-menu dropdown-menu-right">
	
	<li><a href="materiales3.php?IDX='.$Fila2['idmat'].'&CIA='.$CIA.'&ZON='.$ZON.' "><i class="fa fa-edit"></i> Editar Material</a></li>

	<li role="presentation" class="divider"></li>

	<li><a <button type="button" name="view" id="'.$Fila2['idmat'].'" class="view"><i class="fa fa-list"></i> Detalle del Material</button></a></li>
				
</ul></li></ul>';
}
else
{
$accion = '<ul class="nav navbar-nav">
<li class="dropdown btn-group">
<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

<ul class="dropdown-menu dropdown-menu-right">
	
	<li class="disabled"><a href="materiales3.php?IDX='.$Fila2['idmat'].' "><i class="fa fa-edit"></i> Editar Material</a></li>

	<li role="presentation" class="divider"></li>

	<li><a <button type="button" name="view" id="'.$Fila2['idmat'].'" class="view"><i class="fa fa-list"></i> Detalle del Material</button></a></li>
				
</ul></li></ul>';	
}

//echo "<pre>"; print_r($Fila2['idmat']); exit();
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
<!-- =================================================================================== -->

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
						<label><font color="#660000" size="4px">Ubicación.:  </font></label>
						&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $DCIA ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZOND; ?></font></span>
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
		var idmat = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Material.?"))
		{
			$.ajax({
				url:"materiales_action.php",
				method:"POST",
				data:{idmat:idmat, status:status, btn_action:btn_action},
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
        var idmat = $(this).attr("id");
        var btn_action = 'materials_details';
        $.ajax({
            url:"materiales_action.php",
            method:"POST",
            data:{idmat:idmat, btn_action:btn_action},
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



			