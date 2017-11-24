-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 07:06 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pklbbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `no_admin` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alat_berat`
--

CREATE TABLE `alat_berat` (
  `no_alat_berat` int(5) NOT NULL,
  `no_analisis` int(5) NOT NULL,
  `no_proyek` int(5) NOT NULL,
  `nama_alat_berat` varchar(30) NOT NULL,
  `unit` decimal(10,2) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_berat`
--

INSERT INTO `alat_berat` (`no_alat_berat`, `no_analisis`, `no_proyek`, `nama_alat_berat`, `unit`, `harga_satuan`) VALUES
(6, 2, 0, 'M KKKK', '99.00', '99999.00'),
(10, 9, 0, 'HJGJHDGSH', '678.00', '99.00'),
(11, 12, 0, 'jdshjkh', '787.00', '7766.00'),
(12, 13, 0, 'jjhh', '6786.00', '655.00'),
(16, 8, 0, 'hjkhk', '88.00', '98.00');

-- --------------------------------------------------------

--
-- Table structure for table `analisis_bahan`
--

CREATE TABLE `analisis_bahan` (
  `no_analisis_bahan` int(5) NOT NULL,
  `kode_barang` varchar(14) NOT NULL,
  `no_analisis` int(5) NOT NULL,
  `no_proyek` int(5) NOT NULL,
  `perkiraan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis_bahan`
--

INSERT INTO `analisis_bahan` (`no_analisis_bahan`, `kode_barang`, `no_analisis`, `no_proyek`, `perkiraan`) VALUES
(1, 'KJ009', 1, 0, '1.00'),
(2, '', 1, 0, '7.00'),
(3, '', 1, 0, '7.00'),
(4, 'n', 1, 0, '89.00'),
(5, 'KJ009', 1, 0, '6.00'),
(6, 'KJ009', 2, 0, '90.00'),
(7, 'nxgd', 2, 0, '66.00'),
(8, 'n', 3, 0, '67.00'),
(9, 'KJ009', 3, 0, '4.00'),
(10, 'KJ009', 3, 0, '11.00'),
(11, 'KJ009', 3, 0, '12.00'),
(12, 'nxgd', 3, 0, '123123.00'),
(15, 'KJ009', 8, 0, '56.00'),
(16, 'nxgd', 9, 0, '55.00'),
(17, 'KJ009', 12, 0, '44.00'),
(18, 'nxgd', 13, 0, '67.00');

-- --------------------------------------------------------

--
-- Table structure for table `analisis_pekerjaan`
--

CREATE TABLE `analisis_pekerjaan` (
  `no_analisis` int(5) NOT NULL,
  `kode_kerja` varchar(14) NOT NULL,
  `no_proyek` int(5) NOT NULL,
  `item_bayar` varchar(10) NOT NULL,
  `satuan_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis_pekerjaan`
--

INSERT INTO `analisis_pekerjaan` (`no_analisis`, `kode_kerja`, `no_proyek`, `item_bayar`, `satuan_bayar`) VALUES
(8, 'hjkgjhg', 13, 'jhsgjshh', 'jhjfdghs'),
(9, 'hjkgjhg', 14, 'fdhsdgha', 'gqjetywtty'),
(11, 'lla', 14, 'nisa', 'nsjkaK'),
(12, 'lla', 15, 'uyyiuy', 'yuiyiuy');

-- --------------------------------------------------------

--
-- Table structure for table `analisis_tenaga_kerja`
--

CREATE TABLE `analisis_tenaga_kerja` (
  `no_analisis_tenaga` int(5) NOT NULL,
  `kode_tenaga` varchar(14) NOT NULL,
  `no_analisis` int(5) NOT NULL,
  `no_proyek` int(5) NOT NULL,
  `perkiraan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis_tenaga_kerja`
--

INSERT INTO `analisis_tenaga_kerja` (`no_analisis_tenaga`, `kode_tenaga`, `no_analisis`, `no_proyek`, `perkiraan`) VALUES
(1, '12345', 3, 0, '5.00'),
(2, 'none', 2, 0, '88.00'),
(5, '12345', 8, 0, '67.00'),
(6, '12345', 9, 0, '45.00'),
(7, '12345', 12, 0, '44.00'),
(8, '12345', 13, 0, '78.00');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `kode_barang` varchar(14) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(7) NOT NULL,
  `harga_ahs` decimal(10,2) NOT NULL,
  `harga_k` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`kode_barang`, `nama_barang`, `satuan`, `harga_ahs`, `harga_k`) VALUES
('KJ009', 'jhsjkh', 'hj', '90.00', '90.00'),
('nxgd', 'dehnxnbxh', 'hdgh', '94.90', '90.90');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `kode_kerja` varchar(14) NOT NULL,
  `nama_kerja` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`kode_kerja`, `nama_kerja`) VALUES
('hjkgjhg', 'jkj009'),
('lla', 'makan');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `kode_perusahaan` varchar(14) NOT NULL,
  `email` varchar(30) NOT NULL,
  `cp_perusahaan` varchar(15) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL,
  `kabupaten` varchar(20) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`kode_perusahaan`, `email`, `cp_perusahaan`, `nama_perusahaan`, `kabupaten`, `provinsi`, `alamat`) VALUES
