<?= view('templates/header', ['title' => 'Početna – Kafana Projekat']) ?>

<main class="container">
  <!-- Naslov -->
  <h1 class="page-title" style="text-align:center; margin:1.5rem 0; font-size:2.5rem;">Dobrodošli u kafanu</h1>

  <div class="section">
    <h2>O našoj ideji</h2>
    <p>Kafana Projekat je osmišljen da spoji bogatu dušu tradicionalnih kafana sa brzim i jednostavnim onlajn rezervisanjem mjesta. 
      Naše rješenje donosi vam atmosferu starinskih drvenih stolova, živu muziku i miris domaće kuhinje, ali bez stresa oko telefonskih poziva i dužeg čekanja. 
      Bilo da želite da provedete prijatno veče uz zvuke tamburice, organizujete poslovni ručak ili proslavite posebnu priliku, 
      kod nas ćete u par klikova pronaći i rezervisati najbolji kutak. Pored pregleda slobodnih mesta u realnom vremenu, 
      preko platforme možete pratiti i aktuelne događaje, tematske večeri i specijalne menije koje redovno pripremaju naši partneri. 
      Uživajte u jedinstvenom spoju tradicije i tehnologije — Kafana Projekat je vaša karta za nezaboravne trenutke u srcu grada.
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

    <!-- Nova sekcija za aktuelne događaje -->
    <div class="section events">
  <h2>Aktuelni događaji</h2>
  <div class="event-list">
    <!-- Kartica 1 -->
    <div class="event-card">
      <img src="<?= base_url('images/svirka_uzivo.jpg') ?>" alt="Ambijent 1">
      <div class="info">
        <h3>Pod Volat</h3>
        <p><strong>Događaj:</strong> Svirka uživo</p>
        <p><strong>Datum:</strong> 15. maj 2025.</p>
      </div>
    </div>
    <!-- Kartica 2 -->
    <div class="event-card">
      <img src="<?= base_url('images/jazz.jpg') ?>" alt="Ambijent 2">
      <div class="info">
        <h3>Garden</h3>
        <p><strong>Događaj:</strong> Jazz veče</p>
        <p><strong>Datum:</strong> 18. maj 2025.</p>
      </div>
    </div>
    <!-- Kartica 3 -->
    <div class="event-card">
      <img src="<?= base_url('images/tamburaski_orkestar.jpg') ?>" alt="Ambijent 3">
      <div class="info">
        <h3>Kristal</h3>
        <p><strong>Događaj:</strong> Tamburaški orkestar</p>
        <p><strong>Datum:</strong> 20. maj 2025.</p>
      </div>
    </div>
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





