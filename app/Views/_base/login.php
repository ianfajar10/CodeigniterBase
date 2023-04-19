<html>

<head>
    <title>Tutorial Login Dan Register</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center 100vh">
    <?php
    $session = session();
    $login = $session->getFlashdata('login');
    $username = $session->getFlashdata('username');
    $password = $session->getFlashdata('password');
    ?>
    <?php if ($username) { ?>
        <p style="color:red"><?php echo $username ?></p>
    <?php } ?>

    <?php if ($password) { ?>
        <p style="color:red"><?php echo $password ?></p>
    <?php } ?>

    <?php if ($login) { ?>
        <p style="color:green"><?php echo $login ?></p>
    <?php } ?>

    <div class="card col-4">
        <div class="card-body">
            <h5 class="card-title">Masuk</h5>

            <!-- Floating Labels Form -->
            <form method="post" class="row g-3" action="<?php echo (base_url() . 'auth/valid_login') ?>">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama Pengguna">
                        <label for="username">Nama Pengguna</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Kata Sandi">
                        <label for="password">Kata Sandi</label>
                    </div>
                </div>
                <div class="text-center">
                    <p>
                        <a href="<?php echo (base_url() . 'register') ?>">Belum punya akun?</a>
                    </p>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>