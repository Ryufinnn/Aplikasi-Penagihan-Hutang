-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Mar 2018 pada 11.32
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_hutangpiutang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuranpelanggan`
--

CREATE TABLE IF NOT EXISTS `angsuranpelanggan` (
  `id_angsuranpel` varchar(10) NOT NULL,
  `id_hutangpel` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `angsuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsurantoko`
--

CREATE TABLE IF NOT EXISTS `angsurantoko` (
  `id_angsurantoko` varchar(10) NOT NULL,
  `id_hutangtoko` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `angsuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutangpelanggan`
--

CREATE TABLE IF NOT EXISTS `hutangpelanggan` (
  `id_hutangpel` varchar(10) NOT NULL,
  `namapel` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `ket` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutangtoko`
--

CREATE TABLE IF NOT EXISTS `hutangtoko` (
  `id_hutangtoko` varchar(10) NOT NULL,
  `hutangke` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `ket` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', '111', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuranpelanggan`
--
ALTER TABLE `angsuranpelanggan`
 ADD PRIMARY KEY (`id_angsuranpel`);

--
-- Indexes for table `angsurantoko`
--
ALTER TABLE `angsurantoko`
 ADD PRIMARY KEY (`id_angsurantoko`);

--
-- Indexes for table `hutangpelanggan`
--
ALTER TABLE `hutangpelanggan`
 ADD PRIMARY KEY (`id_hutangpel`);

--
-- Indexes for table `hutangtoko`
--
ALTER TABLE `hutangtoko`
 ADD PRIMARY KEY (`id_hutangtoko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
