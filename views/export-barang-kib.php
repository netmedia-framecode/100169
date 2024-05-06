<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if (!isset($_SESSION["project_si_inventaris_sekolah"]["export"])) {
  header("Location: barang-kib");
  exit();
} else {
  $id_barang_kategori = valid($conn, $_SESSION["project_si_inventaris_sekolah"]["export"]['id_barang_kategori']);
  $barang_kib = "SELECT barang_kib.*, users.name, barang_kategori.nama_kategori FROM barang_kib JOIN users ON barang_kib.id_user=users.id_user JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori WHERE barang_kib.id_barang_kategori=$id_barang_kategori";
  $export_barang_kib = mysqli_query($conn, $barang_kib);

  $mpdf->WriteHTML('<div style="border-bottom: 3px solid black;width: 100%;">
  <table border="0" style="width: 100%;">
    <tbody>
      <tr>
        <th style="text-align: center;">
          <img src="../assets/img/logo-kiri.png" alt="" style="width: 100px;height: 100px;">
        </th>
        <td style="text-align: center;">
          <h3>PEMERINTAH PROVINSI NUSA TENGGARA TIMUR<br>DINAS PENDIDIKAN DAN KEBUDAYAAN<br>SMK NEGERI 4 KOTA KUPANG</h3>
          <p style="font-size: 14px;">Jl. Bajawa - Oepoi Kuapng | Telp. (0380) 821586</p>
          <p style="font-size: 14px;">Website: www.smkn4kpg.sch.id - Email: smkn4kpg@yahoo.com</p>
        </td>
        <th style="text-align: center;">
          <img src="../assets/img/logo-smkn4.png" alt="" style="width: 100px;height: 100px;">
        </th>
      </tr>
    </tbody>
  </table>
</div>');

  $mpdf->WriteHTML('
  <h4 style="text-align: center; text-decoration: underline;">Data Barang KIB</h4>
');

  $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; margin: auto;">
  <thead>
    <tr style="border: 1px solid #000;">
      <th style="border: 1px solid #000;" colspan="3">Nomor</th>
      <th style="border: 1px solid #000;" colspan="3">Spesifikasi Barang</th>
      <th style="border: 1px solid #000;" rowspan="2">Kategori</th>
      <th style="border: 1px solid #000;" rowspan="2">Bahan</th>
      <th style="border: 1px solid #000;" rowspan="2">Asal/Cara Perolehan Barang</th>
      <th style="border: 1px solid #000;" rowspan="2">Tahun Perolehan</th>
      <th style="border: 1px solid #000;" rowspan="2">Ukuran (P,SP,D)</th>
      <th style="border: 1px solid #000;" rowspan="2">Satuan</th>
      <th style="border: 1px solid #000;" rowspan="2">Keadaan Barang (B/KB/RB)</th>
      <th style="border: 1px solid #000;" colspan="2">Jumlah</th>
      <th style="border: 1px solid #000;" rowspan="2">Keterangan</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000;">No Urut</th>
      <th style="border: 1px solid #000;">Kode Barang</th>
      <th style="border: 1px solid #000;">Register</th>
      <th style="border: 1px solid #000;">Nama/Jenis Barang</th>
      <th style="border: 1px solid #000;">Merek/Type</th>
      <th style="border: 1px solid #000;">No. Sertifikat/No. Pabrik/No. Chasis/No. Mesin</th>
      <th style="border: 1px solid #000;">Barang</th>
      <th style="border: 1px solid #000;">Harga</th>
    </tr>
  </thead>
  <tbody id="search-page">');

  if (mysqli_num_rows($export_barang_kib) == 0) {
    $mpdf->WriteHTML('<tr style="border: 1px solid #000;">
        <th colspan="16" style="border: 1px solid #000;">Belum ada data.</th>
      </tr>');
  }

  $no = 1;

  if (mysqli_num_rows($export_barang_kib) > 0) {
    $no = 1;
    while ($data = mysqli_fetch_assoc($export_barang_kib)) {
      $mpdf->WriteHTML('
      <tr style="border: 1px solid #000;">
        <th style="border: 1px solid #000;">' . $no . '</th>
        <td style="border: 1px solid #000;">' . $data['kode_barang'] . '</td>
        <td style="border: 1px solid #000;">' . $data['register'] . '</td>
        <td style="border: 1px solid #000;">' . $data['nama_barang_kib'] . '</td>
        <td style="border: 1px solid #000;">' . $data['merek'] . '</td>
        <td style="border: 1px solid #000;">' . $data['no_seri'] . '</td>
        <td style="border: 1px solid #000;">' . $data['nama_kategori'] . '</td>
        <td style="border: 1px solid #000;">' . $data['bahan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['asal_perolehan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['tahun_perolehan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['ukuran'] . '</td>
        <td style="border: 1px solid #000;">' . $data['satuan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['kondisi_barang'] . '</td>
        <td style="border: 1px solid #000;">' . $data['stok_barang'] . '</td>
        <td style="border: 1px solid #000;">Rp.' . number_format($data['harga']) . '</td>
        <td style="border: 1px solid #000;">' . $data['ket'] . '</td>
      </tr>');
      $no++;
    }
  }

  $mpdf->WriteHTML('</tbody>
  </table>');

  $mpdf->WriteHTML('
  <div style="width: 300px; margin-top: 20px; float: right; text-align: right;">
    <p style="text-align: center;">Kupang, ' . date("d M Y") . '</p>
    <p style="text-align: center; padding-top: -15px;">An. Kepala Sekolah</p>
    <h4 style="padding-top: 50px; text-decoration: underline; text-align: center;">-</h4>
  </div>
');

  $mpdf->Output();
  // $mpdf->OutputHttpDownload('Data_Barang_KIB.pdf');
  // header("Location: barang-kib");
  // exit;
}
