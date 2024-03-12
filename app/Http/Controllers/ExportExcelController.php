<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelController extends Controller
{
    function export(Request $request){  
        $data = Group::with('products')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Group Name');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Content'); 
        $sheet->setCellValue('D1', 'Product Name');
        $sheet->setCellValue('E1', 'Product Group Name');
        $sheet->setCellValue('F1', 'Product Description');

        $row = 2;

        foreach($data as $group){
            $sheet->setCellValue('A'.$row, $group->group_name);
            $sheet->setCellValue('B'.$row, $group->title);
            $sheet->setCellValue('C'.$row, $group->content);
            $row++;
            foreach($group->products as $product){
                $sheet->setCellValue('D'.$row, $product->name);
                $sheet->setCellValue('E'.$row, $group->group_name);
                $sheet->setCellValue('F'.$row, $product->description);
                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = time().'-exported-data.xlsx';
        $writer->save($fileName);
        return response()->download($fileName);
    }
}
