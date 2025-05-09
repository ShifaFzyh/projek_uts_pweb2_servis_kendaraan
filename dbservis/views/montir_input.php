<!-- filepath: c:\xampp\htdocs\projek_uts_pweb2_servis_kendaraan\dbservis\views\montir_input.php -->
<?php
session_start();
require_once __DIR__ . '/../Controllers/Montir.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap tipe operasi (add, update, delete)
    $type = $_POST['type'];

    if ($type === 'add') {
        // Tambah data montir
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $tmp_lahir = $_POST['tmp_lahir'];
        $keahlian = $_POST['keahlian'];
        $kategori_montir_id = $_POST['kategori_montir_id'];

        // Panggil fungsi create tanpa parameter nomor
        $montir->create(null, $nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id);
        echo "<script>alert('Data montir berhasil ditambahkan.');</script>";
        echo "<script>window.location.href = '/projek_uts_pweb2_servis_kendaraan/dbservis/index.php?url=montir';</script>";

    } elseif ($type === 'update') {
        // Edit data montir
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $tmp_lahir = $_POST['tmp_lahir'];
        $keahlian = $_POST['keahlian'];
        $kategori_montir_id = $_POST['kategori_montir_id'];

        $montir->update($id, $nama, $gender, $tgl_lahir, $tmp_lahir, $keahlian, $kategori_montir_id);
        echo "<script>alert('Data montir berhasil diperbarui.');</script>";
        echo "<script>window.location.href = '/projek_uts_pweb2_servis_kendaraan/dbservis/index.php?url=montir';</script>";

    } elseif ($type === 'delete') {
        // Hapus data montir
        $id = $_POST['id'];

        $montir->delete($id);
        echo "<script>alert('Data montir berhasil dihapus.');</script>";
        echo "<script>window.location.href = '/projek_uts_pweb2_servis_kendaraan/dbservis/index.php?url=montir';</script>";

    } else {
        echo "<script>alert('Operasi tidak valid.');</script>";
        echo "<script>window.location.href = '/projek_uts_pweb2_servis_kendaraan/dbservis/index.php?url=montir';</script>";
    }
}

echo "<script>window.location.href = '/projek_uts_pweb2_servis_kendaraan/dbservis/index.php?url=montir';</script>";
?>