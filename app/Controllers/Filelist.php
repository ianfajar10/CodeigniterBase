<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;

class Filelist extends BaseController
{
    public function index()
    {
        $file = new FileModel();

        $modules = (new Modules)->index();
        $data = [
            'title' => 'Daftar File',
            'file' => $file->get_files(),
            'modules' => $modules
        ];
        return view('_content/_views/view_file_list', $data);
    }

    public function detail($params)
    {
        $file = new FileModel();

        $modules = (new Modules)->index();
        $data = [
            'title' => 'Detail File',
            'file' => $file->get_files($params),
            'rating' => 5,
            'modules' => $modules
        ];
        return view('_content/_views/view_file_list_detail', $data);
    }

    public function get_list_table()
    {
        $file = new FileModel();

        $db = \Config\Database::connect();

        $db->transStart(); // Memulai transaksi

        try {
            $data = $file->get_files();

            $db->transCommit(); // Commit transaksi
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaksi jika terjadi kesalahan
            return $this->response->setJSON(['error' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    public function drop()
    {
        $file = new FileModel();

        $db = \Config\Database::connect();

        $db->transStart(); // Memulai transaksi

        $data = $this->request->getPost();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $drop = $file->drop($data['id']);

            if ($drop) {
                $db->transCommit();
                return $this->response->setJSON(['success' => true, 'msg' => 'Katalog berhasil dihapus!']);
            } else {
                $db->transRollback();
                return $this->response->setJSON(['success' => false, 'msg' => 'Katalog gagal dihapus!']);
            }
        }
    }
}
