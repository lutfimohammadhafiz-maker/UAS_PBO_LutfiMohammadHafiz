<?php
// views/bidikmisi_view.php
?>
<div class="content <?php echo ($_GET['tab'] ?? 'mandiri') == 'bidikmisi' ? 'active' : ''; ?>">
    <h2 style="color: #f39c12; margin-bottom: 20px;">🎓 Mahasiswa Bidikmisi</h2>
    
    <div class="stats">
        <div class="stat-card bidikmisi">
            <div class="number"><?php echo count($data_bidikmisi); ?></div>
            <div class="label">Total Mahasiswa</div>
        </div>
        <div class="stat-card bidikmisi">
            <div class="number">Rp 0</div>
            <div class="label">Total Tagihan (GRATIS)</div>
        </div>
        <div class="stat-card bidikmisi">
            <div class="number"><?php 
                $total_saku = 0;
                foreach ($data_bidikmisi as $m) {
                    $total_saku += $m['dana_saku'];
                }
                echo 'Rp ' . number_format($total_saku, 0, ',', '.');
            ?></div>
            <div class="label">Total Dana Saku</div>
        </div>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Semester</th>
                    <th>Tarif UKT</th>
                    <th>Nomor KIP</th>
                    <th>Dana Saku</th>
                    <th>Tagihan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data_bidikmisi) > 0): ?>
                    <?php foreach ($data_bidikmisi as $m): ?>
                    <tr>
                        <td><?php echo $m['id']; ?></td>
                        <td><strong><?php echo $m['nama']; ?></strong></td>
                        <td><?php echo $m['nim']; ?></td>
                        <td>Semester <?php echo $m['semester']; ?></td>
                        <td>Rp <?php echo number_format($m['tarif_ukt'], 0, ',', '.'); ?></td>
                        <td><?php echo $m['nomor_kip']; ?></td>
                        <td>Rp <?php echo number_format($m['dana_saku'], 0, ',', '.'); ?></td>
                        <td><strong style="color: #2ecc71;">Rp 0 (GRATIS)</strong></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            Tidak ada data mahasiswa bidikmisi
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>