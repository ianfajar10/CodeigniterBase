<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php foreach ($modules['sidebars'] as $key => $module) { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == $key ? '' : 'collapsed') ?>" href="<?php echo (base_url() . $key) ?>">
                    <i class="<?php echo $module[1] ?>"></i>
                    <span><?php echo $module[0] ?></span>
                </a>
            </li>
        <?php } ?>

    </ul>

</aside>