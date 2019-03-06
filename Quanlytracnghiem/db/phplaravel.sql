-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2019 at 06:58 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `answers` varchar(500) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `created_at`, `update_at`) VALUES
(1, 'asdasdasdasdasd', '0000-00-00 00:00:00', '2019-02-17 16:10:19'),
(2, 'xcxvcvxvxcvxcvxv', '0000-00-00 00:00:00', '2019-02-17 16:10:19'),
(3, 'asdafasfasd', '2019-02-17 16:10:47', '2019-02-17 16:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_details_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `total_point` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `time`, `total_point`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 90, 20, 1, '2019-02-17 15:02:54', '2019-02-17 08:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `thread_details`
--

CREATE TABLE `thread_details` (
  `id` int(11) NOT NULL,
  `threads_id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thread_details`
--

INSERT INTO `thread_details` (`id`, `threads_id`, `questions_id`, `created_at`, `updated_at`) VALUES
(1, 8, 9, '2019-02-17 15:02:54', '2019-02-17 08:02:54'),
(2, 8, 1, '2019-02-17 16:45:21', '2019-02-17 09:45:21'),
(3, 8, 1, '2019-02-17 16:46:21', '2019-02-17 09:46:21'),
(4, 8, 1, '2019-02-17 16:46:54', '2019-02-17 09:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn A', 'admin1@mail.com', '$2y$10$QP/IzGoExu4C/SxpJclSKuNmY.HCqKblPzNxQiAe6KLuQ.BSGiOVa', '07564224220', 1, 'bVpWX2m5veBD8uucc0oTOcwmnGUVBSH0uX2TMwow8RuDzxMf784cUSDCRYCH', '2019-02-12 10:15:23', '2019-02-13 02:36:35'),
(2, 'Nguyễn Văn B', 'admin1@mail.com', '$2y$10$QP/IzGoExu4C/SxpJclSKuNmY.HCqKblPzNxQiAe6KLuQ.BSGiOVa', '02852424251', 0, NULL, '2019-02-12 10:15:23', '2019-02-12 01:47:20'),
(3, 'Nguyễn Văn C', 'admin2@mail.com', '$2y$10$QP/IzGoExu4C/SxpJclSKuNmY.HCqKblPzNxQiAe6KLuQ.BSGiOVa', '045543452134', 0, NULL, '2019-02-12 10:15:23', '2019-02-13 00:51:14'),
(4, 'Nguyễn Văn D', 'admin3@mail.com', '$2y$10$byS2xLp.JmXeW18CEpuGo.QpYtEBeJGAKyk.t11u1JoRVNavuTkqC', '0141263581135', 0, 'lcElUUTy0DBrOoXCnDcbDrrsZVuGIBiFRNP4AFtg1pVHiCvKwU9aTKH8KOy2', '2019-02-12 13:31:31', '2019-02-12 01:47:36'),
(5, 'Nguyễn Văn F', 'admin4@mail.com', '$2y$10$Y1u7VVr/v22PxVYGGA4awOsXFej23ldqtHce/Vg9bue22VhA1lFZe', '04156542574', 0, 'U5mHGNYPFhr6rUCExovAJgJQGm5BznBoUH0AlX3wdK9SQojZCz1vrk8CF4hB', '2019-02-12 10:15:23', '2019-02-12 01:47:46'),
(7, 'Nguyễn Văn G', 'admin5@mail.com', '$2y$10$AfmocwVZhXMMdPR52R08g.Wr5xznG/cHTmbSCe42U3nNqF2fr5xam', '012424574417', 0, 'VmF8vkKrJt4HqFtljiguKXwh1oP9mwgnXhuYyuL4RKqBvMwmrVdybDEiOUrg', '2019-02-12 13:48:20', '2019-02-12 01:48:03'),
(8, 'Nguyễn Văn D', 'test@gmail.com', '$2y$10$wWP535lv7jp6swTUZZz8Ruox7GMRPH/xE7OU08WkvSXjSpdh3An3e', '0364416798', 0, NULL, '2019-02-12 15:38:32', '2019-02-13 00:51:25'),
(9, 'Nguyen Van H', 'admin6@mail.com', '$2y$10$foEuL.nnVt7FGtHu30gDu.FsHh64fFY3SLqV/IVERp.iY8VuUUOo6', '01232131231', 0, NULL, '2019-02-13 08:36:05', '2019-02-13 00:09:01'),
(10, 'Nguyen Văn Q', 'admin7@mail.com', '$2y$10$KWgeKkkzlXEgqT4CG16WouvICEIXb6C1Jdf3yEzYj0ZwVzcIMJssW', '0364416799', 0, NULL, '2019-02-13 11:09:13', '2019-02-13 00:34:05'),
(12, 'Nguyen Van T', 'test2@mail.com', '$2y$10$SCL7RUSDgW4nVhIjQ.O7M.XfcAVDhGplTZ6CmeG9PVgJPr3FmyCwO', '0123451231', 0, NULL, '2019-02-13 13:05:14', '2019-02-13 02:40:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread_details`
--
ALTER TABLE `thread_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `thread_details`
--
ALTER TABLE `thread_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
