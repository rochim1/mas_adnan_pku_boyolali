-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 07:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_rm` varchar(15) NOT NULL,
  `nm_pasien` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `jenis_klm` varchar(25) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `recent_use` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nm_pasien`, `tgl_lahir`, `alamat`, `no_telp`, `pekerjaan`, `tmp_lahir`, `jenis_klm`, `tgl_daftar`, `recent_use`) VALUES
('RM00120210417', 'muhammad nur rochim', '2021-03-30', 'caran', '123', 'programer', 'klaten', 'Laki-Laki', '2021-04-17', '2021-04-17'),
('RM1202', 'recover retensi', '2021-04-01', 'caran', '123', 'pra sukses', 'rumah sakit', 'Laki-Laki', '2021-04-17', '2021-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `kd_peminjam` varchar(6) NOT NULL,
  `nmpeminjam` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`kd_peminjam`, `nmpeminjam`, `email`, `password`, `alamat`, `no_telp`, `keterangan`) VALUES
('PJ001', 'muhammad nur rochim', NULL, NULL, 'jakal', '123', 'mantap'),
('PJ002', 'luviana', NULL, NULL, 'moyudan', '213', 'mantap'),
('PJ003', 'muhammad nur rochim', 'peminjam@mail.com', 'a0a2f49fce72297e6a424581b46cb8ba', 'jakal', '1234', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_pinjam` varchar(5) NOT NULL,
  `kd_peminjam` varchar(6) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `kd_petugas` varchar(5) NOT NULL,
  `tujuan_pinjam` varchar(255) DEFAULT NULL,
  `lokasi_pinjam` varchar(255) DEFAULT NULL,
  `tanggal_hrs_kmb` datetime DEFAULT NULL,
  `no_rm` varchar(15) DEFAULT NULL,
  `nm_pasien` varchar(255) DEFAULT NULL,
  `tgl_lahir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no_pinjam`, `kd_peminjam`, `tgl_pinjam`, `kd_petugas`, `tujuan_pinjam`, `lokasi_pinjam`, `tanggal_hrs_kmb`, `no_rm`, `nm_pasien`, `tgl_lahir`) VALUES
('PM002', 'PJ001', '2021-04-17 08:11:06', 'KP001', 'qwqwq', 'qwqwqw', '2021-04-16 00:00:00', 'RM1202', 'recover retensi', '2021-04-01 00:00:00'),
('PM003', 'PJ001', '2021-04-17 00:00:00', 'KP001', 'asasa', 'qwqwqw', '2021-04-19 00:00:00', 'RM00120210417', 'muhammad nur rochim', '2021-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kd_petugas` varchar(6) NOT NULL,
  `nm_petugas` varchar(150) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `bagian` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kd_petugas`, `nm_petugas`, `no_telp`, `bagian`) VALUES
('KP001', 'muna nur afiyah', '123', 'poli tampan'),
('KP002', 'desi indah dwiningtyas', '123', 'llll');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_kembali`
--

CREATE TABLE `pinjam_kembali` (
  `kd_pinjam_kembali` varchar(6) NOT NULL,
  `kd_peminjam` varchar(6) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `kd_petugas` varchar(6) NOT NULL,
  `tujuan_pinjam` varchar(255) DEFAULT NULL,
  `lokasi_pinjam` varchar(255) DEFAULT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `no_rm` varchar(15) DEFAULT NULL,
  `nm_pasien` varchar(255) DEFAULT NULL,
  `tgl_lahir` datetime DEFAULT NULL,
  `status_pjm` text NOT NULL DEFAULT 'berlangsung',
  `kroscek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retensi`
--

CREATE TABLE `retensi` (
  `no_rm` varchar(6) NOT NULL,
  `nm_pasien` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `jenis_klm` varchar(25) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_retensi` date NOT NULL,
  `tgl_restore` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(5) NOT NULL,
  `user_role_id` int(5) DEFAULT NULL,
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_role_id`, `nama_depan`, `nama_belakang`, `email`, `password`) VALUES
(1, 1, 'john', 'doe', 'kepalarm@gmail.com', '0192023a7bbd73250516f069df18b500'),
(2, 2, 'ahsan', 'zameer', 'ahsan@example.com', '3d68b18bd9042ad3dc79643bde1ff351');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`kd_peminjam`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_pinjam`),
  ADD KEY `kd_petugas` (`kd_petugas`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `peminjam_fk_1` (`kd_peminjam`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indexes for table `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD PRIMARY KEY (`kd_pinjam_kembali`),
  ADD KEY `peminjam` (`kd_peminjam`),
  ADD KEY `petugas_fk` (`kd_petugas`),
  ADD KEY `pasien_fk` (`no_rm`);

--
-- Indexes for table `retensi`
--
ALTER TABLE `retensi`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `pasien` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjam_fk_1` FOREIGN KEY (`kd_peminjam`) REFERENCES `peminjam` (`kd_peminjam`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas` FOREIGN KEY (`kd_petugas`) REFERENCES `petugas` (`kd_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD CONSTRAINT `pasien_fk` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjam` FOREIGN KEY (`kd_peminjam`) REFERENCES `peminjam` (`kd_peminjam`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_fk` FOREIGN KEY (`kd_petugas`) REFERENCES `petugas` (`kd_petugas`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
