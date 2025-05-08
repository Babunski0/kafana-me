<h1>Upravljanje menijima – izaberite restoran</h1>
<ul>
<?php foreach($restaurants as $r): ?>
  <li>
    <a href="<?= base_url("admin/menus/{$r['id']}") ?>">
      <?= esc($r['name']) ?> (<?= esc($r['cuisine']) ?>)
    </a>
  </li>
<?php endforeach; ?>
</ul>
<a href="<?= base_url('admin') ?>">← Nazad na listu restorana</a>
