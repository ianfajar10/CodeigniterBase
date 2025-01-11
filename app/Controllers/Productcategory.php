<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;
use App\Models\ProductcategoryModel;

class Productcategory extends BaseController
{
  protected
    $categoryModel;

  public function __construct()
  {
    $this->categoryModel = new ProductcategoryModel();
  }

  public function index()
  {
    helper('form');
    $modules = (new Modules)->index();

    if (!$this->validate([])) {
      $data = [
        'title' => 'Kategori Produk',
        'modules' => $modules,
        'validation' => $this->validator,
      ];
      return view('_content/_views/view_product_category', $data);
    }
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->categoryModel->get();

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function process()
  {
    $model = new ProductcategoryModel();
    if ($this->request->getMethod() !== 'post') {
      return redirect()->to('product-category');
    }
    $data = array(
      'name'  => $this->request->getPost('name'),
    );
    $model->save_file($data);
    return redirect()->to('product-category')->with('berhasil', 'Data Berhasil di Simpan');
  }

  public function delete($id)
  {
    $product = $this->categoryModel->find($id);

    if (!$product) {
      return redirect()->to('/product-category')->with('gagal', 'Kategori Produk tidak ditemukan.');
    }

    if ($this->categoryModel->delete($id)) {
      return redirect()->to('/product-category')->with('berhasil', 'Kategori Produk berhasil dihapus.');
    } else {
      return redirect()->to('/product-category')->with('gagal', 'Gagal menghapus Kategori produk.');
    }
  }
  
}
