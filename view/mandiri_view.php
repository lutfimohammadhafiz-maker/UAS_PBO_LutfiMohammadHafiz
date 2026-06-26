<?php
// views/mandiri_view.php
?>
<div class="content <?php echo ($_GET['tab'] ?? 'mandiri') == 'mandiri' ? 'active' : ''; ?>">
    <h2 style="color: #e74c3c; margin-bottom: 20px;">👨‍🎓 Mahasiswa Mandiri</h2>
    
    <div class="stats">
        <div class="stat-card mandiri">
            <div class="number"><?php echo count($data_mandiri); ?></div>
            <div class="label">Total Mahasiswa</div>
        </div>
        <div class="stat-card mandiri">
            <div class="number"><?php 
                $total_tagihan = 0;
                foreach ($data_mandiri as $m) {
                    $total_tagihan += $m['tagihan'];
                }
                echo 'Rp ' . number_format($total_tagihan, 0, ',', '.');
            ?></div>
            <div class="label">Total Tagihan</div>
        </div>
        <div class="stat-card mandiri">
            <div class="number"><?php 
                $rata = count($data_mandiri) > 0 ? $total_tagihan / count($data_mandiri) : 0;
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
                    <th>Golongan</th>
                    <th>Nama Wali</th>
                    <th>Tagihan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data_mandiri) > 0): ?>
                    <?php foreach ($data_mandiri as $m): ?>
                    <tr>
                        <td><?php echo $m['id']; ?></td>
                        <td><strong><?php echo $m['nama']; ?></strong></td>
                        <td><?php echo $m['nim']; ?></td>
                        <td>Semester <?php echo $m['semester']; ?></td>
                        <td>Rp <?php echo number_format($m['tarif_ukt'], 0, ',', '.'); ?></td>
                        <td><span class="badge badge-mandiri"><?php echo $m['golongan_ukt']; ?></span></td>
                        <td><?php echo $m['nama_wali']; ?></td>
                        <td><strong style="color: #e74c3c;">Rp <?php echo number_format($m['tagihan'], 0, ',', '.'); ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            Tidak ada data mahasiswa mandiri
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>