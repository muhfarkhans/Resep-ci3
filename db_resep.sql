-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2021 at 10:58 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_resep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `story` varchar(200) DEFAULT NULL,
  `serves` int(11) DEFAULT NULL,
  `cook_time` int(11) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `user_id`, `is_published`, `title`, `story`, `serves`, `cook_time`, `img`, `created_at`) VALUES
(1, 1, 1, 'mi ayam enak', 'mia ayam khas kantor', 10, 60, 'bfe4b810-7029-401a-a31a-6418226ba95f_43.jpg', '2021-01-16 05:57:00'),
(2, 1, 1, 'Steak sapi', 'enak buat makan siang', 2, 60, 'images_daging_steak-daging-lada-hitam.jpg', '2021-01-16 05:55:58'),
(3, 1, 1, 'Roti bakar jos', 'Bagi kamu penggemar roti bakar, kamu bisa kok membuatnya sendiri di rumah. Selain lebih hemat, kamu juga bisa berkreasi dengan topingnya.', 12, 15, 'asnim-ansari-SqYmTDQYMjo-unsplash.jpg', '2021-01-16 05:59:37'),
(4, 1, 0, 'Untitled', NULL, NULL, NULL, NULL, '2021-01-16 06:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `name`) VALUES
(1, 1, 'mi 2 km'),
(2, 2, 'daging sapi'),
(3, 2, 'garam'),
(4, 3, 'roti'),
(5, 3, 'coklat');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_reviews`
--

CREATE TABLE `recipe_reviews` (
  `id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_reviews`
--

INSERT INTO `recipe_reviews` (`id`, `reviewer_id`, `recipe_id`, `stars`, `comment`, `created_at`) VALUES
(1, 2, 3, 5, 'enak keren', '2021-01-16 06:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_steps`
--

INSERT INTO `recipe_steps` (`id`, `recipe_id`, `content`, `img`) VALUES
(1, 1, 'masak mi', NULL),
(2, 2, 'rebus daging', NULL),
(3, 3, 'bakar roti', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img`, `link`, `text`) VALUES
(1, 'patrick-fore-ZmH0g1ievTg-unsplash.jpg', 'donat', 'Donat enak menemani harimu'),
(2, 'davide-cantelli-jpkfc5_d-DI-unsplash.jpg', 'gorengan', 'Makanan cocok bersama keluarga (gorengan)'),
(3, 'ivan-torres-MQUqbmszGGM-unsplash.jpg', 'pizza', 'Buat pizza mu sendiri');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `display_name`, `email`, `password`, `photo`) VALUES
(1, 'kaka', 'koko@koko.koko', 'c2d2ea6494ccae1345a7b5f6e005bf2d', 'koala.jpg'),
(2, 'kaka', 'kaka@kaka.kaka', 'a090b3ac763214fa5e6d2aa3d7af421f', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_to_user` (`user_id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_to_recipe` (`recipe_id`);

--
-- Indexes for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_to_user_1` (`reviewer_id`),
  ADD KEY `r_to_recipe_2` (`recipe_id`);

--
-- Indexes for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_to_recipe_3` (`recipe_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `r_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `r_to_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  ADD CONSTRAINT `r_to_recipe_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `r_to_user_1` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD CONSTRAINT `r_to_recipe_3` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
