<html>

<head>
    <title>Register - Trifecta Coffee</title>
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
    ?>
    <div class="card col-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Pengguna Baru</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" id="ajax_form">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Lengkap">
                        <label for="name">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama Pengguna">
                        <label for="username">Nama Pengguna</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi">
                        <label for="password">Kata Sandi</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Konfirmasi Kata Sandi">
                        <label for="confirm">Konfirmasi Kata Sandi</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="text-center">
                    <p>
                        <a href="<?php echo (base_url() . 'login') ?>">Sudah punya akun?</a>
                    </p>
                    <button type="submit" class="btn btn-primary" id="send_form">Buat</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#ajax_form").validate({
            submitHandler: function(form) {
                $('#send_form').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('auth/valid_register') ?>",
                    type: "POST",
                    data: $('#ajax_form').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil..',
                                html: response.msg,
                                showConfirmButton: false,
                                timer: 3000
                            }).then((result) => {
                                window.location.href = "<?php echo (base_url() . 'login') ?>";
                            })
                        } else {
                            let res = response.msg
                            const error = []
                            for (const [key, value] of Object.entries(res)) {
                                error.push(`<li>${value}</li>`)
                            }
                            let error_msg = error.join('')
                            Swal.fire({
                                icon: 'error',
                                title: 'Maaf..',
                                html: error_msg
                            })
                        }
                    }
                });
            }
        })
    </script>
</body>

</html>