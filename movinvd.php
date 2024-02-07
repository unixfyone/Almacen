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
//include('unico_1.php');
?>

<html>
<head>

</head>

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
	font-size:15px;
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
	font-size:15px;
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

<body>
<?php
echo '<FORM ACTION="" method="POST">';

if(isset($_GET["movh_id"]))$IDX = $_GET["movh_id"];
else $IDX = $_POST["IDX2"];
//--------------
if(isset($_GET["MOP"]))$MOP = $_GET["MOP"];
else $MOP = '';
//-------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';

//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_movinvh 
INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvh.movh_tmid
where movh_id = '$IDX'";

$Registro1 = mysqli_query($link,$SQL);
while($Fila1 = mysqli_fetch_array($Registro1))
{
$mhid = $Fila1["movh_id"];
$ZON = $Fila1["movh_zone"];			// Código del Almacen
$mhdoc = $Fila1["movh_doc"];
$mhtdoc = $Fila1["tm_desc"];
//$mhtdoc = $Fila1["movh_tdoc"];
$mhtmov = $Fila1["movh_tmov"];			// Tipo: Entradas /Salidas
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
</form>
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<Input Type="hidden" name="IDX2" size=11 value="<?Php echo $IDX?>">
<Input Type="hidden" name="MOP" value="<?Php echo $MOP ?>">

<!--  ======================================================================================= -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"> Movimiento Almacen
					</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<?php
					if($add == '1' and $ZON !='' and $mhstatu != 'Cerrado' and $actua == '1')
					{

						if($mhtmov == 'Entradas' ) {	?>
							<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="entproduct_03.php?movh_id=<?Php echo $mhid ?> "><i class="glyphicon glyphicon-plus"></i>  Agregar Renglon</a>
						<?php  } else { ?>
							<a class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" href="entproduct_03_Sal.php?movh_id=<?Php echo $mhid ?> "><i class="glyphicon glyphicon-plus"></i>  Agregar Renglon</a>
						<?php }  ?>
								
					<?php } else { ?>
							
						<button class="btn btn-outline-<?php echo $classButtonHeader;?> btn-xs elevation-1" type="Submit" formaction="entproduct_03.php" formmethod="post" name="BotonAdd" disabled ><span class="glyphicon glyphicon-plus"></span> Agregar Renglon</button>
					<?php	 
					}
					?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>		

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-<?= $cstyle; ?> elevation-2">
						<div class="card-header elevation-1" style="background-color:#<?=$ccolor;?>">
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Movimientos de Materiales.:</font></b>
							<b><font color="#ffffcc" FACE="times new roman" size="4px">&nbsp; Renglones por Documento</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
								<div class="panel-heading">
									<div class="form-group">
										<label><font color="#990000" FACE="times new roman" size="3px">Almacen..:  </font></label>
										&nbsp;&nbsp;<label><font color="black" FACE="times new roman" size="3px"> <?Php echo $DCIA ." / ". $ZOND ." / ". $ZONU; ?></font></label>
									</div>
								</div>
				
								<!-- =========================== -->			
								<table border="1" width="100%">
								<thead>
								<tr height= '16px'>
								<th class="thx"><p>Nro. Documento</p></th>
								<th class="thx"><p>Tipo Documento</p></th>
								<th class="thx"><p>T.M.</p></th>
								<th class="thx"><p>Fecha Doc.</p></th>
								<th class="thx"><p>Ejercicio</p></th>
								<th class="thx"><p>Periodo</p></th>
								</tr>
								</thead>
								<tr>
									<td><b><input class="form-control2" style='text2-align:center' Type="text2" name="movh_doc" id="movh_doc" size='13'  value="<?Php echo $mhdoc; ?>" readonly /></b></td>
									<td><b><input class="form-control2" Type="text2" name="movh_tdoc" id="movh_tdoc" size='30' value="<?Php echo $mhtdoc;?>" color= 'blue'  readonly /></b></td>
									<td><b><input class="form-control2" style='text-align:center' type="text2" name="movh_tmov" id="movh_tmov" size='10' value="<?Php echo $mhtmov; ?>" readonly /></b></td>
									<td><input class="form-control2" type="date" name="movh_fecha" id="movh_fecha" size='12' value="<?Php echo $mhfecha; ?>" readonly /></td>
									<td><input class="form-control2" style="text-align:center" Type="text2" name="movh_ejer" id="movh_ejer" size='4' maxlength="4" value="<?Php echo $mhejer; ?>" readonly></td>
									<td><input class="form-control2" style='text-align:center' Type="text2" name="movh_per" id="movh_per" size='2' value="<?Php echo $mhper; ?>" readonly></td>
								</tr>
								</table>
							</div>
						</div>
						<br>
<!--  ======================================================================================= -->	
						<!--  <div class="panel-body">-->
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
									Where wh_movinvh.movh_id = '$IDX' ORDER BY wh_movinvd.product_cod ASC";
									//---------------------------------------------------------------
									?>
									<div class="col-sm-12 table-responsive">
										<form method="POST" action="act_cerrar_renglon.php">
										<table id="movd_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>							
										<thead>
										<tr height= '16px'>
											<th class="thy"></th>
											<th class="thy"><p>Cod. Material</p></th>
											<th class="thy"><p>Descripción</p></th>
											<th class="thy"><p>Cantidad</p></th>
											<th class="thy"><p>Unit ME</p></th>
											<th class="thy"><p>Tasa Cambio</p></th>
											<th class="thy"><p>Status</p></th>
											<th class="thy"><p>Acciones</p></th>		
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
		$status = '<span class=""><font color="green" >Abierto</font></span>';
		
		if($edit == '1' and $actua == '1')
		{
			if($mhtmov == 'ENTRADAS' ) {
				$accion = '<ul class="nav navbar-nav">
				<li class="dropdown btn-group">
				<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="entproduct_02V2.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>
					<li role="presentation" class="divider"></li>
					<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
				</ul></li></ul>';
			}
			if($mhtmov == 'SALIDAS' ) {
				$accion = '<ul class="nav navbar-nav">
				<li class="dropdown btn-group">
				<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="entproduct_02V2S.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>
					<li role="presentation" class="divider"></li>
					<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
				</ul></li></ul>';
			}			
			
		}	else	{
			
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

		<ul class="dropdown-menu dropdown-menu-right">
			<li class="disabled"><a href="entproduct_02.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>
			<li role="presentation" class="divider"></li>
			<li><a <button type="button" name="view" id="'.$Fila['movd_id'].'" class="view"><i class="fa fa-list" ></i> Detalle del Renglon</button></a></li>
		</ul></li></ul>';			
		}	
		
	}	else	{
		$status = '<span class=""><font color="red" >Cerrado</font></span>';
			
		$accion = '<ul class="nav navbar-nav">
		<li class="dropdown btn-group">
		<button type="button" class="butt-mesas btn-prima btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <span class="caret"></span></button>

		<ul class="dropdown-menu dropdown-menu-right">

		<li class="disabled"><a href="entproduct_02.php?movd_id='.$Fila['movd_id'].' "><i class="fa fa-edit"></i> Editar Renglon</a></li>

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
											<Td><?php echo $Fila['code']; ?></td>
											<Td><span class="text-wrap"><?php echo $Fila['movd_desc']; ?></span></td>
											<Td align="right"><?php echo number_format($Fila['movd_cant'], 2, ",", ".");?></td>
											<Td align="right"><?php echo number_format($Fila['movd_costou_me'], 3, ",", ".");?></td>
											<Td align="right"><?php echo number_format($Fila['movd_tasa_cambio'], 2, ",", ".");?></td>
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
						<!-- </div> -->
<!-- =================================================================================== -->	
						</div>
					</div>
				</div>	
			</div>		
		</div>			
	</section>
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
<!--  ======================================================================================= -->
        <div id="movinvcerrarModal" class="modal fade">
            <div class="modal-dialog modal-lg">
			
		
                <form action="entproduct_02C.php" method="post" id="movinvcerrar_form">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:teal">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><font color="#FFFFFF" FACE="times new roman" size="5px"><i class="fa fa-plus"></i> Detalle del Movimiento</font></h4>
                        </div>
                        <div class="modal-body">
						
							<div class="form-group">
								<b><font color="#990000" size="4px">Proceso para Cerrar Renglon de Movimiento de Productos</font></b>
							</div>
							
							
					<div class="form-group">
						<label><font color="blue" FACE="times new roman" size="3px">Ejercicio / Periodo....:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $mhejer ?></font>
						<label class="control-label"><font color="blue" FACE="times new roman" size="3px">--</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $mhper ?></font>
						<br>
						
						<label><font color="blue" FACE="times new roman" size="3px">Datos del Producto...:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $prod2 ?></font>
						<label class="control-label"><font color="blue" FACE="times new roman" size="3px">--</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $DESCP ?></font>
						<br>
						
						<label><font color="blue" FACE="times new roman" size="3px">Tipo de Movimiento.:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $DESCTM ?></font>
						<br>
						
						<label><font color="blue" FACE="times new roman" size="3px">Descripción Entrada:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $dmov ?></font>
						<br>
						
						<label><font color="blue" FACE="times new roman" size="3px">Cantidad Producto...:</font></label>	
						<font color="black" FACE="times new roman" size="3px">
						<font color='black' FACE="times new roman" size="3px"><?Php echo $mdcant ?></font>	
						
						&nbsp;<label><font color="blue" FACE="times new roman" size="3px">Costo Unitario:</font></label>
						<font color="black" FACE="times new roman" size="3px">
						<font color='black' FACE="times new roman" size="3px"><?Php echo number_format($mdcostou, 2, ",", ".") ?></font>
						
						&nbsp;<label><font color="blue" FACE="times new roman" size="3px">% IVA:</font></label>		
						<font color='black' FACE="times new roman" size="3px"><?Php echo $piva ?></font>
						</font>
						<br>
						
						<label><font color="blue" FACE="times new roman" size="3px">Recibe el Material....:</font></label>
						<font color='black' FACE="times new roman" size="3px"><?Php echo $rprod ?></font>
						</font>
						<br>
					</div>
					
                        </div>
                        <div class="modal-footer" style="background-color:#ecf9ec">

							

							
							<button class="btn btn-info btn-xs" type="Submit" id="BotonClose" name="BotonClose" onclick="('<?php echo $mhid?>');"><span class="glyphicon glyphicon-save"></span> Cerrar Renglon</button>
							
							<button type="button" class="btn btn-success btn-md" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<!--  ====================================-->
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
<!-- ************************************************************************* -->
</script>