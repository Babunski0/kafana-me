<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Moja Kafana') ?></title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }
        header, nav, footer { background: #333; color: #fff; padding: 15px; text-align: center; }
        nav a { color: #fff; margin: 0 15px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .container { display: flex; }
        .sidebar { width: 20%; padding: 15px; background: #f4f4f4; }
        .main { flex: 1; padding: 15px; }
        footer { margin-top: 20px; }
        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>

<header>
    <h1>Dobrodošli u našu Kafanu</h1>
</header>

<nav>
    <a href="<?= base_url('dashboard') ?>">Početna</a>
    <a href="<?= base_url('restaurants') ?>">Lista Restorana</a>
    <a href="<?= base_url('menus') ?>">Meniji</a>
    <a href="<?= base_url('reservations') ?>">Moje Rezervacije</a>
    <a href="<?= base_url('contact') ?>">Kontakt</a>
</nav>

<div class="container">
    <div class="sidebar">
        <h3>Levi Sidebar</h3>
        <p>Ovde mogu biti linkovi, reklame ili info.</p>
    </div>

    <div class="main">
        <?= $this->renderSection('content') ?>
    </div>

    <div class="sidebar">
        <h3>Desni Sidebar</h3>
        <p>Preporuke, ponude, popusti...</p>
    </div>
</div>

<footer>
    &copy; <?= date('Y') ?> Moja Kafana
</footer>

</body>
</html>
