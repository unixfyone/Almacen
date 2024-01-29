<?php

include('database_connection.php');
include('function.php');

if(isset($_POST['btn_action']))
{
//===============================================
	if($_POST['btn_action'] == 'materials_details')
	{
		$query = "
		SELECT mat.*, um.name AS umname, um.acronym, ln.namel AS lnname, ln.typel, cate.category,
		scate.subcategory, br.brand_name
		FROM wh_master_materials mat
		INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id
		INNER JOIN wh_lines ln ON ln.id = mat.wh_line_id
		INNER JOIN wh_categories cate ON cate.cat_id = mat.wh_category_id
		INNER JOIN wh_subcategories scate ON scate.scat_id = mat.wh_subcategory_id
		LEFT JOIN wh_brands br ON br.brand_id = mat.wh_brand_id
		WHERE mat.id = '".$_POST["id"]."'
		";
	
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="table-responsive">
			<table class="table table-boredered table-hover text-nowrap dataTable dtr-inline mt-1 no-footer" role="grid" border=1>
		';
		foreach($result as $row)
		{
			$status = '';
			$config = '';
			if($row['m_statu'] == 'Activo')
			{
				$status = '<span class="label label-success">Activo</span>';
			}
			else
			{
				$status = '<span class="label label-danger">Inactivo</span>';
			}
	
			$output .= '
			<tr>
				<td><font color="#4d88ff" size="4px">ID / Código del Material</font></td>
				<td><b><font size="3px">'.$row["id"].'
				<br>
				'.$row["code"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Descripción</font></td>
				<td><b><font size="3px">'.$row["description"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Descripción Ampliada</font></td>
				<td><b><font size="3px">'.$row["description_amp"].'</font></b></td>
			</tr>			
			<tr>
				<td><font color="#4d88ff" size="4px">Número de Parte</font></td>
				<td><b><font size="3px">'.$row["part_number"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Unidad de Medida</font></td>
				<td><b><font size="3px">'.$row["acronym"].'  -  '.$row["umname"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Línea</font></td>
				<td><b><font size="3px">'.$row["lnname"].'  -  '.$row["typel"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Categoria / SubCategoria</font></td>
				<td><b><font size="3px">'.$row["category"].'
					<br>
					'.$row["subcategory"].'</font></b>
					</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Marca </font></td>
				<td><b><font size="3px">'.$row["brand_name"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Tipo de Material</font></td>
				<td><b><font size="3px">'.$row["type_material"].'</font></b></td>
			</tr>			
			<tr>
				<td><font color="#4d88ff" size="4px">Status </font</td>
				<td><b><font size="3px">'.$status.'</font></b></td>
			</tr>
		
			';
		}
		$output .= '
			</table>
		</div>
		';
		echo $output;
	}
//===============================================
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Activo';
		if($_POST['status'] == 'Activo')
		{
			$status = 'Inactivo';	
		}
		$query = "
		UPDATE wh_master_materials 
		SET m_statu = :m_statu 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':m_statu'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Material cambio de status a ' . $status;
		}
	}
}

?>
