-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2019 at 01:35 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(11) NOT NULL,
  `className` varchar(255) NOT NULL,
  `form` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `className`, `form`) VALUES
(1, 'Acacia', 1),
(2, 'Begonia', 1),
(3, 'Ipomea', 1),
(4, 'Ixora', 1),
(5, 'Vanda', 1),
(6, 'Acacia', 2),
(7, 'Begonia', 2),
(8, 'Ipomea', 2),
(9, 'Ixora', 2),
(10, 'Vanda', 2),
(11, 'Acacia', 3),
(12, 'Begonia', 3),
(13, 'Ipomea', 3),
(14, 'Ixora', 3),
(15, 'Vanda', 3),
(16, 'Acacia', 4),
(17, 'Begonia', 4),
(18, 'Ipomea', 4),
(19, 'Ixora', 4),
(20, 'Vanda', 4),
(21, 'Acacia', 5),
(22, 'Begonia', 5),
(23, 'Ipomea', 5),
(24, 'Ixora', 5),
(25, 'Vanda', 5);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `teacherID` varchar(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseDesc` varchar(255) NOT NULL,
  `courseDate` varchar(255) NOT NULL,
  `courseTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `enrollID` int(11) NOT NULL,
  `studentID` varchar(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `homeworkID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `hmTitle` varchar(255) NOT NULL,
  `hmDesc` varchar(255) NOT NULL,
  `file` blob NOT NULL,
  `hmEndDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `personId` int(11) NOT NULL,
  `uniqueID` varchar(255) NOT NULL,
  `pName` varchar(255) NOT NULL,
  `pIC` varchar(255) NOT NULL,
  `pAge` int(11) NOT NULL,
  `pNoPhone` varchar(15) NOT NULL,
  `pAddress` varchar(255) NOT NULL,
  `pEmail` varchar(255) NOT NULL,
  `pRole` varchar(255) NOT NULL,
  `pStatus` varchar(255) NOT NULL,
  `pUsername` varchar(255) NOT NULL,
  `pPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personId`, `uniqueID`, `pName`, `pIC`, `pAge`, `pNoPhone`, `pAddress`, `pEmail`, `pRole`, `pStatus`, `pUsername`, `pPassword`) VALUES
(2, 'JB160001', 'muhammad nasri bin kamaruddin', '941211105211', 25, '0133512296', 'aa', 'aa@gmail.com', 'student', 'active', 'aa', 'aa'),
(3, 'JBC160001', 'bb', 'bb', 31, 'bb', 'bb', 'bb', 'teacher', 'active', 'bb', 'bb'),
(8, 'JB160002', 'mihun goreng', '941211105222', 25, '11', 'aa', 'mihun@gmail.com', 'student', 'active', 'mihun', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `personID`, `classID`) VALUES
('JB160001', 2, 16),
('JB160002', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE `submit` (
  `submitID` int(11) NOT NULL,
  `homeworkID` int(11) NOT NULL,
  `enrollID` int(11) NOT NULL,
  `file` blob NOT NULL,
  `submitDate` varchar(255) NOT NULL,
  `submitTime` varchar(255) NOT NULL,
  `mark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` varchar(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `personID`, `classID`) VALUES
('JBC160001', 3, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`enrollID`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homeworkID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`submitID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `enrollID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `homeworkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `personId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submit`
--
ALTER TABLE `submit`
  MODIFY `submitID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
