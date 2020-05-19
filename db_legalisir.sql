-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3311
-- Generation Time: Apr 27, 2020 at 02:39 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_legalisir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bioadm`
--

CREATE TABLE IF NOT EXISTS `tbl_bioadm` (
  `bioadmId` int(11) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `NAMA_LGKP` varchar(50) NOT NULL,
  `JENIS_KLMIN` varchar(10) NOT NULL,
  `TMPT_LHR` varchar(100) NOT NULL,
  `TGL_LHR` date NOT NULL,
  `NO_AKTA_LHR` varchar(16) NOT NULL,
  `GOL_DRH` varchar(10) NOT NULL,
  `AGAMA` varchar(20) NOT NULL,
  `STAT_KWN` varchar(25) NOT NULL,
  `NO_AKTA_KWN` varchar(16) NOT NULL,
  `TGL_KWN` date NOT NULL,
  `NO_AKTA_CRAI` varchar(16) NOT NULL,
  `TGL_CRAI` date NOT NULL,
  `STAT_HBKEL` varchar(25) NOT NULL,
  `PDDK_AKH` varchar(10) NOT NULL,
  `JENIS_PKRJN` varchar(25) NOT NULL,
  `NAMA_LGKP_IBU` varchar(50) NOT NULL,
  `NAMA_LGKP_AYAH` varchar(50) NOT NULL,
  `NO_KK` varchar(16) NOT NULL,
  `terhapus` tinyint(1) NOT NULL,
  `dibuatOleh` int(11) NOT NULL,
  `waktuDibuat` datetime NOT NULL,
  `diubahOleh` int(11) NOT NULL,
  `waktuDiubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bioadm`
--

INSERT INTO `tbl_bioadm` (`bioadmId`, `NIK`, `NAMA_LGKP`, `JENIS_KLMIN`, `TMPT_LHR`, `TGL_LHR`, `NO_AKTA_LHR`, `GOL_DRH`, `AGAMA`, `STAT_KWN`, `NO_AKTA_KWN`, `TGL_KWN`, `NO_AKTA_CRAI`, `TGL_CRAI`, `STAT_HBKEL`, `PDDK_AKH`, `JENIS_PKRJN`, `NAMA_LGKP_IBU`, `NAMA_LGKP_AYAH`, `NO_KK`, `terhapus`, `dibuatOleh`, `waktuDibuat`, `diubahOleh`, `waktuDiubah`) VALUES
(1, '99728129', 'Giska9', 'P', 'Yogyakarta9', '2020-02-18', '88726129', 'B', 'ISLAM', 'NIKAH', '87746129', '2020-02-19', '0', '0000-00-00', 'IBU', 'S1', 'swasta9', 'namaibu9', 'namaayah9', '21474836479', 0, 1, '2020-02-21 08:30:54', 1, '2020-02-21 08:52:37'),
(2, '71627818', 'dimas8', 'L', 'Yogyakarta8', '2020-03-08', '1219392108', 'B', 'ISLAM', 'BELUM_NIKAH', '', '0000-00-00', '', '0000-00-00', 'ANAK', 'SMA', 'swasta8', 'ambar8', 'agus8', '1277217118', 0, 4, '2020-03-09 05:20:29', 4, '2020-03-09 05:31:08'),
(5, '321', 'Gasta', 'L', 'Yogyakarta', '1992-06-05', '65421', 'B', 'Islam', 'Belum Menikah', '0', '0000-00-00', '0', '0000-00-00', 'Anak', 'S1', 'Swasta', 'Trikora', 'Hery', '8893991', 0, 4, '2020-03-10 11:19:41', 0, '0000-00-00 00:00:00'),
(6, '123', 'Gasta2', 'L', 'Yogyakarta2', '1992-07-05', '123456', 'A', 'Islam', 'Belum Menikah', '0', '0000-00-00', '0', '0000-00-00', 'Suami', 'D3', 'Swasta2', 'Trikora2', 'Hery2', '1993988', 0, 4, '2020-03-10 11:19:41', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenisdok`
--

