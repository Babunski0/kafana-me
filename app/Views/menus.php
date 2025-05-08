<?= view('templates/header', ['title' => 'Meniji']) ?>

<main class="container">

  <h1 class="page-title" style="text-align:center; margin:1.5rem 0; font-size:2.5rem;">Prikaz menija dostupnih restorana</h1>
  
  <h2 style="text-align:center; margin:1.5rem 0; font-size:1.5rem;">Pozdrav, <?= esc($username) ?>! Klikni na naziv restorana da vidiš njegove kategorije:</h2>

  <?php 
    $order = ['Hladna predjela', 'Topla predjela', 'Ćorbe', 'Glavna jela', 'Dezerti'];
    foreach ($menusByRestaurant as $mr):
      $rest  = $mr['restaurant'];
      $items = $mr['items'];
      $grouped = [];
      foreach ($items as $i) {
        $grouped[$i['category']][] = $i;
      }
  ?>
    <details class="restaurant" style="margin-bottom:2rem;">
      <summary style="
        background:#f0f0f0;
        padding:12px 16px;
        font-size:1.25rem;
        font-weight:600;
        cursor:pointer;
        list-style:none;
      ">
        <?= esc($rest['name']) ?>
      </summary>
      <div class="categories" style="padding:1rem 1.5rem;">
        <?php if (empty($grouped)): ?>
          <em style="color:#777;">Ovaj restoran još nema stavki menija.</em>
        <?php else: ?>
          <?php foreach ($order as $cat): ?>
            <?php if (! empty($grouped[$cat])): ?>
              <h3 style="
                margin:1.5rem 0 .75rem;
                font-size:1.1rem;
                color:#444;
                border-bottom:1px solid #ddd;
                padding-bottom:4px;
              "><?= esc($cat) ?></h3>
              <?php foreach ($grouped[$cat] as $item): ?>
                <div style="
                  display:flex;
                  justify-content:space-between;
                  padding:8px 0;
                  border-bottom:1px solid #eee;
                ">
                  <div>
                    <strong><?= esc($item['item_name']) ?></strong>
                    <?php if ($item['description']): ?>
                      <div style="font-size:.9rem;color:#666;margin-top:4px;">
                        <?= esc($item['description']) ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <span><?= number_format($item['price'],2) ?> EUR</span>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </details>
  <?php endforeach; ?>
</main>

<?= view('templates/footer') ?>
