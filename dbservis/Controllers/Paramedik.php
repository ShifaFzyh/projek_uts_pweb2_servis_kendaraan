<?php
require_once 'Config/DB.php';

class Paramedik
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT paramedik.*, unit_kerja.nama AS unit_kerja
                FROM paramedik
                JOIN unit_kerja ON paramedik.unit_kerja_id = unit_kerja.id");
        return $stmt;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT paramedik.*, unit_kerja.nama AS unit_kerja
                FROM paramedik
                JOIN unit_kerja ON paramedik.unit_kerja_id = unit_kerja.id
                WHERE paramedik.id = $id");
        return $stmt;
    }

    public function create($nama, $tmp_lahir, $tgl_lahir, $gender, $telepon, $alamat, $unit_kerja_id)
    {
        if ($unit_kerja_id == 1) {
            $kategori = 'Dokter Gigi';
        } elseif ($unit_kerja_id == 2) {
            $kategori = 'Dokter Umum';
        } elseif ($unit_kerja_id == 3) {
            $kategori = 'Dokter Ibu & Anak';
        }
        $stmt = $this->pdo->prepare("INSERT INTO paramedik (nama, tmp_lahir, tgl_lahir, gender, kategori, telepon, alamat, unit_kerja_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $tmp_lahir, $tgl_lahir, $gender, $kategori, $telepon, $alamat, $unit_kerja_id]);
    }

    public function update($id, $data)
    {
        if ($data['unit_kerja_id'] == 1) {
            $data['kategori'] = 'Dokter Gigi';
        } elseif ($data['unit_kerja_id'] == 2) {
            $data['kategori'] = 'Dokter Umum';
        } elseif ($data['unit_kerja_id'] == 3) {
            $data['kategori'] = 'Dokter Ibu & Anak';
        }
        $stmt = $this->pdo->prepare("UPDATE paramedik SET nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, kategori=?, telepon=?, alamat=?, unit_kerja_id=? WHERE id=?");
        return $stmt->execute([$data['nama'],$data['tmp_lahir'],$data['tgl_lahir'],$data['gender'],$data['kategori'],$data['telepon'],$data['alamat'],$data['unit_kerja_id'],$id]);
    }

    public function delete($id)
    {
        // Validasi input
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("ID harus berupa angka.");
        }

        try {
            $stmt = $this->pdo->prepare("DELETE FROM paramedik WHERE id = ?");
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

$paramedik = new Paramedik($pdo);
?>
