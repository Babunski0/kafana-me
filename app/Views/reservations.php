<?= view('templates/header', ['title' => 'Moje rezervacije']) ?>

<main class="container" style="max-width:800px; margin:40px auto; background:#fff; padding:20px 30px; border-radius:8px; box-shadow:0 2px 12px rgba(0,0,0,0.1);">
    <h1 style="margin-top:0; font-size:1.8em; color:#333;">Moje rezervacije</h1>
    <p class="greeting" style="margin-bottom:20px; color:#555;">
        Dobrodošao, <strong><?= esc(session()->get('username')) ?></strong>!<br>
        Ovo su tvoje aktivne rezervacije:
    </p>

    <?php if (empty($reservations)): ?>
        <p class="no-reservations" style="text-align:center; color:#777; padding:20px 0;">
            Trenutno nemaš nijednu rezervaciju.
        </p>
    <?php else: ?>
        <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
            <thead>
                <tr>
                    <th style="padding:12px 8px; background:#f0f0f0; color:#666; font-weight:normal; text-align:left;">#</th>
                    <th style="padding:12px 8px; background:#f0f0f0; color:#666; font-weight:normal; text-align:left;">Restoran</th>
                    <th style="padding:12px 8px; background:#f0f0f0; color:#666; font-weight:normal; text-align:left;">Akcija</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $i => $res): ?>
                    <tr style="<?= $i % 2 ? 'background:#fafafa;' : '' ?>">
                        <td style="padding:12px 8px;"><?= $i + 1 ?></td>
                        <td style="padding:12px 8px;"><?= esc($res['restaurant_name']) ?></td>
                        <td style="padding:12px 8px;">
                            <a 
                              href="<?= base_url('cancel/'.$res['id']) ?>" 
                              class="btn-cancel"
                              style="background:#e74c3c; color:#fff; padding:6px 12px; text-decoration:none; border-radius:4px; font-size:0.9em;"
                              onclick="return confirm('Da li zaista želiš da otkažeš ovu rezervaciju?');"
                            >
                              Otkaži
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</main>

<?= view('templates/footer') ?>
