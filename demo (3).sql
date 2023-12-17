-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2023 at 10:52 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Giám đốc', NULL, NULL),
(2, 'Phó giám đốc', NULL, NULL),
(3, 'Trưởng phòng', NULL, NULL),
(4, 'Nhân viên', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `congvan`
--

CREATE TABLE `congvan` (
  `id` int NOT NULL,
  `sohieu` varchar(15) NOT NULL,
  `ngaylap` datetime DEFAULT NULL,
  `ngayky` datetime DEFAULT NULL,
  `ngayhieuluc` datetime DEFAULT NULL,
  `ngaychuyen` datetime DEFAULT NULL,
  `trichyeunoidung` varchar(100) NOT NULL,
  `nguoiky` varchar(30) DEFAULT NULL,
  `tentaptindinhkem` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `conhieuluc` int DEFAULT NULL,
  `idcoquanbanhanh` int NOT NULL,
  `idhinhthucvanban` int NOT NULL,
  `idlinhvuc` int NOT NULL,
  `idloaivanban` int NOT NULL,
  `TenKhongDau` varchar(130) NOT NULL,
  `idloaihinhcongvan` int DEFAULT NULL,
  `congkhai` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `congvan`
--

INSERT INTO `congvan` (`id`, `sohieu`, `ngaylap`, `ngayky`, `ngayhieuluc`, `ngaychuyen`, `trichyeunoidung`, `nguoiky`, `tentaptindinhkem`, `conhieuluc`, `idcoquanbanhanh`, `idhinhthucvanban`, `idlinhvuc`, `idloaivanban`, `TenKhongDau`, `idloaihinhcongvan`, `congkhai`, `is_active`) VALUES
(64, '123', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', 'Công văn số 1', '28', 'scanned_documents/1702808181_1702228102_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 2, 1, 1, 1, 'cong-van-so-1', 2, 1, 1),
(65, '100', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', 'Công văn 2', '33', 'scanned_documents/1702808344_2012-10-18-(1)-0136.jpg', NULL, 2, 1, 1, 1, 'cong-van-2', 2, 1, NULL),
(66, '101', '2023-12-18 00:00:00', '2023-12-18 00:00:00', '2023-12-18 00:00:00', '2023-12-18 00:00:00', 'Công văn đến 1', '28', 'scanned_documents/1702808378_2012-10-16-(1)-0142.jpg', NULL, 2, 1, 2, 1, 'cong-van-den-1', 3, 1, 1),
(67, '102', '2023-12-18 00:00:00', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-20 00:00:00', 'Công văn đến 2', '28', 'scanned_documents/1702808418_2012-10-16-(1)-0142.jpg', NULL, 2, 1, 2, 1, 'cong-van-den-2', 3, 1, 1),
(68, '103', '2023-12-24 00:00:00', '2023-12-24 00:00:00', '2023-12-24 00:00:00', '2023-12-25 00:00:00', 'công văn đi 1', '33', 'scanned_documents/1702808455_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 2, 1, 1, 1, 'cong-van-di-1', 4, 1, NULL),
(69, '104', '2023-12-22 00:00:00', '2023-12-22 00:00:00', '2023-12-22 00:00:00', '2023-12-22 00:00:00', 'công văn đi 2', '28', 'scanned_documents/1702808487_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 2, 1, 1, 1, 'cong-van-di-2', 4, 1, 3),
(70, '105', '2023-12-20 00:00:00', '2023-12-21 00:00:00', '2023-12-21 00:00:00', '2023-12-21 00:00:00', 'Công văn nội bộ 2.1', '36', 'scanned_documents/1702808751_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 2, 2, 2, 1, 'cong-van-noi-bo-2-1', 2, 1, 1),
(71, '106', '2023-12-18 00:00:00', '2023-12-18 00:00:00', '2023-12-18 00:00:00', '2023-12-18 00:00:00', 'Công văn nội bộ 2.2', '36', 'scanned_documents/1702808792_2012-10-16-(1)-0142.jpg', NULL, 4, 3, 2, 1, 'cong-van-noi-bo-2-2', 2, 1, 1),
(72, '107', '2023-12-23 00:00:00', '2023-12-24 00:00:00', '2023-12-24 00:00:00', '2023-12-25 00:00:00', 'Công văn đến  2.1', '36', 'scanned_documents/1702809183_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 4, 3, 2, 1, 'cong-van-den-2-1', 3, 1, NULL),
(73, '108', '2023-12-30 00:00:00', '2023-12-30 00:00:00', '2023-12-30 00:00:00', '2023-12-30 00:00:00', 'Công văn đến  2.2', '38', 'scanned_documents/1702809217_2012-10-16-(1)-0142.jpg', NULL, 2, 2, 1, 1, 'cong-van-den-2-2', 3, 1, 3),
(74, '108', '2023-12-17 00:00:00', '2023-12-18 00:00:00', '2023-12-26 00:00:00', '2023-12-27 00:00:00', 'Công văn đi 2.1', '38', 'scanned_documents/1702809253_2012-10-16-(1)-0142.jpg', NULL, 2, 1, 1, 1, 'cong-van-di-2-1', 4, 1, 1),
(75, '109', '2023-12-18 00:00:00', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-20 00:00:00', 'Công văn đi  2.2', '38', 'scanned_documents/1702809679_co-quan-hai-quan-chap-nhan-ban-scan-hoac-ban-chup-co-mau-kv-ak-23440.jpg', NULL, 2, 2, 1, 1, 'cong-van-di-2-2', 4, 1, 1),
(76, '110', '2023-12-18 00:00:00', '2023-12-19 00:00:00', '2023-12-28 00:00:00', '2023-12-29 00:00:00', 'Công văn nội bộ 3.1', '37', 'scanned_documents/1702809759_2012-10-18-(1)-0136.jpg', NULL, 4, 1, 1, 1, 'cong-van-noi-bo-3-1', 2, 1, 1),
(77, '111', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-19 00:00:00', 'Công văn nội bộ 3.2', '37', 'scanned_documents/1702809795_2012-10-16-(1)-0142.jpg', NULL, 2, 2, 2, 1, 'cong-van-noi-bo-3-2', 2, 1, 1),
(78, '112', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-19 00:00:00', '2023-12-20 00:00:00', 'Công văn đến 3.1', '37', 'scanned_documents/1702809831_2012-10-16-(1)-0142.jpg', NULL, 2, 1, 2, 1, 'cong-van-den-3-1', 3, 1, 3),
(79, '112', '2023-12-20 00:00:00', '2023-12-20 00:00:00', '2023-12-21 00:00:00', '2023-12-21 00:00:00', 'Công văn đến  3.2', '39', 'scanned_documents/1702809857_2012-10-18-(1)-0136.jpg', NULL, 2, 1, 1, 1, 'cong-van-den-3-2', 3, 1, 1),
(80, '113', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', '2023-12-17 00:00:00', 'Công văn đi 3.1', '39', 'scanned_documents/1702809896_2012-10-16-(1)-0142.jpg', NULL, 2, 3, 2, 1, 'cong-van-di-3-1', 4, 1, 1),
(81, '114', '2023-12-18 00:00:00', '2023-12-19 00:00:00', '2023-12-20 00:00:00', '2023-12-21 00:00:00', 'Công văn đi 3.2', '37', 'scanned_documents/1702809928_2012-10-18-(1)-0136.jpg', NULL, 2, 1, 1, 1, 'cong-van-di-3-2', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `congvan_phongban`
--

CREATE TABLE `congvan_phongban` (
  `id` bigint UNSIGNED NOT NULL,
  `congvan_id` bigint NOT NULL,
  `phongban_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `congvan_phongban`
--

INSERT INTO `congvan_phongban` (`id`, `congvan_id`, `phongban_id`, `created_at`, `updated_at`) VALUES
(23, 64, 1, '2023-12-17 03:16:21', '2023-12-17 03:16:21'),
(24, 65, 1, '2023-12-17 03:19:04', '2023-12-17 03:19:04'),
(25, 66, 1, '2023-12-17 03:19:38', '2023-12-17 03:19:38'),
(26, 67, 1, '2023-12-17 03:20:19', '2023-12-17 03:20:19'),
(27, 68, 1, '2023-12-17 03:20:55', '2023-12-17 03:20:55'),
(28, 69, 1, '2023-12-17 03:21:27', '2023-12-17 03:21:27'),
(29, 70, 2, '2023-12-17 03:25:51', '2023-12-17 03:25:51'),
(30, 71, 2, '2023-12-17 03:26:32', '2023-12-17 03:26:32'),
(31, 72, 2, '2023-12-17 03:33:03', '2023-12-17 03:33:03'),
(32, 73, 2, '2023-12-17 03:33:37', '2023-12-17 03:33:37'),
(33, 74, 2, '2023-12-17 03:34:13', '2023-12-17 03:34:13'),
(34, 75, 2, '2023-12-17 03:41:19', '2023-12-17 03:41:19'),
(35, 76, 3, '2023-12-17 03:42:39', '2023-12-17 03:42:39'),
(36, 77, 3, '2023-12-17 03:43:15', '2023-12-17 03:43:15'),
(37, 78, 3, '2023-12-17 03:43:51', '2023-12-17 03:43:51'),
(38, 79, 3, '2023-12-17 03:44:17', '2023-12-17 03:44:17'),
(39, 80, 3, '2023-12-17 03:44:56', '2023-12-17 03:44:56'),
(40, 81, 3, '2023-12-17 03:45:28', '2023-12-17 03:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `coquanbanhanh`
--

CREATE TABLE `coquanbanhanh` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `TenKhongDau` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `coquanbanhanh`
--

INSERT INTO `coquanbanhanh` (`id`, `name`, `TenKhongDau`) VALUES
(2, 'Sở Giáo Dục & Đào Tạo', 'so-giao-duc-dao-tao'),
(4, 'Sở Lao Động-Thương Binh & XH', 'so-lao-dong-thuong-binh-xh');

-- --------------------------------------------------------

--
-- Table structure for table `hinhthucvanban`
--

CREATE TABLE `hinhthucvanban` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `TenKhongDau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hinhthucvanban`
--

INSERT INTO `hinhthucvanban` (`id`, `name`, `TenKhongDau`) VALUES
(1, 'Báo cáo', 'bao-cao'),
(2, 'Công điện', 'cong-dien'),
(3, 'Công văn điều hành', 'cong-van-dieu-hanh'),
(4, 'Chỉ thị', 'chi-thi'),
(5, 'Điều lệ', 'dieu-le'),
(6, 'Giấy mời', 'giay-moi'),
(7, 'Kế hoạch', 'ke-hoach'),
(8, 'Luật', 'luat'),
(9, 'Nghị định', 'nghi-dinh'),
(10, 'Nghị quyết', 'nghi-quyet'),
(11, 'Pháp lệnh', 'phap-lenh'),
(12, 'Quyết định', 'quyet-dinh'),
(13, 'Tài liệu', 'tai-lieu'),
(14, 'Thông báo', 'thong-bao'),
(15, 'Thông tư', 'thong-tu');

-- --------------------------------------------------------

--
-- Table structure for table `linhvuc`
--

CREATE TABLE `linhvuc` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `TenKhongDau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `linhvuc`
--

INSERT INTO `linhvuc` (`id`, `name`, `TenKhongDau`) VALUES
(1, 'Công Nghệ Thông Tin', 'cong-nghe-thong-tin'),
(2, 'Lĩnh vực khác', 'linh-vuc-khac');

-- --------------------------------------------------------

--
-- Table structure for table `loaihinhcongvan`
--

CREATE TABLE `loaihinhcongvan` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `TenKhongDau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `loaihinhcongvan`
--

INSERT INTO `loaihinhcongvan` (`id`, `name`, `TenKhongDau`) VALUES
(2, 'Công văn nội bộ', 'cong-van-noi-bo'),
(3, 'Công văn đến', 'cong-van-den'),
(4, 'Công văn đi', 'cong-van-di');

-- --------------------------------------------------------

--
-- Table structure for table `loaivanban`
--

CREATE TABLE `loaivanban` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `TenKhongDau` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `loaivanban`
--

INSERT INTO `loaivanban` (`id`, `name`, `TenKhongDau`) VALUES
(1, 'Văn bản chỉ đạo điều hành', 'van-ban-chi-dao-dieu-hanh');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2023_11_29_161601_phongban_table', 1),
(5, '2023_11_29_163905_add_phong_ban_id_to_congvan_table', 2),
(6, '2023_11_29_165145_create_congvan_phongban_table', 3),
(7, '2023_12_01_093041_create_user_phongban_table', 4),
(8, '2023_12_02_150358_create_chucvu_table', 5),
(9, '2023_12_10_163831_user_congvan', 6);

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Phòng Ban 1', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(2, 'Phòng Ban 2', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(3, 'Phòng Ban 3', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(4, 'Phòng Ban 4', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(5, 'Phòng Ban 5', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(6, 'Phòng Ban 6', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(7, 'Phòng Ban 7', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(8, 'Phòng Ban 8', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(9, 'Phòng Ban 9', '2023-11-29 09:36:51', '2023-11-29 09:36:51'),
(10, 'Phòng Ban 10', '2023-11-29 09:36:51', '2023-11-29 09:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `hinhanh` varchar(34) NOT NULL,
  `link` varchar(253) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `name`, `hinhanh`, `link`) VALUES
(1, 'banner1', '3lv_0207 banner TS 1.jpg', 'https://www.hactech.edu.vn/tin-tuc/thong-tin-tuyen-sinh/thong-bao-tuyen-sinh-he-cao-dang-khoa-13-nam-2021-1617097771.html#title-container'),
(3, 'banner2', 'IWe_0207-banner TS 2.jpg', 'https://sinhvien.hactech.edu.vn/student-records/register?fbclid=IwAR2cgnifvt99zgR_nPA_tyxrKftyAR07clZ9cGzEZSqBJWgCbuoppea_rrQ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(254) NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `password` varchar(70) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(24, 'User SuperAdmin', 'superadmin@quanlycongvan.com', 2, '$2y$10$qtxkIm68RfjmIhulLgnAx.pq11Dzk8agVCqEDPyRsQHQBdyDP7NKa', 'spJmbYx6yHYN7e2HsDahItwUvwAXZT2hlTB1x0TrK67RvIEunQdokyzTP5rZ', '2023-12-17 10:51:52', '2018-07-06 02:46:31'),
(26, 'test', 'test@gmail.com', 0, '$2y$12$fmUGsDnbkxcVCicgfRNIwO2hXf5CgZHWJo/8wO..ZrWJyrG8aV8l2', NULL, '2023-12-02 09:33:22', '2023-12-02 09:33:22'),
(27, 'test1', 'test1@gmail.com', 0, '$2y$12$5RkkRzyg3rhcBuIRMQqhgOnhzyZ2tG9RRN9rUwamD330NYyGcbpsi', NULL, '2023-12-02 09:38:19', '2023-12-02 09:38:19'),
(28, 'Giám Đốc - PB1', 'giamdoc@phongban1.com', 1, '$2y$12$1Bcz63tUOJ7aZngCcN6lc.3Ay1ngto/3j9jijYW1ccyLdF.Br9lr6', NULL, '2023-12-14 05:56:11', '2023-12-09 08:29:30'),
(30, 'Nguyễn Văn A', 'nhanvien1@phongban1.com', 0, '$2y$12$CU1JFJXo4m0Ot1vVnZ1GcOMx3LU1Bp6DSi7VJORrMK8DVtAxGad2m', NULL, '2023-12-10 09:54:39', '2023-12-10 02:54:39'),
(31, 'nhân viên 2 - pb1', 'nhanvien2@phongban1.com', 0, '$2y$12$apxMH.A2ed4IzyDj6kB.FessLK0LqsZAMvKRWd/dbJXFP.8jU8Ofu', NULL, '2023-12-09 20:36:10', '2023-12-09 20:36:10'),
(32, 'Trưởng phòng - pb1', 'truongphong@phongban1.com', 0, '$2y$12$JZDC.mYVvXmgv9ywiifayeQq4vXFkY8twa2Md3oOAGiTlxWRnInKW', NULL, '2023-12-10 08:44:48', '2023-12-10 08:44:48'),
(33, 'phogiamdoc@phongban1.com', 'phogiamdoc@phongban1.com', 1, '$2y$12$XpDAl6uBRFpLWFRMhbtCj.cPB56QtOeZIkh.MRNjoawzgHRUFPYoi', NULL, '2023-12-10 08:53:51', '2023-12-10 08:53:51'),
(34, 'Trưởng phòng - pb2', 'truongphong@phongban2.com', 0, '$2y$12$yHHNJFAfrsYMf4XsIMyWqeUSnGTf5ZckfzeNeVVAWqMuob0idGU0u', NULL, '2023-12-13 22:48:58', '2023-12-13 22:48:58'),
(35, 'Trưởng phòng - pb3', 'truongphong@phongban3.com', 0, '$2y$12$Y5xoxla4I4FwT0qtQCVYoeGUL48qJaYUoWst/dUXGB3WAT/SzEkTi', NULL, '2023-12-13 22:49:29', '2023-12-13 22:49:29'),
(36, 'Phó Giám Đốc - PB2', 'phogiamdoc@phongban2.com', 1, '$2y$12$MwnWVLlqxPqXWmKKK0BxPO4ZncH/CRVeYw4kElLU9vP.3bw75ew0K', NULL, '2023-12-13 22:50:40', '2023-12-13 22:50:40'),
(37, 'Phó Giám Đốc - PB3', 'phogiamdoc@phongban3.com', 1, '$2y$12$9ln.fakamgZHCnts8h282OcuQP9TBt2jYPq6DAd.SerC.eYAChSMG', NULL, '2023-12-13 22:51:13', '2023-12-13 22:51:13'),
(38, 'Giám Đốc - PB2', 'giamdoc@phongban2.com', 1, '$2y$12$kJF4EOK97PPb4dj1Z0SKO.DoPWtXzIasrBM9iv6zVxFs/KI.GZVMO', NULL, '2023-12-13 22:51:42', '2023-12-13 22:51:42'),
(39, 'Giám Đốc - PB3', 'giamdoc@phongban3.com', 1, '$2y$12$pbOUmFlVPDBIawy1CBAfdutOrNnbWkImSXkJ4/wZ24Y9FQ3ViJ7ZK', NULL, '2023-12-13 22:52:35', '2023-12-13 22:52:35'),
(40, 'Nhân Viên 1 - PB2', 'nhanvien1@phongban2.com', 0, '$2y$12$tECAX9eaOYiH42zKRDyqqub3DJdwEUlGxNvjf.8tbJBlfvvGvrBtm', NULL, '2023-12-13 22:53:33', '2023-12-13 22:53:33'),
(41, 'Nhân Viên 2 - PB2', 'nhanvien2@phongban2.com', 0, '$2y$12$1dMsReANOmRZEVtK1E2vwufg36qPCMO/FlB2F/AbPZOD0gIqgCfPW', NULL, '2023-12-13 22:53:56', '2023-12-13 22:53:56'),
(42, 'Nhân Viên 1 - PB3', 'nhanvien1@phongban3.com', 0, '$2y$12$e1I5LVcGUFHZTw1CRmM/4eOr/TGzZ.Fsqyzkor77nXgRnN24H9ZfG', NULL, '2023-12-13 22:54:23', '2023-12-13 22:54:23'),
(43, 'Nhân Viên 2 - PB3', 'nhanvien2@phongban3.com', 0, '$2y$12$mAZiTSanbTxHjk2wurPlKO0ATTRTCiv4OgKN8Zzn2w82V2cTTxXm2', NULL, '2023-12-13 22:54:44', '2023-12-13 22:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_congvan`
--

CREATE TABLE `user_congvan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `congvan_id` bigint DEFAULT NULL,
  `nguoiky_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_congvan`
--

INSERT INTO `user_congvan` (`id`, `user_id`, `congvan_id`, `nguoiky_id`, `created_at`, `updated_at`) VALUES
(16, 32, 64, 28, '2023-12-17 03:16:21', '2023-12-17 03:16:21'),
(17, 32, 65, 33, '2023-12-17 03:19:04', '2023-12-17 03:19:04'),
(18, 32, 66, 28, '2023-12-17 03:19:38', '2023-12-17 03:19:38'),
(19, 32, 67, 28, '2023-12-17 03:20:19', '2023-12-17 03:20:19'),
(20, 32, 68, 33, '2023-12-17 03:20:55', '2023-12-17 03:20:55'),
(21, 32, 69, 28, '2023-12-17 03:21:27', '2023-12-17 03:21:27'),
(22, 34, 70, 36, '2023-12-17 03:25:51', '2023-12-17 03:25:51'),
(23, 34, 71, 36, '2023-12-17 03:26:32', '2023-12-17 03:26:32'),
(24, 34, 72, 36, '2023-12-17 03:33:03', '2023-12-17 03:33:03'),
(25, 34, 73, 38, '2023-12-17 03:33:37', '2023-12-17 03:33:37'),
(26, 34, 74, 38, '2023-12-17 03:34:13', '2023-12-17 03:34:13'),
(27, 34, 75, 38, '2023-12-17 03:41:19', '2023-12-17 03:41:19'),
(28, 35, 76, 37, '2023-12-17 03:42:39', '2023-12-17 03:42:39'),
(29, 35, 77, 37, '2023-12-17 03:43:15', '2023-12-17 03:43:15'),
(30, 35, 78, 37, '2023-12-17 03:43:51', '2023-12-17 03:43:51'),
(31, 35, 79, 39, '2023-12-17 03:44:17', '2023-12-17 03:44:17'),
(32, 35, 80, 39, '2023-12-17 03:44:56', '2023-12-17 03:44:56'),
(33, 35, 81, 37, '2023-12-17 03:45:28', '2023-12-17 03:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_phongban_chucvu`
--

CREATE TABLE `user_phongban_chucvu` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `phongban_id` bigint DEFAULT NULL,
  `chucvu_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_phongban_chucvu`
--

INSERT INTO `user_phongban_chucvu` (`id`, `user_id`, `phongban_id`, `chucvu_id`, `created_at`, `updated_at`) VALUES
(1, 25, 1, NULL, NULL, NULL),
(2, 27, 1, 4, '2023-12-02 09:38:19', '2023-12-09 09:35:32'),
(3, 26, 3, 4, NULL, '2023-12-09 09:35:42'),
(4, 28, 1, 1, '2023-12-09 08:29:30', '2023-12-09 09:35:21'),
(6, 30, 1, 4, '2023-12-09 20:35:34', '2023-12-09 21:08:46'),
(7, 31, 1, 4, '2023-12-09 20:36:10', '2023-12-09 20:36:10'),
(8, 32, 1, 3, '2023-12-10 08:44:48', '2023-12-10 08:44:48'),
(9, 33, 1, 2, '2023-12-10 08:53:51', '2023-12-10 08:53:51'),
(10, 34, 2, 3, '2023-12-13 22:48:58', '2023-12-13 22:48:58'),
(11, 35, 3, 3, '2023-12-13 22:49:29', '2023-12-13 22:49:29'),
(12, 36, 2, 2, '2023-12-13 22:50:40', '2023-12-13 22:50:40'),
(13, 37, 3, 2, '2023-12-13 22:51:13', '2023-12-13 22:51:13'),
(14, 38, 2, 1, '2023-12-13 22:51:42', '2023-12-13 22:51:42'),
(15, 39, 3, 1, '2023-12-13 22:52:35', '2023-12-13 22:52:35'),
(16, 40, 2, 4, '2023-12-13 22:53:33', '2023-12-13 22:53:33'),
(17, 41, 2, 4, '2023-12-13 22:53:56', '2023-12-13 22:53:56'),
(18, 42, 3, 4, '2023-12-13 22:54:23', '2023-12-13 22:54:23'),
(19, 43, 3, 4, '2023-12-13 22:54:44', '2023-12-13 22:54:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `congvan`
--
ALTER TABLE `congvan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Congvan_fk0` (`idcoquanbanhanh`),
  ADD KEY `Congvan_fk1` (`idhinhthucvanban`),
  ADD KEY `Congvan_fk2` (`idlinhvuc`),
  ADD KEY `Congvan_fk3` (`idloaivanban`),
  ADD KEY `TenKhongDau` (`TenKhongDau`),
  ADD KEY `idloaihinhcongvan` (`idloaihinhcongvan`);

--
-- Indexes for table `congvan_phongban`
--
ALTER TABLE `congvan_phongban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coquanbanhanh`
--
ALTER TABLE `coquanbanhanh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinhthucvanban`
--
ALTER TABLE `hinhthucvanban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linhvuc`
--
ALTER TABLE `linhvuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaihinhcongvan`
--
ALTER TABLE `loaihinhcongvan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `loaivanban`
--
ALTER TABLE `loaivanban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_congvan`
--
ALTER TABLE `user_congvan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_phongban_chucvu`
--
ALTER TABLE `user_phongban_chucvu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `congvan`
--
ALTER TABLE `congvan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `congvan_phongban`
--
ALTER TABLE `congvan_phongban`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `coquanbanhanh`
--
ALTER TABLE `coquanbanhanh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hinhthucvanban`
--
ALTER TABLE `hinhthucvanban`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `linhvuc`
--
ALTER TABLE `linhvuc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaihinhcongvan`
--
ALTER TABLE `loaihinhcongvan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loaivanban`
--
ALTER TABLE `loaivanban`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_congvan`
--
ALTER TABLE `user_congvan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_phongban_chucvu`
--
ALTER TABLE `user_phongban_chucvu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congvan`
--
ALTER TABLE `congvan`
  ADD CONSTRAINT `Congvan_fk0` FOREIGN KEY (`idcoquanbanhanh`) REFERENCES `coquanbanhanh` (`id`),
  ADD CONSTRAINT `Congvan_fk1` FOREIGN KEY (`idhinhthucvanban`) REFERENCES `hinhthucvanban` (`id`),
  ADD CONSTRAINT `Congvan_fk2` FOREIGN KEY (`idlinhvuc`) REFERENCES `linhvuc` (`id`),
  ADD CONSTRAINT `Congvan_fk3` FOREIGN KEY (`idloaivanban`) REFERENCES `loaivanban` (`id`),
  ADD CONSTRAINT `congvan_ibfk_1` FOREIGN KEY (`idloaihinhcongvan`) REFERENCES `loaihinhcongvan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
