<?php
// 1. Incluir el cargador automático de Composer
require 'vendor/autoload.php';
// 2. Importar las clases necesarias de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//------------------------------------
include('database_connection.php');
//------------------------------------
$Fecha = date('d-m-Y');
$CIA = $_GET['CIA']; 		// Codigo Compañia
$ZON = $_GET['ZON']; 		// Codigo del Almacen
$LIN = $_GET['LIN']; 			// Año
//---------------------------------------------------------------
$stmt = $connect->prepare("SELECT * FROM wh_zones
INNER JOIN companies ON companies.id = wh_zones.zcompany_id 
Where zone_id = '$ZON'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row){
$ZOND = $row["zone_desc"];
$ZONU = $row["zone_ubic"];
$DCIA = $row["company"];
} 
//---------------------------------------------------------------
$stmt = $connect->prepare("Select * FROM wh_lines  
WHERE statu = 'Activo' and id = '$LIN'");								
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//-------
foreach ($result as $row){
$DLIN =  $row["namel"];
}
//---------------------------------------------------------------
$stmt = $connect->prepare("SELECT 
	m.id, m.code, m.description_m, m.ubication, m.wh_line_id_m, c.category,
	COALESCE(s.Entradas, 0) AS Entradas,
	COALESCE(s.Salidas, 0) AS Salidas,
	COALESCE(s.Stock, 0) AS Stock
FROM wh_materials m
LEFT JOIN wh_categories c ON c.cat_id = m.wh_category_id_m
LEFT JOIN (
	SELECT
		product_cod,
		SUM(CASE WHEN movd_tmov = 'ENTRADAS' THEN movd_cant ELSE 0 END) AS Entradas,
		SUM(CASE WHEN movd_tmov = 'SALIDAS' THEN movd_cant ELSE 0 END) AS Salidas,
		SUM(CASE WHEN movd_tmov = 'ENTRADAS' THEN movd_cant ELSE 0 END) -
		SUM(CASE WHEN movd_tmov = 'SALIDAS' THEN movd_cant ELSE 0 END) AS Stock
	FROM wh_movinvd
	WHERE movd_cia = '$CIA'
	GROUP BY product_cod
) s ON m.code = s.product_cod
WHERE
	m.zone_id = '$ZON'
	AND m.company_id = '$CIA'
	AND m.wh_line_id_m = '$LIN'
	AND m.m_statu_m = 'Activo'
ORDER BY m.code ASC");
//---------------------------------------------------------------
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 4. Crear el documento de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// 5. Definir los encabezados de la tabla (Fila 1)
$sheet->getStyle('A1:E1')->getFont()->setBold(true);
$sheet->setCellValue('B1', 'EXISTENCIA DE MATERIALES POR LINEA');
$sheet->setCellValue('A2', 'COMPAÑIA:');
$sheet->setCellValue('B2', $DCIA);
$sheet->setCellValue('A3', 'ZONA:');
$sheet->setCellValue('B3', $ZOND);
$sheet->setCellValue('A4', 'LINEA:');
$sheet->setCellValue('B4', $DLIN);

$sheet->setCellValue('A6', 'CODIGO');
$sheet->setCellValue('B6', 'DESCRIPCION');
$sheet->setCellValue('C6', 'CATEGORIA');
$sheet->setCellValue('D6', 'UBICACION');
$sheet->setCellValue('E6', 'EXISTENCIA');
// Opcional: Poner los encabezados en negrita
$sheet->getStyle('A6:E6')->getFont()->setBold(true);
// 6. Llenar el Excel con los datos de MySQL
$filaInicio = 7; // Empezamos en la fila 2 porque la 1 tiene los encabezados
foreach ($result as $row){
    $sheet->setCellValue('A' . $filaInicio, $row['code']);
    $sheet->setCellValue('B' . $filaInicio, $row['description_m']);
    $sheet->setCellValue('C' . $filaInicio, $row['category']);
    $sheet->setCellValue('D' . $filaInicio, $row['ubication']);
	$sheet->setCellValue('E' . $filaInicio, $row['Stock']);
    
    $filaInicio++; // Avanzar a la siguiente fila	
}
// Opcional: Autoajustar el ancho de las columnas para que se lean bien
foreach (range('A', 'E') as $columna) {
    $sheet->getColumnDimension($columna)->setAutoSize(true);
}
// Configurar cabeceras HTTP para forzar la descarga en el navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Existencia_Materiales_' . date('Ymd') . '.xlsx"');
header('Cache-Control: max-age=0');
// 8. Crear el archivo y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
