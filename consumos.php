<?php
//marcas.php

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
</style>
<?php

//---------------------------------------------------------------
echo '<FORM ACTION="" method="GET">';

//-------------
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Consumos</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{ ?>
						<a href="#addnew" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" data-toggle="modal" ><span class="fa fa-plus"></span> Agregar Consumo</a>
						
					<?php	} else { ?>
					
						<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#consumosModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Consumo</button></a>
					<?php	} ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de Consumos</font></b>
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
											<span class="input-group-text"><b>Zona Ubicación:</b></span>
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
								</div>
							</div>							
							<br>
							<?php
							if ($CIA != '' and $ZON != '')
							{ ?>
							<hr>							
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_consumos
								WHERE cia_cons = '$CIA' and zone_cons = '$ZON'
								ORDER BY name_cons ASC ";								
								//---------------------------------------------------------------
								?>						
								<table id="consumos_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1''>
									<thead>
									<tr>
										<th><p>ID</p></th>
										<th><p>Fecha</p></th>
										<th><p>Descripción</p></th>
										<th><p>Status</p></th>
										<th><p>Editar</p></th>
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
									if($Fila2['statu_cons'] == 'Activo')
									{
										if($del == '1' and $actua == '1')
										{
										$status = '<button type="button" name="delete" title="Cambiar Status del Consumo" id="'.$Fila2["id_cons"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu_cons"].'">Activo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Status del Consumo" id="'.$Fila2["id_cons"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu_cons"].'" disabled>Activo</button>';
										}		
									}
									else
									{
										if($del == '1' and $actua == '1')
										{	
										$status = '<button type="button" name="delete" title="Cambiar Status del Consumo" id="'.$Fila2["id_cons"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu_cons"].'">Inactivo</button>';
										}
										else
										{
										$status = '<button type="button" name="delete" title="Cambiar Status del Consumo" id="'.$Fila2["id_cons"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu_cons"].'" disabled>Inactivo</button>';
										}
									}
									// ==============							
									if($Fila2['statu_cons'] == 'Activo' and ($edit == '1') and ($actua == '1'))
									{
										$editar = '<a href="#edit_'.$Fila2["id_cons"].'" title="Editar Consumo" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1" data-toggle="modal" ><span class="fas fa-edit"></span></a>';
										
										include('modal/EditarConsumo.php'); 										
									}
									else
									{
										$editar = '<button type="button" name="update" id="'.$Fila2["id_cons"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';
									}
//<!-- =================================================================================== -->
									?>			
									<Tr height= '16px'>
										<Td><font ><?php echo $Fila2['id_cons']; ?></font></td>
										<Td><font ><?php echo $Fila2['created']; ?></font></td>
										<Td><font ><?php echo $Fila2['name_cons']; ?></font></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $editar; ?></td>
									</tr>
									<?php } mysqli_free_result ($Registro2); ?>
									</tbody>								
								</table>
							<?php }  ?>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </section>
 </div>
 <!-- =================================================================================== -->

<?php include_once("modal/AgregarConsumo.php"); ?>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->

<!-- ************************************************************************* -->
<!-- ********************* Editar el Registro ******************************** -->
<!-- ************************************************************************* -->
<!-- ********************* Lista de Registros ******************************** -->
	$('#consumos_data').DataTable({


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
				"targets":[0,1,4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});
<!-- ************************************************************************* -->
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id_cons = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Consumo?"))
		{
			$.ajax({
				url:"consumos_action.php",
				method:"POST",
				data:{id_cons:id_cons, status:status, btn_action:btn_action},
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
});
</script>


				