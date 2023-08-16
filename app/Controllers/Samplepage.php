<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;

class Samplepage extends BaseController
{
  protected
    $dummyModel;

  public function __construct()
  {
    $this->dummyModel = new DummyModel();
  }

  public function sample_page()
  {
    $modules = (new Modules)->index();
    $data = [
      'title' => 'Halaman Contoh',
      'modules' => $modules
    ];
    return view('_content/_views/view_sample_page', $data);
  }

  public function sample_data_tables()
  {
    $modules = (new Modules)->index();
    $data = [
      'title' => 'Data Tables Contoh',
      'modules' => $modules
    ];
    return view('_content/_views/view_sample_data_table', $data);
  }

  public function get_dummy()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->dummyModel->get_dummy();

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }
}
