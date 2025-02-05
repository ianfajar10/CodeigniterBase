<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class Report extends BaseController
{
  protected
    $transactionModel;

  public function __construct()
  {
    $this->transactionModel = new TransactionModel();
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

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->transactionModel->get_report();

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function generate_pdf()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->transactionModel->get_report();

      $pdf = new \TCPDF();
      $pdf->AddPage();

      // Set judul dan konten PDF
      $no = 1;
      $pdf->SetFont('helvetica', '', 12);
      $html = '<h1 style="text-align: center; color: #000000;">Laporan Mitra</h1>';
      // Set zona waktu ke Jakarta
      date_default_timezone_set('Asia/Jakarta');

      // Format tanggal menggunakan IntlDateFormatter
      $formatter = new \IntlDateFormatter(
          'id_ID', 
          \IntlDateFormatter::FULL, 
          \IntlDateFormatter::LONG, 
          'Asia/Jakarta'
      );
      $formattedDate = $formatter->format(new \DateTime());

      // Menambahkan singkatan WIB manual
      $formattedDate .= ' WIB';

      // Menampilkan tanggal
      $html .= '<p style="text-align: left; font-size: 8px;">Tanggal Cetak : ' . $formattedDate . '</p>';

      $html .= '<table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse; margin: 20px auto; font-family: Arial, sans-serif; background-color: #fafafa;">
                      <thead>
                        <tr style="background-color: #0356fc; color: white; text-align: center;">
                          <th style="border: 1px solid black; padding: 12px; width: 5%;">No</th>
                          <th style="border: 1px solid black; padding: 12px; width: 15%;">Mitra</th>
                          <th style="border: 1px solid black; padding: 12px; width: 24%;">Email</th>
                          <th style="border: 1px solid black; padding: 12px; width: 18%;">Telepon</th>
                          <th style="border: 1px solid black; padding: 12px; width: 21%;">Provinsi</th>
                          <th style="border: 1px solid black; padding: 12px; width: 17%;">Produk Terjual</th>
                        </tr>
                      </thead>
                      <tbody>';

            // Loop untuk menampilkan data dari database
            foreach ($data as $row) {
              $html .= '<tr style="text-align: center; border-bottom: 1px solid #ddd;">
                  <td style="width: 5%;">' . $no . '</td>
                  <td style="width: 15%;">' . $row->name . '</td>
                  <td style="width: 24%;">' . $row->email . '</td>
                  <td style="width: 18%;">' . $row->telepon . '</td>
                  <td style="width: 21%;">' . $row->provinsi . '</td>
                  <td style="width: 17%;">' . $row->total_products_sold . '</td>
              </tr>';

              $no++;
            }    

      $html .= '</tbody></table>';
      
      // Menyisipkan HTML ke dalam PDF
      $pdf->writeHTML($html);
      
      // Output PDF ke browser
      $pdf->Output('Laporan Mitra.pdf', 'D');

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }
}
