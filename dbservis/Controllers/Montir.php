<?php
require_once 'Config/DB.php';

class Montir
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua montir beserta nama kategori montir
    public function index()
    {
        $stmt = $this->pdo->query("SELECT montir.*, kategori_montir.nama AS nama_kategori 
            FROM montir 
            JOIN kategori_montir ON montir.kategori_montir_id = kategori_montir.id");
        return $stmt;
    }

    // Menampilkan satu montir berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT montir.*, kategori_montir.nama AS nama_kategori 
            FROM montir 
            JOIN kategori_montir ON montir.kategori_montir_id = kategori_montir.id 
            WHERE montir.id = ?");
        $stmt->execute([$id]);
        return $stmt;
    }

    // Menambahkan data montir
    public function create($nama, $telp, $kategori_montir_id)
    {
        if (empty($nama) || empty($telp) || empty($kategori_montir_id)) {
            throw new InvalidArgumentException("Semua field harus diisi.");
        }

        $stmt = $this->pdo->prepare("INSERT INTO montir (nama, telp, kategori_montir_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $telp, $kategori_montir_id]);
    }

    // Memperbarui data montir
    public function update($id, $data)
    {
        if (!is_array($data)) {
            throw new TypeError("Data harus dalam bentuk array.");
        }

        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;

        $sql = "UPDATE montir SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    // Menghapus montir berdasarkan ID
    public function delete($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("ID harus berupa angka.");
        }

        $stmt = $this->pdo->prepare("DELETE FROM montir WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$montir = new Montir($pdo);
?>
