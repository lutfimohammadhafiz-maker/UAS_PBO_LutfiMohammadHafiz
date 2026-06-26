<?php
// MahasiswaMandiri.php - Subclass untuk Mahasiswa Mandiri
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private $golonganUkt;
    private $namaWali;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, 
                                $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }
    
    // Getter dan Setter
    public function getGolonganUkt() {
        return $this->golonganUkt;
    }
    
    public function setGolonganUkt($golonganUkt) {
        $this->golonganUkt = $golonganUkt;
    }
    
    public function getNamaWali() {
        return $this->namaWali;
    }
    
    public function setNamaWali($namaWali) {
        $this->namaWali = $namaWali;
    }
    
    // Method select-where untuk MahasiswaMandiri
    public function selectWhereMandiri($koneksi, $kondisi) {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'mandiri' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_mandiri = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_mandiri[] = $row;
        }
        
        return $data_mandiri;
    }
    
    // Implementasi method abstract
    public function hitungTagihanSemester() {
        // Mahasiswa mandiri membayar full UKT
        return $this->tarifUktNominal;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        echo "=== SPESIFIKASI MAHASISWA MANDIRI ===\n";
        echo "ID Mahasiswa    : " . $this->id_mahasiswa . "\n";
        echo "Nama            : " . $this->nama_mahasiswa . "\n";
        echo "NIM             : " . $this->nim . "\n";
        echo "Semester        : " . $this->semester . "\n";
        echo "Tarif UKT       : Rp " . number_format($this->tarifUktNominal, 0, ',', '.') . "\n";
        echo "Jenis Biaya     : Mandiri\n";
        echo "Golongan UKT    : " . $this->golonganUkt . "\n";
        echo "Nama Wali       : " . $this->namaWali . "\n";
        echo "Tagihan Semester: Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------\n";
    }
}
?>