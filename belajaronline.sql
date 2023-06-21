-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2023 pada 14.51
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajaronline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `nama`, `telp`, `password`, `foto`, `role`, `status`, `created_at`) VALUES
(1, 'Admin', '089520040075', 'admin', 'blank.jpg', 1, 0, '2023-05-23 09:00:42'),
(10, 'andracell', '089520040080', 'andracell', 'blank.jpg', 2, 1, '2023-05-27 06:28:11'),
(11, 'AminsAdmin', '089520040080', 'aminsadmin', 'blank.jpg', 2, 0, '2023-06-03 15:35:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_diskusi`
--

CREATE TABLE `tbl_diskusi` (
  `id` int(11) NOT NULL,
  `id_google` varchar(100) DEFAULT NULL,
  `telp` varchar(255) NOT NULL,
  `nama` varchar(550) NOT NULL,
  `pesan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `diskusi` varchar(550) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(225) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_diskusi`
--

INSERT INTO `tbl_diskusi` (`id`, `id_google`, `telp`, `nama`, `pesan`, `foto`, `diskusi`, `url`, `kunci`, `status`, `created_at`) VALUES
(12, '118202240336855293697', '089520040070', 'Alan Herva', 'halo', 'https://lh3.googleusercontent.com/a/AAcHTtdy6_nll1n7H1NkvTcglRvAdEw2RpsyRVaSvp1soQ=s96-c', 'statistik diskusi subtema 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-05-28 23:48:53'),
(13, '', '089520040080', 'andracell', 'halo juga', 'blank.jpg', 'statistik diskusi subtema 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-05-28 23:53:21'),
(14, '', '0895379905511', 'Amins', 'diskusi by amins', 'blank.jpg', 'statistik diskusi subtema 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-03 15:06:58'),
(15, '118202240336855293697', '089520040070', 'Alan Herva', 'halo', 'https://lh3.googleusercontent.com/a/AAcHTtdy6_nll1n7H1NkvTcglRvAdEw2RpsyRVaSvp1soQ=s96-c', 'geologi diskusi', 'pembelajaran45', 'geologi-1', 0, '2023-06-06 01:58:53'),
(16, '118202240336855293697', '089520040070', 'Alan Herva', 'disksi tentang apa', 'https://lh3.googleusercontent.com/a/AAcHTtdy6_nll1n7H1NkvTcglRvAdEw2RpsyRVaSvp1soQ=s96-c', 'geologi diskusi', 'pembelajaran45', 'geologi-1', 0, '2023-06-06 01:59:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_email_gateway`
--

CREATE TABLE `tbl_email_gateway` (
  `id` int(11) NOT NULL,
  `server` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_email_gateway`
--

INSERT INTO `tbl_email_gateway` (`id`, `server`, `email`, `password`, `status`, `created_at`) VALUES
(7, 'smtp.googlemail.com', 'tlearning08@gmail.com', 'mvupotjtentmjlod', 0, '2023-05-26 03:25:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jawab_quiz`
--

CREATE TABLE `tbl_jawab_quiz` (
  `id` int(11) NOT NULL,
  `soal_id` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `jawaban1` varchar(255) NOT NULL,
  `jawaban2` varchar(255) NOT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `screenshot` varchar(550) DEFAULT NULL,
  `pembelajaran` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jawab_quiz`
--

INSERT INTO `tbl_jawab_quiz` (`id`, `soal_id`, `nama`, `telp`, `jawaban1`, `jawaban2`, `jawaban`, `screenshot`, `pembelajaran`, `url`, `kunci`, `status`, `created_at`) VALUES
(38, '1', 'Alan Herva', '089520040070', 'Kratos', 'Teori', 'SALAH', NULL, 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-02 13:51:47'),
(39, '1', 'Amins', '0895379905511', 'Teori', 'Global', 'SALAH', NULL, 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-03 15:07:57'),
(40, '1', 'Alan Herva', '089520040070', 'jawwaban', 'quiz', 'BENAR', NULL, 'pembelajaran statistik 1', 'pembelajaran46', 'geologi-1', 1, '2023-06-06 02:12:43'),
(41, '2', 'Alan Herva', '089520040070', 'genetika', 'perangkat', 'SALAH', NULL, 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:17:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jawab_soal`
--

CREATE TABLE `tbl_jawab_soal` (
  `id` int(11) NOT NULL,
  `soal_id` varchar(255) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `koreksi` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jawab_soal`
--

INSERT INTO `tbl_jawab_soal` (`id`, `soal_id`, `telp`, `nama`, `jawaban`, `koreksi`, `url`, `kunci`, `status`, `created_at`) VALUES
(36, '1', '089520040070', 'Alan Herva', 'soal statistik subtema 1', 'BENAR', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-02 13:53:22'),
(37, '2', '089520040070', 'Alan Herva', 'benda bersuhu tinggi ke benda bersuhu rendah', 'BENAR', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-02 13:53:25'),
(38, '1', '0895379905511', 'Amins', 'soal statistik subtema 1', 'BENAR', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-03 15:11:20'),
(39, '2', '0895379905511', 'Amins', 'benda bersuhu tinggi ke benda bersuhu rendah', 'BENAR', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-03 15:11:30'),
(40, '1', '089520040070', 'Alan Herva', 'saya', 'BENAR', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-05 13:08:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_soal`
--

CREATE TABLE `tbl_nilai_soal` (
  `id` int(11) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `penyelesaian` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `skor` float NOT NULL,
  `pembelajaran` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_nilai_soal`
--

INSERT INTO `tbl_nilai_soal` (`id`, `telp`, `nama`, `jumlah_soal`, `penyelesaian`, `benar`, `salah`, `skor`, `pembelajaran`, `url`, `kunci`, `status`, `created_at`) VALUES
(47, '089520040070', 'Alan Herva', 2, 100, 2, 0, 10, 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-02 13:53:30'),
(48, '0895379905511', 'Amins', 2, 100, 2, 0, 10, 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-03 15:11:56'),
(49, '089520040070', 'Alan Herva', 1, 0, 0, 1, 0, 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-05 13:08:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelajaran`
--

CREATE TABLE `tbl_pembelajaran` (
  `id` int(11) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `pembelajaran` varchar(255) NOT NULL,
  `judul_video` varchar(255) DEFAULT NULL,
  `video` varchar(550) DEFAULT NULL,
  `nama_video` varchar(550) NOT NULL,
  `judul_materi` varchar(255) DEFAULT NULL,
  `materi` varchar(255) DEFAULT NULL,
  `nama_materi` varchar(550) NOT NULL,
  `diskusi` varchar(550) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelajaran`
--

INSERT INTO `tbl_pembelajaran` (`id`, `telp`, `pembelajaran`, `judul_video`, `video`, `nama_video`, `judul_materi`, `materi`, `nama_materi`, `diskusi`, `url`, `kunci`, `status`, `created_at`) VALUES
(43, '089520040075', 'pembelajaran statistik 1', 'statistik judul subtema 1', '1685162031_018b9a0ba45dda4d7c3a.mp4', 'Home _ T-Learning.mp4', 'statistik materi subtema 1', '1685162031_86effa97296d8779a1de.docx', 'LAPORAN KETCEH.docx', 'statistik diskusi subtema 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-05-30 12:34:13'),
(44, '089520040075', 'pembelajaran statistik', 'Tanaman', '1685450424_4e9a17b9e0b5ce80f8ba.mp4', 'Home _ T-Learning.mp4', 'statistik materi subtema 2', '1685450424_c6eb237a79825718933c.docx', '1685111069_4e14ef5e0a2b147e3480.docx', 'statistik diskusi subtema 2', 'pembelajaran44', 'statistik-subtema', 0, '2023-05-30 12:40:24'),
(45, '089520040075', 'pembelajaran geologi', 'video geologi', '1685805595_805489a4cdd522f59af6.mp4', 'Desain.mp4', 'geologi materi', '1685805595_62ef46f024e6d1bf97f8.docx', 'LAPORAN PKL KECE.docx', 'geologi diskusi', 'pembelajaran45', 'geologi-1', 0, '2023-06-03 15:19:55'),
(46, '089520040075', 'pembelajaran statistik 1', 'Tanaman', '1686017200_b5343fef30361cff0e69.mp4', 'Home (1).mp4', 'Kenapa ada Tanaman', '1686017200_e7ccc985bf18ef9f6437.docx', 'Laporan PKL.docx', 'Kenapa tanaman itu hijau', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 02:06:40'),
(47, '089520040075', 'pembelajaran test', 'video test', '1686491933_93de4d729d395c9e5966.mp4', 'Desain.mp4', 'judul test', '1686491933_f356081ee7e101c3d460.xlsx', '20230606_150330.xlsx', 'diskusi test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 13:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `id` int(11) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `soal_id` varchar(255) NOT NULL,
  `soal` varchar(550) NOT NULL,
  `jawaban1` varchar(255) NOT NULL,
  `jawaban2` varchar(255) NOT NULL,
  `opsi1` varchar(225) NOT NULL,
  `opsi2` varchar(255) NOT NULL,
  `opsi3` varchar(255) NOT NULL,
  `opsi4` varchar(255) NOT NULL,
  `jam` varchar(255) DEFAULT NULL,
  `menit` varchar(255) DEFAULT NULL,
  `detik` varchar(255) NOT NULL,
  `pembelajaran` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`id`, `telp`, `soal_id`, `soal`, `jawaban1`, `jawaban2`, `opsi1`, `opsi2`, `opsi3`, `opsi4`, `jam`, `menit`, `detik`, `pembelajaran`, `url`, `kunci`, `status`, `created_at`) VALUES
(27, '089520040075', '1', 'soal statistik subtema 2', 'statistik', 'Global', 'Teori', 'Kratos', 'Darwin', 'Global', '1', '', '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-05-30 13:25:06'),
(28, '089520040075', '2', 'Teori apa yang menyatakan manusia berevolusi dari kera', 'Teori', 'Darwin', 'Teori', 'Kratos', 'kenaikan suhu dan perubahan arah gerak', 'pembelajaran', '', '', '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-05-30 12:47:31'),
(29, '089520040075', '3', 'Teori apa yang menyatakan manusia berevolusi dari kera', 'statistik', 'Darwin', 'Perubahan bentuk dan perubahan arah gerak', 'Cuaca', 'Kenaikan', 'Pemanasan', '', '', '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-05-30 12:49:31'),
(35, '089520040075', '1', 'siapa saya', 'saya', 'kamu', 'kamu', 'saya', 'dia', 'aku', '1', NULL, '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-04 12:06:42'),
(36, '089520040075', '1', 'siapa saya', 'saya', 'kamu', 'kamu', 'saya', 'dia', 'aku', '1', NULL, '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-06-04 13:02:46'),
(37, '089520040075', '2', 'siapa dia', 'dia', 'saya', 'kamu', 'aku', 'dia', 'saya', '1', NULL, '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-04 13:02:46'),
(38, '089520040075', '1', 'quiz 1', 'jawwaban', 'quiz', 'Teori', 'jawwaban', 'quiz', 'suhu', '1', '', '3600', 'pembelajaran statistik 1', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 02:07:46'),
(39, '089520040075', '2', 'soal data sampel', 'soal', 'sampel', 'soal', 'sampel', 'dumb', 'dumb', '1', '10', '3600', 'pembelajaran statistik 1', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 14:53:49'),
(40, '089520040075', '1', 'susunan yang lebih kecil yang menjadi isi atau bagian penyusun dan pendukung atom', 'sub', 'atom', 'sub', 'neutron', 'proton', 'joule', '1', NULL, '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:00:48'),
(41, '089520040075', '2', ' teknik manipulasi susunan gen suatu organisme yang dilakukan untuk mendapatkan organisme dengan sifat baru dengan cara menghilangkan gen tertentu atau memasukkan gen dari organisme lain', 'rekayasa', 'genetika', 'genetika', 'perangkat', 'reaykasa', 'lunak', '1', NULL, '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:00:49'),
(42, '089520040075', '3', 'kemampuan untuk menjaga keseimbangan tubuh dengan cara membuang bahan-bahan sisa metabolisme yang dikeluarkan oleh sel', 'sistem', 'ekskresi', 'sistem', 'ekskresi', 'imun', 'kekebalan tubuh', '1', NULL, '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:00:49'),
(43, '089520040075', '4', 'salah satu jenis gelombang yang geraknya mengarah berdasarkan arah getaran dan arah rambatnya', 'gelombang', 'transversal', 'panas', 'gelombang', 'transversal', 'longtidunal', '1', NULL, '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:00:49'),
(44, '089520040075', '5', 'gelombang dengan perpindahan media berada dalam arah yang sama atau berlawanan dengan arah propagasi gelombang.', 'gelombang', 'longtidunal', 'longtidunal', 'panas', 'gelombang', 'transversal', '1', NULL, '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 14:00:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` int(11) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `soal_id` varchar(255) NOT NULL,
  `soal` varchar(550) NOT NULL,
  `jawaban` varchar(550) NOT NULL,
  `opsi1` varchar(255) NOT NULL,
  `opsi2` varchar(225) NOT NULL,
  `opsi3` varchar(255) NOT NULL,
  `opsi4` varchar(255) NOT NULL,
  `jam` varchar(255) DEFAULT NULL,
  `menit` varchar(255) DEFAULT NULL,
  `detik` varchar(255) NOT NULL,
  `pembelajaran` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `telp`, `soal_id`, `soal`, `jawaban`, `opsi1`, `opsi2`, `opsi3`, `opsi4`, `jam`, `menit`, `detik`, `pembelajaran`, `url`, `kunci`, `status`, `created_at`) VALUES
(27, '089520040075', '1', 'soal statistik subtema 1', 'soal statistik subtema 1', 'Teori', 'Suhu', 'Darwin', 'soal statistik subtema 1', '1', '', '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-05-30 13:57:00'),
(28, '089520040075', '2', 'Teori apa yang menyatakan manusia berevolusi dari kera', 'benda bersuhu tinggi ke benda bersuhu rendah', 'energi dalam bentuk massa', 'kenaikan suhu dan perubahan bentuk', 'Ekstrem', 'benda bersuhu tinggi ke benda bersuhu rendah', '1', '', '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 1, '2023-05-30 13:37:13'),
(29, '089520040075', '1', 'siapa', 'saya', 'saya', 'dia', 'kamu', 'mereka', '1', NULL, '3600', 'pembelajaran statistik 1', 'pembelajaran43', 'statistik-subtema', 0, '2023-06-04 12:15:22'),
(30, '089520040075', 'soal_id', 'soal', 'jawaban', 'opsi1', 'opsi2', 'opsi3', 'opsi4', 'jam', 'menit', 'waktu', 'pembelajaran statistik 1', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 14:46:01'),
(31, '089520040075', '1', 'soal data', 'soal data', 'soal data', 'dumb', 'dumb', 'dumb', '1', '10', '3600', 'pembelajaran statistik 1', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 14:46:01'),
(32, '089520040075', '1', 'soal data', 'soal data', 'soal data', 'dumb', 'dumb', 'dumb', '1', '10', '3600', 'pembelajaran statistik 1', 'pembelajaran46', 'statistik-subtema', 1, '2023-06-06 14:52:46'),
(33, '089520040075', '1', 'soal data', 'jawaban data', 'jawaban data', 'dumb', 'dumb', 'dumb', '1', NULL, '3600', 'pembelajaran geologi', 'pembelajaran45', 'geologi-1', 0, '2023-06-06 15:04:20'),
(34, '089520040075', '1', 'soal test 1', 'jawaban test 1', 'jawaban test 1', 'dumb', 'dumb', 'jawaban test 1', '1', '', '3600', 'pembelajaran test', 'pembelajaran47', 'test-subtema', 0, '2023-06-11 13:59:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_subtema`
--

CREATE TABLE `tbl_subtema` (
  `id` int(11) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `subtema` varchar(550) NOT NULL,
  `url` varchar(550) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_subtema`
--

INSERT INTO `tbl_subtema` (`id`, `telp`, `subtema`, `url`, `kunci`, `status`, `created_at`) VALUES
(22, '089520040075', 'statistik subtema', 'statistik-subtema', 'statistik', 1, '2023-05-27 04:05:15'),
(23, '089520040075', 'statistik subtema', 'statistik-subtema', 'statistik', 0, '2023-05-27 04:09:24'),
(24, '089520040075', 'geologi 1', 'geologi-1', 'geologi', 0, '2023-06-03 15:18:44'),
(25, '089520040075', 'test subtema', 'test-subtema', 'test', 0, '2023-06-11 13:57:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tema`
--

CREATE TABLE `tbl_tema` (
  `id` int(11) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `tema` varchar(550) NOT NULL,
  `url` varchar(550) NOT NULL,
  `logo` varchar(550) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tema`
--

INSERT INTO `tbl_tema` (`id`, `telp`, `tema`, `url`, `logo`, `status`, `created_at`) VALUES
(23, '089520040075', 'statistik', 'statistik', '1685158740_eb93e21f9483ed35dbb7.png', 1, '2023-05-27 03:39:00'),
(24, '089520040075', 'statistik', 'statistik', '1685159384_d2d5aa7ad7016dcfef56.png', 0, '2023-05-27 03:49:44'),
(25, '089520040075', 'geologi', 'geologi', '1685805486_5eaae856808e9777b808.png', 0, '2023-06-03 15:18:06'),
(26, '089520040075', 'test', 'test', '1686491858_6da1c4b4a964532b9570.png', 0, '2023-06-11 13:57:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(30) NOT NULL,
  `id_google` varchar(100) DEFAULT NULL,
  `id_facebook` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telp` varchar(14) DEFAULT NULL,
  `foto` varchar(550) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `kode` int(4) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_google`, `id_facebook`, `nama`, `email`, `telp`, `foto`, `role`, `kode`, `status`, `created_at`) VALUES
(40, '118202240336855293697', NULL, 'Alan Herva', 'alankoka86@gmail.com', '089520040070', 'https://lh3.googleusercontent.com/a/AAcHTtdy6_nll1n7H1NkvTcglRvAdEw2RpsyRVaSvp1soQ=s96-c', 2, 1935, 0, '2023-05-28 23:48:25'),
(41, NULL, NULL, 'andracell', 'andracell888@gmail.com', '089520040080', 'blank.jpg', 2, 1810, 0, '2023-05-28 23:50:58'),
(42, NULL, NULL, 'natjla', 'admin1@gmail.com', '089520040025', 'blank.jpg', 2, 9912, 1, '2023-05-28 23:53:52'),
(43, NULL, NULL, 'Amins', 'aminstech@gmail.com', '0895379905511', 'blank.jpg', 2, 3231, 0, '2023-06-03 15:04:20'),
(44, NULL, NULL, 'aa', 'asd@asd', '089520040100', 'blank.jpg', 2, 8885, 1, '2023-06-04 06:56:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_diskusi`
--
ALTER TABLE `tbl_diskusi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_email_gateway`
--
ALTER TABLE `tbl_email_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jawab_quiz`
--
ALTER TABLE `tbl_jawab_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jawab_soal`
--
ALTER TABLE `tbl_jawab_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_nilai_soal`
--
ALTER TABLE `tbl_nilai_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pembelajaran`
--
ALTER TABLE `tbl_pembelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_subtema`
--
ALTER TABLE `tbl_subtema`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_tema`
--
ALTER TABLE `tbl_tema`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_google` (`id_google`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_diskusi`
--
ALTER TABLE `tbl_diskusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_email_gateway`
--
ALTER TABLE `tbl_email_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_jawab_quiz`
--
ALTER TABLE `tbl_jawab_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_jawab_soal`
--
ALTER TABLE `tbl_jawab_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_soal`
--
ALTER TABLE `tbl_nilai_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelajaran`
--
ALTER TABLE `tbl_pembelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_subtema`
--
ALTER TABLE `tbl_subtema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_tema`
--
ALTER TABLE `tbl_tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
