<?php
// Mahasiswa.php - Abstract Class
abstract class Mahasiswa {
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }
    
    public function getIdMahasiswa() { return $this->id_mahasiswa; }
    public function getNamaMahasiswa() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }
    
    public function setIdMahasiswa($id_mahasiswa) { $this->id_mahasiswa = $id_mahasiswa; }
    public function setNamaMahasiswa($nama_mahasiswa) { $this->nama_mahasiswa = $nama_mahasiswa; }
    public function setNim($nim) { $this->nim = $nim; }
    public function setSemester($semester) { $this->semester = $semester; }
    public function setTarifUktNominal($tarifUktNominal) { $this->tarifUktNominal = $tarifUktNominal; }
    
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}
?>