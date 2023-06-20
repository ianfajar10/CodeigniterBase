<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;

class Critic extends BaseController
{
    protected $criticModel;

    public function __construct()
    {
        $this->criticModel = new CriticModel();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'critics',
            'title' => 'Kritik & Saran',
            'critic' => $this->criticModel->get_critic(),
            'modules' => $modules
        ];
        return view('_content/_views/view_critics', $data);
    }

    public function index_admin()
    {
        $modules = (new Modules)->index();
        $data = [
            'name' => 'criticsadmin',
            'title' => 'Kritik & Saran',
            'critic' => $this->criticModel->get_critic(),
            'modules' => $modules
        ];
        return view('_content/_views/view_critics_admin', $data);
    }

    // public function get_critic()
    // {
    //     $query = $this->criticModel->get_critic();
    //     return $this->response->setJSON($query);
    // }

    public function send()
    {
        $input = $this->request->getPost();

        $data = [
            'username' => $input['username'],
            'critic' => $input['critic']
        ];

        $save = $this->criticModel->save_data($data);

        if ($save) {
            $data = [
                'success' => true,
                'msg' => 'Berhasil, terimakasih telah memberi kritik dan saran.'
            ];
        } else {
            $data = [
                'success' => false,
                'msg' => 'Gagal memberi kritik dan saran.'
            ];
        }

        return $this->response->setJSON($data);
    }
}
