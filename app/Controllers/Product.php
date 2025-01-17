<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;
use App\Models\ProductcategoryModel;
use App\Models\ProductModel;

class Product extends BaseController
{
  protected
    $productModel,
    $productCategoryModel,
    $session;

  public function __construct()
  {
    $this->productModel = new ProductModel();
    $this->productCategoryModel = new ProductcategoryModel();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $categories = $this->productCategoryModel->get();

    helper('form');
    $modules = (new Modules)->index();

    if (!$this->validate([])) {
      $data = [
        'title' => 'Produk',
        'modules' => $modules,
        'validation' => $this->validator,
        'categories' => $categories,
      ];
      return view('_content/_views/view_product_admin', $data);
    }
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->productModel->get();

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function process()
  {
    $sessionData = $this->session->get();

    $model = new ProductModel();
    if ($this->request->getMethod() !== 'post') {
      return redirect()->to('product');
    }
    $validation = $this->validate([
      'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
    ]);

    if ($validation == FALSE) {
      return redirect()->to('product')->with('gagal', 'Periksa kembali isian formulir!');;
    } else {
      $price = str_replace(".", "", $this->request->getPost('price'));
      $upload = $this->request->getFile('file_upload');
      $upload->move(WRITEPATH . '../public/assets/images/');
      $data = array(
        'name'  => $this->request->getPost('name'),
        'category'  => $this->request->getPost('category'),
        'price'  => $price,
        'description'  => $this->request->getPost('description'),
        'file' => $upload->getName(),
        'type' => $upload->getClientMimeType(),
        'stock'  => $this->request->getPost('stock'),
        'created_by'  => $sessionData['username'],
      );
      $model->save_product($data);
      return redirect()->to('product')->with('berhasil', 'Data Berhasil di Simpan');
    }
  }

  public function delete($id)
  {
    $product = $this->productModel->find($id);

    if (!$product) {
      return redirect()->to('/product')->with('gagal', 'Produk tidak ditemukan.');
    }

    if ($this->productModel->delete($id)) {
      return redirect()->to('/product')->with('berhasil', 'Produk berhasil dihapus.');
    } else {
      return redirect()->to('/product')->with('gagal', 'Gagal menghapus produk.');
    }
  }
  
}
