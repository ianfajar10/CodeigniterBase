<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url() . 'dashboard' ?>" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul class="sidebar-nav" id="sidebar-nav">
                <?php foreach ($modules['sidebars'] as $key => $module) { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo (base_url() . $key) ?>" aria-expanded="false">
                            <span>
                                <i class="<?php echo $module[1] ?>"></i>
                            </span>
                            <span class="hide-menu"><strong><?php echo $module[0] ?></strong></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<script src="../assets/js/sidebarmenu.js"></script>