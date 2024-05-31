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
<HTML>
<HEAD>
<title>Materiales</title>

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
 <link rel="stylesheet" href="css/styles-wh.css">

<style type="text/css">
.border {
    border: 1px solid #<?=$ccolor;?>;
}
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php

echo '<FORM name="" ACTION="" method="">';
//---------------------------------------------------------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["LIN"]))$LIN = $_GET["LIN"];
else $LIN = '';
//-------------
if(isset($_GET["prod"]))$prod = $_GET["prod"];
else $prod = '';
//-------------
if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
else $CT1 = '0';

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
$SQL = "SELECT * FROM wh_lines
Where id = '$LIN' ";
$RegistroA = mysqli_query($link,$SQL);
while($row = mysqli_fetch_array($RegistroA))
{
$acronym = $row["acronym"];
$namel = $row["namel"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2 class="m-0"><font color="#<?=$ccolor;?>" >Materiales Almacen
					</font></h2>
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
							<font color="#FFFFFF" size="5px">Agregar Material</font>
						</div>
						<!-- /.card-header -->

						<div class="card-body">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Compañia.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $DCIA ; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Almacén.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $ZOND ." / ". $ZONU; ?></font></span>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label><font color="blue" size="4px">Línea.:  </font></label>
											&nbsp;&nbsp;<span><font color="black" size="4px"> <?Php echo $namel; ?></font></span>
										</div>
									</div>	
								</div>	
							</div>
						</div>
						
					</div>
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
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
											<span class="input-group-text"><b>Código-Descripción:</b></span>
											<b><input class="form-control" type="text" name="prod" id="prod" size="30" maxlength="45" value="<?Php echo $prod ?>" placeholder="Palabra de busqueda" ></b>
											<span class="input-group-btn">
											<button class="btn btn-default" title="Buscar" name="boton1" type="bottom"><i class="w3-margin-left fa fa-search"></i></button></span>
										</div>
									</div>
								</div>
								</FORM>
								<!-- =============================== -->

								<?php
								if (isset($_GET["boton1"])  and $_GET["prod"] != '')
								{
								//---------------------------------------------------------------
								$aKeyword = explode(" ", $_GET['prod']);
								$SQL ="SELECT * FROM wh_master_materials 
								INNER JOIN wh_categories on wh_categories.cat_id = wh_master_materials.wh_category_id
								WHERE wh_master_materials.wh_line_id = '$LIN' and
								wh_master_materials.code like '%" . $aKeyword[0] . "%' OR 
								wh_master_materials.wh_line_id = '$LIN' and
								wh_master_materials.description like '%" . $aKeyword[0] . "%' OR
								wh_categories.category like '%" . $aKeyword[0] . "%' and
								wh_master_materials.wh_line_id = '$LIN'
								";
								//---------------------------------------------------------------
								echo "<br>";
							
								echo "<font color='#$ccolor;' size='4px'><b>Lista de Materiales</b></font>";
								?>
								<Table id="busq_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border='1'>
								
								<thead><tr height= '16px'>
								<TH>Código</th>
								<TH style='text-align:Left'>Descripción</th>
								<TH>Categoria</th>
								<TH><p>statu</th>
								</TR></thead>
								
								<?php

								$Registro2 = mysqli_query($link,$SQL);
								while($Fila = mysqli_fetch_array($Registro2))
								{
								//=============================
								if($Fila['m_statu'] == 'Activo')
								{
									$status = '<span class=""><font color="blue" size="3px">Activo</font></span>';
								}	else	{
									$status = '<span class=""><font color="red" size="3px">Inactivo</font></span>';
								}
								//=============================
								$GRPXD = '';
								$prodid = $Fila["id"];
								$prod2X = $Fila["code"];
								$GRPXD =  $Fila["category"];
								//=============================
								
								echo "<Tr>";
								//-------
								if($Fila['m_statu'] != 'Activo')
								{
								echo "<Td Align=Left>" . $Fila['code'];	
								}	else	{	
								echo "<td><a href=\"materiales2B.php?IDX=$CIA&ZOX=$ZON&LIX=$LIN&CP=$prod2X \">$prod2X</a></td>";
								}
								echo "<Td Align=Left><span class='text-wrap'>" . $Fila['description'];
								echo "<Td Align=Center>" . $GRPXD;
								echo "<Td Align=Center>" . $status;
								echo "</TR>";
								//---------------
								}
								//---------------
								mysqli_free_result ($Registro2);

								echo "</Table>";
								?>
								</FORM>
								<?php } ?>
								<!-- ======================================= -->

								<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
								<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
								<Input Type="hidden" name="LIN" value="<?Php echo $LIN ?>">
						
								<div class="modal-footer" style="background-color:#FFFFFC">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
								</div>			
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>				
</div>
</FORM>						
</BODY>
<script>
$(document).ready(function(){
<!-- ********************* Lista de Registros ******************************** -->
	$('#busq_data').DataTable({
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
				"targets":[3],
				"orderable":false,
			},
		],
		"pageLength": 10
	});
<!-- ************************************************************************* -->	
});
</script>
</HTML> 