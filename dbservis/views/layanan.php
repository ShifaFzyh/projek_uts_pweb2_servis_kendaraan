<?php
include_once(__DIR__ . '/../Layouts/navbar.php'); ?>

<link rel="stylesheet" href="../assets/adminlte/css/adminlte.min.css">
<script src="../assets/adminlte/js/adminlte.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Layanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="?url=home">Home</a></li>
                        <li class="breadcrumb-item active">Layanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Total Biaya</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once 'Controllers/Layanan.php';
                            $layanan = new Layanan($pdo);
                            $rows = $layanan->index();
                            $nomer = 1;
                            foreach ($rows as $item) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $nomer++ ?></td>
                                    <td><?= htmlspecialchars($item['kode']); ?></td>
                                    <td><?= htmlspecialchars($item['nama']); ?></td>
                                    <td><?= htmlspecialchars($item['deskripsi']); ?></td>
                                    <td><?= htmlspecialchars($item['total_biaya']); ?></td>
                                    <td><?= htmlspecialchars($item['rating']); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id']; ?>">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $item['id']; ?>">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalEdit<?= $item['id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="post" action="views/layanan_input.php">
                                                <input type="hidden" name="type" value="update">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEdit<?= $item['id'] ?>Label">Edit Data Layanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode</label>
                                                        <input type="text" class="form-control" name="kode" value="<?= htmlspecialchars($item['kode']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Layanan</label>
                                                        <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($item['nama']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" rows="3" required><?= htmlspecialchars($item['deskripsi']) ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total_biaya" class="form-label">Total Biaya</label>
                                                        <input type="number" class="form-control" name="total_biaya" value="<?= htmlspecialchars($item['total_biaya']) ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="rating" class="form-label">Rating</label>
                                                        <input type="number" class="form-control" name="rating" value="<?= htmlspecialchars($item['rating']) ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalHapus<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalHapusLabel<?= $item['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="modalHapusLabel<?= $item['id']; ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus data <strong><?= htmlspecialchars($item['nama']); ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="views/layanan_input.php">
                                                    <input type="hidden" name="type" value="delete">
                                                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            if (isset($_POST['type'])) {
                                if ($_POST['type'] == 'delete') {
                                    $layanan->delete($_POST['id']);
                                    echo "<script>alert('Data berhasil dihapus.');</script>";
                                    echo "<script>window.location.href = '?url=layanan';</script>";
                                } elseif ($_POST['type'] == 'add') {
                                    $layanan->create($_POST['kode'], $_POST['nama'], $_POST['deskripsi'], $_POST['total_biaya'], $_POST['rating']);
                                    echo "<script>alert('Data berhasil ditambahkan.');</script>";
                                    echo "<script>window.location.href = '?url=layanan';</script>";
                                } elseif ($_POST['type'] == 'update') {
                                    $layanan->update($_POST['id'], $_POST['kode'], $_POST['nama'], $_POST['deskripsi'], $_POST['total_biaya'], $_POST['rating']);
                                    echo "<script>alert('Data berhasil diperbarui.');</script>";
                                    echo "<script>window.location.href = '?url=layanan';</script>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="views/layanan_input.php">
                    <input type="hidden" name="type" value="add">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="total_biaya" class="form-label">Total Biaya</label>
                        <input type="number" class="form-control" id="total_biaya" name="total_biaya" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" class="form-control" id="rating" name="rating">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>