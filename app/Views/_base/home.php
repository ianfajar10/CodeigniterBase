<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ogani Template">
  <meta name="keywords" content="Ogani, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ogani | Template</title>

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
        <li><a href="#">Pages</a>
          <ul class="header__menu__dropdown">
            <li><a href="./shop-details.html">Shop Details</a></li>
            <li><a href="./shoping-cart.html">Shoping Cart</a></li>
            <li><a href="./checkout.html">Check Out</a></li>
            <li><a href="./blog-details.html">Blog Details</a></li>
          </ul>
        </li>
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
        <div class="col-lg-6">
          <nav class="header__menu">
            <ul>
              <li class="active"><a href="./home">Beranda</a></li>
              <li><a href="./blog.html">Terlaris</a></li>
              <li><a href="./contact.html">Terbaru</a></li>
              <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                  <li><a href="./shop-details.html">Shop Details</a></li>
                  <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                  <li><a href="./checkout.html">Check Out</a></li>
                  <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="header__cart">
            <ul>
              <?php if (isset($session['username']) && $session['username'] != null): ?>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
              <?php endif; ?>
              <li><a href="<?= base_url() . 'dashboard' ?>" style="text-decoration: none"><i class="fa fa-user"></i> <?php echo $session['name'] ?? 'Login' ?></a></li>
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
              <span>Semua Kategori </span>
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
                <button type="submit" class="site-btn">SEARCH</button>
              </form>
            </div>
          </div>
          <div class="hero__item set-bg" data-setbg="../assets/home/ogani/img/hero/banner.jpg">
            <div class="hero__text">
              <span>FRUIT FRESH</span>
              <h2>Vegetable <br />100% Organic</h2>
              <p>Free Pickup and Delivery Available</p>
              <a href="#" class="primary-btn">SHOP NOW</a>
            </div>
          </div>
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
                    <li><a href="#"><i class="fa fa-info"></i></a></li>
                    <?php if (isset($session['username']) && $session['username'] != null): ?>
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
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
            <ul>
              <li>Address: 60-49 Road 11378</li>
              <li>Phone: +65 11.188.888</li>
              <li>Email: hello@colorlib.com</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
          <div class="footer__widget">
            <h6>Useful Links</h6>
            <ul>
              <li><a href="#">About Us</a></li>
              <li><a href="#">About Our Shop</a></li>
              <li><a href="#">Secure Shopping</a></li>
              <li><a href="#">Delivery infomation</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Our Sitemap</a></li>
            </ul>
            <ul>
              <li><a href="#">Who We Are</a></li>
              <li><a href="#">Our Services</a></li>
              <li><a href="#">Projects</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Innovation</a></li>
              <li><a href="#">Testimonials</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="footer__widget">
            <h6>Join Our Newsletter Now</h6>
            <p>Get E-mail updates about our latest shop and special offers.</p>
            <form action="#">
              <input type="text" placeholder="Enter your mail">
              <button type="submit" class="site-btn">Subscribe</button>
            </form>
            <div class="footer__widget__social">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Js Plugins -->
  <script src="../assets/home/ogani/js/jquery-3.3.1.min.js"></script>
  <script src="../assets/home/ogani/js/bootstrap.min.js"></script>
  <script src="../assets/home/ogani/js/jquery.nice-select.min.js"></script>
  <script src="../assets/home/ogani/js/jquery-ui.min.js"></script>
  <script src="../assets/home/ogani/js/jquery.slicknav.js"></script>
  <script src="../assets/home/ogani/js/mixitup.min.js"></script>
  <script src="../assets/home/ogani/js/owl.carousel.min.js"></script>
  <script src="../assets/home/ogani/js/main.js"></script>

</body>

</html>