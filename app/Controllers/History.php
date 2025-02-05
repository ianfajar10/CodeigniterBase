<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\RateModel;

class History extends BaseController
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
            'title' => 'Riwayat Transaksi',
            'modules' => $modules
        ];
        return view('_content/_views/view_history', $data);
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $sessionData = $this->session->get();
      $params = null;
      $params2 = null;
      $data = $this->transactionModel->get($params, $params2, $sessionData['username']);

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

  public function processAndRating()
  {
    $session = session();
    $model = new RateModel();
    $model2 = new TransactionModel();
    $id = $this->request->getVar('id');

    $productId = $model2->get($id);

    $productId = $productId[0]->product_id;
    if ($this->request->getMethod() !== 'post') {
      return redirect()->to('history');
    }
    $data = array(
      'product_id'  => $productId,
      'username' => $session->get('username'),
      'rate'  => $this->request->getVar('rating'),
    );

    $updatedData = [
      'paid_status' => 'Diterima',
    ];

    $model->save_file($data);
    $model2->update($id, $updatedData);
    return redirect()->to('history');
  }

  public function getRating()
  {
    $session = session();
    $username = $session->get('username');
    $id = $this->request->getVar('id');

    $db = \Config\Database::connect();
    $db->transStart(); // Memulai transaksi

    try {
      $model = new RateModel();
      $model2 = new TransactionModel();
      $transaction = $model2->get($id);

      $status = $transaction[0]->paid_status;
      $productId = $transaction[0]->product_id;
      $data = $model->get($productId, $username);

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON(['rating' => $data[0]['rate'], 'status' => $status]);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }
}