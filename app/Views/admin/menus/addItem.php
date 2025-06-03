<?= view('templates/header', ['title' => 'Dodaj stavku u meni: ' . esc($restaurant['name']) ]) ?>

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
    --error-bg: #f8d7da;
    --error-border: #dc3545;
    --input-border: #ced4da;
    --input-focus: #4a90e2;
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
    max-width: 600px;
    background-color: var(--bg-page);
  }

  h1 {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .alert-error {
    background-color: var(--error-bg);
    border-left: 4px solid var(--error-border);
    color: var(--text-primary);
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    list-style: none;
  }

  .alert-error li {
    margin-bottom: 0.5rem;
  }

  .form-card {
    background-color: var(--card-bg);
    padding: 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: 0 2px 8px var(--box-shadow);
  }

  form .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
  }

  form label {
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 0.4rem;
  }

  form input[type="text"],
  form select,
  form textarea {
    padding: 0.6rem 0.8rem;
    border: 1px solid var(--input-border);
    border-radius: var(--border-radius);
    font-size: 1rem;
    color: var(--text-primary);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  form input[type="text"]:focus,
  form select:focus,
  form textarea:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
    outline: none;
  }

  form textarea {
    resize: vertical;
    min-height: 100px;
  }

  .btn-save {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.7rem 1.2rem;
    background-color: var(--accent-color);
    color: #ffffff;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.2s ease;
    cursor: pointer;
    margin-top: 0.5rem;
  }

  .btn-save:hover {
    background-color: var(--accent-hover);
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
    margin-top: 1.5rem;
  }

  .btn-back:hover {
    background-color: var(--accent-color);
    color: #ffffff;
  }

  .btn-save i,
  .btn-back i {
    font-size: 1rem;
  }

  @media (max-width: 576px) {
    h1 {
      font-size: 1.5rem;
    }
    .form-card {
      padding: 1rem;
    }
    form input[type="text"],
    form select,
    form textarea {
      font-size: 0.95rem;
    }
    .btn-save,
    .btn-back {
      padding: 0.5rem 0.9rem;
      font-size: 0.95rem;
    }
  }
</style>

<main class="container">
  <h1>Dodaj stavku u meni: <?= esc($restaurant['name']) ?></h1>

  <?php if ($errors = session()->getFlashdata('errors')): ?>
    <ul class="alert-error">
      <?php foreach ($errors as $e): ?>
        <li><?= esc($e) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <div class="form-card">
    <form action="<?= base_url("admin/menus/{$restaurant['id']}/add") ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="item_name">Ime jela</label>
        <input
          type="text"
          id="item_name"
          name="item_name"
          value="<?= old('item_name') ?>"
          placeholder="Unesite naziv jela"
        >
      </div>

      <div class="form-group">
        <label for="price">Cijena (€)</label>
        <input
          type="text"
          id="price"
          name="price"
          value="<?= old('price') ?>"
          placeholder="npr. 9.99"
        >
      </div>

      <div class="form-group">
        <label for="category">Kategorija</label>
        <select id="category" name="category">
          <?php foreach (['Hladna predjela','Topla predjela','Corbe','Glavna jela','Dezerti'] as $cat): ?>
            <option value="<?= esc($cat) ?>" <?= old('category') === $cat ? 'selected' : '' ?>>
              <?= esc($cat) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="description">Opis (opciono)</label>
        <textarea
          id="description"
          name="description"
          placeholder="Dodajte kratak opis jela"
        ><?= old('description') ?></textarea>
      </div>

      <button type="submit" class="btn-save">
        <i class="bi bi-save"></i> Sačuvaj
      </button>
    </form>
  </div>

  <div class="text-center">
    <a href="<?= base_url("admin/menus/{$restaurant['id']}") ?>" class="btn-back">
      <i class="bi bi-arrow-left-circle"></i> Nazad na meni
    </a>
  </div>
</main>

<?= view('templates/footer') ?>
