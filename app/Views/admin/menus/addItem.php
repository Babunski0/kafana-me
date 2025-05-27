<!-- Dodavanje stavke u meniju-->
<h1>Dodaj stavku u meni: <?= esc($restaurant['name']) ?></h1>
<?php if($errors = session()->getFlashdata('errors')): ?>
  <ul style="color:red;">
    <?php foreach($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
  </ul>
<?php endif; ?>

<form action="<?= base_url("admin/menus/{$restaurant['id']}/add") ?>"
      method="post">
  <?= csrf_field() ?>
  <label>Ime jela</label>
  <input type="text" name="item_name" value="<?= old('item_name') ?>">
  <label>Cijena (€)</label>
  <input type="text" name="price"     value="<?= old('price') ?>">
  <label>Kategorija</label>
  <select name="category">
    <?php foreach(['Hladna predjela','Topla predjela','Corbe','Glavna jela','Dezerti'] as $cat): ?>
      <option <?= old('category')===$cat?'selected':'' ?>><?= esc($cat) ?></option>
    <?php endforeach; ?>
  </select>
  <label>Opis (opciono)</label>
  <textarea name="description"><?= old('description') ?></textarea>
  <button type="submit">Sačuvaj</button>
</form>

<p><a href="<?= base_url("admin/menus/{$restaurant['id']}") ?>">← Nazad na meni</a></p>
