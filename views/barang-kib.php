<?php require_once("../controller/script.php");
$_SESSION["project_si_inventaris_sekolah"]["name_page"] = "Barang KIB";
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
              <th class="text-center">Nama Barang</th>
              <th class="text-center">Kondisi</th>
              <th class="text-center">Tahun Anggaran</th>
              <th class="text-center">Sumber Dana</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Stok</th>
              <th class="text-center">Ruangan</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Kategori KIB</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center">Kondisi</th>
              <th class="text-center">Tahun Anggaran</th>
              <th class="text-center">Sumber Dana</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Stok</th>
              <th class="text-center">Ruangan</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_barang_kib as $data) { ?>
              <tr>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['nama_barang_kib'] ?></td>
                <td><?= $data['kondisi_barang'] ?></td>
                <td><?= $data['thn_anggaran'] ?></td>
                <td><?= $data['sumber_dana'] ?></td>
                <td>Rp.<?= number_format($data['harga']) ?></td>
                <td><?= $data['stok_barang'] ?></td>
                <td><?= $data['ruangan'] ?></td>
                <td><?php $created_at = date_create($data["created_at"]);
                    echo date_format($created_at, "l, d M Y"); ?></td>
                <td><?php $updated_at = date_create($data["updated_at"]);
                    echo date_format($updated_at, "l, d M Y"); ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_barang_kib'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_barang_kib'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_barang_kib'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_barang_kategori">Kategori KIB <small class="text-warning">*</small></label>
                              <select name="id_barang_kategori" class="form-control" id="id_barang_kategori" required>
                                <option value="" selected>Pilih Kategori</option>
                                <?php $id_barang_kategori = $data['id_barang_kategori'];
                                foreach ($views_barang_kategori as $data_bk) {
                                  $selected = ($data_bk['id_barang_kategori'] == $id_barang_kategori) ? 'selected' : ''; ?>
                                  <option value="<?= $data_bk['id_barang_kategori'] ?>" <?= $selected ?>><?= $data_bk['nama_kategori'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="nama_barang_kib">Nama Barang KIB <small class="text-warning">*</small></label>
                              <input type="text" name="nama_barang_kib" value="<?= $data['nama_barang_kib'] ?>" class="form-control" id="nama_barang_kib" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="kondisi_barang">Kondisi Barang <small class="text-warning">*</small></label>
                              <input type="text" name="kondisi_barang" value="<?= $data['kondisi_barang'] ?>" class="form-control" id="kondisi_barang" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="thn_anggaran">Tahun Anggaran <small class="text-warning">*</small></label>
                              <select name="thn_anggaran" class="form-control" id="thn_anggaran" required>
                                <?php $thn_anggaran = $data['thn_anggaran'];
                                $start_year = 2000;
                                $end_year = date("Y");
                                for ($year = $end_year; $year >= $start_year; $year--) {
                                  $selected = ($year == $thn_anggaran) ? 'selected' : '';
                                  echo "<option value=" . $year . " " . $selected . ">$year</option>";
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="sumber_dana">Sumber Dana <small class="text-warning">*</small></label>
                              <input type="text" name="sumber_dana" value="<?= $data['sumber_dana'] ?>" class="form-control" id="sumber_dana" required>
                            </div>
                            <div class="form-group">
                              <label for="harga">Harga <small class="text-warning">*</small></label>
                              <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" id="harga" required>
                            </div>
                            <div class="form-group">
                              <label for="stok_barang">Stok Barang <small class="text-warning">*</small></label>
                              <input type="number" name="stok_barang" value="<?= $data['stok_barang'] ?>" class="form-control" id="stok_barang" required>
                            </div>
                            <div class="form-group">
                              <label for="ruangan">Ruangan <small class="text-warning">*</small></label>
                              <input type="text" name="ruangan" value="<?= $data['ruangan'] ?>" class="form-control" id="ruangan" required>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_barang_kib" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_barang_kib'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_barang_kib'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_barang_kib'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['nama_barang_kib'] ?>, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_barang_kib" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Kategori KIB</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_barang_kategori">Kategori KIB <small class="text-warning">*</small></label>
              <select name="id_barang_kategori" class="form-control" id="id_barang_kategori" required>
                <option value="" selected>Pilih Kategori</option>
                <?php foreach ($views_barang_kategori as $data_bk) { ?>
                  <option value="<?= $data_bk['id_barang_kategori'] ?>"><?= $data_bk['nama_kategori'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_barang_kib">Nama Barang KIB <small class="text-warning">*</small></label>
              <input type="text" name="nama_barang_kib" class="form-control" id="nama_barang_kib" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="kondisi_barang">Kondisi Barang <small class="text-warning">*</small></label>
              <input type="text" name="kondisi_barang" class="form-control" id="kondisi_barang" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="thn_anggaran">Tahun Anggaran <small class="text-warning">*</small></label>
              <select name="thn_anggaran" class="form-control" id="thn_anggaran" required>
                <?php
                $start_year = 2000;
                $end_year = date("Y");
                for ($year = $end_year; $year >= $start_year; $year--) {
                  echo "<option value=\"$year\">$year</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="sumber_dana">Sumber Dana <small class="text-warning">*</small></label>
              <input type="text" name="sumber_dana" class="form-control" id="sumber_dana" required>
            </div>
            <div class="form-group">
              <label for="harga">Harga <small class="text-warning">*</small></label>
              <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="form-group">
              <label for="stok_barang">Stok Barang <small class="text-warning">*</small></label>
              <input type="number" name="stok_barang" class="form-control" id="stok_barang" required>
            </div>
            <div class="form-group">
              <label for="ruangan">Ruangan <small class="text-warning">*</small></label>
              <input type="text" name="ruangan" class="form-control" id="ruangan" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_barang_kib" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>