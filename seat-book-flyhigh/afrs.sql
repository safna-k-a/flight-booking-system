-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2023 at 01:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`id`, `name`, `created_at`, `created_by`, `updated`, `edited_by`) VALUES
(1, 'Indigo', '2023-03-14 10:43:13', '', '2023-03-14 10:43:13', ''),
(2, 'Air India', '2023-03-14 10:44:10', '', '2023-03-14 10:44:10', ''),
(3, 'Air Asia', '2023-03-14 11:04:58', '', '2023-03-14 11:04:58', ''),
(4, 'vistara', '2023-03-14 11:04:58', '', '2023-03-14 11:04:58', ''),
(5, 'QANTAS', '2023-03-14 11:04:58', '', '2023-03-14 11:04:58', ''),
(6, 'QATAR', '2023-03-14 11:04:58', '', '2023-03-14 11:04:58', '');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `name`, `abbr`, `state_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Maharaja Bir Bikram Airport / Agartala Airport', 'IXA', 22, '2023-03-14 10:29:49', '', '2023-03-14 10:29:49', ''),
(2, 'Karwar Airport : Naval Air Station', 'KWR', 9, '2023-03-14 10:31:45', '', '2023-03-14 10:31:45', ''),
(3, 'Allahabad Airport', 'IXD', 23, '2023-03-14 17:40:30', '', '2023-03-14 17:40:30', ''),
(4, 'Allahabad Airport', 'IXD', 23, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(5, 'Along Airport / Aalo Airport', 'IXV', 3, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(6, 'Aurangabad Airport', 'IXU', 12, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(7, 'Bagdogra Airport', 'IXB', 24, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(8, 'Balurghat Airport', 'RGH', 24, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(9, 'Bareli Airport', 'BEK', 23, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(10, 'Belgaum Airport', 'IXG', 9, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(11, 'Bellary Airport', 'BEP', 9, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(12, 'Bengaluru International Airport / Kempegowda Inter', 'BLR', 9, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(13, 'Bhatinda Airport', 'BUP', 18, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(14, 'Bhavnagar Aerodome', 'BHU', 5, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(15, 'Raja Bhoj Airport', 'BHO', 11, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(16, 'Biju Patnaik Airport', 'BBI', 17, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', ''),
(17, 'Bhuj Airport', 'BHJ', 5, '2023-03-14 17:41:18', '', '2023-03-14 17:41:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL,
  `fly_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `register_id`, `fly_id`, `status`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 1, 1, 0, '2023-03-18 05:53:06', '', '2023-03-18 05:53:06', ''),
(2, 1, 1, 0, '2023-03-18 05:53:48', '', '2023-03-18 05:53:48', ''),
(3, 2, 1, 0, '2023-03-18 06:51:02', '', '2023-03-18 06:51:02', ''),
(4, 2, 1, 0, '2023-03-18 07:08:47', '', '2023-03-18 07:08:47', ''),
(5, 2, 1, 0, '2023-03-18 07:11:33', '', '2023-03-18 07:11:33', ''),
(6, 2, 1, 0, '2023-03-18 07:12:33', '', '2023-03-18 07:12:33', ''),
(7, 2, 1, 0, '2023-03-18 07:21:00', '', '2023-03-18 07:21:00', ''),
(8, 2, 1, 0, '2023-03-18 08:51:25', '', '2023-03-18 08:51:25', ''),
(9, 2, 1, 0, '2023-03-18 08:52:26', '', '2023-03-18 08:52:26', ''),
(10, 2, 1, 0, '2023-03-18 08:59:42', '', '2023-03-18 08:59:42', ''),
(11, 2, 1, 0, '2023-03-18 09:10:09', '', '2023-03-18 09:10:09', ''),
(12, 2, 1, 0, '2023-03-18 09:25:15', '', '2023-03-18 09:25:15', ''),
(13, 2, 1, 0, '2023-03-18 11:07:38', '', '2023-03-18 11:07:38', ''),
(14, 2, 1, 0, '2023-03-18 11:08:42', '', '2023-03-18 11:08:42', '');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fare`
--

CREATE TABLE `fare` (
  `id` int(11) NOT NULL,
  `fly_id` int(11) NOT NULL,
  `economy_rate` bigint(20) NOT NULL,
  `business_rate` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fare`
