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


<?php

//$ZON = $_POST["ZON"];

//---------------------------------------------------------------

//$mdcant2 = '0';

//--------------
//if(isset($_GET["IDM"]))$IDM = $_GET["IDM"];
//else $IDM = $_GET["IDM2"];
//--------------
//if(isset($_GET["CT1"]))$CT1 = $_GET["CT1"];
//else $CT1 = '0';
//===============================================================
//	$SQLp = "SELECT * FROM wh_periodos 
//	WHERE per_statu = 'Abierto' and zone_id = '$ZON' ";
//	$Registrop = mysqli_query($link,$SQLp);
	//-----------------------------
//	while ($Filap=mysqli_fetch_array($Registrop))
//	{	
//		$AA = $Filap["per_aa"];
//		$MM = $Filap["per_mm"];
//	}
//	mysqli_free_result ($Registrop);
	//===============================================================
//echo "<pre>"; print_r($ZON); exit();
//===============================================================
//---------------------------------------------------------------
//---------------------------------------------------------------




//===============================================================
//if (isset($_GET['BtnOK']))
if (isset($_POST['autorizados'])) 
{
 	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];
		$count = count($id);
	
	$mdcant2 = '0';
//---------------------------------------------------------------
    //Rebuscamos en busca de resultados $_POST (id selecionados).
    for ($i=0; $i < $count; $i++) {
//---------------------------------------------------------------
	$query = "
	SELECT * FROM wh_movinvd 
	INNER JOIN wh_movinvh ON wh_movinvh.movh_id = wh_movinvd.movh_id
	INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id 
	Where wh_movinvd.movd_id = '$id[$i]' LIMIT 1
	";	
	$Registro = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($Registro))
	{
		$mdid = $row['movd_id'];				// ID de Detalle
		$tm_tipo = $row['movh_tmov'];			// Tipo Movimiento (E/S)
		$cia = $row['movd_cia'];				// Id. Compañia
		$zone = $row['movd_zone'];				// Id. Zona
		$AA = $row['movd_ejer'];				// Ejercicio
		$MM = $row['movd_per'];					// Periodo
		$prodid = $row['product_id'];			// Id. de Producto
		$prodcod = $row['product_cod'];			// Cod. de Producto
		$mdcant = $row['movd_cant'];			// Cantidad del Movimiento
		$mdcost = $row['movd_costou_me'];			// Costo Unitario del Movimiento
		$tm_actcost = $row['tm_actcost'];		// Actualiza Costo
	}
	mysqli_free_result ($Registro);



//---------------------------------------------------------------
	$query3 = "SELECT *, Count(product_id) AS Cuenta1 FROM wh_saldosm WHERE aa_s = '".$AA."' and product_id = '".$prodid."'
	";	
	$Registro3 = mysqli_query($link,$query3);
	while($row3 = mysqli_fetch_array($Registro3))
	{
	//=======================================================
		$CTA1 = $row3['Cuenta1'];
		if ($CTA1 == '0') {
		//----------------
			$saldos = '0|0|0|0|0|0|0|0|0|0|0|0';
			$saldos13 = '0|0|0|0|0|0|0|0|0|0|0|0|0';
			$query5 = "INSERT INTO wh_saldosm (aa_s, company_id, zone_id, product_id, product_cod, saldos_e, saldos_s, saldos_fp) VALUES ('$AA', '$cia', '$zone', '$prodid', '$prodcod', '$saldos', '$saldos', '$saldos13')";
			//--------------------------------		
			mysqli_query($link,$query5);
		}
	}
	mysqli_free_result ($Registro3);
	//=======================================================
	$query = "SELECT * FROM wh_saldosm WHERE aa_s = '".$AA."' and product_id = '".$prodid."' ";	
	$Registro2 = mysqli_query($link,$query);			
	while($row2 = mysqli_fetch_array($Registro2))
	{		
		if ($tm_tipo == 'ENTRADAS') {
			$mdcante = $mdcant;					// Cantidad del Movimiento
			$mdcant2 = $mdcant * 1;
			//--------------------------------
			$mValore=explode("|", $row2["saldos_e"]);
			//--------------------------------
			$ve = $mValore[$MM-1]+$mdcante;		// Actualiza cantidad en Mes de entrada del Arreglo
			
			$mValore[$MM-1]=$ve;

			$mValore2=implode("|", $mValore);
			//--------------------------------				
			$query4 = "UPDATE wh_saldosm SET 
			saldos_e = '$mValore2'
			WHERE aa_s = '$AA' and product_id = '$prodid'";
			mysqli_query($link,$query4);
		//----------
		} else {
		//----------
			$mdcants = $mdcant;					// Cantidad del Movimiento
			$mdcant2 = $mdcant * -1;
			//--------------------------------
			$mValors=explode("|", $row2["saldos_s"]);
			//--------------------------------
			$vs = $mValors[$MM-1]+$mdcants;		// Actualiza cantidad de salida en Mes del Arreglo
			
			$mValors[$MM-1]=$vs;

			$mValors2=implode("|", $mValors);
			//--------------------------------
			$query4 = "UPDATE wh_saldosm SET 
			saldos_s = '$mValors2'
			WHERE aa_s = '$AA' and product_id = '$prodid'";
			mysqli_query($link,$query4);
		}
		//=================================
		//--------------------------------
		$mValorfp=explode("|", $row2["saldos_fp"]);
		//--------------------------------
		$vefp = $mValorfp[$MM]+$mdcant2;		// Actualiza cantidad en Mes del Arreglo NOTA este arreglo es de 13 posiciones
		
		$mValorfp[$MM]=$vefp;

		$mValorfp2=implode("|", $mValorfp);
		//--------------------------------				
		$query4 = "UPDATE wh_saldosm SET 
		saldos_fp = '$mValorfp2'
		WHERE aa_s = '$AA' and product_id = '$prodid'";
		mysqli_query($link,$query4);
		//=======================================================
	}
	mysqli_free_result ($Registro2);
//======== Actualiza Status en movinv_d ========
		$fechac = date("Y-m-d");
		$query6 = "
		UPDATE wh_movinvd 
		SET movd_statu = 'Cerrado',
		movd_fechac = '$fechac'
		WHERE movd_id = '$mdid'
		";
		mysqli_query($link,$query6);
//========

//========= Actualiza Quantity en Producto ============

//======== Actualiza Costo Unitario en Producto =========
	if ($tm_tipo == 'ENTRADAS' and $tm_actcost == 'Si')
	{
		$mdcost2 = $mdcost;
//========
		$query9 = "
		UPDATE wh_materials
		SET cost_me = '$mdcost2'
		WHERE id = '".$prodid."'
		";
		mysqli_query($link,$query9);		
	}
//========	
}
//=======================================================	
echo"<script type='text/javascript'>
alert('!Renglones Cerrados Correctamente...')
window.history.go(-1)
</script>";
//==========
} else {
	echo"<script type='text/javascript'>
	alert('!No se Seleccionaron Renglones.........')
	window.history.go(-1)
	</script>";
}
//==========
} 
//===============================================================
?>
</div>
