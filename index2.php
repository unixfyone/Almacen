<?php
include('database_connection.php');
include('headerx.php');
include('unico.php');
?>
<link rel="stylesheet" href="css/cssg.css" />
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
.panel-body {
	padding: 15 px;
}
lement.style {
    height: auto;
}
rect[Attributes Style] {
    fill: rgb(255, 255, 255);
    filter: none;
    x: 0;
    y: 0;
    width: 1000;
    height: 500;
    rx: 0;
    ry: 0;
}
.box {
  border: 0px solid;
  height:492px;
  width: 550px;
}
</style>
<?php


if($_SESSION['type'] == 'Master')
{
echo '<FORM ACTION="" method="GET">';		
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
if(isset($_GET["tm2"]))$tm2 = $_GET["tm2"];
else $tm2 = '';
?>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="col-lg-12">
            <section class="content">
				<br>
				<div class="row">
					<div class="col-lg-7">
						<div class="container-fluid" >
							<div class="panel panel-default elevation-2">
								<figure class="highcharts-figure">
									<div id="container"></div>
								</figure>
							</div>
						</div>
					</div>

				    <div class="col-lg-5">
						
					    <?php include('function.php'); ?>
					    <br>
						<div class="container">
							<!--<div class="box elevation-2"> -->
							<div class="panel panel-default elevation-2">
								<div class="card-header elevation-1" style="background-color:#1F2937">
									<div class="panel-heading"><b><font color="#FFFFFF" size="4px">Consolidado por Compañia</font></b></div>
								</div>
								<div class="card-body">
									<div class="panel-body" align="center">
										<?php echo get_consolidado_cias($connect); ?>
									</div>							
								</div>
							</div>
							<!--</div> -->
						</div>
						
					</div>
				</div>
			</section>

			<section class="content">
				<div class="col-lg-12">
					<div class="row">
						<div class="container-fluid" >
							<div class="panel panel-default elevation-2">
								<?php
								$query1 = "SELECT mat.company_id, comp.company FROM wh_materials mat
								inner join companies comp on comp.id = mat.company_id
								group by mat.company_id ";	
								?>
								<div class="table d-none" >
									<table id="datatable" class="table table-bordered table-hover text-wrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
									  <thead>
									  <tr>
										<th></th>
										<th>Accesorios</th>
										<th>Consumibles</th>
										<th>Explosivos</th>
										<th>Quimicos</th>
										<th>Tapon</th>
									  </tr>
									  </thead>
									  <tbody>			  
									<?php
									//----------------------------
									$Registro1 = mysqli_query($link,$query1);
									while($Fila1 = mysqli_fetch_array($Registro1))
									{
										$IDCIA = $Fila1["company_id"];
										
										$query2 = "SELECT mat.company_id, comp.company, tm2.name, mat.type_tm2_id, 
											sum(mat.cost_me * mat.existence) as gtotal FROM wh_materials mat
											inner join wh_type_material2 tm2 on tm2.id = mat.type_tm2_id
											inner join companies comp on comp.id = mat.company_id
											where mat.company_id = '$IDCIA'
											group by mat.company_id, mat.type_tm2_id
											";
											
											$DCIA2 = '';
											$TMX1 = 0;
											$TMX2 = 0;
											$TMX3 = 0;
											$TMX4 = 0;
											$TMX5 = 0;	
											
										$Registro2 = mysqli_query($link,$query2);		
										while($Fila2 = mysqli_fetch_array($Registro2))
										{
											$IDCIA2 = $Fila2["company_id"];
											$DCIA2 = $Fila2["company"];						
											$mt2Y = $Fila2["type_tm2_id"];
											$DESCTM2X = $Fila2["name"];
											$MONTOG = intval($Fila2["gtotal"]*1000)/1000;
											//======================================================= //echo "<pre>"; print_r($query2); exit();
												if ($Fila2["name"] == 'ACCESORIOS'){
											$TMX1 = $MONTOG; }
												if ($Fila2["name"] == 'CONSUMIBLES'){
											$TMX2 = $MONTOG; }
												if ($Fila2["name"] == 'EXPLOSIVOS'){
											$TMX3 = $MONTOG; }
												if ($Fila2["name"] == 'QUIMICOS'){
											$TMX4 = $MONTOG; }
												if ($Fila2["name"] == 'TAPON'){
											$TMX5 = $MONTOG; }
										}
										//=======================================================	
																					
										?>
										<tr>
											<th><?php echo $DCIA2;?></th>
											<td><?php echo $TMX1;?></td>
											<td><?php echo $TMX2;?></td>
											<td><?php echo $TMX3;?></td>
											<td><?php echo $TMX4;?></td>
											<td><?php echo $TMX5;?></td>
										</tr>
										<?php
									} mysqli_free_result ($Registro1); ?>
										</tbody>
									</table>
								</div>
							</div>
							
						</div>	
					</div>
				</div>
			</section>
			<br>
			
			<div class="panel-body">
				<div class="container-fluid">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<span class="input-group-addon"><font color="blue" ><b>Compañia: </b></font></span>
									<select class="form-control" name="CIA" onChange="javascrip:form.submit()">
										<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
										<?php
										//---------------------------------------------------------------
										$SQL="Select * FROM companies";
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
								<div class="form-group">
									<span class="input-group-addon"><font color="blue"><b>Tipo de Inventario: </b></font></span>
									<select name="tm2" class="form-control" onChange="javascrip:form.submit()">
										<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value=""></option>
										<?php
										//---------------------------------------------------------------
										$SQL="Select * FROM wh_type_material2";
										//---------------------------------------------------------------
										$Registro=mysqli_query($link,$SQL);
										//-------
										while ($Fila=mysqli_fetch_array($Registro)){
										//----
										echo '<option ';
										if($tm2 == $Fila["id"])echo 'selected ';
										echo 'value=' . $Fila["id"] .'>'. $Fila["name"] . "\n";
										}
										mysqli_free_result ($Registro);
										//---------------------------------------------------------------
										?>
									</select>						
								</div>
							</div>
						</div>	
					</div>		
				</div>
			</div>			
			<section class="content">				
				<div class="col-lg-12">
					<div class="container-fluid">
						<div class="panel panel-default elevation-2">
							<div class="card-header elevation-2" style="background-color:#1F2937">
								<div class="panel-heading">
									<b><font color="#FFFFFF" size="4px">Detalle Consolidado por tipo de Inventario</font></b>
								</div>
							</div>
							<div class="card-body">
								<div class="panel-body" align="center">
									<?php
									if($CIA !='' and $tm2 == '')
									{
									$SQL = "SELECT comp.company, mat.description_m, unim.name AS nameum, lin.namel, mat.id AS matid, tmx.name AS nametm2, cla.name AS namecl2, cost_me, existence, 
									(cost_me * existence) AS totalg FROM wh_materials mat
									INNER join companies comp on comp.id = mat.company_id
									left join wh_measurement_units unim on unim.id = mat.wh_measurement_unit_id_m
									left join wh_lines lin on lin.id = mat.wh_line_id_m
									left join wh_type_material2 tmx on tmx.id = mat.type_tm2_id
									left join wh_clasificacion_tm2 cla on cla.id = mat.clas_tm2_id
									WHERE mat.company_id = '$CIA' and mat.existence > 0
									ORDER BY mat.company_id ASC, mat.code ASC
									";
									}
									//----------------------------								
									if($CIA =='' and $tm2 != '') {
									$SQL = "SELECT comp.company, mat.description_m, unim.name AS nameum, lin.namel, mat.id AS matid, tmx.name AS nametm2, cla.name AS namecl2, cost_me, existence, 
									(cost_me * existence) AS totalg FROM wh_materials mat
									INNER join companies comp on comp.id = mat.company_id
									left join wh_measurement_units unim on unim.id = mat.wh_measurement_unit_id_m
									left join wh_lines lin on lin.id = mat.wh_line_id_m
									left join wh_type_material2 tmx on tmx.id = mat.type_tm2_id
									left join wh_clasificacion_tm2 cla on cla.id = mat.clas_tm2_id
									WHERE mat.type_tm2_id = '$tm2' and mat.existence > 0
									ORDER BY mat.company_id ASC, mat.code ASC
									";
									}
									//----------------------------
									if($CIA !='' and $tm2 != '')
									{
									$SQL = "SELECT comp.company, mat.description_m, unim.name AS nameum, lin.namel, mat.id AS matid, tmx.name AS nametm2, cla.name AS namecl2, cost_me, existence, 
									(cost_me * existence) AS totalg FROM wh_materials mat
									INNER join companies comp on comp.id = mat.company_id
									left join wh_measurement_units unim on unim.id = mat.wh_measurement_unit_id_m
									left join wh_lines lin on lin.id = mat.wh_line_id_m
									left join wh_type_material2 tmx on tmx.id = mat.type_tm2_id
									left join wh_clasificacion_tm2 cla on cla.id = mat.clas_tm2_id
									WHERE mat.company_id = '$CIA' and mat.type_tm2_id = '$tm2' and mat.existence > 0
									ORDER BY mat.company_id ASC, mat.code ASC
									";										
									}
									//----------------------------
									if($CIA =='' and $tm2 == '')
									{
									$SQL = "SELECT comp.company, mat.description_m, unim.name AS nameum, lin.namel, mat.id AS matid, tmx.name AS nametm2, cla.name AS namecl2, cost_me, existence, 
									(cost_me * existence) AS totalg FROM wh_materials mat
									INNER join companies comp on comp.id = mat.company_id
									left join wh_measurement_units unim on unim.id = mat.wh_measurement_unit_id_m
									left join wh_lines lin on lin.id = mat.wh_line_id_m
									left join wh_type_material2 tmx on tmx.id = mat.type_tm2_id
									left join wh_clasificacion_tm2 cla on cla.id = mat.clas_tm2_id
									WHERE  mat.company_id = ''
									ORDER BY mat.company_id ASC, mat.code ASC
									";
									} ?>
									<div class="table">
										<table id="materials_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
										  <thead>
										  <tr>
											<th>Empresa</th>
											<th>Descripción</th>
											<th>Uni-Med</th>
											<th>Línea</th>
											<th>Tipo Inv</th>
											<th>Clasificación</th>
											<th>Costo</th>
											<th>Existencia</th>
											<th>Total</th>
										  </tr>
										  </thead>
										  <tbody>			  
											<?php
											$Registro2 = mysqli_query($link,$SQL);
											while($Fila2 = mysqli_fetch_array($Registro2))
											{
												?>								
												<Tr height= '16px'>
												<Td><font size="2px"><?php echo $Fila2['company']; ?></font></td>
												<Td><span class="text-wrap"><font size="2px"><?php echo $Fila2['description_m']; ?></font></span></td>
												<Td><font size="2px"><?php echo $Fila2['nameum'];?></font></td>
												<Td><font size="2px"><?php echo $Fila2['namel'];?></font></td>
												<Td><font size="2px"><?php echo $Fila2['nametm2'];?></font></td>
												<Td><font size="2px"><?php echo $Fila2['namecl2'];?></font></td>
												<Td><font size="3px"><?php echo number_format($Fila2['cost_me'], 2, ',','.');?></font></td>
												<Td><font size="3px"><?php echo $Fila2['existence'];?></font></td>
												<Td><font size="3px"><?php echo number_format($Fila2['totalg'], 2, ',','.');?></font></td>
												</tr>
										<?php
										} mysqli_free_result ($Registro2); ?>
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
	</div>
</div>

</FORM>
	<?php 
//=============================================================================
	} else {
	session_start();
	session_destroy();
	?>
	
<script type="text/javascript">
window.close(); 
</script>

<?php 	}  ?>
	
<script>
$(document).ready(function(){
	
	$('#materials_data').DataTable({
		
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
				"targets":[],
				"orderable":false,
			},
		],
		"pageLength": 25
	});	
	
	
})
</script>
<script>
Highcharts.chart('container', {
	
	credits: {
		enabled: false
	},
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Consolidado General'
    },
    subtitle: {
        text:
            'Source: <a href="" target="_blank">UnixFyOne</a>'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Monto USD'
        }
    }
});
</script>