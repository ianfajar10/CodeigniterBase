<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends BaseController
{
    protected
        $order,
        $orderDetail,
        $user;

    public function __construct()
    {
        $this->order = new OrderModel();
        $this->orderDetail = new OrderDetailModel();
        $this->user = new UserModel();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'title' => 'Laporan',
            'modules' => $modules
        ];
        return view('_content/_views/view_report', $data);
    }

    public function printToPdf($type = null)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        $fileName = 'report.pdf';

        if ($type == 'user') {
            $getData = $this->user->list();
            $data = [
                'title' => 'Laporan Data Pengguna',
                'data'  => $getData
            ];
            $html = view('report/report_user', $data);
            $fileName = 'Laporan - Data Pengguna.pdf';
        } else if ($type == 'order') {
            $getData = $this->order->list();
            $data = [
                'title' => 'Laporan Data Pemesanan',
                'data'  => $getData
            ];
            $html = view('report/report_order', $data);
            $fileName = 'Laporan - Data Pemesanan.pdf';
        } else {
            $getData = $this->orderDetail->list();
            $data = [
                'title' => 'Laporan Data Produk Terjual',
                'data'  => $getData
            ];
            $html = view('report/report_katalog_in_order', $data);
            $fileName = 'Laporan - Data Produk Terjual.pdf';
        }

        // Muat konten HTML
        $dompdf->loadHtml($html);

        // Tetapkan ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML sebagai PDF
        $dompdf->render();

        // Simpan konten PDF ke file
        $pdfFilePath = WRITEPATH . 'uploads/' . $fileName; // Lokasi penyimpanan file PDF di direktori writable
        file_put_contents($pdfFilePath, $dompdf->output());

        // Beri tautan ke file PDF
        return $this->response->download($pdfFilePath, null)->setFileName($fileName);
    }
}
