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

<style type="text/css">
p {
    margin-top: 0em;
    margin-bottom: 0em;
	height: 20px;
}

table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #005266;
	color: white;
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

.btn-xs, .btn-group-xs > .btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
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

</style>
<?php
//--- Conectando, seleccionando la base de datos ---------------
   include_once 'Conex.php';
   $link=Conectarse();
//---------------------------------------------------------------
echo '<FORM ACTION="">';

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["ALM"]))$ALM = $_GET["ALM"];
else $ALM = '';
//-------------
if(isset($_GET["MID"]))$MID = $_GET["MID"];
else $MID = '';
//-------------
if(isset($_GET["EDO"]))$EDO = $_GET["EDO"];
else $EDO = '';
//---------------------------------------------------------------
if(isset($_GET["CT2"]))$CT2 = $_GET["CT2"];
else $CT2 = '0';
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLp = "SELECT * FROM wh_periodos WHERE per_statu = 'Abierto' ";
	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA_P = $Filap["per_aa"];
		$MM_P = $Filap["per_mm"];
	}
	mysqli_free_result ($Registrop);
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
Where zone_id = '$ALM' ";
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
<Input Type="hidden" name="MID" value="<?Php echo $MID; ?>">
<Input Type="hidden" name="ALM" value="<?Php echo $ALM ?>">
<Input Type="hidden" name="EDO" value="<?Php echo $EDO ?>">

<div class="content-wrapper">
<!--<span id="alert_action"></span> -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<section class="content-header">
		<div class="container-fluid">
			<div class="panel-heading">
                
					<div class="row">
					<div class="col-lg-6">
						<b><font color="#990000" FACE="times new roman" size="4px">Movimientos de Productos.: </font></b>
                        <b><font color="blue" FACE="times new roman" size="4px"> Documentos</font></b>
						

                </div>
                <div class="col-lg-6" align="right">

						<?php
						if($MID !='' and $ALM !='')
						{
						?>
							<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#movhModal" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1"> Nuevo Documento</button>

						<?php	 
						} else {
						?>
							<button type="button" name="add" id="add_button" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled><i class="glyphicon glyphicon-plus"></i> Nuevo Documento</button>
						<?php	 
						}
						?>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
		</div>
		</section>
