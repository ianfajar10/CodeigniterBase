<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class Order extends BaseController
{
  protected
    $transactionModel,
    $session;

  public function __construct()
  {
    $this->transactionModel = new TransactionModel();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $modules = (new Modules)->index();
        $data = [
            'title' => 'Riwayat Pesanan',
            'modules' => $modules
        ];
        return view('_content/_views/view_order', $data);
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $sessionData = $this->session->get();
      $params = null;

      if ($this->request->getVar('id') != null) {
        $data = $this->transactionModel->get($this->request->getVar('id'));
      } else {
        $data = $this->transactionModel->get($params, $sessionData['username']);
      }

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function delete($id)
  {
    $product = $this->transactionModel->find($id);

    if (!$product) {
      return redirect()->to('/product-category')->with('gagal', 'Kategori Produk tidak ditemukan.');
    }

    if ($this->transactionModel->delete($id)) {
      return redirect()->to('/product-category')->with('berhasil', 'Kategori Produk berhasil dihapus.');
    } else {
      return redirect()->to('/product-category')->with('gagal', 'Gagal menghapus Kategori produk.');
    }
  }

  public function update()
  {
    $id = $this->request->getVar('id');
    $order = $this->transactionModel->find($id);

    if (!$order) {
      return redirect()->to('/order')->with('gagal', 'Resi tidak ditemukan.');
    }

    $updatedData = [
      'receipt_number' => $this->request->getVar('receipt_number'),
      'paid_status' => 'Dikirim',
    ];

    if ($this->transactionModel->update($id, $updatedData)) {
      return redirect()->to('/order')->with('berhasil', 'Resi berhasil dihapus.');
    } else {
      return redirect()->to('/order')->with('gagal', 'Gagal menghapus Resi.');
    }
  }

  public function generate_pdf()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $sessionData = $this->session->get();
      $params = null;

      if ($this->request->getVar('id') != null) {
        $data = $this->transactionModel->get($this->request->getVar('id'));
      } else {
        $data = $this->transactionModel->get($params, $sessionData['username']);
      }

      $pdf = new \TCPDF();
      $pdf->AddPage();

      // Set judul dan konten PDF
      $no = 1;
      $pdf->SetFont('helvetica', '', 12);
      $html = '<h1 style="text-align: center; color: #000000;">Laporan Penjualan</h1>';

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
        <tr style="background-color: #eb8f34; color: white; text-align: center;">
          <th style="border: 1px solid black; padding: 12px; width: 5%;">No</th>
          <th style="border: 1px solid black; padding: 12px; width: 20%;">No Pesanan</th>
          <th style="border: 1px solid black; padding: 12px; width: 17%;">Pelanggan</th>
          <th style="border: 1px solid black; padding: 12px; width: 26%;">Nama Produk</th>
          <th style="border: 1px solid black; padding: 12px; width: 6%;">Qty</th>
          <th style="border: 1px solid black; padding: 12px; width: 14%;">Harga</th>
          <th style="border: 1px solid black; padding: 12px; width: 12%;">Status</th>
        </tr>
      </thead>
      
      <tbody>';

            // Loop untuk menampilkan data dari database
            foreach ($data as $row) {
              $html .= '<tr style="text-align: center; border-bottom: 1px solid #ddd;">
                  <td style="width: 5%;">' . $no . '</td>
                  <td style="width: 20%;">' . $row->id . '</td>
                  <td style="width: 17%;">' . $row->username . '</td>
                  <td style="width: 26%;">' . $row->product_name . '</td>
                  <td style="width: 6%;">' . $row->qty . '</td>
                  <td style="width: 14%;">' . number_format($row->price, 2, ',', '.') . '</td>
                  <td style="width: 12%;">' . $row->paid_status . '</td>
              </tr>';

              $no++;
            }    

      $html .= '</tbody></table>';
      
      // Menyisipkan HTML ke dalam PDF
      $pdf->writeHTML($html);
      
      // Output PDF ke browser
      $pdf->Output('Laporan Penjualan - '. $sessionData['name'] .'.pdf', 'D');

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }
}