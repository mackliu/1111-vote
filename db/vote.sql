-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-22 10:16:06
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `vote`
--

-- --------------------------------------------------------

--
-- 資料表結構 `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `mem_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `vote_time` datetime NOT NULL,
  `records` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `logs`
--

INSERT INTO `logs` (`id`, `mem_id`, `topic_id`, `vote_time`, `records`, `created_time`) VALUES
(1, 1, 5, '2023-05-22 07:55:38', 'Array', '2023-05-22 05:55:38'),
(2, 1, 5, '2023-05-22 07:55:47', 'Array', '2023-05-22 05:55:47'),
(3, 1, 2, '2023-05-22 07:55:55', 'Array', '2023-05-22 05:55:55'),
(4, 1, 2, '2023-05-22 07:59:17', 'a:1:{i:2;a:2:{i:0;s:1:\"8\";i:1;s:2:\"18\";}}', '2023-05-22 05:59:17'),
(5, 0, 5, '2023-05-22 08:00:45', 'a:1:{i:5;s:2:\"23\";}', '2023-05-22 06:00:45'),
(6, 0, 5, '2023-05-22 08:00:54', 'a:1:{i:5;s:2:\"23\";}', '2023-05-22 06:00:54'),
(7, 0, 5, '2023-05-22 14:03:43', 'a:1:{i:5;s:2:\"21\";}', '2023-05-22 06:03:43');

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` varchar(32) NOT NULL,
  `pw` varchar(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `addr` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`id`, `acc`, `pw`, `name`, `addr`, `email`) VALUES
(1, 'mack', '1234', ' 劉', '泰山', 'macklun@ms7.hinet.net');

-- --------------------------------------------------------

--
-- 資料表結構 `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `options`
--

INSERT INTO `options` (`id`, `description`, `subject_id`, `total`, `created_time`, `updated_time`) VALUES
(8, '20分鐘', 2, 15, '2023-05-15 08:19:27', '2023-05-22 05:59:17'),
(21, '3.5萬', 5, 8, '2023-05-19 06:23:38', '2023-05-22 06:03:43'),
(22, '4萬', 5, 6, '2023-05-19 06:23:38', '2023-05-22 05:55:38'),
(23, '4.5萬', 5, 10, '2023-05-19 06:23:38', '2023-05-22 06:00:54'),
(24, '5萬以上', 5, 38, '2023-05-19 06:23:38', '2023-05-19 08:23:48'),
(25, '8:00', 6, 0, '2023-05-22 06:45:53', '2023-05-22 06:45:53'),
(26, '6:30', 6, 0, '2023-05-22 06:45:53', '2023-05-22 06:45:53'),
(27, '7:00', 6, 0, '2023-05-22 06:45:53', '2023-05-22 06:45:53'),
(28, '8:30', 6, 0, '2023-05-22 06:45:53', '2023-05-22 06:45:53'),
(29, '9:00', 6, 0, '2023-05-22 06:45:53', '2023-05-22 06:45:53');

-- --------------------------------------------------------

--
-- 資料表結構 `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` text NOT NULL,
  `open_time` datetime NOT NULL,
  `close_time` datetime NOT NULL,
  `type` int(1) UNSIGNED NOT NULL,
  `login` tinyint(1) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `topics`
--

INSERT INTO `topics` (`id`, `subject`, `open_time`, `close_time`, `type`, `login`, `created_time`, `updated_time`) VALUES
(2, '每天要花在通勤時間多久?', '2023-05-17 16:19:00', '2023-05-22 16:19:00', 2, 1, '2023-05-15 08:19:27', '2023-05-22 03:46:02'),
(5, '期望薪水多少?', '2023-05-19 14:23:00', '2023-05-22 14:25:00', 1, 0, '2023-05-19 06:23:38', '2023-05-22 06:23:45'),
(6, '國中以下，幾點上課好', '2023-05-23 21:00:10', '2023-05-26 15:33:00', 1, 0, '2023-05-22 06:45:53', '2023-05-22 07:33:29');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
