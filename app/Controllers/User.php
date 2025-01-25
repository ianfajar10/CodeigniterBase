<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;
use App\Models\UserModel;

class User extends BaseController
{
  protected
    $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function index()
  {
    $modules = (new Modules)->index();
    $data = [
      'title' => 'Halaman Data Pengguna',
      'modules' => $modules
    ];
    return view('_content/_views/view_user', $data);
  }

  public function index_mitra()
  {
    $modules = (new Modules)->index();
    $data = [
      'title' => 'Halaman Data Penjual',
      'modules' => $modules
    ];
    return view('_content/_views/view_user_mitra', $data);
  }

  public function get()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $roles = '3';
      $data = $this->userModel->get($roles);

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function get_mitra()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $roles = '2';
      $data = $this->userModel->get($roles);

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }
}
