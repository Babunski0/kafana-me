<?= view('templates/header', ['title' => 'Lista restorana']) ?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  :root {
    --bg-page: #eef2f5;
    --card-bg: #ffffff;
    --card-shadow: rgba(0, 0, 0, 0.1);
    --accent-color: #4a90e2;
    --accent-hover: #357ab7;
    --danger-color: #dc3545;
    --success-color: #28a745;
    --success-hover: #218838; 
    --text-primary: #333333;
    --text-secondary: #666666;
    --border-radius: 8px;
    --spacing: 1rem;
  }

  body {
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-page);
    color: var(--text-primary);
  }

  main.container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  .page-title {
    text-align: center;
    margin: 1.5rem 0;
    font-size: 2.5rem;
    color: var(--text-primary);
    font-weight: 600;
  }

  /* "Dodaj restoran" dugme */
  .btn-add-restaurant {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    background-color: var(--accent-color);
    color: #ffffff;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.2s ease;
  }

  .btn-add-restaurant:hover {
    background-color: var(--accent-hover);
  }

  .restaurant-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    padding-bottom: 2rem;
  }

  .restaurant-card {
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 12px var(--card-shadow);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px var(--card-shadow);
  }

  .restaurant-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .restaurant-card .info {
    padding: var(--spacing);
    flex: 1;
  }

  .restaurant-card .info h3 {
    margin: 0 0 0.5rem;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
  }

  .restaurant-card .info p {
    margin: 0.25rem 0;
    font-size: 0.95rem;
    color: var(--text-secondary);
  }

  .restaurant-card .actions {
    padding: var(--spacing);
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    font-weight: 600;
    border-radius: var(--border-radius);
    text-decoration: none;
    transition: background-color 0.2s ease, opacity 0.2s ease;
    border: none;
    cursor: pointer;
  }

  .btn-danger {
    background-color: var(--danger-color);
    color: #ffffff;
  }

  .btn-danger:hover {
    opacity: 0.9;
  }

  .btn-success {
    background-color: var(--success-color);
    color: #ffffff;
  }

  .btn-success:hover {
    background-color: var(--success-hover); /* sada će ostati vidljivo */
  }

  .btn.disabled {
    background-color: #cccccc;
    color: #777777;
    cursor: not-allowed;
  }

  @media (max-width: 576px) {
    .restaurant-card img {
      height: 140px;
    }
    .restaurant-card .info h3 {
      font-size: 1.1rem;
    }
    .restaurant-card .info p {
      font-size: 0.9rem;
    }
    .btn, .btn-add-restaurant {
      padding: 0.5rem 0.9rem;
      font-size: 0.9rem;
    }
  }
</style>

<main class="container">
  <h1 class="page-title">Lista raspoloživih restorana</h1>

  <?php if (session()->get('role') === 'admin'): ?>
    <div style="text-align: center; margin-bottom: 20px;">
      <a href="<?= base_url('admin/add') ?>" class="btn-add-restaurant">
        + Dodaj restoran
      </a>
    </div>
  <?php endif; ?>

  <div class="restaurant-list">
    <?php foreach ($restaurants as $r): ?>
      <div class="restaurant-card">
        <img src="<?= base_url('uploads/' . $r['image']) ?>" alt="<?= esc($r['name']) ?>">
        <div class="info">
          <h3><?= esc($r['name']) ?></h3>
          <?php $city = trim($r['city']); ?>
          <p><strong>Grad:</strong> <?= esc($city ?: 'Nepoznato') ?></p>
          <p><strong>Kuhinja:</strong> <?= esc($r['cuisine']) ?></p>
          <p><strong>Kapacitet:</strong> <?= esc($r['capacity']) ?></p>
          <p><strong>Slobodna mjesta:</strong> <?= esc($r['available']) ?></p>
          <p><strong>Radno vrijeme:</strong> 08:00 - 24:00</p>
        </div>
        <div class="actions">
          <?php if (session()->get('role') === 'admin'): ?>
            <a
              href="<?= base_url('admin/delete/' . $r['id']) ?>"
              class="btn btn-danger"
              onclick="return confirm('Obriši <?= esc($r['name']) ?>?');"
            >
              Obriši
            </a>
          <?php else: ?>
            <?php if ($r['available'] > 0): ?>
              <a
                href="<?= base_url('reserve/' . $r['id']) ?>"
                class="btn btn-success"
                data-id="<?= $r['id'] ?>"
              >
                Rezerviši
              </a>
            <?php else: ?>
              <button class="btn disabled" disabled>Nema mjesta</button>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?= view('templates/footer') ?>
