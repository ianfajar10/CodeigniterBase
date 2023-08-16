<?php $session = session() ?>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-comment-alt"></i>
                                <span class="ms-2">You have a new message from John.</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-heart"></i>
                                <span class="ms-2">Jane liked your post.</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-flag"></i>
                                <span class="ms-2">Reported content violation.</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-bell"></i>
                                <span class="ms-2">Reminder: Meeting at 3 PM.</span>
                            </a>
                        </div>
                    </div>
                </li>
                <span>Hi, <span id="span_name"></span></span>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="<?= base_url().'profile'?>" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="<?= base_url() . 'auth/logout' ?>" onclick="localStorage.removeItem('user')" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script src="../assets/js/header.js"></script>
<style>
    .app-header {
        background-color: #ffffff;
        /* Ganti warna latar belakang header sesuai kebutuhan Anda */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        /* Tambahkan efek bayangan (shadow) pada header */
    }
</style>