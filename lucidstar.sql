-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2019 at 10:00 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucidstar`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(500) NOT NULL,
  `slogan` varchar(999) NOT NULL,
  `address` varchar(700) NOT NULL,
  `vision` text NOT NULL,
  `mission` text NOT NULL,
  `achievements` text NOT NULL,
  `about` text NOT NULL,
  `phone1` varchar(100) NOT NULL,
  `phone2` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `school_name`, `slogan`, `address`, `vision`, `mission`, `achievements`, `about`, `phone1`, `phone2`, `date_updated`) VALUES
(1, 'Lucid Stars Private School', 'we are stars', '6, Akinwale Street,\r\n\r\nOgba, Ikeja,\r\n\r\nLagos State, Nigeria.', 'Vision', 'Mission', 'Achievements', 'About', '08023148981', '08033160691', '2019-11-11 09:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

DROP TABLE IF EXISTS `ci_session`;
CREATE TABLE IF NOT EXISTS `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('63c24kamdi5u77g90dt3q63ffaqh9jer', '::1', 1573463023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436333032333b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('9jil79r1aaf9vca88p6d4k67a1dqon91', '::1', 1573465133, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436353133333b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('dfjkbljms0v568m7iq3vffqkq2d4123l', '::1', 1573461967, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436313936373b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('i4klf5mbnro9qn8uhr1ifo9c70lshg7f', '::1', 1573466109, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436363130393b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('nus5vg67c21l5b5kej3boeh2fn0o5fb5', '::1', 1573462715, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436323731353b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('qjn8paj2tgcafs5gskle60b3ohpvq8q3', '::1', 1573466221, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436363130393b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('t2q4o49lefjgosh09pmp7s5uni017clp', '::1', 1573462352, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436323335323b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b),
('vih8cthoaca64pca8cp8h90hnkflhbk9', '::1', 1573465699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537333436353639393b757365725f69647c733a313a2231223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b6163746976657c733a313a2231223b6c6576656c7c733a313a2231223b6c6f676765645f696e7c623a313b);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(500) NOT NULL,
  `tags` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `tags`) VALUES
(1, '1572969913WhatsApp_Image_2019-11-02_at_01_21_08.jpeg', 'culture-day-19');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_tags`
--

DROP TABLE IF EXISTS `gallery_tags`;
CREATE TABLE IF NOT EXISTS `gallery_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) NOT NULL,
  `tag_class` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_tags`
--

INSERT INTO `gallery_tags` (`id`, `tag_name`, `tag_class`) VALUES
(2, 'Culture Day 19', 'culture-day-19'),
(3, 'New Year 2020', 'new-year-2020');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `published`) VALUES
(1, 'Admission in progress', 'This is to inform the general public that the admission into Lucid School is ongoing for the 2019/2020 academic year, come one come all', '2019-11-05 15:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(500) NOT NULL,
  `headline` varchar(500) NOT NULL,
  `body` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `headline`, `body`, `date`) VALUES
(1, '1572969620WhatsApp_Image_2019-11-02_at_00_49_15.jpeg', 'Secure Learning Environment', 'We are the best in this system', '2019-11-05 17:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `level` int(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `level`, `active`, `date_created`) VALUES
(1, 'admin', 'admin@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 1, 1, '2019-08-27 12:10:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