('K001', 'Kusuma@gmail.com', '09898989', 'KusumaJayas', 'demak', 'Jateng', 'demak'),
('L001', 'Jaya@gmail.com', '0989898989', 'JayaBaya', 'demak', 'jATENG', 'demak'),
('p002', 'nsia@huu.cp', '676786', 'jnana', 'bdsbnd djbja', 'bcbdvcb bdbs', 'sajjehjhjd');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `no_proyek` int(5) NOT NULL,
  `nama_proyek` varchar(100) NOT NULL,
  `kode_perusahaan` varchar(14) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `sumberdana` varchar(100) NOT NULL,
  `kab` varchar(20) NOT NULL,
  `prov` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`no_proyek`, `nama_proyek`, `kode_perusahaan`, `lokasi`, `sumberdana`, `kab`, `prov`, `tanggal`) VALUES
(13, 'makan bersama', 'L001', 'hgdjkadg', 'jgjhas', 'hgejhgfe', 'ghjdsg', '2017-11-22'),
(14, 'aghghj', 'K001', 'ghjfgh', 'jkgjdg', 'sfdsdf', 'wrew', '2017-11-14'),
(15, 'nisanisanisa', 'K001', 'gjkqgyyu', 'khdjkh', 'ytyutu', 'tuyt', '2017-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_kerja`
--

CREATE TABLE `tenaga_kerja` (
  `kode_tenaga` varchar(14) NOT NULL,
  `nama_tenaga` varchar(30) NOT NULL,
  `satuan` varchar(7) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenaga_kerja`
--

INSERT INTO `tenaga_kerja` (`kode_tenaga`, `nama_tenaga`, `satuan`, `harga_satuan`, `keterangan`) VALUES
('12345', 'Belajar', '2', '10.00', 'Habis'),
('23456', 'dadgahs', 'djsj', '99.00', '99.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`no_admin`);

--
-- Indexes for table `alat_berat`
--
ALTER TABLE `alat_berat`
  ADD PRIMARY KEY (`no_alat_berat`);

--
-- Indexes for table `analisis_bahan`
--
ALTER TABLE `analisis_bahan`
  ADD PRIMARY KEY (`no_analisis_bahan`);

--
-- Indexes for table `analisis_pekerjaan`
--
ALTER TABLE `analisis_pekerjaan`
  ADD PRIMARY KEY (`no_analisis`);

--
-- Indexes for table `analisis_tenaga_kerja`
--
ALTER TABLE `analisis_tenaga_kerja`
  ADD PRIMARY KEY (`no_analisis_tenaga`);

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`kode_kerja`),
  ADD UNIQUE KEY `kode_kerja` (`kode_kerja`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`kode_perusahaan`),
  ADD UNIQUE KEY `cp_perusahaan` (`cp_perusahaan`),
  ADD UNIQUE KEY `nama_perusahaan` (`nama_perusahaan`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`no_proyek`);

--
-- Indexes for table `tenaga_kerja`
--
ALTER TABLE `tenaga_kerja`
  ADD PRIMARY KEY (`kode_tenaga`),
  ADD UNIQUE KEY `nama_tenaga` (`nama_tenaga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `no_admin` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alat_berat`
--
ALTER TABLE `alat_berat`
  MODIFY `no_alat_berat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `analisis_bahan`
--
ALTER TABLE `analisis_bahan`
  MODIFY `no_analisis_bahan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `analisis_pekerjaan`
--
ALTER TABLE `analisis_pekerjaan`
  MODIFY `no_analisis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `analisis_tenaga_kerja`
--
ALTER TABLE `analisis_tenaga_kerja`
  MODIFY `no_analisis_tenaga` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `no_proyek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
