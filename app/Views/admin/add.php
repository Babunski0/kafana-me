<?= view('templates/header', ['title' => 'Dodaj Novi Restoran']) ?>

<style>
  /* Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  :root {
    --bg-page: #eef2f5;
    --card-bg: #ffffff;
    --card-shadow: rgba(0, 0, 0, 0.1);
    --accent-color: #4a90e2;
    --accent-hover: #357ab7;
    --danger-color: #e74c3c;
    --input-border: #ced4da;
    --input-focus: #4a90e2;
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
    max-width: 500px;
    margin: 50px auto;
    background-color: var(--card-bg);
    padding: 30px 25px;
    border-radius: var(--border-radius);
    box-shadow: 0 2px 12px var(--card-shadow);
  }

  h1 {
    margin-top: 0;
    font-size: 1.8rem;
    color: var(--text-primary);
    text-align: center;
    font-weight: 600;
    margin-bottom: 1.5rem;
  }

  .error-box {
    background-color: #ffe5e5;
    border: 1px solid #ffcccc;
    padding: 12px;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
  }

  .error-box p {
    margin: 0 0 8px;
    color: var(--danger-color);
    font-size: 0. nine rem;
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
    font-size: 0. nine rem;
  }

  form input[type="text"],
  form input[type="number"],
  form input[type="file"] {
    padding: 0.6rem 0.8rem;
    border: 1px solid var(--input-border);
    border-radius: var(--border-radius);
    font-size: 1rem;
    color: var(--text-primary);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  form input[type="text"]:focus,
  form input[type="number"]:focus,
  form input[type="file"]:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
    outline: none;
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
    font-size: 1rem;
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
    font-size: 0. nine rem;
  }

  .btn-back:hover {
    background-color: var(--accent-color);
    color: #ffffff;
  }

  @media (max-width: 576px) {
    main.container {
      margin: 30px 10px;
      padding: 20px;
    }
    h1 {
      font-size: 1.5rem;
    }
    form label {
      font-size: 0. nine rem;
    }
    form input[type="text"],
    form input[type="number"],
    form input[type="file"] {
      font-size: 0. nine rem;
      padding: 0.5rem 0.7rem;
    }
    .btn-save,
    .btn-back {
      padding: 0.5rem 1rem;
      font-size: 0. nine rem;
    }
  }
</style>

<main class="container">
  <h1>Dodaj Novi Restoran</h1>

  <?php if ($errors = session()->getFlashdata('errors')): ?>
    <div class="error-box">
      <?php foreach ($errors as $err): ?>
        <p><?= esc($err) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form action="<?= base_url('admin/save') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="name">Naziv restorana</label>
      <input
        type="text"
        id="name"
        name="name"
        value="<?= old('name') ?>"
        placeholder="Unesite naziv"
        required
      >
    </div>

    <div class="form-group">
      <label for="city">Grad</label>
      <input
        type="text"
        id="city"
        name="city"
        value="<?= old('city') ?>"
        placeholder="Unesite grad"
        required
      >
    </div>

    <div class="form-group">
      <label for="cuisine">Tip kuhinje</label>
      <input
        type="text"
        id="cuisine"
        name="cuisine"
        value="<?= old('cuisine') ?>"
        placeholder="npr. Italijanska"
        required
      >
    </div>

    <div class="form-group">
      <label for="capacity">Ukupan kapacitet</label>
      <input
        type="number"
        id="capacity"
        name="capacity"
        value="<?= old('capacity') ?>"
        min="1"
        placeholder="Unesite broj mjesta"
        required
      >
    </div>

    <div class="form-group">
      <label for="image">Slika restorana (jpg/png, max 2MB)</label>
      <input
        type="file"
        id="image"
        name="image"
        accept="image/jpeg,image/png"
        required
      >
    </div>

    <button type="submit" class="btn-save">
      Sačuvaj
    </button>
  </form>

  <div style="text-align:center;">
    <a href="<?= base_url('admin') ?>" class="btn-back">
      ← Nazad na listu restorana
    </a>
  </div>
</main>

<?= view('templates/footer') ?>
