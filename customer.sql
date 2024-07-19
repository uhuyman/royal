-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2024 at 05:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cust_name` varchar(200) NOT NULL,
  `cust_hp` varchar(15) NOT NULL,
  `species` varchar(50) NOT NULL,
  `ras` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `lifestyle` varchar(100) NOT NULL,
  `special_need` longtext NOT NULL,
  `brand_before` varchar(100) NOT NULL,
  `know_brand_rc` tinyint(1) NOT NULL,
  `before_buy` varchar(100) NOT NULL,
  `information` varchar(200) NOT NULL,
  `buy` tinyint(1) NOT NULL,
  `product_buy` varchar(100) NOT NULL,
  `qty_recomend` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `id_user`, `cust_name`, `cust_hp`, `species`, `ras`, `age`, `lifestyle`, `special_need`, `brand_before`, `know_brand_rc`, `before_buy`, `information`, `buy`, `product_buy`, `qty_recomend`, `quantity`, `time_input`) VALUES
(1, 1, 'po', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 1, 'ee', 'aa', 11, 'ui', 98, 10, '2024-07-08 07:54:23'),
(2, 1, 'popppppyyy', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 0, 'ee', 'aa', 0, 'ui', 98, 10, '2024-07-08 07:54:23'),
(3, 1, 'ppepeppp', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 0, 'ee', 'aa', 0, 'ui', 98, 10, '2024-07-08 07:54:23'),
(4, 2, 'ppepeppp', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 0, 'ee', 'aa', 0, 'ui', 98, 10, '2024-07-08 07:54:23'),
(5, 2, 'linnardo', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 0, 'ee', 'aa', 0, 'ui', 98, 10, '2024-07-08 07:54:23'),
(6, 2, 'steven', '086271281', 'ii', 'anjing', '12', 'uu', 'aa', 'rc', 0, 'ee', 'aa', 0, 'ui', 98, 10, '2024-07-08 08:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
