<!-- Stranica za Admin usere na kojoj dodaju restoran-->
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Restoran</title>
    <style>
      form { max-width: 400px; margin: 50px auto; font-family: Arial, sans-serif; }
      label { display: block; margin-bottom: 5px; font-weight: bold; }
      input[type="text"],
      input[type="number"],
      input[type="file"] {
        display: block;
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }
      button {
        display: inline-block;
        padding: 10px 20px;
        background: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      button:hover {
        background: #45a049;
      }
      .error {
        background: #ffe5e5;
        border: 1px solid #ffcccc;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
      }
      .error p {
        margin: 0 0 5px;
        color: #cc0000;
      }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Dodaj Novi Restoran</h1>

    <!-- Prikazi greske validacije -->
    <?php if ($errors = session()->getFlashdata('errors')): ?>
      <div class="error">
        <?php foreach ($errors as $err): ?>
          <p><?= esc($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/save') ?>"
          method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="name">Naziv restorana</label>
        <input type="text" id="name" name="name"
               value="<?= old('name') ?>" required>

        <label for="cuisine">Tip kuhinje</label>
        <input type="text" id="cuisine" name="cuisine"
               value="<?= old('cuisine') ?>" required>

        <label for="capacity">Ukupan kapacitet</label>
        <input type="number" id="capacity" name="capacity"
               value="<?= old('capacity') ?>" min="1" required>

        <label for="image">Slika restorana (jpg/png, max 2MB)</label>
        <input type="file" id="image" name="image"
               accept="image/jpeg,image/png" required>

        <button type="submit">Sačuvaj</button>
    </form>

    <p style="text-align:center; margin-top:20px;">
      <a href="<?= base_url('admin') ?>">← Nazad na listu restorana</a>
    </p>
</body>
</html>
