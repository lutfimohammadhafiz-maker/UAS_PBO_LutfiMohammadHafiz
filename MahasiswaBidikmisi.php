<?php
// MahasiswaBidikmisi.php
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
    
    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }
    
    public function selectWhereBidikmisi($koneksi, $kondisi = '1=1') {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'bidikmisi' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_bidikmisi = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_bidikmisi[] = $row;
        }
        return $data_bidikmisi;
    }
    
    public function hitungTagihanSemester() {
        return 0;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        return [
            'id' => $this->id_mahasiswa,
            'nama' => $this->nama_mahasiswa,
            'nim' => $this->nim,
            'semester' => $this->semester,
            'tarif_ukt' => $this->tarifUktNominal,
            'jenis' => 'Bidikmisi',
            'nomor_kip' => $this->nomorKipKuliah,
            'dana_saku' => $this->danaSakuSubsidi,
            'tagihan' => $this->hitungTagihanSemester()
        ];
    }
}
?>