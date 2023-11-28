<!DOCTYPE html>
<?php
//header.php
$logo= $_SESSION['logo'];
$userid= $_SESSION['user_id'];
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UnixFyOneS | Dashboard</title>

  


	
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  
<style type="text/css">

</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark elevation-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index_whpa.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->

      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
	<ul class="navbar-nav ml-auto">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <font color="#FFFFFF"><?php echo $_SESSION["first_name"];?>&nbsp;<?php echo $_SESSION["last_name"]; ?>
			</font></a>
			<ul class="dropdown-menu">
				<li>
					<a class="dropdown-item" href="logout.php">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Cerrar Sesión
					</a>
				</li>
			</ul>
		</li>
	</ul>
<?php
include('unico.php');
$classButtonFooter = 'btn btn-outline-'.$cstyle.' btn-md elevation-1 text-bold text-md mt-3 mb-3 mr-3';
$classButtonHeader = 'btn btn-outline-'.$cstyle.' btn-xs elevation-1 text-bold text-md mt-2 mb-2 mr-2';
$classButtonList = 'btn btn-outline-light text-dark border border-dark btn-ms mr-1 ml-1 mt-1 mb-1';
?>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
	<div class="row m-0 p-0 mb-0 bg-dark">
		<a href="#" class="brand-link text-center m-0 p-0">
		<img src="dist/img/thumbnails/unixfyone.png" width="239" height="59" alt="Logo">
		</a>
	</div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="row m-0 p-0 mb-0">
		  <img src="<?= $logo; ?>" class="brand-image text-lg w-100 mt-3 ml-0 mb-3 h-100" alt="Logo">
      </div>

      <!-- SidebarSearch Form -->

	  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index_whpa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
          </li>
<!--------------------------------------------------------- -->
				<?php
					
					$opcion11 = "Tablas/Archivos";
					$opcion12 = "Materiales";
					//$opcion13 = "Mantenimientos de equipos";
					$opcion21 = "Registros Datos"; //Movimientos del Almacen
					$opcion22 = "Registros Movimientos"; //Movimientos del Almacen
					$opcion31 = "Seguridad Menús";
					$opcion32 = "Seguridad Usuarios";
					$opcion41 = "Consultas Materiales";
					$opcion42 = "Consultas Movimientos";
					$opcion43 = "Consultas de Mantenimientos";
					$opcion51 = "Reportes Materiales";
					$opcion52 = "Reportes de Movimientos";
					$opcion53 = "Reportes de Mantenimientos";
					?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Actualizaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tablas/Archivos</p>
				  <i class="right fas fa-angle-left"></i>
                </a>
				
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion11' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro11 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro11))
						{ 
					?>
						<li class="nav-item"> 
							<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
								<i class="far fa-dot-circle nav-icon"></i>
								<p><?= $Fila['menuop_desc']; ?></p>
							</a>
						</li>
						<?php
						}
						mysqli_free_result ($Registro11);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>
				
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Materiales</p>
				  <i class="right fas fa-angle-left"></i>
                </a>
				
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion12' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro12 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro12))
						{ 
					?>
						<li class="nav-item"> 
							<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
								<i class="far fa-dot-circle nav-icon"></i>
								<p><?= $Fila['menuop_desc']; ?></p>
							</a>
						</li>
						<?php
						}
						mysqli_free_result ($Registro12);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>
              </li>
            </ul>
          </li>
