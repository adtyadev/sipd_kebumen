-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 09:49 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `gp`
--

CREATE TABLE `gp` (
  `id_gp` int(11) NOT NULL,
  `nama_gp` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gp`
--

INSERT INTO `gp` (`id_gp`, `nama_gp`, `tarif`) VALUES
(1, 'IIIC', 350000),
(2, 'IIID', 425000),
(4, 'IVA', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_profesi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_profesi`) VALUES
(1, 'Staff bidang PDE'),
(2, 'Staff PDE');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_gp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `id_jabatan`, `id_gp`) VALUES
(111, 'Pegawai X', 1, 4),
(122, 'Pegawai 1', 1, 1),
(123, 'Pegawai 2', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sppd`
--

CREATE TABLE `sppd` (
  `no_sppd` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `maksud` longtext NOT NULL,
  `rute` varchar(50) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `pembuat_daftar` varchar(50) NOT NULL,
  `biaya_pergi` int(11) NOT NULL,
  `biaya_pulang` int(11) NOT NULL,
  `akomodasi` int(11) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `id_transport_berangkat` int(11) NOT NULL,
  `id_transport_berakhir` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sppd`
--

INSERT INTO `sppd` (`no_sppd`, `nip`, `maksud`, `rute`, `tgl_berangkat`, `tgl_berakhir`, `pembuat_daftar`, `biaya_pergi`, `biaya_pulang`, `akomodasi`, `jumlah_biaya`, `id_transport_berangkat`, `id_transport_berakhir`, `status`) VALUES
(1, 122, 'coba wc', 'Bandung', '2018-10-23', '2018-10-24', 'ayas', 150000, 200000, 0, 1050000, 3, 2, 'Selesai'),
(2, 122, 'Jalan-jalan', 'Jakarta', '2018-10-01', '2018-10-03', 'ayas', 150000, 150000, 0, 1350000, 3, 3, 'Masuk Keuangan'),
(3, 123, 'Jalan-jalan', 'Semarang', '2018-10-05', '2018-10-08', 'ayas', 350000, 350000, 0, 2400000, 1, 1, 'Pengajuan ke SDM Pusat'),
(4, 123, 'Kunjungan Industri', 'Semarang', '2018-09-23', '2018-09-25', 'ayas', 250000, 250000, 0, 1775000, 1, 1, 'Masuk Keuangan'),
(5, 122, 'cari oleole', 'Solo', '2018-01-21', '2018-01-23', 'Ayas', 100000, 100000, 0, 1250000, 3, 2, 'Masuk Keuangan'),
(6, 111, '', 'Surakarta', '2018-01-01', '2018-01-03', 'Ayas', 10000, 10000, 0, 1520000, 1, 1, 'Pengajuan ke SDM Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `id_transportasi` int(11) NOT NULL,
  `nama_transportasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id_transportasi`, `nama_transportasi`) VALUES
(1, 'Kereta Api'),
(2, 'Pesawat'),
(3, 'Bus/Travel');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_user`) VALUES
('ayas', 'c3ec0f7b054e729c5a716c8125839829', 'ayassss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gp`
--
ALTER TABLE `gp`
  ADD PRIMARY KEY (`id_gp`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`no_sppd`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gp`
--
ALTER TABLE `gp`
  MODIFY `id_gp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id_transportasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
