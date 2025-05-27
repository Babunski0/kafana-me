<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel – Restorani</title>
  <style>
    table { width:100%; border-collapse: collapse; margin-top:20px; }
    th, td { padding:10px; border:1px solid #ddd; text-align:left; }
    a.button { padding:8px 12px; background:#4CAF50; color:#fff; text-decoration:none; border-radius:4px; }
    a.button.danger { background:#e74c3c; }
  </style>
</head>
<body>
  <h1>Admin Panel</h1>
  <?php if(session()->getFlashdata('success')): ?>
    <p style="color:green"><?= esc(session()->getFlashdata('success')) ?></p>
  <?php endif; ?>

  <p>
    <a href="<?= site_url('admin/add') ?>" class="button">+ Dodaj novi restoran</a>
    <a href="<?= site_url('dashboard') ?>" style="margin-left:20px;">← Nazad na dashboard</a>
  </p>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Naziv</th>
        <th>Kuhinja</th>
        <th>Kapacitet</th>
        <th>Slobodna mjesta</th>
        <th>Akcije</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($restaurants as $r): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= esc($r['name']) ?></td>
          <td><?= esc($r['cuisine']) ?></td>
          <td><?= $r['capacity'] ?></td>
          <td><?= $r['available'] ?></td>
          <td>
            <!-- Uredi dugme -->
            <a href="<?= site_url('admin/restaurants/' . $r['id'] . '/edit') ?>"
               class="button"
               style="margin-right:8px;">
              Uredi
            </a>
            <!-- Obriši dugme -->
            <a href="<?= site_url('admin/delete/' . $r['id']) ?>"
               class="button danger"
               onclick="return confirm('Obriši restoran <?= esc($r['name']) ?>?');">
              Obriši
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
