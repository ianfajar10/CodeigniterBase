<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\RateModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'report',
            'title' => 'Laporan',
            'modules' => $modules
        ];
        return view('_content/_views/view_report', $data);
    }
    
    public function download_order()
    {
        $model = new OrderModel();
        $dataOrder = $model->list_history_order_user('date');

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(60);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO. PESAN')
            ->setCellValue('B1', 'PENGGUNA')
            ->setCellValue('C1', 'TOTAL ITEM')
            ->setCellValue('D1', 'TOTAL HARGA')
            ->setCellValue('E1', 'DISKON')
            ->setCellValue('F1', 'HARGA SETELAH DISKON')
            ->setCellValue('G1', 'STATUS');

        $column = 2;
        foreach ($dataOrder as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['id'])
                ->setCellValue('B' . $column, $data['user_id'])
                ->setCellValue('C' . $column, $data['total_item'])
                ->setCellValue('D' . $column, $data['total_price'])
                ->setCellValue('E' . $column, $data['discount'])
                ->setCellValue('F' . $column, $data['price_after_diskon'])
                ->setCellValue('G' . $column, $data['status'] == "menunggu_pembayaran" ? "Menunggu Pembayaran" : "Pembayaran Diterima");
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Penjualan ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_user()
    {
        $model = new UserModel();
        $dataUser = $model->list_user();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA')
            ->setCellValue('B1', 'EMAIL')
            ->setCellValue('C1', 'MULAI DAFTAR');

        $column = 2;
        foreach ($dataUser as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['name'])
                ->setCellValue('B' . $column, $data['email'])
                ->setCellValue('C' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pengguna ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_critic()
    {
        $model = new RateModel();
        $dataCritic = $model->get_comment();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA MENU')
            ->setCellValue('B1', 'NAMA PENGGUNA')
            ->setCellValue('C1', 'KOMENTAR')
            ->setCellValue('D1', 'WAKTU DITULIS');

        $column = 2;
        foreach ($dataCritic as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['menu_name'])
                ->setCellValue('B' . $column, $data['user_id'])
                ->setCellValue('C' . $column, $data['comment'])
                ->setCellValue('D' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Kritik & Saran ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
}
