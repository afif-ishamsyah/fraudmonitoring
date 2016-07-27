/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.9-MariaDB : Database - fastel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fastel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fastel`;

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `notel` varchar(15) NOT NULL,
  `nipnas` decimal(8,0) DEFAULT NULL,
  `namacc` varchar(150) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `nikam` decimal(6,0) DEFAULT NULL,
  `namaam` varchar(100) DEFAULT NULL,
  `segment` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`notel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`notel`,`nipnas`,`namacc`,`alamat`,`nikam`,`namaam`,`segment`) values ('02182608708',43211234,'Asboen','Malaysia Barat',123432,'Zig','DSS');

/*Table structure for table `revenue` */

DROP TABLE IF EXISTS `revenue`;

CREATE TABLE `revenue` (
  `notel` varchar(15) DEFAULT NULL,
  `rev1` decimal(15,0) DEFAULT NULL,
  `rev2` decimal(15,0) DEFAULT NULL,
  `rev3` decimal(15,0) DEFAULT NULL,
  `average` decimal(15,0) DEFAULT NULL,
  KEY `notel` (`notel`),
  CONSTRAINT `revenue_ibfk_1` FOREIGN KEY (`notel`) REFERENCES `profile` (`notel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `revenue` */

insert  into `revenue`(`notel`,`rev1`,`rev2`,`rev3`,`average`) values ('02182608708',30,30,30,30);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
