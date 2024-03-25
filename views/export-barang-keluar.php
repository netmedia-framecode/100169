<?php require_once("../controller/script.php");

require_once __DIR__ . '/../assets/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$barang_keluar = "SELECT barang_keluar.*, barang_kategori.nama_kategori, status_barang_keluar.status_bk FROM barang_keluar JOIN barang_kib ON barang_keluar.id_barang_kib=barang_kib.id_barang_kib JOIN barang_kategori ON barang_kib.id_barang_kategori=barang_kategori.id_barang_kategori JOIN status_barang_keluar ON barang_keluar.id_status_bk=status_barang_keluar.id_status_bk";
$export_barang_keluar = mysqli_query($conn, $barang_keluar);

$mpdf->WriteHTML('<div style="border-bottom: 3px solid black;width: 100%;">
  <table border="0" style="width: 100%;">
    <tbody>
      <tr>
        <th style="text-align: center;">
          <img src="../assets/img/logo-kiri.png" alt="" style="width: 100px;height: 100px;">
        </th>
        <td style="text-align: center;">
          <h3>PEMERINTAH PROVINSI NUSA TENGGARA TIMUR<br>DINAS PENDIDIKAN DAN KEBUDAYAAN<br>SMK NEGERI 4 KOTA KUPANG</h3>
          <p style="font-size: 14px;">Jl. Yos Soedarso, Kelurahan Aplasi-Kefamenanu | Telp. 0388[31448]- email: smkkatolikkefa@gmail.com</p>
        </td>
        <th style="text-align: center;">
          <img src="../assets/img/logo-smkn4.png" alt="" style="width: 100px;height: 100px;">
        </th>
      </tr>
    </tbody>
  </table>
</div>');

$mpdf->WriteHTML('
  <h4 style="text-align: center; text-decoration: underline;">Data Barang Keluar</h4>
');

$mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%; margin: auto;">
  <thead>
    <tr style="border: 1px solid #000;">
      <th style="border: 1px solid #000;">No</th>
      <th style="border: 1px solid #000;">Kategori KIB</th>
      <th style="border: 1px solid #000;">Barang</th>
      <th style="border: 1px solid #000;">Penerima</th>
      <th style="border: 1px solid #000;">Jumlah</th>
      <th style="border: 1px solid #000;">Keterangan</th>
      <th style="border: 1px solid #000;">Status</th>
    </tr>
  </thead>
  <tbody id="search-page">');

if (mysqli_num_rows($export_barang_keluar) == 0) {
  $mpdf->WriteHTML('<tr style="border: 1px solid #000;">
        <th colspan="7" style="border: 1px solid #000;">Belum ada data.</th>
      </tr>');
}

$no = 1;

if (mysqli_num_rows($export_barang_keluar) > 0) {
  while ($data = mysqli_fetch_assoc($export_barang_keluar)) {
    $mpdf->WriteHTML('
      <tr style="border: 1px solid #000;">
        <th style="border: 1px solid #000;">' . $no . '</th>
        <td style="border: 1px solid #000;">' . $data['nama_kategori'] . '</td>
        <td style="border: 1px solid #000;">' . $data['nama_barang_keluar'] . '</td>
        <td style="border: 1px solid #000;">' . $data['penerima'] . '</td>
        <td style="border: 1px solid #000;">' . $data['jumlah'] . '</td>
        <td style="border: 1px solid #000;">' . $data['keterangan'] . '</td>
        <td style="border: 1px solid #000;">' . $data['status_bk'] . '</td>
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
// $mpdf->OutputHttpDownload('Data_Barang_Keluar.pdf');
// header("Location: barang-keluar");
// exit;
