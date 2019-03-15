-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 04:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `support_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(45) NOT NULL,
  `c_phone` varchar(45) NOT NULL,
  `c_org` varchar(45) NOT NULL,
  `public_ip` varchar(45) NOT NULL,
  `sys_type_id` int(11) NOT NULL,
  `serv_host_id` int(11) DEFAULT NULL,
  `start_date_host` date DEFAULT NULL,
  `exp_date_host` date DEFAULT NULL,
  `serv_main_id` int(11) DEFAULT NULL,
  `start_date_main` date DEFAULT NULL,
  `exp_date_main` date DEFAULT NULL,
  `num_branch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_phone`, `c_org`, `public_ip`, `sys_type_id`, `serv_host_id`, `start_date_host`, `exp_date_host`, `serv_main_id`, `start_date_main`, `exp_date_main`, `num_branch`) VALUES
(1, 'Chan', '068 217 269', 'PNC', '192.128.10.2', 2, 1, '2019-03-14', '2020-03-14', 3, '2019-03-14', '2019-09-14', 3),
(2, 'Chan', '068 217 269', 'PNC', '192.128.10.2', 2, 1, '2019-03-14', '2020-03-14', 3, '2019-03-14', '2019-09-14', 3),
(3, 'Hello,', 'ddd', 'ddd', 'ddd', 3, 1, '2019-03-14', '2020-03-14', 4, '2019-03-14', '2020-03-14', 2),
(4, 'Hello,', 'ddd', 'ddd', 'ddd', 3, 1, '2019-03-14', '2020-03-14', 4, '2019-03-14', '2020-03-14', 2),
(5, '333', '333', '33', '33', 2, 1, '2019-03-14', '2020-03-14', 4, '2019-03-14', '2020-03-14', 2),
(6, 'erer', 'erer', 'erer', 'erer', 3, 2, '2019-03-14', '2019-09-14', 4, '2019-03-14', '2020-03-14', 2),
(7, 'Testing', '093 393 383', 'HEllO', '203.38383', 3, 2, '2019-03-14', '0000-00-00', 3, '2019-03-14', '0000-00-00', 2),
(8, 'Miniddd', 'dsfddfs', 'dfsfs', 'fsfsf', 3, 1, '2019-03-14', '2020-03-14', 4, '2019-03-27', '2020-03-27', 2),
(9, 'Pisey', '038 004 484 ', 'Flexible Solution Cambodia', '192.168.39.3', 1, 1, '2019-03-14', '2020-03-14', 4, '2019-03-14', '2020-03-14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_detail`
--

