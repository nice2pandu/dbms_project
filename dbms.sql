/*
SQLyog Ultimate v9.20 
MySQL - 5.7.35-0ubuntu0.18.04.1 : Database - dbmanagement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbmanagement` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbmanagement`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e');

/*Table structure for table `host_ip` */

DROP TABLE IF EXISTS `host_ip`;

CREATE TABLE `host_ip` (
  `id` int(10) DEFAULT '1',
  `session_ip` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `host_ip` */

insert  into `host_ip`(`id`,`session_ip`) values (1,'49.43.227.48');

/*Table structure for table `user_login` */

DROP TABLE IF EXISTS `user_login`;

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `remote_ip` varchar(20) DEFAULT NULL,
  `user_password` varchar(300) DEFAULT NULL,
  `user_session_id` varchar(255) DEFAULT '0',
  `posting_date` date NOT NULL,
  `expeiry_days` int(10) DEFAULT '0',
  `expeiry_date` date DEFAULT NULL,
  `db_options` varchar(255) DEFAULT NULL,
  `db_display_names` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `user_login` */

insert  into `user_login`(`id`,`user_name`,`user_email`,`mobile`,`remote_ip`,`user_password`,`user_session_id`,`posting_date`,`expeiry_days`,`expeiry_date`,`db_options`,`db_display_names`,`price`) values (1,'admin','admin@gmail.com','11',NULL,'d0970714757783e6cf17b26fb8e2298f','hooc8h4vsuo3poiund2r6qq0qi','2020-12-04',NULL,NULL,'APTS2020,GHMC2020',NULL,NULL),(19,'user','user@gmail.com','9959818521','49.37.158.91','e10adc3949ba59abbe56e057f20f883e','2e5ef07kgg0msc7139n5bl7qgs','2025-06-04',30,'2025-06-05','advgujarat.`gdata`, apts2020.`data`','GUJARAT,APTS2020',NULL),(21,'user2','user2@gmail.com','2523','','81dc9bdb52d04dc20036dbd8313ed055','pqlgk90g7efde08d82gau922hg','2025-06-05',NULL,'2025-06-05','apts2020.`data`','APTS2020',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
