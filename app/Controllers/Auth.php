<?php

namespace App\Controllers;

use App\Models\RajaOngkirModel;
use App\Models\UserModel;
use GuzzleHttp\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    protected
        $userModel,
        $validation,
        $session,
        $raja_ongkir;

    public function __construct()
    {
        $this->userModel = new UserModel();

        $this->validation = \Config\Services::validation();

        $this->session = \Config\Services::session();

        $this->raja_ongkir = new RajaOngkirModel();

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
        $url = 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json';

        // Membuat client Guzzle untuk melakukan request HTTP
        $client = new Client();

        try {
            $response = $client->request('GET', $url);

            $data = json_decode($response->getBody()->getContents(), true);

            return view('_base/register', ['provinces' => $data]);
        } catch (\Exception $e) {
            return view('error_view', ['message' => 'Error fetching data']);
        }
    }

    public function getKabupaten()
    {
        // Mendapatkan provinsiId yang dikirim via POST
        $provinsiId = $this->request->getPost('provinsiId');

        // URL API untuk mendapatkan data kabupaten berdasarkan provinsi
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinsiId}.json";

        $client = new Client();

        try {
            // Melakukan request GET ke API
            $response = $client->request('GET', $url);

            // Mendapatkan body dari response dan meng-decode JSON menjadi array
            $data = json_decode($response->getBody()->getContents(), true);

            // Mengirimkan data kabupaten dalam format JSON
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            // Menangani jika terjadi error
            return $this->response->setJSON([]);
        }
    }

    public function getKecamatan()
    {
        $kabupatenId = $this->request->getPost('kabupatenId');
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$kabupatenId}.json";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $url);
            return $this->response->setJSON(json_decode($response->getBody(), true));
        } catch (\Exception $e) {
            return $this->response->setJSON([]);
        }
    }

    public function register_mitra()
    {
        try {
            $provinces = $this->raja_ongkir->getProvinces();

            return view('_base/register_mitra', ['provinces' => $provinces]);
        } catch (\Exception $e) {
            return view('error_view', ['message' => 'Error fetching data']);
        }
    }

    public function getCities($provinceId)
    {
        $cities = $this->raja_ongkir->getCities($provinceId);

        return json_encode($cities);
    }
    
    public function valid_register()
    {
        //tangkap data dari form
        $data = $this->request->getPost();
        $email = $data['email'];
        $provinsi = null;
        $kabupaten = null;
        $kecamatan = null;

        
        $url = 'https://emsifa.github.io/api-wilayah-indonesia/api/province/' . $data['provinsi'] . '.json';
        
        $client = new Client();
        
        try {
            $response = $client->request('GET', $url);
            
            $datas = json_decode($response->getBody()->getContents(), true);
            
            $provinsi = $datas['name'];
            
        } catch (\Exception $e) {
            return view('error_view', ['message' => 'Error fetching data']);
        }
        
        $url2 = 'https://emsifa.github.io/api-wilayah-indonesia/api/regency/' . $data['kabupaten'] . '.json';

        $client2 = new Client();

        try {
            $response = $client2->request('GET', $url2);

            $datas = json_decode($response->getBody()->getContents(), true);

            $kabupaten = $datas['name'];
            
        } catch (\Exception $e) {
            return view('error_view', ['message' => 'Error fetching data']);
        }

        $url3 = 'https://emsifa.github.io/api-wilayah-indonesia/api/district/' . $data['kecamatan'] . '.json';

        $client3 = new Client();

        try {
            $response = $client3->request('GET', $url3);
            
            $datas = json_decode($response->getBody()->getContents(), true);
            
            $kecamatan = $datas['name'];
            
        } catch (\Exception $e) {
            return view('error_view', ['message' => 'Error fetching data']);
        }

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
        } else if ($data['telepon'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Telepon tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['provinsi'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Provinsi tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['kabupaten'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Kabupaten/Kota tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['kecamatan'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Kecamatan tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['alamat'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Alamat tidak boleh kosong!'
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
                'telepon' => $data['telepon'] ?? null,
                'bank' => $data['bank'] ?? null,
                'rekening' => $data['rekening'] ?? null,
                'rekening_name' => $data['rekening_name'] ?? null,
                'provinsi' => $provinsi ?? null,
                'kabupaten' => $kabupaten ?? null,
                'kecamatan' => $kecamatan ?? null,
                'alamat' => $data['alamat'] ?? null,
                'role' => $data['user_type'] ?? 3
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

    public function valid_register_mitra()
    {
        //tangkap data dari form
        $data = $this->request->getPost();
        $email = $data['email'];

        $getAllApi = $this->raja_ongkir->getAllNames($data['kabupaten_mitra']);

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
        } else if ($data['telepon'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Telepon tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['provinsi_mitra'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Provinsi tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['kabupaten_mitra'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Kabupaten/Kota tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['district'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Kecamatan tidak boleh kosong!'
            ];
            return $this->response->setJSON($data);
        } else if ($data['alamat'] == null) {
            $data = [
                'success' => false,
                'msg2' => 'Alamat tidak boleh kosong!'
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
                'telepon' => $data['telepon'] ?? null,
                'bank' => $data['bank'] ?? null,
                'rekening' => $data['rekening'] ?? null,
                'rekening_name' => $data['rekening_name'] ?? null,
                'provinsi' => $getAllApi->province ?? null,
                'kabupaten' => $getAllApi->city_name ?? null,
                'kecamatan' => $data['district'] ?? null,
                'alamat' => $data['alamat'] ?? null,
                'origin' => $data['origin'] ?? null,
                'role' => $data['user_type'] ?? 3
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
        $mail->Password = "epwljcmgijkgyoyp";           //password email smtp
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $mail->Timeout = 60; // timeout pengiriman (dalam detik)
        $mail->SMTPKeepAlive = true;

        $mail->From = "inigm10@gmail.com"; //email pengirim
        $mail->FromName = "Codeigniter Base"; //nama pengirim

        $mail->addAddress($email); //email penerima

        $mail->isHTML(true);
        $mail->Subject = 'Greeting Codeigniter Base'; //subject
        $mail->Body    = "Halo, selamat datang pengguna baru!"; //isi email
        $mail->AltBody = "PHP mailer"; //body email (optional)

        if (!$mail->send()) {
            $data = [
                'success' => false,
                'msg2' => 'Anda gagal mendaftar 2'
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
                    'email' => $user['email'],
                    'bank' => $user['bank'],
                    'rekening' => $user['rekening'],
                    'rekening_name' => $user['rekening_name'],
                    'telepon' => $user['telepon'],
                    'provinsi' => $user['provinsi'],
                    'kabupaten' => $user['kabupaten'],
                    'kecamatan' => $user['kecamatan'],
                    'alamat' => $user['alamat'],
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
