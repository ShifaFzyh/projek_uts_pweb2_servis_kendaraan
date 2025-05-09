<?php
<<<<<<< Updated upstream
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
require_once 'Controllers/Montir.php';
$data = $montir->index();
?>
<div class="container">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Montir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
=======
require_once __DIR__ . '/../Controllers/Montir.php';
require_once __DIR__ . '/../Controllers/KategoriMontir.php';

// Ambil data montir dan kategori montir
$dataMontir = $montir->index();
$dataKategori = $kategori_montir->index();

include_once(__DIR__ . '/../Layouts/navbar.php'); ?>

<link rel="stylesheet" href="../assets/adminlte/css/adminlte.min.css">
<script src="../assets/adminlte/js/adminlte.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Montir</h1>
>>>>>>> 40c4eabdec7d5d645f404c5b5b48bd85b22d6eec
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="?url=home">Home</a></li>
                        <li class="breadcrumb-item active">Montir</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Tanggal Lahir</th>
                                <th>Tempat Lahir</th>
                                <th>Keahlian</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($dataMontir as $item) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($item['nama']); ?></td>
                                    <td><?= htmlspecialchars($item['gender']); ?></td>
                                    <td><?= htmlspecialchars($item['tgl_lahir']); ?></td>
                                    <td><?= htmlspecialchars($item['tmp_lahir']); ?></td>
                                    <td><?= htmlspecialchars($item['keahlian']); ?></td>
                                    <td><?= htmlspecialchars($item['nama_kategori']); ?></td>
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
                                <div class="modal fade" id="modalEdit<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $item['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="post" action="/projek_uts_pweb2_servis_kendaraan/dbservis/views/montir_input.php">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditLabel<?= $item['id']; ?>">Edit Data Montir</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                                    <input type="hidden" name="type" value="update">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Montir</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($item['nama']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-select" name="gender" id="gender" required>
                                                            <option value="Laki-laki" <?= $item['gender'] === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                                            <option value="Perempuan" <?= $item['gender'] === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= htmlspecialchars($item['tgl_lahir']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?= htmlspecialchars($item['tmp_lahir']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="keahlian" class="form-label">Keahlian</label>
                                                        <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required><?= htmlspecialchars($item['keahlian']); ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kategori_montir_id" class="form-label">Kategori Montir</label>
                                                        <select class="form-select" name="kategori_montir_id" id="kategori_montir_id" required>
                                                            <option value="" hidden>--Pilih Kategori--</option>
                                                            <?php foreach ($dataKategori as $kategori) : ?>
                                                                <option value="<?= $kategori['id']; ?>" <?= $kategori['id'] == $item['kategori_montir_id'] ? 'selected' : ''; ?>>
                                                                    <?= htmlspecialchars($kategori['nama']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                                                <form method="post" action="/projek_uts_pweb2_servis_kendaraan/dbservis/views/montir_input.php">
                                                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                                    <input type="hidden" name="type" value="delete">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
            <form method="post" action="/projek_uts_pweb2_servis_kendaraan/dbservis/views/montir_input.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Montir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="add">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Montir</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option value="" hidden>--Pilih Gender--</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_montir_id" class="form-label">Kategori Montir</label>
                        <select class="form-select" name="kategori_montir_id" id="kategori_montir_id" required>
                            <option value="" hidden>--Pilih Kategori--</option>
                            <?php foreach ($dataKategori as $kategori) : ?>
                                <option value="<?= $kategori['id']; ?>"><?= htmlspecialchars($kategori['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
