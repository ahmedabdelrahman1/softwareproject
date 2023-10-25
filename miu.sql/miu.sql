-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 12:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `coursedetails_table`
--

CREATE TABLE `coursedetails_table` (
  `ID` int(11) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `Duration` varchar(100) NOT NULL,
  `courseinfo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursedetails_table`
--

INSERT INTO `coursedetails_table` (`ID`, `Category`, `level`, `Duration`, `courseinfo`) VALUES
(1, 'Programming', 'Beginner level', '2 Hours', 'An introductory course for C++ is designed to provide a solid foundation for beginners in the world of programming. C++ is a versatile and powerful programming language often used for software development, game development, and systems programming. In this course, students typically learn the fundamentals of C++ syntax, data types, control structures, and functions. They are introduced to object-oriented programming (OOP) principles, which are central to C++, and gain an understanding of classes, objects, inheritance, and polymorphism.');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `preview` varchar(200) NOT NULL,
  `instructorID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `detailsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`ID`, `name`, `preview`, `instructorID`, `price`, `detailsID`) VALUES
(1, 'c++', 'this is a course that teches you about the c++', 2, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_table`
--

CREATE TABLE `enrollment_table` (
  `ID` int(11) NOT NULL,
  `studentID` int(100) NOT NULL,
  `courseID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_table`
--

INSERT INTO `enrollment_table` (`ID`, `studentID`, `courseID`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_url`, `user_id`) VALUES
(1, 'IMG-65398ef22f7be5.93129921.jpg', 8),
(2, 'IMG-653987dd2e7fe8.27204121.jpg', 10),
(3, 'IMG-65398fcb0956a8.83027716.jpg', 11);

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
(2, 'Ahmed', 'Gaber', 'Ahmed123@gmail', 'd93591bdf7860e1e4ee2fca799911215', 'instructor'),
(3, 'admin', 'admin', 'admin12@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(5, 'lob', 'a', 'Ahmed123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student'),
(6, 'omar', 'ddddddddd', 'omar123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student'),
(7, 'bassel', 'AbdelRahim', 'basselshaaban1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(11, '3enaby', 'man', '3enab@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursedetails_table`
--
ALTER TABLE `coursedetails_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enrollment_table`
--
ALTER TABLE `enrollment_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

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
-- AUTO_INCREMENT for table `coursedetails_table`
--
ALTER TABLE `coursedetails_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment_table`
--
ALTER TABLE `enrollment_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pdf_table`
--
ALTER TABLE `pdf_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `section_table`
--
ALTER TABLE `section_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
