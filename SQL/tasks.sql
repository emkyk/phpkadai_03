-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 7 月 06 日 16:13
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `task_manager`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL,
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `due_date`, `priority`, `status`) VALUES
(2, 'php課題03', '2024-07-05', 'High', 'Completed'),
(5, 'php課題02', '2024-06-28', 'High', 'Pending'),
(18, 'チーズアカデミー', '2024-07-05', 'Medium', 'Completed'),
(19, 'チーズアカデミー', '2024-07-05', 'Low', 'Pending'),
(20, 'php課題01', '2024-05-03', 'Low', 'Pending'),
(21, 'php課題04', '2024-07-12', 'High', 'Pending'),
(22, 'php課題05', '2024-07-19', 'High', 'Pending'),
(23, 'じゃんけんアプリリッチ', '2024-05-31', 'Low', 'Pending'),
(24, 'チーズアカデミー修正', '2024-05-23', 'Low', 'Pending');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
