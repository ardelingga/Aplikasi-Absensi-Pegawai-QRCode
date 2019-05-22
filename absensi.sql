-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2018 at 08:32 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id` bigint(20) NOT NULL,
  `waktu` datetime NOT NULL,
  `id_personal` bigint(20) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `tipe` enum('masuk','pulang') NOT NULL,
  `telat_menit` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id`, `waktu`, `id_personal`, `ket`, `tipe`, `telat_menit`) VALUES
(2025, '2017-11-22 06:31:00', 3, 'manual', 'masuk', 0),
(2027, '2012-08-02 06:47:00', 12, 'AutoQRC', 'masuk', 0),
(2028, '2017-12-06 06:30:00', 12, 'AutoQRC', 'masuk', 0),
(2029, '2017-11-24 06:30:00', 2, 'AutoQRC', 'masuk', 0),
(2030, '2017-11-24 15:00:00', 2, 'AutoQRC', 'pulang', 0),
(2031, '2017-11-25 07:15:00', 2, 'AutoQRC', 'masuk', 15),
(2032, '2017-11-25 14:30:00', 2, 'AutoQRC', 'pulang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pengguna`
--

CREATE TABLE `data_pengguna` (
  `id` bigint(20) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `aktif` enum('Y','T') NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pengguna`
--

INSERT INTO `data_pengguna` (`id`, `uname`, `upass`, `level`, `aktif`, `nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Y', 'Nafi Sulhikam'),
(2, 'lingga', '458d0f67bec87022f05530adf3c4c64a', 'admin', 'Y', 'Ardelingga Pramesta Kusuma');

-- --------------------------------------------------------

--
-- Table structure for table `m_departemen`
--

CREATE TABLE `m_departemen` (
  `id` bigint(20) NOT NULL,
  `nama_departemen` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `aktif` enum('y','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_departemen`
--

INSERT INTO `m_departemen` (`id`, `nama_departemen`, `keterangan`, `aktif`) VALUES
(1, 'Guru Tidak Tetap', 'Personal', 'y'),
(2, 'Guru Tetap', 'Tetap', 'y'),
(3, 'Pimpinan', 'Kepala Sekolah ', 'y'),
(4, 'Staf Tata Usaha', 'TU', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `m_personal`
--

CREATE TABLE `m_personal` (
  `id` bigint(20) NOT NULL,
  `kode_personal` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `aktif` enum('y','t') NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `imei` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_personal`
--

INSERT INTO `m_personal` (`id`, `kode_personal`, `nama`, `alamat`, `no_hp`, `aktif`, `id_departemen`, `imei`) VALUES
(1, '1516002', 'Puspita Fauziyah, S.kom.', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '087745651234', 'y', 1, '121302'),
(2, '1216001', 'Alvi Jazilah, S.pd.i', 'Desa Cipejeuh Kulon Kec. Astanajapura Kab.Cirebon', '083167896513', 'y', 2, '121301'),
(3, '1216003', 'Ahmad Akbar, S. pd.i.', 'Desa Kanci Kec. Astanajapura Kab. Cirebon', '085215642345', 'y', 2, '121303'),
(4, '1216004', 'Sahroni, S. si.', 'Desa Kanci Kec. Astanajapura Kab. Cirebon', '083167852132', 'y', 2, '121304'),
(5, '1216004', 'Besus Abdurrokhman', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '087745234545', 'y', 2, '121305'),
(6, '1216005', 'Khodijah, S.pd.i.', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '085797144345', 'y', 1, '121306'),
(7, '1216006', 'Khidir, S. kom.', 'Desa Kepongpongan Kec. Talun Kab. Cirebon', '085745292412', 'y', 3, '121311'),
(8, '1216007', 'Bahrul hayat S. kom.', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '08654567855566', 'y', 2, '121307'),
(9, '1216008', 'Iin Inayah Hafid, S. pd.', 'Desa Cipejeuh Kulon Kec. Astanajapura Kab.Cirebon', '0877243633221', 'y', 2, '121308'),
(10, '1216009', 'Syamsul Arifin ', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '083156678444', 'y', 4, '121309'),
(11, '1216010', 'Ismi Azizah', 'Desa Munjul Kec. Astanajapura Kab. Cirebon', '089155872434', 'y', 4, '121310'),
(12, '15160028', 'Ardelingga Pramesta Kusuma', 'Desa Sumbakeling Kec. Pancalang Kab. Kuningan', '087847146981', 'y', 2, '355308064800103');

-- --------------------------------------------------------

--
-- Table structure for table `m_set_priode`
--

CREATE TABLE `m_set_priode` (
  `id` bigint(20) NOT NULL,
  `nama_priode` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `aktif` enum('y','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_set_priode`
--

INSERT INTO `m_set_priode` (`id`, `nama_priode`, `tgl_mulai`, `tgl_akhir`, `aktif`) VALUES
(3, 'Tahun Ajaran 2017-2018', '2017-07-03', '2018-07-02', 'y'),
(4, 'Tahun Ajaran 2018 - 2019', '2018-01-22', '2019-01-22', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `m_set_waktu`
--

CREATE TABLE `m_set_waktu` (
  `id` bigint(20) NOT NULL,
  `nama_seting` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `jam_mulai_abs` time NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `jam_batas_pulang` time NOT NULL,
  `jam_batas_masuk` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_set_waktu`
--

INSERT INTO `m_set_waktu` (`id`, `nama_seting`, `jam_mulai_abs`, `jam_masuk`, `jam_pulang`, `jam_batas_pulang`, `jam_batas_masuk`) VALUES
(2, 'Standar', '06:30:00', '07:00:00', '12:40:00', '15:00:00', '07:30:00'),
(3, 'Pengayaan / Ekstrakulikuler', '13:45:00', '14:00:00', '15:00:00', '15:30:00', '14:15:00'),
(4, 'Tata Usaha', '06:00:00', '06:30:00', '15:00:00', '15:30:00', '07:30:00'),
(5, 'Pimpinan', '07:00:00', '07:30:00', '14:00:00', '14:30:00', '08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `opsi_umum`
--

CREATE TABLE `opsi_umum` (
  `id` int(11) NOT NULL,
  `opsi_key` varchar(255) NOT NULL,
  `opsi_val` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opsi_umum`
--

INSERT INTO `opsi_umum` (`id`, `opsi_key`, `opsi_val`) VALUES
(1, 'qrcode_kode', 'b258ba8b478e63407cb3886a2ddbb112122d7c35');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_set_abs`
--

CREATE TABLE `tabel_set_abs` (
  `id` bigint(20) NOT NULL,
  `nama_set_abs` varchar(255) NOT NULL,
  `id_departemen` bigint(20) NOT NULL,
  `id_waktu` bigint(20) NOT NULL,
  `id_priode` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tabel_set_abs`
--

INSERT INTO `tabel_set_abs` (`id`, `nama_set_abs`, `id_departemen`, `id_waktu`, `id_priode`) VALUES
(1, 'Guru Tetap - Standar (2017-2018)', 2, 2, 3),
(2, 'pimpinan', 3, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_trans_abs`
--

CREATE TABLE `tabel_trans_abs` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `id_personal` bigint(20) NOT NULL,
  `tgl_abs` date NOT NULL,
  `waktu_abs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_coba`
--

CREATE TABLE `tb_coba` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelas` varchar(9) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_coba`
--

INSERT INTO `tb_coba` (`id`, `nama`, `kelas`, `alamat`) VALUES
(1, 'Ardelingga Pramesta Kusuma', 'VII', 'Kuningan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_departemen`
--
ALTER TABLE `m_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_personal`
--
ALTER TABLE `m_personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei` (`imei`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indexes for table `m_set_priode`
--
ALTER TABLE `m_set_priode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_set_waktu`
--
ALTER TABLE `m_set_waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opsi_umum`
--
ALTER TABLE `opsi_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_set_abs`
--
ALTER TABLE `tabel_set_abs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_departemen_2` (`id_departemen`,`id_priode`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_waktu` (`id_waktu`),
  ADD KEY `id_priode` (`id_priode`);

--
-- Indexes for table `tabel_trans_abs`
--
ALTER TABLE `tabel_trans_abs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `tb_coba`
--
ALTER TABLE `tb_coba`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2033;
--
-- AUTO_INCREMENT for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_departemen`
--
ALTER TABLE `m_departemen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_personal`
--
ALTER TABLE `m_personal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `m_set_priode`
--
ALTER TABLE `m_set_priode`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_set_waktu`
--
ALTER TABLE `m_set_waktu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `opsi_umum`
--
ALTER TABLE `opsi_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tabel_set_abs`
--
ALTER TABLE `tabel_set_abs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_coba`
--
ALTER TABLE `tb_coba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD CONSTRAINT `data_kehadiran_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `m_personal` (`id`);

--
-- Constraints for table `m_personal`
--
ALTER TABLE `m_personal`
  ADD CONSTRAINT `m_personal_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `m_departemen` (`id`);

--
-- Constraints for table `tabel_set_abs`
--
ALTER TABLE `tabel_set_abs`
  ADD CONSTRAINT `tabel_set_abs_ibfk_4` FOREIGN KEY (`id_departemen`) REFERENCES `m_departemen` (`id`),
  ADD CONSTRAINT `tabel_set_abs_ibfk_5` FOREIGN KEY (`id_waktu`) REFERENCES `m_set_waktu` (`id`),
  ADD CONSTRAINT `tabel_set_abs_ibfk_6` FOREIGN KEY (`id_priode`) REFERENCES `m_set_priode` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
