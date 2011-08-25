/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.8-log : Database - medtechtrade
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `published` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categoria` */

insert  into `categoria`(`id`,`nombre`,`title`,`thumbnail`,`descripcion`,`published`,`order`,`active`) values (148,'Others','Others',NULL,'',NULL,19,1),(150,'Apparatus / General Lab','Apparatus / General Lab',NULL,'',NULL,2,1),(151,'Cardio Devices','Cardio Devices',NULL,'',NULL,5,1),(152,'Balances','Balances',NULL,'',NULL,6,1),(153,'Centrifugues','Centrifugues',NULL,'',NULL,7,1),(154,'Respirators','Respirators',NULL,'',NULL,8,1),(155,'Endoscopy Devices','Endoscopy Devices',NULL,'',NULL,10,1),(156,'Microscopes','Microscopes',NULL,'',NULL,17,1),(157,'Imaging Systems','Imaging Systems',NULL,'',NULL,12,1),(158,'Chirurgical Devices','Chirurgical Devices',NULL,'',NULL,14,1),(159,'Monitoring Devices','Monitoring Devices',NULL,'',NULL,9,1),(160,'Perfusors & Pumps','Perfusors & Pumps',NULL,'',NULL,16,1),(161,'Ultrasound','Ultrasound',NULL,'',NULL,18,1),(162,'Incubators','Incubators',NULL,'',NULL,13,1),(163,'Autoclaves','Autoclaves',NULL,'',NULL,3,1),(164,'Coolers & Freezers','Coolers & Freezers',NULL,'',NULL,11,1),(165,'Medical Furnitures / Beds','Medical Furnitures / Beds',NULL,'',NULL,15,1),(168,'X-Ray','X-Ray',NULL,'',NULL,4,1),(169,'NEU- & Demogeräte','NEU- & Demogeräte',NULL,'',NULL,20,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
