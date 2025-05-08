<?php
require_once 'Config/DB.php';

class Pasien
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT pasien.*, kelurahan.nama AS nama_kelurahan
                FROM pasien
                JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id");
        return $stmt;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT pasien.*, kelurahan.nama AS nama_kelurahan
                FROM pasien
                JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id
                WHERE pasien.id = $id");
        return $stmt;
    }

    public function create($kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $alamat, $email, $kelurahan_id)
    {
        // Validasi input
        if (empty($kode) || empty($nama) || empty($tmp_lahir) || empty($tgl_lahir) || empty($gender) || empty($alamat) || empty($email) || empty($kelurahan_id)) {
            throw new InvalidArgumentException("Semua field harus diisi.");
        }

        // Siapkan dan jalankan pernyataan SQL
        $stmt = $this->pdo->prepare("INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, alamat, email, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $alamat, $email, $kelurahan_id]);
    }

    public function update($id, $data) {
        if (!is_array($data)) {
            throw new TypeError("Expected parameter 'data' to be an array.");
        }

        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;

        $sql = "UPDATE pasien SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete($id)
    {
        // Validasi input
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("ID harus berupa angka.");
        }

        try {
            $stmt = $this->pdo->prepare("DELETE FROM pasien WHERE id = ?");
            $result = $stmt->execute([$id]);

            // Cek apakah ada baris yang terpengaruh
            if ($result && $stmt->rowCount() > 0) {
                return true; // Penghapusan berhasil
            } else {
                return false; // Tidak ada baris yang dihapus (mungkin ID tidak ada)
            }
        } catch (PDOException $e) {
            // Tangani kesalahan PDO
            // Anda bisa mencatat kesalahan atau melempar pengecualian
            throw new Exception("Terjadi kesalahan saat menghapus data: " . $e->getMessage());
        }
    }
}

$pasien = new Pasien($pdo);
?>