CREATE TABLE `service_detail` (
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `serv_id` int(11) NOT NULL,
  `d_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_detail`
--

INSERT INTO `service_detail` (`d_id`, `c_id`, `serv_id`, `d_price`) VALUES
(1, 6, 2, 20),
(2, 6, 2, 20),
(3, 6, 2, 20),
(4, 6, 2, 20),
(5, 6, 2, 20),
(6, 6, 2, 20),
(7, 6, 4, 40),
(8, 6, 4, 40),
(9, 6, 4, 40),
(10, 6, 4, 40),
(11, 6, 4, 40),
(12, 6, 4, 40),
(13, 6, 4, 40),
(14, 6, 4, 40),
(15, 6, 4, 40),
(16, 6, 4, 40),
(17, 6, 4, 40),
(18, 6, 4, 40),
(19, 7, 1, 20),
(20, 7, 1, 20),
(21, 7, 1, 20),
(22, 7, 1, 20),
(23, 7, 1, 20),
(24, 7, 1, 20),
(25, 7, 1, 20),
(26, 7, 1, 20),
(27, 7, 1, 20),
(28, 7, 1, 20),
(29, 7, 1, 20),
(30, 7, 1, 20),
(31, 7, 4, 40),
(32, 7, 4, 40),
(33, 7, 4, 40),
(34, 7, 4, 40),
(35, 7, 4, 40),
(36, 7, 4, 40),
(37, 7, 4, 40),
(38, 7, 4, 40),
(39, 7, 4, 40),
(40, 7, 4, 40),
(41, 7, 4, 40),
(42, 7, 4, 40),
(43, 7, 2, 20),
(44, 7, 2, 20),
(45, 7, 2, 20),
(46, 7, 2, 20),
(47, 7, 2, 20),
(48, 7, 2, 20),
(49, 7, 3, 40),
(50, 7, 3, 40),
(51, 7, 3, 40),
(52, 7, 3, 40),
(53, 7, 3, 40),
(54, 7, 3, 40),
(55, 8, 2, 20),
(56, 8, 2, 20),
(57, 8, 2, 20),
(58, 8, 2, 20),
(59, 8, 2, 20),
(60, 8, 2, 20),
(61, 8, 3, 40),
(62, 8, 3, 40),
(63, 8, 3, 40),
(64, 8, 3, 40),
(65, 8, 3, 40),
(66, 8, 3, 40),
(67, 8, 1, 20),
(68, 8, 1, 20),
(69, 8, 1, 20),
(70, 8, 1, 20),
(71, 8, 1, 20),
(72, 8, 1, 20),
(73, 8, 1, 20),
(74, 8, 1, 20),
(75, 8, 1, 20),
(76, 8, 1, 20),
(77, 8, 1, 20),
(78, 8, 1, 20),
(79, 8, 4, 40),
(80, 8, 4, 40),
(81, 8, 4, 40),
(82, 8, 4, 40),
(83, 8, 4, 40),
(84, 8, 4, 40),
(85, 8, 4, 40),
(86, 8, 4, 40),
(87, 8, 4, 40),
(88, 8, 4, 40),
(89, 8, 4, 40),
(90, 8, 4, 40),
(91, 8, 1, 20),
(92, 8, 1, 20),
(93, 8, 1, 20),
(94, 8, 1, 20),
(95, 8, 1, 20),
(96, 8, 1, 20),
(97, 8, 1, 20),
(98, 8, 1, 20),
(99, 8, 1, 20),
(100, 8, 1, 20),
(101, 8, 1, 20),
(102, 8, 1, 20),
(103, 8, 4, 40),
(104, 8, 4, 40),
(105, 8, 4, 40),
(106, 8, 4, 40),
(107, 8, 4, 40),
(108, 8, 4, 40),
(109, 8, 4, 40),
(110, 8, 4, 40),
(111, 8, 4, 40),
(112, 8, 4, 40),
(113, 8, 4, 40),
(114, 8, 4, 40),
(127, 9, 1, 20),
(128, 9, 1, 20),
(129, 9, 1, 20),
(130, 9, 1, 20),
(131, 9, 1, 20),
(132, 9, 1, 20),
(133, 9, 1, 20),
(134, 9, 1, 20),
(135, 9, 1, 20),
(136, 9, 1, 20),
(137, 9, 1, 20),
(138, 9, 1, 20),
(139, 9, 4, 40),
(140, 9, 4, 40),
(141, 9, 4, 40),
(142, 9, 4, 40),
(143, 9, 4, 40),
(144, 9, 4, 40),
(145, 9, 4, 40),
(146, 9, 4, 40),
(147, 9, 4, 40),
(148, 9, 4, 40),
(149, 9, 4, 40),
(150, 9, 4, 40);

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `serv_id` int(11) NOT NULL,
  `serv_type` varchar(45) NOT NULL,
  `serv_price` varchar(45) NOT NULL,
  `serv_duration` int(11) NOT NULL,
  `serv_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`serv_id`, `serv_type`, `serv_price`, `serv_duration`, `serv_key`) VALUES
(1, 'Hosting', '240', 12, 1),
(3, 'Maintenance', '240', 6, 2),
(6, '4444', '3434444', 4344444, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_type`
--

CREATE TABLE `system_type` (
  `sys_id` int(11) NOT NULL,
  `sys_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_type`
--

INSERT INTO `system_type` (`sys_id`, `sys_type`) VALUES
(1, 'រំលស់'),
(2, 'កម្ចី'),
(3, 'បញ្ចាំ'),
(7, 'wehhee'),
(10, 'why');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(45) NOT NULL,
  `u_pass` varchar(45) NOT NULL,
  `u_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_pass`, `u_status`) VALUES
(1, 'chea', '123', '1'),
(4, 'chan', '123', '1'),
(5, 'pisey', '123', '1'),
(6, 'Hello', '123', '1'),
(7, 'dfdf112222', 'dfdfdf', '1'),
(9, 'ttt', 'tt', '0'),
(10, 'admin@gmail.com12', 'dd', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `service_detail`
--
ALTER TABLE `service_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`serv_id`);

--
-- Indexes for table `system_type`
--
ALTER TABLE `system_type`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_detail`
--
ALTER TABLE `service_detail`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_type`
--
ALTER TABLE `system_type`
  MODIFY `sys_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
