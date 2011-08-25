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
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categoria` */

insert  into `categoria`(`id`,`nombre`,`title`,`thumbnail`,`descripcion`,`published`,`order`,`active`) values (148,'Others','Others',NULL,'',NULL,19,1),(150,'Apparatus / General Lab','Apparatus / General Lab',NULL,'',NULL,2,1),(151,'Cardio Devices','Cardio Devices',NULL,'',NULL,5,1),(152,'Balances','Balances',NULL,'',NULL,6,1),(153,'Centrifugues','Centrifugues',NULL,'',NULL,7,1),(154,'Respirators','Respirators',NULL,'',NULL,8,1),(155,'Endoscopy Devices','Endoscopy Devices',NULL,'',NULL,10,1),(156,'Microscopes','Microscopes',NULL,'',NULL,17,1),(157,'Imaging Systems','Imaging Systems',NULL,'',NULL,12,1),(158,'Chirurgical Devices','Chirurgical Devices',NULL,'',NULL,14,1),(159,'Monitoring Devices','Monitoring Devices',NULL,'',NULL,9,1),(160,'Perfusors & Pumps','Perfusors & Pumps',NULL,'',NULL,16,1),(161,'Ultrasound','Ultrasound',NULL,'',NULL,18,1),(162,'Incubators','Incubators',NULL,'',NULL,13,1),(163,'Autoclaves','Autoclaves',NULL,'',NULL,3,1),(164,'Coolers & Freezers','Coolers & Freezers',NULL,'',NULL,11,1),(165,'Medical Furnitures / Beds','Medical Furnitures / Beds',NULL,'',NULL,15,1),(168,'X-Ray','X-Ray',NULL,'',NULL,4,1),(169,'NEU- & Demogeräte','NEU- & Demogeräte',NULL,'',NULL,20,1),(170,'prueba','Prueba 2','123.jpg','esto es una vaina',NULL,NULL,1),(171,'prueba2','ddsfsd',NULL,'dfsdfdsfs',NULL,NULL,1);

/*Table structure for table `cuotaspago` */

DROP TABLE IF EXISTS `cuotaspago`;

CREATE TABLE `cuotaspago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operacion_has_equipo_id` int(11) NOT NULL,
  `estadocuota_id` int(11) NOT NULL,
  `nrocuota` int(11) NOT NULL,
  `pago` float NOT NULL,
  `fechapago` datetime NOT NULL,
  `fechalimite` datetime NOT NULL,
  `mora` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cuotaspago_operacion_has_equipo1` (`operacion_has_equipo_id`),
  KEY `fk_cuotaspago_estadocuota1` (`estadocuota_id`),
  CONSTRAINT `fk_cuotaspago_operacion_has_equipo1` FOREIGN KEY (`operacion_has_equipo_id`) REFERENCES `operacion_has_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuotaspago_estadocuota1` FOREIGN KEY (`estadocuota_id`) REFERENCES `estadocuota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cuotaspago` */

/*Table structure for table `equipo` */

DROP TABLE IF EXISTS `equipo`;

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precioventa` float NOT NULL,
  `preciocompra` float NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estadoequipo_id` int(11) NOT NULL,
  `publicacionEquipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fabricantes_id` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipo_categoria` (`categoria_id`),
  KEY `fk_equipo_estadoequipo1` (`estadoequipo_id`),
  KEY `fk_equipo_publicacionEquipo1` (`publicacionEquipo_id`),
  KEY `fk_equipo_usuario1` (`usuario_id`),
  KEY `fk_equipo_fabricantes1` (`fabricantes_id`),
  CONSTRAINT `fk_equipo_fabricantes1` FOREIGN KEY (`fabricantes_id`) REFERENCES `fabricantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_estadoequipo1` FOREIGN KEY (`estadoequipo_id`) REFERENCES `estadoequipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_publicacionEquipo1` FOREIGN KEY (`publicacionEquipo_id`) REFERENCES `publicacionequipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipo` */

/*Table structure for table `equipo_has_formapago` */

DROP TABLE IF EXISTS `equipo_has_formapago`;

CREATE TABLE `equipo_has_formapago` (
  `equipo_id` int(11) NOT NULL,
  `formapago_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nrocuotas` int(11) NOT NULL,
  `pago` float DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `totalpago` float DEFAULT NULL,
  `moraxdia` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipo_has_formapago_formapago1` (`formapago_id`),
  KEY `fk_equipo_has_formapago_equipo1` (`equipo_id`),
  CONSTRAINT `fk_equipo_has_formapago_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_has_formapago_formapago1` FOREIGN KEY (`formapago_id`) REFERENCES `formapago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipo_has_formapago` */

/*Table structure for table `equipodescripcion` */

DROP TABLE IF EXISTS `equipodescripcion`;

CREATE TABLE `equipodescripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idiomas_id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `equipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipodescripcion_idiomas1` (`idiomas_id`),
  KEY `fk_equipodescripcion_equipo1` (`equipo_id`),
  CONSTRAINT `fk_equipodescripcion_idiomas1` FOREIGN KEY (`idiomas_id`) REFERENCES `idiomas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipodescripcion_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipodescripcion` */

/*Table structure for table `estadocuota` */

DROP TABLE IF EXISTS `estadocuota`;

CREATE TABLE `estadocuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadocuota` */

/*Table structure for table `estadoequipo` */

DROP TABLE IF EXISTS `estadoequipo`;

CREATE TABLE `estadoequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `acive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadoequipo` */

