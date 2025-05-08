<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Kafana Projekat') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/site.css') ?>">
    <script>
        window.BASE_URL = '<?= base_url() ?>';
    </script>
</head>
<body>
<header>
    <h1>Kafana Projekat</h1>
    <p>Doživite autentičnu atmosferu najboljih kafana</p>
</header>
<nav>
    <div class="container">
        <a href="<?= base_url('/') ?>">Početna</a>
        <a href="<?= base_url('restaurants') ?>">Lista restorana</a>
        <?php if (session()->get('role') === 'admin'): ?>
            <a href="<?= base_url('admin/menus') ?>">Meniji</a>
        <?php else: ?>
            <a href="<?= base_url('menus') ?>">Meniji</a>
        <?php endif; ?>
        <a href="<?= base_url('reservations') ?>">Moje rezervacije</a>
        <a href="<?= base_url('contact') ?>">Kontakt</a>
        <a href="<?= base_url('logout') ?>">Odjavi se</a>
    </div>
</nav>