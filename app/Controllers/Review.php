<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriticModel;
use App\Models\RateModel;

class Review extends BaseController
{
    protected $rateModel;

    public function __construct()
    {
        $this->rateModel = new RateModel();
    }

    public function index()
    {
        $modules = (new Modules)->index();
        $model = new CriticModel();
        $data = [
            'critic' => $model->get_critic(),
            'name' => 'review',
            'title' => 'Review Pelanggan',
            'review' => $this->rateModel->get_comment(),
            'modules' => $modules
        ];
        return view('_content/_views/view_review', $data);
    }
}
