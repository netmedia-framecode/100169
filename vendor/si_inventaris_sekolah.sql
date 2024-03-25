-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Mar 2024 pada 06.21
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_inventaris_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`) VALUES
(1, 'auth.jpg', '#4e73de');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_kategori`
--

CREATE TABLE `barang_kategori` (
  `id_barang_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_kategori`
--

INSERT INTO `barang_kategori` (`id_barang_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(2, 'Tanah', '2024-03-07 17:17:32', '2024-03-07 17:17:32'),
(3, 'Peralatan dan Mesin', '2024-03-07 17:17:48', '2024-03-07 17:17:48'),
(4, 'Gedung dan Bangunan', '2024-03-07 17:18:01', '2024-03-07 17:18:01'),
(5, 'Jalan Irigrasi dan Jaringan', '2024-03-07 17:18:25', '2024-03-07 17:18:25'),
(6, 'Aset Tetap Lainnya', '2024-03-07 17:18:42', '2024-03-07 17:18:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_barang_kib` int(11) DEFAULT NULL,
  `id_status_bk` int(11) NOT NULL DEFAULT 1,
  `nama_barang_keluar` varchar(50) DEFAULT NULL,
  `penerima` varchar(50) DEFAULT NULL,
  `jumlah` char(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_barang_kib`, `id_status_bk`, `nama_barang_keluar`, `penerima`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 6, 1, 'Mesin Bubut', 'Netmedia Framecode', '1', '', '2024-03-25 13:12:48', '2024-03-25 13:12:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_kib`
--

CREATE TABLE `barang_kib` (
  `id_barang_kib` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_barang_kategori` int(11) DEFAULT NULL,
  `kode_barang` char(15) NOT NULL,
  `register` char(10) NOT NULL,
  `nama_barang_kib` varchar(50) DEFAULT NULL,
  `merek` varchar(50) NOT NULL,
  `no_seri` varchar(50) NOT NULL,
  `bahan` varchar(50) NOT NULL,
  `asal_perolehan` varchar(50) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL,
  `ukuran` char(10) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL,
  `stok_barang` int(11) NOT NULL,
  `harga` char(20) DEFAULT NULL,
  `ket` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_kib`
--

INSERT INTO `barang_kib` (`id_barang_kib`, `id_user`, `id_barang_kategori`, `kode_barang`, `register`, `nama_barang_kib`, `merek`, `no_seri`, `bahan`, `asal_perolehan`, `tahun_perolehan`, `ukuran`, `satuan`, `kondisi_barang`, `stok_barang`, `harga`, `ket`, `created_at`, `updated_at`) VALUES
(5, 1, 2, '01.01.11.04.02', '', 'Tanah', '', '4301353', '', 'Milik Pemerintah', '1979', '', '40.000', 'B', 1, '1539850000', '', '2024-03-25 13:05:51', '2024-03-25 13:05:51'),
(6, 1, 3, '02.04.01.01.01', '0035', 'Mesin Bubut', '', '', 'Besi', '', '1995', '', 'Buah', '1.B/1.RB', 2, '1980800', '', '2024-03-25 13:06:37', '2024-03-25 13:12:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_barang_kib` int(11) DEFAULT NULL,
  `nama_barang_masuk` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` char(20) DEFAULT NULL,
  `harga` char(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_barang_kib`, `nama_barang_masuk`, `keterangan`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
(10, 6, 'Mesin Bubut', '', '1', '1980800', '2024-03-25 13:09:37', '2024-03-25 13:09:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `username` varchar(75) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` char(12) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_barang_keluar`
--

CREATE TABLE `status_barang_keluar` (
  `id_status_bk` int(11) NOT NULL,
  `status_bk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_barang_keluar`
--

INSERT INTO `status_barang_keluar` (`id_status_bk`, `status_bk`) VALUES
(1, 'Diajukan'),
(2, 'Diterima'),
(3, 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang`
--

CREATE TABLE `tentang` (
  `id_tentang` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`id_tentang`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '<p>Sistem ini adalah suatu aplikasi yang bisa mempermudah bagian sarana prasarana dalam mengelola barang masuk, barang keluar dan dapat mempermudah setiap jurusan dalam melakukan pemesanan barang melalui sistem. Sistem ini dapat dibuka secara transparan dan reel time (stok barangnya kelihatan, barang masuknya kelihatan, barang keluarnya kelihatan).</p>\r\n\r\n<p>Sistem informasi inventaris barang yang di rancang meliputi data informasi Inventaris barang (KIB) misalnya data Barang Habis Pakai, data peralatan dan mesin, data tanah, data Gedung dan bangunan. Hasil implementasi dari sistem informasi ini adalah pencatatan data inventaris serta pembuatan laporan inventaris lebih mudah untuk dilakukan.</p>\r\n\r\n<p>Dengan adanya sistem ini diharapkan mampu membantu dan mempermudah kinerja petugas dalam mengelolah inventaris barang yang ada di SMK Negeri 4 Kupang, sehingga data yang ada dapat di proses lebih akurat, efektif, efisien dan mempermudah dalam proses pembuatan laporan rekonsilasi.</p>\r\n', '2024-03-07 12:24:35', '2024-03-11 04:05:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2024-03-06 11:29:49', '2024-03-06 11:29:49'),
(3, 3, 1, '2y10gQcqARS9DVe26Cxk2PsBFK2edaTWPmjsOzSfDanjGz518phyoG', '749098', 'Netmedia Framecode', 'default.svg', 'netmediaframecode@gmail.com', '$2y$10$6zTR4NffEpHtAD9ycuw8wuCqiko3UMcQkQtZQZkExNUws/3KaFrD6', '2024-03-25 13:12:01', '2024-03-25 13:12:23');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 3, 3),
(6, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 3, 13),
(14, 2, 7),
(15, 2, 8),
(16, 2, 9),
(17, 2, 10),
(18, 2, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'Data Inventaris'),
(4, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Kepala Sekolah'),
(3, 'Pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(7, 3, 1, 'Kategori KIB', 'kategori-kib', 'fas fa-list-ul'),
(8, 3, 1, 'Barang KIB', 'barang-kib', 'fas fa-list-ul'),
(9, 3, 1, 'Barang Masuk', 'barang-masuk', 'fas fa-list-ul'),
(10, 3, 1, 'Barang Keluar', 'barang-keluar', 'fas fa-list-ul'),
(11, 4, 1, 'Tentang', 'tentang', 'fas fa-list-ul'),
(12, 4, 1, 'Kontak', 'kontak', 'fas fa-list-ul'),
(13, 3, 1, 'Pengajuan Barang', 'pengajuan-barang', 'fas fa-list');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_kategori`
--
ALTER TABLE `barang_kategori`
  ADD PRIMARY KEY (`id_barang_kategori`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_barang_kib` (`id_barang_kib`),
  ADD KEY `id_status_bk` (`id_status_bk`);

--
-- Indeks untuk tabel `barang_kib`
--
ALTER TABLE `barang_kib`
  ADD PRIMARY KEY (`id_barang_kib`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang_kategori` (`id_barang_kategori`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang_kib` (`id_barang_kib`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indeks untuk tabel `status_barang_keluar`
--
ALTER TABLE `status_barang_keluar`
  ADD PRIMARY KEY (`id_status_bk`);

--
-- Indeks untuk tabel `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang_kategori`
--
ALTER TABLE `barang_kategori`
  MODIFY `id_barang_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `barang_kib`
--
ALTER TABLE `barang_kib`
  MODIFY `id_barang_kib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `status_barang_keluar`
--
ALTER TABLE `status_barang_keluar`
  MODIFY `id_status_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id_tentang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang_kib`) REFERENCES `barang_kib` (`id_barang_kib`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_status_bk`) REFERENCES `status_barang_keluar` (`id_status_bk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `barang_kib`
--
ALTER TABLE `barang_kib`
  ADD CONSTRAINT `barang_kib_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_kib_ibfk_2` FOREIGN KEY (`id_barang_kategori`) REFERENCES `barang_kategori` (`id_barang_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang_kib`) REFERENCES `barang_kib` (`id_barang_kib`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
