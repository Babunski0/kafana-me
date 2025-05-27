<?= view('templates/header', ['title' => 'Uredi restoran']) ?>

<main class="container" style="max-width:600px; margin-top:2rem;">
    <h2>Uredi restoran: <?= esc($restaurant['name']) ?></h2>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/restaurants/' . $restaurant['id'] . '/update') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name">Ime restorana</label>
            <input type="text" id="name" name="name" value="<?= old('name', $restaurant['name']) ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="city">Grad</label>
            <input type="text" id="city" name="city" value="<?= old('city', $restaurant['city']) ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cuisine">Kuhinja</label>
            <input type="text" id="cuisine" name="cuisine" value="<?= old('cuisine', $restaurant['cuisine']) ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="capacity">Kapacitet</label>
            <input type="number" id="capacity" name="capacity" value="<?= old('capacity', $restaurant['capacity']) ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Nova slika (opcionalno)</label>
            <input type="file" id="image" name="image" accept="image/*" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj promene</button>
        <a href="<?= site_url('admin') ?>" class="btn btn-secondary">Odustani</a>
    </form>
</main>

<?= view('templates/footer') ?>