-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2018 at 08:45 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) UNSIGNED NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `parent`, `description`, `dateAdded`) VALUES
(1, 'Web Development', 0, 'Blog posts related to latest trends, and technologies in web design, and development', '2018-09-15 17:35:45'),
(2, 'App Development', 0, 'Latest gist on mobile apps across all platforms', '2018-09-15 17:39:05'),
(3, 'Digital Arts', 0, 'Art showcases, tutorials, gist on latest techniques, and softwares', '2018-09-15 17:41:42'),
(4, 'SEO', 0, 'Latest on Search Engine Optimization', '2018-09-15 17:43:22'),
(5, 'IOS', 2, 'IOS related technologies', '2018-09-15 17:47:56'),
(6, 'Android', 2, 'Android related technologies', '2018-09-15 17:47:56'),
(7, 'Misc', 2, 'other platforms', '2018-10-23 20:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` int(11) NOT NULL,
  `creatorID` int(11) NOT NULL,
  `title` text NOT NULL,
  `categories` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `isApproved` tinyint(1) NOT NULL,
  `isSpam` tinyint(1) NOT NULL,
  `isPublished` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `userType` enum('Super-Administrator','Administrator','Editor','Author','Public') NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `displayName` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `postCount` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `userType`, `fullname`, `displayName`, `bio`, `password`, `postCount`, `email`, `dateAdded`) VALUES
(1, 'Elmage', 'Super-Administrator', 'Ogaba Emmanuel', 'Elmage G Ace', 'I\'m the boss!          ', '$2y$09$3WqlhGOeDG5fgu4Xp65Qb.1NFlwDZlQ/EYFWRIAep4E9sMwHWHkbe', 1, 'elmage@yahoo.com', '2018-09-01 11:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(1, 1, '$2y$09$JXfHTZ2IWS.rvMrjxRHdQOTy6zYlXoF.mjUIYYlg/LxUXliMRfZiW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
