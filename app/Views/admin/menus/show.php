<?= view('templates/header', ['title' => 'Meni za ' . esc($restaurant['name']) ]) ?>

<style>
  /* Učitaj Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  /* Varijable za boje */
  :root {
    --bg-page: #eef2f5;
    --card-bg: #ffffff;
    --accent-color: #4a90e2;
    --accent-hover: #357ab7;
    --text-primary: #333333;
    --text-secondary: #666666;
    --success-bg: #d4edda;
    --success-border: #28a745;
    --table-header-bg: #f0f4f7;
    --table-row-hover: #f9f9f9;
    --border-radius: 8px;
    --box-shadow: rgba(0, 0, 0, 0.1);
  }

  body {
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-page);
  }

  main.container {
    margin: 2rem auto;
    padding: 2rem;
    max-width: 1000px;
    background-color: var(--bg-page);
  }

  h2 {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .alert-success {
    background-color: var(--success-bg);
    border-left: 4px solid var(--success-border);
    color: var(--text-primary);
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
  }

  .btn-add-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    background-color: var(--accent-color);
    color: #ffffff;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.2s ease;
  }

  .btn-add-item:hover {
    background-color: var(--accent-hover);
  }

  .menu-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    background-color: var(--card-bg);
    box-shadow: 0 2px 8px var(--box-shadow);
    border-radius: var(--border-radius);
    overflow: hidden;
  }

  .menu-table th,
  .menu-table td {
    padding: 0.75rem 1rem;
    text-align: left;
    vertical-align: middle;
  }

  .menu-table thead th {
    background-color: var(--table-header-bg);
    font-weight: 600;
    color: var(--text-primary);
  }

  .menu-table tbody tr:not(.category-row):hover {
    background-color: var(--table-row-hover);
  }

  .category-row th {
    background-color: var(--accent-color);
    color: #ffffff;
    font-size: 1.05rem;
    text-transform: uppercase;
    padding: 0.9rem 1rem;
  }

  .action-links a {
    color: var(--accent-color);
    font-weight: 500;
    text-decoration: none;
    margin-right: 0.75rem;
    transition: color 0.2s ease;
  }

  .action-links a:hover {
    color: var(--accent-hover);
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
    text-decoration: none;
    transition: background-color 0.2s ease, color 0.2s ease;
    margin-top: 2rem;
  }

  .btn-back:hover {
    background-color: var(--accent-color);
    color: #ffffff;
  }

  .btn-add-item i,
  .action-links i,
  .btn-back i {
    font-size: 1rem;
  }

  @media (max-width: 576px) {
    h1 {
      font-size: 1.5rem;
    }
    .menu-table th,
    .menu-table td {
      padding: 0.5rem 0.75rem;
    }
    .btn-add-item,
    .btn-back {
      padding: 0.5rem 0.9rem;
      font-size: 0.95rem;
    }
  }
</style>

<main class="container">
  <h2>Meni za “<?= esc($restaurant['name']) ?>”</h2>

  <?php if(session()->get('success')): ?>
    <div class="alert-success">
      <?= esc(session()->get('success')) ?>
    </div>
  <?php endif; ?>

  <a href="<?= base_url("admin/menus/{$restaurant['id']}/add") ?>" class="btn-add-item">
    <i class="bi bi-plus-circle"></i> Dodaj stavku
  </a>

  <table class="menu-table">
    <thead>
      <tr>
        <th>Jelo</th>
        <th>Cijena (€)</th>
        <th>Opis</th>
        <th>Akcije</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($grouped as $cat => $items): ?>
        <tr class="category-row">
          <th colspan="4"><?= esc($cat) ?></th>
        </tr>
        <?php foreach($items as $i): ?>
          <tr>
            <td><?= esc($i['item_name']) ?></td>
            <td><?= number_format($i['price'], 2, ',', '.') ?></td>
            <td><?= esc($i['description']) ?></td>
            <td class="action-links">
              <a href="<?= base_url("admin/menus/{$restaurant['id']}/items/{$i['id']}/edit") ?>">
                <i class="bi bi-pencil-square"></i> Uredi
              </a>
              <a href="<?= base_url("admin/menus/{$restaurant['id']}/delete/{$i['id']}") ?>"
                 onclick="return confirm('Obriši <?= esc($i['item_name']) ?>?')">
                <i class="bi bi-trash-fill"></i> Obriši
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="text-center">
    <a href="<?= base_url('admin/menus') ?>" class="btn-back">
      <i class="bi bi-arrow-left-circle"></i> Nazad na restorane
    </a>
  </div>
</main>

<?= view('templates/footer') ?>
