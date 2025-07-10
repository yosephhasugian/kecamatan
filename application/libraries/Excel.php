<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Excel
{
    public function create()
    {
        return new Spreadsheet();
    }

    public function download($spreadsheet, $filename = 'Laporan.xls')
    {
        $writer = new Xls($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
