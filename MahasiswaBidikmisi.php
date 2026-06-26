<?php
// MahasiswaBidikmisi.php - Subclass untuk Mahasiswa Bidikmisi
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, 
                                $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }
    
    // Getter dan Setter
    public function getNomorKipKuliah() {
        return $this->nomorKipKuliah;
    }
    
    public function setNomorKipKuliah($nomorKipKuliah) {
        $this->nomorKipKuliah = $nomorKipKuliah;
    }
    
    public function getDanaSakuSubsidi() {
        return $this->danaSakuSubsidi;
    }
    
    public function setDanaSakuSubsidi($danaSakuSubsidi) {
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }
    
    // Method select-where untuk MahasiswaBidikmisi
    public function selectWhereBidikmisi($koneksi, $kondisi) {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'bidikmisi' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_bidikmisi = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_bidikmisi[] = $row;
        }
        
        return $data_bidikmisi;
    }
    
    // Implementasi method abstract
    public function hitungTagihanSemester() {
        // Mahasiswa bidikmisi membayar UKT yang sudah disubsidi
        $total_tagihan = $this->tarifUktNominal - $this->danaSakuSubsidi;
        return $total_tagihan > 0 ? $total_tagihan : 0;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        echo "=== SPESIFIKASI MAHASISWA BIDIKMISI ===\n";
        echo "ID Mahasiswa        : " . $this->id_mahasiswa . "\n";
        echo "Nama                : " . $this->nama_mahasiswa . "\n";
        echo "NIM                 : " . $this->nim . "\n";
        echo "Semester            : " . $this->semester . "\n";
        echo "Tarif UKT           : Rp " . number_format($this->tarifUktNominal, 0, ',', '.') . "\n";
        echo "Jenis Biaya         : Bidikmisi\n";
        echo "Nomor KIP Kuliah    : " . $this->nomorKipKuliah . "\n";
        echo "Dana Saku Subsidi   : Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.') . "\n";
        echo "Tagihan Semester    : Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------------\n";
    }
}
?>