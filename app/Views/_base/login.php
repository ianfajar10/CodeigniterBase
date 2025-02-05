<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon1.ico" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <!-- Menambahkan Font Awesome untuk ikon eye -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Styling untuk ikon eye */
        .password-container {
            position: relative;
        }

        .toggle-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/logo3.png" width="180" alt="">
                                </a>
                                <h4 class="text-center"> Masuk Akun</h4><br>
                                <form id="loginForm">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama Pengguna">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                                        <!-- Membungkus input password dengan div container -->
                                        <div class="password-container">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi">
                                            <!-- Ikon mata untuk toggle password -->
                                            <i class="fas fa-eye toggle-icon" onclick="togglePassword()"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Ingat Perangkat Ini
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="#">Lupa Kata Sandi ?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="submitButton">
                                        <span class="text-button" role="status" aria-hidden="true">Masuk</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Belum memiliki akun ?</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="text-primary fw-bold ms-2" href="<?php echo (base_url() . 'register') ?>">Buat akun Pembeli</a>
                                        <span class="mx-2">||</span>
                                        <a class="text-primary fw-bold ms-2" href="<?php echo (base_url() . 'register-mitra') ?>">Buat akun Penjual</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/login.js"></script>

    <!-- JavaScript untuk toggle password -->
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var icon = document.querySelector(".toggle-icon");

            // Cek apakah input password dalam mode tersembunyi atau tidak
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash"); // Ganti ikon menjadi "eye-slash"
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye"); // Kembalikan ikon menjadi "eye"
            }
        }
    </script>
</body>

</html>
