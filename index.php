<?php
// index.php - Versi Simpel
require_once 'config/database.php';

// Ambil parameter tab
$tab = $_GET['tab'] ?? 'mandiri';

// Query untuk mengambil data berdasarkan jenis
function getDataMahasiswa($koneksi, $jenis) {
    $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = '$jenis'";
    $result = mysqli_query($koneksi, $query);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Ambil data semua jenis
$data_mandiri = getDataMahasiswa($koneksi, 'mandiri');
$data_bidikmisi = getDataMahasiswa($koneksi, 'bidikmisi');
$data_prestasi = getDataMahasiswa($koneksi, 'prestasi');

// Hitung total
$total_mandiri = count($data_mandiri);
$total_bidikmisi = count($data_bidikmisi);
$total_prestasi = count($data_prestasi);
$total_keseluruhan = $total_mandiri + $total_bidikmisi + $total_prestasi;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - UAS PBO</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 5px;
            font-size: 2.5em;
        }
        
        .subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .nav-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
            flex-wrap: wrap;
        }
        
        .nav-tab {
            padding: 12px 30px;
            background: #ecf0f1;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #34495e;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .nav-tab:hover {
            background: #d5dbdb;
            transform: translateY(-2px);
        }
        
        .nav-tab.active {
            color: white;
        }
        
        .nav-tab.mandiri { border-left: 4px solid #e74c3c; }
        .nav-tab.mandiri.active { background: #e74c3c; }
        
        .nav-tab.bidikmisi { border-left: 4px solid #f39c12; }
        .nav-tab.bidikmisi.active { background: #f39c12; }
        
        .nav-tab.prestasi { border-left: 4px solid #2ecc71; }
        .nav-tab.prestasi.active { background: #2ecc71; }
        
        .content {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border-left: 4px solid #3498db;
        }
        
        .stat-card .number {
            font-size: 2em;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .stat-card .label {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .stat-card.mandiri { border-left-color: #e74c3c; }
        .stat-card.bidikmisi { border-left-color: #f39c12; }
        .stat-card.prestasi { border-left-color: #2ecc71; }
        
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
        }
        
        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        tbody tr:hover {
            background: #f8f9fa;
            transition: background 0.3s;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-mandiri { background: #e74c3c; color: white; }
        .badge-bidikmisi { background: #f39c12; color: white; }
        .badge-prestasi { background: #2ecc71; color: white; }
        
        .empty-data {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        .empty-data .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ecf0f1;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .debug-info {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            h1 { font-size: 1.8em; }
            .nav-tabs { flex-wrap: wrap; }
            .nav-tab { flex: 1; text-align: center; font-size: 14px; padding: 10px; }
            table { font-size: 12px; }
            th, td { padding: 8px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Data Mahasiswa</h1>
        <p class="subtitle">Sistem Informasi Pembiayaan UKT - UAS PBO</p>
        
        <!-- Debug Info -->
        <div class="debug-info">
            <strong>📌 Informasi Database:</strong><br>
            Database: <?php echo $database; ?> | 
            Total Data: <?php echo $total_keseluruhan; ?> mahasiswa<br>
            <small>Mandiri: <?php echo $total_mandiri; ?> | 
            Bidikmisi: <?php echo $total_bidikmisi; ?> | 
            Prestasi: <?php echo $total_prestasi; ?></small>
        </div>
        
        <!-- Navigation -->
        <div class="nav-tabs">
            <a href="?tab=mandiri" class="nav-tab mandiri <?php echo $tab == 'mandiri' ? 'active' : ''; ?>">
                🔴 Mandiri (<?php echo $total_mandiri; ?>)
            </a>
            <a href="?tab=bidikmisi" class="nav-tab bidikmisi <?php echo $tab == 'bidikmisi' ? 'active' : ''; ?>">
                🟠 Bidikmisi (<?php echo $total_bidikmisi; ?>)
            </a>
            <a href="?tab=prestasi" class="nav-tab prestasi <?php echo $tab == 'prestasi' ? 'active' : ''; ?>">
                🟢 Prestasi (<?php echo $total_prestasi; ?>)
            </a>
        </div>
        
        <!-- CONTENT MANDIRI -->
        <div class="content <?php echo $tab == 'mandiri' ? 'active' : ''; ?>">
            <h2 style="color: #e74c3c; margin-bottom: 20px;">👨‍🎓 Mahasiswa Mandiri</h2>
            
            <div class="stats">
                <div class="stat-card mandiri">
                    <div class="number"><?php echo $total_mandiri; ?></div>
                    <div class="label">Total Mahasiswa</div>
                </div>
                <div class="stat-card mandiri">
                    <div class="number">
                        <?php 
                        $total_ukt = 0;
                        foreach ($data_mandiri as $m) {
                            $total_ukt += $m['tarif_ukt_nominal'] + 100000;
                        }
                        echo 'Rp ' . number_format($total_ukt, 0, ',', '.');
                        ?>
                    </div>
                    <div class="label">Total Tagihan (+Rp100.000)</div>
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
                            <th>Nama Wali</th>
                            <th>Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($data_mandiri) > 0): ?>
                            <?php foreach ($data_mandiri as $m): ?>
                            <tr>
                                <td><?php echo $m['id_mahasiswa']; ?></td>
                                <td><strong><?php echo $m['nama_mahasiswa']; ?></strong></td>
                                <td><?php echo $m['nim']; ?></td>
                                <td>Semester <?php echo $m['semester']; ?></td>
                                <td>Rp <?php echo number_format($m['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                                <td><?php echo $m['nama_wali'] ?? '-'; ?></td>
                                <td><strong style="color: #e74c3c;">Rp <?php echo number_format($m['tarif_ukt_nominal'] + 100000, 0, ',', '.'); ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-data">
                                    <div class="icon">📭</div>
                                    Belum ada data mahasiswa mandiri
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- CONTENT BIDIKMISI -->
        <div class="content <?php echo $tab == 'bidikmisi' ? 'active' : ''; ?>">
            <h2 style="color: #f39c12; margin-bottom: 20px;">🎓 Mahasiswa Bidikmisi</h2>
            
            <div class="stats">
                <div class="stat-card bidikmisi">
                    <div class="number"><?php echo $total_bidikmisi; ?></div>
                    <div class="label">Total Mahasiswa</div>
                </div>
                <div class="stat-card bidikmisi">
                    <div class="number">Rp 0</div>
                    <div class="label">Total Tagihan (GRATIS)</div>
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
                                <td><?php echo $m['id_mahasiswa']; ?></td>
                                <td><strong><?php echo $m['nama_mahasiswa']; ?></strong></td>
                                <td><?php echo $m['nim']; ?></td>
                                <td>Semester <?php echo $m['semester']; ?></td>
                                <td>Rp <?php echo number_format($m['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                                <td><?php echo $m['nomor_kip_kuliah'] ?? '-'; ?></td>
                                <td>Rp <?php echo number_format($m['dana_saku_supsidi'] ?? 0, 0, ',', '.'); ?></td>
                                <td><strong style="color: #2ecc71;">Rp 0 (GRATIS)</strong></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-data">
                                    <div class="icon">📭</div>
                                    Belum ada data mahasiswa bidikmisi
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- CONTENT PRESTASI -->
        <div class="content <?php echo $tab == 'prestasi' ? 'active' : ''; ?>">
            <h2 style="color: #2ecc71; margin-bottom: 20px;">🏆 Mahasiswa Prestasi</h2>
            
            <div class="stats">
                <div class="stat-card prestasi">
                    <div class="number"><?php echo $total_prestasi; ?></div>
                    <div class="label">Total Mahasiswa</div>
                </div>
                <div class="stat-card prestasi">
                    <div class="number">
                        <?php 
                        $total_tagihan = 0;
                        foreach ($data_prestasi as $m) {
                            $total_tagihan += $m['tarif_ukt_nominal'] * 0.25;
                        }
                        echo 'Rp ' . number_format($total_tagihan, 0, ',', '.');
                        ?>
                    </div>
                    <div class="label">Total Tagihan (25%)</div>
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
                                <td><?php echo $m['id_mahasiswa']; ?></td>
                                <td><strong><?php echo $m['nama_mahasiswa']; ?></strong></td>
                                <td><?php echo $m['nim']; ?></td>
                                <td>Semester <?php echo $m['semester']; ?></td>
                                <td>Rp <?php echo number_format($m['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                                <td><?php echo $m['nama_instansi_beasiswa'] ?? '-'; ?></td>
                                <td><?php echo number_format($m['minimal_ipk_syarat'] ?? 0, 2); ?></td>
                                <td><strong style="color: #2ecc71;">Rp <?php echo number_format($m['tarif_ukt_nominal'] * 0.25, 0, ',', '.'); ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-data">
                                    <div class="icon">📭</div>
                                    Belum ada data mahasiswa prestasi
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> - UAS PBO - Lutfi Mohammad Hafiz - TRPL1A</p>
            <p>Database: <?php echo $database; ?></p>
        </div>
    </div>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>