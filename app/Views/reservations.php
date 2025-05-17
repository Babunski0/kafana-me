<?= view('templates/header', ['title' => 'Moje rezervacije']) ?>
<main class="container dark-container" style="max-width:800px; margin:40px auto; background:#5E8F8F; padding:20px 30px; border-radius:8px; box-shadow:0 2px 12px rgba(0,0,0,0.1);">
    <h1 style="margin-top:0; font-size:1.8em; color:#FFFFFF;">Moje rezervacije</h1>
    <p class="greeting" style="margin-bottom:20px; color:#E0E0E0;">
        Dobrodošao, <strong><?= esc(session()->get('username')) ?></strong>!<br>
        Ovo su tvoje aktivne rezervacije:
    </p>

    <?php if (empty($reservations)): ?>
        <p style="text-align:center; color:#FFFFFF; padding:20px 0;">Trenutno nemaš nijednu rezervaciju.</p>
    <?php else: ?>
        <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
            <thead>
                <tr>
                    <th style="padding:12px; background:#2D4B4B; color:#FFD166;">#</th>
                    <th style="padding:12px; background:#2D4B4B; color:#EF476F;">Restoran</th>
                    <th style="padding:12px; background:#2D4B4B; color:#06D6A0;">Osobe</th>
                    <th style="padding:12px; background:#2D4B4B; color:#06D6A0;">Obrok</th>
                    <th style="padding:12px; background:#2D4B4B; color:#06D6A0;">Vrijeme</th>
                    <th style="padding:12px; background:#2D4B4B; color:#EF476F;">Akcija</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $i => $res): ?>
                <tr style="<?= $i % 2 ? 'background:#497171;' : '' ?>; color:#E0E0E0;">
                    <td style="padding:8px;"><?= $i + 1 ?></td>
                    <td style="padding:8px;"><?= esc($res['restaurant_name']) ?></td>
                    <td style="padding:8px;"><?= esc($res['people']) ?></td>
                    <td style="padding:8px;"><?= esc($res['meal_type']) ?></td>
                    <td style="padding:8px;"><?= esc($res['reservation_time']) ?></td>
                    <td style="padding:8px;">
                        <a href="<?= base_url('cancel/'.$res['id']) ?>" class="btn-cancel" style="background:#e74c3c; color:#fff; padding:6px 12px; text-decoration:none; border-radius:4px;" onclick="return confirm('Da li zaista želiš da otkažeš ovu rezervaciju?');">Otkaži</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
<?= view('templates/footer') ?>