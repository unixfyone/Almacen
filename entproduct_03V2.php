<?php
//entproduct.php

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

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
<link rel="stylesheet" href="cssi/styles.css">
<link rel="stylesheet" href="css/styles-wh.css">

<style type="text/css">
.form-controlX2 {
	background-color: #e9ecef;
	border: #<?=$ccolor;?>; 
	border-style: solid; 
	border-top-width: 0px; 
	border-right-width: 2px; 
	border-bottom-width: 1px; 
	border-left-width: 0px; 
}	
.form-control2 {
  display: block;
  width: 100%;
  height: 38px;
  padding: 8px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #e9ecef;
  background-image: none;
  border: #<?=$ccolor;?>;
  border-radius: 4px;
  	border-style: solid; 
	border-top-width: 0px; 
	border-right-width: 2px; 
	border-bottom-width: 1px; 
	border-left-width: 0px; 
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control2:focus {
  border-color: #<?=$ccolor2;?>;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
}
th {
    color: white;
	font-size:14px;
	background-color:#<?=$ccolor;?>;
	}

table, th, td {
    border: 1px solid #cccccc;
    border-collapse: collapse;
}
.thx {
    color: black;
	font-size:15px;
	background-color:#cccccc;
	border-color: white;
	text-align:center;
	}
.thy {
    color: black;
	font-size:16px;
	background-color:#f8f8f8;
	text-align:center;
	border: 1px solid #cccccc;
    border-collapse: collapse;
	}

.w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}

.border {
    border: 1px solid #<?=$ccolor;?>;
}

