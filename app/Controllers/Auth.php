<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected
        $userModel,
        $validation,
        $session;

    public function __construct()
    {
        //membuat user model untuk konek ke database 
        $this->userModel = new UserModel();

        //meload validation
        $this->validation = \Config\Services::validation();

        //meload session
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        //menampilkan halaman login
        return view('_base/login');
    }

    public function register()
    {
        //menampilkan halaman register
        return view('_base/register');
    }

    public function valid_register()
    {
        //tangkap data dari form 
        $data = $this->request->getPost();

        //jalankan validasi
        $this->validation->run($data, 'register');

        //cek errornya
        $errors = $this->validation->getErrors();

        //jika ada error kembalikan ke halaman register
        if ($errors) {
            session()->setFlashdata('error', $errors);
            $data = [
                'success' => false,
                'msg' => $this->validation->getErrors()
            ];

            return $this->response->setJSON($data);
        } else {
            //jika tdk ada error 
            $password = md5($data['password']);

            //masukan data ke database
            $data = [
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => $password,
                'email' => $data['email'],
                'role' => 2
            ];

            $this->userModel->save_data($data);

            $data = [
                'success' => true,
                'msg' => 'Anda berhasil mendaftar, silahkan login'
            ];

            //arahkan ke halaman login
            return $this->response->setJSON($data);
        }
    }

    public function valid_login()
    {
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $this->userModel->check_login($data);

        //ambil cart user login
        $cart = new CartModel();

        //cek apakah username ditemukan
        if ($user) {
            $user = $user[0];
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user['password'] != md5($data['password'])) {
                session()->setFlashdata('password', 'Password salah');
                return redirect()->to('login');
            } else {
                //jika benar, arahkan user masuk ke aplikasi 
                $sessLogin = [
                    'isLogin' => true,
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'cart' => count($cart->list_cart_user($user['username']))
                ];
                $this->session->set($sessLogin);
                return redirect()->to('/');
            }
        } else {
            //jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('login');
    }
}