--

INSERT INTO `fare` (`id`, `fly_id`, `economy_rate`, `business_rate`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 1, 5000, 10000, '2023-03-16 06:52:46', 'admin', '2023-03-16 06:52:46', ''),
(2, 12, 5000, 10000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(3, 2, 6000, 90000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(4, 3, 5500, 85000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(5, 4, 5800, 95000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(6, 5, 7000, 12000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(7, 6, 800, 13000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(8, 7, 6500, 15000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(9, 8, 10000, 18000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(10, 9, 7500, 15000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(11, 10, 5900, 18000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', ''),
(12, 11, 10000, 20000, '2023-03-16 06:56:53', 'admin', '2023-03-16 06:56:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `airline_id` int(11) NOT NULL,
  `total_seat` int(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `name`, `airline_id`, `total_seat`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 'Airbus A1', 2, 60, '2023-03-15 08:40:47', '', '2023-03-14 11:08:22', 'safna'),
(2, 'Boeing 777', 2, 30, '2023-03-15 08:43:39', '', '2023-03-14 17:28:03', 'safna'),
(3, 'Boeing 777', 2, 30, '2023-03-15 08:46:17', '', '2023-03-14 17:31:16', 'safna'),
(4, 'Boeing 777', 2, 30, '2023-03-15 08:46:27', '', '2023-03-15 01:41:33', 'safna'),
(5, 'Boeing 778', 2, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(6, 'Boeing 779', 2, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(7, 'Boeing 780', 2, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(8, 'airbus a380', 1, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(9, 'airbus a381', 1, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(10, 'airbus a382', 1, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(11, 'airbus a383', 1, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(12, 'airbus a384', 1, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(13, 'jet 1', 3, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(14, 'jet 2', 3, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(15, 'jet 3', 3, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(16, 'jet 4', 3, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(17, 'jet 5', 3, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(18, 'V1', 4, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(19, 'V2', 4, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(20, 'V3', 4, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(21, 'V4', 4, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(22, 'V5', 4, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(23, 'QS-1', 5, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(24, 'QS-2', 5, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(25, 'QS-3', 5, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(26, 'QS-4', 5, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(27, 'QS-5', 5, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(28, 'QR-1', 6, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(29, 'QR-2', 6, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(30, 'QR-3', 6, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(31, 'QR-4', 6, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', ''),
(32, 'QR-5', 6, 30, '2023-03-15 01:41:33', '', '2023-03-15 01:41:33', '');

-- --------------------------------------------------------

--
-- Table structure for table `fly`
--

CREATE TABLE `fly` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `arrival_id` int(11) NOT NULL,
  `arr_date` date NOT NULL,
  `depart_date` date NOT NULL,
  `arr_time` time NOT NULL,
  `depart_time` time NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fly`
--

INSERT INTO `fly` (`id`, `flight_id`, `depart_id`, `arrival_id`, `arr_date`, `depart_date`, `arr_time`, `depart_time`, `created_by`, `created_at`, `edited_by`, `edited_at`) VALUES
(1, 2, 11, 9, '2023-03-25', '2023-03-26', '06:35:35', '23:35:35', '', '2023-03-15 03:38:31', '', '2023-03-15 03:38:31'),
(2, 7, 5, 17, '2023-03-28', '2023-03-28', '12:39:07', '16:39:07', '', '2023-03-15 03:40:17', '', '2023-03-15 03:40:17'),
(3, 9, 15, 6, '2023-03-22', '2023-03-23', '17:40:24', '22:40:24', '', '2023-03-15 03:41:22', '', '2023-03-15 03:41:22'),
(4, 10, 3, 8, '2023-03-17', '2023-03-19', '24:41:33', '11:41:33', '', '2023-03-15 03:42:50', '', '2023-03-15 03:42:50'),
(5, 5, 9, 12, '2023-03-20', '2023-03-21', '05:42:55', '12:42:55', '', '2023-03-15 03:44:07', '', '2023-03-15 03:44:07'),
(6, 11, 5, 16, '2023-03-27', '2023-03-28', '03:44:17', '08:18:41', '', '2023-03-15 03:45:28', '', '2023-03-15 03:45:28'),
(7, 12, 13, 16, '2023-03-09', '2023-03-10', '10:53:56', '14:06:56', '', '2023-03-15 03:54:56', '', '2023-03-15 03:54:56'),
(8, 9, 15, 11, '2023-03-17', '2023-03-18', '03:55:01', '11:55:01', '', '2023-03-15 03:55:56', '', '2023-03-15 03:55:56'),
(9, 5, 7, 12, '2023-03-23', '2023-03-24', '02:56:23', '05:56:23', '', '2023-03-15 03:57:19', '', '2023-03-15 03:57:19'),
(10, 10, 8, 12, '2023-03-21', '2023-03-23', '19:57:24', '21:13:24', '', '2023-03-15 03:58:31', '', '2023-03-15 03:58:31'),
(11, 11, 7, 16, '2023-03-30', '2023-03-31', '14:12:36', '16:58:36', '', '2023-03-15 03:59:43', '', '2023-03-15 03:59:43'),
(12, 7, 13, 5, '2023-04-20', '2023-04-21', '06:23:16', '10:15:23', '', '2023-03-15 04:01:20', '', '2023-03-15 04:01:20'),
(13, 8, 14, 8, '2023-05-03', '2023-05-04', '08:31:24', '12:33:24', '', '2023-03-15 04:02:29', '', '2023-03-15 04:02:29'),
(14, 4, 11, 1, '2023-05-16', '2023-05-17', '22:40:06', '07:04:06', '', '2023-03-15 04:05:30', '', '2023-03-15 04:05:30'),
(15, 3, 3, 14, '2023-04-01', '2023-04-02', '21:21:43', '06:38:15', '', '2023-03-15 04:07:28', '', '2023-03-15 04:07:28'),
(16, 6, 13, 7, '2023-03-28', '2023-03-29', '01:07:41', '05:27:17', '', '2023-03-15 04:08:33', '', '2023-03-15 04:08:33'),
(17, 2, 12, 16, '2023-04-05', '2023-04-06', '13:32:09', '15:32:48', '', '2023-03-15 04:09:47', '', '2023-03-15 04:09:47'),
(18, 6, 12, 11, '2023-03-21', '2023-03-22', '17:36:15', '24:40:20', '', '2023-03-15 04:10:53', '', '2023-03-15 04:10:53'),
(19, 7, 5, 12, '2023-03-29', '2023-03-31', '22:10:57', '03:46:19', '', '2023-03-15 04:11:46', '', '2023-03-15 04:11:46'),
(20, 9, 10, 15, '2023-03-24', '2023-03-24', '17:25:22', '20:31:16', '', '2023-03-15 04:12:43', '', '2023-03-15 04:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `seat_no` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(30) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `booking_id`, `seat_no`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 'aJ', 1, 'A3', '2023-03-18 05:53:07', '', '2023-03-18 05:53:07', ''),
(2, 'R', 1, 'B3', '2023-03-18 05:53:07', '', '2023-03-18 05:53:07', ''),
(3, 'Vijay', 1, 'C3', '2023-03-18 05:53:07', '', '2023-03-18 05:53:07', ''),
(4, 'aJ', 1, 'C1', '2023-03-18 05:53:49', '', '2023-03-18 05:53:49', ''),
(5, 'R', 1, 'D1', '2023-03-18 05:53:49', '', '2023-03-18 05:53:49', ''),
(6, 'Vijay', 1, 'E1', '2023-03-18 05:53:49', '', '2023-03-18 05:53:49', ''),
(7, 'aJ', 3, 'G1', '2023-03-18 06:51:02', '', '2023-03-18 06:51:02', ''),
(8, 'R', 3, 'G2', '2023-03-18 06:51:02', '', '2023-03-18 06:51:02', ''),
(9, 'Vijay', 3, 'G3', '2023-03-18 06:51:02', '', '2023-03-18 06:51:02', ''),
(10, 'aJ', 3, 'H1', '2023-03-18 07:08:47', '', '2023-03-18 07:08:47', ''),
(11, 'R', 3, 'H2', '2023-03-18 07:08:47', '', '2023-03-18 07:08:47', ''),
(12, 'Vijay', 3, 'H3', '2023-03-18 07:08:47', '', '2023-03-18 07:08:47', ''),
(13, 'aJ', 3, 'A1', '2023-03-18 07:11:33', '', '2023-03-18 07:11:33', ''),
(14, 'R', 3, 'B2', '2023-03-18 07:11:33', '', '2023-03-18 07:11:33', ''),
(15, 'Vijay', 3, 'C3', '2023-03-18 07:11:33', '', '2023-03-18 07:11:33', ''),
(16, 'aJ', 3, 'D1', '2023-03-18 07:12:34', '', '2023-03-18 07:12:34', ''),
(17, 'R', 3, 'D2', '2023-03-18 07:12:34', '', '2023-03-18 07:12:34', ''),
(18, 'Vijay', 3, 'E2', '2023-03-18 07:12:34', '', '2023-03-18 07:12:34', ''),
(19, 'aJ', 3, 'F1', '2023-03-18 07:21:01', '', '2023-03-18 07:21:01', ''),
(20, 'R', 3, 'F2', '2023-03-18 07:21:01', '', '2023-03-18 07:21:01', ''),
(21, 'Vijay', 3, 'F3', '2023-03-18 07:21:01', '', '2023-03-18 07:21:01', ''),
(22, 'aJ', 3, 'G1', '2023-03-18 08:51:25', '', '2023-03-18 08:51:25', ''),
(23, 'R', 3, 'G2', '2023-03-18 08:51:26', '', '2023-03-18 08:51:26', ''),
(24, 'Vijay', 3, 'H2', '2023-03-18 08:51:26', '', '2023-03-18 08:51:26', ''),
(25, 'aJ', 3, 'C2', '2023-03-18 08:52:27', '', '2023-03-18 08:52:27', ''),
(26, 'R', 3, 'E1', '2023-03-18 08:52:27', '', '2023-03-18 08:52:27', ''),
(27, 'Vijay', 3, 'E3', '2023-03-18 08:52:28', '', '2023-03-18 08:52:28', ''),
(28, 'aJ', 3, 'A2', '2023-03-18 08:59:42', '', '2023-03-18 08:59:42', ''),
(29, 'R', 3, 'A3', '2023-03-18 08:59:42', '', '2023-03-18 08:59:42', ''),
(30, 'Vijay', 3, 'B3', '2023-03-18 08:59:43', '', '2023-03-18 08:59:43', ''),
(31, 'aJ', 3, 'I1', '2023-03-18 09:10:09', '', '2023-03-18 09:10:09', ''),
(32, 'R', 3, 'I2', '2023-03-18 09:10:09', '', '2023-03-18 09:10:09', ''),
(33, 'Vijay', 3, 'I3', '2023-03-18 09:10:10', '', '2023-03-18 09:10:10', ''),
(34, 'aJ', 3, 'G3', '2023-03-18 09:25:15', '', '2023-03-18 09:25:15', ''),
(35, 'R', 3, 'H1', '2023-03-18 09:25:15', '', '2023-03-18 09:25:15', ''),
(36, 'Vijay', 3, 'H3', '2023-03-18 09:25:15', '', '2023-03-18 09:25:15', ''),
(37, 'aJ', 3, 'J1', '2023-03-18 11:07:39', '', '2023-03-18 11:07:39', ''),
(38, 'R', 3, 'J2', '2023-03-18 11:07:39', '', '2023-03-18 11:07:39', ''),
(39, 'aJ', 3, 'C1', '2023-03-18 11:08:42', '', '2023-03-18 11:08:42', ''),
(40, 'R', 3, 'D3', '2023-03-18 11:08:42', '', '2023-03-18 11:08:42', ''),
(41, 'Vijay', 3, 'J3', '2023-03-18 11:08:42', '', '2023-03-18 11:08:42', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `status`, `booking_id`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(2, 16200, '1', 3, '2023-03-18 09:10:49', '', '2023-03-18 09:10:49', ''),
(3, 16500, '1', 3, '2023-03-18 09:26:08', '', '2023-03-18 09:26:08', ''),
(4, 22000, '1', 3, '2023-03-18 11:09:29', '', '2023-03-18 11:09:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `photo` blob NOT NULL,
  `status` int(11) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`, `phone`, `photo`, `status`, `token`) VALUES
(1, 'safna', 'ka.safnas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2147483647, 0x726f73652e6a70672e6a706567, 1, '1c6beb356ed92283b678fb6f833005c022dc9694ca87fb4c0e'),
(2, 'anjali', 'anjali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2147483647, 0x7465612d74696d652d333234303736365f5f3438302e6a7067, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `seat_no` varchar(30) NOT NULL,
  `seat_type_id` int(11) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `fly_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(30) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `seat_no`, `seat_type_id`, `rate`, `fly_id`, `status`, `user_id`, `class_id`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 'A1', 1, 11000, 1, 1, 2, 0, '2023-03-17 08:14:27', 'admin', '2023-03-17 08:14:27', ''),
(2, 'A2', 2, 10500, 1, 1, 2, 0, '2023-03-17 08:14:27', 'admin', '2023-03-17 08:14:27', ''),
(3, 'A3', 1, 11000, 1, 1, 2, 0, '2023-03-17 08:15:15', 'admin', '2023-03-17 08:15:15', ''),
(4, 'B1', 1, 11000, 1, 0, 1, 0, '2023-03-17 08:18:10', 'admin', '2023-03-17 08:18:10', ''),
(5, 'B2', 2, 10500, 1, 1, 2, 0, '2023-03-17 08:18:10', 'admin', '2023-03-17 08:18:10', ''),
(6, 'B3', 1, 11000, 1, 1, 2, 0, '2023-03-17 08:18:10', 'admin', '2023-03-17 08:18:10', ''),
(7, 'C1', 1, 11000, 1, 1, 2, 0, '2023-03-17 08:18:42', 'admin', '2023-03-17 08:18:42', ''),
(8, 'C2', 2, 10500, 1, 1, 2, 0, '2023-03-17 08:18:42', 'admin', '2023-03-17 08:18:42', ''),
(9, 'C3', 1, 11000, 1, 1, 2, 0, '2023-03-17 08:18:42', 'admin', '2023-03-17 08:18:42', ''),
(10, 'D1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:19:57', 'admin', '2023-03-17 08:19:57', ''),
(11, 'D2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:19:57', 'admin', '2023-03-17 08:19:57', ''),
(12, 'D3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:19:57', 'admin', '2023-03-17 08:19:57', ''),
(13, 'E1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:20:27', 'admin', '2023-03-17 08:20:27', ''),
(14, 'E2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:20:27', 'admin', '2023-03-17 08:20:27', ''),
(15, 'E3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:20:27', 'admin', '2023-03-17 08:20:27', ''),
(16, 'F1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:20:46', 'admin', '2023-03-17 08:20:46', ''),
(17, 'F2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:20:46', 'admin', '2023-03-17 08:20:46', ''),
(18, 'F3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:20:46', 'admin', '2023-03-17 08:20:46', ''),
(19, 'G1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:21:10', 'admin', '2023-03-17 08:21:10', ''),
(20, 'G2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:21:10', 'admin', '2023-03-17 08:21:10', ''),
(21, 'G3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:21:10', 'admin', '2023-03-17 08:21:10', ''),
(22, 'H1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:22:53', 'admin', '2023-03-17 08:22:53', ''),
(23, 'H2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:22:53', 'admin', '2023-03-17 08:22:53', ''),
(24, 'H3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:22:53', 'admin', '2023-03-17 08:22:53', ''),
(25, 'I1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:23:17', 'admin', '2023-03-17 08:23:17', ''),
(26, 'I2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:23:17', 'admin', '2023-03-17 08:23:17', ''),
(27, 'I3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:23:17', 'admin', '2023-03-17 08:23:17', ''),
(28, 'J1', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:23:36', 'admin', '2023-03-17 08:23:36', ''),
(29, 'J2', 2, 5200, 1, 1, 2, 0, '2023-03-17 08:23:36', 'admin', '2023-03-17 08:23:36', ''),
(30, 'J3', 1, 5500, 1, 1, 2, 0, '2023-03-17 08:23:36', 'admin', '2023-03-17 08:23:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `seat_type`
--

CREATE TABLE `seat_type` (
  `id` int(11) NOT NULL,
  `seat_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_type`
--

INSERT INTO `seat_type` (`id`, `seat_type`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'window', '2023-03-17 04:33:28', '', '2023-03-17 04:33:28', ''),
(2, 'middle', '2023-03-17 04:34:05', '', '2023-03-17 04:34:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'ANDHRA PRADESH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(2, 'ASSAM', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(3, 'ARUNACHAL PRADESH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(4, 'BIHAR', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(5, 'GUJRAT', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(6, 'HARYANA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(7, 'HIMACHAL PRADESH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(8, 'JAMMU & KASHMIR', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(9, 'KARNATAKA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(10, 'KERALA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(11, 'MADHYA PRADESH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(12, 'MAHARASHTRA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(13, 'MANIPUR', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(14, 'MEGHALAYA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(15, 'MIZORAM', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(16, 'NAGALAND', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(17, 'ORISSA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(18, 'PUNJAB', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(19, 'RAJASTHAN', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(20, 'SIKKIM', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(21, 'TAMIL NADU', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(22, 'TRIPURA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(23, 'UTTAR PRADESH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(24, 'WEST BENGAL', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(25, 'DELHI', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(26, 'GOA', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(27, 'PONDICHERY', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(28, 'LAKSHDWEEP', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(29, 'DAMAN & DIU', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(30, 'DADRA & NAGAR', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(31, 'CHANDIGARH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(32, 'ANDAMAN & NICOBAR', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(33, 'UTTARANCHAL', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(34, 'JHARKHAND', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', ''),
(35, 'CHATTISGARH', '2023-03-14 10:20:29', '', '2023-03-14 10:21:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `ticket` blob NOT NULL,
  `bill` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_type`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `register_id` (`register_id`),
  ADD KEY `fly_id` (`fly_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fare`
--
ALTER TABLE `fare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fly_id` (`fly_id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airline_id` (`airline_id`);

--
-- Indexes for table `fly`
--
ALTER TABLE `fly`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `arrival_id` (`arrival_id`),
  ADD KEY `depart_id` (`depart_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seat_type_id` (`seat_type_id`),
  ADD KEY `fly_id` (`fly_id`);

--
-- Indexes for table `seat_type`
--
ALTER TABLE `seat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airline`
--
ALTER TABLE `airline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fare`
--
ALTER TABLE `fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `fly`
--
ALTER TABLE `fly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `seat_type`
--
ALTER TABLE `seat_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airport`
--
ALTER TABLE `airport`
  ADD CONSTRAINT `airport_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state_list` (`id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`fly_id`) REFERENCES `fly` (`id`);

--
-- Constraints for table `fare`
--
ALTER TABLE `fare`
  ADD CONSTRAINT `fare_ibfk_1` FOREIGN KEY (`fly_id`) REFERENCES `fly` (`id`);

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`airline_id`) REFERENCES `airline` (`id`);

--
-- Constraints for table `fly`
--
ALTER TABLE `fly`
  ADD CONSTRAINT `fly_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  ADD CONSTRAINT `fly_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  ADD CONSTRAINT `fly_ibfk_3` FOREIGN KEY (`arrival_id`) REFERENCES `airport` (`id`),
  ADD CONSTRAINT `fly_ibfk_4` FOREIGN KEY (`depart_id`) REFERENCES `airport` (`id`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`status`) REFERENCES `user` (`id`);

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`seat_type_id`) REFERENCES `seat_type` (`id`),
  ADD CONSTRAINT `seat_ibfk_2` FOREIGN KEY (`fly_id`) REFERENCES `fly` (`id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
