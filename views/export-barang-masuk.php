<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$barang_masuk = "SELECT barang_masuk.*, barang_kategori.nama_kategori FROM barang_masuk JOIN barang_kib ON barang_masuk.id_barang_kib=barang_kib.id_barang_kib JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori";
$export_barang_masuk = mysqli_query($conn, $barang_masuk);

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
  <h4 style="text-align: center; text-decoration: underline;">Data Barang Masuk</h4>
');

$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; margin: auto;">
  <thead>
    <tr style="border: 1px solid #000;">
      <th style="border: 1px solid #000;">No</th>
      <th style="border: 1px solid #000;">Kategori KIB</th>
      <th style="border: 1px solid #000;">Barang</th>
      <th style="border: 1px solid #000;">Keterangan</th>
      <th style="border: 1px solid #000;">Jumlah</th>
      <th style="border: 1px solid #000;">Harga</th>
    </tr>
  </thead>
  <tbody id="search-page">');

if (mysqli_num_rows($export_barang_masuk) == 0) {
  $mpdf->WriteHTML('<tr style="border: 1px solid #000;">
        <th colspan="6" style="border: 1px solid #000;">Belum ada data.</th>
      </tr>');
}

$no = 1;

if (mysqli_num_rows($export_barang_masuk) > 0) {
  while ($data = mysqli_fetch_assoc($export_barang_masuk)) {
    $mpdf->WriteHTML('
      <tr style="border: 1px solid #000;">
        <th style="border: 1px solid #000;">' . $no . '</th>
        <td style="border: 1px solid #000;">' . $data['nama_kategori'] . '</td>
        <td style="border: 1px solid #000;">' . $data['nama_barang_masuk'] . '</td>
        <td style="border: 1px solid #000;">' . $data['keterangan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['jumlah'] . '</td>
        <td style="border: 1px solid #000;">Rp.' . number_format($data['harga']) . '</td>
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
// $mpdf->OutputHttpDownload('Data_Barang_Masuk.pdf');
// header("Location: barang-masuk");
// exit;
