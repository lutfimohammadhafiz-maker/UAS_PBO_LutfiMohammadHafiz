<?php
// insert_data.php - Script untuk mengisi data jika database kosong
require_once 'config/database.php';

echo "=== MENGISI DATA MAHASISWA ===\n\n";

// Cek apakah data sudah ada
$check = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tabel_mahasiswa");
$row = mysqli_fetch_assoc($check);

if ($row['total'] > 0) {
    echo "Data sudah ada! Total: " . $row['total'] . " mahasiswa\n";
    echo "Tidak perlu insert data baru.\n";
    exit;
}

// Data MANDIRI (7 data)
$mandiri = [
    ['Ahmad Fauzi', 'TRPL1A001', 1, 9500000, 'mandiri', 'Budi Santoso', NULL, NULL, NULL, NULL],
    ['Siti Rahmawati', 'TRPL1A002', 3, 10500000, 'mandiri', 'Ahmad Dahlan', NULL, NULL, NULL, NULL],
    ['Muhammad Rizky', 'TRPL1A003', 5, 11500000, 'mandiri', 'Haryanto', NULL, NULL, NULL, NULL],
    ['Dewi Lestari', 'TRPL1A004', 7, 12500000, 'mandiri', 'Sutrisno', NULL, NULL, NULL, NULL],
    ['Rudi Hartono', 'TRPL1A005', 2, 9800000, 'mandiri', 'Slamet Riyadi', NULL, NULL, NULL, NULL],
    ['Nina Susanti', 'TRPL1A006', 4, 10800000, 'mandiri', 'Agus Salim', NULL, NULL, NULL, NULL],
    ['Andi Pratama', 'TRPL1A007', 6, 11800000, 'mandiri', 'Darmawan', NULL, NULL, NULL, NULL]
];

// Data BIDIKMISI (7 data)
$bidikmisi = [
    ['Fikri Ramadhan', 'TRPL1A008', 1, 500000, 'bidikmisi', 'Samsul Bahri', 'KIP2025001', 850000, NULL, 2.75],
    ['Rina Anggraini', 'TRPL1A009', 3, 500000, 'bidikmisi', 'Mardiono', 'KIP2025002', 850000, NULL, 2.80],
    ['Irfan Hakim', 'TRPL1A010', 5, 500000, 'bidikmisi', 'Sukardi', 'KIP2025003', 850000, NULL, 2.85],
    ['Dina Melati', 'TRPL1A011', 7, 500000, 'bidikmisi', 'Rusdi', 'KIP2025004', 850000, NULL, 2.70],
    ['Bayu Saputra', 'TRPL1A012', 2, 500000, 'bidikmisi', 'Suryanto', 'KIP2025005', 850000, NULL, 2.75],
    ['Intan Permata', 'TRPL1A013', 4, 500000, 'bidikmisi', 'Suparman', 'KIP2025006', 850000, NULL, 2.80],
    ['Hendra Kusuma', 'TRPL1A014', 6, 500000, 'bidikmisi', 'Mustofa', 'KIP2025007', 850000, NULL, 2.85]
];

// Data PRESTASI (6 data)
$prestasi = [
    ['Tiara Puspita', 'TRPL1A015', 1, 1500000, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.50],
    ['Gilang Ramadhan', 'TRPL1A016', 3, 1500000, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.25],
    ['Maya Sari', 'TRPL1A017', 5, 1500000, 'prestasi', NULL, NULL, NULL, 'Bank Indonesia', 3.40],
    ['Aditya Nugroho', 'TRPL1A018', 7, 1500000, 'prestasi', NULL, NULL, NULL, 'Bank Indonesia', 3.30],
    ['Lisa Permata', 'TRPL1A019', 2, 1500000, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.45],
    ['Rio Febrian', 'TRPL1A020', 4, 1500000, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.35]
];

// Gabungkan semua data
$all_data = array_merge($mandiri, $bidikmisi, $prestasi);

// Insert data
$success = 0;
$failed = 0;

foreach ($all_data as $data) {
    $query = "INSERT INTO tabel_mahasiswa 
              (nama_mahasiswa, nim, semester, tarif_ukt_nominal, jenis_pembiayaan, 
               nama_wali, nomor_kip_kuliah, dana_saku_supsidi, nama_instansi_beasiswa, minimal_ipk_syarat) 
              VALUES (
                  '$data[0]', '$data[1]', $data[2], $data[3], '$data[4]',
                  " . ($data[5] ? "'$data[5]'" : "NULL") . ", 
                  " . ($data[6] ? "'$data[6]'" : "NULL") . ", 
                  " . ($data[7] ? $data[7] : "NULL") . ", 
                  " . ($data[8] ? "'$data[8]'" : "NULL") . ", 
                  " . ($data[9] ? $data[9] : "NULL") . "
              )";
    
    if (mysqli_query($koneksi, $query)) {
        $success++;
        echo "✓ Berhasil insert: " . $data[0] . " (" . $data[1] . ")\n";
    } else {
        $failed++;
        echo "✗ Gagal insert: " . $data[0] . " - " . mysqli_error($koneksi) . "\n";
    }
}

echo "\n=== HASIL INSERT ===\n";
echo "Berhasil: $success data\n";
echo "Gagal: $failed data\n";

mysqli_close($koneksi);
?>