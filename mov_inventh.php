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
<link rel="stylesheet" href="css/styles-wh.css">

<style type="text/css">
.border {
    border: 1px solid #<?=$ccolor;?>;
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

if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_GET["CIAX"]))$CIAX = $_GET["CIAX"];
else $CIAX = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["MID"]))$MID = $_GET["MID"];
else $MID = '';
//-------------
if(isset($_GET["EDO"]))$EDO = $_GET["EDO"];
else $EDO = '';
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLp = "SELECT * FROM wh_periodos WHERE per_statu = 'Abierto' and zone_id = '$ZON' ";
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
<Input Type="hidden" name="MID" value="<?Php echo $MID; ?>">
<Input Type="hidden" name="CIAX" value="<?Php echo $CIAX ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="EDO" value="<?Php echo $EDO ?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">



<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Movimiento Almacen
					</font></h2>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $CIAX != '' and $ZON !='' and $MID !='' and $actua == '1')
					{
						if($MID =='ENTRADAS') {
							echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"mov_inventh2V2.php?CIAX=$CIAX&ZON=$ZON&MID=$MID \"><i class='glyphicon glyphicon-plus'></i> Agregar Documento</a>";						
						} else {
							echo "<a type='button' class='btn btn-outline-<?php echo $classButtonHeader; ?> btn-xs elevation-1' href=\"mov_inventh2V2S.php?CIAX=$CIAX&ZON=$ZON&MID=$MID \"><i class='glyphicon glyphicon-plus'></i> Agregar Documento</a>";										
						}
					} else {
						?>
						<a><button type="button" name="add_button" id="add_button" data-toggle="modal" data-target="#" class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" disabled />Agregar Documento</button></a>
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
							<b><font color="#FFFFFF" size="4px">Documentos Movimientos Almacen</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia:</b></span>
											<select class="form-control" name="CIAX" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select uz.*, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo' 
												GROUP BY uz.uzcompany_id
												";
												
												$Registro=mysqli_query($link,$SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($CIAX == $Fila["id"])echo 'selected ';
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
											<span class="input-group-text"><b>Almacen.:</b></span>
											<select class="form-control" name="ZON" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar la Ubicación</option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_user_zones 
												INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIAX' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
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
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Tipo de Movimiento.:</b></span>
											<select class="form-control" name="MID" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Selecconar Movimientos</option>							
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
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Status Movimientos:</b></span>
											<select class="form-control" name="EDO" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * FROM wh_movinvh group by movh_statu";
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
							</div>
							
						</div> 	<!-- /.PRUEBAAAAA -->
					</div>
				</div>
			</div>
		</div>
	</section>
							
	<?php if ($CIAX != '' and $ZON != '' and $MID != '') { ?>
	
	

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card card-<?= $cstyle; ?>-dark card-outline">
							<div class="card-header bg-light border-0">
								<h5 class="card-title text-<?= $cstyle; ?>-dark text-bold">Documentos </h5>
							</div>
						</div>
						<div class="panel-body">
							<?php
							if ($EDO != '') {
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_movinvh 
							INNER JOIN wh_periodos ON wh_periodos.per_aa = wh_movinvh.movh_ejer and wh_periodos.per_mm = wh_movinvh.movh_per
							INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
							WHERE wh_periodos.per_statu = 'Abierto' and wh_periodos.zone_id = '$ZON' and wh_movinvh.movh_tmov = '$MID' and wh_movinvh.movh_zone = '$ZON' and wh_movinvh.movh_cia = '$CIAX' and wh_movinvh.movh_statu = '$EDO' and movh_salint = '0' ORDER BY wh_movinvh.movh_doc DESC ";
							//---------------------------------------------------------------
							} else {
							$SQL = "SELECT * FROM wh_movinvh 
							INNER JOIN wh_periodos ON wh_periodos.per_aa = wh_movinvh.movh_ejer and wh_periodos.per_mm = wh_movinvh.movh_per
							INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
							WHERE wh_periodos.per_statu = 'Abierto' and wh_periodos.zone_id = '$ZON' and wh_movinvh.movh_tmov = '$MID' and wh_movinvh.movh_zone = '$ZON' and wh_movinvh.movh_cia = '$CIAX' and movh_salint = '0' ORDER BY wh_movinvh.movh_doc DESC ";
							//---------------------------------------------------------------								
							}
							?>
							
							
							<div class="col-sm-12 table-responsive">
							<table id="movimientos_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
															
								<thead class="text-dark">
									<tr>
									<th>Fecha</th>
									<th>Tipo</th>
									<th>Documento</th>
									<th>Nro. OC/Salida</th>
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
										$rcerrados = '';
										$DOC = $Fila2['movh_id'];
										$query = "SELECT COUNT(movh_id) AS renglones FROM wh_movinvd 
										WHERE movh_id = '$DOC' and movd_statu = 'Cerrado'";
										$Registro3 = mysqli_query($link,$query);
										while($row = mysqli_fetch_array($Registro3))
										{
										
										$rcerrados = $row['renglones'];
										}
										mysqli_free_result ($Registro3);
//<!-- ====================================================== -->
	if($Fila2['movh_statu'] == 'Abierto')
	{
		$status = '<span class=""><b><font color="green" size="3px">Abierto</font></b></span>';
	} else { 
		$status = '<span class=""><b><font color="red" size="3px">Cerrado</font></b></span>';
	}
//<!-- ============
	if($Fila2['movh_statu'] == 'Abierto')
	{
		if($edit == '1' and $actua == '1')
		{	
			if($MID == 'ENTRADAS' )
			{				
			$accion = '<ul class="nav navbar-nav">
			<li class="dropdown btn-group">
			<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>
			
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="mov_inventh3V2.php?IDX='.$Fila2['movh_id'].'&MOP='. $MOP.'&MID='. $MID.' "><i class="fa fa-edit"></i>  Editar Documento</a></li>
				
				<li role="presentation" class="divider"></li>
				
				<li><a href="entproduct_03.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-plus-circle"></i>  Agregar Renglones</a></li>
				<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-list"></i>  Detalle de  Renglones</a></li>
				<li><a href="mov_invent_hC.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-times"></i> Cerrar Documento</a></li>
				
				<li role="presentation" class="divider"></li>
				
				<li class="disabled"><a href="rep_document_pdfe.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-print"></i> Imprimir PDF</a></li>
				
			</ul></li></ul>';
			} else {
				$accion = '<ul class="nav navbar-nav">
				<li class="dropdown btn-group">
				<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>
				
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="mov_inventh3V2S.php?IDX='.$Fila2['movh_id'].'&MOP='. $MOP.'&MID='. $MID.' "><i class="fa fa-edit"></i>  Editar Documento</a></li>
					
					<li role="presentation" class="divider"></li>
					
					<li><a href="entproduct_03_Sal.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-plus-circle"></i>  Agregar Renglones</a></li>
					<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-list"></i>  Detalle de  Renglones</a></li>
					<li><a href="mov_invent_hC.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-times"></i> Cerrar Documento</a></li>
					
					<li role="presentation" class="divider"></li>
					
					<li class="disabled"><a href="rep_document_pdfs.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-print"></i> Imprimir PDF</a></li>
				</ul></li></ul>';
			}
		} else {
			
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>
		
		<ul class="dropdown-menu dropdown-menu-right">
			<li class="disabled"><a href="#" ><i class="fa fa-edit"></i>  Editar Documento</a></li>
			<li role="presentation" class="divider"></li>
			<li class="disabled"><a href="#"><i class="fa fa-plus-circle"></i>  Agregar Renglones</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-list"></i>  Detalle de  Renglones</a></li>
			<li role="presentation" class="divider"></li>
			<li class="disabled"><a href="#"><i class="fa fa-times"></i> Cerrar Documento</a></li>
			
		</ul></li></ul>';
		}
		
	} else {

			if($MID == 'ENTRADAS' )
			{
				$accion = '<ul class="nav navbar-nav">
				<li class="dropdown btn-group">
				<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>
				
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="disabled"><a href="#"><i class="fa fa-edit"></i>  Editar Documento</a></li>
					<li role="presentation" class="divider"></li>
					<li class="disabled"><a href="#"><i class="fa fa-plus-circle"></i>  Agregar Renglones</a></li>
					<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-list"></i>  Detalle de  Renglones</a></li>
					<li class="disabled"><a href="#"><i class="fa fa-times"></i> Cerrar Documento</a></li>
					<li role="presentation" class="divider"></li>
					<li><a href="rep_document_pdfe.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-print"></i> Imprimir PDF</a></li>				
				</ul></li></ul>';
			} else {
				$accion = '<ul class="nav navbar-nav">
				<li class="dropdown btn-group">
				<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i><span class="caret"></span></button>
				
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="disabled"><a href="#"><i class="fa fa-edit"></i>  Editar Documento</a></li>
					<li role="presentation" class="divider"></li>
					<li class="disabled"><a href="#"><i class="fa fa-plus-circle"></i>  Agregar Renglones</a></li>
					<li><a href="movinvd.php?movh_id='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-list"></i>  Detalle de  Renglones</a></li>
					<li class="disabled"><a href="#"><i class="fa fa-times"></i> Cerrar Documento</a></li>
					<li role="presentation" class="divider"></li>
					<li><a href="rep_document_pdfs.php?IDM='.$Fila2['movh_id'].'&MOP='. $MOP.' "><i class="fa fa-print"></i> Imprimir PDF</a></li>				
				</ul></li></ul>';				
			}	
		}
//<!-- =======================	

//<!-- =================================================================================== -->	
								?>							
									<Tr height= '16px'>
										<Td><font size="3px"><?php echo $Fila2['movh_fecha']; ?></font></td>
										<Td><span class="text-wrap"><font size="3px" color = "#990000"><?php echo $Fila2['tm_desc']; ?></font></span></td>
										<Td><font size="3px" color = "#990000"><?php echo $Fila2['movh_doc']; ?></font></td>
										<Td><span class="text-wrap"><font size="3px"><?php echo $Fila2['movh_oc']; ?></font></span></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $accion; ?></td>
									</tr>
								<?php } mysqli_free_result ($Registro2); ?>
								</tbody>
								</div>
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
	<div id="movimientosModal" class="modal fade" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<form method="post" name="movimientos_form">
				<div class="modal-content w3-animate-zoom">
    				<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" ><i class="fa fa-plus"></i> Agregar Movimientos de Productos</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<!-- =============================================================== -->
						<Input Type="hidden" name="movh_tmov" id="movh_tmov" value="<?Php echo $MID; ?>">
						<Input Type="hidden" name="movh_cia" id="movh_cia" value="<?Php echo $CIAX; ?>">
						<Input Type="hidden" name="movh_zone" id="movh_zone" value="<?Php echo $ZON; ?>">
						<Input Type="hidden" name="movh_ejer" id="movh_ejer" value="<?Php echo $AA_P; ?>">
						<Input Type="hidden" name="movh_per" id="movh_per" value="<?Php echo $MM_P; ?>">
						<!-- =============================================================== -->						
						<div class="form-group">
							<label><font color="#660000" size="3px">Zona Ubicación..:  </font></label>
							&nbsp;&nbsp;<label><font color="black" size="3px"><?Php echo $DCIA ."&nbsp;&nbsp; / &nbsp;&nbsp;". $ZOND; ?></font></label>
							<br>
							<label><font color="#660000" size="3px">Documento de.:  </font></label>
							&nbsp;<label><font color="blue" size="3px"> <?Php echo $MID; ?></font></label>
						</div>
						<HR style="border-color:#a6a6a6;">	
						<!-- =============================================================== -->
						<div class="row">  
							<div class="col-sm-4">
								<div class="form-group">
									<label><font size="3px"><i class="fas fa-code"></i> Nro.Documento.:</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="15" name="movh_doc" id="movh_doc" class="form-control" placeholder="Nra. del Documento" required />
									</div>
								</div> 
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label><font size="3px"><i class="fa fa-file-text"></i> Tipo de Documento.:</font></label>
									<div class="input-group-prepend">
										<input type="text" maxlength="80" name="movh_tdoc" id="movh_tdoc" class="form-control" placeholder="Tipo de Documento" required />
									</div>
								</div>                                 
							</div>
						</div>							
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label><font size="3px"><i class="fa fa-calendar"></i> Fecha del Documento.:</font></label>
									<div class="input-group-prepend">
										<input type="date" name="movh_fecha" id="movh_fecha" class="form-control" required />
									</div>
								</div> 
							</div>						
							<div class="col-sm-8">
								<div class="form-group">
									<label><font size="3px"><i class="fa fa-clock-o "></i> Ejercicio-Periodo.:</font></label>
									<div class="col-md-4">
										<div class="input-group-prepend">
											<input type="text" name="movh_ejer1" id="movh_ejer1" style="text-align:center" class="form-control" value="<?Php echo $AA_P ?>" readonly ></input>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="text" name="movh_per1" id="movh_per1" style="text-align:center" class="form-control" value="<?Php echo $MM_P ?>" readonly ></input>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label><font size="3px"><i class="fa fa-clock-o "></i> Procedencia.:</font></label>						
									<div class="input-group-prepend">
										<input type="text" name="movh_proce" id="movh_proce" maxlength="60" class="form-control" placeholder="Procedencia / Proveedor / Cliente" required />
									</div>
								</div>
							</div>
						</div>
					
    				</div>
    				<div class="modal-footer" style="background-color:#FFFFFC">
    					<input type="hidden" name="movh_id" id="movh_id" />
    					<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-outline-<?php echo $classButtonFooter; ?>" value="Add" />
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><i class="fa fa-right-from-bracket"></i> Cerrar</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

<script>
$(document).ready(function(){
<!-- ********************* Egregar Registro ******************************** -->
	$('#add_button').click(function(){
		$('#movimientos_form').trigger('reset');
		$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Agregar Categoria</b></font>");
		$('#action').val('Grabar');
		$('#btn_action').val('Add');
	});
<!-- ************************************************************************* -->
	$(document).on('submit','#movimientos_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"mov_inventh_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#movimientos_form')[0].reset();
				$('#movimientosModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				//groupsdataTable.ajax.reload();
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
				$('#movimientosModal').modal('show');
				$('#movh_doc').val(data.movh_doc);
				$('#movh_tdoc').val(data.movh_tdoc);
				$('#movh_fecha').val(data.movh_fecha);
				$('#movh_proce').val(data.movh_proce);
				$('.modal-title').html("<font color='#FFFFFF' size='5px'><b>Editar Documentos</b></font>");
				$('#movh_id').val(movh_id);
				$('#action').val('Grabar');
				$('#btn_action').val("Edit");
			}
		})
	});
<!-- ********************* status del Registros ******************************** -->

<!-- ********************* Lista de Registros ******************************** -->
	$('#movimientos_data').DataTable({
		
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
		"pageLength": 25
	});
<!-- ************************************************************************* -->
});
</script>

			