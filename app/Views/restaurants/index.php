<?= view('layout/header') ?>

<div class="container">
  <h2>Сви ресторани</h2>
  <div class="restaurant-list">
    <?php foreach($restaurants as $r): ?>
      <div class="card">
        <img src="<?= esc($r['image_url']) ?>" alt="<?= esc($r['name']) ?>">
        <h3><?= esc($r['name']) ?></h3>
        <p>Кухиња: <?= esc($r['cuisine']) ?></p>
        <p>Слободних места: <?= esc($r['available_seats']) ?></p>
        <a href="<?= base_url("reserve/{$r['id']}") ?>" class="btn">Резервиши</a>
        <?php if(session()->get('role') === 'admin'): ?>
          <a href="<?= base_url("admin/delete/{$r['id']}") ?>" class="btn btn-danger">Избриши</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if(session()->get('role') === 'admin'): ?>
    <a href="<?= base_url('admin/add') ?>" class="btn btn-primary">Додај ресторан</a>
  <?php endif; ?>
</div>

<?= view('layout/footer') ?>
