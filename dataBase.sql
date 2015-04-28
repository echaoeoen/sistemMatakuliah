-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2015 at 09:08 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sismatkul`
--
CREATE DATABASE IF NOT EXISTS `sismatkul` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sismatkul`;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `dosenId` int(11) NOT NULL AUTO_INCREMENT,
  `kodeDosen` varchar(10) NOT NULL,
  `NIDN` varchar(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`dosenId`),
  UNIQUE KEY `kodeDosen` (`kodeDosen`,`NIDN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dosen`
--


-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `jadwalId` int(11) NOT NULL AUTO_INCREMENT,
  `hari` int(11) NOT NULL,
  `matakuliahId` int(11) NOT NULL,
  `dosenId` int(11) NOT NULL,
  `ruanganId` int(11) NOT NULL,
  `kelasId` int(11) NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`jadwalId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kelasId` int(11) NOT NULL AUTO_INCREMENT,
  `namaKelas` varchar(50) NOT NULL,
  `dosenWali` int(11) NOT NULL,
  PRIMARY KEY (`kelasId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kelas`
--


-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `mataKuliahId` int(11) NOT NULL AUTO_INCREMENT,
  `namaMataKuliah` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  PRIMARY KEY (`mataKuliahId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `matakuliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE IF NOT EXISTS `mengajar` (
  `dosenId` int(11) NOT NULL,
  `matakuliahId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--
-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE IF NOT EXISTS `ruangan` (
  `ruanganId` int(11) NOT NULL AUTO_INCREMENT,
  `namaRuangan` varchar(100) NOT NULL,
  PRIMARY KEY (`ruanganId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ruangan`
--


-- --------------------------------------------------------

--
-- Table structure for table `sks`
--

CREATE TABLE IF NOT EXISTS `sks` (
  `sksId` int(11) NOT NULL AUTO_INCREMENT,
  `jenisSks` enum('PRAKTIKUM','TEORI') NOT NULL,
  `jmlJam` int(11) NOT NULL,
  `jmlSks` int(11) NOT NULL,
  PRIMARY KEY (`sksId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sks`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
