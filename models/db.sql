-- Active: 1709030200372@@127.0.0.1@3306@si_inventaris_sekolah
CREATE TABLE barang_kategori(
  id_barang_kategori INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(75),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE barang_kib(
  id_barang_kib INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT,
  id_barang_kategori INT,
  nama_barang_kib VARCHAR(50),
  kondisi_barang VARCHAR(50),
  thn_anggaran DATE,
  sumber_dana VARCHAR(50),
  harga CHAR(20),
  stok_barang INT,
  ruangan VARCHAR(30),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_barang_kategori) REFERENCES barang_kategori(id_barang_kategori) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE barang_masuk(
  id_barang_masuk INT AUTO_INCREMENT PRIMARY KEY,
  id_barang_kib INT,
  nama_barang_masuk VARCHAR(50),
  keterangan TEXT,
  jumlah CHAR(20),
  harga CHAR(20),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_barang_kib) REFERENCES barang_kib(id_barang_kib) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE barang_keluar(
  id_barang_keluar INT AUTO_INCREMENT PRIMARY KEY,
  id_barang_kib INT,
  nama_barang_keluar VARCHAR(50),
  penerima VARCHAR(50),
  jumlah CHAR(20),
  keterangan TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_barang_kib) REFERENCES barang_kib(id_barang_kib) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE kontak (
  id_kontak INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(75),
  email VARCHAR(50),
  phone CHAR(12),
  pesan TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tentang(
  id_tentang INT AUTO_INCREMENT PRIMARY KEY,
  deskripsi TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);