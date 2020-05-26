/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.11-MariaDB : Database - ci
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `sys_status` */

DROP TABLE IF EXISTS `sys_status`;

CREATE TABLE `sys_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `class` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sys_status` */

/*Table structure for table `sys_users` */

DROP TABLE IF EXISTS `sys_users`;

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(8) DEFAULT NULL,
  `status` smallint(5) DEFAULT 1 COMMENT '1=active user, 0=block,',
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `last_accessed_ip` varchar(15) DEFAULT '0.0.0.0',
  `logins` smallint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT 1 COMMENT 'default',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `sys_users` */

insert  into `sys_users`(`id`,`username`,`email`,`phone`,`status`,`profile_picture`,`password`,`last_login`,`last_logout`,`last_accessed_ip`,`logins`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'Pema Dorji Sherpass','pemarekdendorjee@gmail.com','98745612',1,'/uploads/images/2020/May/25/1590386939_445bd9ebc0cb0667c0c7.png','$2y$10$2inKeiNsdwXXX98BU59x2uYZdsvxFnKOB9cpamc5p7gW0PBIkJOdG','2020-05-26 10:41:11','2020-05-25 18:13:04','::1',21,1,'2020-05-24 11:26:10',0,'2020-05-26 10:41:12'),(13,'test','test@gmail.com','12345678',1,'/uploads/images/2020/May/24/1590353371_43e4efcdd22419ec37b0.png','$2y$10$RvJBwo4uuGEss223NIKOjuf7jHJD61S/MxFkVtLZdUz6vg41TjRyW','2020-05-25 01:46:59','2020-05-25 01:47:06','::1',4,1,'2020-05-24 15:49:31',NULL,'2020-05-25 01:47:06');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
