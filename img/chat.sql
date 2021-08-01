-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 04:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `isi_chat` text NOT NULL,
  `tanggal_chat` date NOT NULL,
  `jam_chat` varchar(100) NOT NULL,
  `notif_chat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_pengirim`, `id_penerima`, `isi_chat`, `tanggal_chat`, `jam_chat`, `notif_chat`) VALUES
(1, 1, 2, 'sayang', '2020-06-18', '20:54', 'sudah'),
(2, 1, 2, 'apa kabarmu sayang', '2020-06-18', '20:57', 'sudah'),
(3, 1, 2, 'ad', '2020-06-20', '18:36', 'sudah'),
(4, 2, 1, 'adad', '2020-06-20', '18:37', 'sudah'),
(5, 2, 1, 'addd', '2020-06-20', '18:37', 'sudah'),
(6, 2, 1, 'gggg', '2020-06-20', '18:37', 'sudah'),
(7, 2, 1, 'halo', '2020-07-05', '15:56', 'sudah'),
(8, 1, 2, 'apa', '2020-07-05', '15:56', 'belum'),
(9, 1, 2, 'bangsat', '2020-07-05', '15:56', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `foto_user` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username_user` varchar(20) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `log_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `foto_user`, `nama_user`, `username_user`, `password_user`, `log_time`) VALUES
(1, '2.jpg', 'luffy', 'luffy', 'luffy', '1593939662'),
(2, '6.jpg', 'nami', 'nami', 'nami', '1593939604');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
