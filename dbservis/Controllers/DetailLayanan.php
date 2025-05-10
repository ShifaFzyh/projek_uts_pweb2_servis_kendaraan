<?php
require_once 'Config/DB.php';

class DetailLayanan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT detail_layanan.*, l.nama as layanan, m.nama as montir FROM detail_layanan LEFT JOIN layanan l ON detail_layanan.layanan_id = l.id LEFT JOIN montir m ON detail_layanan.montir_id = m.id");
        return $stmt;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT detail_layanan.*, l.nama as layanan, m.nama as montir FROM detail_layanan LEFT JOIN layanan l ON detail_layanan.layanan_id = l.id LEFT JOIN montir m ON detail_layanan.montir_id = m.id WHERE dl.id = $id");
        return $stmt;
    }

    public function create($pekerjaan, $biaya, $layanan_id, $montir_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO detail_layanan (pekerjaan, biaya, layanan_id, montir_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$pekerjaan, $biaya, $layanan_id, $montir_id]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE detail_layanan SET pekerjaan=?, biaya=?, layanan_id=?, montir_id=? WHERE id=?");
        return $stmt->execute([$data['pekerjaan'], $data['biaya'], $data['layanan_id'], $data['montir_id'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM detail_layanan WHERE id = ?");
        $result = $stmt->execute([$id]);
        return $result;
    }
}

$detailLayanan = new DetailLayanan($pdo);
