<?php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
//========================================
	if($_POST['btn_action'] == 'product_details')
	{
		$query = "
		SELECT * FROM wh_movinvd 
		INNER JOIN wh_movinvh ON wh_movinvh.movh_id = wh_movinvd.movh_id
		INNER JOIN wh_tipmov ON wh_tipmov.tm_id = wh_movinvd.tm_id
		INNER JOIN wh_materials ON wh_materials.id = wh_movinvd.product_id
		WHERE wh_movinvd.movd_ejer = '".$_POST["xaa"]."' and wh_movinvd.movd_per = '".$_POST["xmm"]."' and wh_movinvd.product_id = '".$_POST["product_id"]."' and wh_movinvd.movd_statu = 'Cerrado'
		ORDER BY wh_movinvd.movd_fecha DESC
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="">
		<table class="table table-boredered">
				
			<b><font color="#0066FF" FACE="times new roman" size="3px">Año del Ejercicio..: &nbsp;&nbsp;&nbsp;</font> '.$_POST["xaa"].' &nbsp;&nbsp;&nbsp;<font color="#0066FF" FACE="times new roman" size="3px">Periodo del Ejercicio..:  &nbsp;&nbsp;&nbsp;</font>'.$_POST["xmm"].' </font></b>
			<br>
			<b><font color="#0066FF" FACE="times new roman" size="3px">Material..: </font> '.$_POST["desc"].' </b>
			<tr>
			<th>Fecha</th>
			<th>Documento</th>
			<th>Movimiento</th>
			<th>TM</th>
			<th>Costo ME</th>
			<th>Cantidad</th>
			</tr>		
				
		';
		foreach($result as $row)
		{
			$tipom = 0;
			if($row['movd_tmov'] == 'Entradas')
			{
				$tipom = '<font color="blue">'.number_format($row['movd_cant'], 2, ",", ".").'</font>';
				$tipod = '<font color="blue">'.$row['movd_tmov'];
			} else {
				$tipom = '<font color="red">'.number_format($row['movd_cant'], 2, ",", ".").'</font>';
				$tipod = '<font color="red">'.$row['movd_tmov'];
			}
			
			$output .= '

			<tr>
				<td align="left"><font size="2px">'.date("d-m-Y", strtotime($row["movh_fecha"])).'</font></td>
				<td><font size="2px">'.$row["movh_doc"].'</font></td>
				<td><font size="2px">'.$row["tm_desc"].'</font></td>
				<td align="left"><b><font size="2px">'.$tipod.'</font></b></td>
				<td align="right"><font size="2px">'.number_format($row['movd_costou_me'], 2, ",", ".").'</font></td>
				<td align="right"><b><font size="2px">'.$tipom.'</font></b></td>
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