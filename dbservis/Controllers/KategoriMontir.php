<!-- filepath: c:\xampp\htdocs\projek_uts_pweb2_servis_kendaraan\dbservis\Controllers\KategoriMontir.php -->
<?php
require_once __DIR__ . '/../Config/DB.php';

class KategoriMontir
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua kategori montir
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM kategori_montir");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menampilkan satu kategori montir berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM kategori_montir WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$kategori_montir = new KategoriMontir($pdo);
?>