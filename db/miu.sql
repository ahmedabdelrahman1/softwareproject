-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 07:00 AM
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
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `ID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `cm_ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`ID`, `sectionID`, `cm_ID`, `studentID`, `grade`, `name`, `file`) VALUES
(3, 136, 9, 14, 10, 'omar assignment', '../assignments/Sheet 5 - Cache Memory.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'programing');

-- --------------------------------------------------------

--
-- Table structure for table `course_matrial_table`
--

CREATE TABLE `course_matrial_table` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `submission` tinyint(1) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_matrial_table`
--

INSERT INTO `course_matrial_table` (`id`, `name`, `file`, `sectionID`, `submission`, `deadline`) VALUES
(2, 'lob a', '../files/Phase2 Evaluation-F23.docx', 136, NULL, NULL),
(9, 'lab 4', '../files/CSC360 Study Case Assignment.pdf', 136, 1, '2023-12-12 11:01:00'),
(10, 'lab3', '../files/Sheet 5 - Answers - Cache Memory.pdf', 136, 1, '2023-12-11 11:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_req`
--

CREATE TABLE `course_req` (
  `ID` int(11) NOT NULL,
  `req` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_req`
--

INSERT INTO `course_req` (`ID`, `req`) VALUES
(1, 'ioeiroueeioe'),
(2, 'www'),
(3, 'yyyy');

-- --------------------------------------------------------

--
-- Table structure for table `course_req_value`
--

CREATE TABLE `course_req_value` (
  `ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `course_req_ID` int(11) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_req_value`
--

INSERT INTO `course_req_value` (`ID`, `course_ID`, `course_req_ID`, `value`) VALUES
(17, 24, 2, 'assssaadda');

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
  `Category` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `courseinfo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`ID`, `name`, `preview`, `instructorID`, `price`, `Category`, `level`, `startdate`, `enddate`, `courseinfo`) VALUES
(19, 'python', 'this course teaches you all you need to know about python', 2, 8000, 'programming', 'beginner', '2023-12-07', '2024-02-21', 'ppppppppp'),
(20, 'java', 'this course teaches you all you need to know about Java', 2, 8000, 'programming', 'beginner', '2023-12-15', '2024-02-15', 'llllllllllllllllllllllllllllllllllllllll'),
(24, 'c++ ', 'this course teaches you all you need to know about c++', 2, 8000, 'programming', 'beginner', '2023-12-22', '2023-12-27', 'uuuuuuuu');

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
(1, 13, 20),
(2, 14, 19),
(3, 13, 21),
(4, 17, 19),
(5, 17, 24);

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
(3, 'IMG-65398fcb0956a8.83027716.jpg', 11),
(4, ' ', 12),
(5, ' ', 13),
(6, ' ', 14),
(7, 'IMG-653a158ace3fd1.23382751.jpg', 15),
(8, 'IMG-653a3564940995.07524102.jpg', 16),
(9, ' ', 17);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `linkaddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `name`, `linkaddress`) VALUES
(1, 'mycourses', 'mycourses.php'),
(2, 'profile', 'profile.php'),
(3, 'about', 'about.php'),
(4, 'attendence', 'attendence.php'),
(5, 'book mark', 'bookmark.php'),
(6, 'courses', 'courses.php');

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
(136, 'Lecture', 19, 'Press to see all the lectures');

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
(13, 'bassel', 'aref', 'bassel123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student'),
(14, 'omar', 'ahmed', 'omar123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student'),
(15, 'kamel', 'aref', 'kamel123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'instructor'),
(16, 'moj', 'nm', 'bassel2119@gmail', '827ccb0eea8a706c4c34a16891f84e7b', 'student'),
(17, 'abdulla', 'ahmed', 'abdulla123@gmail.com', '09d024f43467614027f21200cf7ea926', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`ID`, `name`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'instructor'),
(4, 'vistor');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes_pages`
--

CREATE TABLE `usertypes_pages` (
  `ID` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypes_pages`
--

INSERT INTO `usertypes_pages` (`ID`, `usertype_id`, `page_id`) VALUES
(2, 3, 1),
(3, 3, 2),
(4, 3, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 5),
(9, 2, 6),
(10, 3, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_matrial_table`
--
ALTER TABLE `course_matrial_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_req`
--
ALTER TABLE `course_req`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `course_req_value`
--
ALTER TABLE `course_req_value`
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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usertypes_pages`
--
ALTER TABLE `usertypes_pages`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_matrial_table`
--
ALTER TABLE `course_matrial_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_req`
--
ALTER TABLE `course_req`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_req_value`
--
ALTER TABLE `course_req_value`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `enrollment_table`
--
ALTER TABLE `enrollment_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `section_table`
--
ALTER TABLE `section_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usertypes_pages`
--
ALTER TABLE `usertypes_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
