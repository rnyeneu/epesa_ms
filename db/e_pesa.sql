-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 08:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_pesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `current_float` int(11) NOT NULL,
  `current_cash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`p_id`, `p_name`, `current_float`, `current_cash`) VALUES
(1, 'Airtel Money', 0, 1000000),
(2, 'Halopesa', 900000, 100000),
(3, 'M-Pesa', 500000, 500000),
(4, 'Tigopesa', 398000, 602000);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `trans_type` varchar(20) NOT NULL,
  `trans_provider` varchar(30) NOT NULL,
  `trans_date` varchar(20) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `time_added` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `trans_type`, `trans_provider`, `trans_date`, `amount`, `time_added`) VALUES
(1, '25282761310', 'Deposit', 'Tigopesa', '29/11/2021', 102000, '18:45:06'),
(3, '25282761313', 'Deposit', 'Airtel Money', '29/11/2021', 500000, '18:52:52'),
(2, '25282761316', 'Withdraw', 'Halopesa', '29/11/2021', 400000, '18:50:25'),
(4, '35345433', 'Deposit', '', '29/11/2021', 2147483647, '19:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `transactions_log`
--

CREATE TABLE `transactions_log` (
  `id` int(11) NOT NULL,
  `trans_type` varchar(20) NOT NULL,
  `trans_provider` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `float_balance` int(11) NOT NULL,
  `cash_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions_log`
--

INSERT INTO `transactions_log` (`id`, `trans_type`, `trans_provider`, `amount`, `float_balance`, `cash_balance`) VALUES
(1, 'Deposit', 'Tigopesa', 102000, 398000, 602000),
(2, 'Withdraw', 'Halopesa', 400000, 900000, 100000),
(3, 'Deposit', 'Airtel Money', 500000, 0, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`, `role`, `is_active`) VALUES
(1, 'Rahabu Nyeneu', 'rnyeneu', '12345', 'Admin', 1),
(2, 'Hurbert Shayo', 'gasper', '1234', 'Operator', 1),
(3, 'Victor Nesphory', 'gboys', 'manshaker', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `transactions_log`
--
ALTER TABLE `transactions_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions_log`
--
ALTER TABLE `transactions_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
