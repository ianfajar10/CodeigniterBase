<?php $session = session() ?>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo base_url() . 'dashboard' ?>" class="logo d-flex align-items-center">
            <img src="<?= base_url() . 'assets/img/logo.png' ?>" alt="">
            <span class="d-none d-lg-block">Trifecta Coffee</span>
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
                <span class="badge bg-primary badge-number"><?= $session->get('cart') ?></span>
            </a>

            <li class="nav-item dropdown <?= $session->get('username') !== 'admin' ? 'visually-hidden' : '' ?>">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number"><?= count($critic) ?></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        <?= count($critic) == 0 ? 'Belum ada kritik dan saran yang masuk' : 'Ada ' . count($critic) . ' kritik dan saran yang masuk' ?>
                        <a href="<?= base_url().'criticadmin' ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat semua</span></a>
                    </li>
                    <?php $limit = 0; ?>
                    <?php foreach ($critic as $row) : ?>
                        <?php if ($limit < 3) { ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="notification-item">
                                <i class="bi bi-chat-left-quote text-primary"></i>
                                <div>
                                    <h4><?= $row['username'] ?></h4>
                                    <p><?= (strlen($row['critic']) > 20 ? substr($row['critic'], 0, 100) . '...' :  $row['critic']) ?></p>
                                    <p><?= $row['created_at'] ?></p>
                                </div>
                            </li>
                        <?php } else {
                            break;
                        }?>
                        <?php $limit++; ?>
                    <?php endforeach; ?>

                </ul>

            </li>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRt0XikLERJ8A3kTEC6_j9lMiLFu7-27j_AyA&usqp=CAU" alt="Profile" class="rounded-circle">
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
<!-- <script>
    $(document).ready(async function() {
        var base_url = $('#base_url').val();
        await $.ajax({
            type: "POST",
            url: base_url + ('critic/get_critic'),
            success: function(response) {
                console.log(response.length);
                $("#count_critic").text(response.length)
            }
        });
    });
</script> -->