<?php require_once("../controller/script.php");
$_SESSION["project_si_inventaris_sekolah"]["name_page"] = "Barang KIB";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_si_inventaris_sekolah"]["name_page"] ?></h1>
    <div class="col text-right">
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#import"><i class="bi bi-file-earmark-arrow-down"></i> Import</a>
      <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header border-bottom-0 shadow">
              <h5 class="modal-title" id="exampleModalLabel">Import Barang KIB</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-body text-left">
                <div class="mb-3">
                  <label for="file_kib" class="form-label">File KIB</label>
                  <input name="file_kib" class="form-control" type="file" id="file_kib" accept=".xls, .xlsx">
                  <small class="text-danger">Hanya file excel yang diperbolehkan!</small>
                </div>
              </div>
              <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" name="import_barang_kib" class="btn btn-success btn-sm">Import</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#export"><i class="bi bi-download"></i> Export</a>
      <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header border-bottom-0 shadow">
              <h5 class="modal-title" id="exampleModalLabel">Export Barang KIB</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-body text-left">
                <div class="mb-3">
                  <label for="id_barang_kategori" class="form-label">Kategori</label>
                  <select name="id_barang_kategori" class="form-control" id="id_barang_kategori" required>
                    <option value="" selected>Pilih Kategori</option>
                    <?php foreach ($views_barang_kategori as $data_kategori_barang) { ?>
                      <option value="<?= $data_kategori_barang['id_barang_kategori'] ?>"><?= $data_kategori_barang['nama_kategori'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" name="export_barang_kib" class="btn btn-success btn-sm">Export</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- <a href="export-barang-kib" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="bi bi-download"></i> Export</a> -->
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" colspan="3">Nomor</th>
              <th class="text-center" colspan="3">Spesifikasi Barang</th>
              <th class="text-center" rowspan="2">Kategori</th>
              <th class="text-center" rowspan="2">Bahan</th>
              <th class="text-center" rowspan="2">Asal/Cara Perolehan Barang</th>
              <th class="text-center" rowspan="2">Tahun Perolehan</th>
              <th class="text-center" rowspan="2">Ukuran (P,SP,D)</th>
              <th class="text-center" rowspan="2">Satuan</th>
              <th class="text-center" rowspan="2">Keadaan Barang (B/KB/RB)</th>
              <th class="text-center" colspan="2">Jumlah</th>
              <th class="text-center" rowspan="2">Keterangan</th>
              <th class="text-center" rowspan="2">Tgl buat</th>
              <th class="text-center" rowspan="2">Tgl edit</th>
              <th class="text-center" rowspan="2">Aksi</th>
            </tr>
            <tr>
              <th class="text-center">No Urut</th>
              <th class="text-center">Kode Barang</th>
              <th class="text-center">Register</th>
              <th class="text-center">Nama/Jenis Barang</th>
              <th class="text-center">Merek/Type</th>
              <th class="text-center">No. Sertifikat/No. Pabrik/No. Chasis/No. Mesin</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Harga</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center" colspan="3">Nomor</th>
              <th class="text-center" colspan="3">Spesifikasi Barang</th>
              <th class="text-center" rowspan="2">Kategori</th>
              <th class="text-center" rowspan="2">Bahan</th>
              <th class="text-center" rowspan="2">Asal/Cara Perolehan Barang</th>
              <th class="text-center" rowspan="2">Tahun Perolehan</th>
              <th class="text-center" rowspan="2">Ukuran (P,SP,D)</th>
              <th class="text-center" rowspan="2">Satuan</th>
              <th class="text-center" rowspan="2">Keadaan Barang (B/KB/RB)</th>
              <th class="text-center" colspan="2">Jumlah</th>
              <th class="text-center" rowspan="2">Keterangan</th>
              <th class="text-center" rowspan="2">Tgl buat</th>
              <th class="text-center" rowspan="2">Tgl edit</th>
              <th class="text-center" rowspan="2">Aksi</th>
            </tr>
            <tr>
              <th class="text-center">No Urut</th>
              <th class="text-center">Kode Barang</th>
              <th class="text-center">Register</th>
              <th class="text-center">Nama/Jenis Barang</th>
              <th class="text-center">Merek/Type</th>
              <th class="text-center">No. Sertifikat/No. Pabrik/No. Chasis/No. Mesin</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Harga</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $no = 1;
            foreach ($views_barang_kib as $data) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['kode_barang'] ?></td>
                <td><?= $data['register'] ?></td>
                <td><?= $data['nama_barang_kib'] ?></td>
                <td><?= $data['merek'] ?></td>
                <td><?= $data['no_seri'] ?></td>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['bahan'] ?></td>
                <td><?= $data['asal_perolehan'] ?></td>
                <td><?= $data['tahun_perolehan'] ?></td>
                <td><?= $data['ukuran'] ?></td>
                <td><?= $data['satuan'] ?></td>
                <td><?= $data['kondisi_barang'] ?></td>
                <td><?= $data['stok_barang'] ?></td>
                <td>Rp.<?= number_format($data['harga']) ?></td>
                <td><?= $data['ket'] ?></td>
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
                              <label for="kode_barang">Kode Barang <small class="text-warning">*</small></label>
                              <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" class="form-control" id="kode_barang" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="register">Register</label>
                              <input type="text" name="register" value="<?= $data['register'] ?>" class="form-control" id="register" minlength="3">
                            </div>
                            <div class="form-group">
                              <label for="nama_barang_kib">Nama/Jenis Barang <small class="text-warning">*</small></label>
                              <input type="text" name="nama_barang_kib" value="<?= $data['nama_barang_kib'] ?>" class="form-control" id="nama_barang_kib" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="merek">Merek/Type</label>
                              <input type="text" name="merek" value="<?= $data['merek'] ?>" class="form-control" id="merek">
                            </div>
                            <div class="form-group">
                              <label for="no_seri">No. Sertifikat/No. Pabrik/No. Chasis/No. Mesin</label>
                              <input type="text" name="no_seri" value="<?= $data['no_seri'] ?>" class="form-control" id="no_seri">
                            </div>
                            <div class="form-group">
                              <label for="id_barang_kategori">Kategori Barang <small class="text-warning">*</small></label>
                              <select name="id_barang_kategori" class="form-control" id="id_barang_kategori" required>
                                <?php $id_barang_kategori = $data['id_barang_kategori'];
                                foreach ($views_barang_kategori as $data_bk) {
                                  $selected = ($data_bk['id_barang_kategori'] == $id_barang_kategori) ? 'selected' : ''; ?>
                                  <option value="<?= $data_bk['id_barang_kategori'] ?>" <?= $selected ?>><?= $data_bk['nama_kategori'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="bahan">Bahan</label>
                              <input type="text" name="bahan" value="<?= $data['bahan'] ?>" class="form-control" id="bahan">
                            </div>
                            <div class="form-group">
                              <label for="asal_perolehan">Asal/Cara Perolehan Barang</label>
                              <input type="text" name="asal_perolehan" value="<?= $data['asal_perolehan'] ?>" class="form-control" id="asal_perolehan">
                            </div>
                            <div class="form-group">
                              <label for="tahun_perolehan">Tahun Perolehan</label>
                              <input type="number" name="tahun_perolehan" value="<?= $data['tahun_perolehan'] ?>" class="form-control" id="tahun_perolehan">
                            </div>
                            <div class="form-group">
                              <label for="ukuran">Ukuran (P,SP,D)</label>
                              <input type="text" name="ukuran" value="<?= $data['ukuran'] ?>" class="form-control" id="ukuran">
                            </div>
                            <div class="form-group">
                              <label for="satuan">Satuan <small class="text-warning">*</small></label>
                              <input type="text" name="satuan" value="<?= $data['satuan'] ?>" class="form-control" id="satuan" required>
                            </div>
                            <div class="form-group">
                              <label for="kondisi_barang">Keadaan Barang (B/KB/RB) <small class="text-warning">*</small></label>
                              <input type="text" name="kondisi_barang" value="<?= $data['kondisi_barang'] ?>" class="form-control" id="kondisi_barang" required>
                            </div>
                            <div class="form-group">
                              <label for="stok_barang">Jumlah Barang <small class="text-warning">*</small></label>
                              <input type="number" name="stok_barang" value="<?= $data['stok_barang'] ?>" class="form-control" id="stok_barang" required>
                            </div>
                            <div class="form-group">
                              <label for="harga">Harga <small class="text-warning">*</small></label>
                              <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" id="harga" required>
                            </div>
                            <div class="form-group">
                              <label for="ket">Keterangan</label>
                              <input type="text" name="ket" value="<?= $data['ket'] ?>" class="form-control" id="ket">
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
              <label for="kode_barang">Kode Barang <small class="text-warning">*</small></label>
              <input type="text" name="kode_barang" class="form-control" id="kode_barang" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="register">Register</label>
              <input type="text" name="register" class="form-control" id="register" minlength="3">
            </div>
            <div class="form-group">
              <label for="nama_barang_kib">Nama/Jenis Barang <small class="text-warning">*</small></label>
              <input type="text" name="nama_barang_kib" class="form-control" id="nama_barang_kib" minlength="3" required>
            </div>
            <div class="form-group">
              <label for="merek">Merek/Type</label>
              <input type="text" name="merek" class="form-control" id="merek">
            </div>
            <div class="form-group">
              <label for="no_seri">No. Sertifikat/No. Pabrik/No. Chasis/No. Mesin</label>
              <input type="text" name="no_seri" class="form-control" id="no_seri">
            </div>
            <div class="form-group">
              <label for="id_barang_kategori">Kategori Barang <small class="text-warning">*</small></label>
              <select name="id_barang_kategori" class="form-control" id="id_barang_kategori" required>
                <option value="" selected>Pilih Kategori</option>
                <?php foreach ($views_barang_kategori as $data_bk) { ?>
                  <option value="<?= $data_bk['id_barang_kategori'] ?>"><?= $data_bk['nama_kategori'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="bahan">Bahan</label>
              <input type="text" name="bahan" class="form-control" id="bahan">
            </div>
            <div class="form-group">
              <label for="asal_perolehan">Asal/Cara Perolehan Barang</label>
              <input type="text" name="asal_perolehan" class="form-control" id="asal_perolehan">
            </div>
            <div class="form-group">
              <label for="tahun_perolehan">Tahun Perolehan</label>
              <input type="number" name="tahun_perolehan" class="form-control" id="tahun_perolehan">
            </div>
            <div class="form-group">
              <label for="ukuran">Ukuran (P,SP,D)</label>
              <input type="text" name="ukuran" class="form-control" id="ukuran">
            </div>
            <div class="form-group">
              <label for="satuan">Satuan <small class="text-warning">*</small></label>
              <input type="text" name="satuan" class="form-control" id="satuan" required>
            </div>
            <div class="form-group">
              <label for="kondisi_barang">Keadaan Barang (B/KB/RB) <small class="text-warning">*</small></label>
              <input type="text" name="kondisi_barang" class="form-control" id="kondisi_barang" required>
            </div>
            <div class="form-group">
              <label for="stok_barang">Jumlah Barang <small class="text-warning">*</small></label>
              <input type="number" name="stok_barang" class="form-control" id="stok_barang" required>
            </div>
            <div class="form-group">
              <label for="harga">Harga <small class="text-warning">*</small></label>
              <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="form-group">
              <label for="ket">Keterangan</label>
              <input type="text" name="ket" class="form-control" id="ket">
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