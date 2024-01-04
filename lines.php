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

<?php
echo '<FORM ACTION="" method="GET">';

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["typel"]))$typel = $_GET["typel"];
else $typel = '';
//-------------
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
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">
<Input Type="hidden" name="typel" value="<?Php echo $typel ?>" />

<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
		
			<span id="result"></span>
			
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Lineas</font></h2>
				</div>
				<span id='alert_action'></span>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a href="#addnew" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Agregar Linea</a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#linesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Linea</button></a>
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
							<font color="#FFFFFF" size="5px">Lista de Lineas</font>
						</div>
						  <!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_lines where typel = 'LIN'";
								//---------------------------------------------------------------
								?>
								<table id="lines_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
								  <thead class="text-dark">
									<tr>
									<th>ID</th>
									<th>Descripción</th>
									<th>Prefijo Cod SAP</th>
									<th>Tipo</th>
									<th>Consecutivo</th>
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
									if($Fila2['statu'] == 'Activo')
									{
										if($del == '1' and $actua == '1')
										{
										$status = '<b><font color=green size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Linea" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'">Activo</button></a><font></b>';
										}
										else
										{
										$status = '<b><font color=green size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Linea" id="'.$Fila2["id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Activo</button></a><font></b>';
										}		
									}
									else
									{
										if($del == '1' and $actua == '1')
										{	
										$status = '<b><font color=red size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Linea" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'">Inactivo</button></a><font></b>';
										}
										else
										{
										$status = '<b><font color=red size="3px"><a<button type="button" name="delete" title="Cambiar Status de la Linea" id="'.$Fila2["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["statu"].'" disabled>Inactivo</button></a><font></b>';
										}
									}
									// ==============							
									if($Fila2['statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
									{
									$accion = '<a href="#edit_'.$Fila2["id"].'" title="Editar Lìnea" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1" data-toggle="modal" ><span class="fas fa-edit"></span></a>';
									
									include('modal/EditarLinea.php'); 
									}
									else
									{
									$accion = '<button type="button"  class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
									}
				//<!-- =================================================================================== -->	
									?>								
									<Tr height= '16px'>
										<Td><?php echo $Fila2['id']; ?></font></td>
										<Td><?php echo $Fila2['namel'];?></font></td>
										<Td><?php echo $Fila2['acronym'];?></font></td>
										<Td><?php echo $Fila2['typel'];?></font></td>
										<Td><?php echo $Fila2['cont_cod'];?></font></td>
										<td align="center"><?php echo $status; ?></td>
										<td align="center"><?php echo $accion; ?></td>
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
<?php include_once("modal/AgregarLinea.php"); ?>
<script>
$(document).ready(function(){
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la Linea?"))
		{
			$.ajax({
				url:"lines_action.php",
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
	//var linesdataTable = $('#lines_data').DataTable({
	$('#lines_data').DataTable({
		
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
		"pageLength": 20
	});
<!-- ************************************************************************* -->
});
</script>

 <?php
 //include('footer.php');
?>



			