<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class IsAdmin implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!session('isLogin')) {
      return redirect()->to(site_url('/login'));
    } else {
      if (session('role') != '1' && session('role') != '2') {
        return redirect()->to(site_url('/home'));
      }
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