/*Table structure for table `estadooperacion` */

DROP TABLE IF EXISTS `estadooperacion`;

CREATE TABLE `estadooperacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadooperacion` */

/*Table structure for table `fabricantes` */

DROP TABLE IF EXISTS `fabricantes`;

CREATE TABLE `fabricantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fabricantes` */

/*Table structure for table `formaenvio` */

DROP TABLE IF EXISTS `formaenvio`;

CREATE TABLE `formaenvio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `formaenvio` */

/*Table structure for table `formaenvio_has_equipo` */

DROP TABLE IF EXISTS `formaenvio_has_equipo`;

CREATE TABLE `formaenvio_has_equipo` (
  `formaenvio_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_formaenvio_has_equipo_equipo1` (`equipo_id`),
  KEY `fk_formaenvio_has_equipo_formaenvio1` (`formaenvio_id`),
  CONSTRAINT `fk_formaenvio_has_equipo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_formaenvio_has_equipo_formaenvio1` FOREIGN KEY (`formaenvio_id`) REFERENCES `formaenvio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `formaenvio_has_equipo` */

/*Table structure for table `formapago` */

DROP TABLE IF EXISTS `formapago`;

CREATE TABLE `formapago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `formapago` */

/*Table structure for table `idiomas` */

DROP TABLE IF EXISTS `idiomas`;

CREATE TABLE `idiomas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prefijo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `idiomas` */

/*Table structure for table `imagen` */

DROP TABLE IF EXISTS `imagen`;

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `fk_imagenes_equipo1` (`equipo_id`),
  CONSTRAINT `fk_imagenes_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `imagen` */

/*Table structure for table `operacion` */

DROP TABLE IF EXISTS `operacion`;

CREATE TABLE `operacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estadooperacion_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `fechapago` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacion_estadooperacion1` (`estadooperacion_id`),
  KEY `fk_operacion_usuario1` (`usuario_id`),
  CONSTRAINT `fk_operacion_estadooperacion1` FOREIGN KEY (`estadooperacion_id`) REFERENCES `estadooperacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `operacion` */

/*Table structure for table `operacion_has_equipo` */

DROP TABLE IF EXISTS `operacion_has_equipo`;

CREATE TABLE `operacion_has_equipo` (
  `operacion_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float DEFAULT NULL,
  `equipo_has_formapago_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacion_has_equipo_equipo1` (`equipo_id`),
  KEY `fk_operacion_has_equipo_operacion1` (`operacion_id`),
  KEY `fk_operacion_has_equipo_equipo_has_formapago1` (`equipo_has_formapago_id`),
  CONSTRAINT `fk_operacion_has_equipo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_equipo_has_formapago1` FOREIGN KEY (`equipo_has_formapago_id`) REFERENCES `equipo_has_formapago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_operacion1` FOREIGN KEY (`operacion_id`) REFERENCES `operacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `operacion_has_equipo` */

/*Table structure for table `pagina` */

DROP TABLE IF EXISTS `pagina`;

CREATE TABLE `pagina` (
  `idpagina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  `idiomas_id` int(11) NOT NULL,
  `paises_id` int(11) NOT NULL,
  PRIMARY KEY (`idpagina`),
  KEY `fk_pagina_idiomas1` (`idiomas_id`),
  KEY `fk_pagina_paises1` (`paises_id`),
  CONSTRAINT `fk_pagina_idiomas1` FOREIGN KEY (`idiomas_id`) REFERENCES `idiomas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagina_paises1` FOREIGN KEY (`paises_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pagina` */

/*Table structure for table `paises` */

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `paises` */

insert  into `paises`(`id`,`nombre`,`code`,`active`) values (1,'Peru','pe',1);

/*Table structure for table `publicacionequipo` */

DROP TABLE IF EXISTS `publicacionequipo`;

CREATE TABLE `publicacionequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `publicacionequipo` */

/*Table structure for table `tipousuario` */

DROP TABLE IF EXISTS `tipousuario`;

CREATE TABLE `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipousuario` */

insert  into `tipousuario`(`id`,`nombre`,`active`) values (1,'Registrado',1);

/*Table structure for table `traducciones` */

DROP TABLE IF EXISTS `traducciones`;

CREATE TABLE `traducciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idiomas_id` int(11) NOT NULL,
  `nombretabla` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecampo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_traducciones_idiomas1` (`idiomas_id`),
  CONSTRAINT `fk_traducciones_idiomas1` FOREIGN KEY (`idiomas_id`) REFERENCES `idiomas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `traducciones` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipousuario_id` int(11) NOT NULL,
  `sendemail` int(11) DEFAULT NULL,
  `fecharegistro` datetime NOT NULL,
  `ultimavisita` datetime NOT NULL,
  `activacion` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codpostal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `institucion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paises_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipousuario1` (`tipousuario_id`),
  KEY `fk_usuario_paises1` (`paises_id`),
  CONSTRAINT `fk_usuario_paises1` FOREIGN KEY (`paises_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`tipousuario_id`) REFERENCES `tipousuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellido`,`email`,`login`,`clave`,`tipousuario_id`,`sendemail`,`fecharegistro`,`ultimavisita`,`activacion`,`active`,`direccion`,`codpostal`,`ciudad`,`institucion`,`paises_id`) values (2,'Luis alberto','mayta mamani','slovacus@gmail.com','slovacus','77e5a902560174d453967481ed01a0c5',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,0,'mi casa','1414','Lima','mi casa',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
