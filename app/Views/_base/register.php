<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Codeigniter Base</title>

    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                                </a>
                                <p class="text-center">Your Social Campaigns</p>
                                <form id="ajax_form">
                                    <div class="mb-3">
                                        <label for="exampleNama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername" class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama Pengguna">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputConfirmPassword" class="form-label">Konfirmasi Kata Sandi</label>
                                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Konfirmasi Kata Sandi">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="submitButton">
                                        <span class="text-button" role="status" aria-hidden="true">Buat</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                                        <a class="text-primary fw-bold ms-2" href="<?= base_url() . 'login' ?>">Masuk</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="../assets/js/register.js"></script>
</body>

</html>