-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 02:44 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentid` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `position` varchar(10) NOT NULL,
  `initials` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentid`, `userid`, `position`, `initials`, `created_at`, `updated_at`) VALUES
(1, 3, 'SRA', 'QQW', '2019-06-21 19:08:59', '2019-06-21 19:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `caseagent`
--

CREATE TABLE `caseagent` (
  `caseagentid` int(11) NOT NULL,
  `caseid` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `dateassigned` date NOT NULL,
  `agent_status` enum('Current','Previous') NOT NULL DEFAULT 'Current',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caseagent`
--

INSERT INTO `caseagent` (`caseagentid`, `caseid`, `userid`, `dateassigned`, `agent_status`, `created_at`, `updated_at`) VALUES
(4, 1, 3, '2019-06-05', 'Current', '2019-06-22 14:51:51', '2019-06-22 14:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `casenature`
--

CREATE TABLE `casenature` (
  `cnatureid` int(11) NOT NULL,
  `caseid` int(11) NOT NULL,
  `natureid` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casenature`
--

INSERT INTO `casenature` (`cnatureid`, `caseid`, `natureid`, `updated_at`, `created_at`) VALUES
(4, 1, 1, '2019-06-22 14:51:51', '2019-06-22 14:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `casereports`
--

CREATE TABLE `casereports` (
  `reportid` int(11) NOT NULL,
  `report` varchar(255) NOT NULL,
  `caseid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casereports`
--

INSERT INTO `casereports` (`reportid`, `report`, `caseid`, `created_at`, `updated_at`) VALUES
(1, 'FinalReport_QQW [I-00-0005].docx', 1, '2019-06-22 23:17:33', '2019-06-22 23:17:33'),
(2, 'report_QQW [I-00-0005](2019-06-22 11.26.15 PM).docx', 1, '2019-06-22 23:26:15', '2019-06-22 23:26:15'),
(3, 'report_QQW [I-00-0005] (2019-06-22 11.30.16 PM).docx', 1, '2019-06-22 23:30:16', '2019-06-22 23:30:16'),
(4, 'report_QQW [I-00-0005] (2019-06-22 11.54.40 PM).docx', 1, '2019-06-22 23:54:40', '2019-06-22 23:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `caseid` int(11) NOT NULL,
  `docketnumber` varchar(255) DEFAULT NULL,
  `ccn` varchar(255) DEFAULT NULL,
  `acmo` varchar(255) DEFAULT NULL,
  `complainantname` text NOT NULL,
  `complainant_organization` varchar(255) DEFAULT NULL,
  `complainant_Address` text,
  `complainant_Contact_Number` varchar(255) DEFAULT NULL,
  `dateTerminated` date DEFAULT NULL,
  `statusid` int(11) NOT NULL,
  `caseAvailability` enum('Available','Deleted','','') NOT NULL DEFAULT 'Available',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`caseid`, `docketnumber`, `ccn`, `acmo`, `complainantname`, `complainant_organization`, `complainant_Address`, `complainant_Contact_Number`, `dateTerminated`, `statusid`, `caseAvailability`, `updated_at`, `created_at`) VALUES
(1, 'I-00-0005', 'C-00-0123456789', '00-C-0123456789', 'Ako si Complainant Mahaba Pangalan', 'Mahaba Sana', 'P.O. Box 283 8562 Fusce Rd. Frederick Nebraska 20620', '09072358512', '2019-06-22', 2, 'Available', '2019-06-22 14:51:51', '2019-06-22 13:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `case_status`
--

CREATE TABLE `case_status` (
  `statusid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_status`
--

INSERT INTO `case_status` (`statusid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Under Investigation', '2019-06-18 00:05:17', '2019-06-18 00:05:17'),
(2, 'Solved with Prosecution', '2019-06-20 19:59:10', '2019-06-20 19:59:10'),
(3, 'Solved without Prosecution', '2019-06-20 19:59:30', '2019-06-20 19:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `case_suspects`
--

CREATE TABLE `case_suspects` (
  `id` int(11) NOT NULL,
  `caseid` int(11) NOT NULL,
  `suspect_name` varchar(255) NOT NULL,
  `suspect_Address` text,
  `suspect_Contact_Number` varchar(50) DEFAULT NULL,
  `suspect_Sex` enum('Male','Female') DEFAULT NULL,
  `suspect_Civil_Status` enum('Single','Married','Widowed','Separated','Divorced','Deceased') DEFAULT NULL,
  `suspect_Occupation` varchar(50) DEFAULT NULL,
  `status` enum('Guilty','Innocent') NOT NULL DEFAULT 'Guilty',
  `suspect_Age` varchar(11) DEFAULT NULL,
  `suspect_Age2` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `height2` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `weight2` varchar(255) DEFAULT NULL,
  `eye_color` varchar(255) DEFAULT NULL,
  `hair_color` varchar(255) DEFAULT NULL,
  `skin_tone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_suspects`
--

INSERT INTO `case_suspects` (`id`, `caseid`, `suspect_name`, `suspect_Address`, `suspect_Contact_Number`, `suspect_Sex`, `suspect_Civil_Status`, `suspect_Occupation`, `status`, `suspect_Age`, `suspect_Age2`, `height`, `height2`, `weight`, `weight2`, `eye_color`, `hair_color`, `skin_tone`, `created_at`, `updated_at`) VALUES
(4, 1, 'Wimbledondondon Dumugan Dumugmug', '606-3727 Ullamcorper. Street Roseville NH 11523', NULL, NULL, NULL, NULL, 'Guilty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-22 14:51:51', '2019-06-22 14:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `case_victims`
--

CREATE TABLE `case_victims` (
  `id` int(11) NOT NULL,
  `caseid` int(11) NOT NULL,
  `victim_name` varchar(255) DEFAULT NULL,
  `victim_Address` text,
  `victim_Contact_Number` varchar(50) DEFAULT NULL,
  `victim_Sex` enum('Male','Female') DEFAULT NULL,
  `victim_Age` int(5) DEFAULT NULL,
  `victim_Civil_Status` enum('Single','Married','Separated','Divorced','Widowed','Deceased') DEFAULT NULL,
  `victim_Occupation` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_victims`
--

INSERT INTO `case_victims` (`id`, `caseid`, `victim_name`, `victim_Address`, `victim_Contact_Number`, `victim_Sex`, `victim_Age`, `victim_Civil_Status`, `victim_Occupation`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-22 14:51:51', '2019-06-22 14:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `complaintsheet`
--

CREATE TABLE `complaintsheet` (
  `id` int(11) NOT NULL,
  `caseid` int(11) NOT NULL,
  `place_Committed` text,
  `date_Committed` text,
  `narration_Of_Facts` text,
  `reported_Any_Agency` text,
  `status_of_Investigation` text,
  `where_court_Proceedings` text,
  `report_Considerations` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaintsheet`
--

INSERT INTO `complaintsheet` (`id`, `caseid`, `place_Committed`, `date_Committed`, `narration_Of_Facts`, `reported_Any_Agency`, `status_of_Investigation`, `where_court_Proceedings`, `report_Considerations`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-22 13:44:25', '2019-06-22 13:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyid` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `login` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyid`, `userid`, `login`, `logout`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-06-20 19:40:24', NULL, '2019-06-20 19:40:24', '2019-06-20 19:40:24'),
(2, 1, '2019-06-21 18:19:21', '2019-06-21 18:30:13', '2019-06-21 18:19:21', '2019-06-21 18:30:13'),
(3, 1, '2019-06-21 18:34:30', NULL, '2019-06-21 18:34:30', '2019-06-21 18:34:30'),
(4, 1, '2019-06-22 13:40:34', '2019-06-22 15:35:09', '2019-06-22 13:40:34', '2019-06-22 15:35:09'),
(5, 2, '2019-06-22 14:11:27', '2019-06-22 14:12:06', '2019-06-22 14:11:27', '2019-06-22 14:12:06'),
(6, 3, '2019-06-22 14:12:14', '2019-06-22 15:01:44', '2019-06-22 14:12:14', '2019-06-22 15:01:44'),
(7, 2, '2019-06-22 15:02:23', '2019-06-22 15:03:45', '2019-06-22 15:02:23', '2019-06-22 15:03:45'),
(8, 3, '2019-06-22 15:04:10', '2019-06-22 15:35:01', '2019-06-22 15:04:10', '2019-06-22 15:35:01'),
(9, 3, '2019-06-22 15:47:43', '2019-06-22 16:01:49', '2019-06-22 15:47:43', '2019-06-22 16:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logid` int(11) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `logs_caseid` int(11) DEFAULT NULL,
  `action` enum('Add','Update','Delete','Insert','Archived','Unarchived') NOT NULL,
  `description` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logid`, `userid`, `logs_caseid`, `action`, `description`, `updated_at`, `created_at`) VALUES
(1, 1, NULL, 'Add', 'Administrator register new user with the username = damdamin', '2019-06-20 19:45:18', '2019-06-20 19:45:18'),
(2, 1, NULL, 'Add', 'Administrator add new case status with status name = Solved with Prosecution', '2019-06-20 19:59:10', '2019-06-20 19:59:10'),
(3, 1, NULL, 'Add', 'Administrator add new case status with status name = Solved without Prosecution', '2019-06-20 19:59:30', '2019-06-20 19:59:30'),
(4, 1, NULL, 'Update', 'Administrator user details update, with the username = damdamin', '2019-06-21 18:40:27', '2019-06-21 18:40:27'),
(5, 1, NULL, 'Update', 'Administrator user details update, with the username = damdamin', '2019-06-21 18:40:41', '2019-06-21 18:40:41'),
(6, 1, NULL, 'Add', 'Administrator register new user with the username = qwerty', '2019-06-21 19:08:59', '2019-06-21 19:08:59'),
(7, 1, NULL, 'Add', 'Administrator add new case nature with nature name = Rape', '2019-06-21 19:09:28', '2019-06-21 19:09:28'),
(8, 1, NULL, 'Add', 'Administrator add new with docketnumber = I-00-0005', '2019-06-22 13:44:25', '2019-06-22 13:44:25'),
(9, 1, NULL, 'Update', 'Administrator reset user password, with the username = damdamin', '2019-06-22 14:11:21', '2019-06-22 14:11:21'),
(10, 1, NULL, 'Update', 'Administrator reset user password, with the username = qwerty', '2019-06-22 14:11:51', '2019-06-22 14:11:51'),
(11, 1, NULL, 'Update', 'Administrator update the case information with case docketnumber = I-00-0005', '2019-06-22 14:48:22', '2019-06-22 14:48:22'),
(12, 1, NULL, 'Update', 'Administrator update the case information with case docketnumber = I-00-0005', '2019-06-22 14:49:46', '2019-06-22 14:49:46'),
(13, 1, NULL, 'Update', 'Administrator update the case information with case docketnumber = I-00-0005', '2019-06-22 14:51:51', '2019-06-22 14:51:51'),
(14, 3, 1, 'Add', 'SRA Werty uploaded a report in case I-00-0005', '2019-06-22 15:17:34', '2019-06-22 15:17:34'),
(15, 3, 1, 'Add', 'SRA Werty uploaded a report in case I-00-0005', '2019-06-22 15:26:16', '2019-06-22 15:26:16'),
(16, 3, 1, 'Add', 'SRA Werty uploaded a report in case I-00-0005', '2019-06-22 15:30:16', '2019-06-22 15:30:16'),
(17, 3, 1, 'Add', 'SRA Werty uploaded a report in case I-00-0005', '2019-06-22 15:54:40', '2019-06-22 15:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `nature`
--

CREATE TABLE `nature` (
  `natureid` int(11) NOT NULL,
  `nature` varchar(255) NOT NULL,
  `casetype` enum('Crime') NOT NULL DEFAULT 'Crime',
  `natureAvailability` enum('Available','Deleted','','') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nature`
--

INSERT INTO `nature` (`natureid`, `nature`, `casetype`, `natureAvailability`, `created_at`, `updated_at`) VALUES
(1, 'Rape', 'Crime', 'Available', '2019-06-21 19:09:28', '2019-06-21 19:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleInitial` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('Investigator','Encoder','Administrator') COLLATE utf8mb4_unicode_ci NOT NULL,
  `userStatus` enum('Active','Inactive','Deleted','Reassigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstName`, `middleInitial`, `lastName`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `userStatus`) VALUES
(1, 'Rowena Ruth', 'A', 'Valbuena', 'wengruth', '$2y$10$UTw2Cu6CU5fLujfUd9GM...uiNK4mmsGNyiQaWn.9/gDxEc90FGn.', 'pXc6LsSkdNn9OA1NTgL2lMlsyxt9wHjIPfaTsiM0hTVzXzPMf37AgjKb27wq', '2019-06-18 00:04:55', '2019-06-18 00:04:55', 'Administrator', 'Active'),
(2, 'Dam', 'P', 'Dam', 'damdamin', '$2y$10$GcHF5QReOfwmtgvvC6hBD.F5PRz0zQ6g7zt9uiOhNFN6.fpdxT34G', 'VqAJVjnsul1fP7C31LUXcMuUdNQoKf6ZtO6gVC4e1u9us2kzOcKbbOcyIwPx', '2019-06-20 19:45:18', '2019-06-21 18:40:41', 'Encoder', 'Active'),
(3, 'Qwerty', 'Q.', 'Werty', 'qwerty', '$2y$10$YnGCmerUUtfptQnaCJ7MWeOF8cbs4cEXFBvi3D9xJnsXSFi76F676', 'tbptQxEf38Bxu0JG8HsjcJlGvMS8UJdDEzG6MCjtyk7bZM7VhDUbm1iqd8Fe', '2019-06-21 19:08:58', '2019-06-21 19:08:58', 'Investigator', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentid`),
  ADD UNIQUE KEY `initials` (`initials`),
  ADD KEY `userid_fk1` (`userid`);

--
-- Indexes for table `caseagent`
--
ALTER TABLE `caseagent`
  ADD PRIMARY KEY (`caseagentid`),
  ADD KEY `userid_fk2` (`userid`),
  ADD KEY `caseid_fk2` (`caseid`);

--
-- Indexes for table `casenature`
--
ALTER TABLE `casenature`
  ADD PRIMARY KEY (`cnatureid`),
  ADD KEY `caseid_fk1` (`caseid`),
  ADD KEY `natureid_fk1` (`natureid`);

--
-- Indexes for table `casereports`
--
ALTER TABLE `casereports`
  ADD PRIMARY KEY (`reportid`),
  ADD KEY `caseid_fk20` (`caseid`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`caseid`),
  ADD UNIQUE KEY `docketnumber` (`docketnumber`,`ccn`,`acmo`),
  ADD KEY `statusid_fk1` (`statusid`);

--
-- Indexes for table `case_status`
--
ALTER TABLE `case_status`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `case_suspects`
--
ALTER TABLE `case_suspects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_suspect_caseid` (`caseid`);

--
-- Indexes for table `case_victims`
--
ALTER TABLE `case_victims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_victim_caseid` (`caseid`);

--
-- Indexes for table `complaintsheet`
--
ALTER TABLE `complaintsheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseid` (`caseid`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyid`),
  ADD KEY `userid_fk4` (`userid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `userid_fk5` (`userid`),
  ADD KEY `logs_caseid_fk` (`logs_caseid`);

--
-- Indexes for table `nature`
--
ALTER TABLE `nature`
  ADD PRIMARY KEY (`natureid`),
  ADD UNIQUE KEY `nature` (`nature`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `caseagent`
--
ALTER TABLE `caseagent`
  MODIFY `caseagentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `casenature`
--
ALTER TABLE `casenature`
  MODIFY `cnatureid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `casereports`
--
ALTER TABLE `casereports`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `caseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_status`
--
ALTER TABLE `case_status`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `case_suspects`
--
ALTER TABLE `case_suspects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `case_victims`
--
ALTER TABLE `case_victims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaintsheet`
--
ALTER TABLE `complaintsheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nature`
--
ALTER TABLE `nature`
  MODIFY `natureid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `userid_fk1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `caseagent`
--
ALTER TABLE `caseagent`
  ADD CONSTRAINT ` caseid_fk2` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid_fk2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `casenature`
--
ALTER TABLE `casenature`
  ADD CONSTRAINT `caseid_fk1` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `natureid_fk1` FOREIGN KEY (`natureid`) REFERENCES `nature` (`natureid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `casereports`
--
ALTER TABLE `casereports`
  ADD CONSTRAINT `caseid_fk50` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON UPDATE CASCADE;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `statusid_fk1` FOREIGN KEY (`statusid`) REFERENCES `case_status` (`statusid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case_suspects`
--
ALTER TABLE `case_suspects`
  ADD CONSTRAINT `case_suspect_caseid` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case_victims`
--
ALTER TABLE `case_victims`
  ADD CONSTRAINT `case_victim_caseid` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaintsheet`
--
ALTER TABLE `complaintsheet`
  ADD CONSTRAINT `caseidFK_complaintSheet` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `userid_fk4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_caseid_fk` FOREIGN KEY (`logs_caseid`) REFERENCES `cases` (`caseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid_fk5` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
