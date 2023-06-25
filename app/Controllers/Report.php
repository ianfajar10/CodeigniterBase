<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;
use App\Models\FileModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{
    public function index()
    {
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $model2 = new OrderModel();
        $id_user = ['username' => \Config\Services::session()->get('username')];
        $data = [
            'count_order' => count($model2->order_in_progress()),
            'critic' => $model->get_critic(),
            'critic_user' => $model->get_critic($id_user),
            'name' => 'report',
            'title' => 'Laporan',
            'modules' => $modules
        ];
        return view('_content/_views/view_report', $data);
    }
    
    public function download_profit()
    {
        $data = $this->request->getPost();
        $model = new OrderModel();
        $dataOrder = $model->list_history_order_user($data);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(60);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO. PESAN')
            ->setCellValue('B1', 'TOTAL ITEM')
            ->setCellValue('C1', 'TOTAL HARGA')
            ->setCellValue('D1', 'DISKON')
            ->setCellValue('E1', 'HARGA SETELAH DISKON');

        $column = 2;
        foreach ($dataOrder as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['id'])
                ->setCellValue('B' . $column, $data['total_item'])
                ->setCellValue('C' . $column, $data['total_price'])
                ->setCellValue('D' . $column, $data['discount'])
                ->setCellValue('E' . $column, $data['price_after_diskon']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pendapatan ' . date("Y-m-d");

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
        $model = new CriticModel();
        $dataCritic = $model->get_critic();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA PENGGUNA')
            ->setCellValue('B1', 'KRITIK')
            ->setCellValue('C1', 'DITULIS TANGGAL');

        $column = 2;
        foreach ($dataCritic as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['username'])
                ->setCellValue('B' . $column, $data['critic'])
                ->setCellValue('C' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Kritik dan Saran ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_unlike_menu()
    {
        $model = new FileModel();
        $dataCritic = $model->get_unlike_menu();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA MENU')
            ->setCellValue('B1', 'JUMLAH DIPESAN');

        $column = 2;
        foreach ($dataCritic as $data) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $column, $data['name'])
            ->setCellValue('B' . $column, $data['quantity'] ? $data['quantity'] : 0);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Menu Kurang Laris ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_user_loyal()
    {
        $model = new OrderModel();
        $dataCritic = $model->get_user_loyal();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NAMA PELANGGAN')
            ->setCellValue('B1', 'NAMA PENGGUNA')
            ->setCellValue('C1', 'JUMLAH PESANAN');

        $column = 2;
        foreach ($dataCritic as $data) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $column, $data['name'])
            ->setCellValue('B' . $column, $data['username'])
            ->setCellValue('C' . $column, $data['total'] ? $data['total'] : 0);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Menu Kurang Laris ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_order()
    {
        $data = $this->request->getPost();
        $model = new OrderModel();
        $dataOrder = $model->list_history_order_user($data);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(60);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO. PESAN')
            ->setCellValue('B1', 'STATUS')
            ->setCellValue('C1', 'PENGGUNA')
            ->setCellValue('D1', 'EMAIL')
            ->setCellValue('E1', 'TOTAL ITEM')
            ->setCellValue('F1', 'ITEM');

        $column = 2;
        foreach ($dataOrder as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['id'])
                ->setCellValue('B' . $column, $data['status'] == "pesanan_belum_diproses" ? "Pesanan Belum Diproses" : ($data['status'] == "pesanan_sedang_diproses" ? "Pesanan Sedang Diproses" : "Pembayaran Diterima"))
                ->setCellValue('C' . $column, $data['user_id'])
                ->setCellValue('D' . $column, $data['email'])
                ->setCellValue('E' . $column, $data['total_item'])
                ->setCellValue('F' . $column, $data['item']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pesanan ' . date("Y-m-d");

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
}
