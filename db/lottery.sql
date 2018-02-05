-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2018 at 08:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lottery`
--

-- --------------------------------------------------------

--
-- Table structure for table `lottery`
--

CREATE TABLE IF NOT EXISTS `lottery` (
`id` int(30) NOT NULL,
  `lotteryNumber` int(30) NOT NULL,
  `prizeId` int(50) NOT NULL,
  `typeId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE IF NOT EXISTS `prize` (
`id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `onDate` date NOT NULL,
  `publish` varchar(3) NOT NULL,
  `weight` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prize`
--

INSERT INTO `prize` (`id`, `title`, `type`, `description`, `image`, `onDate`, `publish`, `weight`) VALUES
(22, 'LCD Monitor', 2, '', '', '2018-02-05', 'Yes', 20),
(21, 'Hero Honda', 1, '', '', '2018-02-05', 'Yes', 10),
(23, 'Mobile Set', 3, '', '', '2018-02-05', 'Yes', 30),
(24, 'Rice Cooker', 6, '', '', '2018-02-05', 'Yes', 40),
(25, 'Micro Oven', 5, '', '', '2018-02-05', 'Yes', 50),
(26, 'Wall Clock', 7, '', '', '2018-02-05', 'Yes', 60),
(27, 'Mirror', 7, '', '', '2018-02-05', 'Yes', 70),
(28, 'Wall Clock', 7, '', '', '2018-02-05', 'Yes', 80);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
`id` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `onDate` date NOT NULL,
  `publish` varchar(3) NOT NULL,
  `weight` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `title`, `onDate`, `publish`, `weight`) VALUES
(1, 'First Price', '2018-02-05', 'Yes', 10),
(2, 'Second Price', '2018-02-05', 'Yes', 20),
(3, 'Third Price', '2018-02-05', 'Yes', 30),
(5, 'Fourth Price', '2018-02-05', 'Yes', 40),
(6, 'Fifth Price', '2018-02-05', 'Yes', 50),
(7, 'Consolation Price', '2018-02-05', 'Yes', 60);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastLogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `loginTimes` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('A','D') NOT NULL DEFAULT 'D',
  `userGroupId` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lastLogin`, `loginTimes`, `status`, `userGroupId`) VALUES
(1, 'admin', 'lottery_123_#', '2018-02-05 23:33:00', 468, 'A', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lottery`
--
ALTER TABLE `lottery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prize`
--
ALTER TABLE `prize`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
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
-- AUTO_INCREMENT for table `lottery`
--
ALTER TABLE `lottery`
MODIFY `id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
