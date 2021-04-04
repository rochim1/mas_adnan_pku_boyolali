-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2021 pada 17.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

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
-- Struktur dari tabel `pasien`
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
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nm_pasien`, `tgl_lahir`, `alamat`, `no_telp`, `pekerjaan`, `tmp_lahir`, `jenis_klm`) VALUES
('RM001', 'Aura Lisa', '2017-06-15', 'Boyolali tlatar sekitar situ', '082229207400', 'Mahasiswa', 'Boyolali', 'Perempuan'),
('RM003', 'Adnan Aziz D', '2021-01-05', 'boyolali', '123', 'mahasiswa', 'Boyolali', 'Laki-Laki'),
('RM004', 'aziz', '2021-01-05', 'asd', '08222123456', 'asd', 'qwe', 'Laki-Laki'),
('RM005', 'aziza', '2021-01-03', 'boyolali lah', '08222123456', 'mahasiswa', 'Boyolali', 'Perempuan'),
('RM006', 'qweew', '2011-11-11', 'qw', '08222123456', 'mahasiswa', 'qwe', 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `kd_peminjam` varchar(6) NOT NULL,
  `nmpeminjam` varchar(150) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` int(15) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `kd_petugas` varchar(6) NOT NULL,
  `nm_petugas` varchar(150) DEFAULT NULL,
  `no_telp` int(15) DEFAULT NULL,
  `jabatan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam_kembali`
--

CREATE TABLE `pinjam_kembali` (
  `kode_pinjam_kmb` varchar(6) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `kd_peminjam` varchar(6) DEFAULT NULL,
  `kd_petugas` varchar(6) DEFAULT NULL,
  `tujuan_pinjam` varchar(100) DEFAULT NULL,
  `lokasi_poli` varchar(100) DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `deadline_kembali` datetime DEFAULT NULL,
  `no_rm` varchar(6) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kroscek` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`kd_peminjam`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indeks untuk tabel `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD PRIMARY KEY (`kode_pinjam_kmb`),
  ADD KEY `kd_peminjam` (`kd_peminjam`),
  ADD KEY `kd_petugas` (`kd_petugas`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjam_kembali`
--
ALTER TABLE `pinjam_kembali`
  ADD CONSTRAINT `no_rm` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`),
  ADD CONSTRAINT `pinjam_kembali_ibfk_1` FOREIGN KEY (`kd_peminjam`) REFERENCES `peminjam` (`kd_peminjam`),
  ADD CONSTRAINT `pinjam_kembali_ibfk_2` FOREIGN KEY (`kd_petugas`) REFERENCES `petugas` (`kd_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
