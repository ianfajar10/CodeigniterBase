<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ogani Template">
  <meta name="keywords" content="Ogani, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon1.ico" />
  <title>FreeZzeMart</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="../assets/home/ogani/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="../assets/home/ogani/css/style.css" type="text/css">

  <style>
    .no-decoration {
      text-decoration: none !important;
    }
  </style>

  <!-- Awal Style Session metode pembayaran -->
  <style>
    .payment-methods {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
    }

    .payment-methods img {
      width: 70px;
      height: auto;
    }
  </style>
  <!-- Akhir Style Session metode pembayaran -->

  <!-- awal style session layanan logistik -->
  <style>
    .shipping-services {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }

    .shipping-services img {
      width: 100px;
      height: auto;
    }
  </style>
  <!-- akhir style session layanan logistik -->

</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="#"><img src="../assets/home/ogani/img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
      <ul>
        <?php if (isset($session['username']) && $session['username'] != null): ?>
          <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
          <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        <?php endif; ?>
      </ul>
      <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
      <div class="header__top__right__language">
        <img src="../assets/home/ogani/img/language.png" alt="">
        <div>English</div>
        <span class="arrow_carrot-down"></span>
        <ul>
          <li><a href="#">Spanis</a></li>
          <li><a href="#">English</a></li>
        </ul>
      </div>
      <div class="header__top__right__auth">
        <a href="#"><i class="fa fa-user"></i> <?php echo $session['name'] ?? 'Login' ?></a>
      </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
      <ul>
        <li class="active"><a href="./home">Home</a></li>
        <li><a href="./shop-grid.html">Shop</a></li>
        <li><a href="./blog.html">Blog</a></li>
        <li><a href="./contact.html">Contact</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
        <li>Free Shipping for all Order of $99</li>
      </ul>
    </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="header__logo">
            <a href="./home"><img src="../assets/home/ogani/img/logo3.png" alt=""></a>
          </div>
        </div>
        <div class="col-lg-7">
          <nav class="header__menu">
            <ul>
              <li class="active"><a href="./home"><i class="fa fa-home"></i> Beranda </a></li>
              <li><a href="./blog.html"><i class="fa fa-fire"></i> Terlaris </a></li>
              <li><a href="./contact.html"><i class="fa fa-plus-circle"></i> Terbaru </a></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-2">
          <div class="header__menu">
            <ul>
              <?php if (isset($session['username']) && $session['username'] != null): ?>
                <li><a href="../profile/favorite"><i class="fa fa-heart"></i><span id="favorite-count"><?php echo $favorite_count ?></span></a></li>
              <?php else: ?>
                <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Daftar</a>
                  <ul class="header__menu__dropdown">
                    <li><a href="/register">Pengguna</a></li>
                    <li><a href="/register-mitra">Penjual</a></li>
                  </ul>
                </li>
              <?php endif; ?>
              <li><a href="<?= base_url() . 'dashboard' ?>" style="text-decoration: none"><i class="fa fa-user"></i> <?= $firstName = explode(' ', $session['name'] ?? 'Login')[0]; ?></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="humberger__open">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- Hero Section Begin -->
  <section class="hero">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="hero__categories">
            <div class="hero__categories__all">
              <i class="fa fa-bars"></i>
              <span>Jenis Produk </span>
            </div>
            <ul>
              <?php foreach ($categories as $category): ?>
                <li><a href="/search?keyword=<?= urlencode(strtolower($category['name'])) ?>"><?= $category['name'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="hero__search">
            <div class="hero__search__form">
              <form action="#">
                <input type="text" placeholder="Apa yang kamu cari ?">
                <button type="submit" class="site-btn"> Cari</button>
              </form>
            </div>
          </div>

          <!-- awal session bagian carousel -->
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../assets/home/ogani/img/hero/banner1.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="../assets/home/ogani/img/hero/banner.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="../assets/home/ogani/img/hero/banner1.png" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <!-- akhir session bagian carousel -->

          <!-- <div class="hero__item set-bg" data-setbg="../assets/home/ogani/img/hero/banner1.png">
            
            <div class="hero__text">
              <span>FRUIT FRESH</span>
              <h2>Vegetable <br />100% Organic</h2>
              <p>Free Pickup and Delivery Available</p>
              <a href="#" class="primary-btn">SHOP NOW</a>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Categories Section Begin -->
  <?php if (!($keywords)): ?>
    <section class="categories">
      <div class="container">
        <div class="row">
          <div class="categories__slider owl-carousel">
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../assets/home/ogani/img/categories/cat-1.jpg">
                <h5><a href="#">Fresh Fruit</a></h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../assets/home/ogani/img/categories/cat-2.jpg">
                <h5><a href="#">Dried Fruit</a></h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../assets/home/ogani/img/categories/cat-3.jpg">
                <h5><a href="#">Vegetables</a></h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../assets/home/ogani/img/categories/cat-4.jpg">
                <h5><a href="#">drink fruits</a></h5>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="categories__item set-bg" data-setbg="../assets/home/ogani/img/categories/cat-5.jpg">
                <h5><a href="#">drink fruits</a></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
  <?php endif; ?>
  <!-- Categories Section End -->

  <!-- Featured Section Begin -->
  <section class="featured spad" style="padding-top: <?= $keywords ? '0px' : '80px'; ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Featured Product</h2>
          </div>
        </div>
      </div>
      <div class="row featured__filter">
        <?php if (!empty($products)): ?>
          <?php foreach ($products as $product): ?>
            <div class="col-lg-2 col-md-4 col-sm-6 mix">
              <div class="featured__item">
                <div class="featured__item__pic set-bg" data-setbg="../public/assets/images/<?= $product->file ?>">
                  <ul class="featured__item__pic__hover">
                    <?php if (!isset($session['role']) || ($session['role'] != 1 && $session['role'] != 2)): ?>
                      <li><a href="/home/details/<?php echo $product->id ?>"><i class="fa fa-info"></i></a></li>
                      <?php if (isset($session['username']) && $session['username'] != null): ?>
                        <li>
                          <a href="javascript:void(0);" id="love-button" data-product-id="<?php echo $product->id; ?>">
                            <i class="fa <?php echo $product->love == 1 ? 'fa-heart' : 'fa-heart-o'; ?>"></i>
                          </a>
                        </li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                      <?php endif; ?>
                    <?php endif; ?>
                  </ul>
                </div>
                <div class="featured__item__text">
                  <h6><a href="#"><?= $product->name ?></a></h6>
                  <h6><a href="#"><?= $product->mitra_name ?></a></h6>
                  <h5>Rp <?= $product->price ?>,-</h5>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12">
            <p class="text-center">Produk tidak ditemukan.</p>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </section>
  <!-- Featured Section End -->

  <!-- Footer Section Begin -->
  <footer class="footer spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="footer__about">
            <div class="footer__about__logo">
              <a href="./home"><img src="../assets/home/ogani/img/logo3.png" alt=""></a>
            </div>
            <p class="text-justify" style="color: black;">FreeZzemart merupakan platform online yang menghubungkan penjual dan pembeli produk makanan beku. Menyediakan berbagai pilihan jenis produk dan harga yang kompetitif, serta kemudahan dalam pencarian produk. Yuk Belanja Sekarang</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
          <div class="footer__widget">
            <h6>Metode Pembayaran</h6><hr>
            <div class="payment-methods">
              <img src="../assets/home/ogani/img/payment/bni.png" alt="BNI">  
              <img src="../assets/home/ogani/img/payment/bca.png" alt="BCA">
              <img src="../assets/home/ogani/img/payment/mandiri.png" alt="Mandiri">
              <img src="../assets/home/ogani/img/payment/brivabri.png" alt="BRIVA">
              <img src="../assets/home/ogani/img/payment/alto.png" alt="Alto">
              <img src="../assets/home/ogani/img/payment/prima.png" alt="Prima">
              <img src="../assets/home/ogani/img/payment/atmbersama.png" alt="Atm Bersama">
              <img src="../assets/home/ogani/img/payment/permata.png" alt="Permata">
              <img src="../assets/home/ogani/img/payment/cimbniaga.png" alt="Cimb Niaga">
              <img src="../assets/home/ogani/img/payment/shopeepay.png" alt="Shopeepay">
              <img src="../assets/home/ogani/img/payment/qris.png" alt="Qris">
              <img src="../assets/home/ogani/img/payment/dana.png" alt="Dana">
              <img src="../assets/home/ogani/img/payment/gopay.png" alt="Gopay">
              <img src="../assets/home/ogani/img/payment/indomaret.png" alt="Indomaret">
              <img src="../assets/home/ogani/img/payment/alfamart.png" alt="Alfamart">
              <img src="../assets/home/ogani/img/payment/alfamidi.png" alt="Alfamidi">
              <img src="../assets/home/ogani/img/payment/dandan.png" alt="DanDan">
            </div>
          </div>
        </div>

        <!-- awal session layanan pengiriman -->
        <div class="col-lg-4 col-md-12">
          <div class="footer__widget">
            <h6>Layanan Pengiriman</h6><hr>
            <div class="payment-methods">
              <img src="../assets/home/ogani/img/logistik/posind.png" alt="POSIND">
              <img src="../assets/home/ogani/img/logistik/tiki.png" alt="TIKI">
              <img src="../assets/home/ogani/img/logistik/jne.png" alt="JNE">
            </div>
          </div>
        </div>
        <!-- akhir session layanan pengiriman -->
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->
  <footer class="bg-primary text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2025 Nama Perusahaan. Semua Hak Dilindungi.</p>
            <p>Desain oleh <a href="https://www.example.com" class="text-white">Nama Anda</a></p>
        </div>
    </footer>

  <!-- Js Plugins -->
  <script src="../assets/home/ogani/js/jquery-3.3.1.min.js"></script>
  <script src="../assets/home/ogani/js/bootstrap.min.js"></script>
  <script src="../assets/home/ogani/js/jquery.nice-select.min.js"></script>
  <script src="../assets/home/ogani/js/jquery-ui.min.js"></script>
  <script src="../assets/home/ogani/js/jquery.slicknav.js"></script>
  <script src="../assets/home/ogani/js/mixitup.min.js"></script>
  <script src="../assets/home/ogani/js/owl.carousel.min.js"></script>
  <script src="../assets/home/ogani/js/main.js"></script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '#love-button', function() {
        var productId = $(this).data('product-id');
        console.log('Product ID:', productId); // Cek apakah product_id benar
        $.ajax({
          url: '/home/love', // Pastikan URL benar
          type: 'POST',
          data: {
            product_id: productId
          },
          success: function(response) {
            if (response.status === 'success') {
              alert(response.additional_status);
            } else {
              alert('Failed to update the product status');
            }
          },
          error: function() {
            alert('Error occurred while liking the product');
          },
        });
        var icon = $(this).find('i');
        var favoriteCountElement = $('#favorite-count');
        if (icon.hasClass('fa-heart-o')) {
          icon.removeClass('fa-heart-o').addClass('fa-heart');
          var currentCount = parseInt(favoriteCountElement.text());
          favoriteCountElement.text(currentCount + 1);
        } else {
          icon.removeClass('fa-heart').addClass('fa-heart-o');
          var currentCount = parseInt(favoriteCountElement.text());
          favoriteCountElement.text(currentCount - 1);
        }
      });
    });
  </script>

</body>

</html>