<div class="container">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                        <div class="mb-3">
                            <input type="radio" class="form-check-control" id="laki-laki" name="gender" value="L" required>
                            <label for="laki-laki" class="form-label">Laki-laki</label>
                            <input type="radio" class="form-check-control" id="perempuan" name="gender" value="P" required>
                            <label for="perempuan" class="form-label">Perempuan</label>
                        </div>
                        <div class="mb-3">
                            <label for="unit_kerja" class="form-label">Unit Kerja</label>
                            <select class="form-select" name="unit_kerja" id="unit_kerja">
                                <option value="" hidden>--Pilih Unit Kerja--</option>
                                <?php
                                require_once 'Controllers/Unitkerja.php';
                                $unit = $unitkerja->index();
                                foreach ($unit as $item) : ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <input type="hidden" name="type" value="add">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th class="pe-1" style="width: 50px;">No</th>
                        <th class="pe-1">Nama Paramedik</th>
                        <th class="pe-1">Gender</th>
                        <th class="pe-1">Tanggal Lahir</th>
                        <th class="pe-1">Telepon</th>
                        <th class="pe-1" colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require ('Controllers/Paramedik.php');
                    $row = $paramedik->index();
                    $nomer=1;
                    foreach($row as $item){
                    ?>
                        <tr>
                            <td class="text-center"><?=$nomer++ ?></td>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td><?= $item['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                            <td><?= htmlspecialchars($item['tgl_lahir']); ?></td>
                            <td><?= htmlspecialchars($item['telepon']); ?></td>
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
                                        <h5 class="modal-title" id="modalInfo<?= $item['id'] ?>Label">Detail Paramedik: <?= htmlspecialchars($item['nama']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Nama:</strong> <span class="float-end"><?= htmlspecialchars($item['nama']); ?></span></li>
                                            <li class="list-group-item"><strong>Gender:</strong> <span class="float-end"><?= $item['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></span></li>
                                            <li class="list-group-item"><strong>Kategori:</strong> <span class="float-end"><?= htmlspecialchars($item['kategori']); ?></span></li>
                                            <li class="list-group-item"><strong>Unit Kerja:</strong> <span class="float-end"><?= htmlspecialchars($item['unit_kerja']); ?></span></li>
                                            <li class="list-group-item"><strong>Tempat Lahir:</strong> <span class="float-end"><?= htmlspecialchars($item['tmp_lahir']); ?></span></li>
                                            <li class="list-group-item"><strong>Tanggal Lahir:</strong> <span class="float-end"><?= htmlspecialchars($item['tgl_lahir']); ?></span></li>
                                            <li class="list-group-item"><strong>Telepon:</strong> <span class="float-end"><?= htmlspecialchars($item['telepon']); ?></span></li>
                                            <li class="list-group-item"><strong>Alamat:</strong> <span class="float-end"><?= htmlspecialchars($item['alamat']); ?></span></li>
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
                                            <h5 class="modal-title" id="modalEdit<?= $item['id'] ?>Label">Edit Data Paramedik</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($item['nama']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" name="tmp_lahir" value="<?= htmlspecialchars($item['tmp_lahir']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tgl_lahir" value="<?= htmlspecialchars($item['tgl_lahir']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Gender</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="gender" value="L" <?= $item['gender'] === 'L' ? 'checked' : '' ?> class="form-check-input" id="genderL<?= $item['id'] ?>">
                                                    <label class="form-check-label" for="genderL<?= $item['id'] ?>">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="gender" value="P" <?= $item['gender'] === 'P' ? 'checked' : '' ?> class="form-check-input" id="genderP<?= $item['id'] ?>">
                                                    <label class="form-check-label" for="genderP<?= $item['id'] ?>">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon" class="form-label">Telepon</label>
                                                <input type="number" class="form-control" name="telepon" value="<?= htmlspecialchars($item['telepon']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($item['alamat']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                                <select class="form-select" name="unit_kerja" required>
                                                    <option hidden>--Pilih Unit Kerja--</option>
                                                    <?php
                                                    foreach ($unitkerja->index() as $unit) {
                                                        $selected = $unit['id'] == $item['unit_kerja_id'] ? 'selected' : '';
                                                        echo "<option value='{$unit['id']}' $selected>{$unit['nama']}</option>";
                                                    }
                                                    ?>
                                                </select>
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

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $item['id']; ?>">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data <strong><?= htmlspecialchars($item['nama']); ?></strong>?
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
                    if(isset($_POST['type'])){
                        if($_POST['type'] == 'delete'){
                            $paramedik->delete($_POST['id']);
                            echo "<script>alert('Data berhasil dihapus.');</script>";
                            echo "<script>window.location.href = '?url=paramedik';</script>";
                        } elseif($_POST['type'] == 'add'){
                            $paramedik->create($_POST['nama'], $_POST['tmp_lahir'], $_POST['tgl_lahir'], $_POST['gender'], $_POST['telepon'], $_POST['alamat'], $_POST['unit_kerja']);
                            echo "<script>alert('Data berhasil ditambahkan.');</script>";
                            echo "<script>window.location.href = '?url=paramedik';</script>";
                        } elseif ($_POST['type'] == 'update') {
                            $id = $_POST['id'];
                            $data = [
                                'nama' => $_POST['nama'],
                                'tmp_lahir' => $_POST['tmp_lahir'],
                                'tgl_lahir' => $_POST['tgl_lahir'],
                                'gender' => $_POST['gender'],
                                'telepon' => $_POST['telepon'],
                                'alamat' => $_POST['alamat'],
                                'unit_kerja_id' => $_POST['unit_kerja']
                            ];
                            $paramedik->update($id, $data);
                            echo "<script>alert('Data berhasil diperbarui.');</script>";
                            echo "<script>window.location.href = '?url=paramedik';</script>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
