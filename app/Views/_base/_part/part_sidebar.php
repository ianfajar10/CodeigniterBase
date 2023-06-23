<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php foreach ($modules['sidebars'] as $key => $module) { ?>
            <li class="nav-item <?php echo (($key == 'profile') || ($key == 'cart') ? 'visually-hidden' : null) ?>">
                <a class="nav-link <?php echo (uri_string() == $key ? '' : 'collapsed') ?>" href="<?php echo (base_url() . $key) ?>">
                    <i class="<?php echo $module[1] ?>"></i>
                    <span><?php echo $module[0] ?><span class="badge bg-primary badge-number <?php echo (($key === 'orderadmin') ? (($count_order !== 0) ? '' : 'visually-hidden') : 'visually-hidden') ?>"><?= $count_order ?></span></span>
                </a>
            </li>
        <?php } ?>

    </ul>

</aside>