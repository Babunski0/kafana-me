<?= view('templates/header', ['title' => 'Moje rezervacije']) ?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

  :root {
    --primary-bg: #5E8F8F;
    --container-bg: #5E8F8F;
    --card-bg: #ffffff;
    --card-shadow: rgba(0, 0, 0, 0.1);
    --header-bg: #2D4B4B;
    --header-text-yellow: #FFD166;
    --header-text-red: #EF476F;
    --header-text-green: #06D6A0;
    --row-even-bg: #497171;
    --text-light: #E0E0E0;
    --text-dark: #333333; 
    --text-white: #FFFFFF;
    --danger-color: #e74c3c;
    --danger-hover: #c0392b;
    --border-radius: 8px;
    --spacing: 1rem;
  }

  body {
    font-family: 'Montserrat', sans-serif;
    background-color: var(--primary-bg);
    color: var(--text-light);
  }

  main.container {
    max-width: 800px;
    margin: 40px auto;
    background-color: var(--container-bg);
    padding: 20px 30px;
    border-radius: var(--border-radius);
    box-shadow: 0 2px 12px var(--card-shadow);
  }

  h1 {
    margin-top: 0;
    font-size: 1.8em;
    color: var(--text-white);
    text-align: center;
  }

  .greeting {
    margin-bottom: 20px;
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.4;
  }

  .no-reservations {
    text-align: center;
    color: var(--text-white);
    padding: 20px 0;
    font-size: 1rem;
  }

  .reservations-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 2px 8px var(--card-shadow);
  }

  .reservations-table thead th {
    padding: 12px;
    background-color: var(--header-bg);
    color: var(--text-white);
    font-weight: 600;
    font-size: 0.95rem;
    text-align: left;
  }

  .reservations-table thead th:nth-child(1) {
    color: var(--header-text-yellow);
  }
  .reservations-table thead th:nth-child(2),
  .reservations-table thead th:nth-child(6) {
    color: var(--header-text-red);
  }
  .reservations-table thead th:nth-child(3),
  .reservations-table thead th:nth-child(4),
  .reservations-table thead th:nth-child(5) {
    color: var(--header-text-green);
  }

  .reservations-table tbody tr:nth-child(even) {
    background-color: var(--row-even-bg);
  }

  .reservations-table tbody td {
    padding: 8px;
    font-size: 0.9rem;
    color: var(--text-dark); 
  }

  .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 6px 12px;
    background-color: var(--danger-color);
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background-color 0.2s ease;
  }

  .btn-cancel:hover {
    background-color: var(--danger-hover);
  }

  @media (max-width: 576px) {
    h1 {
      font-size: 1.5em;
    }
    .reservations-table thead th,
    .reservations-table tbody td {
      padding: 8px;
      font-size: 0.8rem;
    }
    .btn-cancel {
      padding: 5px 10px;
      font-size: 0.8rem;
    }
  }
</style>

<main class="container">
  <h1>Moje rezervacije</h1>
  <p class="greeting">
    Dobrodošao, <strong><?= esc(session()->get('username')) ?></strong>!<br>
    Ovo su tvoje aktivne rezervacije:
  </p>

  <?php if (empty($reservations)): ?>
    <p class="no-reservations">Trenutno nemaš nijednu rezervaciju.</p>
  <?php else: ?>
    <table class="reservations-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Restoran</th>
          <th>Osobe</th>
          <th>Obrok</th>
          <th>Vrijeme</th>
          <th>Akcija</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reservations as $i => $res): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($res['restaurant_name']) ?></td>
            <td><?= esc($res['people']) ?></td>
            <td><?= esc($res['meal_type']) ?></td>
            <td><?= esc($res['reservation_time']) ?></td>
            <td>
              <a
                href="<?= base_url('cancel/' . $res['id']) ?>"
                class="btn-cancel"
                onclick="return confirm('Da li zaista želiš da otkažeš ovu rezervaciju?');"
              >
                Otkaži
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</main>

<?= view('templates/footer') ?>
