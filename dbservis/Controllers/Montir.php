<?php
require_once __DIR__ . '/../Config/DB.php';

class Montir
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua data montir
    public function index()
    {
        $stmt = $this->pdo->query("SELECT montir.*, kategori_montir.nama AS nama_kategori 
            FROM montir 
            JOIN kategori_montir ON montir.kategori_montir_id = kategori_montir.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menampilkan satu data montir berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT montir.*, kategori_montir.nama AS nama_kategori 
            FROM montir 
            JOIN kategori_montir ON montir.kategori_montir_id = kategori_montir.id 
            WHERE montir.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambahkan data montir
    public function create($nomor, $nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id)
    {
        // Jika nomor tidak diberikan, buat nomor otomatis
        if ($nomor === null) {
            $stmt = $this->pdo->query("SELECT MAX(id) AS max_id FROM montir");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $nextId = $result['max_id'] + 1;
            $nomor = 'M' . str_pad($nextId, 3, '0', STR_PAD_LEFT); // Format: M001, M002, dst.
        }

        $stmt = $this->pdo->prepare("INSERT INTO montir (nomor, nama, gender, tgl_lahir, tmp_lahir, keahlian, kategori_montir_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nomor, $nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id]);
    }

    // Memperbarui data montir
    public function update($id, $nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id)
    {
        $stmt = $this->pdo->prepare("UPDATE montir 
            SET nama = ?, gender = ?, tgl_lahir = ?, tmp_lahir = ?, keahlian = ?, kategori_montir_id = ? 
            WHERE id = ?");
        return $stmt->execute([$nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id, $id]);
    }

    // Menghapus data montir berdasarkan ID
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM montir WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$montir = new Montir($pdo);
?>