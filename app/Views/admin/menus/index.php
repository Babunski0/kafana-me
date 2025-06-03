<?= view('templates/header', ['title' => 'Admin panel – lista restorana']) ?>

<style>
  /* Učitaj Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  /* Varijable za boje */
  :root {
    --bg-page: #eef2f5;
    --card-bg: #ffffff;
    --card-hover: #f1f5f9;
    --accent-color: #4a90e2;
    --text-primary: #333333;
    --text-secondary: #666666;
    --btn-bg: #4a90e2;
    --btn-hover: #357ab7;
    --btn-text: #ffffff;
    --border-radius: 12px;
    --box-shadow: rgba(0, 0, 0, 0.1);
  }

  body {
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-page);
  }

  main.container {
    margin: 2rem auto;
    padding: 2rem;
    max-width: 1200px;
    background-color: var(--bg-page);
  }

  h2 {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
  }

  .restaurant-card {
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 12px var(--box-shadow);
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px var(--box-shadow);
    background-color: var(--card-hover);
  }

  .card-content {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .card-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
  }

  .card-cuisine {
    margin: 0.5rem 0 1.25rem;
    color: var(--text-secondary);
    font-style: italic;
    font-size: 0.95rem;
  }

  .btn-edit-menu {
    align-self: flex-start;
    padding: 0.5rem 1rem;
    background-color: var(--accent-color);
    color: var(--btn-text);
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    transition: background-color 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
  }

  .btn-edit-menu:hover {
    background-color: var(--btn-hover);
  }

  .btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    background-color: transparent;
    color: var(--accent-color);
    border: 2px solid var(--accent-color);
    border-radius: var(--border-radius);
    font-weight: 600;
    transition: background-color 0.2s ease, color 0.2s ease;
    text-decoration: none;
    margin-top: 2rem;
  }

  .btn-back:hover {
    background-color: var(--accent-color);
    color: var(--btn-text);
  }

  .btn-back i,
  .btn-edit-menu i {
    font-size: 1rem;
  }

  /* Responsive finese */
  @media (max-width: 576px) {
    h1 {
      font-size: 1.5rem;
    }
    .card-title {
      font-size: 1.1rem;
    }
    .card-cuisine {
      font-size: 0.9rem;
    }
  }
</style>

<main class="container">
  <h2>Upravljanje menijima – izaberite restoran</h2>

  <div class="grid-container">
    <?php foreach($restaurants as $r): ?>
      <div class="restaurant-card">
        <div class="card-content">
          <h2 class="card-title"><?= esc($r['name']) ?></h2>
          <p class="card-cuisine"><?= esc($r['cuisine']) ?></p>
          <a href="<?= base_url("admin/menus/{$r['id']}") ?>" class="btn-edit-menu">
            Uredi meni
            <i class="bi bi-pencil-square"></i>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="text-center">
    <a href="<?= base_url('admin') ?>" class="btn-back">
      <i class="bi bi-arrow-left-circle"></i>
      Nazad na listu restorana
    </a>
  </div>
</main>

<?= view('templates/footer') ?>
