<?php

namespace App\Controllers;

use App\Models\CriticModel;
use App\Models\FileModel;
use App\Models\OrderModel;

class Upload extends BaseController
{
    public function index()
    {
        helper('form');
        $modules = (new Modules)->index();
        $model = new FileModel();
        $model2 = new CriticModel();
        $model3 = new OrderModel();
        $id_user = ['username' => \Config\Services::session()->get('username')];
        
        if (!$this->validate([])) {
            $data = [
                'count_order' => count($model3->order_in_progress()),
                'critic' => $model2->get_critic(),
                'critic_user' => $model->get_critic($id_user),
                'name' => 'unggah',
                'title' => 'Unggah Menu',
                'validation' => $this->validator,
                'file' => $model->get_files(),
                'modules' => $modules
            ];
            echo view('_content/_views/view_files', $data);
        }
    }
    
    public function index_banner()
    {
        helper('form');
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $model2 = new OrderModel();
        $id_user = ['username' => \Config\Services::session()->get('username')];
        
        if (!$this->validate([])) {
            $data = [
                'count_order' => count($model2->order_in_progress()),
                'critic' => $model->get_critic(),
                'critic_user' => $model->get_critic($id_user),
                'name' => 'banner',
                'title' => 'Banner',
                'validation' => $this->validator,
                'modules' => $modules
            ];
            echo view('_content/_views/view_banner', $data);
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
            if ($this->request->getPost('bundling')) {
                $name = 'Bundling ' . $this->request->getPost('name');
            } else {
                $name = $this->request->getPost('food') ? 'Makanan ' . $this->request->getPost('name') : 'Minuman ' . $this->request->getPost('name');
            }
            $data = array(
                'name'  => $name,
                'price'  => $price,
                'description'  => $this->request->getPost('description'),
                'file' => $upload->getName(),
                'type' => $upload->getClientMimeType(),
                'best' => $this->request->getPost('best') ? $this->request->getPost('best') : null,
            );
            $model->save_file($data);
            return redirect()->to('./upload')->with('berhasil', 'Data Berhasil di Simpan');
        }
    }

    public function banner_process()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('banner');
        }
        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg]|max_size[file_upload,4096]'
        ]);
        
        if ($validation == FALSE) {
            return redirect()->to('banner')->with('gagal', 'Periksa kembali dokumen!');;
        } else {
            unlink('assets/img/banner.jpg');
            $upload = $this->request->getFile('file_upload');
            $upload->move(WRITEPATH . '../assets/img/', 'banner.jpg');
            return redirect()->to('./banner')->with('berhasil', 'Data Berhasil di Simpan');
        }
    }

    public function delete_file(){
        $model = new FileModel();
        $params = $this->request->getPost();

        $get_data = $model->get_files($params['file_id'])[0];
        unlink('public/assets/images' . DIRECTORY_SEPARATOR . $get_data['file']);
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
