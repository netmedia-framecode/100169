<?php require_once("../controller/script.php");
$_SESSION["project_si_inventaris_sekolah"]["name_page"] = "Barang Masuk";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_si_inventaris_sekolah"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Kategori KIB</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Kategori KIB</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_barang_masuk as $data) { ?>
              <tr>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['nama_barang_masuk'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td>Rp.<?= number_format($data['harga']) ?></td>
                <td><?php $created_at = date_create($data["created_at"]);
                    echo date_format($created_at, "l, d M Y"); ?></td>
                <td><?php $updated_at = date_create($data["updated_at"]);
                    echo date_format($updated_at, "l, d M Y"); ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_barang_masuk'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_barang_masuk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_barang_masuk'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_masuk" value="<?= $data['id_barang_masuk'] ?>">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <input type="hidden" name="jumlahOld" value="<?= $data['jumlah'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_barang_kib">Barang KIB <small class="text-warning">*</small></label>
                              <select class="form-control" id="id_barang_kib" disabled required>
                                <?php $id_barang_kib = $data['id_barang_kib'];
                                foreach ($views_barang_kib as $data_bk) {
                                  $selected = ($data_bk['id_barang_kib'] == $id_barang_kib) ? 'selected' : ''; ?>
                                  <option value="<?= $data_bk['id_barang_kib'] ?>" <?= $selected ?>><?= $data_bk['nama_kategori'] . " - " . $data_bk['nama_barang_kib'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="nama_barang_masuk">Nama Barang Masuk <small class="text-warning">*</small></label>
                              <input type="text" name="nama_barang_masuk" value="<?= $data['nama_barang_masuk'] ?>" class="form-control" id="nama_barang_masuk" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea name="keterangan" class="form-control" id="deskripsi<?= $data['id_barang_masuk'] ?>" rows="3"><?= $data['keterangan'] ?></textarea>
                              <script>
                                CKEDITOR.replace('deskripsi<?= $data['id_barang_masuk'] ?>');
                              </script>
                            </div>
                            <div class="form-group">
                              <label for="jumlah">Jumlah <small class="text-warning">*</small></label>
                              <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" id="jumlah" required>
                            </div>
                            <div class="form-group">
                              <label for="harga">Harga <small class="text-warning">*</small></label>
                              <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" id="harga" required>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_barang_masuk" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_barang_masuk'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_barang_masuk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_barang_masuk'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_masuk" value="<?= $data['id_barang_masuk'] ?>">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <input type="hidden" name="jumlah" value="<?= $data['jumlah'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['nama_barang_masuk'] ?>, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_barang_masuk" class="btn btn-danger btn-sm">hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Barang Masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_barang_kib">Barang KIB <small class="text-warning">*</small></label>
              <select name="id_barang_kib" class="form-control" id="id_barang_kib" required>
                <option value="" selected>Pilih Barang</option>
                <?php foreach ($views_barang_kib as $data_bk) { ?>
                  <option value="<?= $data_bk['id_barang_kib'] ?>"><?= $data_bk['nama_kategori'] . " - " . $data_bk['nama_barang_kib'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" class="form-control" id="deskripsi" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah <small class="text-warning">*</small></label>
              <input type="number" name="jumlah" class="form-control" id="jumlah" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_barang_masuk" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>