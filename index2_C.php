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
    width: 915;
    height: 400;
    rx: 0;
    ry: 0;
}
</style>
<?php
if($_SESSION['type'] == 'Master')
{
echo '<FORM ACTION="" method="GET">';

$AA_HOY = date("Y");
	
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["AA"]))$AA = $_GET["AA"];
else $AA = '';
//-------------
if(isset($_GET["MM1"]))$MM1 = $_GET["MM1"];
else $MM1 = '';
//-------------
if(isset($_GET["MM2"]))$MM2 = $_GET["MM2"];
else $MM2 = '';
//-------------
if(isset($_GET["tm2"]))$tm2 = $_GET["tm2"];
else $tm2 = '';	
//------------ Ultimo Periodo -----------------------------------
//---------------------------------------------------------------
$SQL1 = "SELECT DISTINCT b.per_aa,  b.per_mm, CONCAT(b.per_aa, '-', b.per_mm) AS AAMM
FROM  (
	SELECT per_aa, MAX(per_mm) AS per_mm 
	FROM wh_periodos 
	 WHERE per_aa = YEAR(NOW()) 
	GROUP BY per_aa, per_mm 
) a
JOIN wh_periodos b ON a.per_aa = b.per_aa AND a.per_mm = b.per_mm; ";

$RegistroA = mysqli_query($link,$SQL1);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$PER_A = $FilaA["per_aa"];
$PER_M = $FilaA["per_mm"];
$PER_AM = $FilaA["AAMM"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>



<!-- <div id="rotacionanio240" style="min-width: 310px; max-width: 900px; height: 400px; margin: 280px; margin-top:20px;"></div> -->

<div class="content-wrapper">
	<div class="container-fluid">
		<br />
		<div class="col-lg-12">
			<section class="content">
				<div class="row">
					<div class="col-lg-8">
						<div class="panel panel-default elevation-2">
						<figure class="highcharts-figure">
							<div id="container1"></div>
							<!--<p class="highcharts-description"> </p> -->
						</figure>
						</div>
					</div>	
					
					<div class="col-lg-4">
						<?php include('function.php'); ?>
						<div class="container">
							<!--<div class="box elevation-2"> -->
							<div class="panel panel-default elevation-2">
								<div class="card-body">
									<div class="panel-body" align="center">
									<!------------------------------------>
										<div class="col-lg-12">
										<div class="input-group">
											<span class="input-group-text"><b>Compañia......: </b></span>
											<select class="form-control" name="CIA" onChange="javascrip:form.submit()">
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value "">Seleccione Empresa...</option>
												<?php
												//---------------------------------------------------------------<option hidden selected>Selecciona una opción</option>
												$SQL="SELECT c.id, c.company
												FROM wh_zones wz
												INNER JOIN companies c ON c.id = wz.zcompany_id
												GROUP BY c.id, c.company
												ORDER BY c.id ASC";
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
										<br>
										
										<div class="col-lg-12">
										<div class="input-group">
											<span class="input-group-text"><b>Ejercicio........:</b></span>
											<select class="form-control" name="AA" id = "xaa" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev" value="">Seleccione Ejercicio...</option>
												<?php
												//---------------------------------------------------------------
												//$SQL="SELECT ej_aa, company_id as ej_cia FROM wh.wh_ejercicios
												//where company_id = '$CIA' ";
												
												$SQL="SELECT DISTINCT ej_aa FROM wh_ejercicios";
												
												$Registro=mysqli_query($link, $SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($AA == $Fila["ej_aa"])echo 'selected ';
												echo 'value=' . $Fila["ej_aa"] .'>'. $Fila["ej_aa"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
										</div>
										<br>

										<div class="col-lg-12">
										<div class="input-group">
											<span class="input-group-text"><b>Periodo desde:</b></span>
											<select class="form-control" name="MM1" id = "xmm1" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * From wh_periodos 
												WHERE company_id = '$CIA' and per_aa = '$AA' and per_statu = 'Cerrado'";
												$Registro=mysqli_query($link, $SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($MM1 == $Fila["per_mm"])echo 'selected ';
												echo 'value=' . $Fila["per_mm"] .'>'. $Fila["per_mm"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
										</div>
										<br>
										
										<div class="col-lg-12">
										<div class="input-group">
											<span class="input-group-text"><b>Periodo hasta.:</b></span>
											<select class="form-control" name="MM2" id = "xmm2" onChange="javascrip:form.submit()" >
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<?php
												//---------------------------------------------------------------
												$SQL="Select * From wh_periodos 
												WHERE company_id = '$CIA' and per_aa = '$AA' and per_mm >= '$MM1'and per_statu = 'Cerrado' ";
												$Registro=mysqli_query($link, $SQL);
												//-------
												while ($Fila=mysqli_fetch_array($Registro)){
												//----
												echo '<option ';
												if($MM2 == $Fila["per_mm"])echo 'selected ';
												echo 'value=' . $Fila["per_mm"] .'>'. $Fila["per_mm"] . "\n";
												}
												mysqli_free_result ($Registro);
												//---------------------------------------------------------------
												?>									
											</select>
										</div>
										</div>										
										<!------------------------------------>
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
								$query0 = "SELECT mat.company_id, comp.company FROM wh_materials mat
								inner join companies comp on comp.id = mat.company_id
								group by mat.company_id ";	
								?>
								<div class="table d-none" >
									<table id="datatable" class="table table-bordered table-hover text-wrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
									  <thead>
									  <tr>
										<th></th>
										<th>Longkeda</th>
										<th>Integra Well Services, C.A.</th>
										<th>Xenix Services</th>
									  </tr>
									  </thead>
										<tbody>

									<?php
									if($CIA =='' and $AA == '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA_HOY' and per_statu = 'Cerrado'
										ORDER BY AAMM ASC ";
										} 
									if($CIA !='' and $AA == '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA_HOY'  and company_id = '$CIA' and per_statu = 'Cerrado'
										order by AAMM ASC ";
										}		 								
									if($CIA !='' and $AA != '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA'  and company_id = '$CIA' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 
									if($CIA !='' and $AA != '' and $MM1 != '' and $MM2 !='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA'  and company_id = '$CIA' and per_mm >= '$MM1' and per_mm <= '$MM2' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 
									if($CIA =='' and $AA != '' and $MM1 == '' and $MM2 =='')	
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 
																		
									$Registro1 = mysqli_query($link,$query1);
									while($Fila1 = mysqli_fetch_array($Registro1))
									{
										//$cia1 = $Fila1["company_id"];
										$ejer1 = $Fila1["per_aa"];
										$per1 = $Fila1["per_mm"];
										$aamm1 = $Fila1["AAMM"];
										
										//======================================================= 
										if($CIA =='' ) {
											$query3 = " SELECT sal.product_id, sal.product_cod, sal.company_id AS sal_company_id, aa_s, mat.cost_me AS costo_me, saldos_fp,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
											FROM wh_saldosm sal
											inner join wh_materials mat on mat.id = sal.product_id
											where aa_s = '$ejer1'
											order by sal.company_id ASC, aa_s ASC
											";										
										}
										if($CIA !='') {
											$query3 = " SELECT sal.product_id, sal.product_cod, sal.company_id AS sal_company_id, aa_s, mat.cost_me AS costo_me, saldos_fp,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
											FROM wh_saldosm sal
											inner join wh_materials mat on mat.id = sal.product_id
											where aa_s = '$ejer1' and sal.company_id = '$CIA' 
											order by sal.company_id asc, aa_s ASC
											";
										}									
										
										$TMX = 0;
										$TCIA1_M = '0';
										$TCIA1_MG = '0';
										$TCIA3_M = '0';
										$TCIA3_MG = '0';
										$TCIA16_M = '0';
										$TCIA16_MG = '0';
										$cost = '0';

									
										$Registro3 = mysqli_query($link,$query3);			
										while($row3 = mysqli_fetch_array($Registro3))
										{
											
											$TMX = 0;
											$TCIA1_M = 0;
											$TCIA3_M = 0;
											$TCIA16_M = 0;
											
											$cost = $row3["costo_me"];

											if ($per1 == '1'){$TMX = $row3["ENE"]; }
											if ($per1 == '2'){$TMX = $row3["FEB"]; }
											if ($per1 == '3'){$TMX = $row3["MAR"]; }
											if ($per1 == '4'){$TMX = $row3["ABR"]; }
											if ($per1 == '5'){$TMX = $row3["MAY"]; }
											if ($per1 == '6'){$TMX = $row3["JUN"]; }
											if ($per1 == '7'){$TMX = $row3["JUL"]; }
											if ($per1 == '8'){$TMX = $row3["AGO"]; }
											if ($per1 == '9'){$TMX = $row3["SEP"]; }
											if ($per1 == '10'){$TMX = $row3["OCT"]; }
											if ($per1 == '11'){$TMX = $row3["NOV"]; }
											if ($per1 == '12'){$TMX = $row3["DIC"]; }
											
																						
											if( $row3["sal_company_id"] == '1') {
												$TCIA1_M = $TMX * $cost;
												
											}
											if( $row3["sal_company_id"] == '3') {
												$TCIA3_M = $TMX * $cost;
												
											}
											if( $row3["sal_company_id"] == '16') {
												$TCIA16_M = $TMX * $cost;
											}
											$TCIA1_MG = ((INT)$TCIA1_MG + (INT)$TCIA1_M);
											$TCIA3_MG = ((INT)$TCIA3_MG + (INT)$TCIA3_M);
											$TCIA16_MG = ((INT)$TCIA16_MG + (INT)$TCIA16_M);								
										}
									//======================================================= $float_value_of_var = floatval("123.456");
									
										?>
										<tr>
											<td><?php echo $aamm1;?></td>
											<td><?php echo $TCIA1_MG;?></td>
											<td><?php echo $TCIA3_MG;?></td>
											<td><?php echo $TCIA16_MG;?></td>
										</tr>
										<?php
									} mysqli_free_result ($Registro3); 
									
										?>
										</tbody>
									</table>


								</div>
							</div>
						</div>
					</div>	
				</div>
			</section>
		
            <section class="content">
				<HR>
				<div class="row">
					
					<div class="col-lg-12">
						<div class="panel panel-default elevation-2">
						<div class="container-fluid" >
								<figure class="highcharts-figure">
									<div id="container2"></div>
								</figure>
							</div>
						</div>
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
								$query0 = "SELECT mat.company_id, comp.company FROM wh_materials mat
								inner join companies comp on comp.id = mat.company_id
								group by mat.company_id ";	
								?>
								<div class="table d-none" >
									<table id="datatable2" class="table table-bordered table-hover text-wrap dataTable dtr-inline mt-1 no-footer collapsed" role="grid" border='1'>
									  <thead>
									  <tr>
										<th>Periodo</th>
										<th>Accesorios</th>
										<th>Consumibles</th>
										<th>Explosivos</th>
										<th>Quimicos</th>
										<th>Tapon</th>
									  </tr>
									  </thead>
									  <tbody>			  
									<?php
									if($CIA =='' and $AA == '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA_HOY' and per_statu = 'Cerrado'
										ORDER BY AAMM ASC ";
										} 
									if($CIA !='' and $AA == '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA_HOY'  and company_id = '$CIA' and per_statu = 'Cerrado'
										order by AAMM ASC ";
										}		 								
									if($CIA !='' and $AA != '' and $MM1 == '' and $MM2 =='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA'  and company_id = '$CIA' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 
									if($CIA !='' and $AA != '' and $MM1 != '' and $MM2 !='')
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA'  and company_id = '$CIA' and per_mm >= '$MM1' and per_mm <= '$MM2' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 
									if($CIA =='' and $AA != '' and $MM1 == '' and $MM2 =='')	
										{
										$query1 = "SELECT distinct per_aa, per_mm, concat(per_aa,'-', per_mm) AS AAMM, per_statu FROM wh_periodos
										WHERE per_aa = '$AA' and per_statu = 'Cerrado'
										order by AAMM ASC ";										
										} 										
										
										//----------------------------
										$Registro1 = mysqli_query($link,$query1);
										while($Fila1 = mysqli_fetch_array($Registro1))
										{
										//print_r($Fila1);
										$ejer1 = $Fila1["per_aa"];
										$per1 = $Fila1["per_mm"];
										$aamm1 = $Fila1["AAMM"];
										
										//======================================================= 
										if($CIA =='') {
											$query3 = " SELECT sal.product_id, sal.product_cod, sal.company_id AS sal_company_id, aa_s, mat.cost_me AS costo_me, 
											saldos_fp, mat.type_tm2_id, tm2.name,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
											FROM wh_saldosm sal
											inner join wh_materials mat on mat.id = sal.product_id
											inner join wh_type_material2 tm2 on tm2.id = mat.type_tm2_id
											where aa_s = '$ejer1' 
											order by sal.company_id asc, aa_s ASC, mat.type_tm2_id ASC
											";										
										}										
										if($CIA !='') {
											$query3 = " SELECT sal.product_id, sal.product_cod, sal.company_id AS sal_company_id, aa_s, mat.cost_me AS costo_me, 
											saldos_fp, mat.type_tm2_id, tm2.name,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',2),'|',-1) AS ENE, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',3),'|',-1) AS FEB, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',4),'|',-1) AS MAR, 
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',5),'|',-1) AS ABR,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',6),'|',-1) AS MAY,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',7),'|',-1) AS JUN,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',8),'|',-1) AS JUL,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',9),'|',-1) AS AGO,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',10),'|',-1) AS SEP,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',11),'|',-1) AS OCT,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',12),'|',-1) AS NOV,
											SUBSTRING_INDEX(SUBSTRING_INDEX(saldos_fp,'|',13),'|',-1) AS DIC
											FROM wh_saldosm sal
											inner join wh_materials mat on mat.id = sal.product_id
											inner join wh_type_material2 tm2 on tm2.id = mat.type_tm2_id
											where aa_s = '$ejer1' and sal.company_id = '$CIA' 
											order by sal.company_id asc, aa_s ASC, mat.type_tm2_id ASC
											";										
										}										
											$TCIA1_MG = 0; $TMXG1 = 0;
											$TCIA2_MG = 0; $TMXG2 = 0;
											$TCIA3_MG = 0; $TMXG3 = 0;
											$TCIA4_MG = 0; $TMXG4 = 0;
											$TCIA5_MG = 0; $TMXG5 = 0;								
											$cost = '0';
										
										
										$Registro3 = mysqli_query($link,$query3);			
										while($row3 = mysqli_fetch_array($Registro3))
										{
											$TMX = 0;
											$TMX1 = 0;	$TMX2 = 0;	$TMX3 = 0;	$TMX4 = 0;	$TMX5 = 0;
											
											$cost = $row3["costo_me"];

											if ($per1 == '1'){$TMX = $row3["ENE"]; }
											if ($per1 == '2'){$TMX = $row3["FEB"]; }
											if ($per1 == '3'){$TMX = $row3["MAR"]; }
											if ($per1 == '4'){$TMX = $row3["ABR"]; }
											if ($per1 == '5'){$TMX = $row3["MAY"]; }
											if ($per1 == '6'){$TMX = $row3["JUN"]; }
											if ($per1 == '7'){$TMX = $row3["JUL"]; }
											if ($per1 == '8'){$TMX = $row3["AGO"]; }
											if ($per1 == '9'){$TMX = $row3["SEP"]; }
											if ($per1 == '10'){$TMX = $row3["OCT"]; }
											if ($per1 == '11'){$TMX = $row3["NOV"]; }
											if ($per1 == '12'){$TMX = $row3["DIC"]; }

											//======================================================= 
												if ($row3["name"] == 'ACCESORIOS'){
											$TMX1 = $TMX * $cost; 
											$TMXG1 = $TMXG1 + $TMX1;
											}
												if ($row3["name"] == 'CONSUMIBLES'){
											$TMX2 = $TMX * $cost; 
											$TMXG2 = $TMXG2 + $TMX2;
											}
												if ($row3["name"] == 'EXPLOSIVOS'){
											$TMX3 = $TMX * $cost; 
											$TMXG3 = $TMXG3 + $TMX3;
											}
												if ($row3["name"] == 'QUIMICOS'){
											$TMX4 = $TMX * $cost; 
											$TMXG4 = $TMXG4 + $TMX4;
											}
												if ($row3["name"] == 'TAPON'){
											$TMX5 = $TMX * $cost; 
											$TMXG5 = $TMXG5 + $TMX5;
											}
										}
											$TCIA1_MG = ((INT)$TCIA1_MG + (INT)$TMXG1);
											$TCIA2_MG = ((INT)$TCIA2_MG + (INT)$TMXG2);
											$TCIA3_MG = ((INT)$TCIA3_MG + (INT)$TMXG3);
											$TCIA4_MG = ((INT)$TCIA4_MG + (INT)$TMXG4);
											$TCIA5_MG = ((INT)$TCIA5_MG + (INT)$TMXG5);
										//=======================================================
										?>
										<tr>
											<td><?php echo $aamm1;?></td>
											<td><?php echo $TCIA1_MG;?></td>
											<td><?php echo $TCIA2_MG;?></td>
											<td><?php echo $TCIA3_MG;?></td>
											<td><?php echo $TCIA4_MG;?></td>
											<td><?php echo $TCIA5_MG;?></td>
										</tr>
										<?php
									} mysqli_free_result ($Registro3); ?>
										</tbody>
									</table>

								</div>
							</div>
							
						</div>	
					</div>
				</div>
			</section>			
						
		</div>
	</div>	
</div>


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

Highcharts.chart('container1', {
//Highcharts.chart('rotacionanio240', {  
colors: ['#ff6100','#0257b9','#C2000C', '#AA4643'],
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
        text: 'Consolidado Periodos'
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
            text: 'Amount'
        }
    }
});

</script>

<script>

Highcharts.chart('container2', {
	credits: {
		enabled: false
	},
    chart: {
        type: 'column'
    },

    title: {

        text: 'Detalle Compañias Tipos de Materiales',
        align: 'center'
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
        min: 0,
        title: {
            text: 'Amount'
        }
    },
	
 //       plotOptions: {
 //           series: {
 //               colorByPoint: true
 //           }
 //       },

 //   tooltip: {
 //       format: '<b>{key}</b><br/>{series.name}: {y}<br/>' +
 //           'Total: {point.stackTotal}'
 //   },

 //  plotOptions: {
 //       column: {
 //           stacking: 'normal'	
 //       }
 //   },


    data: {
        table: 'datatable2'
    },
});

</script>