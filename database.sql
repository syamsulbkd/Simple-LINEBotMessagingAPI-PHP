-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Jun 2018 pada 08.52
-- Versi server: 10.2.12-MariaDB
-- Versi PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Created by Syamsul Anwar
-- https://www.anwar.my.id
--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `listresponse`
--

CREATE TABLE `listresponse` (
  `id_listresponse` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'text',
  `sort` int(11) DEFAULT 0,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  `originalContentUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `previewImageUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ongroup` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `listresponse`
--
ALTER TABLE `listresponse`
  ADD PRIMARY KEY (`id_listresponse`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `listresponse`
--
ALTER TABLE `listresponse`
  MODIFY `id_listresponse` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
