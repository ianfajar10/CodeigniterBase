<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;

class Katalog extends BaseController
{
    protected $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }
    
    public function index()
    {
        $getFiles = $this->fileModel->get_files();
        $data = [
            'title' => 'Katalog',
            'product' => $getFiles,
        ];
        return view('_base/katalog', $data);
    }
    
    public function detail()
    {
        $idByUri = $this->request->uri->getSegment(3);

        $getFiles = $this->fileModel->get_files($idByUri);
        $data = [
            'title' => 'Detail Produk',
            'product' => $getFiles,
        ];
        return view('_base/detail_katalog', $data);
    }

    public function search($query = null)
    {
        $query = $this->request->getPost('search_query');
        $filter = $this->request->getPost('filterValue');

        $file = new FileModel();

        $modules = (new Modules)->index($query);
        $data = [
            'title' => 'Katalog',
            'product' => $filter == '' ? $file->get_files_by_search($query) : $file->get_files_by_filter($filter),
            'query' => $query,
            'filter' => $filter,
            'modules' => $modules
        ];
        return view('_base/katalog', $data);
    }
}
