<?php
require_once 'Controllers/Layanan.php';
require_once 'Controllers/Montir.php';
require_once 'Controllers/DetailLayanan.php';

if(isset($_POST['type'])) {
    $type = $_POST['type'];
    $detailLayanan = new DetailLayanan($pdo);
    if ($type == 'add') {
        $pekerjaan = $_POST['pekerjaan'];
        $biaya = $_POST['biaya'];
        $layanan_id = $_POST['layanan_id'];
        $pj_montir_id = $_POST['pj_montir_id'];

        if ($detailLayanan->create($pekerjaan, $biaya, $layanan_id, $pj_montir_id)) {
            echo "<script>alert('Data berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data!');</script>";
        }
    } elseif ($type == 'update') {
        $id = $_POST['id'];
        $pekerjaan = $_POST['pekerjaan'];
        $biaya = $_POST['biaya'];
        $layanan_id = $_POST['layanan_id'];
        $pj_montir_id = $_POST['pj_montir_id'];

        if ($detailLayanan->update($id, ['pekerjaan' => $pekerjaan, 'biaya' => $biaya, 'layanan_id' => $layanan_id, 'pj_montir_id' => $pj_montir_id])) {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data!');</script>";
        }
    } elseif ($type == 'delete') {
        $id = $_POST['id'];

        if ($detailLayanan->delete($id)) {
            echo "<script>alert('Data berhasil dihapus!');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!');</script>";
        }
    }
}

?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="type" value="add">
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="number" class="form-control" id="biaya" name="biaya" required>
                    </div>
                    <div class="mb-3">
                        <label for="layanan_id" class="form-label">Layanan</label>
                        <select name="layanan_id" id="layanan_id" class="form-select" required>
                            <option value="" hidden>-- Pilih Layanan --</option>
                            <?php
                            $no = 1;
                            foreach ($layanan->index() as $item):
                            ?>
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pj_montir_id" class="form-label">PJ Montir</label>
                        <select name="pj_montir_id" id="pj_montir_id" class="form-select" required>
                            <option value="" hidden>-- Pilih Montir --</option>
                            <?php
                            $no = 1;
                            foreach ($montir->index() as $item):
                            ?>
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-3">
                    </div>
                    <input type="hidden" name="type" value="add">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data Pelayanan
            </button>

            <table id="example1" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th class="pe-1" style="width: 50px;">ID</th>
                        <th class="pe-1">Pekerjaan</th>
                        <th class="pe-1">Biaya</th>
                        <th class="pe-1">Layanan</th>
                        <th class="pe-1">PJ Montir</th>
                        <th class="pe-1" colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomer = 1;
                    foreach ($detailLayanan->index() as $item) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $nomer++ ?></td>
                            <td><?= htmlspecialchars($item['pekerjaan']); ?></td>
                            <td><?= htmlspecialchars($item['biaya']); ?></td>
                            <td><?= htmlspecialchars($item['layanan']); ?></td>
                            <td><?= htmlspecialchars($item['montir']); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalInfo<?= $item['id']; ?>">
                                    Info
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id']; ?>">
                                    Edit
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $item['id']; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Info -->
                        <div class="modal fade" id="modalInfo<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalInfo<?= $item['id'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalInfo<?= $item['id'] ?>Label">Detail Service: <?= htmlspecialchars($item['pekerjaan']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Pekerjaan:</strong> <span class="float-end"><?= htmlspecialchars($item['pekerjaan']); ?></span></li>
                                            <li class="list-group-item"><strong>Biaya:</strong> <span class="float-end"><?= htmlspecialchars($item['biaya']); ?></span></li>
                                            <li class="list-group-item"><strong>Layanan:</strong> <span class="float-end"><?= htmlspecialchars($item['layanan']); ?></span></li>
                                            <li class="list-group-item"><strong>PJ Montir:</strong> <span class="float-end"><?= htmlspecialchars($item['montir']); ?></span></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalEdit<?= $item['id'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEdit<?= $item['id'] ?>Label">Edit Data Pelayanan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                                            <div class="mb-3">
                                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control" name="pekerjaan" value="<?= htmlspecialchars($item['pekerjaan']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="biaya" class="form-label">Biaya</label>
                                                <input type="number" class="form-control" name="biaya" value="<?= htmlspecialchars($item['biaya']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="layanan_id" class="form-label">Layanan</label>
                                                <select name="layanan_id" id="layanan_id" class="form-select" required>
                                                    <?php 
                                                    foreach($layanan->index() as $layananItem):  
                                                    ?>
                                                    <option value="<?= htmlspecialchars($layananItem['id']) ?>" <?= ($item['layanan_id'] == $layananItem['id']) ? 'selected' : '' ?>><?= htmlspecialchars($layananItem['nama']) ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pj_montir_id" class="form-label">PJ Montir</label>
                                                <select name="pj_montir_id" id="pj_montir_id" class="form-select" required>
                                                    <?php 
                                                    foreach($montir->index() as $montirItem):  
                                                    ?>
                                                    <option value="<?= htmlspecialchars($montirItem['id']) ?>" <?= ($item['pj_montir_id'] == $montirItem['id']) ? 'selected' : '' ?>><?= htmlspecialchars($montirItem['nama']) ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $item['id']; ?>">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data untuk <strong><?= htmlspecialchars($item['pekerjaan']); ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                            <input type="hidden" name="type" value="delete">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>