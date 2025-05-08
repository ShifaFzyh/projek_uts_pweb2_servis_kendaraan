<!-- filepath: c:\xampp\htdocs\projek_uts_pweb2_servis_kendaraan\dbservis\views\layanan_input.php -->
<?php
session_start();
require_once __DIR__ . '/../Controllers/Layanan.php';
require_once __DIR__ . '/../Config/DB.php';


$layanan = new Layanan($pdo);

// Periksa apakah ada data yang dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap tipe operasi (add, update, delete)
    $type = $_POST['type'];

    if ($type === 'add') {
        // Tambah data layanan
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $total_biaya = $_POST['total_biaya'];
        $rating = $_POST['rating'];

        $layanan->create($kode, $nama, $deskripsi, $total_biaya, $rating);
        echo "<script>alert('Data berhasil ditambahkan.');</script>";
echo "<script>window.location.href = '../index.php?url=layanan';</script>";

    } elseif ($type === 'update') {
        // Edit data layanan
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $total_biaya = $_POST['total_biaya'];
        $rating = $_POST['rating'];

        $layanan->update($id, $kode, $nama, $deskripsi, $total_biaya, $rating);
       echo "<script>alert('Data berhasil ditambahkan.');</script>";
echo "<script>window.location.href = '../index.php?url=layanan';</script>";

    } elseif ($type === 'delete') {
        // Hapus data layanan
        $id = $_POST['id'];

        $layanan->delete($id);
        echo "<script>alert('Data berhasil dihapus.');</script>";
        echo "<script>window.location.href = '../index.php?url=layanan';</script>";

    } else {
        echo "<script>alert('Operasi tidak valid.');</script>";
        echo "<script>window.location.href = '../index.php?url=layanan';</script>";

    }
} else {
    echo "<script>alert('Akses tidak valid.');</script>";
    echo "<script>window.location.href = '../index.php?url=layanan';</script>";

}
?>