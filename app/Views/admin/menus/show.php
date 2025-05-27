<!-- Stranica koja prikazuje stavke u meniju za restorane-->
<h1>Meni za “<?= esc($restaurant['name']) ?>”</h1>
<?php if(session()->get('success')): ?>
  <p style="color:green"><?= session()->get('success') ?></p>
<?php endif; ?>

<a href="<?= base_url("admin/menus/{$restaurant['id']}/add") ?>">+ Dodaj stavku</a>
<table border="1" cellpadding="5" style="margin-top:10px;">
  <?php foreach($grouped as $cat => $items): ?>
    <tr><th colspan="4"><?= esc($cat) ?></th></tr>
    <tr>
      <th>Jelo</th><th>Cijena (€)</th><th>Opis</th><th>Akcije</th>
    </tr>
    <?php foreach($items as $i): ?>
      <tr>
        <td><?= esc($i['item_name']) ?></td>
        <td><?= number_format($i['price'],2,',','.') ?></td>
        <td><?= esc($i['description']) ?></td>
        <td>
          <a href="<?= base_url("admin/menus/{$restaurant['id']}/items/{$i['id']}/edit") ?>">
            Uredi
          </a>
          |
          <a href="<?= base_url("admin/menus/{$restaurant['id']}/delete/{$i['id']}") ?>"
             onclick="return confirm('Obriši <?= esc($i['item_name']) ?>?')">
            Obriši
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endforeach; ?>
</table>
<p><a href="<?= base_url('admin/menus') ?>">← Nazad na restorane</a></p>
