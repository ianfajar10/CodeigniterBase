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
}
