<?php
require_once __DIR__ . '/../Config/DB.php';


class Layanan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        // Ambil semua data dari tabel layanan
        $stmt = $this->pdo->query("SELECT * FROM layanan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        // Ambil data layanan berdasarkan ID
        $stmt = $this->pdo->prepare("SELECT * FROM layanan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($kode, $nama, $deskripsi, $total_biaya, $rating)
    {
        $stmt = $this->pdo->prepare("INSERT INTO layanan (kode, nama, deskripsi, total_biaya, rating) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$kode, $nama, $deskripsi, $total_biaya, $rating]);
    }

    public function update($id, $kode, $nama, $deskripsi, $total_biaya, $rating)
    {
        $stmt = $this->pdo->prepare("UPDATE layanan SET kode = ?, nama = ?, deskripsi = ?, total_biaya = ?, rating = ? WHERE id = ?");
        return $stmt->execute([$kode, $nama, $deskripsi, $total_biaya, $rating, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM layanan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$layanan = new Layanan($pdo);
?>