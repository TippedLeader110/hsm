-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 12:56 AM
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
-- Database: `hsm`
--
CREATE DATABASE IF NOT EXISTS `hsm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hsm`;



-- --------------------------------------------------------

--
-- Table structure for table `a_users`
--

DROP TABLE IF EXISTS `a_users`;
CREATE TABLE `a_users` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1 COMMENT '1 = admin/direktur',
  `nohp` varchar(14) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_users`
--

INSERT INTO `a_users` (`id`, `nama`, `username`, `password`, `email`, `level`, `nohp`, `status`) VALUES
(10, '', 'admin', '$2y$10$RRtPYlAepicQlaspFrbfneJHaYdnADcJfyE9pXF7mpZW.F7jIhGqa', '', 1, NULL, 1),
(11, 'Muhammad Bayhaqi Daulay', 'test', '$2y$10$pdM8cY8Idjcacynd6lUZ.O.nGZF1tUT0LIU549UvuDtyApXhCeI.u', 'bayhaqi101@gmail.com', 1, '089686434951', 1),
(12, '13131', '3121', '$2y$10$zvxDRvdE2qHKC.jQbDs56.c0.vTDHTS6GQDG18cwS08lgPH/d59bi', '123131@gmail.com', 1, '132131', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bonus_karyawan`
--

DROP TABLE IF EXISTS `bonus_karyawan`;
CREATE TABLE `bonus_karyawan` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `id_bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bonus_karyawan`
--

INSERT INTO `bonus_karyawan` (`id`, `id_karyawan`, `id_kriteria`, `nilai`, `id_bonus`) VALUES
(7, 1, 1, 4, 1),
(8, 1, 2, 5, 1),
(9, 5, 1, 3, 1),
(10, 5, 2, 4, 1),
(11, 4, 1, 5, 1),
(12, 4, 2, 4, 1),
(14, 2, 2, 4, 1),
(15, 13, 1, 4, 1),
(16, 13, 2, 5, 1),
(17, 8, 1, 5, 1),
(18, 8, 2, 4, 1),
(19, 7, 1, 5, 1),
(20, 7, 2, 4, 1),
(21, 1, 3, 4, 1),
(22, 2, 3, 3, 1),
(23, 4, 3, 2, 1),
(24, 5, 3, 5, 1),
(25, 7, 3, 4, 1),
(26, 8, 3, 3, 1),
(27, 9, 1, 4, 1),
(28, 9, 2, 1, 1),
(29, 9, 3, 5, 1),
(30, 10, 1, 5, 1),
(31, 10, 2, 4, 1),
(32, 10, 3, 3, 1),
(33, 11, 1, 3, 1),
(34, 11, 2, 5, 1),
(35, 11, 3, 1, 1),
(36, 12, 1, 3, 1),
(37, 12, 2, 4, 1),
(38, 12, 3, 1, 1),
(39, 13, 3, 1, 1),
(40, 1, 4, 3, 1),
(41, 1, 5, 5, 1),
(42, 2, 1, 4, 1),
(43, 2, 4, 2, 1),
(44, 2, 5, 4, 1),
(45, 4, 4, 5, 1),
(46, 4, 5, 2, 1),
(47, 5, 4, 5, 1),
(48, 5, 5, 3, 1),
(49, 7, 4, 4, 1),
(50, 7, 5, 4, 1),
(51, 8, 4, 5, 1),
(52, 8, 5, 4, 1),
(53, 14, 1, 4, 1),
(54, 14, 2, 5, 1),
(55, 14, 3, 4, 1),
(56, 14, 4, 3, 1),
(57, 14, 5, 4, 1),
(58, 15, 1, 3, 1),
(59, 15, 2, 5, 1),
(60, 15, 3, 3, 1),
(61, 15, 4, 4, 1),
(62, 15, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` int(11) NOT NULL COMMENT '0=Perempuan, 1 = Laki Laki',
  `nohp` text NOT NULL ,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `alamat`, `jenis_kelamin`, `nohp`, `status`) VALUES
(1, 'Dani Sigit', ' 222 ', 1, '08123131314222', 1),
(2, 'Mulyono S.', '  <select class=\"custom-select\" id=\"inputGroupSelect01\">\r\n    <option selected>Choose...</option>\r\n    <option value=\"1\">One</option>\r\n    <option value=\"2\">Two</option>\r\n    <option value=\"3\">Three</option>\r\n  </select>', 1, '08123131314', 1),
(4, 'Darti Iswani', ' 13131', 0, '213131', 1),
(5, 'Adiansyah', ' Jalan Prof.Dr Hamka\r\nNo 56 ', 1, '089686434951', 1),
(7, 'Katika Harum', ' awdawd', 0, '12313', 1),
(8, 'Tiwi Amelia', ' 123131', 0, '31313123', 1),
(14, 'Desi Agustina', 'Jalan Prof.Dr Hamka\r\nNo 56', 1, '12313', 1),
(15, 'Ayu Harahap', 'Jalan Prof.Dr Hamka\r\nNo 56', 0, '1313', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `nama` text NOT NULL,
  `bobot` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `minmax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `id_sesi`, `nama`, `bobot`, `jenis`, `minmax`) VALUES
