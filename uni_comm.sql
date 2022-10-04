-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2022 at 09:54 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uni_comm`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `author_id`, `body`, `timestamp`) VALUES
(8, 1, 'i hate u', '2022-05-19 18:25:45'),
(9, 1, 'meeeeeeeooooooooooowwwwwwwwww', '2022-05-21 16:36:12'),
(10, 1, 'hello test 339pm', '2022-05-27 12:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `post_id`, `body`) VALUES
(18, 2, 11, 'sdsdsd'),
(19, 2, 11, 'dd'),
(20, 2, 10, 'fdfd');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `faculty`, `department`, `course_name`, `subject_name`, `file`, `author_id`) VALUES
(10, 'CIT', 'Computer Science', 'Intro to OOP', 'Pointers', 'index.html', 1),
(9, 'CIT', 'Computer Information Systems', 'Database', 'DBMS', 'index.html', 1),
(8, 'CIT', 'Computer Science', 'Intro to OOP', 'Classes', 'homepage.php', 4);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`post_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(16, 1, 10),
(27, 2, 10),
(26, 2, 11),
(28, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `reciever_id` (`reciever_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msg_id`, `sender_id`, `reciever_id`, `body`, `timestamp`) VALUES
(13, 507, 2, 1, 'hi', '2022-05-28 23:57:52'),
(14, 246, 2, 3, 'yo!', '2022-05-29 00:15:20'),
(15, 507, 1, 2, 'hello', '2022-05-29 00:16:24'),
(16, 246, 2, 3, 'meow', '2022-05-29 07:42:30'),
(19, 507, 2, 1, 'bonus?', '2022-05-29 08:45:51'),
(20, 507, 2, 1, 'plz', '2022-05-29 08:51:44'),
(22, 378, 2, 4, 'how r u?', '2022-05-29 09:27:41'),
(23, 378, 2, 4, 'bonus plz?', '2022-05-29 09:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `body` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `timestamp`, `body`, `image`) VALUES
(10, 1, '2022-05-11 12:15:28', 'dfd', ''),
(11, 1, '2022-05-11 19:11:20', 'kkd', ''),
(12, 2, '2022-05-19 19:06:35', 'meow', 'post-img1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `body`, `post_id`, `timestamp`) VALUES
(1, 'Test Report 123.', 12, '2022-05-27 22:57:46'),
(2, 'single post test', 11, '2022-05-27 23:03:33'),
(3, 'dep test', 10, '2022-05-27 23:03:49'),
(4, 'false report.', 11, '2022-05-29 01:47:28'),
(5, '1231', 12, '2022-05-29 12:31:44'),
(6, '1233', 11, '2022-05-29 12:33:03'),
(7, 'admin report test', 12, '2022-05-29 12:41:14'),
(8, '1248', 10, '2022-05-29 12:48:13'),
(9, '1250', 11, '2022-05-29 12:50:21'),
(10, '1251', 12, '2022-05-29 12:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `name`, `value`) VALUES
(16, 1, 'js', 60),
(17, 2, 'nodejs', 80);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `birth_date`, `phone`, `profile_pic`, `department`, `password`, `level`, `type`, `active`) VALUES
(1, 'admin', 'admin@admin.com', 'female', '2000-02-01', '8888888888', 'girl.jpg', 'Computer Science', '$2y$10$x0uJerhZECTqjGRXc8UeqOE2yQiaecXu1eGUBeogYsiPzeKZ3GrAS', 0, 2, 1),
(2, 'ali abd', 'ali@unicomm.com', 'male', '2000-03-03', '9999999999', 'men.jpg', 'Computer Science', '$2y$10$xO0omEXD3G2A/b5IcC8sTu2tXFEX2GuyIhBoHjUyusoG851b41sdK', 1, 0, 1),
(3, 'sara ahmed', 'sara@unicomm.com', 'female', '2000-07-07', '1112121212', 'girl.jpg', 'Computer Science', '$2y$10$xO0omEXD3G2A/b5IcC8sTu2tXFEX2GuyIhBoHjUyusoG851b41sdK', 2, 0, 1),
(4, 'Ibrahim Samer', 'instructor@unicomm.com', 'female', '2000-12-03', '1212121212', 'c2.jpg', 'Cyber Security', '$2y$10$xO0omEXD3G2A/b5IcC8sTu2tXFEX2GuyIhBoHjUyusoG851b41sdK', 0, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`reciever_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
