<?php
// MahasiswaPrestasi.php
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
    
    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }
    
    public function selectWherePrestasi($koneksi, $kondisi = '1=1') {
        $query = "SELECT * FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'prestasi' AND $kondisi";
        $result = mysqli_query($koneksi, $query);
        
        $data_prestasi = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_prestasi[] = $row;
        }
        return $data_prestasi;
    }
    
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal * 0.25;
    }
    
    public function tampilkanSpesifikasiAkademik() {
        return [
            'id' => $this->id_mahasiswa,
            'nama' => $this->nama_mahasiswa,
            'nim' => $this->nim,
            'semester' => $this->semester,
            'tarif_ukt' => $this->tarifUktNominal,
            'jenis' => 'Prestasi',
            'instansi' => $this->namaInstansiBeasiswa,
            'ipk_syarat' => $this->minimalIpkSyarat,
            'tagihan' => $this->hitungTagihanSemester()
        ];
    }
}
?>