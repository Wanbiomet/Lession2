-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 24, 2023 lúc 02:45 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qldm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(29, 'Tivi Samsung', 28, '2023-08-24 14:22:59', '2023-08-24 14:22:59'),
(30, 'Tivi LG', 28, '2023-08-24 14:23:55', '2023-08-24 14:23:55'),
(31, 'laptop', 0, '2023-08-24 14:25:33', '2023-08-24 14:25:33'),
(32, 'Xe máy', 0, '2023-08-24 14:25:40', '2023-08-24 14:25:40'),
(33, 'ô tô', 0, '2023-08-24 14:25:45', '2023-08-24 14:25:45'),
(34, 'mecedec-benz', 33, '2023-08-24 14:26:38', '2023-08-24 14:26:38'),
(35, 'laptop gaming', 31, '2023-08-24 14:26:57', '2023-08-24 14:26:57'),
(36, 'vison', 32, '2023-08-24 14:31:03', '2023-08-24 14:31:03'),
(37, 'ariblade', 32, '2023-08-24 14:31:14', '2023-08-24 14:31:14'),
(38, 'laptop văn phòng', 31, '2023-08-24 14:31:36', '2023-08-24 14:31:36'),
(39, 'ariblade - trắng', 37, '2023-08-24 14:32:05', '2023-08-24 14:32:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
