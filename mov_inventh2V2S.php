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
<HTML>
<HEAD>
<title>Materiales</title>

<link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
<link rel="stylesheet" href="css/styles-wh.css">
	
<style type="text/css">
.border {
    border: 1px solid #<?=$ccolor;?>;
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
</style>
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php
echo '<FORM ACTION="act_movinventh.php" method="Post">';
//---------------------------------------------------------------
if(isset($_GET["CIAX"]))$CIAX = $_GET["CIAX"];
else $CIAX = '';
//-------------
if(isset($_GET["ZON"]))$ZON = $_GET["ZON"];
else $ZON = '';
//-------------
if(isset($_GET["MID"]))$MID = $_GET["MID"];
else $MID = '';
//-------------
if(isset($_GET["movh_tentrega"]))$movh_tentrega = $_GET["movh_tentrega"];
else $movh_tentrega = '';
//-------------
if(isset($_GET["movh_tdoc"]))$movh_tdoc = $_GET["movh_tdoc"];
else $movh_tdoc = '';
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
$cont_em = $FilaA["zone_doc_em"];
$cont_sm = $FilaA["zone_doc_sm"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
	$SQLp = "SELECT zone_id, per_aa, per_mm, fec_min, fec_max, Count(per_statu) AS Cuenta1 FROM wh_periodos 
	WHERE per_statu = 'Abierto' and zone_id = '$ZON' 
	group by per_aa, per_mm, fec_min, fec_max";

	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
	while ($Filap=mysqli_fetch_array($Registrop))
	{	
		$AA_P = $Filap["per_aa"];
		$MM_P = $Filap["per_mm"];
		$CTA2 = $Filap["Cuenta1"];
		$fechamin = $Filap["fec_min"];
		$fechamax = $Filap["fec_max"];
	}
	mysqli_free_result ($Registrop);
//---------------------------------------------------------------
//---------------------------------------------------------------
 if ($MID == 'SALIDAS' ) {
	  
 if ($cont_sm < 10000 ) {
 $cont_sm1 = str_pad($cont_sm, 5, "0", STR_PAD_LEFT);
 } else { 
 $cont_sm1 = $cont_sm;
 }
 $cont_doc = "SM".'-'.$cont_sm1;
 }

?>
<Input Type="hidden" name="CIAX" value="<?Php echo $CIAX ?>">
<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
<Input Type="hidden" name="MID" value="<?Php echo $MID ?>">
<Input Type="hidden" name="movh_tdoc" value="<?Php echo $movh_tdoc ?>">
<Input Type="hidden" name="movh_tentrega" value="<?Php echo $movh_tentrega ?>">

<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<!--<span id="alert_action"></span> -->
<div class="content-wrapper">
    <!-- Main content -->
	<br>
	<section class="content">
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
											&nbsp;&nbsp;<span><b><font color="red" size="4px"> <?Php echo $MID; ?></font></b></span>
										</div>
									</div>								
								</div>
								<hr class="elevation-2" color="#CCCCCC" >
								<?Php include_once('function.php'); ?>
								<!-- =============================== -->
								<?php	if ($CTA2 > '0')		// Existen Periodos Abiertos
								{ ?>
								<div class="row">  
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Nro.Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="text" maxlength="15" name="movh_doc" id="movh_doc" class="form-control" placeholder="Nra. del Documento" value="<?Php echo $cont_doc ?>" readonly />
											</div>
										</div> 
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font size="3px"> Ejercicio-Periodo.:</font></label>
											<div class="input-group-prepend">
												<input type="text" name="movh_ejer" id="movh_ejer" style="text-align:center" class="form-control" value="<?Php echo $AA_P ?>" readonly ></input>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="text" name="movh_per" id="movh_per" style="text-align:center" class="form-control" value="<?Php echo $MM_P ?>" readonly ></input>
											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"> Fecha del Documento.:</font></label>
											<div class="input-group-prepend">
												<input type="date" name="movh_fecha" id="movh_fecha" min="<?= $fechamin; ?>" max="<?= $fechamax; ?>" class="form-control" required />
											</div>
										</div> 
									</div>										
									<div class="col-sm-4">
										<div class="form-group">
											<label><font size="3px"> Tipo de Documento.:</font></label>
											<select name="tm_id" class="form-control" required />
												<option value=""></option>
												<?php echo fill_tipmov_list($connect, $MID); ?>
											</select>
										</div>                                 
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label><font FACE="times new roman" size="3px"><i class="fa fa-clock-o "></i> Orden de Salida.:</font></label>						
											<div class="input-group-prepend">
												<input type="text" name="movh_oc" id="movh_oc" maxlength="45" class="form-control" placeholder="Nro. de Orden de Compra" />
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-4">
										<div class="input-group">
											<label><font color="#505050" size="3px"> Tipo de Entrega</font></label>
											<select name="movh_tentrega" id="movh_tentrega" class="form-control" required>
											<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"></option>
												<option value="NO-APLICA">NO-APLICA</option>
												<option value="TRASLADO">TRASLADO</option>
												<option value="DEVOLUCION">DEVOLUCION</option>
												<option value="DESINCORPORACION">DESINCORPORACION</option>
											<select>												
										</div>
									</div>
							
									<div class="col-sm-2">
										<div class="input-group">
											<label class="input-group-text"><font color="#990000" size="3px"> Receptor externo:</font></label>
											<input type="checkbox" id="check" onchange="javascript:showContent()" />
										</div>
									</div>
							
									<div id="content" style="display: none;" class="col-sm-6">
										<div class="input-group">
											<label><font FACE="times new roman" size="3px"> Material Recibido por.:</font></label>
											<input type="text" maxlength="60" name="movh_receptor" id="movh_receptor" class="form-control" placeholder="Receptor del Material" />
										</div>
									</div>
								</div>
							</div>

							<br>
							<div id="content2" style="display: block;" class="col-sm-12">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label class="input-group-text"><font color="#505050" size="3px">Compañia del Receptor.:</font></label>
											<div class="input-group-prepend">
												<select name="company_id" id="company_id" class="form-control">
												<option value="">Seleccionar Compañia</option>
												<?php echo fill_companies_list($connect); ?>
												</select>
											</div>
										</div>
									</div>								
									<div class="col-lg-4">
										<div class="form-group">
											<label class="input-group-text"><font color="#505050" size="3px">Departamento del Receptor.:</font></label>
											<div class="input-group-prepend">
												<select name="department_id2" id="department_id2" class="form-control">
												<option value="">Seleccionar Departamento</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label class="input-group-text"><font color="#505050" size="3px"> Receptor...:</font></label>
											<div class="input-group-prepend">
												<select name="user_receptor" id="user_receptor" class="form-control" >
													<option value="">Seleccionar Usuario</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="input-group">
										<label class="input-group-text"><font color="#505050" size="3px">Departamento Despachador:</font></label>
										<select name="department_id" id="department_id" class="form-control" required>
											<option value="">Seleccionar Departamento</option>
											<?php echo fill_departments_list($connect, $CIAX); ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group">
										<label class="input-group-text"><font color="#505050" size="3px">Usuario Despachador:</font></label>
										<select name="user_despachador" id="user_despachador" class="form-control"  required>
											<option value="">Seleccionar Usuario</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="input-group">
										<label class="input-group-text"><font color="#505050" size="3px">Departamento Aprobador:</font></label>
										<select name="department_id3" id="department_id3" class="form-control" required>
											<option value="">Seleccionar Departamento</option>
											<?php echo fill_departments_list($connect, $CIAX); ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group">
										<label class="input-group-text"><font color="#505050" size="3px">Usuario Aprobador:</font></label>
										<select name="user_aprobador" id="user_aprobador" class="form-control"  required>
											<option value="">Seleccionar Usuario</option>
										</select>
									</div>
								</div>
							</div>


							<Input Type="hidden" name="CIAX"  id="CIAX" value="<?Php echo $CIAX ?>">
							<Input Type="hidden" name="ZON" value="<?Php echo $ZON ?>">
							<Input Type="hidden" name="MID" value="<?Php echo $MID ?>">
							
							<div class="modal-footer" style="background-color:#FFFFFC">
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" formaction="act_movinventh.php" formmethod="post" type="submit" id="BotonAdd" name="BotonAdd"><span class="fa fa-edit"></span> Agregar</button>
								
								<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="glyphicon glyphicon-arrow-left"></span> Retornar</button>
							</div>
							<?php } else {?>
							
							<div class="modal-dialog modal-md"">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Agregar Documentos</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
								<div class="modal-body">
									<div class="alert alert-danger">
										<strong>Atencion.! </strong> No Existe Ningun Periodo Abierto .....
									</div>
								</div>
								<div class="modal-footer">
									<button class='btn btn-outline-<?php echo $classButtonFooter; ?>' type='button' name='Cancel' onclick='window.history.go(-1)' data-dismiss="modal"><span class="fa fa-times"></span> Cerrar</button>
								</div>
							</div>								
							<?php } ?>
						</div>
					</div>
				</div>		
			</div>			
		</div>
	</section>					
</div>
</FORM>


	
<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
		element2 = document.getElementById("content2");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
			document.getElementById('company_id').value = '';
			document.getElementById('department_id2').value = '';
			document.getElementById('user_receptor').value = '';
			element2.style.display='none';
        }
        else {
			document.getElementById('movh_receptor').value = '';
            element.style.display='none';
			element2.style.display='block';
        }
    }
