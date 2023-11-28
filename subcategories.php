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
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
 
</head> 

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
<style>

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
					<h1 class="m-0"><b><font color="<?=$ccolor;?>" FACE="times new roman" size="5px">SubCategorias</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $actua == '1')
					{
					?>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#scategoriesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1">Agregar SubCategorias</button></a>
					<?php	 
					} else {
					?>
					<a>
					<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#scategoriesModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar SubCategorias</button></a>
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
				<b><font color="#FFFFFF" FACE="times new roman" size="4px">Lista de SubCategorias</font></b>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<?php
				//---------------------------------------------------------------
				$SQL = "SELECT * FROM wh_subcategories
				INNER JOIN wh_categories ON wh_categories.cat_id = wh_subcategories.wh_category_id 
				where wh_categories.cat_statu = 'Activo' ";
				//---------------------------------------------------------------
				?>
                <table id="scategories_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
                  <thead>
                  <tr>
					<th>ID</th>
					<th>Fecha</th>
					<th>Categoria</th>
					<th>Descripción SubCategoria</th>
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
					if($Fila2['scat_statu'] == 'Activo')
					{
						if($del == '1' and $actua == '1')
						{
						$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status de la SubCategoria" id="'.$Fila2["scat_id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["scat_statu"].'">Activo</button></a><font></b>';
						}
						else 
						{
						$status = '<b><font color=green size="2px"><a<button type="button" name="delete" title="Cambiar Status de la SubCategoria" id="'.$Fila2["scat_id"].'" class="btn btn-success btn-xs delete" data-status="'.$Fila2["scat_statu"].'" disabled>Activo</button></a><font></b>';
						}		
					}
					else
					{
						if($del == '1' and $actua == '1')
						{	
						$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status de la SubCategoria" id="'.$Fila2["scat_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["scat_statu"].'">Inactivo</button></a><font></b>';
						}
						else
						{
						$status = '<b><font color=red size="2px"><a<button type="button" name="delete" title="Cambiar Status de la SubCategoria" id="'.$Fila2["scat_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$Fila2["scat_statu"].'" disabled>Inactivo</button></a><font></b>';
						}
					}
					// ==============							

					if($Fila2['scat_statu'] == 'Activo' and ($edit == '1') and ($actua == '1'))
					{
					$accion = '<button type="button" name="update" title="Editar SubCategoria" id="'.$Fila2["scat_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update"  aria-pressed="true"><i class="fas fa-edit"></i></button>';
					}
					else
					{
					$accion = '<button type="button" name="update" id="'.$Fila2["scat_id"].'" class="btn btn-outline-light text-dark border border-dark btn-xs mr-1 ml-1 mt-1 mb-1 update" aria-pressed="true" disabled><i class="fas fa-edit"></i></button>';	
					}

//<!-- =================================================================================== -->	
					?>								
					<Tr height= '16px'>
						<Td><font size="2px"><?php echo $Fila2['scat_id']; ?></font></td>
						<Td><font size="2px"><?php echo $Fila2['created'];?></font></td>
						<Td><font size="2px"><?php echo $Fila2['category'];?></font></td>
						<Td><font size="2px"><?php echo $Fila2['subcategory'];?></font></td>
						<td align="center"><?php echo $status; ?></td>
						<td><?php echo $accion; ?></td>
					</tr>
					<?php } mysqli_free_result ($Registro2); ?>
				</tbody>
		
				</table>
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
 
     <div id="scategoriesModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="scategories_form">
    			<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
    					
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Adicionar Sub Categoria</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label><font color="#303030" FACE="times new roman" size="3px">Categoria</font></label>
											<select name="wh_category_id" id="wh_category_id" class="form-control" required>
												<option value="">Seleccionar la Categoria</option>
												<?php include 'function.php'; echo fill_categories_list($connect); ?>
											</select>
										</div>
									</div>                        
									<div class="col-sm-8">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px">Descripción de la SubCategoria</font></label>
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-object-ungroup"></i></span>
													<input type="text" name="subcategory" id="subcategory" maxlength="100" class="form-control" required />
											</div>
										</div>                                 
									</div>
								</div>
							</div>
						</div>					
					</div>
					<br>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="scat_id" id="scat_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><i class="fa fa-right-from-bracket "></i>Cerrar</button>	
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
 
 <!-- /.content-wrapper -->

<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#scategories_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar SubCategoria</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#scategories_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"subcategories_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#scategories_form')[0].reset();
				$('#scategoriesModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//groupsdataTable.ajax.reload();
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var scat_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"subcategories_action.php",
			method:"POST",
			data:{scat_id:scat_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#scategoriesModal').modal('show');
				$('#wh_category_id').val(data.wh_category_id);
				$('#subcategory').val(data.subcategory);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar SubCategoria</b></font>");
				$('#scat_id').val(scat_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var scat_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status de la SubCategoria?"))
		{
			$.ajax({
				url:"subcategories_action.php",
				method:"POST",
				data:{scat_id:scat_id, status:status, btn_action:btn_action},
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
	$('#scategories_data').DataTable({
		
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
		"pageLength": 10
	});
<!-- ************************************************************************* -->
})
</script>
 <?php
 //include('footer.php');
?>
</html>



			