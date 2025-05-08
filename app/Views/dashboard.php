<?= view('templates/header', ['title' => 'Početna – Kafana Projekat']) ?>

<main class="container">
  <!-- Naslov -->
  <h1 class="page-title" style="text-align:center; margin:1.5rem 0; font-size:2.5rem;">Dobrodošli u kafanu</h1>

  <div class="section">
    <h2>O našoj ideji</h2>
    <p>Kafana Projekat je osmišljen da spoji tradiciju i moderni način rezervacije mesta ...
    </p>
    <img 
      src="<?= base_url('images/photo1.jpg') ?>" 
      alt="Atmosfera kafane" 
      style="max-width:100%; height:auto; display:block; margin:1rem auto;"
    >
  </div>

    <div class="section">
        <h2>Preporučeni restorani</h2>
        <div class="restaurant-list">
            <?php if (empty($restaurants)): ?>
              <p>Još nema restorana za preporuku.</p>
            <?php else: foreach ($restaurants as $r): ?>
              <div class="restaurant-card">
                <img src="<?= base_url('uploads/'.$r['image']) ?>"
                     alt="<?= esc($r['name']) ?>">
                <div class="info">
                  <h3><?= esc($r['name']) ?></h3>
                  <p><strong>Kuhinja:</strong> <?= esc($r['cuisine']) ?></p>
                  <p><strong>Slobodnih mesta:</strong> <?= $r['available'] ?></p>
                </div>
                <?php if ($r['available'] > 0): ?>
                  <a 
                    href="<?= base_url('reserve/'.$r['id']) ?>" 
                    class="btn btn-success btn-reserve" 
                    data-id="<?= $r['id'] ?>"
                  >
                    Rezerviši
                  </a>
                <?php else: ?>
                  <span class="btn disabled">Nema slobodnih mesta</span>
                <?php endif; ?>
              </div>
            <?php endforeach; endif; ?>
        </div>
    </div>

    <div class="section">
        <h2>Zašto baš mi?</h2>
        <p>✔️ Jednostavno i brzo rezervisanje<br>
           ✔️ Pregled slobodnih mesta u realnom vremenu<br>
           ✔️ Ekskluzivne ponude i popusti<br>
           ✔️ Autentična atmosfera i najbolja lokacija</p>
    </div>

<?= view('templates/footer') ?>





