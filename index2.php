<?php
include('database_connection.php');
include('headerx.php');
include('function.php');
?>

<div class="row">
	<?php
	if($_SESSION['type'] == 'Master')
	{
	?>
	<div align="center">
	
	</div>
</div>
	<?php 
	} else {
	session_start();
	session_destroy();
	?>
	
	<script type="text/javascript">
	window.close(); 
	</script>		
		
	<?php 	}  ?>
