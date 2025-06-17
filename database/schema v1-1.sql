-- VERSION 1.1
-- Change: student_registerd_class: last_month_end and remark default to NULL

-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: pro-music
-- ------------------------------------------------------
-- Server version	5.5.16-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addr1` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `addr2` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `father_work_tel` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `father_cell_tel` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `mother_work_tel` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `mother_cell_tel` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `home_tel` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `province` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `parents_email` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `parents_names` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `Index_4` (`home_tel`,`parents_names`),
  KEY `Index_2` (`home_tel`),
  KEY `Index_3` (`parents_names`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adhoc_payments`
--

DROP TABLE IF EXISTS `adhoc_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adhoc_payments` (
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `reference` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `cheque_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `cheque_num` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `school_year` char(10) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`payment_id`) USING BTREE,
  KEY `Index_2` (`date`),
  KEY `Index_3` (`student_id`),
  KEY `Index_5` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `class_schedule`
--

DROP TABLE IF EXISTS `class_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_schedule` (
  `course_id` int(10) unsigned NOT NULL,
  `grade` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `duration` smallint(5) unsigned DEFAULT NULL,
  `cancelled` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `cancelled_time` datetime DEFAULT NULL,
  `external_rate` decimal(10,2) DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `remarks` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dow` smallint(5) unsigned DEFAULT NULL COMMENT 'Day of week',
  `rescheduled_from` int(10) unsigned DEFAULT NULL,
  `internal_cost` decimal(10,2) DEFAULT NULL COMMENT 'teacher''s cost',
  `class_type` char(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'MW-makeup from W mins, MT-makeup from T mins',
  `cost_type` char(2) COLLATE latin1_general_ci DEFAULT NULL,
  `from_student_credit_id` int(10) unsigned DEFAULT NULL COMMENT 'student_credit_id where minutes come from',
  `to_student_credit_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `Index_1` (`date`),
  KEY `Index_2` (`cancelled`),
  KEY `Index_5` (`student_id`),
  KEY `Index_6` (`teacher_id`),
  KEY `Index_7` (`dow`),
  KEY `Index_3` (`course_id`),
  KEY `Index_8` (`from_student_credit_id`) USING BTREE,
  KEY `Index_9` (`from_student_credit_id`),
  KEY `Index_10` (`to_student_credit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `category` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `current` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`course_id`),
  KEY `Index_1` (`course_name`),
  KEY `Index_2` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `credit_transfers`
--

DROP TABLE IF EXISTS `credit_transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_transfers` (
  `transfer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_student_id` int(10) unsigned DEFAULT NULL,
  `to_student_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `from_credit_id` int(10) unsigned DEFAULT NULL,
  `to_credit_id` int(10) unsigned DEFAULT NULL,
  `remarks` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `transfer_type` char(6) COLLATE latin1_general_ci NOT NULL COMMENT 'W, T, WOT, CXL, A - self adjustment',
  `minutes` smallint(5) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transfer_id`),
  KEY `Index_2` (`from_student_id`),
  KEY `Index_3` (`to_student_id`),
  KEY `Index_4` (`date`),
  KEY `Index_5` (`from_credit_id`),
  KEY `Index_6` (`to_credit_id`),
  KEY `Index_7` (`transfer_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!50001 DROP VIEW IF EXISTS `enrollment`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `enrollment` (
  `school_year` char(10),
  `Parents` varchar(100),
  `Name` varchar(60),
  `Home Phone` varchar(30),
  `mother_work_tel` varchar(100),
  `mother_cell_tel` varchar(100),
  `student_id` int(10) unsigned,
  `account_id` int(10) unsigned,
  `course_id` int(10) unsigned,
  `Course` varchar(45),
  `Teacher` varchar(60),
  `Start Date` date,
  `End Date` date,
  `grade` varchar(20),
  `dow` smallint(5) unsigned,
  `time` varchar(10),
  `duration` smallint(5) unsigned,
  `fee` decimal(19,6)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `group_lesson`
--

DROP TABLE IF EXISTS `group_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_lesson` (
  `group_lesson_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_lesson` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_lesson_id`),
  KEY `Index_2` (`group_lesson`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_lesson_members`
--

DROP TABLE IF EXISTS `group_lesson_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_lesson_members` (
  `group_lesson_member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT 'student_id or teacher_id',
  `member_type` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S' COMMENT 'S or T',
  `remarks` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `group_lesson_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`group_lesson_member_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_lesson_payments`
--

DROP TABLE IF EXISTS `group_lesson_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_lesson_payments` (
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `group_lesson_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`) USING BTREE,
  KEY `Index_2` (`teacher_id`),
  KEY `Index_3` (`date`),
  KEY `Index_4` (`group_lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `holdcheques`
--

DROP TABLE IF EXISTS `holdcheques`;
/*!50001 DROP VIEW IF EXISTS `holdcheques`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `holdcheques` (
  `student_id` int(10) unsigned,
  `month` char(8),
  `cheque_num` varchar(10),
  `amount` decimal(10,2),
  `cheque_name` varchar(45),
  `payment_method` varchar(45),
  `status` char(2),
  `remarks` varchar(100),
  `number_of_lessons` smallint(5) unsigned,
  `duration` smallint(5) unsigned,
  `external_rate` decimal(10,2),
  `scheduled_payment_id` int(10) unsigned,
  `course_id` int(10) unsigned,
  `cheque_date` date,
  `timestamp` timestamp,
  `school_year` char(10)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `Email` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Group` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Username` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `misc_items`
--

DROP TABLE IF EXISTS `misc_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `misc_items` (
  `misc_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `school_year` char(10) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`misc_item_id`),
  KEY `Index_2` (`student_id`),
  KEY `Index_3` (`date`),
  KEY `Index_4` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC COMMENT='Miscellaneous Dollar adjustments';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `month_end`
--

DROP TABLE IF EXISTS `month_end`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `month_end` (
  `monthend_rec_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `month` char(8) COLLATE latin1_general_ci NOT NULL COMMENT 'e.g. 2007-12',
  `num_lessons` smallint(5) unsigned NOT NULL,
  `total_mins` smallint(5) unsigned NOT NULL,
  `extra_mins` smallint(5) unsigned NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `PD_cheque` decimal(10,2) NOT NULL,
  `wmins_this_month` smallint(5) unsigned NOT NULL,
  `tmins_this_month` smallint(5) unsigned NOT NULL,
  `cur_year_wmins` smallint(5) unsigned NOT NULL,
  `cur_year_wamt` decimal(10,2) NOT NULL,
  `wmins_used_this_month` smallint(5) unsigned NOT NULL,
  `wamts_used_this_month` decimal(10,2) NOT NULL,
  `wcredit_this_month` decimal(10,2) NOT NULL,
  `cur_year_tmins` smallint(5) unsigned NOT NULL,
  `cur_year_tamt` decimal(10,2) NOT NULL,
  `tmins_used_this_month` smallint(5) unsigned NOT NULL,
  `tamts_used_this_month` decimal(10,2) NOT NULL,
  `tcredits_this_month` decimal(10,2) NOT NULL,
  `cash_balance` decimal(10,2) NOT NULL,
  `cash_used_this_month` decimal(10,2) NOT NULL,
  `adhoc_payments` decimal(10,2) NOT NULL,
  `misc_items` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`monthend_rec_id`),
  KEY `Index_2` (`student_id`),
  KEY `Index_3` (`course_id`),
  KEY `Index_4` (`month`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_holidays`
--

DROP TABLE IF EXISTS `school_holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_holidays` (
  `holiday_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `Description` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned DEFAULT NULL,
  `sex` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `discount` smallint(5) unsigned NOT NULL DEFAULT '0',
  `discount_expiry_date` date NOT NULL DEFAULT '1900-01-01',
  `student_email` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `related_friends` mediumtext COLLATE latin1_general_ci,
  `last_name` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `given_name` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `name_tie_breaker` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `full_name` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `group_lessons` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT 'None',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`),
  KEY `Index_3` (`account_id`),
  KEY `Index_2` (`full_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_credit_minutes`
--

DROP TABLE IF EXISTS `student_credit_minutes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_credit_minutes` (
  `student_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `minutes` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL COMMENT 'class_id + credit_type is a unique record',
  `credit_type` char(2) CHARACTER SET latin1 DEFAULT NULL COMMENT 'W, T, CXL',
  `remarks` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `status` char(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Cancel',
  `minute_balance` int(10) unsigned DEFAULT NULL COMMENT 'in minutes',
  `student_credit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `external_rate` decimal(10,2) DEFAULT NULL,
  `internal_cost` decimal(10,2) DEFAULT NULL,
  `cost_type` char(2) COLLATE latin1_general_ci DEFAULT NULL,
  `minutes_go_to` varchar(200) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'class_id''s where these minutes were credited to',
  `date` date NOT NULL COMMENT 'date of original class',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_credit_id`),
  UNIQUE KEY `Index_3` (`class_id`) USING BTREE,
  KEY `Index_2` (`course_id`),
  KEY `Index_4` (`student_id`),
  KEY `Index_5` (`credit_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_registered_classes`
--

DROP TABLE IF EXISTS `student_registered_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_registered_classes` (
  `student_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `dow` smallint(5) unsigned DEFAULT NULL COMMENT 'current dow',
  `cash` decimal(10,2) DEFAULT '0.00' COMMENT 'cash balance only for this course',
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `registered_class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dow_change_date` date DEFAULT NULL COMMENT 'start date for new dow',
  `last_month_end` char(8) COLLATE latin1_general_ci DEFAULT NULL COMMENT '2007-01, 2007-12, etc',
  `school_year` char(10) COLLATE latin1_general_ci NOT NULL COMMENT 'e.g. 2007-2008',
  `time` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `duration` smallint(5) unsigned NOT NULL,
  `external_rate` decimal(10,2) NOT NULL,
  `grade` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(20) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'T - terminated',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `internal_cost` decimal(10,2) DEFAULT NULL,
  `cost_type` char(2) COLLATE latin1_general_ci DEFAULT NULL,
  `remarks` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`registered_class_id`),
  KEY `Index_2` (`student_id`),
  KEY `Index_3` (`course_id`),
  KEY `Index_4` (`teacher_id`),
  KEY `Index_5` (`school_year`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_scheduled_payments`
--

DROP TABLE IF EXISTS `student_scheduled_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_scheduled_payments` (
  `student_id` int(10) unsigned NOT NULL,
  `month` char(8) COLLATE latin1_general_ci NOT NULL COMMENT 'e.g. 2007-12',
  `cheque_num` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `cheque_name` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `payment_method` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `status` char(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'R - received, D - desposted, B - bounced',
  `remarks` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `number_of_lessons` smallint(5) unsigned DEFAULT NULL,
  `duration` smallint(5) unsigned DEFAULT NULL,
  `external_rate` decimal(10,2) DEFAULT NULL,
  `scheduled_payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `cheque_date` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `school_year` char(10) COLLATE latin1_general_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`scheduled_payment_id`),
  KEY `Index_1` (`student_id`),
  KEY `Index_3` (`cheque_date`),
  KEY `Index_4` (`month`) USING BTREE,
  KEY `Index_5` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `studentsbyteacher`
--

DROP TABLE IF EXISTS `studentsbyteacher`;
/*!50001 DROP VIEW IF EXISTS `studentsbyteacher`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `studentsbyteacher` (
  `year` char(10),
  `teacher` varchar(60),
  `last_name` varchar(45),
  `given_name` varchar(45),
  `course_name` varchar(45),
  `start_date` date,
  `end_date` date,
  `home_tel` varchar(30),
  `mother_work_tel` varchar(100),
  `mother_cell_tel` varchar(100),
  `father_work_tel` varchar(100),
  `father_cell_tel` varchar(100)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `teacher_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `home_tel` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `cell_tel` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `SIN` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `addr1` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `addr2` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `province` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `profile` text COLLATE latin1_general_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `other_tel` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `teacher_since` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `active` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`teacher_id`) USING BTREE,
  KEY `Index_2` (`teacher`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `teacher_payroll`
--

DROP TABLE IF EXISTS `teacher_payroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_payroll` (
  `teacher_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `remarks` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cheque_num` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `month` char(8) COLLATE latin1_general_ci DEFAULT NULL,
  `cheque_amount` decimal(10,2) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `Index_1` (`teacher_id`),
  KEY `Index_3` (`date`),
  KEY `Index_4` (`month`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `teacher_rate`
--

DROP TABLE IF EXISTS `teacher_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_rate` (
  `teacher_id` int(10) unsigned NOT NULL,
  `external_rate` decimal(10,2) NOT NULL,
  `split` decimal(10,2) DEFAULT '0.00',
  `fixed_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rate_category` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cost_type` char(2) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'S or F - fixed amt',
  `teacher_rate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grades_applied` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`teacher_rate_id`),
  KEY `Index_1` (`teacher_id`),
  KEY `Index_3` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `tuition`
--

DROP TABLE IF EXISTS `tuition`;
/*!50001 DROP VIEW IF EXISTS `tuition`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tuition` (
  `Name` varchar(60),
  `Course` varchar(45),
  `Year` int(4),
  `Fee` decimal(41,6)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` char(10) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `user_type` smallint(5) unsigned DEFAULT NULL COMMENT 'admin, user',
  `expiry_date` date DEFAULT NULL,
  `password_change_date` date DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `Index_2` (`user_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `enrollment`
--

/*!50001 DROP TABLE IF EXISTS `enrollment`*/;
/*!50001 DROP VIEW IF EXISTS `enrollment`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `enrollment` AS select `student_registered_classes`.`school_year` AS `school_year`,`account`.`parents_names` AS `Parents`,`student`.`full_name` AS `Name`,`account`.`home_tel` AS `Home Phone`,`account`.`mother_work_tel` AS `mother_work_tel`,`account`.`mother_cell_tel` AS `mother_cell_tel`,`student`.`student_id` AS `student_id`,`account`.`account_id` AS `account_id`,`course`.`course_id` AS `course_id`,`course`.`course_name` AS `Course`,`teacher`.`teacher` AS `Teacher`,`student_registered_classes`.`start_date` AS `Start Date`,`student_registered_classes`.`end_date` AS `End Date`,`student_registered_classes`.`grade` AS `grade`,`student_registered_classes`.`dow` AS `dow`,`student_registered_classes`.`time` AS `time`,`student_registered_classes`.`duration` AS `duration`,((`student_registered_classes`.`external_rate` * `student_registered_classes`.`duration`) / 15) AS `fee` from ((((`student_registered_classes` join `student`) join `account`) join `course`) join `teacher`) where ((`student_registered_classes`.`student_id` = `student`.`student_id`) and (`student`.`account_id` = `account`.`account_id`) and (`student_registered_classes`.`course_id` = `course`.`course_id`) and (`student_registered_classes`.`teacher_id` = `teacher`.`teacher_id`)) order by `account`.`parents_names`,`account`.`home_tel`,`student`.`full_name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `holdcheques`
--

/*!50001 DROP TABLE IF EXISTS `holdcheques`*/;
/*!50001 DROP VIEW IF EXISTS `holdcheques`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `holdcheques` AS select `student_scheduled_payments`.`student_id` AS `student_id`,`student_scheduled_payments`.`month` AS `month`,`student_scheduled_payments`.`cheque_num` AS `cheque_num`,`student_scheduled_payments`.`amount` AS `amount`,`student_scheduled_payments`.`cheque_name` AS `cheque_name`,`student_scheduled_payments`.`payment_method` AS `payment_method`,`student_scheduled_payments`.`status` AS `status`,`student_scheduled_payments`.`remarks` AS `remarks`,`student_scheduled_payments`.`number_of_lessons` AS `number_of_lessons`,`student_scheduled_payments`.`duration` AS `duration`,`student_scheduled_payments`.`external_rate` AS `external_rate`,`student_scheduled_payments`.`scheduled_payment_id` AS `scheduled_payment_id`,`student_scheduled_payments`.`course_id` AS `course_id`,`student_scheduled_payments`.`cheque_date` AS `cheque_date`,`student_scheduled_payments`.`timestamp` AS `timestamp`,`student_scheduled_payments`.`school_year` AS `school_year` from `student_scheduled_payments` where ((`student_scheduled_payments`.`status` = _latin1'H') or (`student_scheduled_payments`.`status` = _latin1'LH')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `studentsbyteacher`
--

/*!50001 DROP TABLE IF EXISTS `studentsbyteacher`*/;
/*!50001 DROP VIEW IF EXISTS `studentsbyteacher`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `studentsbyteacher` AS select `student_registered_classes`.`school_year` AS `year`,`teacher`.`teacher` AS `teacher`,`student`.`last_name` AS `last_name`,`student`.`given_name` AS `given_name`,`course`.`course_name` AS `course_name`,`student_registered_classes`.`start_date` AS `start_date`,`student_registered_classes`.`end_date` AS `end_date`,`account`.`home_tel` AS `home_tel`,`account`.`mother_work_tel` AS `mother_work_tel`,`account`.`mother_cell_tel` AS `mother_cell_tel`,`account`.`father_work_tel` AS `father_work_tel`,`account`.`father_cell_tel` AS `father_cell_tel` from ((((`student_registered_classes` join `student`) join `account`) join `teacher`) join `course`) where ((`student_registered_classes`.`student_id` = `student`.`student_id`) and (`student_registered_classes`.`teacher_id` = `teacher`.`teacher_id`) and (`student_registered_classes`.`course_id` = `course`.`course_id`) and (`student`.`account_id` = `account`.`account_id`)) order by `teacher`.`teacher` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tuition`
--

/*!50001 DROP TABLE IF EXISTS `tuition`*/;
/*!50001 DROP VIEW IF EXISTS `tuition`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tuition` AS select `student`.`full_name` AS `Name`,`course`.`course_name` AS `Course`,year(`class_schedule`.`date`) AS `Year`,sum(((`class_schedule`.`duration` * `class_schedule`.`external_rate`) / 15)) AS `Fee` from ((`student` join `course`) join `class_schedule`) where ((`class_schedule`.`student_id` = `student`.`student_id`) and (`class_schedule`.`course_id` = `course`.`course_id`) and (((`class_schedule`.`cancelled` <> _latin1'T') and (`class_schedule`.`cancelled` <> _latin1'W') and (`class_schedule`.`cancelled` <> _latin1'CXL')) or isnull(`class_schedule`.`cancelled`) or (`class_schedule`.`cancelled` = _latin1''))) group by `student`.`full_name`,`course`.`course_name`,year(`class_schedule`.`date`) order by `student`.`full_name`,`course`.`course_name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-24 10:34:38
