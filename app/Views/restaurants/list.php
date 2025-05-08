<?= view('templates/header', ['title' => 'Lista restorana']) ?>

<main class="container">
<h1 class="page-title" style="text-align:center; margin:1.5rem 0; font-size:2.5rem;">Lista raspoloživih restorana</h1>

  <?php if (session()->get('role') === 'admin'): ?>
    <div style="text-align:center; margin-bottom:20px;">
      <a href="<?= base_url('admin/add') ?>" class="btn">
        + Dodaj restoran
      </a>
    </div>
  <?php endif; ?>

  <div class="restaurant-list">
    <?php foreach($restaurants as $r): ?>
      <div class="restaurant-card">
        <img src="<?= base_url('uploads/'.$r['image']) ?>" alt="<?= esc($r['name']) ?>">
        <div class="info">
          <h3><?= esc($r['name']) ?></h3>
          <p><strong>Kuhinja:</strong> <?= esc($r['cuisine']) ?></p>
          <p><strong>Kapacitet:</strong> <?= $r['capacity'] ?></p>
          <p><strong>Slobodna mesta:</strong> <?= $r['available'] ?></p>
        </div>
        <div class="actions">
          <?php if (session()->get('role') === 'admin'): ?>
            <a 
              href="<?= base_url('admin/delete/'.$r['id']) ?>" 
              class="btn btn-danger"
              onclick="return confirm('Obriši <?= esc($r['name']) ?>?');"
            >
              Obriši
            </a>
          <?php else: ?>
            <?php if ($r['available'] > 0): ?>
              <a 
                href="<?= base_url('reserve/'.$r['id']) ?>" 
                class="btn btn-success btn-reserve" 
                data-id="<?= $r['id'] ?>"
              >
                Rezerviši
              </a>
            <?php else: ?>
              <button class="btn disabled" disabled>Nema mesta</button>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?= view('templates/footer') ?>
