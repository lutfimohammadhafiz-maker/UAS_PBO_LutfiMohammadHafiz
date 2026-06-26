<?php
// 1. Abstract Class Mahasiswa
abstract class Mahasiswa {
    // Atribut terenkapsulasi (protected)
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;
    
    // Constructor
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }
    
    // Getter methods
    public function getIdMahasiswa() {
        return $this->id_mahasiswa;
    }
    
    public function getNamaMahasiswa() {
        return $this->nama_mahasiswa;
    }
    
    public function getNim() {
        return $this->nim;
    }
    
    public function getSemester() {
        return $this->semester;
    }
    
    public function getTarifUktNominal() {
        return $this->tarifUktNominal;
    }
    
    // Setter methods
    public function setIdMahasiswa($id_mahasiswa) {
        $this->id_mahasiswa = $id_mahasiswa;
    }
    
    public function setNamaMahasiswa($nama_mahasiswa) {
        $this->nama_mahasiswa = $nama_mahasiswa;
    }
    
    public function setNim($nim) {
        $this->nim = $nim;
    }
    
    public function setSemester($semester) {
        $this->semester = $semester;
    }
    
    public function setTarifUktNominal($tarifUktNominal) {
        $this->tarifUktNominal = $tarifUktNominal;
    }
    
    // Abstract methods (tanpa body)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}

// 2. Class MahasiswaMandiri (turunan dari Mahasiswa)
class MahasiswaMandiri extends Mahasiswa {
    private $nama_wali;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nama_wali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nama_wali = $nama_wali;
    }
    
    public function getNamaWali() {
        return $this->nama_wali;
    }
    
    public function setNamaWali($nama_wali) {
        $this->nama_wali = $nama_wali;
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
        echo "Nama Wali       : " . $this->nama_wali . "\n";
        echo "Tagihan Semester: Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------\n";
    }
}

// 3. Class MahasiswaBidikmisi (turunan dari Mahasiswa)
class MahasiswaBidikmisi extends Mahasiswa {
    private $nama_wali;
    private $nomor_kip_kuliah;
    private $dana_saku_subsidi;
    private $minimal_ipk_syarat;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, 
                                $nama_wali, $nomor_kip_kuliah, $dana_saku_subsidi, $minimal_ipk_syarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nama_wali = $nama_wali;
        $this->nomor_kip_kuliah = $nomor_kip_kuliah;
        $this->dana_saku_subsidi = $dana_saku_subsidi;
        $this->minimal_ipk_syarat = $minimal_ipk_syarat;
    }
    
    // Getter dan Setter
    public function getNamaWali() {
        return $this->nama_wali;
    }
    
    public function setNamaWali($nama_wali) {
        $this->nama_wali = $nama_wali;
    }
    
    public function getNomorKipKuliah() {
        return $this->nomor_kip_kuliah;
    }
    
    public function setNomorKipKuliah($nomor_kip_kuliah) {
        $this->nomor_kip_kuliah = $nomor_kip_kuliah;
    }
    
    public function getDanaSakuSubsidi() {
        return $this->dana_saku_subsidi;
    }
    
    public function setDanaSakuSubsidi($dana_saku_subsidi) {
        $this->dana_saku_subsidi = $dana_saku_subsidi;
    }
    
    public function getMinimalIpkSyarat() {
        return $this->minimal_ipk_syarat;
    }
    
    public function setMinimalIpkSyarat($minimal_ipk_syarat) {
        $this->minimal_ipk_syarat = $minimal_ipk_syarat;
    }
    
    // Implementasi method abstract
    public function hitungTagihanSemester() {
        // Mahasiswa bidikmisi membayar UKT yang sudah disubsidi
        // dan mendapatkan dana saku
        $total_tagihan = $this->tarifUktNominal - $this->dana_saku_subsidi;
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
        echo "Nama Wali           : " . $this->nama_wali . "\n";
        echo "Nomor KIP Kuliah    : " . $this->nomor_kip_kuliah . "\n";
        echo "Dana Saku Subsidi   : Rp " . number_format($this->dana_saku_subsidi, 0, ',', '.') . "\n";
        echo "Minimal IPK Syarat  : " . $this->minimal_ipk_syarat . "\n";
        echo "Tagihan Semester    : Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------------\n";
    }
}

