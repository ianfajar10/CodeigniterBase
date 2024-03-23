<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;
use App\Models\FileModel;

class Mastercoffee extends BaseController
{
  protected
    $dummyModel,
    $fileModel;

  public function __construct()
  {
    $this->dummyModel = new DummyModel();
    $this->fileModel = new FileModel();
  }

  public function index()
  {
    helper('form');
    $modules = (new Modules)->index();

    if (!$this->validate([])) {
      $data = [
        'title' => 'Master Coffee',
        'modules' => $modules,
        'validation' => $this->validator,
      ];
      echo view('_content/_views/view_master_coffee', $data);
    }
  }

  public function get_crud()
  {
    $db = \Config\Database::connect();

    $db->transStart(); // Memulai transaksi

    try {
      $data = $this->fileModel->get_files();

      $db->transCommit(); // Commit transaksi
      return $this->response->setJSON($data);
    } catch (\Exception $e) {
      $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
      return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
  }

  public function process()
  {
    $model = new FileModel();
    if ($this->request->getMethod() !== 'post') {
      return redirect()->to('master-coffee');
    }
    $validation = $this->validate([
      'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
    ]);

    if ($validation == FALSE) {
      return redirect()->to('master-coffee')->with('gagal', 'Periksa kembali isian formulir!');;
    } else {
      $type = $this->request->getPost('typeMenu');
      $price = str_replace(".", "", $this->request->getPost('price'));
      $upload = $this->request->getFile('file_upload');
      $upload->move(WRITEPATH . '../public/assets/images/');
      $data = array(
        'name'  => $this->request->getPost('variant') ? $this->request->getPost('name') . ' (Hot & Ice)' : $this->request->getPost('name'),
        'price'  => $price,
        'description'  => $this->request->getPost('description'),
        'file' => $upload->getName(),
        'type' => $upload->getClientMimeType(),
        'additional' => $type,
      );
      $model->save_file($data);
      return redirect()->to('master-coffee')->with('berhasil', 'Data Berhasil di Simpan');
    }
  }

}
