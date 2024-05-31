<?php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//========================================
	if($_POST['btn_action'] == 'product_details')
	{
	
		$query = "
		SELECT * FROM wh_materials 
		INNER JOIN wh_zones ON wh_zones.zone_id = wh_materials.zone_id 
		INNER JOIN wh_brands ON wh_brands.brand_id = wh_materials.wh_brand_id_m
		INNER JOIN wh_measurement_units ON wh_measurement_units.id = wh_materials.wh_measurement_unit_id_m
		WHERE wh_materials.id = '".$_POST["id"]."'
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
			$existencia = $_POST['expa'] + $_POST['exe'] - $_POST['exs'];
			$status = '';
			if($row['m_statu_m'] == 'Activo')
			{
				$status = '<span class=""><font color="green" FACE="times new roman" size="3px">Activo</font></span>';
			}
			else
			{
				$status = '<span class=""><font color="red" FACE="times new roman" size="3px">Inactivo</font></span>';
			}
			
			$FechaAct = date("d-m-Y", strtotime($row["created"]));
						
			//=====================
			$output .= '
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Almacen del Material</font></td>
				<td>'.$row["zone_desc"].' &nbsp;&nbsp;/&nbsp;&nbsp; '.$row["zone_ubic"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Código <br> Descripción Material</font></td>
				<td>'.$row["code"].' <br> '.$row["description_m"].'</td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Marca del Producto</font></td>
				<td>'.$row["brand_name"].'</td> 
			</tr>
			<tr>
				<td><b><font color="#0066FF" FACE="times new roman" size="3px">Año / Periodo Activo: </font></b></td>
				<td><b>'.$_POST['aa'].' &nbsp;&nbsp;/&nbsp;&nbsp; '.$_POST['mm'].'</b></td>
			</tr>
			<tr>
				<td><b><font color="#909090" FACE="times new roman" size="3px">Saldo Anterior.:</font></td>
				<td bgcolor = "#f2f2f2"><font color="blue" FACE="times new roman" size="3px">'.number_format($_POST['expa'], 2, ",", ".").' &nbsp;&nbsp; '.$row["name"].'</font></b></td>
			</tr>
			<tr>
				<td><b><font color="#909090" FACE="times new roman" size="3px">Entradas del Periodo:</font></td>
				<td bgcolor = "#f2f2f2"><font color="blue" FACE="times new roman" size="3px">'.number_format($_POST['exe'], 2, ",", ".").' &nbsp;&nbsp; '.$row["name"].'</font></b></td>
			</tr>
			<tr>
				<td><b><font color="#909090" FACE="times new roman" size="3px">Salidas del Periodo:</font></td>
				<td bgcolor = "#f2f2f2"><font color="red" FACE="times new roman" size="3px">'.number_format($_POST['exs'], 2, ",", ".").' &nbsp;&nbsp; '.$row["name"].'</font></b></td>
			</tr>

			<tr>
				<td><b><font color="#909090" FACE="times new roman" size="3px">Cantidad en Existencia Actual:</font></b></td>
				<td bgcolor = "#f2f2f2"><b><font color="#000000" FACE="times new roman" size="3px">'.number_format($existencia, 2, ",", ".").' &nbsp;&nbsp; '.$row["name"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#0066FF" FACE="times new roman" size="3px">Ultimo Costo ME</font></td>
				<td>'.number_format($row['cost_me'], 2, ",", ".").'</td>
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