(1, 1, 'Lama Bekerja', 25, 1, 0),
(2, 1, 'Ketaatan', 25, 1, 1),
(3, 1, 'Ketelitian dan Tanggung Jawab', 20, 1, 1),
(4, 1, 'Kedisplinan', 15, 1, 0),
(5, 1, 'Kehadiran', 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_admin`
--

DROP TABLE IF EXISTS `log_admin`;
CREATE TABLE `log_admin` (
  `id_log` int(11) NOT NULL,
  `ip` text NOT NULL,
  `id_admin` int(11) NOT NULL,
  `waktu` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` (`id_log`, `ip`, `id_admin`, `waktu`, `status`) VALUES
(1, '::1', 11, '2021-04-01 19:51:07', 'Login Admin'),
(2, '::1', 10, '2021-04-02 18:02:16', 'Login Admin'),
(3, '::1', 10, '2021-04-05 06:13:06', 'Login Admin'),
(4, '::1', 10, '2021-04-27 04:20:49', 'Login Admin'),
(5, '::1', 10, '2021-04-27 04:26:04', 'Login Admin'),
(6, '::1', 10, '2021-04-29 08:01:00', 'Login Admin'),
(7, '::1', 10, '2021-06-29 10:05:00', 'Login Admin'),
(8, '::1', 10, '2021-07-02 20:13:04', 'Login Admin'),
(9, '::1', 10, '2021-07-02 20:16:05', 'Login Admin'),
(10, '::1', 10, '2021-07-03 04:25:37', 'Login Admin'),
(11, '::1', 10, '2021-07-03 04:27:38', 'Login Admin'),
(12, '::1', 10, '2021-07-03 04:38:06', 'Login Admin'),
(13, '::1', 10, '2021-07-03 08:10:35', 'Login Admin'),
(14, '::1', 10, '2021-07-03 11:08:53', 'Login Admin'),
(15, '192.168.43.1', 10, '2021-07-03 12:15:51', 'Login Admin'),
(16, '::1', 10, '2021-07-08 06:58:10', 'Login Admin'),
(17, '::1', 10, '2021-07-08 10:09:18', 'Login Admin'),
(18, '::1', 10, '2021-07-08 10:58:42', 'Login Admin'),
(19, '::1', 10, '2021-07-08 11:01:47', 'Login Admin'),
(20, '::1', 10, '2021-07-08 11:14:02', 'Login Admin'),
(21, '::1', 11, '2021-07-08 11:16:35', 'Login Admin'),
(22, '::1', 10, '2021-07-08 11:22:28', 'Login Admin'),
(23, '::1', 10, '2021-07-11 09:12:38', 'Login Admin'),
(24, '::1', 10, '2021-07-15 00:44:13', 'Login Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `log_admin_u`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `log_admin_u`;
CREATE TABLE `log_admin_u` (
`id_log` int(11)
,`ip` text
,`id_admin` int(11)
,`waktu` text
,`status` text
,`nama` text
,`username` varchar(32)
,`password` varchar(128)
,`email` text
,`level` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilai_pegawai`
-- (See below for the actual view)
--

-- --------------------------------------------------------

--
-- Table structure for table `sesi_bonus`
--

DROP TABLE IF EXISTS `sesi_bonus`;
CREATE TABLE `sesi_bonus` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `mulai` text NOT NULL,
  `akhir` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sesi_bonus`
--

INSERT INTO `sesi_bonus` (`id`, `nama`, `mulai`, `akhir`, `status`) VALUES
(1, '2021', '2021-04-01', '2021-04-03', 1),
(2, 'ww', '2021-04-27', '2021-05-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token_api`
--

DROP TABLE IF EXISTS `token_api`;
CREATE TABLE `token_api` (
  `id` int(11) NOT NULL,
  `token_key` text NOT NULL,
  `expired` text NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `log_admin_u`
--
DROP TABLE IF EXISTS `log_admin_u`;

DROP VIEW IF EXISTS `log_admin_u`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `log_admin_u`  AS  select `b`.`id_log` AS `id_log`,`b`.`ip` AS `ip`,`b`.`id_admin` AS `id_admin`,`b`.`waktu` AS `waktu`,`b`.`status` AS `status`,`a`.`nama` AS `nama`,`a`.`username` AS `username`,`a`.`password` AS `password`,`a`.`email` AS `email`,`a`.`level` AS `level` from (`a_users` `a` join `log_admin` `b` on(`b`.`id_admin` = `a`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `nilai_pegawai`

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_users`
--
ALTER TABLE `a_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus_karyawan`
--
ALTER TABLE `bonus_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_karyawan`),
  ADD KEY `id_bonus` (`id_kriteria`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sesi` (`id_sesi`);

--
-- Indexes for table `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `sesi_bonus`
--
ALTER TABLE `sesi_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_api`
--
ALTER TABLE `token_api`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_users`
--
ALTER TABLE `a_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bonus_karyawan`
--
ALTER TABLE `bonus_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sesi_bonus`
--
ALTER TABLE `sesi_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token_api`
--
ALTER TABLE `token_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

