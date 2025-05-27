<!-- Pocetna stranica, vise marketinski prikaz -->

<?= view('templates/header', ['title' => 'Početna – Kafana Projekat']) ?>

<main class="container" style="background: #cbd4dc">
  
  <h1 class="page-title" style="text-align:center; margin:1.5rem 0; font-size:2.5rem; color: #2c3e50">Dobrodošli u kafanu</h1>

  <div class="section">
    <h2 style="color: #34495e">O našoj ideji</h2>
    <p style="color: #5d6d7e">Kafana Projekat je osmišljen da spoji bogatu dušu tradicionalnih kafana sa brzim i jednostavnim onlajn rezervisanjem mjesta. 
      Naše rješenje donosi vam atmosferu starinskih drvenih stolova, živu muziku i miris domaće kuhinje, ali bez stresa oko telefonskih poziva i dužeg čekanja. 
      Bilo da želite da provedete prijatno veče uz zvuke tamburice, organizujete poslovni ručak ili proslavite posebnu priliku, 
      kod nas ćete u par klikova pronaći i rezervisati najbolji kutak. Pored pregleda slobodnih mesta u realnom vremenu, 
      preko platforme možete pratiti i aktuelne događaje, tematske večeri i specijalne menije koje redovno pripremaju naši partneri. 
      Uživajte u jedinstvenom spoju tradicije i tehnologije — Kafana Projekat je vaša karta za nezaboravne trenutke u srcu grada.
    </p>
    <img 
      src="<?= base_url('images/photo1.jpg') ?>" 
      alt="Atmosfera kafane" 
      style="max-width:100%; height:75vh; min-height:120px; display:block; margin:1rem auto; border-radius: 16px;"
    >
  </div>


    <!-- Sekcija koja sadrzi 3 restorana (poslednja dodata) -->
    <div class="section">
        <h2 style="color: #34495e; padding-top: 2em;">Preporučeni restorani</h2>
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
                  <p><strong>Slobodnih mjesta:</strong> <?= $r['available'] ?></p>
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

    <!-- Sekcija za aktuelne dogadjaje -->
    <div class="section events">
  <h2 style="color: #34495e; padding-top: 2em;">Aktuelni događaji</h2>
  <div class="event-list">
    <div class="event-card">
      <img src="<?= base_url('images/svirka_uzivo.jpg') ?>" alt="Ambijent 1">
      <div class="info">
        <h3>Pod Volat</h3>
        <p><strong>Događaj:</strong> Svirka uživo</p>
        <p><strong>Datum:</strong> 15. maj 2025.</p>
      </div>
    </div>
    <div class="event-card">
      <img src="<?= base_url('images/jazz.jpg') ?>" alt="Ambijent 2">
      <div class="info">
        <h3>Garden</h3>
        <p><strong>Događaj:</strong> Jazz veče</p>
        <p><strong>Datum:</strong> 18. maj 2025.</p>
      </div>
    </div>
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


    <!--Sekcija zasto da koristi neko ovaj sajt -->
    <div class="section">
        <h2 style="color: #34495e; padding-top: 2em;">Zašto baš mi?</h2>
        <p style="color: #5d6d7e">✔️ Jednostavno i brzo rezervisanje<br>
           ✔️ Pregled slobodnih mjesta u realnom vremenu<br>
           ✔️ Detaljan pregled menija i aktuelnih dogadjaja<br>
           ✔️ Bezbjednost i pouzdanost</p>
    </div>

<?= view('templates/footer') ?>





