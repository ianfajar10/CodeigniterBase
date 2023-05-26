<?php

namespace App\Controllers;

use App\Models\FileModel;

class Upload extends BaseController
{
    public function index()
    {
        helper('form');
        $modules = (new Modules)->index();
        $model = new FileModel();
        
        if (!$this->validate([])) {
            $data = [
                'name' => 'profile',
                'title' => 'Profil',
                'validation' => $this->validator,
                'file' => $model->get_files(),
                'modules' => $modules
            ];
            echo view('_content/_views/view_files', $data);
        }
    }

    public function process()
    {
        $model = new FileModel();
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('upload');
        }
        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
        ]);

        if ($validation == FALSE) {
            return redirect()->to('upload')->with('gagal', 'Periksa kembali dokumen!');;
        } else {
            $price = str_replace(".", "", $this->request->getPost('price'));
            $upload = $this->request->getFile('file_upload');
            $upload->move(WRITEPATH . '../public/assets/images/');
            $data = array(
                'name'  => $this->request->getPost('name'),
                'price'  => $price,
                'description'  => $this->request->getPost('description'),
                'file' => $upload->getName(),
                'type' => $upload->getClientMimeType()
            );
            $model->save_file($data);
            return redirect()->to('./upload')->with('berhasil', 'Data Berhasil di Simpan');
        }
    }

    public function delete_file(){
        $model = new FileModel();
        $params = $this->request->getPost();

        $get_data = $model->get_files($params['file_id'])[0];
        unlink('public\assets\images' . DIRECTORY_SEPARATOR . $get_data['file']);
        $delete = $model->delete_files($get_data['id']);
        if ($delete) {

            $response = [
                'success' => true,
                'msg' => 'Menu berhasil dihapus.'
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Menu gagal dihapus.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