</script>
<script>
$(document).ready(function(){
<!-- ********************* Lista para Usuarios/departamento **************** -->
$('#department_id').change(function(){
        var department_id = $('#department_id').val();
		var CIAX = $('#CIAX').val();

        var btn_action = 'load_usuarios';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id:department_id, CIAX:CIAX, btn_action:btn_action},
            success:function(data)
            {
                $('#user_despachador').html(data);
            }
        });
    });
$('#department_id2').change(function(){
        var department_id2 = $('#department_id2').val();
		var company_id = $('#company_id').val();
        var btn_action = 'load_usuarios2';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id2:department_id2, company_id:company_id, btn_action:btn_action},
            success:function(data)
            {
                $('#user_receptor').html(data);
            }
        });
    });
$('#department_id3').change(function(){
        var department_id3 = $('#department_id3').val();
		var CIAX = $('#CIAX').val();
        var btn_action = 'load_usuarios3';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{department_id3:department_id3, CIAX:CIAX, btn_action:btn_action},
            success:function(data)
            {
                $('#user_aprobador').html(data);
            }
        });
    });
$('#company_id').change(function(){
        var company_id = $('#company_id').val();
        var btn_action = 'load_department';
        $.ajax({
            url:"mov_action.php",
            method:"POST",
            data:{company_id:company_id, btn_action:btn_action},
            success:function(data)
            {
                $('#department_id2').html(data);
            }
        });
    });
//---------------
});	
//---------------
</script>

</BODY>
</HTML> 