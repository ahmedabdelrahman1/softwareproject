-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 10:04 PM
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
-- Database: `miu`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detials` varchar(200) NOT NULL,
  `instructorID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`ID`, `name`, `detials`, `instructorID`, `price`, `sectionID`) VALUES
(1, 'c++', 'this is a course that teches you about the c++', 2, 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table`
--

CREATE TABLE `pdf_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pdf_file` varchar(100) NOT NULL,
  `sectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_table`
--

INSERT INTO `pdf_table` (`id`, `name`, `pdf_file`, `sectionID`) VALUES
(1, 'co', 'CO_Assignment2.pdf', 0),
(2, 'math', 'Assignment1and2.pdf', 1),
(3, 'lab3', 'Lab 3 – Introduction to Python - Part 2.pdf', 0),
(4, 'lab1', 'Fall23_CSC360_Lab 1 Pt. 2.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_table`
--

CREATE TABLE `section_table` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `courseID` int(11) NOT NULL,
  `detials` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section_table`
--

INSERT INTO `section_table` (`ID`, `name`, `courseID`, `detials`) VALUES
(1, 'Lecture', 1, 'Press to see all the lectures');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `type`) VALUES
(1, 'Bassel', 'AbdelRahim', 'basselshaaban1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student'),
(2, 'Ahmed', 'Gaber', 'Ahmed123@gmail', 'd93591bdf7860e1e4ee2fca799911215', 'instructor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pdf_table`
--
ALTER TABLE `pdf_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_table`
--
ALTER TABLE `section_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pdf_table`
--
ALTER TABLE `pdf_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section_table`
--
ALTER TABLE `section_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
