<html>
<?php
function fill_companies_list($connect)
//====================================
{
	$query = "
	SELECT * FROM companies 
	WHERE statu = 'Activo' 
	ORDER BY company ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["company"].'</option>';
	}
	return $output;
}

function fill_zone_user_cia_list($connect, $userid, $cias)
//====================================
{
	$query = "
	Select * FROM wh_user_zones 
	INNER JOIN wh_zones ON wh_zones.zone_id = wh_user_zones.zone_id
	WHERE wh_user_zones.user_id = '$userid' and wh_user_zones.uzcompany_id = '$cias' and wh_user_zones.userz_statu = 'Activo' and wh_zones.zone_statu = 'Activo' 
	ORDER BY wh_zones.zone_desc
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["zone_id"].'">'.$row["zone_desc"].' '.$row["zone_ubic"].'</option>';
	}
	return $output;
}

function fill_categories_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_categories 
	WHERE cat_statu = 'Activo' 
	ORDER BY category ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>';
	}
	return $output;
}

function fill_scategories_list($connect, $category_id)
//===================================================
{
	$query = "SELECT * FROM wh_subcategories 
	WHERE scat_statu = 'Activo' 
	AND wh_category_id = '".$category_id."'
	ORDER BY subcategory ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Seleccionar Subcategoria</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["scat_id"].'">'.$row["subcategory"].'</option>';
	}
	return $output;
}

function fill_zonas_list($connect, $userid)
//====================================
{
	$query = "
	Select * FROM zonas 
	INNER JOIN user_zu ON user_zu.zu_id = zonas.zu_id
	WHERE user_zu.user_id = '".$userid."' and user_zu.user_zu_status = 'activo' and zonas.zu_status = 'activo'
	ORDER BY zu_desc
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["zu_id"].'">'.$row["zu_desc"].'</option>';
	}
	return $output;
}

function fill_zonas_list2($connect)
//====================================
{
	$query = "
	SELECT * FROM zonas 
	WHERE zu_status = 'activo' 
	ORDER BY zu_desc ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["zu_id"].'">'.$row["zu_desc"].'</option>';
	}
	return $output;
}


function fill_marcas_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_brands 
	WHERE brand_statu = 'Activo' 
	ORDER BY brand_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
	}
	return $output;
}

function fill_sectores_list($connect)
//====================================
{
	$query = "
	SELECT * FROM sectores 
	WHERE sector_status = 'activo' 
	ORDER BY sector_desc ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["sector_id"].'">'.$row["sector_desc"].'</option>';
	}
	return $output;
}

function fill_departments_list($connect, $cia)
//====================================
{
	$query = "
	SELECT * FROM departments 
	WHERE statu = 'Activo' and company_id = '".$cia."'
	ORDER BY department ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["department"].'</option>';
	}
	return $output;
}

function fill_user_department_list($connect, $department_id)
//====================================
{
	$query = "
	SELECT  * FROM positions
	inner join departments on departments.id = positions.department_id
	inner join users on users.position_id = positions.id
	where departments.statu = 'Activo' and positions.department_id = '".$department_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Seleccionar Usuario</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["first_name"].' '.$row["last_name"].'</option>';
	}
	return $output;
}


function fill_lines_list($connect, $cia)
//====================================
{
	$query = "
	SELECT * FROM wh_lines
	WHERE statu = 'Activo' and company_id = '".$cia."'
	ORDER BY namel ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["acronym"].'</option>';
	}
	return $output;
}
function fill_consumo_list($connect, $zon)
//====================================
{
	$query = "
	SELECT * FROM wh_consumos 
	WHERE statu_cons = 'Activo' and zone_cons = '".$zon."'
	ORDER BY name_cons ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_cons"].'">'.$row["name_cons"].'</option>';
	}
	return $output;
}
	
function fill_prove_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_suppliers 
	WHERE statu = 'Activo' 
	ORDER BY prove ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["prove"].'</option>';
	}
	return $output;
}

function fill_tipos_list($connect)
//====================================
{
	$query = "
	SELECT * FROM ait_type_components 
	WHERE tc_statu = 'Activo' 
	ORDER BY typec ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["tc_id"].'">'.$row["typec"].'</option>';
	}
	return $output;
}

function fill_modelos_list($connect, $brand_id)
//===================================================
{
	$query = "SELECT * FROM ait_models 
	WHERE model_statu = 'Activo' 
	AND brand_id = '".$brand_id."'
	ORDER BY model ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Seleccionar Modelo</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["model_id"].'">'.$row["model"].' </option>';
	}
	return $output;
}

function fill_unit_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_measurement_units 
	WHERE statu = 'Activo' 
	ORDER BY name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
	}
	return $output;
}

function fill_menugr_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_menu_groups 
	WHERE menugr_statu = 'Activo' 
	ORDER BY menugr_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["menugr_id"].'">'.$row["menugr_name"].'</option>';
	}
	return $output;
}

function fill_menuop_list($connect, $menugr_id)
//===================================================
{
	$query = "SELECT * FROM wh_menu_options 
	WHERE menuop_statu = 'Activo' 
	AND menugr_id = '".$menugr_id."'
	ORDER BY menuop_desc ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Seleccionar opciones de Menú</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["menuop_id"].'">'.$row["menuop_desc"].'</option>';

	}
	return $output;
}

function fill_tipmov_list($connect, $mhtmov )
//====================================
{
	$query = "
	SELECT * FROM wh_tipmov 
	WHERE tm_statu= 'Activo' and tm_tipo = '".$mhtmov."'
	ORDER BY tm_cod ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["tm_id"].'">'.$row["tm_desc"].'</option>';
	}
	return $output;
}


function get_user_name($connect, $user_id)
//====================================
{
	$query = "
	SELECT user_name FROM user_details WHERE user_id = '".$user_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_name'];
	}
}
//------------------------------------
function fill_conditions_list($connect)
//====================================
{
	$query = "
	SELECT * FROM wh_conditions
	where c_statu = 'Activo'
	ORDER BY c_description ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["c_id"].'">'.$row["c_description"].'</option>';
	}
	return $output;
}
//------------------------------------
function fill_product_list($connect)
//====================================
{
	$query = "
	SELECT * FROM equipos 
	WHERE eq_status = 'activo' 
	ORDER BY eq_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["equipo_id"].'">'.$row["eq_name"].'</option>';
	}
	return $output;
}
?>
</html>