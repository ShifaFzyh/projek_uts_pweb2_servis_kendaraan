<div class="container">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periksa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <select name="nama_pasien" id="nama_pasien" class="form-select" required>
                                <option value="" hidden>-- Pilih Pasien --</option>
                            <?php
                                require ('Controllers/Pasien.php');
                                $pasiens = $pasien->index();
                                foreach ($pasiens as $p) {
                                    echo '<option value="' . htmlspecialchars($p['id']) . '">' . htmlspecialchars($p['nama']) . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_paramedik" class="form-label">Nama Paramedik</label>
                            <select name="nama_paramedik" id="nama_paramedik" class="form-select" required>
                                <option value="" hidden>-- Pilih Paramedik --</option>
                            <?php
                                require ('Controllers/Paramedik.php');
                                $paramediks = $paramedik->index();
                                foreach ($paramediks as $p) {
                                    echo '<option value="' . htmlspecialchars($p['id']) . '">' . htmlspecialchars($p['nama']) . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="col">
                                <label for="berat" class="form-label">Berat Badan</label>
                                <input type="text" class="form-control" id="berat" name="berat" required>
                            </div>
                            <div class="col">
                                <label for="tinggi" class="form-label">Tinggi Badan</label>
                                <input type="text" class="form-control" id="tinggi" name="tinggi" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="sistolik" class="form-label">Sistolik</label>
                                <input type="text" class="form-control" id="sistolik" name="sistolik" required>
                            </div>
                            <div class="col">
                                <label for="diastolik" class="form-label">Diastolik</label>
                                <input type="text" class="form-control" id="diastolik" name="diastolik" required>
                            </div>
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
                Tambah Data Periksa
            </button>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th class="pe-1" style="width: 50px;">No</th>
                        <th class="pe-1">Tanggal</th>
                        <th class="pe-1">Pasien</th>
                        <th class="pe-1">Paramedik</th>
                        <th class="pe-1">Keterangan</th>
                        <th class="pe-1" colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require ('Controllers/Periksa.php');
                    $row = $periksa->index();
                    $nomer=1;
                    foreach($row as $item){
                    ?>
                        <tr>
                            <td class="text-center"><?= $nomer++ ?></td>
                            <td><?= htmlspecialchars($item['tanggal']); ?></td>
                            <td><?= htmlspecialchars($item['nama_pasien']); ?></td>
                            <td><?= htmlspecialchars($item['nama_paramedik']); ?></td>
                            <td><?= htmlspecialchars($item['keterangan']); ?></td>
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
                                        <h5 class="modal-title" id="modalInfo<?= $item['id'] ?>Label">Detail Periksa: <?= htmlspecialchars($item['nama_pasien']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Tanggal:</strong> <span class="float-end"><?= htmlspecialchars($item['tanggal']); ?></span></li>
                                            <li class="list-group-item"><strong>Pasien:</strong> <span class="float-end"><?= htmlspecialchars($item['nama_pasien']); ?></span></li>
                                            <li class="list-group-item"><strong>Paramedik:</strong> <span class="float-end"><?= htmlspecialchars($item['nama_paramedik']); ?></span></li>
                                            <li class="list-group-item"><strong>Keterangan:</strong> <span class="float-end"><?= htmlspecialchars($item['keterangan']); ?></span></li>
                                            <li class="list-group-item"><strong>Berat Badan:</strong> <span class="float-end"><?= htmlspecialchars($item['berat']); ?></span></li>
                                            <li class="list-group-item"><strong>Tinggi Badan:</strong> <span class="float-end"><?= htmlspecialchars($item['tinggi']); ?></span></li>
                                            <li class="list-group-item"><strong>Tensi:</strong> <span class="float-end"><?= htmlspecialchars($item['tensi']); ?></span></li>
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
                                            <h5 class="modal-title" id="modalEdit<?= $item['id'] ?>Label">Edit Data Periksa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($item['tanggal']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                                <select name="nama_pasien" id="nama_pasien" class="form-select" required>
                                                    <?php
                                                    $pasiens = $pasien->index();
                                                    foreach ($pasiens as $p) {
                                                        echo '<option value="' . htmlspecialchars($p['id']) . '"' . ($item['pasien_id'] == $p['id'] ? ' selected' : '') . '>' . htmlspecialchars($p['nama']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_paramedik" class="form-label">Nama Paramedik</label>
                                                <select name="nama_paramedik" id="nama_paramedik" class="form-select" required>
                                                    <?php
                                                    $paramediks = $paramedik->index();
                                                    foreach ($paramediks as $p) {
                                                        echo '<option value="' . htmlspecialchars($p['id']) . '"' . ($item['paramedik_id'] == $p['id'] ? ' selected' : '') . '>' . htmlspecialchars($p['nama']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea class="form-control" name="keterangan" required><?= htmlspecialchars($item['keterangan']) ?></textarea>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label for="berat" class="form-label">Berat Badan</label>
                                                    <input type="text" class="form-control" name="berat" value="<?= htmlspecialchars($item['berat']) ?>" required>
                                                </div>
                                                <div class="col">
                                                    <label for="tinggi" class="form-label">Tinggi Badan</label>
                                                    <input type="text" class="form-control" name="tinggi" value="<?= htmlspecialchars($item['tinggi']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label for="sistolik" class="form-label">Sistolik</label>
                                                    <input type="text" class="form-control" name="sistolik" value="<?= explode('/', htmlspecialchars($item['tensi']))[0] ?>" required>
                                                </div>
                                                <div class="col">
                                                    <label for="diastolik" class="form-label">Diastolik</label>
                                                    <input type="text" class="form-control" name="diastolik" value="<?= explode('/', htmlspecialchars($item['tensi']))[1] ?>" required>
                                                </div>
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
                                        Yakin ingin menghapus data periksa untuk <strong><?= htmlspecialchars($item['nama_pasien']); ?></strong>?
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
                            $periksa->delete($_POST['id']);
                            echo "<script>alert('Data berhasil dihapus.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        } elseif($_POST['type'] == 'add'){
                            $_POST['tensi'] = $_POST['sistolik'] . '/' . $_POST['diastolik'];
                            $periksa->create($_POST['nama_pasien'], $_POST['nama_paramedik'], $_POST['berat'], $_POST['tinggi'], $_POST['tensi'], $_POST['tanggal'], $_POST['keterangan']);
                            echo "<script>alert('Data berhasil ditambahkan.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        } elseif ($_POST['type'] == 'update') {
                            $id = $_POST['id'];
                            $data = [
                                'tanggal' => $_POST['tanggal'],
                                'pasien_id' => $_POST['nama_pasien'],
                                'berat' => $_POST['berat'],
                                'tinggi' => $_POST['tinggi'],
                                'tensi' => $_POST['sistolik'] . '/' . $_POST['diastolik'],
                                'tanggal' => $_POST['tanggal'],
                                'paramedik_id' => $_POST['nama_paramedik'],
                                'keterangan' => $_POST['keterangan']
                            ];
                            $periksa->update($id, $data);
                            echo "<script>alert('Data berhasil diperbarui.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
