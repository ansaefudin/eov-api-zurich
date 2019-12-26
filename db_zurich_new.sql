-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 11:10 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_zurich`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_zurcih`
--

CREATE TABLE `tb_data_zurcih` (
  `ID` int(40) NOT NULL,
  `UID` varchar(40) NOT NULL,
  `POLICY_HOLDER_NAME` varchar(80) NOT NULL,
  `POLICY_HOLDER_NAME_ROW_2` varchar(40) NOT NULL,
  `POLICY_HOLDER_DATE_OF_BIRTH` varchar(40) NOT NULL,
  `POLICY_NUMBER` varchar(40) NOT NULL,
  `INSURED_NAME` varchar(80) NOT NULL,
  `CURRENCY_1` varchar(80) NOT NULL,
  `SUM_ASSURED` varchar(40) NOT NULL,
  `CURRENCY_2` varchar(80) NOT NULL,
  `PREMIUM_AMOUNT` varchar(40) NOT NULL,
  `CODE_FREQUENCY` varchar(40) NOT NULL,
  `PAYMENT_FREQUENCY` varchar(40) NOT NULL,
  `CODE_PAYMENT_METHOD` varchar(40) NOT NULL,
  `PAYMENT_METHOD` varchar(40) NOT NULL,
  `AGENT_NAME` varchar(40) NOT NULL,
  `POLICY_HOLDER_PHONE_NUMBER` varchar(40) NOT NULL,
  `EMAIL_POLICY_HOLDER_NAME` varchar(40) NOT NULL,
  `COMPONENT_DESCRIPTION` varchar(50) NOT NULL,
  `LANDING_PAGE` varchar(50) NOT NULL,
  `PARSED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `GENERATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS_FLAG` varchar(20) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_zurcih`
--

INSERT INTO `tb_data_zurcih` (`ID`, `UID`, `POLICY_HOLDER_NAME`, `POLICY_HOLDER_NAME_ROW_2`, `POLICY_HOLDER_DATE_OF_BIRTH`, `POLICY_NUMBER`, `INSURED_NAME`, `CURRENCY_1`, `SUM_ASSURED`, `CURRENCY_2`, `PREMIUM_AMOUNT`, `CODE_FREQUENCY`, `PAYMENT_FREQUENCY`, `CODE_PAYMENT_METHOD`, `PAYMENT_METHOD`, `AGENT_NAME`, `POLICY_HOLDER_PHONE_NUMBER`, `EMAIL_POLICY_HOLDER_NAME`, `COMPONENT_DESCRIPTION`, `LANDING_PAGE`, `PARSED_AT`, `GENERATED_AT`, `STATUS_FLAG`, `CREATED_AT`) VALUES
(1, 'g9t7ft71je1c4w', 'Soekrisno\r\n', '', '19-09-1991', '1636299', 'Indira Kemala\r\n', 'Rp.\r\n', '10.000.000', 'Rp.\r\n', '5.000.000', 'B', 'Perbulan', 'C', 'Auto Debit Kartu Kredit', 'Sugeng Wintholo', '081919123030', 'muhamadmaulanarachman@gmail.com', 'Proteksi 8', '', '2019-12-26 09:18:03', '2019-12-26 09:18:03', 'PARSED', '2019-12-26 09:18:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_data_zurcih`
--
ALTER TABLE `tb_data_zurcih`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_data_zurcih`
--
ALTER TABLE `tb_data_zurcih`
  MODIFY `ID` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
