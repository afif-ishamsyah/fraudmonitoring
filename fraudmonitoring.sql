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

insert  into `activity`(`id_case`,`activity_number`,`activity_date`,`description`,`input_date`,`filename`,`mime`,`original_filename`) values ('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad',6,'2016-06-20','Blokiiir','2016-07-25','php5CBD.tmp.png','image/png','8.png'),('73c50273-25f4-4ae3-b132-e768687ba74d',4,'2016-07-23','Menunggu Respon','2016-07-26','php70CE.tmp.png','image/png','98.png');

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
  `telephone_number` varchar(15) DEFAULT NULL COMMENT 'nomor telpon',
  `case_parameter` int(11) DEFAULT NULL COMMENT 'jenis case',
  `case_time` date DEFAULT NULL COMMENT 'waktu case terjadi',
  `description` varchar(500) DEFAULT NULL COMMENT 'deskripsi',
  `evidence` blob COMMENT 'bukti',
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

insert  into `case`(`id_case`,`telephone_number`,`case_parameter`,`case_time`,`description`,`evidence`,`status`,`destination`,`destination_number`,`duration`,`number_of_call`,`input_date`,`filename`,`mime`,`original_filename`) values ('35d9ff51-4c0e-49ce-a3fb-20f3201b916f','081383112806',2,'2016-07-20','lagi lagi',NULL,'0','Jepang','42342342342',3600,30,'2016-07-25','php43AD.tmp.jpg','image/jpeg','96.jpg'),('73c50273-25f4-4ae3-b132-e768687ba74d','08145678990',3,'2015-07-20','Kejadian Pertama',NULL,'0','SIngapura','0923565432',3600,20,'2016-07-26','php6B3C.tmp.jpg','image/jpeg','99.jpg'),('76034255-9401-4fb8-8457-b93174ed6928','08229987096',1,'2016-05-18','completed',NULL,'0','Albania Barat','5343534534',7200,30,'2016-07-25','php9201.tmp.jpg','image/jpeg','12.jpg'),('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad','081383112806',2,'2016-06-20','Parah',NULL,'1','Indonesia','0314666789',3600,600,'2016-07-25','php9678.tmp.jpg','image/jpeg','4.jpg'),('b0f05071-ee60-4570-b11d-f3aaba9fbb31','02182608704',2,'2016-05-20','coba coba',NULL,'0','China','0314666789',60000,600,'2016-07-27','php1C9F.tmp.jpg','image/jpeg','3.jpg');

/*Table structure for table `case_parameter` */

DROP TABLE IF EXISTS `case_parameter`;

CREATE TABLE `case_parameter` (
  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_parameter`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `case_parameter` */

insert  into `case_parameter`(`id_parameter`,`description`) values (1,'One to Many'),(2,'Many to One'),(3,'Many to Many'),(7,'One to One');

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id_case` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `main_number` varchar(15) DEFAULT NULL,
  `nipnas` decimal(8,0) DEFAULT NULL,
  `customer` varchar(150) DEFAULT NULL,
  `nikam` decimal(6,0) DEFAULT NULL,
  `am` varchar(100) DEFAULT NULL,
  `installation` varchar(100) DEFAULT NULL,
  `segment` varchar(3) DEFAULT NULL,
  `revenue` decimal(15,0) DEFAULT NULL,
  KEY `id_case` (`id_case`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id_case`) REFERENCES `case` (`id_case`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`id_case`,`telephone_number`,`main_number`,`nipnas`,`customer`,`nikam`,`am`,`installation`,`segment`,`revenue`) values ('8ed14aea-fb89-4fc8-80ea-7f5400ec92ad','081383112806','081383112899',51122115,'PT Tunggangjaya',215512,'Yak','Surabaya','DBM',40000000),('76034255-9401-4fb8-8457-b93174ed6928','08229987096','08229987099',51133115,'Bank BRI',315513,'Ampas','Semarang','DMS',300000),('35d9ff51-4c0e-49ce-a3fb-20f3201b916f','081383112806','081383112899',9119119,'PT Indra Jaya Tbk',987789,'Isis','Jakarta','FRS',3000000),('73c50273-25f4-4ae3-b132-e768687ba74d','08145678990','08145678999',8900098,'Institut Lele',654456,'Surya ','Kejawan','BFS',50000),('b0f05071-ee60-4570-b11d-f3aaba9fbb31','02182608704','02182608708',43211234,'Asboen',123432,'Zig','Malaysia Barat','DSS',30);

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

insert  into `profileuser`(`id`,`username`,`password`,`previledge`,`remember_token`) values (1,'minyman','$2y$10$5nwGenxxxEu2Ggl5IKrIUur0diRxhKl8ROpvYEjYtKkmpZi7WTC9S','1','AnVLc0WqEQTDJ2LgoSPqqLcz7ct4bq3MEZ8V2UBkjnCYZkO5E8rEDIHexJC7'),(2,'asbun','$2y$10$WlMPY6oqr9aV6A8.x/Ez6uZ6i7DlFC6yjQuPt3ClwEZSpPjv9EpBq','0','dEXe3tu2gOXrHDmj4ot2rImKYZmbr7pnRUycmOyQ74irfjYmfIA0VFd4CvfY');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
