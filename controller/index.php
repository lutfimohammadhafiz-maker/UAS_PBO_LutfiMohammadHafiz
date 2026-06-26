<?php
// index.php - Main Controller
require_once 'config/database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// Ambil data dari database
$mandiri = new MahasiswaMandiri(0, '', '', 0, 0, '', '');
$bidikmisi = new MahasiswaBidikmisi(0, '', '', 0, 0, '', 0);
$prestasi = new MahasiswaPrestasi(0, '', '', 0, 0, '', 0);

// Ambil semua data dari database
$data_mandiri_db = $mandiri->selectWhereMandiri($koneksi);
$data_bidikmisi_db = $bidikmisi->selectWhereBidikmisi($koneksi);
$data_prestasi_db = $prestasi->selectWherePrestasi($koneksi);

// Konversi data database ke objek untuk perhitungan tagihan
$data_mandiri = [];
foreach ($data_mandiri_db as $row) {
    $m = new MahasiswaMandiri(
        $row['id_mahasiswa'],
        $row['nama_mahasiswa'],
        $row['nim'],
        $row['semester'],
        $row['tarif_ukt_nominal'],
        'A', // default golongan
        $row['nama_wali'] ?? '-'
    );
    $data_mandiri[] = $m->tampilkanSpesifikasiAkademik();
}

$data_bidikmisi = [];
foreach ($data_bidikmisi_db as $row) {
    $m = new MahasiswaBidikmisi(
        $row['id_mahasiswa'],
        $row['nama_mahasiswa'],
        $row['nim'],
        $row['semester'],
        $row['tarif_ukt_nominal'],
        $row['nomor_kip_kuliah'] ?? '-',
        $row['dana_saku_supsidi'] ?? 0
    );
    $data_bidikmisi[] = $m->tampilkanSpesifikasiAkademik();
}

$data_prestasi = [];
foreach ($data_prestasi_db as $row) {
    $m = new MahasiswaPrestasi(
        $row['id_mahasiswa'],
        $row['nama_mahasiswa'],
        $row['nim'],
        $row['semester'],
        $row['tarif_ukt_nominal'],
        $row['nama_instansi_beasiswa'] ?? '-',
        $row['minimal_ipk_syarat'] ?? 0
    );
    $data_prestasi[] = $m->tampilkanSpesifikasiAkademik();
}

// Include header
include 'views/header.php';

// Tampilkan view berdasarkan tab yang dipilih
$tab = $_GET['tab'] ?? 'mandiri';

switch ($tab) {
    case 'bidikmisi':
        include 'views/bidikmisi_view.php';
        break;
    case 'prestasi':
        include 'views/prestasi_view.php';
        break;
    case 'mandiri':
    default:
        include 'views/mandiri_view.php';
        break;
}

// Include footer
include 'views/footer.php';

// Tutup koneksi
mysqli_close($koneksi);
?>