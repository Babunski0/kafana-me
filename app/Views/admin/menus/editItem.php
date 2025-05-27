<?= view('templates/header', ['title' => 'Uredi stavku menija']) ?>

<main class="container" style="max-width:600px; margin-top:2rem;">
    <h2>Uredi stavku menija: <?= esc($item['item_name']) ?> (<?= esc($restaurant['name']) ?>)</h2>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/menus/' . $restaurant['id'] . '/items/' . $item['id'] . '/update') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="item_name">Naziv stavke</label>
            <input type="text" id="item_name" name="item_name" value="<?= old('item_name', $item['item_name']) ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Opis (opcionalno)</label>
            <textarea id="description" name="description" class="form-control"><?= old('description', $item['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Kategorija</label>
            <select id="category" name="category" class="form-control" required>
                <?php foreach($order as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= old('category', $item['category']) === $cat ? 'selected' : '' ?>>
                        <?= esc(mb_convert_case($cat, MB_CASE_TITLE, 'UTF-8')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Cijena (EUR)</label>
            <input type="number" step="0.01" id="price" name="price" value="<?= old('price', $item['price']) ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj promjene</button>
        <a href="<?= site_url('admin/menus/' . $restaurant['id']) ?>" class="btn btn-secondary">Odustani</a>
    </form>
</main>

<?= view('templates/footer') ?>
