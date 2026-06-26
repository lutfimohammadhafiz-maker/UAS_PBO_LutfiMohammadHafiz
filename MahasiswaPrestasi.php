<?php
// MahasiswaPrestasi.php - Subclass untuk Mahasiswa Prestasi
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, 
                                $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }
    
    // Getter dan Setter
    public function getNamaInstansiBeasiswa() {
        return $this->namaInstansiBeasiswa;
    }
    
    public function setNamaInstansiBeasiswa($namaInstansiBeasiswa) {
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
    }
    
    public function getMinimalIpkSyarat() {
        return $this->minimalIpkSyarat;
    }
    
    public function setMinimalIpkSyarat($minimalIpkSyarat) {
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }
    
    // Method select-where untuk MahasiswaPrestasi
    public function selectWherePrestasi($koneksi, $kondisi) {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'prestasi' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_prestasi = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_prestasi[] = $row;
        }
        
        return $data_prestasi;
    }
    
    // Implementasi method abstract
    public function hitungTagihanSemester() {
        // Mahasiswa prestasi mendapat potongan 50% dari UKT
        return $this->tarifUktNominal * 0.5;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        echo "=== SPESIFIKASI MAHASISWA PRESTASI ===\n";
        echo "ID Mahasiswa          : " . $this->id_mahasiswa . "\n";
        echo "Nama                  : " . $this->nama_mahasiswa . "\n";
        echo "NIM                   : " . $this->nim . "\n";
        echo "Semester              : " . $this->semester . "\n";
        echo "Tarif UKT             : Rp " . number_format($this->tarifUktNominal, 0, ',', '.') . "\n";
        echo "Jenis Biaya           : Prestasi\n";
        echo "Nama Instansi Beasiswa: " . $this->namaInstansiBeasiswa . "\n";
        echo "Minimal IPK Syarat    : " . $this->minimalIpkSyarat . "\n";
        echo "Tagihan Semester (50%): Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------------\n";
    }
}
?>