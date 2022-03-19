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
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `tweetID` int(11) NOT NULL,
  `status` varchar(140) NOT NULL,
  `tweetBy` int(11) NOT NULL,
  `retweetID` int(11) NOT NULL,
  `retweetBy` int(11) NOT NULL,
  `likesCount` int(11) NOT NULL,
  `retweetCount` int(11) NOT NULL,
  `postedOn` datetime NOT NULL,
  `retweetMsg` varchar(140) NOT NULL,
  `username` varchar(30) NOT NULL,
  `screenName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweetID`, `status`, `tweetBy`, `retweetID`, `retweetBy`, `likesCount`, `retweetCount`, `postedOn`, `retweetMsg`, `username`, `screenName`) VALUES
(2, 'Hey Guys, Welcome!! to JediTweet. My name is Harsahib Preet Singh and I am one of the developers of this website.', 1, 0, 0, 1, 2, '2021-03-30 08:29:00', 'null', '', ''),
(8, 'Hey, i am a dummy user just for testing here', 6, 0, 0, 0, 2, '2021-03-30 13:27:10', 'null', '', ''),
(18, 'Hey Guys, Welcome!! to JediTweet. My name is Harsahib Preet Singh and I am one of the developers of this website.', 1, 2, 6, 1, 1, '2021-03-31 23:57:29', 'Hey!! Deep here', '', ''),
(19, 'Hey, i am a dummy user just for testing here', 6, 8, 1, 0, 2, '2021-04-01 09:22:29', 'Hey!! Deep how are you doing?', '', ''),
(20, 'Hey guys!! How ya all doin Amit here', 7, 0, 0, 0, 0, '2021-04-03 14:20:28', 'null', 'Amit', 'Amit Lalani'),
(21, 'Hey Guys!! Summer is coming and now we can party hard', 1, 0, 0, 0, 4, '2021-04-04 08:49:14', 'null', 'Harsahib', 'Harsahib Preet Singh'),
(24, 'Hey Guys!! Summer is coming and now we can party hard', 1, 21, 1, 0, 4, '2021-04-04 05:42:46', 'Yiipppy!!!', 'Harsahib', 'Harsahib Preet Singh'),
(25, 'Hey Amit!! How you doin?', 1, 0, 0, 0, 0, '2021-04-05 04:26:22', 'null', 'Harsahib', 'Harsahib Preet Singh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweetID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
