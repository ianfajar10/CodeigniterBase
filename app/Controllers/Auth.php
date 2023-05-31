<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\UserModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";

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

            $save = $this->userModel->save_data($data);

            if ($save) {
                $mail = new PHPMailer;

                //Enable SMTP debugging. 
                $mail->SMTPDebug = 0;
                //Set PHPMailer to use SMTP.
                $mail->isSMTP();
                //Set SMTP host name                          
                $mail->Host = "tls://smtp.gmail.com"; //host mail server
                //Set this to true if SMTP host requires authentication to send email
                $mail->SMTPAuth = true;
                //Provide username and password     
                $mail->Username = "inigm10@gmail.com";   //nama-email smtp          
                $mail->Password = "kxjasgmtigetxzeo";           //password email smtp
                //If SMTP requires TLS encryption then set it
                $mail->SMTPSecure = "tls";
                //Set TCP port to connect to 
                $mail->Port = 587;

                $mail->From = "inigm10@gmail.com"; //email pengirim
                $mail->FromName = "Trifecta App"; //nama pengirim

                $mail->addAddress($data['email']); //email penerima

                $mail->isHTML(true);
                $mail->Subject = 'Kode Promo Trifecta App'; //subject
                $mail->Body    = "Selamat!, anda berhak mendapatkan kode potongan Rp10.000. Gunakan kode 'PENGGUNABARU' saat melakukan pesanan. "; //isi email
                $mail->AltBody = "PHP mailer"; //body email (optional)

                if (!$mail->send()) {
                    $data = [
                        'success' => false,
                        'msg' => 'Anda gagal mendaftar'
                    ];
                } else {
                    $data = [
                        'success' => true,
                        'msg' => 'Anda berhasil mendaftar, silahkan login dan periksa kotak masuk pada email anda'
                    ];
                }
            }

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
