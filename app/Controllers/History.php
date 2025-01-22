<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class History extends BaseController
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
            'title' => 'Riwayat Pesanan',
            'modules' => $modules
        ];
        return view('_content/_views/view_history', $data);
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->transactionModel->get();

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
  
}
