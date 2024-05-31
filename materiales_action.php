<?php

include('database_connection.php');
include('function.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'load_subcategories')
	{
		echo fill_scategories_list($connect, $_POST['wh_category_id']);
	}
	if($_POST['btn_action'] == 'load_typematerial')
	{
		echo fill_type_material2($connect, $_POST['wh_type_material']);
	}
	if($_POST['btn_action'] == 'load_ctypematerial')
	{
		echo fill_type_cmaterial2($connect, $_POST['wh_tinv_id']);
	}
//===============================================
	if($_POST['btn_action'] == 'Addx')
	{
		$query = "
		INSERT INTO wh_materials 
		(code, company_id, zone_id, description, prefix, code_sap, part_number, wh_measurement_unit_id, wh_line_id, wh_category_id, wh_subcategory_id, wh_brand_id, type_material, ubication, cost, reorder, fill) 
		VALUES 
		(:code, :company_id, :zone_id, :description, :prefix, :code_sap, :part_number, :wh_measurement_unit_id, :wh_line_id, :wh_category_id, :wh_subcategory_id, :wh_brand_id, :type_material, :ubication, :cost, :reorder, :fill)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':code' 			=> $_POST["code"],
				':company_id' 		=> $_POST["company_id"],
				':zone_id' 			=> $_POST["zone_id"],
				':description' 		=> $_POST["description"],
				':prefix' 			=> $_POST["prefix"],
				':code_sap' 		=> $_POST["code_sap"],
				':part_number' 		=> $_POST["part_number"],
				':wh_measurement_unit_id' => $_POST["wh_measurement_unit_id"],
				':wh_line_id' 			=> $_POST["wh_line_id"],
				':wh_category_id' 		=> $_POST["wh_category_id"],
				':wh_subcategory_id' 	=> $_POST["wh_subcategory_id"],
				':wh_brand_id' 			=> $_POST["wh_brand_id"],
				':type_material' 		=> $_POST["type_material"],
				':ubication' 			=> $_POST["ubication"],
				':cost' 		=> $_POST["cost"],
				':reorder' 		=> $_POST["reorder"],
				':fill' 		=> $_POST["fill"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Material Agregado';
		}
	}
//===============================================	
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM wh_materials WHERE id = '".$_POST["id"]."' ";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
		$output['code'] = $row['code'];
		$output['description'] = $row['description'];
		$output['prefix'] = $row['prefix'];
		$output['code_sap'] = $row['code_sap'];
		$output['part_number'] = $row['part_number'];
		$output['wh_measurement_unit_id'] = $row['wh_measurement_unit_id'];
		$output['wh_line_id'] = $row['wh_line_id'];
		$output['wh_category_id'] = $row['wh_category_id'];
		$output['wh_subcategory_id'] = $row['wh_subcategory_id'];
		//$output['subcategory_select_box'] = fill_scategories_list($connect, $row['wh_category_id']);
		}
		echo json_encode($output);
	}




	
//===============================================
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE wh_materials 
		set description = :description
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id' => $_POST["id"],
				':description' => $_POST["description"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Material Editado';
		}
	}
//===============================================
	if($_POST['btn_action'] == 'materials_details')
	{
		$query = "
		SELECT mat.*, um.name AS umname, um.acronym, ln.namel AS lnname, ln.typel, cate.category,
		scate.subcategory, br.brand_name
		FROM wh_materials mat
		INNER JOIN wh_measurement_units um ON um.id = mat.wh_measurement_unit_id_m
		INNER JOIN wh_lines ln ON ln.id = mat.wh_line_id_m
		INNER JOIN wh_categories cate ON cate.cat_id = mat.wh_category_id_m
		INNER JOIN wh_subcategories scate ON scate.scat_id = mat.wh_subcategory_id_m
		INNER JOIN wh_brands br ON br.brand_id = mat.wh_brand_id_m
		WHERE mat.id = '".$_POST["idmat"]."'
		";
		
//echo "<pre>"; print_r($query); exit();

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
			if($row['m_statu_m'] == 'Activo')
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
				<td><b><font size="3px">'.$row["description_m"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Descripción Ampliada</font></td>
				<td><b><font size="3px">'.$row["description_amp_m"].'</font></b></td>
			</tr>			
			<tr>
				<td><font color="#4d88ff" size="4px">Prefijo-Línea</font></td>
				<td><b><font size="3px">'.$row["prefix"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Código SAP</font></td>
				<td><b><font size="3px">'.$row["code_sap"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="4px">Número de Parte</font></td>
				<td><b><font size="3px">'.$row["part_number_m"].'</font></b></td>
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
				<td><b><font size="3px">'.$row["type_material_m"].'</font></b></td>
			</tr>			
			<tr>
				<td><font color="#4d88ff" size="4px">Ubicación</font></font></td>
				<td><b><font size="3px">'.$row["ubication"].'</font></b></td>
			</tr>
			<tr>
				<td><font color="#4d88ff" size="3px">Costo Moneda Extranjera 
				<br>Stock Minimo
				<br>Stock Maximo</font></td>
				<td><b><font size="3px">'.$row['cost_me'].'
				<br>'.$row["reorder"].'
				<br>'.$row["fill"].'</font></b></td>
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
		UPDATE wh_materials 
		SET m_statu_m = :m_statu_m 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':m_statu_m'	=>	$status,
				':id'		=>	$_POST["idmat"]
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
