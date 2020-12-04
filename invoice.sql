-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-11-30 09:32:00
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `invoice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `award_numbers`
--

CREATE TABLE `award_numbers` (
  `id` int(11) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `period` tinyint(1) NOT NULL,
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `award_numbers`
--

INSERT INTO `award_numbers` (`id`, `year`, `period`, `number`, `type`) VALUES
(1, 2020, 5, '42024723', 1),
(2, 2020, 5, '64157858', 2),
(3, 2020, 5, '68550826', 3),
(4, 2020, 5, '84643124', 3),
(5, 2020, 5, '46665810', 3),
(6, 2020, 5, '651', 4),
(7, 2020, 5, '341', 4),
(8, 2020, 4, '13362795', 1),
(9, 2020, 4, '27580166', 2),
(10, 2020, 4, '53227282', 3),
(11, 2020, 4, '35082085', 3),
(12, 2020, 4, '37175928', 3),
(13, 2020, 4, '987', 4),
(14, 2020, 4, '614', 4),
(15, 2020, 3, '03016191', 1),
(16, 2020, 3, '62474899', 2),
(17, 2020, 3, '33657726', 3),
(18, 2020, 3, '06142620', 3),
(19, 2020, 3, '66429962', 3),
(20, 2020, 3, '790', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` tinyint(1) UNSIGNED NOT NULL,
  `payment` int(11) UNSIGNED NOT NULL,
  `paytype` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `invoices`
--

INSERT INTO `invoices` (`id`, `code`, `number`, `period`, `payment`, `paytype`, `date`, `create_time`) VALUES
(2, 'FZ', '24710653', 5, 1100, '6', '2020-10-30', '2020-11-25 14:03:28'),
(3, 'FG', '12345678', 6, 485, '1', '2020-11-20', '2020-11-28 01:06:49'),
(4, 'HW', '88754931', 6, 78, '2', '2020-11-01', '2020-11-28 01:09:41'),
(5, 'HK', '11223344', 5, 4587, '2', '2020-10-10', '2020-11-28 03:58:16'),
(6, 'FG', '77889944', 5, 11, '6', '2020-10-18', '2020-11-28 03:59:53'),
(7, 'WW', '45271642', 5, 45, '1', '2020-10-13', '2020-11-28 04:10:19'),
(87, 'DA', '54987156', 5, 445, '2', '2020-09-18', '2020-11-28 04:14:42'),
(88, 'RV', '44720001', 5, 72, '', '2020-09-30', '2020-11-28 04:19:56'),
(89, 'FG', '12398775', 5, 1524, '2', '2020-09-16', '2020-11-28 04:26:49'),
(93, 'LU', '47165472', 6, 20, '1', '2020-11-16', '2020-11-28 05:13:05'),
(94, 'SA', '74851236', 6, 888, '1', '2020-11-13', '2020-11-28 05:14:13'),
(95, 'DD', '11223344', 6, 887, '1', '2020-12-01', '2020-11-28 07:52:39'),
(97, 'TY', '45781236', 6, 886, '1', '2020-12-02', '2020-11-28 16:00:32'),
(98, 'FE', '42024723', 5, 1000, '2', '2020-09-11', '2020-11-30 06:52:02');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `award_numbers`
--
ALTER TABLE `award_numbers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `award_numbers`
--
ALTER TABLE `award_numbers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
