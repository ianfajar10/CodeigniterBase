<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        <?php foreach ($modules['all'] as $key => $module) { ?>
            <?php echo (count(explode('/', uri_string())) > 1 ? (explode('/', uri_string())[0] . '/' . explode('/', uri_string())[1] == $key ? $module[0] . ' - Trifecta Coffee' : null) : (uri_string() == $key ? $module[0] . ' - Trifecta Coffee' : null)) ?>
        <?php } ?>
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() . 'assets/img/favicon.png' ?>" rel="icon">
    <link href="<?= base_url() . 'assets/img/apple-touch-icon.png' ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() . 'assets/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/boxicons/css/boxicons.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/quill/quill.snow.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/quill/quill.bubble.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/simple-datatables/style.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . 'assets/vendor/bootstrap/css/input-numspin.min.css' ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() . 'assets/css/style.css' ?>" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Mar 09 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <?= $this->include('_base/_part/part_header') ?>

    <!-- ======= Sidebar ======= -->
    <?= $this->include('_base/_part/part_sidebar') ?>

    <!-- ======= Main Content ======= -->
    <main id="main" class="main">

        <!-- KEBUTUHAN PARAMETER AWAL -->
        <?php $session = session() ?>
        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
        <input type="hidden" id="user_id" value="<?php echo $session->get('username'); ?>">

        <div class="pagetitle">
            <?= $this->include('_base/_part/part_title') ?>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <?= $this->include('_base/_part/part_footer') ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="<?= base_url() . 'assets/vendor/apexcharts/apexcharts.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/chart.js/chart.umd.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/echarts/echarts.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/quill/quill.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/simple-datatables/simple-datatables.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/tinymce/tinymce.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/php-email-form/validate.js' ?>"></script>

    <script src="<?= base_url() . 'assets/js/main.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/js/input-numspin.min.js' ?>"></script>
    <script>
        $('input.numberformat').keyup(function(event) {

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            });
        });
    </script>

</body>

</html>