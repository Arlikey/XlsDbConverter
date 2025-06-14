<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'src/DatabaseManager.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Src\DatabaseManager;

$db = new DatabaseManager();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $products = $db->getProductsWithCategory();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Price');
    $sheet->setCellValue('D1', 'Category Name');

    $row = 2;
    foreach ($products as $product) {
        $sheet->setCellValue("A{$row}", $product->id);
        $sheet->setCellValue("B{$row}", $product->name);
        $sheet->setCellValue("C{$row}", $product->price);
        $sheet->setCellValue("D{$row}", $product->category_name);
        $row++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="products.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    for ($i = 1; $i < count($rows); $i++) {
        [$id, $name, $price, $category] = $rows[$i];

        $db->insertProduct([
            'name' => $name,
            'price' => $price,
            'category_name' => $category
        ]);
    }

    $_SESSION['success'] = "Products uploaded successfully!";

    header('Location: index.php');
    exit;
}
?>
