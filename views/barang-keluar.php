<?php require_once("../controller/script.php");
$_SESSION["project_si_inventaris_sekolah"]["name_page"] = "Barang Keluar";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_si_inventaris_sekolah"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#export"><i class="bi bi-download"></i> Export</a>
    <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header border-bottom-0 shadow">
            <h5 class="modal-title" id="exampleModalLabel">Export Barang Keluar</h5>
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
              <button type="submit" name="export_barang_keluar" class="btn btn-success btn-sm">Export</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- <a href="export-barang-keluar" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="bi bi-download"></i> Export</a> -->
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Kategori KIB</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Penerima</th>
              <th class="text-center">Pengaju</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Kategori KIB</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Penerima</th>
              <th class="text-center">Pengaju</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Tgl buat</th>
              <th class="text-center">Tgl edit</th>
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_barang_keluar as $data) { ?>
              <tr>
                <td><?= $data['nama_kategori'] ?></td>
                <td><?= $data['nama_barang_keluar'] ?></td>
                <td><?= $data['penerima'] ?></td>
                <td><?= $data['pengaju'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td><?php $created_at = date_create($data["created_at"]);
                    echo date_format($created_at, "l, d M Y"); ?></td>
                <td><?php $updated_at = date_create($data["updated_at"]);
                    echo date_format($updated_at, "l, d M Y"); ?></td>
                <td>
                  <?php if ($data['id_status_bk'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#status<?= $data['id_barang_keluar'] ?>">
                      <?= $data['status_bk'] ?>
                    </button>
                  <?php } else if ($data['id_status_bk'] == 2) { ?>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#status<?= $data['id_barang_keluar'] ?>">
                      <?= $data['status_bk'] ?>
                    </button>
                  <?php } else if ($data['id_status_bk'] == 3) { ?>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#status<?= $data['id_barang_keluar'] ?>">
                      <?= $data['status_bk'] ?>
                    </button>
                  <?php } ?>
                  <div class="modal fade" id="status<?= $data['id_barang_keluar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Status <?= $data['nama_barang_keluar'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_keluar" value="<?= $data['id_barang_keluar'] ?>">
                          <div class="modal-body">
                            <p>Ubah status barang keluar yang diajukan oleh pengguna:</p>
                            <div class="form-group">
                              <label for="id_status_bk">Status Barang Keluar <small class="text-warning">*</small></label>
                              <select name="id_status_bk" class="form-control" id="id_status_bk" required>
                                <option value="" selected>Pilih Status Barang</option>
                                <?php $id_status_bk = $data['id_status_bk'];
                                foreach ($views_status_bk as $data_bk) {
                                  $selected = ($data_bk['id_status_bk'] == $id_status_bk) ? 'selected' : ''; ?>
                                  <option value="<?= $data_bk['id_status_bk'] ?>" <?= $selected ?>><?= $data_bk['status_bk'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" name="ubah_status_barang_keluar" class="btn btn-primary btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_barang_keluar'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_barang_keluar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_barang_keluar'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_keluar" value="<?= $data['id_barang_keluar'] ?>">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <input type="hidden" name="jumlahOld" value="<?= $data['jumlah'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_barang_kib">Barang KIB <small class="text-warning">*</small></label>
                              <select class="form-control" id="id_barang_kib" disabled required>
                                <option value="" selected>Pilih Barang</option>
                                <?php $id_barang_kib = $data['id_barang_kib'];
                                foreach ($views_barang_kib as $data_bk) {
                                  $selected = ($data_bk['id_barang_kib'] == $id_barang_kib) ? 'selected' : ''; ?>
                                  <option value="<?= $data_bk['id_barang_kib'] ?>" <?= $selected ?>><?= $data_bk['nama_kategori'] . " - " . $data_bk['nama_barang_kib'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="nama_barang_keluar">Nama Barang Keluar <small class="text-warning">*</small></label>
                              <input type="text" name="nama_barang_keluar" value="<?= $data['nama_barang_keluar'] ?>" class="form-control" id="nama_barang_keluar" minlength="3" required>
                            </div>
                            <div class="form-group">
                              <label for="penerima">Penerima <small class="text-warning">*</small></label>
                              <input type="text" name="penerima" value="<?= $data['penerima'] ?>" class="form-control" id="penerima" required>
                            </div>
                            <div class="form-group">
                              <label for="jumlah">Jumlah <small class="text-warning">*</small></label>
                              <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" id="jumlah" required>
                            </div>
                            <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea name="keterangan" class="form-control" id="deskripsi<?= $data['id_barang_keluar'] ?>" rows="3"><?= $data['keterangan'] ?></textarea>
                              <script>
                                CKEDITOR.replace('deskripsi<?= $data['id_barang_keluar'] ?>');
                              </script>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_barang_keluar" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_barang_keluar'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_barang_keluar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_barang_keluar'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_barang_keluar" value="<?= $data['id_barang_keluar'] ?>">
                          <input type="hidden" name="id_barang_kib" value="<?= $data['id_barang_kib'] ?>">
                          <input type="hidden" name="jumlah" value="<?= $data['jumlah'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus <?= $data['nama_barang_keluar'] ?>, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_barang_keluar" class="btn btn-danger btn-sm">hapus</button>
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

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>