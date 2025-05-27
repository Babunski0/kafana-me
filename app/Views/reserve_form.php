<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Rezerviši <?= esc($restaurant['name']) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/site.css') ?>">
    <style>
      .btn-submit {
        cursor: pointer;
        display: inline-block;
        padding: .75rem 1.5rem;
        background: #e67e22;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        transition: background .3s;
      }
      .btn-submit:hover {
        background: #d35400;
      }
      .error-msg {
        background: #ffe5e5;
        border: 1px solid #ffcccc;
        color: #cc0000;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
        text-align: center;
      }
    </style>
</head>
<body>
    <?= view('templates/header') ?>
    <main class="container dark-container" style="max-width:600px; margin:40px auto;">
        <h2>Rezerviši: <?= esc($restaurant['name']) ?></h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-msg">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php $hour = (int) date('H'); ?>
        <?php if ($hour < 8): ?>
            <div class="error-msg">
                Restoran radi od 08:00. Trenutno nije moguće rezervisati.
            </div>
        <?php else: ?>

            <?php if (isset($validation)): ?>
                <div class="error-msg">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('reserve/' . $restaurant['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div style="margin-bottom:1rem;">
                  <label for="people">Broj osoba:</label><br>
                  <input type="number" id="people" name="people" min="1" max="<?= esc($restaurant['available']) ?>" value="<?= set_value('people', 1) ?>" required style="width:100%; padding:.5rem; border-radius:4px; border:1px solid #ccc;">
                </div>

                <div style="margin-bottom:1rem;">
                  <label for="meal_type">Obrok:</label><br>
                  <select id="meal_type" name="meal_type" required style="width:100%; padding:.5rem; border-radius:4px; border:1px solid #ccc;">
                      <option value="dorucak" <?= set_select('meal_type','dorucak') ?>>Doručak</option>
                      <option value="rucak" <?= set_select('meal_type','rucak') ?>>Ručak</option>
                      <option value="vecera" <?= set_select('meal_type','vecera') ?>>Večera</option>
                  </select>
                </div>

                <div style="margin-bottom:1rem;">
                  <label for="reservation_time">Vrijeme rezervacije:</label><br>
                  <input type="time" id="reservation_time" name="reservation_time" min="08:00" max="23:59" value="<?= set_value('reservation_time','12:00') ?>" required style="width:100%; padding:.5rem; border-radius:4px; border:1px solid #ccc;">
                </div>

                <button type="submit" class="btn-submit">Potvrdi rezervaciju</button>
                <a href="<?= base_url('restaurants') ?>" class="btn-submit" style="background:#34495e; margin-left:1rem;">Nazad</a>
            </form>

        <?php endif; ?>
    </main>
    <?= view('templates/footer') ?>
</body>
</html>
