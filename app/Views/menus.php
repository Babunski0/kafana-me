<!-- Stranica koja prikazuje menije restorana po kategorijama (Hladna predjela, Topla predjela...)-->

<?= view('templates/header', ['title' => 'Meniji']) ?>

<main class="container" style="background: #cbd4dc;">

  <h2 class="page-title" style="text-align:center; margin:1.4rem 0; font-size:2.5rem; color: #2c3e50">Prikaz menija dostupnih restorana</h2>
  
  <h4 style="text-align:center; margin:1.5rem 0; font-size:1.2rem; color: #2c3e50">Pozdrav, <?= esc($username) ?>! Klikni na naziv restorana da vidiš njegove kategorije:</h4>

  <!-- Grupisanje stavki menija po restoranima i kategorijama radi urednijeg prikaza -->
  <?php 
    $order = ['Hladna predjela', 'Topla predjela', 'Corbe', 'Glavna jela', 'Dezerti'];
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
        background: #2c3e50;
        padding:12px 16px;
        margin-left: 10%;
        color: white;
        margin-right: 10%;
        border-radius: 16px;
        font-size:1.25rem;
        font-weight:600;
        cursor:pointer;
        list-style:none;
      ">
        <?= esc($rest['name']) ?>
      </summary>
    <!-- Prikaz svih stavki menija za dati restoran, ukoliko nema stavki ispisuje se poruka -->
      <div class="categories" style="background: #1C2938; padding:1rem 1.5rem; margin: 0 10%; border-radius: 1rem; margin-top: 1rem;">
        <?php if (empty($grouped)): ?>
          <em style="color: #2c3e50;">Ovaj restoran još nema stavki menija.</em>
        <?php else: ?>
          <?php foreach ($order as $cat): ?>
            <?php if (! empty($grouped[$cat])): ?>
              <h2 style="
                margin:1.5rem 0 .75rem;
                font-size:1.2rem;
                color:rgb(255, 255, 255);
                border-bottom:1px solid #ddd;
                padding-bottom:4px;
              "><?= esc($cat) ?></h2>
              <?php foreach ($grouped[$cat] as $item): ?>
                <div style="
                  display:flex;
                  justify-content:space-between;
                  padding:8px 0;
                  border-bottom:1px solid #eee;
                ">
                  <div>
                    <span style="color:rgb(172, 112, 0)"><strong><?= esc($item['item_name']) ?></strong><span>
                    <?php if ($item['description']): ?>
                      <div style="font-size:.9rem;color: #5d6d7e;margin-top:4px;">
                        <?= esc($item['description']) ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <span style="color:rgb(172, 112, 0)"><?= number_format($item['price'],2) ?> EUR</span>
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