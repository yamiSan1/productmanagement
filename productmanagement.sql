-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 01:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `image`, `userID`) VALUES
(2, 'wepik--2022520-171741.jpeg', '../uploads/wepik--2022520-171741.jpeg', 1),
(3, 'wepik--2022520-171741.jpeg', '../uploads/wepik--2022520-171741.jpeg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `managecategory`
--

CREATE TABLE `managecategory` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDesc` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `categoryImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `managecategory`
--

INSERT INTO `managecategory` (`categoryID`, `categoryName`, `categoryDesc`, `userID`, `categoryImage`) VALUES
(5, 'Wordpress Templates', 'Ready template to use for commercial uses', 1, '../uploads/categories/Website Creator-pana.png'),
(6, 'Digital Marketing', 'Social Media is now the best way to improve your buisness productivity', 1, '../uploads/categories/Ecommerce campaign-pana.png');

-- --------------------------------------------------------

--
-- Table structure for table `manageproduct`
--

CREATE TABLE `manageproduct` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `qte` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPassword`, `title`) VALUES
(1, 'yamiSAn1', 'admin@localhost', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Websites Seller'),
(3, 'Jaafar', 'admin@oussa.ma', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Otaku Developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `managecategory`
--
ALTER TABLE `managecategory`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `categoryID` (`categoryID`),
  ADD UNIQUE KEY `categoryName` (`categoryName`),
  ADD UNIQUE KEY `categoryDesc` (`categoryDesc`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `manageproduct`
--
ALTER TABLE `manageproduct`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName` (`productName`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managecategory`
--
ALTER TABLE `managecategory`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manageproduct`
--
ALTER TABLE `manageproduct`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `managecategory`
--
ALTER TABLE `managecategory`
  ADD CONSTRAINT `managecategory_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `manageproduct`
--
ALTER TABLE `manageproduct`
  ADD CONSTRAINT `manageproduct_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `managecategory` (`categoryID`),
  ADD CONSTRAINT `manageproduct_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
