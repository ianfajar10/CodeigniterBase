<?php $session = session() ?>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo base_url() . 'dashboard' ?>" class="logo d-flex align-items-center">
            <img src="<?= base_url() . 'assets/img/logo.png' ?>" alt="">
            <span class="d-none d-lg-block">Thani Coffee</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="<?php echo (base_url() . 'menulist/search') ?>">
            <input type="search" name="query" placeholder="Cari.." title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <a class="nav-link nav-icon <?= $session->get('name') ? ($session->get('username') == 'admin' ? 'visually-hidden' : '') : 'visually-hidden' ?>" href="<?php echo (base_url() . 'cart') ?>">
                <i class="bi bi-cart"></i>
                <span class="badge badge-number" style="background-color: #E0CBB0"><?= $session->get('cart') ?></span>
            </a>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?= base_url() . 'assets/img/ic_profile.png' ?>" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= strlen($session->get('name')) > 12 ? substr($session->get('name'), 0, 12) . '...' : $session->get('name'); ?></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <span>Halo, </span>
                        <h6><?= $session->get('name'); ?></h6>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="<?= $session->get('name') ? '' : 'visually-hidden' ?>">
                        <a class="dropdown-item d-flex align-items-center" href="<?php echo (base_url() . 'profile') ?>">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>

                    <li class="<?= $session->get('name') ? '' : 'visually-hidden' ?>">
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?= $session->get('name') ? (base_url() . 'auth/logout') : (base_url() . 'login') ?>">
                            <i class="bi bi-box-arrow-right"></i>
                            <span><?= $session->get('name') ? 'Keluar' : 'Masuk' ?></span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>

</header>