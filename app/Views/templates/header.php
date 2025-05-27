<!-- Header za sve stranice u View-->

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Kafana Projekat') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/site.css') ?>">
    <style>
        .container::before,
        .container::after {
        display: none !important;
        background: none   !important;
        content: none      !important;
        }
    </style>
    <script>window.BASE_URL = '<?= base_url() ?>';</script>
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <!-- Logo -->
        <div class="logo">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo Kafana Projekat">
            </a>
        </div>
        <!-- Naslov -->
        <div class="site-branding">
            <h1>Kafana Projekat</h1>
            <p><strong>Doživite autentičnu atmosferu najboljih kafana</strong></p>
        </div>
    </div>
</header>

<nav>
    <div class="nav-inner">
        <a href="<?= base_url('/') ?>">Početna</a>

        <?php if (session()->get('role') === 'admin'): ?>
            <a href="<?= site_url('admin') ?>">Lista restorana</a>
        <?php else: ?>
            <a href="<?= site_url('restaurants') ?>">Lista restorana</a>
        <?php endif; ?>

        <?php if (session()->get('role') === 'admin'): ?>
            <a href="<?= site_url('admin/menus') ?>">Meniji</a>
        <?php else: ?>
            <a href="<?= site_url('menus') ?>">Meniji</a>
        <?php endif; ?>

        <a href="<?= base_url('reservations') ?>">Moje rezervacije</a>
        <a href="<?= base_url('logout') ?>">Odjavi se</a>
    </div>
</nav>

<main>