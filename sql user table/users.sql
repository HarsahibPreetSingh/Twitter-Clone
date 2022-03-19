-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2021 at 04:43 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweety`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `screenName` varchar(40) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `profileCover` varchar(255) NOT NULL,
  `following` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `bio` varchar(140) NOT NULL,
  `country` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `screenName`, `profileImage`, `profileCover`, `following`, `followers`, `bio`, `country`, `website`) VALUES
(1, 'Harsahib', 'hr644654@dal.ca', 'B00850322', 'Harsahib Preet Singh', 'assets/images/defaultProfile.png', 'assets/images/defaultCover.png', 4, 5, 'null', 'null', 'null'),
(6, 'Deep', 'harsahib555@gmail.com', 'Sahib27', 'Deep Dave', 'assets/images/defaultProfile.png', 'assets/images/defaultCover.png', 1, 1, 'null', 'null', 'null'),
(7, 'Amit', 'am326342@dal.ca', 'B00858413', 'Amit Lalani', 'assets/images/defaultprofile.png', 'assets/images/defaultCover.png', 1, 1, 'null', 'null', 'null'),
(8, 'Jason', 'ng839815@dal.ca', 'B00830592', 'Jason Nguyen', 'assets/images/defaultprofile.png', 'assets/images/defaultCover.png', 0, 1, 'null', 'null', 'null'),
(9, 'Julia', 'jl315162@dal.ca', 'B00790841', 'Julia Embrett', 'assets/images/defaultProfileGirl.jpeg', 'assets/images/defaultCover.png', 1, 0, 'null', 'null', 'null'),
(10, 'Mustafa', 'ms801525@dal.ca', 'B00636362', 'Mustafa Ali', 'assets/images/defaultprofile.png', 'assets/images/defaultCover.png', 1, 1, 'null', 'null', 'null'),
(11, 'Karan', 'karan555@gmail.com', 'B00850322', 'Karan Aujla', 'assets/images/defaultprofile.png', 'assets/images/defaultCover.png', 1, 0, 'null', 'null', 'null');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
