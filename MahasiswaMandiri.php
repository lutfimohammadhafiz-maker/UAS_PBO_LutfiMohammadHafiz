<?php
// MahasiswaMandiri.php
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
    
    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }
    
    public function selectWhereMandiri($koneksi, $kondisi = '1=1') {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'mandiri' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_mandiri = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_mandiri[] = $row;
        }
        return $data_mandiri;
    }
    
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal + 100000;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        return [
            'id' => $this->id_mahasiswa,
            'nama' => $this->nama_mahasiswa,
            'nim' => $this->nim,
            'semester' => $this->semester,
            'tarif_ukt' => $this->tarifUktNominal,
            'jenis' => 'Mandiri',
            'golongan_ukt' => $this->golonganUkt,
            'nama_wali' => $this->namaWali,
            'tagihan' => $this->hitungTagihanSemester()
        ];
    }
}
?>