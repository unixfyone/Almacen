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
if(isset($_GET["CT2"]))$CT2 = $_GET["CT2"];
else $CT2 = '0';
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Zonas Almacenes</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{ ?>
						<a href="#addnew" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" data-toggle="modal" ><span class="fa fa-plus"></span> Agregar Zona</a>
						<?php
					} else {
					?>
						<a href="#" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" data-toggle="modal" disabled ><span class="fa fa-plus"></span> Agregar Zona</a>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Zonas</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia:</b></span>
											<select class="form-control" name="CIA" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select zn.*, uz.*, co.id, co.company FROM wh_zones zn
												INNER JOIN companies co ON co.id = zn.zcompany_id
												INNER JOIN wh_user_zones uz ON uz.uzcompany_id = zn.zcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo'
												GROUP BY zn.zcompany_id
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
								</div>
							</div>
							<br>
	  
							<div class="panel-body">
							<?php
							if ($CIA != '')
							{	
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_zones
							INNER JOIN companies ON companies.id = wh_zones.zcompany_id
							WHERE wh_zones.zcompany_id = '$CIA'
							";
							//---------------------------------------------------------------
							} else {
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_zones
							INNER JOIN companies ON companies.id = wh_zones.zcompany_id
							";
							//---------------------------------------------------------------								
							}	
							?>	
                    		<table id="zonas_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" border='1'>
                    			<thead>
								<tr>
									<th>Código</th>
									<th>Compañia</th>
									<th>Prefijo</th>
									<th>Descripción</th>
									<th>Ubicación</th>
									<th>Dirección</th>
									<th>EM</th>
									<th>SM</th>
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
//<!-- =================================================================================== -->	
	if($Fila2['zone_statu'] == 'Activo')
	{
		if($del == '1' and $actua == '1')
		{
		$status = '<button type="button" name="delete" title="Cambiar Status de la Zona de Ubicación" id="'.$Fila2["zone_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["zone_statu"].'">Activo</button>';
		}
		else
		{
		$status = '<button type="button" name="delete" title="Cambiar Status de la Zona de Ubicación" id="'.$Fila2["zone_id"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["zone_statu"].'" disabled>Activo</button>';
		}
	}
	else
	{
		if($del == '1' and $actua == '1')
		{	
		$status = '<button type="button" name="delete" title="Cambiar Status de la Zona de Ubicación" id="'.$Fila2["zone_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["zone_statu"].'">Inactivo</button>';
		}
		else
		{
		$status = '<button type="button" name="delete" title="Cambiar Status de la Zona de Ubicación" id="'.$Fila2["zone_id"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["zone_statu"].'" disabled>Inactivo</button>';
		}
	}
//<!-- =================================================================================== -->
	if($Fila2['zone_statu'] == 'Activo')
	{
		if($edit == '1' and $actua == '1')
		{
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>
		
		<ul class="dropdown-menu dropdown-menu-right">

			<li><a href="#edit_'.$Fila2["zone_id"].'" class="update" data-toggle="modal" ><i class="fa fa-edit"></i> Editar Zona</a></li>
		
			<li role="presentation" class="divider"></li>
			
			<li><a href="users1_zu.php?zu_id='.$Fila2['zone_id'].' "><i class="fa fa-list"></i> Usuarios por Zona</a></li>		
		</ul></li></ul>';

		include('modal/EditarZona.php');
		
		}
		else
		{
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>
		
		<ul class="dropdown-menu dropdown-menu-right">
		
			<li class="disabled"><a <button type="button" name="update" class="update"><i class="fa fa-edit"></i> Editar Zona</button></a></li>
			
			<li role="presentation" class="divider"></li>
			<li><a href="users1_zu.php?zu_id='.$Fila2['zone_id'].'"><i class="fa fa-list"></i> Usuarios por Zona</a></li>			
		
		</ul></li></ul>';			
		}
	}
	else
	{
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs" data-toggle="dropdown" aria-expanded="false" disabled><i class="fa fa-cog"></i> <span class="caret"></span></button>
		
		</li></ul>';
	}
//<!-- =================================================================================== -->	
									?>								
									<Tr height= '16px'>
										<Td><font size="2px"><?php echo $Fila2['zone_id']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['company']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['zone_prefix']; ?></font></td>
										<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['zone_desc']; ?></font><span></td>
										<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['zone_ubic']; ?></font><span></td>
										<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['zone_direc']; ?></font><span></td>
										<Td><font size="2px"><?php echo $Fila2['zone_doc_em']; ?></font></td>
										<Td><font size="2px"><?php echo $Fila2['zone_doc_sm']; ?></font></td>
										<td><?php echo $status; ?></td>
										<td align="center"><?php echo $accion; ?></td>
									</tr>
									<?php } mysqli_free_result ($Registro2); ?>
								</tbody>								
                    		</table>
							</div>
							<?php //} ?>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
	<!-- =================================================================================== -->
<?php include_once("modal/AgregarZona.php"); ?>
<script>
$(document).ready(function(){

<!-- ********************* Lista de Registros ******************************** -->
	$('#zonas_data').DataTable({
		
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
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var zone_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Zona de Ubicación ..?"))
		{
			$.ajax({
				url:"zonas_action.php",
				method:"POST",
				data:{zone_id:zone_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					//almacendataTable.ajax.reload();
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


				