btn-prima {
    color: #fff;
    background-color: #<?=$ccolor2;?>;
    border-color: #<?=$ccolor;?>;
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
//echo '<FORM>';

//---------------------------------------------------------------
if(isset($_GET["movh_doc"]))$IDX = $_GET["movh_doc"];
else $IDX = '';
//--------------
if(isset($_GET["zone"]))$ZON = $_GET["zone"];
else $ZON = '';
//--------------
if(isset($_GET["prod"]))$prod = $_GET["prod"];
else $prod = '';
//--------------
if(isset($_GET["prodid"]))$prodid = $_GET["prodid"];
else $prodid = '';
//---------------------------------------------------------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

$varPI = '0';
//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh 
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
WHERE movh_doc = '$IDX' and movh_zone = '$ZON'";
$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];
$mhtdoc = $Fila1["tm_desc"]; 
$mhtmov = $Fila1["movh_tmov"];
$mhfecha = $Fila1["movh_fecha"];
$mhejer = $Fila1["movh_ejer"];
$mhper = $Fila1["movh_per"];
$mhproce = $Fila1["movh_proce"];
$mhstatu = $Fila1["movh_statu"];
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
$CIA = $FilaA["zcompany_id"];
$DCIA = $FilaA["company"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------

//echo "<pre>"; print_r($SQL); exit();
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>">
<Input Type="hidden" name="movh_doc" value="<?Php echo $IDX ?>">
<Input Type="hidden" name="zone" value="<?Php echo $ZON ?>">

<Input Type="hidden" name="prod" value="<?Php echo $prod ?>">
<Input Type="hidden" name="prodid" value="<?Php echo $prodid ?>">

<div class="content-wrapper">
    <!-- Main content -->
	<section class="content">
	<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" size="4px">Agregar Documento Movimientos Almacen</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Compañia..:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $DCIA ; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacen..:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Tipo Documento..:  </font></label>
											&nbsp;&nbsp;<span><b><font color="red" size="4px"> <?Php echo $mhtmov; ?></font></b></span>
										</div>
									</div>								
								</div>
								<!-- =========================== -->
								<table border="1" width="100%">
								<thead><tr>
									<th class="thx"><p>Nro. Documento</p></th>
									<th class="thx"><p>Tipo Documento</p></th>
									<th class="thx"><p>T.M.</p></th>
									<th class="thx"><p>Fecha Doc.</p></th>
									<th class="thx"><p>Ejercicio</p></th>
									<th class="thx"><p>Periodo</p></th>
								</tr></thead>
								<tr>
									<td><b><input class="form-control2" style='text-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
									<td><b><input class="form-control2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" readonly /></b></td>
									<td><b><input class="form-control2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
									<td><input class="form-control2" type="date" name="movh_fecha" id="movh_fecha" size='13' value="<?Php echo $mhfecha; ?>" readonly /></td>
									<td><input class="form-control2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' value="<?Php echo $mhejer; ?>" readonly></td>
									<td><input class="form-control2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
								</tr>
								</table>
							</div>
						</div>
						<!--================================================== -->
						<div class="row">
							<div class="col-sm-12">
								<!--<div class="col-sm-12 table-responsive"> -->
								<div class="box-body">
									<?php
									//---------------------------------------------------------------
									$SQL = "SELECT * FROM wh_movinvh 
									INNER JOIN wh_movinvd ON wh_movinvd.movh_id = wh_movinvh.movh_id
									INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id
									INNER JOIN wh_materials ON wh_materials.zone_id = wh_movinvd.movd_zone and wh_materials.code = wh_movinvd.product_cod
									Where wh_movinvh.movh_doc = '$IDX' ORDER BY wh_movinvd.movd_id ASC";
									//--------------------------------------------------------------- 
									?>
									<div class="col-sm-12 table-responsive">
										
										<form method="POST" action="act_cerrar_renglon.php"> 
										
										<table id="movd_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>							
										<thead>
										<tr height= '16px'>
											<th class="thy"></th>
											<th class="thy">Cod. Material</th>
											<th class="thy">Descripción</th>
											<th class="thy">Cantidad</th>
											<th class="thy">Unit ME</th>
											<th class="thy">Tasa Cambio</th>
											<th class="thy">Status</th>
											<th class="thy">Acciones</th>		
										</tr>
										</thead>
										<tbody>
										<?php
										$Registro2 = mysqli_query($link,$SQL);
										while($Fila = mysqli_fetch_array($Registro2))
										{ 
										$tmtipo = $Fila["tm_tipo"];
										$status = '';
										$accion = '';
										//==============================
										$prod2 = $Fila["code"];
										$DESCP = $Fila["description_m"];
										$DESCTM = $Fila["tm_desc"];
										$dmov = $Fila["movd_desc"];
										$mdcant = $Fila["movd_cant"];
										$mdcostoue = $Fila["movd_costou_me"];
										$mdcostoul = $Fila["movd_costou_ml"];
										$rprod = $Fila["movd_recprod"];
//<!-- =================================================================================== -->
	if($Fila['movd_statu'] == 'Abierto')
	{
		$status = '<span class=""><font color="green" size="3px">Abierto</font></span>';

		if($mhtmov == 'Entradas' ) {
			$accion = '<ul class="nav navbar-nav">
			<li class="dropdown btn-group">
			<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="entproduct_02V2.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>
				<li role="presentation" class="divider"></li>
				<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
			</ul></li></ul>';
		}
		if($mhtmov == 'Salidas' ) {
			$accion = '<ul class="nav navbar-nav">
			<li class="dropdown btn-group">
			<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="entproduct_02_Sal.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>
				<li role="presentation" class="divider"></li>
				<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
				
			</ul></li></ul>';
		}			
		
	}	else	{
		$status = '<span class=""><font color="red" size="3px">Cerrado</font></span>';
			
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

		<ul class="dropdown-menu dropdown-menu-right">

		<li class="disabled"><a href="#"><i class="fa fa-edit"></i> Editar Renglon</a></li>

		<li role="presentation" class="divider"></li>

		<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
		</ul></li></ul>';										
	}
//<!-- =================================================================================== -->								
										?>
										<Tr height= '16px'>
											<?php if($Fila['movd_statu'] == 'Abierto') {	?>
											<td><input type="checkbox" name="id[]" value="<?php echo $Fila['movd_id']; ?>" /></td>
											<?php } else { ?>
											<td><input type="checkbox" name="id[]" value="<?php echo $Fila['movd_id']; ?>" disabled /></td>
											<?php } ?> 
											<Td><font size="3px"><?php echo $Fila['product_cod']; ?></font></td>
											<Td><span class="text-wrap"><font size="3px"><?php echo $Fila['movd_desc']; ?></font></span></td>
											<Td align="right"><font size="3px"><?php echo number_format($Fila['movd_cant'], 3, ",", ".");?></font></td>
											<Td align="right"><font size="3px"><?php echo number_format($Fila['movd_costou_me'], 2, ",", ".");?></font></td>
											<Td align="right"><font size="3px"><?php echo number_format($Fila['movd_tasa_cambio'], 2, ",", ".");?></font></td>
											<td align="center"><?php echo $status; ?></td>
											<td><?php echo $accion; ?></td>
										</tr>
										<?php } mysqli_free_result ($Registro2); ?>
										</tbody>
										</table>
										
										<div Align="right" style="background-color:#FFFFFC">
											<input class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="submit" name="autorizados" value="Cerrar seleccionados" />
										</form>
											<button class="btn btn-outline-<?php echo $classButtonFooter;?> btn-md elevation-1" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>	
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>	
					<!-- </div> -->
<!-- =================================================================================== -->	
				</div>
			</div>
		</div>
	</section>
	<!--======================================================================================= -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card card-<?= $cstyle; ?>-dark card-outline">
							<div class="card-header bg-light border-0">
								<h5 class="card-title text-<?= $cstyle; ?>-dark text-bold">Buscar Material</h5>
							</div>
						</div>
						<div class="container-fluid">						
							<div class="panel-body">
								<FORM>
								
								<Input Type="hidden" name="movh_doc" value="<?Php echo $IDX ?>">
								<Input Type="hidden" name="zone" value="<?Php echo $ZON ?>">
								<Input Type="hidden" name="CT1" value="<?Php echo $CT1=$CT1+'1';?>">
								
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-7">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-text"><b>Busqueda..:</b></span>
														<b><input class="form-control" type="text" name="prod" size="20" maxlength="45" value="<?Php echo $prod ?>" placeholder="Palabra de busqueda" ></b>
														<span class="input-group-btn">
														<button class="btn btn-default" name="boton1" type="submit"><i class="w3-margin-left fa fa-search"> Buscar</i></button></span>
													</div>
												</div>
											</div>
										</div>
									</div>	
									</FORM>
					
									<div class="container-fluid">					
										<?php
									
										//*****************************************************
										if (isset($_GET["boton1"])  and $_GET["prod"] != "")
										{
											//---------------------------------------------------------------
											$aKeyword = explode(" ", $_GET['prod']);
											$SQL ="SELECT * FROM wh_materials 
											INNER JOIN wh_categories on wh_categories.cat_id = wh_materials.wh_category_id_m
											WHERE wh_materials.zone_id = '$ZON' and 
											wh_materials.company_id = '$CIA' and 
											wh_materials.m_statu_m = 'Activo' and
											wh_materials.code like '%" . $aKeyword[0] . "%' or 
											
											wh_materials.zone_id = '$ZON' and 
											wh_materials.company_id = '$CIA' and 
											wh_materials.m_statu_m = 'Activo' and										
											wh_materials.description_m like '%" . $aKeyword[0] . "%' OR
											
											wh_materials.zone_id = '$ZON' and 
											wh_materials.company_id = '$CIA' and 
											wh_materials.m_statu_m = 'Activo' and									
											wh_categories.category like '%" . $aKeyword[0] . "%'
											";
									
											//---------------------------------------------------------------

											echo "<b><font color='#0066FF' size='4px'>Lista de Materiales</font></b>";
											?>
											<Table id="busq_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
											
											<thead><tr height= '16px'>
											<TH class='thy'><p>Codigo</p></th>
											<TH class='thy'><p style='text-align:Left'>Descripción</p></th>
											<TH class='thy'><p>Categoria</p></th>
											<TH class='thy'><p>statu</p></th>
											</TR></thead>
											<?php
											$Registro2 = mysqli_query($link,$SQL);
											while($Fila = mysqli_fetch_array($Registro2))
											{
											//=============================
											if($Fila['m_statu_m'] == 'Activo')
											{
												$status = '<span class=""><font color="blue" FACE="times new roman" size="3px">Activo</font></span>';
											}	else	{
												$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Inactivo</font></span>';
											}	
											//=============================
											$GRPXD = '';
											$prodid = $Fila["id"];
											$prod2X = $Fila["code"];
											$GRPXD =  $Fila["category"];
											//=============================
											echo "<Tr>";
											//-------
											if($Fila['m_statu_m'] != 'Activo')
											{
											echo "<Td Align=Left><font size=3>" . $Fila['code'];	
											}	else	{	
											 echo "<td><a href=\"entproduct_03AV2.php?IDH=$mhid&IDP=$prodid&CP=$prod2X&zone=$ZON \">$prod2X</a></td>";
											}
											//-------
											echo "<Td Align=Left><span class=text-wrap><font size=3>" . $Fila['description_m'];
											echo "<Td Align=Center><font size=3>" . $GRPXD;
											echo "<Td Align=Center><font size=3>" . $status;
											echo "</TR>";
											//---------------
											} 
											mysqli_free_result ($Registro2);
										
											echo "</Table>";
											echo "<br>";
											//---------------
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>
<!-- =================================================================================== -->	
	<div id="movinvdetailsModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<form method="post" id="movinvd_form">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#<?=$ccolor;?>">
						<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Detalle del Movimiento</font></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<Div id="movinv_details"></Div>

					</div>
					<div class="modal-footer" style="background-color:#FFFFFC">
						<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- ==== 
</FORM>	-->
<!-- =================================================================================== -->
<script>
$(document).ready(function(){

<!-- ********************* Lista de Registros ******************************** -->
	$('#movd_data').DataTable({
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
				"targets":[0, 3, 4, 5, 6],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	
<!-- ************************************************************************* -->
    $(document).on('click', '.view', function(){
        var movd_id = $(this).attr("id");
        var btn_action = 'movinv_details';
        $.ajax({
            url:"movinvd_action.php",
            method:"POST",
            data:{movd_id:movd_id, btn_action:btn_action},
            success:function(data){
                $('#movinvdetailsModal').modal('show');
				$('.modal-title').html("<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Detalle del Renglon</b></font>");
                $('#movinv_details').html(data);
            }
        })
	});	
<!-- ************************************************************************* -->	
});
</script>

<?php
//-------------------------------------------------------
mysqli_close($link);
//----------------------------------------------------------------
?>
