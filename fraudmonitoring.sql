/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.9-MariaDB : Database - fraudmonitoring
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fraudmonitoring` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fraudmonitoring`;

/*Table structure for table `activity` */

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id_case` varchar(100) DEFAULT NULL,
  `activity_number` int(11) DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `original_filename` varchar(100) DEFAULT NULL,
  KEY `activity_number` (`activity_number`),
  KEY `id_case` (`id_case`),
  CONSTRAINT `activity_ibfk_5` FOREIGN KEY (`activity_number`) REFERENCES `activity_parameter` (`id_parameter`),
  CONSTRAINT `activity_ibfk_6` FOREIGN KEY (`id_case`) REFERENCES `case` (`id_case`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `activity` */

insert  into `activity`(`id_case`,`activity_number`,`activity_date`,`description`,`input_date`,`filename`,`mime`,`original_filename`) values ('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad',6,'2016-06-20','Blokiiir','2016-07-25','php5CBD.tmp.png','image/png','8.png');

/*Table structure for table `activity_parameter` */

DROP TABLE IF EXISTS `activity_parameter`;

CREATE TABLE `activity_parameter` (
  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_parameter`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `activity_parameter` */

insert  into `activity_parameter`(`id_parameter`,`description`,`status`) values (1,'Permintaan Blokir','0'),(2,'Blokir SLI','0'),(3,'Caring Pelanggan','0'),(4,'Respond Pelanggan','0'),(5,'Surat Pelanggan','0'),(6,'Tiketing','1'),(7,'Buka Blokir/Tagih','1');

/*Table structure for table `case` */

DROP TABLE IF EXISTS `case`;

CREATE TABLE `case` (
  `id_case` varchar(100) NOT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `case_parameter` int(11) DEFAULT NULL,
  `case_time` date DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `evidence` blob,
  `status` char(1) DEFAULT '0',
  `destination` varchar(100) DEFAULT NULL,
  `destination_number` varchar(15) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `number_of_call` int(11) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `original_filename` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_case`),
  KEY `telephonenumber` (`telephone_number`),
  KEY `case_parameter` (`case_parameter`),
  CONSTRAINT `case_ibfk_1` FOREIGN KEY (`case_parameter`) REFERENCES `case_parameter` (`id_parameter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `case` */

insert  into `case`(`id_case`,`telephone_number`,`case_parameter`,`case_time`,`description`,`evidence`,`status`,`destination`,`destination_number`,`duration`,`number_of_call`,`input_date`,`filename`,`mime`,`original_filename`) values ('76034255-9401-4fb8-8457-b93174ed6928','08229987096',1,'2016-05-18','completed',NULL,'0','Albania Barat','5343534534',7200,30,'2016-07-25','php9201.tmp.jpg','image/jpeg','12.jpg'),('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad','081383112806',2,'2016-06-20','Parah',NULL,'1','Indonesia','0314666789',3600,600,'2016-07-25','php9678.tmp.jpg','image/jpeg','4.jpg');

/*Table structure for table `case_parameter` */

DROP TABLE IF EXISTS `case_parameter`;

CREATE TABLE `case_parameter` (
  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_parameter`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `case_parameter` */

insert  into `case_parameter`(`id_parameter`,`description`) values (1,'One to Many'),(2,'Many to One'),(3,'Many to Many'),(7,'One to One');

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id_case` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `nipnas` varchar(30) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `nikam` varchar(30) DEFAULT NULL,
  `am` varchar(100) DEFAULT NULL,
  `telephone_am` varchar(15) DEFAULT NULL,
  `segment` char(3) DEFAULT NULL,
  `revenue` int(11) DEFAULT NULL,
  KEY `id_case` (`id_case`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id_case`) REFERENCES `case` (`id_case`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`id_case`,`telephone_number`,`nipnas`,`customer`,`nikam`,`am`,`telephone_am`,`segment`,`revenue`) values ('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad','081383112806',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('76034255-9401-4fb8-8457-b93174ed6928','08229987096',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `profileuser` */

DROP TABLE IF EXISTS `profileuser`;

CREATE TABLE `profileuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `previledge` char(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `profileuser` */

insert  into `profileuser`(`id`,`username`,`password`,`previledge`,`remember_token`) values (1,'minyman','$2y$10$5nwGenxxxEu2Ggl5IKrIUur0diRxhKl8ROpvYEjYtKkmpZi7WTC9S','1','K5Eg0waIr3u0O98MwFeRwqGgl7C0tlkctBSTEUexWRZVm0Jalzu9fNXFx29D'),(2,'asbun','$2y$10$WlMPY6oqr9aV6A8.x/Ez6uZ6i7DlFC6yjQuPt3ClwEZSpPjv9EpBq','0','XCfVe7mkReqEzKhlI4Vk7lausO1H5leE8j4OW0ZhphZIcZI7y1DvNjIVPnFT');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
