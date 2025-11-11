-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 09:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gunung_berapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dampak`
--

CREATE TABLE `dampak` (
  `id_dampak` int(11) NOT NULL,
  `id_letusan` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `tingkat_dampak` varchar(50) DEFAULT NULL,
  `radius_dampak_km` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gunung`
--

CREATE TABLE `gunung` (
  `id_gunung` int(11) NOT NULL,
  `nama_gunung` varchar(100) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `ketinggian` int(11) DEFAULT NULL,
  `status_aktif` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korban`
--

CREATE TABLE `korban` (
  `id_korban` int(11) NOT NULL,
  `nama_korban` varchar(100) NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `alamat_asal` text DEFAULT NULL,
  `nama_wilayah` varchar(100) DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `waktu_laporan` date DEFAULT NULL,
  `judul_laporan` text DEFAULT NULL,
  `detail_laporan` text DEFAULT NULL,
  `status_verifikasi` varchar(50) DEFAULT 'Menunggu Verifikasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letusan`
--

CREATE TABLE `letusan` (
  `id_letusan` int(11) NOT NULL,
  `id_gunung` int(11) NOT NULL,
  `tanggal_letusan` date DEFAULT NULL,
  `tingkat_letusan` varchar(50) DEFAULT NULL,
  `durasi_letusan` varchar(50) DEFAULT NULL,
  `jumlah_korban` int(11) DEFAULT 0,
  `dampak_ekonomi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logistik`
--

CREATE TABLE `logistik` (
  `id_logistik` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mengungsi`
--

CREATE TABLE `mengungsi` (
  `id_registrasi` int(11) NOT NULL,
  `id_korban` int(11) NOT NULL,
  `id_posko` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `kondisi_saat_masuk` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peringatan_dini`
--

CREATE TABLE `peringatan_dini` (
  `id_peringatan` int(11) NOT NULL,
  `tanggal_ditetapkan` datetime NOT NULL,
  `rekomendasi_tindakan` text DEFAULT NULL,
  `level_status` varchar(50) DEFAULT NULL,
  `nama_status` varchar(100) DEFAULT NULL,
  `id_gunung` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posko_pengungsian`
--

CREATE TABLE `posko_pengungsian` (
  `id_posko` int(11) NOT NULL,
  `nama_posko` varchar(150) NOT NULL,
  `kapasitas_maksimal` int(11) DEFAULT NULL,
  `alamat_posko` text DEFAULT NULL,
  `penangungg_jawab` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sebaran_wilayah`
--

CREATE TABLE `sebaran_wilayah` (
  `id` int(11) NOT NULL,
  `nama_gunung` varchar(100) DEFAULT NULL,
  `wilayah_terdampak` varchar(150) DEFAULT NULL,
  `waktu_kejadian` datetime DEFAULT NULL,
  `jumlah_korban` int(11) DEFAULT NULL,
  `informasi_terbaru` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_posko` int(11) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL DEFAULT 0,
  `update_terakhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_penugasan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_posko` int(11) NOT NULL,
  `peran_spesifik` text DEFAULT NULL,
  `shift_jaga` varchar(50) DEFAULT 'Aktif',
  `status_bertugas` varchar(50) DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL,
  `estimasi_populasi` int(11) DEFAULT NULL,
  `kategori_resiko` varchar(50) DEFAULT NULL,
  `jarak_dari_gunung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dampak`
--
ALTER TABLE `dampak`
  ADD PRIMARY KEY (`id_dampak`),
  ADD UNIQUE KEY `unik_dampak` (`id_letusan`,`id_wilayah`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `gunung`
--
ALTER TABLE `gunung`
  ADD PRIMARY KEY (`id_gunung`);

--
-- Indexes for table `korban`
--
ALTER TABLE `korban`
  ADD PRIMARY KEY (`id_korban`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `letusan`
--
ALTER TABLE `letusan`
  ADD PRIMARY KEY (`id_letusan`),
  ADD KEY `id_gunung` (`id_gunung`);

--
-- Indexes for table `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id_logistik`);

--
-- Indexes for table `mengungsi`
--
ALTER TABLE `mengungsi`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD KEY `id_korban` (`id_korban`),
  ADD KEY `id_posko` (`id_posko`);

--
-- Indexes for table `peringatan_dini`
--
ALTER TABLE `peringatan_dini`
  ADD PRIMARY KEY (`id_peringatan`),
  ADD KEY `id_gunung` (`id_gunung`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `posko_pengungsian`
--
ALTER TABLE `posko_pengungsian`
  ADD PRIMARY KEY (`id_posko`);

--
-- Indexes for table `sebaran_wilayah`
--
ALTER TABLE `sebaran_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD UNIQUE KEY `unik_stok` (`id_posko`,`id_logistik`),
  ADD KEY `id_logistik` (`id_logistik`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_penugasan`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_posko` (`id_posko`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dampak`
--
ALTER TABLE `dampak`
  MODIFY `id_dampak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gunung`
--
ALTER TABLE `gunung`
  MODIFY `id_gunung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korban`
--
ALTER TABLE `korban`
  MODIFY `id_korban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `letusan`
--
ALTER TABLE `letusan`
  MODIFY `id_letusan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mengungsi`
--
ALTER TABLE `mengungsi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peringatan_dini`
--
ALTER TABLE `peringatan_dini`
  MODIFY `id_peringatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posko_pengungsian`
--
ALTER TABLE `posko_pengungsian`
  MODIFY `id_posko` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sebaran_wilayah`
--
ALTER TABLE `sebaran_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_penugasan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dampak`
--
ALTER TABLE `dampak`
  ADD CONSTRAINT `dampak_ibfk_1` FOREIGN KEY (`id_letusan`) REFERENCES `letusan` (`id_letusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dampak_ibfk_2` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korban`
--
ALTER TABLE `korban`
  ADD CONSTRAINT `korban_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `letusan`
--
ALTER TABLE `letusan`
  ADD CONSTRAINT `letusan_ibfk_1` FOREIGN KEY (`id_gunung`) REFERENCES `gunung` (`id_gunung`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengungsi`
--
ALTER TABLE `mengungsi`
  ADD CONSTRAINT `mengungsi_ibfk_1` FOREIGN KEY (`id_korban`) REFERENCES `korban` (`id_korban`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengungsi_ibfk_2` FOREIGN KEY (`id_posko`) REFERENCES `posko_pengungsian` (`id_posko`) ON UPDATE CASCADE;

--
-- Constraints for table `peringatan_dini`
--
ALTER TABLE `peringatan_dini`
  ADD CONSTRAINT `peringatan_dini_ibfk_1` FOREIGN KEY (`id_gunung`) REFERENCES `gunung` (`id_gunung`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peringatan_dini_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_posko`) REFERENCES `posko_pengungsian` (`id_posko`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`id_posko`) REFERENCES `posko_pengungsian` (`id_posko`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
