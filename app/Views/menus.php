<?= view('templates/header', ['title' => 'Meniji']) ?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  :root {
    --bg-page: #eef2f5;
    --card-bg: #ffffff;
    --card-shadow: rgba(0, 0, 0, 0.1);
    --accent-color: #4a90e2;
    --accent-hover: #357ab7;
    --text-primary: #333333;
    --text-secondary: #666666;
    --heading-bg: #4a90e2;
    --heading-text: #ffffff;
    --category-heading-bg: #f0f4f7;
    --category-heading-text: #333333;
    --item-border: #dddddd;
    --border-radius: 8px;
    --spacing: 1rem;
  }

  body {
    font-family: 'Montserrat', sans-serif;
    background-color: var(--bg-page);
    color: var(--text-primary);
  }

  main.container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  .page-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
  }

  .subtitle {
    font-weight: 400;
    color: var(--text-secondary);
    margin-bottom: 2rem;
  }

  .restaurant {
    margin-bottom: 2rem;
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 12px var(--card-shadow);
    overflow: hidden;
  }

  .restaurant summary {
    list-style: none;
    cursor: pointer;
    background-color: var(--heading-bg);
    color: var(--heading-text);
    padding: 0.75rem 1rem;
    font-size: 1.25rem;
    font-weight: 600;
    border: none;
    outline: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .restaurant summary:hover {
    background-color: var(--accent-hover);
  }

  .restaurant summary::-webkit-details-marker {
    display: none;
  }

  .restaurant summary::after {
    content: '▸';
    font-size: 1rem;
    transition: transform 0.2s ease;
  }

  .restaurant[open] summary::after {
    transform: rotate(90deg);
  }

  .restaurant .content {
    background-color: var(--card-bg);
    padding: 1rem;
  }

  .restaurant .category-heading {
    background-color: var(--category-heading-bg);
    color: var(--category-heading-text);
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    font-size: 1rem;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    margin-top: var(--spacing);
  }

  .restaurant .items-list {
    border: 1px solid var(--item-border);
    border-top: none;
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    overflow: hidden;
  }

  .restaurant .item-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0.75rem;
    border-bottom: 1px solid var(--item-border);
  }

  .restaurant .item-row:last-child {
    border-bottom: none;
  }

  .restaurant .item-info {
    flex: 1;
  }

  .restaurant .item-name {
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
  }

  .restaurant .item-desc {
    margin: 0.25rem 0 0;
    color: var(--text-secondary);
    font-size: 0. nine rem;
  }

  .restaurant .item-price {
    font-weight: 600;
    color: var(--accent-color);
    margin-left: 1rem;
    white-space: nowrap;
  }

  @media (max-width: 576px) {
    .restaurant summary {
      font-size: 1.1rem;
      padding: 0.6rem 0.8rem;
    }
    .restaurant .item-row {
      flex-direction: column;
      align-items: flex-start;
    }
    .restaurant .item-price {
      margin-top: 0.5rem;
      margin-left: 0;
    }
  }
</style>

<main class="container">
  <h2 class="page-title">Prikaz menija dostupnih restorana</h2>
  <h4 class="subtitle">Pozdrav, <?= esc($username) ?>! Klikni na naziv restorana da vidiš njegove kategorije:</h4>

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
    <details class="restaurant">
      <summary><?= esc($rest['name']) ?></summary>
      <div class="content">
        <?php if (empty($grouped)): ?>
          <p style="color: var(--text-secondary); font-style: italic;">Ovaj restoran još nema stavki menija.</p>
        <?php else: ?>
          <?php foreach ($order as $cat): ?>
            <?php if (! empty($grouped[$cat])): ?>
              <div class="category-heading"><?= esc($cat) ?></div>
              <div class="items-list">
                <?php foreach ($grouped[$cat] as $item): ?>
                  <div class="item-row">
                    <div class="item-info">
                      <p class="item-name"><?= esc($item['item_name']) ?></p>
                      <?php if ($item['description']): ?>
                        <p class="item-desc"><?= esc($item['description']) ?></p>
                      <?php endif; ?>
                    </div>
                    <div class="item-price">
                      <?= number_format($item['price'], 2, ',', '.') ?> EUR
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </details>
  <?php endforeach; ?>
</main>

<?= view('templates/footer') ?>
