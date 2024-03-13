<?php require_once("../controller/script.php");
$_SESSION["project_si_inventaris_sekolah"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <?php $barang_kib = "SELECT SUM(stok_barang) as total FROM barang_kib";
  $dash_barang_kib = mysqli_query($conn, $barang_kib);
  $data_barang_kib = mysqli_fetch_assoc($dash_barang_kib);
  $barang_masuk = "SELECT SUM(jumlah) as total FROM barang_masuk";
  $dash_barang_masuk = mysqli_query($conn, $barang_masuk);
  $data_barang_masuk = mysqli_fetch_assoc($dash_barang_masuk);
  $barang_keluar = "SELECT SUM(jumlah) as total FROM barang_keluar";
  $dash_barang_keluar = mysqli_query($conn, $barang_keluar);
  $data_barang_keluar = mysqli_fetch_assoc($dash_barang_keluar);
  if ($id_role <= 2) { ?>
    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" onclick="window.location.href='barang-kib'" style="cursor: pointer;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Stok Barang</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= number_format($data_barang_kib['total']); ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-box2-fill fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" onclick="window.location.href='barang-masuk'" style="cursor: pointer;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Barang Masuk</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= number_format($data_barang_masuk['total']) . " / " . number_format($data_barang_kib['total']); ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-box-seam-fill fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2" onclick="window.location.href='barang-keluar'" style="cursor: pointer;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Barang Keluar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= number_format($data_barang_keluar['total']) . " / " . number_format($data_barang_kib['total']); ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-dropbox fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" onclick="window.location.href='kontak'" style="cursor: pointer;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kontak
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= mysqli_num_rows($views_kontak) ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="bi bi-chat-left-dots-fill fa-2x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php } ?>

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
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
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
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
          <div class="chart-area">
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

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Chart Pie</h6>
        </div>
        <div class="card-body text-center">
          <p>Perbandingan jumlah data barang</p>
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
            <?php
            $barang_kib = number_format($data_barang_kib['total']);
            $barang_masuk = number_format($data_barang_masuk['total']);
            $barang_keluar = number_format($data_barang_keluar['total']);
            ?>
            <script>
              var pieData = {
                labels: ["Barang KIB", "Barang Masuk", "Barang Keluar"],
                datasets: [{
                  data: [
                    <?php echo $barang_kib; ?>,
                    <?php echo $barang_masuk; ?>,
                    <?php echo $barang_keluar; ?>
                  ],
                  backgroundColor: [
                    'rgba(0, 123, 255, 0.9)',
                    'rgba(40, 167, 69, 0.9)',
                    'rgba(23, 162, 184, 0.9)'
                  ]
                }]
              };
            </script>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Barang KIB
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Barang Masuk
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Barang Keluar
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>