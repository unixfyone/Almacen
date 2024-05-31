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

.navbar-nav .open .dropdown-menu {
    position: static;
    float: none;
    width: auto;
    margin-top: 0;
    background-color: transparent;
    border: 0;
    box-shadow: none;
}
.navbar-nav .open .dropdown-menu > li > a {
    line-height: 20px;
}
.navbar-nav .open .dropdown-menu > li > a, .navbar-nav .open .dropdown-menu .dropdown-header {
    padding: 5px 15px 5px 25px;
}
.dropdown-menu > li > a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333333;
    white-space: nowrap;
}
.dropdown-menu > li > a:hover {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
}
.dropdown-menu > .disabled > a,
.dropdown-menu > .disabled > a:hover,
.dropdown-menu > .disabled > a:focus {
  color: #999999;
}
.dropdown-menu > .disabled > a:hover,
.dropdown-menu > .disabled > a:focus {
  text-decoration: none;
  background-color: transparent;
  background-image: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  cursor: not-allowed;
}
.dropdown-menu .divider {
    height: 1px;
    margin: 9px 0;
    overflow: hidden;
    background-color: #e5e5e5;
.navbar-nav > li > .dropdown-menu {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
}
.open > .dropdown-menu {
    display: block;
}
.dropdown-menu-right {
    left: auto;
    right: 0;
}
.dropdown-menu {
    top: 100%;
    left: 0;
    z-index: 1000;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    font-size: 14px;
    text-align: left;
    border-radius: 4px;
    background-clip: padding-box;
}
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus {
  text-decoration: none;
  color: #ffffff;
  background-color: #2fa4e7;
}
</style>

<?php

echo '<FORM ACTION="">';

echo $USR = '';

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
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
$SQL = "SELECT * FROM wh_zones Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
$CIAX = $FilaA["zcompany_id"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP; ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON; ?>">

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
					if($add == '1' and $actua == '1' and $ZON !='')
					{
					?>
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userzuModal" class="btn btn-outline-<?php echo $classButtonHeader; ?>"><i class="fa fa-plus"></i> Nuevo Usuario</button> 
					<?php	 
					} else {
					?>
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userzuModal" class="btn btn-outline-<?php echo $classButtonHeader; ?>" disabled><i class="fa fa-plus"></i> Nuevo Usuario</button>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Usuarios por Zonas</font></b>
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
												$SQL="Select zn.*, co.id, co.company FROM wh_zones zn
												INNER JOIN companies co ON co.id = zn.zcompany_id
												GROUP BY zn.zcompany_id
												";
												//WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo'
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
												$SQL="Select * FROM wh_zones 
												WHERE zcompany_id = '$CIA' and zone_statu = 'Activo' 
												ORDER BY zone_desc";								
												
												//INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												//wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIA' and wh_user_zones.userz_statu = 'Activo' and 
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												$UBIC = $Fila["zone_id"] ."&nbsp;&nbsp; / &nbsp;&nbsp;". $Fila["zone_ubic"];
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
			<!-- =================================================================================== -->
							<?php
							if ($ZON != '') 
							{ ?>
							<div class="panel-body">
								<?php
								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_zones 
								INNER JOIN wh_user_zones ON wh_user_zones.zone_id = wh_zones.zone_id
								INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_zones.user_id
								INNER JOIN companies ON companies.id = wh_zones.zcompany_id
								Where wh_zones.zone_id = '$ZON'
								ORDER BY wh_user_details.first_name ASC";
								//---------------------------------------------------------------
								?>
								<table id="userszu_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" border='1'>
								<thead>
								<tr height= '16px'>
									<th>ID</th>
									<th>Compañia</th>
									<th>Usuario</th>
									<th>Correo Electronico</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$contador = 0;
								$Registro2 = mysqli_query($link,$SQL);
								while($Fila2 = mysqli_fetch_array($Registro2))
								{
								$editar = '';
								$USRN = $Fila2["first_name"] ."&nbsp;". $Fila2["last_name"];
//<!-- =================================================================================== -->	
	if($Fila2['userz_statu'] == 'Activo')
	{
		$status = '<button type="button" name="delete" title="Cambiar Status del Usuario" id="'.$Fila2["ID_reg"].'"  class="btn btn-success btn-xs delete" data-status="'.$Fila2["userz_statu"].'">Activo</button>';
			
	} else {
		
		$status = '<button type="button" name="delete" title="Cambiar Status del Tipo de Equipo" id="'.$Fila2["ID_reg"].'"  class="btn btn-danger btn-xs delete" data-status="'.$Fila2["userz_statu"].'">Inactivo</button>';
		
	}
//<!-- =================================================================================== -->							
								?>
								<Tr>
								<Td><font size="3px"><?php echo $Fila2['ID_reg']; ?></font></td>
								<Td><font size="3px"><?php echo $Fila2['company']; ?></font></td>
								<Td><font size="3px"><?php echo $USRN; ?></font></td>
								<Td><font size="3px"><?php echo $Fila2['user_email']; ?></font></td>
								<td><?php echo $status; ?></td>
<!-- =================================================================================== -->		
								</tr>
								<?php } mysqli_free_result ($Registro2); ?>
								</tbody>
								</table>
							</div>
						</div>
					</div>						
				</div>
<!-- =================================================================================== -->
			</div>
		</div>
	</section>
</div>
<?php } // mysqli_close($link); ?>
</FORM>
<!-- =================================================================================== -->	
			<div id="userzuModal" class="modal fade" data-backdrop="static">
				<div class="modal-dialog modal-lg">
					<form method="post" id="userzu_form">
						<div class="modal-content w3-animate-zoom">
							<div class="modal-header" style="background-color:#<?=$ccolor;?>">
								<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"> Adicionar Usuario Zona de Ubicación</font></h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<!-- ===============================================================   -->
								<Input Type="hidden" name="zone_id" id="zone_id" value="<?Php echo $ZON; ?>">
								<Input Type="hidden" name="uzcompany_id" id="uzcompany_id"value="<?php echo $CIAX; ?>">
								
								<div class="form-group">
									<label><font color="#660000" FACE="times new roman" size="2px">Zona Ubicación..:  </font></label>
									&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="2px"> <?Php echo $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
								</div>
								<HR style="border-color:#cccccc;">	
								<!-- =============================================================== -->
								<br>
								<div class="col-lg-12">
									<div class="input-group">
										<span class="input-group-text"><b>Usuario.:</b></span>
										<select class="form-control" name="user_id" id="user_id" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
											<?php
											//---------------------------------------------------------------
											$SQL="Select * From wh_user_details WHERE user_statu = 'Activo' ORDER BY first_name ";
											$Registro=mysqli_query($link, $SQL);
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
									</b>
								</div>
							</div>
							<br><br><br>
							<div class="modal-footer" style="background-color:#FFFFFC">
								<input type="hidden" name="ID_reg" id="ID_reg" />
								<input type="hidden" name="btn_action" id="btn_action" />
								<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
								<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
							</div>
						</div>
						<Input Type="hidden" name="CT2" value="<?Php echo $CT2=$CT2+'1'; ?>">
					</form>
				</div>
			</div>
<?php mysqli_close($link); ?>
<!-- =================================================================================== -->
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#userzu_form')[0].reset();
		$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Usuario a Zona de Ubicación</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->

	$(document).on('submit','#userzu_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"users_zu_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#userzu_form')[0].reset();
				$('#userzuModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->


<!-- ************************************************************************* -->	
    $('#userszu_data').DataTable({
		
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
				"targets":[0],
				"orderable":false,
			},
		],
		"pageLength": 8
    });	
<!-- ********************* status del Registros ******************************** -->
	$(document).on('click', '.delete', function(){
		var ID_reg = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("¿Seguro que quieres cambiar el Status del Registro?"))
		{
			$.ajax({
				url:"users_zu_action.php",
				method:"POST",
				data:{ID_reg:ID_reg, status:status, btn_action:btn_action},
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
});
<!-- ************************************************************************* -->
</script>