-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2016 at 06:05 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Mas_Sangre`
--
CREATE DATABASE IF NOT EXISTS `Mas_Sangre` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Mas_Sangre`;

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `account_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`account_id`, `person_id`, `email`, `password`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 15, 'loza', '$2y$10$Q8KjSwZxoo.b8SzLDUga3OtIKh4N0q2NIpCgVAjv/vLhLmHkXkKxG', '2016-09-10 08:58:43', '2016-09-10 08:58:43', 1),
(2, 15, 'loza', '$2y$10$vbdxd5z7SbOIF7GtMO..CO1ZGrdXhH1K/q1DIDT.7OmQVjO6X0ppa', '2016-09-10 08:59:46', '2016-09-10 08:59:46', 1),
(3, 15, 'loza', '$2y$10$/gBiAj3PXb0jFSSxsYuoDOuR6paIc3P6Hxgz7GGwCecxZrDH288Mq', '2016-09-10 09:02:06', '2016-09-10 09:02:06', 1),
(4, 15, 'loza', '$2y$10$X25aYB1nT0xoVwIBGxtwb.qjYYgitlmTFssI8S7EANvikRPVAON/W', '2016-09-10 09:02:17', '2016-09-10 09:02:17', 1),
(5, 15, 'loza', '$2y$10$kjX3L6EO8Paav1ZKj0qKLeTaSOOucI2AiKNmzl2FTwIOLWrALDKd.', '2016-09-10 09:04:21', '2016-09-10 09:04:21', 1),
(6, 15, 'loza', 'F', '2016-09-10 09:13:01', '2016-09-10 09:13:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `appointment_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `reminder_activated` tinyint(1) NOT NULL DEFAULT '1',
  `complete_flag` tinyint(1) NOT NULL DEFAULT '1',
  `comments` varchar(1500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_type`
--

CREATE TABLE `blood_type` (
  `blood_type_id` int(11) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_type`
--

INSERT INTO `blood_type` (`blood_type_id`, `blood_type`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 'O+', '2016-09-10 05:35:35', '2016-09-10 05:35:35', 1),
(2, 'O-', '2016-09-11 10:38:17', '2016-09-11 10:38:17', 1),
(3, 'A+', '2016-09-11 10:38:17', '2016-09-11 10:38:17', 1),
(6, 'A-', '2016-09-11 10:39:10', '2016-09-11 10:39:10', 1),
(7, 'B+', '2016-09-11 10:39:10', '2016-09-11 10:39:10', 1),
(8, 'B-', '2016-09-11 10:40:46', '2016-09-11 10:40:46', 1),
(9, 'AB+', '2016-09-11 10:40:46', '2016-09-11 10:40:46', 1),
(10, 'AB-', '2016-09-11 10:41:00', '2016-09-11 10:41:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Campaign`
--

CREATE TABLE `Campaign` (
  `campaign_id` int(11) NOT NULL,
  `creator_account_id` int(11) NOT NULL,
  `beneficiary_person_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `reward` int(11) NOT NULL,
  `beneficiary_identifier` varchar(250) DEFAULT NULL,
  `open_flag` tinyint(1) NOT NULL DEFAULT '1',
  `comments` varchar(1500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Campaign`
--

INSERT INTO `Campaign` (`campaign_id`, `creator_account_id`, `beneficiary_person_id`, `hospital_id`, `start_date`, `end_date`, `reward`, `beneficiary_identifier`, `open_flag`, `comments`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '21323', 1, 'asdasdas sadsad', '2016-09-10 22:31:13', '2016-09-10 22:31:13', 1),
(2, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:38:08', '2016-09-10 22:38:08', 1),
(3, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:47:37', '2016-09-10 22:47:37', 1),
(4, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:50:06', '2016-09-10 22:50:06', 1),
(5, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:51:46', '2016-09-10 22:51:46', 1),
(6, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:52:06', '2016-09-10 22:52:06', 1),
(7, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:52:16', '2016-09-10 22:52:16', 1),
(8, 1, 16, 1, '2016-09-08 00:00:00', '2016-09-21 00:00:00', 0, '8271262', 1, 'test asdasd', '2016-09-10 22:52:46', '2016-09-10 22:52:46', 1),
(9, 2, 15, 1, '2016-09-07 00:00:00', '2016-09-22 00:00:00', 0, 'AAAAAAA', 1, 'Comments', '2016-09-10 23:16:17', '2016-09-11 06:32:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Campaign_Blood_Type`
--

CREATE TABLE `Campaign_Blood_Type` (
  `campaign_blood_type` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `blood_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Donation`
--

CREATE TABLE `Donation` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Donor`
--

CREATE TABLE `Donor` (
  `donor_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donor`
--

INSERT INTO `Donor` (`donor_id`, `person_id`, `rank`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 15, 3, '2016-09-10 09:55:45', '2016-09-10 09:55:45', 1),
(2, 15, 3, '2016-09-10 09:57:07', '2016-09-10 09:57:07', 1),
(3, 15, 3, '2016-09-10 09:57:21', '2016-09-10 09:57:21', 1),
(4, 14, 3, '2016-09-10 09:57:28', '2016-09-10 09:57:28', 1),
(5, 14, 3, '2016-09-10 09:57:35', '2016-09-10 09:57:35', 1),
(6, 14, 3, '2016-09-10 09:57:41', '2016-09-10 09:57:41', 1),
(7, 14, 3, '2016-09-10 09:57:42', '2016-09-10 09:57:42', 1),
(8, 16, 3, '2016-09-10 09:57:50', '2016-09-10 09:57:50', 1),
(9, 16, 3, '2016-09-10 09:57:52', '2016-09-10 09:57:52', 1),
(10, 16, 3, '2016-09-10 09:57:53', '2016-09-10 09:57:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Donor_Hospital`
--

CREATE TABLE `Donor_Hospital` (
  `donor_hospital_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donor_Hospital`
--

INSERT INTO `Donor_Hospital` (`donor_hospital_id`, `donor_id`, `hospital_id`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 15, 1, '2016-09-10 13:12:17', '2016-09-10 13:12:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Hospital`
--

CREATE TABLE `Hospital` (
  `hospital_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `latitude` decimal(14,10) NOT NULL,
  `longitude` decimal(14,10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone1` varchar(15) NOT NULL,
  `telephone2` varchar(15) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `colony` varchar(100) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `token` tinyint(1) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `donation_morning` tinyint(1) NOT NULL,
  `donation_afternoon` tinyint(1) NOT NULL,
  `donation_night` tinyint(1) NOT NULL,
  `donation_all_day` tinyint(1) NOT NULL,
  `comments` varchar(1500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Hospital`
--

INSERT INTO `Hospital` (`hospital_id`, `name`, `latitude`, `longitude`, `email`, `telephone1`, `telephone2`, `street_name`, `colony`, `postal_code`, `city`, `state`, `token`, `open_time`, `close_time`, `donation_morning`, `donation_afternoon`, `donation_night`, `donation_all_day`, `comments`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 'Test', '32.3243430000', '12.3434300000', 'asdasd', '324324', '68', 'por ahi', 'asdsad', '89765', 'zapopan', 'jalisco', 0, '06:00:00', '22:00:00', 1, 1, 1, 1, 'Comentarios bonitos', '2016-09-10 13:00:55', '2016-09-10 13:00:55', 1),
(2, 'Hospital Civil de Guadalajara Fray Antonio Alcalde', '20.6878300000', '103.3459240000', '', '01 33 3942 4400', '', 'Calle Coronel Calderón 777', 'El Retiro', '44280', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 09:29:07', '2016-09-11 09:29:07', 1),
(3, 'Centro Médico Nacional de Occidente', '20.6862210000', '103.3293930000', '', '01 33 3617 0060', '', 'Avenida Belisario Domínguez 1000', 'Independencia Oriente', '44340', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 09:29:07', '2016-09-11 09:29:07', 1),
(5, 'Hospital General de Occidente', '20.7177030000', '-103.3718932000', '01 33 3030 6339', '', NULL, 'Av Zoquipan 1050', 'Seattle', '45170', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 09:58:59', '2016-09-11 09:58:59', 1),
(6, 'Hospital San Javier Guadalajara', '20.6879100000', '-103.3920630000', '', '01 33 3669 0222', NULL, 'Av Pablo Casals 640', 'Prados de Providencia', '44670', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 09:58:59', '2016-09-11 09:58:59', 1),
(7, 'Centro Médico Puerta de Hierro', '20.7084421000', '-103.4169038000', '', '01 33 3848 4000', NULL, 'Av Empresarios No. 150', 'Puerta de Hierro', '45116', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 10:35:06', '2016-09-11 10:35:06', 1),
(8, 'Hospital Civil Juan I. Menchaca', '20.7586378000', '-103.4820726000', '', '', '', 'Sierra Nevada 815', 'Independencia Oriente', '44340', 'Guadalajara', 'Jalisco', 0, '00:00:00', '00:00:00', 0, 0, 0, 0, '', '2016-09-11 10:35:06', '2016-09-11 10:35:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Inactivity_Request`
--

CREATE TABLE `Inactivity_Request` (
  `inactivity_request_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `reason` varchar(1500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `fathers_name` varchar(50) NOT NULL,
  `mothers_name` varchar(50) DEFAULT NULL,
  `genre` char(1) DEFAULT NULL,
  `blood_type_id` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_flag` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Information of person';

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`person_id`, `first_name`, `fathers_name`, `mothers_name`, `genre`, `blood_type_id`, `birth_date`, `email`, `telephone`, `weight`, `image`, `created_date`, `modified_date`, `valid_flag`) VALUES
(1, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:38:34', '2016-09-10 05:38:34', 1),
(2, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:39:43', '2016-09-10 05:39:43', 1),
(3, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:40:37', '2016-09-10 05:40:37', 1),
(4, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:41:59', '2016-09-10 05:41:59', 1),
(5, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:43:17', '2016-09-10 05:43:17', 1),
(6, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:43:19', '2016-09-10 05:43:19', 1),
(7, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:49:51', '2016-09-10 05:49:51', 1),
(8, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:49:52', '2016-09-10 05:49:52', 1),
(9, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '0000-00-00', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:55:05', '2016-09-10 05:55:05', 1),
(10, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '2000-09-09', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 05:59:57', '2016-09-10 05:59:57', 1),
(11, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '2000-09-09', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 06:00:19', '2016-09-10 06:00:19', 1),
(12, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '2000-09-09', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 06:00:31', '2016-09-10 06:00:31', 1),
(13, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '2000-09-09', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 06:01:26', '2016-09-10 06:01:26', 1),
(14, 'Out,In', 'Out,In', 'Out,[In]', 'M', 1, '2000-09-09', 'Out,[In]', '342343', '62.30', 'Out,[In]', '2016-09-10 06:05:01', '2016-09-10 06:05:01', 1),
(15, 'El TORO', 'Glez', 'loza', 'M', 1, '1988-09-19', 'Out@assd', '0987', '90.30', 'image', '2016-09-10 06:05:49', '2016-09-10 20:21:15', 0),
(16, 'Octavio', 'Glez', 'Loza', 'M', 0, '0000-00-00', 'octavio@gmail.co', '123', '0.00', '', '2016-09-10 06:06:16', '2016-09-11 03:17:57', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `blood_type`
--
ALTER TABLE `blood_type`
  ADD PRIMARY KEY (`blood_type_id`);

--
-- Indexes for table `Campaign`
--
ALTER TABLE `Campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `Campaign_Blood_Type`
--
ALTER TABLE `Campaign_Blood_Type`
  ADD PRIMARY KEY (`campaign_blood_type`);

--
-- Indexes for table `Donation`
--
ALTER TABLE `Donation`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `Donor`
--
ALTER TABLE `Donor`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `Donor_Hospital`
--
ALTER TABLE `Donor_Hospital`
  ADD PRIMARY KEY (`donor_hospital_id`);

--
-- Indexes for table `Hospital`
--
ALTER TABLE `Hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `Inactivity_Request`
--
ALTER TABLE `Inactivity_Request`
  ADD PRIMARY KEY (`inactivity_request_id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blood_type`
--
ALTER TABLE `blood_type`
  MODIFY `blood_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Campaign`
--
ALTER TABLE `Campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Campaign_Blood_Type`
--
ALTER TABLE `Campaign_Blood_Type`
  MODIFY `campaign_blood_type` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Donation`
--
ALTER TABLE `Donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Donor`
--
ALTER TABLE `Donor`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Donor_Hospital`
--
ALTER TABLE `Donor_Hospital`
  MODIFY `donor_hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Hospital`
--
ALTER TABLE `Hospital`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Inactivity_Request`
--
ALTER TABLE `Inactivity_Request`
  MODIFY `inactivity_request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
