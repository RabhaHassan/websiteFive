-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 فبراير 2020 الساعة 05:08
-- إصدار الخادم: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL COMMENT 'to identify user',
  `Username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `Truststatus` int(11) NOT NULL DEFAULT 0,
  `Fullname` varchar(255) NOT NULL,
  `Ragestatus` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `vkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`userID`, `Username`, `password`, `Email`, `GroupID`, `Truststatus`, `Fullname`, `Ragestatus`, `Date`, `avatar`, `vkey`) VALUES
(0, 'mohammed', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'malmasri23596@gmail.com', 1, 1, 'mohammed ayman almasri', 1, '0000-00-00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD KEY `member_1` (`Member_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'to identify user', AUTO_INCREMENT=36;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
