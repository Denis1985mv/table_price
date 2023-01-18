<?php

require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Font, Border, Alignment};

// $styleArray = [
//     'font' => [
//         'bold' => true,
//     ],
//     'alignment' => [
//         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
//     ],
//     'borders' => [
//         'top' => [
//             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
//         ],
//     ],
//     'fill' => [
//         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
//         'color' => [
//             'argb' => 'FFA0A0A0',
//         ]
//     ],
// ];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Название таблицы');
$sheet->mergeCells('A1:E1');
$sheet->setCellValue('A3', '№');
$sheet->setCellValue('B3', 'Название');
$sheet->setCellValue('C3', 'Параметр 1');
$sheet->setCellValue('D3', 'Параметр 2');
$sheet->setCellValue('E3', 'Параметр 3');
// Получаем ячейку для которой будем устанавливать стили
$sheet->getColumnDimension('B')->setWidth(40);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getRowDimension(3)->setRowHeight(20);
$sheet->getRowDimension(1)->setRowHeight(25);


$sheet->getStyle('A1')->applyFromArray([
    'font' => [
      'name' => 'Arial',
      'bold' => true,
      'size' => 16,
      'italic' => false,
      'underline' => false,
      'strikethrough' => false,
      'color' => [
          'rgb' => '000000'
        ]
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => [
                'rgb' => '808080'
            ]
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ]
]);

$sheet->getStyle('A3:E3')->applyFromArray([
    'font' => [
      'name' => 'Arial',
      'bold' => true,
      'italic' => false,
      'underline' => false,
      'strikethrough' => false,
      'color' => [
          'rgb' => 'F8F8FF'
        ]
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => [
                'rgb' => '808080'
            ]
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => [
            'rgb' => 'C71585',
        ]
    ]
]);



// Выбросим исключение в случае, если не удастся сохранить файл
try {
    $writer = new Xlsx($spreadsheet);
    $writer->save('task1.xlsx');

} catch (PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    echo $e->getMessage();
}