<!-- =================================================================================== -->
			<div class="panel-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-5">
							<div class="input-group">
								<span class="input-group-text"><b>Almacen.:</b></span>
								<select class="form-control" name="ALM" onChange="javascrip:form.submit()" autofocus>
								<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
								<?php
								//---------------------------------------------------------------
								$SQL="Select * FROM wh_user_zones 
								INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
								WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
								ORDER BY wh_zones.zone_desc";								
								
								$Registro=mysqli_query($link,$SQL);
								//-------
								while ($Fila=mysqli_fetch_array($Registro)){
								$UBIC = $Fila["zone_desc"] ."&nbsp;&nbsp; / &nbsp;&nbsp;". $Fila["zone_ubic"];
								//----
								echo '<option ';
								if($ALM == $Fila["zone_id"])echo 'selected ';
								echo 'value=' . $Fila["zone_id"] .'>'. $UBIC . "\n";
								}
								mysqli_free_result ($Registro);
								//---------------------------------------------------------------
								?>									
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-text"><b>Tipo Movimiento.:</b></span>
								<select class="form-control" name="MID" onChange="javascrip:form.submit()" >
								<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
								<?php
								//---------------------------------------------------------------
									$SQL="Select * FROM wh_tipmov group by tm_tipo";
									$Registro=mysqli_query($link,$SQL);
									//-------
									while ($Fila=mysqli_fetch_array($Registro)){
									//----
									echo '<option ';
									if($MID == $Fila["tm_tipo"])echo 'selected ';
									echo 'value=' . $Fila["tm_tipo"] .'>'. $Fila["tm_tipo"] . "\n";
									}
									mysqli_free_result ($Registro);
								//---------------------------------------------------------------
								?>									
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="input-group">
								<span class="input-group-text"><b>Status:</b></span>
								<select class="form-control" name="EDO" id="EDO" onChange="javascrip:form.submit()" >
								<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>

								<?php
								//---------------------------------------------------------------
								$SQL="Select * FROM wh_movinvh where movh_ejer = '$AA_P' and movh_per = '$MM_P' GROUP BY movh_statu ORDER BY movh_statu";
								$Registro=mysqli_query($link,$SQL);
								//-------
								while ($Fila=mysqli_fetch_array($Registro)){
								//----
								echo '<option ';
								if($EDO == $Fila["movh_statu"])echo 'selected ';
								echo 'value=' . $Fila["movh_statu"] .'>'. $Fila["movh_statu"] . "\n";
								}
								mysqli_free_result ($Registro);
								//---------------------------------------------------------------
								?>	
								</select>
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		<!-- =================================================================================== -->
		<?php
		if ($MID != '' and $ALM !='') 
		{ ?>
		<div class="panel-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
				<!--<div class="col-sm-12 table-responsive"> -->
					<!-- <div class="box-body"> -->
					<?php
					//---------------------------------------------------------------
					$SQL = "SELECT * FROM wh_movinvh 
					INNER JOIN wh_periodos ON wh_periodos.per_aa = wh_movinvh.movh_ejer and wh_periodos.per_mm = wh_movinvh.movh_per
					WHERE wh_periodos.per_statu = 'Abierto' and wh_movinvh.movh_tmov = '$MID' and wh_movinvh.movh_zone = '$ALM' and wh_movinvh.movh_statu = '$EDO' ORDER BY wh_movinvh.movh_fecha DESC ";
					//---------------------------------------------------------------
					?>
					<table id="movh_data" class="table table-bordered table-striped" border='1'>
					<thead>
					<tr height= '16px'>
					<th><p>Fecha</p></th>
					<th><p>Tipo</p></th>
					<th><p>Documento</p></th>
					<th><p>Procedencia</p></th>
					<th><p>Status</p></th>
					<th><p>Acciones</p></th>
					</tr>
					</thead>
					<tbody>
						<?php
						$contador = 0;
						$Registro2 = mysqli_query($link,$SQL);
						while($Fila2 = mysqli_fetch_array($Registro2))
						{
						$status = '';
						$accion = '';
//<!-- =================================================================================== -->	
	if($Fila2['movh_statu'] == 'Abierto')
	{
		$status = '<span class=""><font color="green" FACE="times new roman" size="3px">Abierto</font></span>';
		
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="btn btn-primary btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></button>
		
		<ul class="dropdown-menu dropdown-menu-right">
			
			<li><a <button type="button" name="update" id="'.$Fila2["movh_id"].'" class="update"><i class="glyphicon glyphicon-edit"></i> Editar Documento</button></a></li>
		
			<li role="presentation" class="divider"></li>

			<li><a href="entproduct_03.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-plus-sign"></i>  Agregar Renglones</a></li>
			
			<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-list"></i>  Detalle de  Renglones</a></li>
			
			<li><a href="mov_invent_hC.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-remove"></i> Cerrar Documento</a></li>
			
		</ul></li></ul>';			
	}
	else
	{
		$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Cerrado</font></span>';

		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="btn btn-primary btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></button>
		
		<ul class="dropdown-menu dropdown-menu-right">
			
			<li class="disabled"><a <button type="button" name="update" id="'.$Fila2["movh_id"].'" class="update"><i class="glyphicon glyphicon-edit"></i> Editar Documento</button></a></li>
		
			<li role="presentation" class="divider"></li>

			<li class="disabled"><a href="entproduct_03.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-plus-sign"></i>  Agregar Renglones</a></li>
			
			<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-list"></i>  Detalle de  Renglones</a></li>
			
			<li class="disabled"><a href="mov_invent_hC.php?movh_id='.$Fila2['movh_id'].' "><i class="glyphicon glyphicon-remove"></i> Cerrar Documento</a></li>
			
		</ul></li></ul>';		
		
		
		
		
		
	}
//<!-- =================================================================================== -->								
						?>
						<Tr height= '16px'>
							<Td><font size="2.5px"><?php echo $Fila2['movh_fecha']; ?></font></td>
							<Td><b><font size="2.5px" color = "#990000"><?php echo $Fila2['movh_tdoc']; ?></font></b></td>
							<Td><b><font size="2.5px" color = "#990000"><?php echo $Fila2['movh_doc']; ?></font></b></td>
							<Td><font size="2.5px"><?php echo $Fila2['movh_proce']; ?></font></td>
							<td><?php echo $status; ?></td>
							<td><?php echo $accion; ?></td>
						</tr>
						<?php } mysqli_free_result ($Registro2); ?>
					</tbody>
					</table>
					<!--</div> -->
				</div>
			</div>						
		</div>
		</div>
<!-- =================================================================================== -->
		</div>
	</div>
</div>
</div>
<?php } ?>
</FORM>			
<!-- =================================================================================== -->
	<div id="movhModal" class="modal fade">
		<div class="modal-dialog modal-md">
			<form method="post" id="movh_form">
				<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:teal">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="4px"><i class="fa fa-plus"></i> Agregar Movimientos de Productos</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<!-- =============================================================== -->
						<Input Type="hidden" name="movh_tmov" id="movh_tmov" value="<?Php echo $MID; ?>">
						<Input Type="hidden" name="movh_zone" id="movh_zone" value="<?Php echo $ALM; ?>">
						
						<div class="form-group">
							<label><font color="#660000" FACE="times new roman" size="3px">Almacen..:  </font></label>
							&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $ZOND ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZONU; ?></font></label>
							<br>
							<label><font color="#660000" FACE="times new roman" size="3px">Documento de.:  </font></label>
							&nbsp;<label><font color="blue" FACE="times new roman" size="3px"> <?Php echo $MID; ?></font></label>
						</div>
						<HR style="border-color:#a6a6a6;">	
						<!-- =============================================================== -->
						<div class="form-group">
							<label class="col-sm-4 control-label">Documento..:</label>
							<div class="col-md-6">
								<input type="text" name="movh_doc" id="movh_doc" maxlength="15" class="form-control" placeholder="Nro. de Documento" autofocus required />
							</div>
							<br>
    					</div>
						<br>
						<div class="form-group">
							<label class="col-sm-4 control-label">Tipo de Documento.:</label>
							<div class="col-md-7">
								<input type="text" name="movh_tdoc" id="movh_tdoc" maxlength="30" class="form-control" placeholder="Nombre del Tipo de Documento" required />
							</div>
						</div>
						<br><br>
						<div class="form-group">
							<label class="col-sm-4 control-label">Fecha del Documento.:</label>
							<div class="col-md-4">
								<input type="date" name="movh_fecha" id="movh_fecha" class="form-control" required />
							</div>
						</div>
						<br><br>
						<div class="form-group">
							<label class="col-sm-4 control-label">Ejercicio-Periodo.:</label>
							<div class="col-md-2">
								<input type="text" name="movh_ejer" id="movh_ejer" style="text-align:center" class="form-control" value="<?Php echo $AA_P ?>" readonly ></input>
							</div>
							<div class="col-md-2">
								<input type="text" name="movh_per" id="movh_per" style="text-align:center" class="form-control" value="<?Php echo $MM_P ?>" readonly ></input>
							</div>							
						</div>
						<br><br>
						<div class="form-group">
							<label class="col-sm-4 control-label">Proveedor / Cliente.:</label>
							<div class="col-md-8">
								<input type="text" name="movh_prove" id="movh_prove" class="form-control" placeholder="Nombre Proveedor / Cliente" required />
							</div>
						</div>
						<br><br>						
						<div class="form-group">
							<label class="col-sm-4 control-label">Sub-Total Documento:</label>
							<div class="col-md-4">
								<input type="text" maxlength="12" name="movh_stotal" id="movh_stotal" value= '0.00' class="form-control" required />
							</div>
							<div class="col-md-4" align = "left">
								<label><b><font color="green" size="2px">(Usar punto decimal)</font></b></label>
							</div>							
						</div>
						<br><br>
						<div class="form-group">
							<label class="col-sm-4 control-label">Total IVA Documento:</label>
							<div class="col-md-4">
								<input type="text" maxlength="12" name="movh_iva" id="movh_iva" value= '0.00' class="form-control" required />
							</div>
							<div class="col-md-4" align = "left">
								<label><b><font color="green" size="2px">(Usar punto decimal)</font></b></label>
							</div>							
						</div>
						<br><br>						
    				</div>
    				<div class="modal-footer" style="background-color:#e6fff2">
    					<input type="hidden" name="movh_id" id="movh_id" />
    					<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
						<button type="button" class="btn btn-success btn-md" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
    $('#add_button').click(function(){
        $('#movhModal').modal('show');
        $('#movh_form')[0].reset();
        $('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='4px'><b> Agregar Documentos Movimientos de Productos</b></font>");
        $('#action').val("Grabar");
        $('#btn_action').val("Add");
    });
<!-- ************************************************************************* -->
	
	$(document).on('submit','#movh_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"mov_inventh_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#movh_form')[0].reset();
				$('#movhModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				location.reload();
			}
		})
	});
<!-- ********************* Editar el Registro ******************************** -->
	$(document).on('click', '.update', function(){
		var movh_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"mov_inventh_action.php",
			method:"POST",
			data:{movh_id:movh_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#movhModal').modal('show');
				$('#movh_doc').val(data.movh_doc);
				$('#movh_tdoc').val(data.movh_tdoc);
				$('#movh_fecha').val(data.movh_fecha);
				$('#movh_ejer').val(data.movh_ejer);
				$('#movh_per').val(data.movh_per);
				$('#movh_proce').val(data.movh_proce);
				$('#movh_stotal').val(data.movh_stotal);
				$('#movh_iva').val(data.movh_iva);
				$('#product_procedencia').val(data.product_procedencia);
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='4px'><b>Editar Documentos Movimientos de Productos</b></font>");
				$('#movh_id').val(movh_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* Lista de Registros ******************************** -->
	$('#movh_data').DataTable({
		
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
				"targets":[0, 3, 5, 7],
				"orderable":false,
			},
		],
		"pageLength": 8
	});
});
<!-- ************************************************************************* -->
</script>

<?php
mysqli_close($link);
?>				