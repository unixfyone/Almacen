<?php

//movinvd_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//========================================
	if($_POST['btn_action'] == 'movinv_details')
	{
		$query = "
		SELECT * FROM wh_movinvd 
		INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id 
		INNER JOIN wh_movinvh ON wh_movinvh.movh_id = wh_movinvd.movh_id
		INNER JOIN wh_materials ON wh_materials.code = wh_movinvd.product_cod
		INNER JOIN wh_measurement_units ON wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
		Where wh_movinvd.movd_id = '".$_POST["movd_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="table-responsive">
		<table class="table table-boredered">
		';
		foreach($result as $row)
		{
			//=====================
			$status = '';
			if($row['movd_statu'] == 'Abierto')
			{
				$status = '<span class=""><font color="green" FACE="times new roman" size="2px">Abierto</font></span>';
			}
			else
			{
				$status = '<span class=""><font color="red" FACE="times new roman" size="2px">Cerrado</font></span>';
			}
			
			$FechaDoc = date("d-m-Y", strtotime($row["movh_fecha"]));
			$CTOTALE = ($row['movd_cant'] * $row['movd_costou_me']);
			$CTOTALL = ($row['movd_cant'] * $row['movd_costou_ml']);
			//=====================
			$output .= '
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Movimiento</font></td>
				<td>'.$row["movd_desc"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Código <br> Descripción Producto</font></td>
				<td>'.$row["product_cod"].' <br> '.$row["description_m"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Número / Fecha Documento</font></td>
				<td>'.$row["movh_doc"].' &nbsp;&nbsp;/&nbsp;&nbsp; '.$FechaDoc.'</td> 
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Ejercico / Período</font></td>
				<td>'.$row["movh_ejer"].' &nbsp;&nbsp;/&nbsp;&nbsp; '.$row["movh_per"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Cantidad del Renglon</font></td>
				<td>'.number_format($row['movd_cant'], 2, ",", ".").' &nbsp;&nbsp; '.$row["name"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Costos Renglon Moneda Extranjera</font></td>
				<td>Unitario Moneda Extranjera: '.number_format($row['movd_costou_me'], 3, ",", ".").' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Costo Total.: '.number_format($CTOTALE, 3, ",", ".").'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Tasa de Cambio</font></td>
				<td>Tasa de Cambio Bs.: '.number_format($row['movd_tasa_cambio'], 2, ",", ".").'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Detalle del Movimiento</font></td>
				<td>'.$row["movd_desc"].'</td>
			</tr>			
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Recibe el Producto</font></td>
				<td>'.$row["movd_recprod"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Status</font></td>
				<td><b>'.$status.'</b></td>
			</tr>
			';
		}
		$output .= '
			</table>
		</div>
		';
		echo $output;
	}
//========================================
}
//========================================
?>