// 4. Class MahasiswaPrestasi (turunan dari Mahasiswa)
class MahasiswaPrestasi extends Mahasiswa {
    private $nama_instansi_beasiswa;
    private $minimal_ipk_syarat;
    
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, 
                                $nama_instansi_beasiswa, $minimal_ipk_syarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nama_instansi_beasiswa = $nama_instansi_beasiswa;
        $this->minimal_ipk_syarat = $minimal_ipk_syarat;
    }
    
    // Getter dan Setter
    public function getNamaInstansiBeasiswa() {
        return $this->nama_instansi_beasiswa;
    }
    
    public function setNamaInstansiBeasiswa($nama_instansi_beasiswa) {
        $this->nama_instansi_beasiswa = $nama_instansi_beasiswa;
    }
    
    public function getMinimalIpkSyarat() {
        return $this->minimal_ipk_syarat;
    }
    
    public function setMinimalIpkSyarat($minimal_ipk_syarat) {
        $this->minimal_ipk_syarat = $minimal_ipk_syarat;
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
        echo "Nama Instansi Beasiswa: " . $this->nama_instansi_beasiswa . "\n";
        echo "Minimal IPK Syarat    : " . $this->minimal_ipk_syarat . "\n";
        echo "Tagihan Semester (50%): Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "-----------------------------------------\n";
    }
}

// 5. Contoh Penggunaan dan Testing dengan Data dari Database
echo "===== IMPLEMENTASI ABSTRACT CLASS MAHASISWA =====\n\n";

// Membuat objek Mahasiswa Mandiri
$mandiri1 = new MahasiswaMandiri(1, "Ahmad Fauzi", "TRPL1A001", 1, 9500000, "Budi Santoso");
$mandiri2 = new MahasiswaMandiri(2, "Siti Rahmawati", "TRPL1A002", 3, 10500000, "Ahmad Dahlan");
$mandiri3 = new MahasiswaMandiri(3, "Muhammad Rizky", "TRPL1A003", 5, 11500000, "Haryanto");

// Membuat objek Mahasiswa Bidikmisi
$bidikmisi1 = new MahasiswaBidikmisi(8, "Fikri Ramadhan", "TRPL1A008", 1, 500000, 
                                     "Samsul Bahri", "KIP2025001", 850000, 2.75);
$bidikmisi2 = new MahasiswaBidikmisi(9, "Rina Anggraini", "TRPL1A009", 3, 500000, 
                                     "Mardiono", "KIP2025002", 850000, 2.80);
$bidikmisi3 = new MahasiswaBidikmisi(10, "Irfan Hakim", "TRPL1A010", 5, 500000, 
                                     "Sukardi", "KIP2025003", 850000, 2.85);

// Membuat objek Mahasiswa Prestasi
$prestasi1 = new MahasiswaPrestasi(15, "Tiara Puspita", "TRPL1A015", 1, 1500000, 
                                   "Kemendikbud", 3.50);
$prestasi2 = new MahasiswaPrestasi(16, "Gilang Ramadhan", "TRPL1A016", 3, 1500000, 
                                   "Kemendikbud", 3.25);
$prestasi3 = new MahasiswaPrestasi(17, "Maya Sari", "TRPL1A017", 5, 1500000, 
                                   "Bank Indonesia", 3.40);

// Menampilkan spesifikasi semua mahasiswa
echo "1. DATA MAHASISWA MANDIRI\n";
echo "==========================\n";
$mandiri1->tampilkanSpesifikasiAkademik();
$mandiri2->tampilkanSpesifikasiAkademik();
$mandiri3->tampilkanSpesifikasiAkademik();

echo "\n2. DATA MAHASISWA BIDIKMISI\n";
echo "===========================\n";
$bidikmisi1->tampilkanSpesifikasiAkademik();
$bidikmisi2->tampilkanSpesifikasiAkademik();
$bidikmisi3->tampilkanSpesifikasiAkademik();

echo "\n3. DATA MAHASISWA PRESTASI\n";
echo "==========================\n";
$prestasi1->tampilkanSpesifikasiAkademik();
$prestasi2->tampilkanSpesifikasiAkademik();
$prestasi3->tampilkanSpesifikasiAkademik();

// Demonstrasi polymorphism
echo "\n===== DEMONSTRASI POLYMORPHISM =====\n";
$daftar_mahasiswa = [$mandiri1, $bidikmisi1, $prestasi1];

foreach ($daftar_mahasiswa as $mahasiswa) {
    echo $mahasiswa->getNamaMahasiswa() . " (NIM: " . $mahasiswa->getNim() . ") - ";
    echo "Tagihan Semester: Rp " . number_format($mahasiswa->hitungTagihanSemester(), 0, ',', '.') . "\n";
}

// Menampilkan informasi jumlah objek
echo "\n===== INFORMASI OBJEK =====\n";
echo "Total objek Mahasiswa Mandiri   : 3\n";
echo "Total objek Mahasiswa Bidikmisi : 3\n";
echo "Total objek Mahasiswa Prestasi  : 3\n";
echo "Total keseluruhan objek         : 9\n";
?>