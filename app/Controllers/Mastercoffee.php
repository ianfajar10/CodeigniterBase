<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DummyModel;

class Mastercoffee extends BaseController
{
  protected
    $dummyModel;

  public function __construct()
  {
    $this->dummyModel = new DummyModel();
  }

  public function index()
  {
    $modules = (new Modules)->index();
    $data = [
      'title' => 'Master Coffee',
      'modules' => $modules
    ];
    return view('_content/_views/view_master_coffee', $data);
  }
}
