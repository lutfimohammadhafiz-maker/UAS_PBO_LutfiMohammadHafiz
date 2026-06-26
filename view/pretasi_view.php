<?php
// views/prestasi_view.php
?>
<div class="content <?php echo ($_GET['tab'] ?? 'mandiri') == 'prestasi' ? 'active' : ''; ?>">
    <h2 style="color: #2ecc71; margin-bottom: 20px;">🏆 Mahasiswa Prestasi</h2>
    
    <div class="stats">
        <div class="stat-card prestasi">
            <div class="number"><?php echo count($data_prestasi); ?></div>
            <div class="label">Total Mahasiswa</div>
        </div>
        <div class="stat-card prestasi">
            <div class="number"><?php 
                $total_tagihan = 0;
                foreach ($data_prestasi as $m) {
                    $total_tagihan += $m['tagihan'];
                }
                echo 'Rp ' . number_format($total_tagihan, 0, ',', '.');
            ?></div>
            <div class="label">Total Tagihan (25%)</div>
        </div>
        <div class="stat-card prestasi">
            <div class="number"><?php 
                $rata = count($data_prestasi) > 0 ? $total_tagihan / count($data_prestasi) : 0;
                echo 'Rp ' . number_format($rata, 0, ',', '.');
            ?></div>
            <div class="label">Rata-rata Tagihan</div>
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
                    <th>Instansi Beasiswa</th>
                    <th>Min. IPK</th>
                    <th>Tagihan (25%)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data_prestasi) > 0): ?>
                    <?php foreach ($data_prestasi as $m): ?>
                    <tr>
                        <td><?php echo $m['id']; ?></td>
                        <td><strong><?php echo $m['nama']; ?></strong></td>
                        <td><?php echo $m['nim']; ?></td>
                        <td>Semester <?php echo $m['semester']; ?></td>
                        <td>Rp <?php echo number_format($m['tarif_ukt'], 0, ',', '.'); ?></td>
                        <td><?php echo $m['instansi']; ?></td>
                        <td><?php echo number_format($m['ipk_syarat'], 2); ?></td>
                        <td><strong style="color: #2ecc71;">Rp <?php echo number_format($m['tagihan'], 0, ',', '.'); ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            Tidak ada data mahasiswa prestasi
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>