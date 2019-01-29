-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2019 at 08:34 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myflig_c`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE `advertise` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `status` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `user1` text NOT NULL,
  `user2` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `userId` varchar(200) NOT NULL,
  `iid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `idnum` int(11) NOT NULL,
  `user1` text NOT NULL,
  `id` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inappropriate`
--

CREATE TABLE `inappropriate` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inout`
--

CREATE TABLE `inout` (
  `idno` int(11) NOT NULL,
  `input` varchar(200) NOT NULL,
  `output` varchar(200) NOT NULL DEFAULT '	وقتی اینو شنیدم چی جواب بدم؟',
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `postid` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `minds`
--

CREATE TABLE `minds` (
  `idnum` int(11) NOT NULL,
  `name` text NOT NULL,
  `id` text NOT NULL,
  `pic` text CHARACTER SET utf8 NOT NULL,
  `adminid` text NOT NULL,
  `country` text NOT NULL,
  `link` text NOT NULL,
  `type` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender` text NOT NULL,
  `receiver` text NOT NULL,
  `postId` text NOT NULL,
  `timereg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Places`
--

CREATE TABLE `Places` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `address` text NOT NULL,
  `amTime` text NOT NULL,
  `pmTime` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userid` mediumtext CHARACTER SET utf8 NOT NULL,
  `name` text NOT NULL,
  `image` text CHARACTER SET latin1 NOT NULL,
  `video` text NOT NULL,
  `videoThumbName` text NOT NULL,
  `profilePic` text CHARACTER SET latin1 NOT NULL,
  `status` varchar(200) NOT NULL,
  `nlike` text CHARACTER SET latin1 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `subject` text CHARACTER SET utf8mb4 NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 NOT NULL,
  `userid` text NOT NULL,
  `imagename` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `wave_code` text CHARACTER SET utf8mb4 NOT NULL,
  `life_code` text NOT NULL,
  `realname` text CHARACTER SET utf8mb4 NOT NULL,
  `username` text CHARACTER SET utf8mb4 NOT NULL,
  `password` text NOT NULL,
  `idnum` varchar(255) NOT NULL,
  `frequency` text CHARACTER SET utf8mb4 NOT NULL,
  `bio` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `phone` text NOT NULL,
  `gender` text CHARACTER SET utf8mb4 NOT NULL,
  `contrycode` int(11) NOT NULL,
  `nPosts` int(11) NOT NULL,
  `nFollowers` int(11) NOT NULL DEFAULT '0',
  `nFollowing` int(11) NOT NULL DEFAULT '0',
  `profileImage` text NOT NULL,
  `writings_nlike` int(11) NOT NULL,
  `timereg` text CHARACTER SET utf8mb4 NOT NULL,
  `allowlogin` text NOT NULL,
  `lastplayid` text NOT NULL,
  `action` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `data` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `lastHomeGet` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_mind`
--

CREATE TABLE `users_mind` (
  `idnum` int(11) NOT NULL,
  `userid` text NOT NULL,
  `mindid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `reported_kind` text NOT NULL,
  `reported_id` text NOT NULL,
  `usercomment` text CHARACTER SET utf8mb4 NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wave_likes`
--

CREATE TABLE `wave_likes` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `postid` text NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wave_posts`
--

CREATE TABLE `wave_posts` (
  `id` int(11) NOT NULL,
  `userid` mediumtext CHARACTER SET utf8 NOT NULL,
  `name` text NOT NULL,
  `profilePic` text CHARACTER SET latin1 NOT NULL,
  `voice` text NOT NULL,
  `contrycode` text NOT NULL,
  `text` text NOT NULL,
  `nlike` text CHARACTER SET latin1 NOT NULL,
  `ischeck` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertise`
--
ALTER TABLE `advertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`idnum`);

--
-- Indexes for table `inappropriate`
--
ALTER TABLE `inappropriate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inout`
--
ALTER TABLE `inout`
  ADD PRIMARY KEY (`idno`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minds`
--
ALTER TABLE `minds`
  ADD PRIMARY KEY (`idnum`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Places`
--
ALTER TABLE `Places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`idnum`),
  ADD KEY `id_2` (`idnum`),
  ADD KEY `bio` (`bio`(191)),
  ADD KEY `contrycode` (`contrycode`);

--
-- Indexes for table `users_mind`
--
ALTER TABLE `users_mind`
  ADD PRIMARY KEY (`idnum`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wave_likes`
--
ALTER TABLE `wave_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wave_posts`
--
ALTER TABLE `wave_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertise`
--
ALTER TABLE `advertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `idnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=992;

--
-- AUTO_INCREMENT for table `inappropriate`
--
ALTER TABLE `inappropriate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inout`
--
ALTER TABLE `inout`
  MODIFY `idno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2110;

--
-- AUTO_INCREMENT for table `minds`
--
ALTER TABLE `minds`
  MODIFY `idnum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3049;

--
-- AUTO_INCREMENT for table `Places`
--
ALTER TABLE `Places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7412;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7529;

--
-- AUTO_INCREMENT for table `users_mind`
--
ALTER TABLE `users_mind`
  MODIFY `idnum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `wave_likes`
--
ALTER TABLE `wave_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wave_posts`
--
ALTER TABLE `wave_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