CREATE TABLE IF NOT EXISTS `tbl_jenisdok` (
  `jenisdokId` int(11) NOT NULL,
  `kode` varchar(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `terhapus` tinyint(1) NOT NULL,
  `dibuatOleh` int(11) NOT NULL,
  `waktuDibuat` datetime NOT NULL,
  `diubahOleh` int(11) NOT NULL,
  `waktuDiubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenisdok`
--

INSERT INTO `tbl_jenisdok` (`jenisdokId`, `kode`, `nama`, `terhapus`, `dibuatOleh`, `waktuDibuat`, `diubahOleh`, `waktuDiubah`) VALUES
(1, 'KK', 'Kartu Keluarga', 0, 4, '2020-03-09 04:31:55', 0, '0000-00-00 00:00:00'),
(2, 'KTP', 'Kartu Tanda Penduduk', 0, 4, '2020-03-09 04:32:10', 0, '0000-00-00 00:00:00'),
(3, 'AB', 'Akta Bantul', 0, 4, '2020-03-09 04:32:32', 4, '2020-03-09 04:33:53'),
(4, 'ALB', 'Akta Luar Bantul', 0, 4, '2020-03-09 04:32:52', 0, '0000-00-00 00:00:00'),
(5, 'tc', 'tes', 1, 4, '2020-03-09 04:34:13', 4, '2020-03-09 04:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pejabat`
--

CREATE TABLE IF NOT EXISTS `tbl_pejabat` (
  `pejabatId` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `terhapus` tinyint(1) NOT NULL,
  `dibuatOleh` int(11) NOT NULL,
  `waktuDibuat` datetime NOT NULL,
  `diubahOleh` int(11) NOT NULL,
  `waktuDiubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pejabat`
--

INSERT INTO `tbl_pejabat` (`pejabatId`, `nip`, `nama`, `jabatan`, `terhapus`, `dibuatOleh`, `waktuDibuat`, `diubahOleh`, `waktuDiubah`) VALUES
(1, '12345', 'Gasta45', 'Direktur45', 1, 1, '2020-02-06 13:07:09', 1, '2020-02-07 02:54:22'),
(2, '321', 'Giska', 'Sekertaris', 0, 1, '2020-02-07 01:54:24', 0, '0000-00-00 00:00:00'),
(3, '890', 'Rio', 'Manager', 0, 1, '2020-02-07 02:54:55', 0, '0000-00-00 00:00:00'),
(4, '7654321', 'Tes Aja1', 'Sekertaris1', 1, 1, '2020-02-09 11:16:15', 1, '2020-02-09 11:16:35'),
(5, '8891', 'ayu1', 'Sekertaris II8', 1, 6, '2020-03-02 13:50:12', 6, '2020-03-02 13:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regleg`
--

CREATE TABLE IF NOT EXISTS `tbl_regleg` (
  `reglegId` int(11) NOT NULL,
  `pejabatId` int(11) NOT NULL,
  `jenisdokId` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_reg` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `terhapus` tinyint(1) NOT NULL,
  `dibuatOleh` int(11) NOT NULL,
  `waktuDibuat` datetime NOT NULL,
  `diubahOleh` int(11) NOT NULL,
  `waktuDiubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_regleg`
--

INSERT INTO `tbl_regleg` (`reglegId`, `pejabatId`, `jenisdokId`, `nik`, `no_reg`, `tanggal`, `terhapus`, `dibuatOleh`, `waktuDibuat`, `diubahOleh`, `waktuDiubah`) VALUES
(1, 2, 4, '876', 1, '2020-04-01', 0, 4, '2020-04-27 01:47:20', 0, '0000-00-00 00:00:00'),
(2, 3, 4, '876', 1, '2020-04-03', 0, 4, '2020-04-27 01:51:24', 0, '0000-00-00 00:00:00'),
(3, 3, 4, '876', 2, '2020-04-27', 0, 4, '2020-04-27 01:52:38', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `statusId` tinyint(4) NOT NULL COMMENT 'status id',
  `status` varchar(50) NOT NULL COMMENT 'status text'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`statusId`, `status`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `statusId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `statusId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@admin.com', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'Saya Admin', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2017-06-19 09:22:53'),
(2, 'manager@bewithdhanu.in', '$2y$10$Gkl9ILEdGNoTIV9w/xpf3.mSKs0LB1jkvvPKK7K0PSYDsQY7GE9JK', 'Manager', '9890098900', 2, 0, 1, '2016-12-09 17:49:56', 1, '2017-06-19 09:22:29'),
(3, 'employee@bewithdhanu.in', '$2y$10$MB5NIu8i28XtMCnuExyFB.Ao1OXSteNpCiZSiaMSRPQx1F1WLRId2', 'Employee', '9890098900', 3, 0, 1, '2016-12-09 17:50:22', 1, '2017-06-19 09:23:21'),
(4, 'user@user.com', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'Fani', '0858659512', 3, 0, 1, '2020-02-05 05:13:47', 1, '2020-02-05 05:14:49'),
(6, 'boby@yahoo.com', '$2y$10$Gl44n./CI/0xaHjOV7vryeESGwubojAZxJEPjMar7lhH8hJ6TzK/q', 'Boby', '5432123456', 3, 0, 1, '2020-03-02 13:45:20', NULL, NULL),
(5, 'giska98@yahoo.com', '$2y$10$9yWhQoXPO90E0iu87RTQN.uJ2fmzDrcBrpV3eZwXLsjAAKdcenYBu', 'Giska', '0857257710', 2, 0, 1, '2020-02-07 01:55:45', NULL, NULL),
(7, 'andri1@gmail.com', '$2y$10$nZzfGBrBjA3tZ1PI0ZVqPOJbzVMqBEJ7H1i1I5t5p5yJZ5kbNh4.2', 'Andrikusuma1', '0858659581', 3, 0, 1, '2020-04-21 06:03:24', 1, '2020-04-21 06:03:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bioadm`
--
ALTER TABLE `tbl_bioadm`
  ADD PRIMARY KEY (`bioadmId`),
  ADD UNIQUE KEY `NIK` (`NIK`);

--
-- Indexes for table `tbl_jenisdok`
--
ALTER TABLE `tbl_jenisdok`
  ADD PRIMARY KEY (`jenisdokId`);

--
-- Indexes for table `tbl_pejabat`
--
ALTER TABLE `tbl_pejabat`
  ADD PRIMARY KEY (`pejabatId`);

--
-- Indexes for table `tbl_regleg`
--
ALTER TABLE `tbl_regleg`
  ADD PRIMARY KEY (`reglegId`),
  ADD KEY `pejabatId` (`pejabatId`),
  ADD KEY `jenisdokId` (`jenisdokId`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `statusId` (`statusId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bioadm`
--
ALTER TABLE `tbl_bioadm`
  MODIFY `bioadmId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_jenisdok`
--
ALTER TABLE `tbl_jenisdok`
  MODIFY `jenisdokId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_pejabat`
--
ALTER TABLE `tbl_pejabat`
  MODIFY `pejabatId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_regleg`
--
ALTER TABLE `tbl_regleg`
  MODIFY `reglegId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `statusId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'status id',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_regleg`
--
ALTER TABLE `tbl_regleg`
  ADD CONSTRAINT `tbl_regleg_ibfk_1` FOREIGN KEY (`pejabatId`) REFERENCES `tbl_pejabat` (`pejabatId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_regleg_ibfk_2` FOREIGN KEY (`jenisdokId`) REFERENCES `tbl_jenisdok` (`jenisdokId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
