-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2021 at 11:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

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
  `no_rm` varchar(6) NOT NULL,
  `nm_pasien` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `jenis_klm` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nm_pasien`, `tgl_lahir`, `alamat`, `no_telp`, `pekerjaan`, `tmp_lahir`, `jenis_klm`) VALUES
('RM001', 'Aura Lisa', '2017-06-15', 'Boyolali tlatar sekitar situ', '082229207400', 'Mahasiswa', 'Boyolali', 'Perempuan'),
('RM003', 'Adnan Aziz D', '2021-01-05', 'boyolali', '123', 'mahasiswa', 'Boyolali', 'Laki-Laki'),
('RM004', 'azize', '2021-01-05', 'asd', '08222123456', 'asd', 'qwe', 'Laki-Laki'),
('RM005', 'azizad', '2021-01-03', 'boyolali lah', '08222123456', 'mahasiswa', 'Boyolali', 'Perempuan'),
('RM016', 'asdasdas', '1999-12-12', 'asd', '12312312', 'asd', 'asdasdasd', 'Perempuan'),
('RM017', 'asd', '1999-12-12', 'asd', '123123123', 'a', 'qw', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `kd_peminjam` varchar(6) NOT NULL,
  `nmpeminjam` varchar(150) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`kd_peminjam`, `nmpeminjam`, `alamat`, `no_telp`, `keterangan`) VALUES
('PJ001', 'Siti Halizah', 'Bantul City', '123123123', 'tidak ada keluhan sehat wal afiat'),
('PJ002', 'adnanaz', 'asde', '082229207400', 'sehat'),
('PJ03', 'lisaaa', 'adada', '12312312312', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_pinjam` varchar(5) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `kd_petugas` varchar(5) NOT NULL,
  `tujuan_pinjam` varchar(255) DEFAULT NULL,
  `lokasi_pinjam` varchar(255) DEFAULT NULL,
  `tanggal_hrs_kmb` datetime DEFAULT NULL,
  `no_rm` varchar(5) DEFAULT NULL,
  `nm_pasien` varchar(255) DEFAULT NULL,
  `tgl_lahir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no_pinjam`, `tgl_pinjam`, `kd_petugas`, `tujuan_pinjam`, `lokasi_pinjam`, `tanggal_hrs_kmb`, `no_rm`, `nm_pasien`, `tgl_lahir`) VALUES
('PM001', '2021-02-12 00:00:00', 'KP002', 'bebas', 'solo', '2021-02-17 00:00:00', 'RM001', 'auralisa', '2021-02-11 00:00:00');

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
('KP001', 'Adnan Aziz E', '082229207412', 'Perawat'),
('KP002', 'asde', '123123123', 'RI-Melati'),
('KP003', 'asd', '123123123', 'RI-Melati');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_kembali`
--

CREATE TABLE `pinjam_kembali` (
  `kode_pinjam_kmb` varchar(6) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `kd_peminjam` varchar(6) DEFAULT NULL,
  `kd_petugas` varchar(6) DEFAULT NULL,
  `tujuan_pinjam` varchar(100) DEFAULT NULL,
  `lokasi_poli` varchar(100) DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `tenggat_kembali` datetime DEFAULT NULL,
  `no_rm` varchar(6) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kroscek` varchar(100) DEFAULT NULL
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
(1, 1, 'john', 'doe', 'john_doe@example.com', '0192023a7bbd73250516f069df18b500'),
(2, 2, 'ahsan', 'zameer', 'ahsan@example.com', '3d68b18bd9042ad3dc79643bde1ff351'),
(3, 3, 'sarah', 'khan', 'sarah@example.com', 'ec26202651ed221cf8f993668c459d46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(5) NOT NULL,
  `user_role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `user_role`) VALUES
(1, 'superuser'),
(2, 'admin'),
(3, 'peminjam');

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
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indexes for table `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD PRIMARY KEY (`kode_pinjam_kmb`),
  ADD KEY `kd_peminjam` (`kd_peminjam`),
  ADD KEY `kd_petugas` (`kd_petugas`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
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
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kd_petugas`) REFERENCES `petugas` (`kd_petugas`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`);

--
-- Constraints for table `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD CONSTRAINT `no_rm` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`),
  ADD CONSTRAINT `pinjam_kembali_ibfk_1` FOREIGN KEY (`kd_peminjam`) REFERENCES `peminjam` (`kd_peminjam`),
  ADD CONSTRAINT `pinjam_kembali_ibfk_2` FOREIGN KEY (`kd_petugas`) REFERENCES `petugas` (`kd_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
