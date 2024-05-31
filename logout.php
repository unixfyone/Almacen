<?php
//logout.php
session_start();

session_destroy();

//header("location:login.php");
?>
<script type="text/javascript">
window.close(); 
</script>

