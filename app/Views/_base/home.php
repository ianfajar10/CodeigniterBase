<?php
$session = session();
$isLogin = $session->get('isLogin');
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.ico" />
  <!-- Author Meta -->
  <meta name="author" content="codepixer">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Milestone Coffee</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <!-- CSS ============================================= -->
  <link rel="stylesheet" href="../assets/home/css/linearicons.css">
  <link rel="stylesheet" href="../assets/home/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/home/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/home/css/magnific-popup.css">
  <link rel="stylesheet" href="../assets/home/css/nice-select.css">
  <link rel="stylesheet" href="../assets/home/css/animate.min.css">
  <link rel="stylesheet" href="../assets/home/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/home/css/main.css">

  <style>
    .no-decoration {
      text-decoration: none;
    }
  </style>
</head>

<body>

  <header id="header" id="home">
    <div class="header-top">
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
            <ul>
              <li>
                Selasa - Minggu : 10:00 sampai 22:00
              </li>
              <li>
                <a href="tel:(012) 6985 236 7512">(0813) 8126 4093</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row align-items-center justify-content-between d-flex">
        <div id="logo">
          <a href="index.html">
            <h2 class="text-white text-uppercase ml-3">Milestone Coffee</h2>
          </a>
        </div>
        <nav id="nav-menu-container">
          <ul class="nav-menu">
            <li class="menu-active"><a href="#home">Home</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#coffee">Produk</a></li>
            <?php if ($isLogin) { ?>
              <li class="menu-has-children"><a href=""><?php print_r($session->get('name')); ?></a>
                <ul>
                  <li>
                    <?php if ($session->get('name') == 'Super Admin') : ?>
                      <a href="<?= base_url() . 'dashboard' ?>">Beranda</a>
                    <?php else : ?>
                      <a href="<?= base_url() . 'history' ?>">Pesanan</a>
                    <?php endif; ?>
                  </li>
                  <li><a href="<?= base_url() . 'auth/logout' ?>" onclick="localStorage.clear()">Logout</a></li>
                </ul>
              </li>
            <?php } else { ?>
              <li><a href="<?= base_url() . 'login' ?>">Login</a></li>
            <?php } ?>
          </ul>
        </nav><!-- #nav-menu-container -->
      </div>
    </div>
  </header><!-- #header -->


  <!-- start banner Area -->
  <section class="banner-area" id="home">
    <div class="container">
      <div class="row fullscreen d-flex align-items-center justify-content-start">
        <div class="banner-content col-lg-7">
          <h1>
            Mulai hari dengan <br> secangkir kopi
          </h1>
          <a href="<?= base_url() . 'katalog' ?>" class="primary-btn text-uppercase">Pesan</a>
        </div>
      </div>
    </div>
  </section>
  <!-- End banner Area -->

  <!-- Start menu Area -->
  <section class="menu-area section-gap" id="coffee">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10">Apa yang kami sajikan untuk Anda</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach (array_slice($product, 0, 10) as $item) : ?>
          <div class="col-lg-4">
            <div class="single-menu">
              <div class="title-div justify-content-between d-flex">
                <h4><?= $item['name'] ?></h4>
                <p class="price float-right">Rp. <?= number_format($item['price'], 2, ',', '.') ?></p>
              </div>
              <p><?= strlen($item['description']) > 200 ? substr($item['description'], 0, 200) . '...' : $item['description']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
        <div class="col-lg-2">
          <div class="single-menu">
            <div class="title-div justify-content-between d-flex">
              <h4>Selengkapnya</h4>
            </div>
            <a href="<?= base_url() . 'katalog' ?>" class="no-decoration text-uppercase price" style="font-weight: bold; font-size:medium">Lihat katalog disini</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End menu Area -->

  <!-- Start gallery Area -->
  <section class="gallery-area section-gap" id="gallery">
    <div class="container">
      <!-- <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10">What kind of Coffee we serve for you</h1>
            <p>Who are in extremely love with eco friendly system.</p>
          </div>
        </div>
      </div> -->
      <div class="row">
        <div class="col-lg-4">
          <a href="../assets/home/img/g1.jpg" class="img-pop-home">
            <img class="img-fluid" src="../assets/home/img/g1.jpg" alt="">
          </a>
          <a href="../assets/home/img/g2.jpg" class="img-pop-home">
            <img class="img-fluid" src="../assets/home/img/g2.jpg" alt="">
          </a>
        </div>
        <div class="col-lg-8">
          <a href="../assets/home/img/g3.jpg" class="img-pop-home">
            <img class="img-fluid" src="../assets/home/img/g3.jpg" alt="">
          </a>
          <div class="row">
            <div class="col-lg-6">
              <a href="../assets/home/img/g4.jpg" class="img-pop-home">
                <img class="img-fluid" src="../assets/home/img/g4.jpg" alt="">
              </a>
            </div>
            <div class="col-lg-6">
              <a href="../assets/home/img/g5.jpg" class="img-pop-home">
                <img class="img-fluid" src="../assets/home/img/g5.jpg" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End gallery Area -->

  <!-- start footer Area -->
  <footer class="footer-area section-gap" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="single-footer-widget">
            <h6>Tentang Kami</h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
            </p>
            <p class="footer-text">
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>
                document.write(new Date().getFullYear());
              </script>
              All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by
              <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End footer Area -->

  <script src="../assets/home/js/vendor/jquery-2.2.4.min.js"></script>
  <script src="../assets/home/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="../assets/home/js/easing.min.js"></script>
  <script src="../assets/home/js/hoverIntent.js"></script>
  <script src="../assets/home/js/superfish.min.js"></script>
  <script src="../assets/home/js/jquery.ajaxchimp.min.js"></script>
  <script src="../assets/home/js/jquery.magnific-popup.min.js"></script>
  <script src="../assets/home/js/owl.carousel.min.js"></script>
  <script src="../assets/home/js/jquery.sticky.js"></script>
  <script src="../assets/home/js/jquery.nice-select.min.js"></script>
  <script src="../assets/home/js/parallax.min.js"></script>
  <script src="../assets/home/js/waypoints.min.js"></script>
  <script src="../assets/home/js/jquery.counterup.min.js"></script>
  <script src="../assets/home/js/mail-script.js"></script>
  <script src="../assets/home/js/main.js"></script>
</body>

</html>