<?php
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
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Montir</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="spesialisasi" class="form-label">Spesialisasi</label>
                            <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_montir_id" class="form-label">Kategori Montir</label>
                            <select class="form-select" name="kategori_montir_id" id="kategori_montir_id">
                                <option value="" hidden>--Pilih Kategori--</option>
                                <?php
                                require_once 'Controllers/KategoriMontir.php';
                                $kategori = $kategori_montir->index();
                                foreach ($kategori as $item) : ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="type" value="add">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
