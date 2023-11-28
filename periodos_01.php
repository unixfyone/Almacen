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
<HTML>
<HEAD>
<TITLE>Periodos</TITLE>

<link rel="stylesheet" type="text/css" href="cssi/styles.css" />

<style>
p {
    margin-top: 0.4em;
    margin-bottom: 0em;
	height: 25px;
}

</style>

<style type="text/css">
table, td, th {border: 2px solid #CCCCCC;}

th {background-color: #005266;
	color: white;
	text-align: center;
	font-family: Verdana, Helvetica, sans-serif;
	font-size: 14px;
}
td {font-size: 15px;}

table.border, td.border {border: 0px;}

.thx {
    color: black;
	font-size:15px;
	background-color:#cccccc;
	border-color: white;
	text-align:center;
	}
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php

//---------------------------------------------------------------
echo '<FORM ACTION="" method="GET">';

//-------------
if(isset($_GET["CIA"]))$CIA = $_GET["CIA"];
else $CIA = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//---------------------------------------------------------------
?>

<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Périodos
					</font></b></h1>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Control de Périodos</font></b>
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
												$SQL="Select uz.*, co.id, co.company FROM wh_user_zones uz
												INNER JOIN companies co ON co.id = uz.uzcompany_id
												WHERE uz.user_id = '$userid' and uz.userz_statu = 'Activo' 
												GROUP BY uz.uzcompany_id
												";
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
												$SQL="Select * FROM wh_user_zones 
												INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
												WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$CIA' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
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
							</div>
							<br>
							<?php
							if ($CIA != '' and $ZON != '')
							{ ?>
							<hr>						
							</FORM>
							<div align="center">
								<br>
								<label><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px"><b>Périodos</b></font></label>
								<?php
								//---------------------------------------------------------------
								echo '<FORM ACTION="periodos_03.php" method="Post">';

								//---------------------------------------------------------------
								$SQL = "SELECT * FROM wh_periodos 
								INNER JOIN wh_ejercicios ON wh_ejercicios.ej_aa = wh_periodos.per_aa
								WHERE wh_periodos.company_id = '$CIA' and wh_periodos.zone_id = '$ZON'
								ORDER BY wh_periodos.per_mm DESC ";
								
								//---------------------------------------------------------------
								?>
								<Input Type="hidden" name="CIA" value="<?Php echo $CIA ?>">
								<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
								
								<table class="blueTable" align="center" width='55%'>
								<thead>
								<tr>
								<th class="thx"><p> Nro </p></th>
								<th class="thx"><p> Cia </p></th>
								<th class="thx"><p> Almacén </p></th>
								<th class="thx"><p> Año </p></th>
								<th class="thx"><p> Mes </p></th>
								<th class="thx"><p> Status </p></th>
								</tr>
								</thead>
								<?php
								//-------------------------------
								$contador = 0;

								$Registro = mysqli_query($link,$SQL);
								while($Fila = mysqli_fetch_array($Registro))
								{
								$contador++;
								echo "<Tr>";
								echo "<Td bgcolor='#EEEEEE' align=Center>" . $contador;
								echo "<Td bgcolor='#EEEEEE' Align=Center><font size=2>" . $Fila['company_id'];
								echo "<Td bgcolor='#EEEEEE' Align=Center><font size=2>" . $Fila['zone_id'];
								echo "<Td bgcolor='#EEEEEE' Align=Center><font size=2>" . $Fila['per_aa'];
								echo "<Td bgcolor='#EEEEEE' Align=Center><font size=2>" . $Fila['per_mm'];
								if ($Fila['per_statu'] == "Cerrado")
								{
								echo "<Td bgcolor=FFFFFF align=Center><font color='Red'>" . "Cerrado";
								echo "</font>";
								} else {
								echo "<td bgcolor=ffffff align=Center><font color='Blue'><A HREF=\"periodos_02.php?AA=" .$Fila['per_aa']."&MM=" .$Fila['per_mm']."\">";
								echo "Abierto</a></td>";
								echo "</font>";
								}
								echo "</tr>";
								}
								mysqli_free_result ($Registro);

								echo "</Table>";

								mysqli_close($link);

								?>
								<br>
								<div align="center">
									<button class="btn btn-outline-<?php echo $classButtonFooter; ?> btn-sm" Type="Submit" name="BotonADD"><i class="fa fa-plus"></i> Activar Periodo</button>
								</div>
								<br><br>
								</FORM>
							</div>
						<?php } ?>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>
	</section>		
<!-- =================================================================================== -->
</div>	
</BODY>
</HTML> 