<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DefaultRoute implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        return redirect()->to(base_url('/home'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
