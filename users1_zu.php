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
	
	 <link rel="stylesheet" href="dist/css/<?=$cstyle;?>.css">
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

</style>

<BODY>

<?php
echo '<FORM ACTION="" method="POST">';

//echo $USR = '';

if(isset($_GET["zu_id"]))$ZON = $_GET["zu_id"];
else $ZON = '';
//--------------
if(isset($_POST["CT1"]))$CT1 = $_POST["CT1"];
else $CT1 = '0';

//---------------------------------------------------------------
//---------------------------------------------------------------
$SQL = "SELECT * FROM wh_zones Where zone_id = '$ZON' ";
$RegistroA = mysqli_query($link,$SQL);
while($FilaA = mysqli_fetch_array($RegistroA))
{
$ZOND = $FilaA["zone_desc"];
$ZONU = $FilaA["zone_ubic"];
} 
mysqli_free_result ($RegistroA);
//---------------------------------------------------------------
//---------------------------------------------------------------
?>
<Input Type="hidden" name="CT1" size=11 value="<?Php echo $CT1=$CT1+'1';?>">
<!--  ======================================================================================= -->
<div class="content-wrapper">
	<!-- Content Header (Page header)  -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="m-0"><b><font color="#<?=$ccolor;?>" FACE="times new roman" size="5px">Zonas Almacenes</font></b></h1>
				</div>
				<div class="col-sm-6" align='right'>
					<button class="btn btn-outline-<?php echo $classButtonHeader; ?>" type="button" name="BotonCancelar" onclick='window.history.go(-"<?Php echo $CT1; ?>" )'><span class="fa fa-arrow-left"></span> Retornar</button>
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
							<b><font color="#FFFFFF" FACE="times new roman" size="4px">Usuarios por Zona de Ubicación</font></b>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="panel-body">
							<?php
							//---------------------------------------------------------------
							$SQL = "SELECT * FROM wh_user_zones 
							INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_zones.user_id
							WHERE wh_user_zones.zone_id = '$ZON'
							ORDER BY wh_user_details.first_name ASC";
							//---------------------------------------------------------------
							?>
							<table id="userszu_data" class="table table-bordered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" border='1'>
								<thead>
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Correo Electronico</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$Registro2 = mysqli_query($link,$SQL);
								while($Fila = mysqli_fetch_array($Registro2))
								{ 
								$status = '';
								$USRN = $Fila["first_name"] ."&nbsp;". $Fila["last_name"];
//<!-- =================================================================================== -->	
	if($Fila['userz_statu'] == 'Activo')
	{
		$status = '<span class=""><font color="green" FACE="times new roman" size="3px">Activo</font></span>';
			
	} else {
		
		$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Inactivo</font></span>';
		
	}

//<!-- =================================================================================== -->								
								?>
								<Tr>
									<Td><font size="3px"><?php echo $Fila['ID_reg']; ?></font></td>
									<Td><font size="3px"><?php echo $USRN; ?></font></td>
									<Td><font size="3px"><?php echo $Fila['user_email']; ?></font></td>
									<td><?php echo $status; ?></td>
								</tr>
								<?php } mysqli_free_result ($Registro2); ?>
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
</form>

<script>
$(document).ready(function(){
<!-- ********************* Lista de Registros ******************************** -->
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
				"targets":[0, 2],
				"orderable":false,
			},
		],
		"pageLength": 5	
    });
});
</script>
<?php mysqli_close($link); ?>
</BODY>
</HTML> 