<!--------------------------------------------------------- -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Movimientos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registros Datos</p>
				  <i class="right fas fa-angle-left"></i>
                </a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion21' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro21 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro21))
						{ 
					?>
						<li class="nav-item"> 
							<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
								<i class="far fa-dot-circle nav-icon"></i>
								<p><?= $Fila['menuop_desc']; ?></p>
							</a>
						</li>
						<?php
						}
						mysqli_free_result ($Registro21);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>				
              </li>
			<li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-circle"></i>
				  <p>Registros Movimientos</p>
				  <i class="right fas fa-angle-left"></i>
				</a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion22' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro22 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro22))
						{ 
					?>
						<li class="nav-item"> 
							<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
								<i class="far fa-dot-circle nav-icon"></i>
								<p><?= $Fila['menuop_desc']; ?></p>
							</a>
						</li>
						<?php
						}
						mysqli_free_result ($Registro22);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>					
				</li>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Seguridad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seguridad Menús</p>
				  <i class="right fas fa-angle-left"></i>
                </a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion31' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro31 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro31))
						{ 
					?>
					<li class="nav-item"> 
						<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
							<i class="far fa-dot-circle nav-icon"></i>
							<p><?= $Fila['menuop_desc']; ?></p>
						</a>
					</li>
						<?php
						}
						mysqli_free_result ($Registro31);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>			 
			</li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seguridad Usuarios</p>
				  <i class="right fas fa-angle-left"></i>
                </a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion32' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro31 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro31))
						{ 
					?>
					<li class="nav-item"> 
						<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
							<i class="far fa-dot-circle nav-icon"></i>
							<p><?= $Fila['menuop_desc']; ?></p>
						</a>
					</li>
						<?php
						}
						mysqli_free_result ($Registro31);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>					
			 </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Consultas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultas Materiales</p>
				  <i class="fas fa-angle-left right"></i>
                </a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion41' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro31 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro31))
						{ 
					?>
					<li class="nav-item"> 
						<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
							<i class="far fa-dot-circle nav-icon"></i>
							<p><?= $Fila['menuop_desc']; ?></p>
						</a>
					</li>
						<?php
						}
						mysqli_free_result ($Registro31);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>	
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultas Movimientos</p>
				  <i class="fas fa-angle-left right"></i>
                </a>
				<ul class="nav nav-treeview">
					<?php
						$SQLx = "SELECT * FROM wh_user_menus
						INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
						INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
						INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
						WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion42' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
						//--------

						$Registro31 = mysqli_query($link,$SQLx);
						while ($Fila=mysqli_fetch_array($Registro31))
						{ 
					?>
					<li class="nav-item"> 
						<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
							<i class="far fa-dot-circle nav-icon"></i>
							<p><?= $Fila['menuop_desc']; ?></p>
						</a>
					</li>
						<?php
						}
						mysqli_free_result ($Registro31);
						
						//================================================
						//mysqli_close($link);
						?>
				</ul>
			</li>
        </ul>
		</li>
	
		<li class="nav-item">
            <a href="#" class="nav-link">
				<i class="nav-icon fas fa-bars"></i>
				<p>Reportes<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Reportes Materiales</p>
						<i class="fas fa-angle-left right"></i>
					</a>
					<ul class="nav nav-treeview">
						<?php
							$SQLx = "SELECT * FROM wh_user_menus
							INNER JOIN wh_user_details ON wh_user_details.user_id = wh_user_menus.user_id
							INNER JOIN wh_menu_groups ON wh_menu_groups.menugr_id = wh_user_menus.menugr_id
							INNER JOIN wh_menu_options ON wh_menu_options.menuop_id = wh_user_menus.menuop_id
							WHERE wh_user_details.user_id = '$userid' and wh_menu_groups.menugr_name = '$opcion51' and wh_user_menus.usermn_statu = 'Activo' and wh_menu_options.menuop_statu= 'Activo' ORDER BY wh_menu_options.menuop_desc";
							//--------

							$Registro31 = mysqli_query($link,$SQLx);
							while ($Fila=mysqli_fetch_array($Registro31))
							{ 
						?>
						<li class="nav-item"> 
							<?= "<a href={$Fila['menuop_run_mn']}?MOP=" .$Fila['menuop_id']. " class='nav-link'>"?>
								<i class="far fa-dot-circle nav-icon"></i>
								<p><?= $Fila['menuop_desc']; ?></p>
							</a>
						</li>
						<?php
						}
						mysqli_free_result ($Registro31);
						
						//================================================
						//mysqli_close($link);
						?>
					</ul>	
				</li>
				<?php mysqli_close($link); ?>
			</ul>
		</li>







		
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
   <!--
  <aside class="control-sidebar control-sidebar-dark">
   -->
    <!-- Control sidebar content goes here -->
	<!--
  </aside>
   -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>


</body>

</html>