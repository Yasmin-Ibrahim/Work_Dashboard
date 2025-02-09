<?php include_once 'C:\xampp\htdocs\yasmin\Nice_Admin/core/functions.php'; ?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link " href="index.html">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" href="<?= url('app/users') ?>">
        <i class="bi bi-gem"></i><span>Users</span>
    </a>

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url("pages/profile.php") ?>">
        <i class="bi bi-person"></i>
        <span>Profile</span>
    </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url("pages/register.php") ?>">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
    </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url("pages/login.php") ?>">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
    </a>
    </li><!-- End Login Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url("pages/error404.php") ?>">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
    </a>
    </li><!-- End Error 404 Page Nav -->

</ul>

</aside><!-- End Sidebar-->