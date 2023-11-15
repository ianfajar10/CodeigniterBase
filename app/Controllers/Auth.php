<?php

namespace App\Controllers;

use App\Models\UserModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    protected
        $userModel,
        $validation,
        $session;

    public function __construct()
    {
        $this->userModel = new UserModel();

        $this->validation = \Config\Services::validation();

        $this->session = \Config\Services::session();

        require APPPATH . 'Libraries/phpmailer/src/Exception.php';
        require APPPATH . 'Libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'Libraries/phpmailer/src/SMTP.php';
    }

    public function login()
    {
        return view('_base/login');
    }

    public function register()
    {
        return view('_base/register');
    }

    public function valid_register()
    {
        //tangkap data dari form
        $data = $this->request->getPost();
        $email = $data['email'];

        if ($data['name'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Nama tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['username'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Nama pengguna tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['password'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Kata sandi tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['confirm'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Konfirmasi kata sandi tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['email'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Email tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        }

        $check_email = $this->userModel->check_email($email);

        if ($check_email) {
            $data = [
                'success' => false,
                'msg2' => 'Email sudah pernah digunakan!'
            ];
            return $this->response->setJSON($data);
        }

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
                $data = [
                    'success' => true,
                    'msg' => 'Anda berhasil mendaftar, silahkan login dan periksa kotak masuk pada email anda'
                ];
            } else {
                $data = [
                    'success' => false,
                    'msg2' => 'Anda gagal mendaftar'
                ];
            }

            return $this->send_email($email);
        }
    }

    public function send_email($email)
    {
        $mail = new PHPMailer();

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

        $mail->Timeout = 60; // timeout pengiriman (dalam detik)
        $mail->SMTPKeepAlive = true;

        $mail->From = "inigm10@gmail.com"; //email pengirim
        $mail->FromName = "Milestone Coffee"; //nama pengirim

        $mail->addAddress($email); //email penerima

        $mail->isHTML(true);
        $mail->Subject = 'Greeting Milestone Coffee'; //subject
        $mail->Body    = "Halo, selamat datang pengguna baru!"; //isi email
        $mail->AltBody = "PHP mailer"; //body email (optional)

        if (!$mail->send()) {
            $data = [
                'success' => false,
                'msg2' => 'Anda gagal mendaftar'
            ];
        } else {
            $data = [
                'success' => true,
                'msg' => 'Anda berhasil mendaftar, silahkan login dan periksa kotak masuk pada email anda'
            ];
        }

        return $this->response->setJSON($data);
    }


    public function valid_login()
    {
        $data = $this->request->getPost();


        $user = $this->userModel->check_login($data);

        if ($user) {
            $user = $user[0];
            if ($user['password'] != md5($data['password'])) {
                $data = [
                    'success' => false,
                    'msg' => 'Kata sandi tidak sesuai!'
                ];
                return $this->response->setJSON($data);
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set($sessLogin);
                $data = [
                    'success' => true,
                    'msg' => 'Anda berhasil masuk!'
                ];
                return $this->response->setJSON($data);
            }
        } else {
            $data = [
                'success' => false,
                'msg' => 'Nama pengguna tidak ditemukan!'
            ];
            return $this->response->setJSON($data);
        }
    }

    public function get_session()
    {
        $sessionData = $this->session->get();

        header('Content-Type: application/json');
        echo json_encode($sessionData);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
