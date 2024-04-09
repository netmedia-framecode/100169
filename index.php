<?php require_once("templates/top.php"); ?>

<section class="slider_section ">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container ">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1 style="font-size: 35px;">
                  SISTEM INFORMASI <br>
                  INVENTARIS BARANG SEKOLAH <br>
                  SMK Negeri 4 Kupang
                </h1>
                <p>
                  Dapat membantu dan mempermudah kinerja petugas dalam mengelolah inventaris barang yang ada di SMK Negeri 4 Kupang, sehingga data yang ada dapat di proses lebih akurat, efektif, efisien dan mempermudah dalam proses pembuatan laporan rekonsilasi.
                </p>
                <div class="btn-box">
                  <a href="#tentang" class="btn1">
                    Baca lebih
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="assets/img/slider-img.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
</div>

<section class="why_section layout_padding" id="tentang">
  <div class="container">
    <div class="heading_container heading_center">
      <h2 class="mb-5">
        Tentang</span>
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img src="assets/img/about.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <h3>
            Sistem Informasi Inventaris Barang Sekolah SMKN 4 Kupang
          </h3>
          <?php foreach ($views_tentang as $data) {
            echo $data['deskripsi'];
          } ?>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Grafik data barang <?php if (isset($_POST['barang'])) {
                                                                                if ($_POST['barang'] == "masuk") {
                                                                                  echo "masuk";
                                                                                }
                                                                                if ($_POST['barang'] == "keluar") {
                                                                                  echo "keluar";
                                                                                }
                                                                              } else {
                                                                                echo "masuk dan keluar";
                                                                              } ?></h6>
            <div class="dropdown no-arrow">
              <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Action:</div>
                <form action="" method="post">
                  <button type="submit" name="barang" value="masuk" class="dropdown-item" id="masuk">Barang Masuk</button>
                  <button type="submit" name="barang" value="keluar" class="dropdown-item" id="keluar">Barang keluar</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./">All</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area" style="height: 500px;">
              <canvas id="myAreaChart"></canvas>
              <?php
              $currentYear = date('Y');
              if (isset($_POST['barang'])) {
                if ($_POST['barang'] == 'masuk') {
                  $sql = "SELECT 'Barang KIB' as category, MONTH(created_at) as month, SUM(stok_barang) as total FROM barang_kib WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month 
                UNION
                SELECT 'Barang Masuk' as category, MONTH(created_at) as month, SUM(jumlah) as total FROM barang_masuk WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month";
                }
                if ($_POST['barang'] == 'keluar') {
                  $sql = "SELECT 'Barang KIB' as category, MONTH(created_at) as month, SUM(stok_barang) as total FROM barang_kib WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month 
                UNION
                SELECT 'Barang Keluar' as category, MONTH(created_at) as month, SUM(jumlah) as total FROM barang_keluar WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month";
                }
              } else {
                $sql = "SELECT 'Barang KIB' as category, MONTH(created_at) as month, SUM(stok_barang) as total FROM barang_kib WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month 
              UNION
              SELECT 'Barang Masuk' as category, MONTH(created_at) as month, SUM(jumlah) as total FROM barang_masuk WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month
              UNION
              SELECT 'Barang Keluar' as category, MONTH(created_at) as month, SUM(jumlah) as total FROM barang_keluar WHERE YEAR(created_at) = $currentYear AND MONTH(created_at) BETWEEN 1 AND 12 GROUP BY month";
              }
              $result = $conn->query($sql);
              $dataGrafik = [];
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $namaBulan = DateTime::createFromFormat('!m', $row['month'])->format('F');
                  $dataGrafik[] = [
                    'category' => $row['category'],
                    'total' => $row['total'],
                    'month' => $namaBulan,
                  ];
                }
              }
              ?>

              <script>
                var dataGrafik = <?php echo json_encode($dataGrafik); ?>;
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="team_section layout_padding">
  <div class="container-fluid">
    <div class="heading_container heading_center">
      <h2 class="mb-5">
        Kontak</span>
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="detail-box">
          <form action="" method="post">
            <div class="col-10 m-auto">
              <div class="mb-5">
                <input type="text" name="username" class="form-control p-4 shadow" placeholder="Nama" required />
              </div>
              <div class="mb-5">
                <input type="email" name="email" class="form-control p-4 shadow" placeholder="Email" required />
              </div>
              <div class="mb-5">
                <input type="number" name="phone" class="form-control p-4 shadow" placeholder="No. Handphone" required />
              </div>
              <div class="mb-5">
                <textarea name="pesan" class="form-control border-0 form-control rounded-0 mb-4 shadow" id="pesan" rows="3" placeholder="Pesan" required></textarea>
              </div>
              <div class="btn_box">
                <button type="submit" name="add_kontak" class="btn1">
                  <i class="bi bi-send"></i> Kirim
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6 ">
        <div class="img-box">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3927.1366845982557!2d123.6141553152547!3d-10.169543395156085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569cacee026da9%3A0x358ed7b270d988c6!2sSMK%20Negeri%204%20Kupang!5e0!3m2!1sid!2sid!4v1710099658888!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once("templates/bottom.php"); ?>