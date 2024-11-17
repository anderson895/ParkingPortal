<?php
require '../vendor/autoload.php'; // Ensure you have installed PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('../backend/class.php');
$db = new global_class();

$report_type = $_GET['report_type'];
$carId = $_GET['carID'];

// Fetch data based on report type
switch ($report_type) {
    case 'daily':
        $data = $db->fetch_daily_logHistory($carId);
        break;
    case 'weekly':
        $data = $db->fetch_weekly_logHistory($carId);
        break;
    case 'monthly':
        $data = $db->fetch_monthly_logHistory($carId);
        break;
    case 'yearly':
        $data = $db->fetch_yearly_logHistory($carId);
        break;
    default:
        $data = [];
        break;
}

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report');

// Set the title for the report
$sheet->setCellValue('A1', ucfirst($report_type) . ' Report'); // Title based on report type
$sheet->mergeCells('A1:H1'); // Merge title cell across the entire header row
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14); // Bold and increase font size for title
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Center align the title

// Set the headers for the columns
$headers = ['Date', 'Car Owner\'s Name', 'Vehicle Model', 'Plate Number', 'Condo Unit Number', 'RFID Number', 'Time In', 'Time Out'];
$sheet->fromArray($headers, NULL, 'A2'); // Start header from row 2 (below the title)

// Apply bold and centered style to headers
$sheet->getStyle('A2:H2')->getFont()->setBold(true);
$sheet->getStyle('A2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Set column widths to auto-size based on content
$columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
foreach ($columns as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true); // Auto size columns based on content
}

// Adjust row height for better spacing (optional)
$sheet->getRowDimension('1')->setRowHeight(30); // Title row height
$sheet->getRowDimension('2')->setRowHeight(25); // Header row height

// Fill the data
$row = 3; // Start row for data (after the header)
foreach ($data as $log) {
    $sheet->setCellValue("A$row", $log['time_date']);
    $sheet->setCellValue("B$row", $log['carName']);
    $sheet->setCellValue("C$row", $log['carType']);
    $sheet->setCellValue("D$row", $log['plateNumber']);
    $sheet->setCellValue("E$row", $log['condo']);
    $sheet->setCellValue("F$row", $log['RFID']);
    $sheet->setCellValue("G$row", $log['time_in']);
    $sheet->setCellValue("H$row", $log['time_out'] ?: 'No Time Out');
    $row++;
}

// Set the filename for the download
$filename = ucfirst($report_type) . '_Report_' . date('Y-m-d') . '.xlsx';

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write the file to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
