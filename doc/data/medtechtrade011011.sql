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

insert  into `categoria`(`id`,`nombre`,`title`,`thumbnail`,`descripcion`,`published`,`order`,`active`) values (148,'Others','Others',NULL,'',NULL,19,1),(150,'Apparatus / General Lab','Apparatus / General Lab',NULL,'',NULL,2,1),(151,'Cardio Devices','Cardio Devices',NULL,'',NULL,5,1),(152,'Balances','Balances',NULL,'',NULL,6,1),(153,'Centrifugues','Centrifugues',NULL,'',NULL,7,1),(154,'Respirators','Respirators',NULL,'',NULL,8,1),(155,'Endoscopy Devices','Endoscopy Devices',NULL,'',NULL,10,1),(156,'Microscopes','Microscopes',NULL,'',NULL,17,1),(157,'Imaging Systems','Imaging Systems',NULL,'',NULL,12,1),(158,'Chirurgical Devices','Chirurgical Devices',NULL,'',NULL,14,1),(159,'Monitoring Devices','Monitoring Devices',NULL,'',NULL,9,1),(160,'Perfusors & Pumps','Perfusors & Pumps',NULL,'',NULL,16,1),(161,'Ultrasound','Ultrasound',NULL,'',NULL,18,1),(162,'Incubators','Incubators',NULL,'',NULL,13,1),(163,'Autoclaves','Autoclaves',NULL,'',NULL,3,1),(164,'Coolers & Freezers','Coolers & Freezers',NULL,'',NULL,11,1),(165,'Medical Furnitures / Beds','Medical Furnitures / Beds',NULL,'',NULL,15,1),(168,'X-Ray','X-Ray',NULL,'',NULL,4,1),(169,'NEU- & Demogeräte','NEU- & Demogeräte',NULL,'',NULL,20,1),(170,'prueba','Prueba 2','123.jpg','esto es una vaina',NULL,NULL,0),(171,'prueba2','ddsfsd',NULL,'dfsdfdsfs',NULL,NULL,0);

/*Table structure for table `categoriapregunta` */

DROP TABLE IF EXISTS `categoriapregunta`;

CREATE TABLE `categoriapregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `categoriapregunta` */

insert  into `categoriapregunta`(`id`,`descripcion`,`active`) values (1,'Otros',1);

/*Table structure for table `contacto` */

DROP TABLE IF EXISTS `contacto`;

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contacto` */

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
  CONSTRAINT `fk_cuotaspago_estadocuota1` FOREIGN KEY (`estadocuota_id`) REFERENCES `estadocuota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuotaspago_operacion_has_equipo1` FOREIGN KEY (`operacion_has_equipo_id`) REFERENCES `operacion_has_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cuotaspago` */

insert  into `cuotaspago`(`id`,`operacion_has_equipo_id`,`estadocuota_id`,`nrocuota`,`pago`,`fechapago`,`fechalimite`,`mora`) values (3,4,2,1,58,'2011-09-26 15:01:02','2011-09-26 15:01:02',0.58),(4,4,2,2,58,'2011-09-26 15:01:04','2011-09-26 15:01:04',0),(5,4,1,3,42,'2011-09-26 15:00:58','2011-09-26 15:00:58',0);

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
  `moneda_id` int(11) NOT NULL,
  `paises_id` int(11) NOT NULL,
  `calidad` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `modelo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechafabricacion` datetime DEFAULT NULL,
  `documento` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sourceDocumento` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pesoEstimado` float DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `ancho` int(11) DEFAULT NULL,
  `alto` int(11) DEFAULT NULL,
  `sizeCaja` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `views` int(11) DEFAULT NULL COMMENT 'es para la parte de productos mas visitados',
  `topofers` int(2) DEFAULT '0' COMMENT 'si es un producto top offers',
  `publishdate` date DEFAULT NULL COMMENT 'fecha de publicacion',
  PRIMARY KEY (`id`),
  KEY `fk_equipo_categoria` (`categoria_id`),
  KEY `fk_equipo_estadoequipo1` (`estadoequipo_id`),
  KEY `fk_equipo_publicacionEquipo1` (`publicacionEquipo_id`),
  KEY `fk_equipo_usuario1` (`usuario_id`),
  KEY `fk_equipo_fabricantes1` (`fabricantes_id`),
  KEY `fk_equipo_moneda1` (`moneda_id`),
  KEY `fk_equipo_paises1` (`paises_id`),
  CONSTRAINT `fk_equipo_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_estadoequipo1` FOREIGN KEY (`estadoequipo_id`) REFERENCES `estadoequipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_fabricantes1` FOREIGN KEY (`fabricantes_id`) REFERENCES `fabricantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_moneda1` FOREIGN KEY (`moneda_id`) REFERENCES `moneda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_paises1` FOREIGN KEY (`paises_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_publicacionEquipo1` FOREIGN KEY (`publicacionEquipo_id`) REFERENCES `publicacionequipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipo` */

insert  into `equipo`(`id`,`nombre`,`precioventa`,`preciocompra`,`categoria_id`,`estadoequipo_id`,`publicacionEquipo_id`,`usuario_id`,`fabricantes_id`,`tag`,`moneda_id`,`paises_id`,`calidad`,`cantidad`,`modelo`,`fechafabricacion`,`documento`,`sourceDocumento`,`pesoEstimado`,`size`,`ancho`,`alto`,`sizeCaja`,`active`,`views`,`topofers`,`publishdate`) values (2,'Equipo 1',12,12,148,1,2,3,2,'sas',1,1,'buena',122,'23123','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,79,0,NULL),(3,'equipo 2',123,111,148,2,1,3,2,'kusa,kusa',1,1,'muy mala',123,'123we','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,128,0,NULL),(4,'equipo 3',125,140,151,1,2,5,2,'1245',1,1,'buena',145,'1455214','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,293,1,NULL),(5,'equipo 4',1234,12,162,1,2,3,2,'qwq',1,1,'muy buena',12,'2122','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,401,1,NULL),(6,'test tsfs',120,240,150,2,2,6,2,'sssss',2,1,'Alta calidad',5,'s','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,679,0,NULL),(9,'prueba equivo',15,1285,151,2,2,6,2,'',1,1,'Buena Calidad',10,'120vb','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,95,0,NULL),(10,'test 2 x',9,1258,152,2,2,6,2,'dgdfgdgfd',1,1,'Buena Calidad',15,'xxxxxxxxxxxxxxx','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,2,1,NULL),(11,'test tsfs2',5,245,150,1,2,6,2,'sfsf',1,1,'Buena Calidad',35,'xxxxxxxxxxxxxxx','2015-03-20 17:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0,NULL),(12,'test tsfs3',14,654,159,1,2,6,2,'sgadgsg',2,1,'Buena Calidad',10,'tst','2023-03-20 17:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0,NULL),(13,'stereo xxxx',58,958,150,1,2,6,2,'sdsssssssssssssss',1,1,'Buena Calidad',25,'sfs','2011-03-17 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,3,1,NULL),(14,'electrocardiograma',0,915,151,2,1,6,2,'Equipo de Electro',2,1,'Excelente',10,'varuadis','2011-03-24 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0,NULL),(15,'Equipo-X-Ray',0,1452,168,1,1,6,2,'Equipo,',3,1,'Excelente',1452,'mdmfsdf','2011-03-30 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,0,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipo_has_formapago` */

insert  into `equipo_has_formapago`(`equipo_id`,`formapago_id`,`id`,`nrocuotas`,`pago`,`dias`,`totalpago`,`moraxdia`) values (13,2,1,3,15,2,0,15),(12,2,2,2,20,5,0,10);

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
  CONSTRAINT `fk_equipodescripcion_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipodescripcion_idiomas1` FOREIGN KEY (`idiomas_id`) REFERENCES `idiomas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `equipodescripcion` */

/*Table structure for table `estadocuota` */

DROP TABLE IF EXISTS `estadocuota`;

CREATE TABLE `estadocuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadocuota` */

insert  into `estadocuota`(`id`,`nombre`,`active`) values (1,'PENDIENTE',1),(2,'CANCELADA',1);

/*Table structure for table `estadoequipo` */

DROP TABLE IF EXISTS `estadoequipo`;

CREATE TABLE `estadoequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadoequipo` */

insert  into `estadoequipo`(`id`,`nombre`,`active`) values (1,'Usado',1),(2,'Nuevo',1);

/*Table structure for table `estadooperacion` */

DROP TABLE IF EXISTS `estadooperacion`;

CREATE TABLE `estadooperacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `estadooperacion` */

insert  into `estadooperacion`(`id`,`nombre`,`active`) values (1,'Pendiente Pago',1),(2,'Vendidos',1),(3,'Reservado',1),(4,'Pendiente Entrega',1),(5,'Entregado',1);

/*Table structure for table `fabricantes` */

DROP TABLE IF EXISTS `fabricantes`;

CREATE TABLE `fabricantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fabricantes` */

insert  into `fabricantes`(`id`,`nombre`,`active`) values (2,'Samsung',1),(4,'fabricante',0);

/*Table structure for table `favorito_equipo_usuario` */

DROP TABLE IF EXISTS `favorito_equipo_usuario`;

CREATE TABLE `favorito_equipo_usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fechagrabacion` datetime DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_favorito_equipo` (`equipo_id`),
  KEY `FK_favorito_equipo1` (`usuario_id`),
  CONSTRAINT `FK_favorito_equipo` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_favorito_equipo1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `favorito_equipo_usuario` */

insert  into `favorito_equipo_usuario`(`id`,`equipo_id`,`usuario_id`,`fechagrabacion`,`order`,`active`) values (1,2,6,'2011-09-23 12:42:16',1,1),(2,3,5,'2011-09-23 12:42:59',1,1),(3,12,6,'2011-09-24 12:35:14',2,1);

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
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `formapago` */

insert  into `formapago`(`id`,`nombre`,`active`) values (1,'Efectivo',1),(2,'Credito',1);

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
  `published` int(11) DEFAULT '0',
  `descripcion` text COLLATE utf8_unicode_ci,
  `order` int(11) DEFAULT '1',
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_imagenes_equipo1` (`equipo_id`),
  CONSTRAINT `fk_imagenes_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `imagen` */

insert  into `imagen`(`id`,`equipo_id`,`nombre`,`thumb`,`imagen`,`published`,`descripcion`,`order`,`active`) values (1,13,'imagen1',NULL,'1254.png',1,NULL,1,1),(2,13,'imagen2',NULL,'1234.png',1,NULL,1,1),(4,14,'testttttttttttttt',NULL,'292a_t.jpg',0,'testttttttttttttttttttt',1,1),(5,14,'terts',NULL,'292c.jpg',0,'tsafaaaaa',1,1),(6,14,'sdafsdds',NULL,'device-00.png',0,'fsdfsdfds',1,0),(7,14,'esta es  su Imagen',NULL,'plano de red.jpg',0,'<p>\r\n	agregando una Imagen</p>\r\n',1,1);

/*Table structure for table `ipligence` */

DROP TABLE IF EXISTS `ipligence`;

CREATE TABLE `ipligence` (
  `ip_from` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',
  `ip_to` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',
  `country_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `continent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `continent_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ipligence` */

insert  into `ipligence`(`ip_from`,`ip_to`,`country_code`,`country_name`,`continent_code`,`continent_name`) values (0000000000,0033554431,'','','',''),(0033554432,0034603007,'FR','FRANCE','EU','EUROPE'),(0034603008,0035651583,'','','',''),(0035651584,0036700159,'IT','ITALY','EU','EUROPE'),(0036700160,0036962303,'AE','UNITED ARAB EMIRATES','ME','MIDDLE EAST'),(0036962304,0037748735,'','','',''),(0037748736,0038273023,'SE','SWEDEN','EU','EUROPE'),(0038273024,0038797311,'KZ','KAZAKHSTAN','AS','ASIA'),(0038797312,0039059455,'PT','PORTUGAL','EU','EUROPE'),(0039059456,0039321599,'GR','GREECE','EU','EUROPE'),(0039321600,0039583743,'SA','SAUDI ARABIA','ME','MIDDLE EAST'),(0039583744,0039845887,'RU','RUSSIAN FEDERATION','EU','EUROPE'),(0039845888,0040370175,'GB','UNITED KINGDOM','EU','EUROPE'),(0040370176,0040894463,'DK','DENMARK','EU','EUROPE'),(0040894464,0041418751,'IT','ITALY','EU','EUROPE'),(0041418752,0041943039,'GB','UNITED KINGDOM','EU','EUROPE'),(0041943040,0050331647,'','','',''),(0050331648,0067108863,'HK','HONG KONG','AS','ASIA'),(0067108864,0083886079,'US','UNITED STATES','NA','NORTH AMERICA'),(0083886080,0100663295,'RU','RUSSIAN FEDERATION','EU','EUROPE'),(0100663296,0121195295,'US','UNITED STATES','NA','NORTH AMERICA'),(0121195296,0121195327,'IT','ITALY','EU','EUROPE'),(0121195328,0133147879,'US','UNITED STATES','NA','NORTH AMERICA'),(0133147880,0133147919,'','','',''),(0133147920,0133728015,'US','UNITED STATES','NA','NORTH AMERICA'),(0133728016,0133728039,'','','',''),(0133728040,0167772159,'US','UNITED STATES','NA','NORTH AMERICA'),(0167772160,0184549375,'','','',''),(0184549376,0201326591,'IN','INDIA','AS','ASIA'),(0201326592,0251658239,'US','UNITED STATES','NA','NORTH AMERICA'),(0251658240,0268435455,'BR','BRAZIL','SA','SOUTH AMERICA'),(0268435456,0335544319,'US','UNITED STATES','NA','NORTH AMERICA'),(0335544320,0352321535,'IT','ITALY','EU','EUROPE'),(0352321536,0404684799,'US','UNITED STATES','NA','NORTH AMERICA'),(0404684800,0404692991,'','','',''),(0404692992,0404772287,'US','UNITED STATES','NA','NORTH AMERICA'),(0404772288,0404772295,'','','',''),(0404772296,0404979711,'US','UNITED STATES','NA','NORTH AMERICA'),(0404979712,0405012479,'','','',''),(0405012480,0405143551,'CA','CANADA','NA','NORTH AMERICA'),(0405143552,0405180415,'US','UNITED STATES','NA','NORTH AMERICA'),(0405180416,0405184511,'CA','CANADA','NA','NORTH AMERICA'),(0405184512,0405192703,'US','UNITED STATES','NA','NORTH AMERICA'),(0405192704,0405209087,'','','',''),(0405209088,0405295103,'US','UNITED STATES','NA','NORTH AMERICA'),(0405295104,0405299199,'','','',''),(0405299200,0405331967,'US','UNITED STATES','NA','NORTH AMERICA'),(0405331968,0405340159,'','','',''),(0405340160,0405364735,'US','UNITED STATES','NA','NORTH AMERICA'),(0405364736,0405422079,'','','',''),(0405422080,0405448823,'US','UNITED STATES','NA','NORTH AMERICA'),(0405448824,0405448831,'','','',''),(0405448832,0405688183,'US','UNITED STATES','NA','NORTH AMERICA'),(0405688184,0405688191,'','','',''),(0405688192,0405798911,'US','UNITED STATES','NA','NORTH AMERICA'),(0405798912,0405831679,'','','',''),(0405831680,0405843967,'US','UNITED STATES','NA','NORTH AMERICA'),(0405843968,0405848063,'CA','CANADA','NA','NORTH AMERICA'),(0405848064,0405872639,'','','',''),(0405872640,0405897215,'US','UNITED STATES','NA','NORTH AMERICA'),(0405897216,0405901311,'','','',''),(0405901312,0405909503,'US','UNITED STATES','NA','NORTH AMERICA'),(0405909504,0405921791,'','','',''),(0405921792,0405929983,'CA','CANADA','NA','NORTH AMERICA'),(0405929984,0405938175,'US','UNITED STATES','NA','NORTH AMERICA'),(0405938176,0405962751,'','','',''),(0405962752,0405966847,'US','UNITED STATES','NA','NORTH AMERICA'),(0405966848,0406003711,'','','',''),(0406003712,0406011903,'US','UNITED STATES','NA','NORTH AMERICA'),(0406011904,0406044671,'','','',''),(0406044672,0406052863,'US','UNITED STATES','NA','NORTH AMERICA'),(0406052864,0406061055,'','','',''),(0406061056,0406077439,'US','UNITED STATES','NA','NORTH AMERICA'),(0406077440,0406093823,'','','',''),(0406093824,0406102015,'US','UNITED STATES','NA','NORTH AMERICA'),(0406102016,0406142975,'','','',''),(0406142976,0406147071,'US','UNITED STATES','NA','NORTH AMERICA'),(0406147072,0406159359,'','','',''),(0406159360,0406175743,'US','UNITED STATES','NA','NORTH AMERICA'),(0406175744,0406183935,'','','',''),(0406183936,0406188031,'CA','CANADA','NA','NORTH AMERICA'),(0406188032,0406192127,'','','',''),(0406192128,0406208511,'CA','CANADA','NA','NORTH AMERICA'),(0406208512,0406216703,'','','',''),(0406216704,0406241279,'US','UNITED STATES','NA','NORTH AMERICA'),(0406241280,0406274047,'','','',''),(0406274048,0406282239,'PR','PUERTO RICO','CB','CARIBBEAN'),(0406282240,0406323199,'','','',''),(0406323200,0406388735,'US','UNITED STATES','NA','NORTH AMERICA'),(0406388736,0406454271,'CA','CANADA','NA','NORTH AMERICA'),(0406454272,0406847487,'US','UNITED STATES','NA','NORTH AMERICA'),(0406847488,0407408639,'CA','CANADA','NA','NORTH AMERICA'),(0407408640,0407597055,'US','UNITED STATES','NA','NORTH AMERICA'),(0407597056,0407601151,'','','',''),(0407601152,0407605247,'US','UNITED STATES','NA','NORTH AMERICA'),(0407605248,0407609343,'','','',''),(0407609344,0407613439,'US','UNITED STATES','NA','NORTH AMERICA'),(0407613440,0407633919,'','','',''),(0407633920,0408420351,'CA','CANADA','NA','NORTH AMERICA'),(0408420352,0408502271,'US','UNITED STATES','NA','NORTH AMERICA'),(0408502272,0408518655,'CA','CANADA','NA','NORTH AMERICA'),(0408518656,0408535039,'US','UNITED STATES','NA','NORTH AMERICA'),(0408535040,0408551423,'CA','CANADA','NA','NORTH AMERICA'),(0408551424,0408719359,'US','UNITED STATES','NA','NORTH AMERICA'),(0408719360,0408723455,'','','',''),(0408723456,0409239551,'US','UNITED STATES','NA','NORTH AMERICA'),(0409239552,0409272319,'','','',''),(0409272320,0409337855,'US','UNITED STATES','NA','NORTH AMERICA'),(0409337856,0409354239,'CA','CANADA','NA','NORTH AMERICA'),(0409354240,0409370623,'','','',''),(0409370624,0409470087,'US','UNITED STATES','NA','NORTH AMERICA'),(0409470088,0409470095,'','','',''),(0409470096,0409509887,'US','UNITED STATES','NA','NORTH AMERICA'),(0409509888,0409534463,'','','',''),(0409534464,0409550847,'US','UNITED STATES','NA','NORTH AMERICA'),(0409550848,0409567231,'','','',''),(0409567232,0409595903,'US','UNITED STATES','NA','NORTH AMERICA'),(0409595904,0409599999,'','','',''),(0409600000,0409668687,'US','UNITED STATES','NA','NORTH AMERICA'),(0409668688,0409668703,'','','',''),(0409668704,0409669767,'US','UNITED STATES','NA','NORTH AMERICA'),(0409669768,0409669775,'','','',''),(0409669776,0409731071,'US','UNITED STATES','NA','NORTH AMERICA'),(0409731072,0409862143,'CA','CANADA','NA','NORTH AMERICA'),(0409862144,0410124287,'US','UNITED STATES','NA','NORTH AMERICA'),(0410124288,0410177751,'CA','CANADA','NA','NORTH AMERICA'),(0410177752,0410177755,'US','UNITED STATES','NA','NORTH AMERICA'),(0410177756,0410187175,'CA','CANADA','NA','NORTH AMERICA'),(0410187176,0410187183,'US','UNITED STATES','NA','NORTH AMERICA'),(0410187184,0410187703,'CA','CANADA','NA','NORTH AMERICA'),(0410187704,0410187707,'US','UNITED STATES','NA','NORTH AMERICA'),(0410187708,0410189823,'CA','CANADA','NA','NORTH AMERICA'),(0410189824,0410648575,'US','UNITED STATES','NA','NORTH AMERICA'),(0410648576,0410714111,'CA','CANADA','NA','NORTH AMERICA'),(0410714112,0411032087,'US','UNITED STATES','NA','NORTH AMERICA'),(0411032088,0411032095,'','','',''),(0411032096,0411164671,'US','UNITED STATES','NA','NORTH AMERICA'),(0411164672,0411168767,'CA','CANADA','NA','NORTH AMERICA'),(0411168768,0411172863,'','','',''),(0411172864,0411303935,'US','UNITED STATES','NA','NORTH AMERICA'),(0411303936,0411369471,'NL','NETHERLANDS','EU','EUROPE'),(0411369472,0411566079,'','','',''),(0411566080,0411639807,'US','UNITED STATES','NA','NORTH AMERICA'),(0411639808,0411643903,'CA','CANADA','NA','NORTH AMERICA'),(0411643904,0411647999,'','','',''),(0411648000,0411664383,'CA','CANADA','NA','NORTH AMERICA'),(0411664384,0411680767,'US','UNITED STATES','NA','NORTH AMERICA'),(0411680768,0411688959,'CA','CANADA','NA','NORTH AMERICA'),(0411688960,0411697151,'','','',''),(0411697152,0411717631,'CA','CANADA','NA','NORTH AMERICA'),(0411717632,0411721727,'','','',''),(0411721728,0411734015,'CA','CANADA','NA','NORTH AMERICA'),(0411734016,0411736063,'','','',''),(0411736064,0411738143,'CA','CANADA','NA','NORTH AMERICA'),(0411738144,0411738151,'','','',''),(0411738152,0411738159,'CA','CANADA','NA','NORTH AMERICA'),(0411738160,0411738167,'','','',''),(0411738168,0411738175,'CA','CANADA','NA','NORTH AMERICA'),(0411738176,0411762687,'','','','');

/*Table structure for table `jos_home` */

DROP TABLE IF EXISTS `jos_home`;

CREATE TABLE `jos_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jos_home` */

insert  into `jos_home`(`id`,`lang`,`country`,`type`,`body`,`active`) values (1,'es','cl','home','<div><img src=\"images/stories/frontpage-chile.jpg\" border=\"0\" alt=\"MedTechTrade\" style=\"border: 0pt none;\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Bienvenido a MedTechTrade Chile</div>\r\n<p>MedTechTrade es su especialista suizo en la compra y venta a nivel mundial de equipamiento médico usado y reacondicionado.</p>\r\n<p> </p>\r\n<h3>Equipos medicos suizos a su alcanze</h3>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> MedTechTrade</strong> es una empresa suiza, dedicada a la venta de de equipamento medico reacondicionado de marcas líderes en el mercado mundial.</p>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> </strong><strong>MedTechTrade</strong> contribuye con equipamiento médico proveniente de Suiza, Alemania y Austria que responde a las exigencias de nuestros clientes, aplicando especial cuidado para que distintos parámetros como calidad, confiabilidad, precisión, flexibilidad y ahorro en costos de mantención, se cumplan.</p>\r\n<p> </p>\r\n<h2><strong>Nuestras top-3 ofertas destacadas: </strong></h2>\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/287a.jpg\" border=\"0\" alt=\"Microscopio Zeiss\" width=\"76\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Zeiss<br /><strong>Modelo</strong>: Standard 14<br /><strong>Descripción</strong>: Microscopio Zeiss<br /><a href=\"es/microscopios/156/microscop/287\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Monitor de pacientes\" width=\"77\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Marquette<br /><strong>Modelo</strong>: Solar 8000/Tram250sl <br /><strong>Descripción</strong>: Equipo de monitoreo de pacientes<br /><a href=\"es/equipos-de-monitoreo/159/critical-care-monitoring/179\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/228c.jpg\" border=\"0\" alt=\"Set cirugia de oido\" width=\"53\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Karl Storz<br /><strong>Descripción</strong>: Instrumetal Quirúrgico para cirugía de oido<br /><a href=\"es/instrumental-quirurgico/158/ear-surgery-set/228\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><br /><strong> </strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(2,'es','cl','about','<p><span class=\"contentheading\">Sobre nosotros</span></p>\r\n<p>MedTechTrade es una empresa internacional con origen en Suiza y se dedica a la compra y venta de equipos medicos nuevos y reacondicionados.</p>\r\n<p>Nosotros nos especializamos en encontrar los equipos médicos que usted necesitan de alta calida a precios accesibles. Nuestro objetivo es facilitar la acquisión de equipos medicos a travéz de nuestra plataforma. Ofrecemos una plataforma de compra y venta única, donde se puede comparar entre los modelos y fabricantes más reconocidos para ahorar tiempo y dinero.</p>\r\n<p>Para asegurarnos de la satisfacción de nuestros clientes, nosotros seguimos el estándar más alto de calidad y empleamos solo profesionales altamente calificados y entrenados para reacondicionar cada equipo de acuerdo con las especificaciones originales del fabricante.<br /><strong><br />Todos nuestros equipos son acompañados de una garantía.</strong></p>\r\n<p><strong><br /></strong></p>\r\n<h3>Nuestro Equipo</h3>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\">\r\n<p><img src=\"images/stories/cl-roland.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Roland Suttner</strong><br />Gerente General<br />Chile<br /><br /></p>\r\n</td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/cl-darwin.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Darwin Lagos Veloso</strong><br />Ventas y Servicio Técnico<br />Chile<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/cl-rosanna.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Rossana Díaz</strong><br />Logistica y Administración<br />Chile<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-thomas.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Thomas Zaugg</strong><br />Gerente General<br />Suiza<br /><br /></td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-erika.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Erika Günther</strong><br />Logistica y Administración<br />Suiza<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/ch-margareta.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Margareta Deszynski</strong><br />Ventas y Marketing<br />Suiza<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(3,'es','pe','home','<div><img src=\"images/stories/frontpage-peru.png\" border=\"0\" alt=\"MedTechTrade\" style=\"border: 0pt none;\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Bienvenido a MedTechTrade Perú</div>\r\n<p>MedTechTrade es su especialista suizo en la compra y venta a nivel mundial de equipamiento médico usado y reacondicionado.</p>\r\n<p> </p>\r\n<h3>Equipos medicos suizos a su alcanze</h3>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> MedTechTrade</strong> es una empresa suiza, dedicada a la venta de de equipamento medico reacondicionado de marcas líderes en el mercado mundial.</p>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> </strong><strong>MedTechTrade</strong> contribuye con equipamiento médico proveniente de Suiza, Alemania y Austria que responde a las exigencias de nuestros clientes, aplicando especial cuidado para que distintos parámetros como calidad, confiabilidad, precisión, flexibilidad y ahorro en costos de mantención, se cumplan.</p>\r\n<p> </p>\r\n<h2><strong>Nuestras top-3 ofertas destacadas: </strong></h2>\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/287a.jpg\" border=\"0\" alt=\"Microscopio Zeiss\" width=\"76\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Zeiss<br /><strong>Modelo</strong>: Standard 14<br /><strong>Descripción</strong>: Microscopio Zeiss<br /><a href=\"es/microscopios/156/microscop/287\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Monitor de pacientes\" width=\"77\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Marquette<br /><strong>Modelo</strong>: Solar 8000/Tram250sl <br /><strong>Descripción</strong>: Equipo de monitoreo de pacientes<br /><a href=\"es/equipos-de-monitoreo/159/critical-care-monitoring/179\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/228c.jpg\" border=\"0\" alt=\"Set cirugia de oido\" width=\"53\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Karl Storz<br /><strong>Descripción</strong>: Instrumetal Quirúrgico para cirugía de oido<br /><a href=\"es/instrumental-quirurgico/158/ear-surgery-set/228\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><br /><strong> </strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(4,'es','pe','about','<p><span class=\"contentheading\">Sobre nosotros</span></p>\r\n<p>MedTechTrade es una empresa internacional con origen en Suiza y se dedica a la compra y venta de equipos medicos nuevos y reacondicionados.</p>\r\n<p>Nosotros nos especializamos en encontrar los equipos médicos que usted necesitan de alta calida a precios accesibles. Nuestro objetivo es facilitar la acquisión de equipos medicos a travéz de nuestra plataforma. Ofrecemos una plataforma de compra y venta única, donde se puede comparar entre los modelos y fabricantes más reconocidos para ahorar tiempo y dinero.</p>\r\n<p>Para asegurarnos de la satisfacción de nuestros clientes, nosotros seguimos el estándar más alto de calidad y empleamos solo profesionales altamente calificados y entrenados para reacondicionar cada equipo de acuerdo con las especificaciones originales del fabricante.<br /><strong><br />Todos nuestros equipos son acompañados de una garantía.</strong></p>\r\n<p><strong><br /></strong></p>\r\n<h3>Nuestro Equipo</h3>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\">\r\n<p><img src=\"images/stories/cl-roland.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Roland Suttner</strong><br />Gerente General<br />Chile<br /><br /></p>\r\n</td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/cl-darwin.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Darwin Lagos Veloso</strong><br />Ventas y Servicio Técnico<br />Chile<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/cl-rosanna.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Rossana Díaz</strong><br />Logistica y Administración<br />Chile<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-thomas.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Thomas Zaugg</strong><br />Gerente General<br />Suiza<br /><br /></td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-erika.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Erika Günther</strong><br />Logistica y Administración<br />Suiza<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/ch-margareta.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Margareta Deszynski</strong><br />Ventas y Marketing<br />Suiza<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(5,'de','ch','home','<div><img src=\"images/stories/frontpage-image.jpg\" border=\"0\" alt=\"MedTechTrade\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Willkommen</div>\r\n<p><strong>MedTechTrade</strong> ist eine weltweite Handelsorganisation von medizinischen Geräten für Firmen und Organisationen. Unser Ziel ist es den Handel von medizinischen Geräten zu ermöglichen und zu beschleunigen.</p>\r\n<p><strong>Bitte wählen Sie Ihr Interessengebiet:</strong></p>\r\n<p><a href=\"index.php?option=com_content&amp;view=article&amp;id=68&amp;Itemid=56&amp;lang=de\"><img src=\"images/stories/bot1.png\" border=\"0\" alt=\"Medizintechnik verkaufen\" width=\"251\" height=\"102\" /></a><a href=\"index.php?option=com_adsmanager&amp;page=front&amp;Itemid=170&amp;lang=de\"><img src=\"images/stories/bot2.png\" border=\"0\" alt=\"Medizintechnik verkaufen\" width=\"251\" height=\"102\" style=\"border: 0pt none; margin-left:18px;\" /></a></p>\r\n<p> </p>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<h2><strong>Die aktuellen 3 Top-Angebote:</strong></h2>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/235a.jpg\" border=\"0\" alt=\"Freezer\" width=\"73\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Thermo Scientific<strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">ULT2586-10-V</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Ultra-Low Temperature Upright Freezers, Volumen 691l, Temperature range: from -50°C until -86°C<br /><a href=\"en/coolers-and-freezers/164/ultra-low-temperature-upright-freezers/236\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Solar 8000\" width=\"77\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: Marquette</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Solar 8000/Tram 250sl</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Patient Monitors<br /><a href=\"en/monitoring-devices/159/critical-care-monitoring/179\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/229a.jpg\" border=\"0\" alt=\"Stapedektomie Set\" width=\"75\" height=\"100\" style=\"border: 0px none currentColor;\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Karl Storz</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Chirurgie Stapedektomie Set</span> <br /><a href=\"en/chirurgical-devices/158/surgery-stapedectomie-set-karl-storz/229\"><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Link...</span></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /></span></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(6,'de','ch','about','<p><span class=\"contentheading\">Über uns</span></p>\r\n<p>MedTechTrade ist eine Schweizer Firma, welche erneuerte Geräte aus zweiter Hand von führenden Medizintechnikherstellern weltweit anbietet.</p>\r\n<p>Wir liefern medizinische Geräte aus der Schweiz, Deutschland, Österreich und anderen europäischen Ländern ganz auf die Bedürfnisse unserer Kunden zugeschnitten.</p>\r\n<p>Wir legen besonderen Wert auf Qualität, Zuverlässigkeit, Flexibilität und können Ihnen Kosteneinsparung bei der Anschaffung von Geräten sowie beim technischen Service bieten.</p>\r\n<p>Unsere Kunden sind Krankenhäuser, Labore und medizinische Forschungseinrichtungen. Wir sind direkt für Sie da in der Schweiz, Polen, Peru und Chile.</p>\r\n<p><strong>Bei Interesse kontaktieren Sie uns noch heut.</strong></p>\r\n<p><strong><br /></strong></p>\r\n<h3>Unser Team</h3>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-thomas.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Thomas Zaugg</strong><br />General Manager<br />Schweiz<br /><br /></td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-erika.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Erika Günther</strong><br />Backoffice &amp; Customer Support<br />Schweiz<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/ch-margareta.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Margareta Deszynski</strong><br /><span lang=\"EN-GB\">Sales Support</span><br />Schweiz<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\">\r\n<p><img src=\"images/stories/cl-roland.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Roland Suttner</strong><br />General Manager<br />Chile<br /><br /></p>\r\n</td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/cl-darwin.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Darwin Lagos Veloso</strong><br />Sales Support und technischer Service<br />Chile<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/cl-rosanna.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Rossana Díaz</strong><br />Logistik und Administration<br />Chile<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(7,'en','pl','home','<div><img src=\"images/stories/frontpage-poland.png\" border=\"0\" alt=\"MedTechTrade\" style=\"border: 0pt none;\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Welcome</div>\r\n<p><strong>MedTechTrade</strong> is a global trade association for technology manufacturers, research institutions, allied professional services and development organizations with shared interests in collaborative developing technologies, products and services for the global medical products marketplace.</p>\r\n<p>Our goal is to enable and accelerate trading of medical devices for companies and institutional organisation.</p>\r\n<p> </p>\r\n<h2>Top 3 offers:</h2>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/235a.jpg\" border=\"0\" alt=\"Freezer\" width=\"73\" height=\"100\" />..</td>\r\n<td><strong>Manufacturer</strong>: Thermo Scientific<br /><strong>Product name</strong>: Ultra-Low Temperature Upright Freezers<br /><strong>Model</strong>: ULT2586-10-V<br /><a href=\"en/coolers-and-freezers/164/ultra-low-temperature-upright-freezers/236\"><strong>Link...</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Patient Monitor\" width=\"77\" height=\"100\" />..</td>\r\n<td><strong>Manufacturer</strong>: GE Healthcare<br /><strong>Product name:</strong> Critical Care Monitoring<br /><strong>Model</strong>: Solar 8000/Tram 250sl<br /><a href=\"en/monitoring-devices/159/critical-care-monitoring/179\"><strong>Link...</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/229a.jpg\" border=\"0\" alt=\"Stapedectomie set\" width=\"75\" height=\"100\" style=\"border: 0px none currentColor;\" />..</td>\r\n<td><strong>Manufacturer</strong>: Karl Storz<br /><strong>Product name</strong>: Surgery Stapedectomie set Karl Storz<br /><a href=\"en/chirurgical-devices/158/surgery-stapedectomie-set-karl-storz/229\"><strong>Link...</strong></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><br /><strong> </strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(8,'en','pl','about','<p><span class=\"contentheading\">About Us</span></p>\r\n<p>MedTechTrade is a Swiss Company dedicated to the sale of pre-owned and refurbished medical devices of leading brands in the international market.</p>\r\n<p>MedTechTrade is providing medical devices coming from Switzerland, Germany, Austria and other European countries and is responding to the needs of our clients. We do put special emphasis on our main values which are quality, reliability, precision, flexibility and last but not least cost savings at purchase as well as at maintenance.</p>\r\n<p>MedTechTrade clients are hospitals, laboratories, and medical investigation companies and it has representations in Switzerland, Poland, Peru and Chile.</p>\r\n<p><strong>Feel free to get in contact with us now.</strong></p>\r\n<p><strong><br /></strong></p>\r\n<h3>Our Team</h3>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-thomas.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Thomas Zaugg</strong><br />General Manager<br />Switzerland<br /><br /></td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/ch-erika.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Erika Günther</strong><br />Backoffice &amp; Customer Support<br />Switzerland<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/ch-margareta.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; margin-right: 5px; border: 0pt none;\" /><strong>Margareta Deszynski</strong><br /><span lang=\"EN-GB\">Sales Support</span><br />Switzerland<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 260px; padding-top: 10px;\">\r\n<p><img src=\"images/stories/cl-roland.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Roland Suttner</strong><br />General Manager<br />Chile<br /><br /></p>\r\n</td>\r\n<td style=\"width: 260px; padding-top: 10px;\"><img src=\"images/stories/cl-darwin.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Darwin Lagos Veloso</strong><br />Sales Support and technical Service<br />Chile<br /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top: 10px;\"><img src=\"images/stories/cl-rosanna.jpg\" border=\"0\" width=\"90\" height=\"110\" style=\"float: left; border: 0pt none; margin-right:5px;\" /><strong>Rossana Díaz</strong><br />Logistics and Administrations<br />Chile<br /></td>\r\n<td style=\"padding-top: 10px;\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>',1),(9,'en','us','home','<div><img src=\"images/stories/frontpage-image.jpg\" border=\"0\" alt=\"MedTechTrade\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Welcome</div>\r\n<p><strong>MedTechTrade</strong> is a global trade association for technology manufacturers, research institutions, allied professional services and development organizations with shared interests in collaborative developing technologies, products and services for the global medical products marketplace.</p>\r\n\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<h2><strong>Top 3 offers::</strong></h2>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/235a.jpg\" border=\"0\" alt=\"Freezer\" width=\"73\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Thermo Scientific<strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">ULT2586-10-V</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Ultra-Low Temperature Upright Freezers, Volumen 691l, Temperature range: from -50°C until -86°C<br /><a href=\"en/coolers-and-freezers/164/ultra-low-temperature-upright-freezers/236\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Solar 8000\" width=\"77\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: Marquette</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Solar 8000/Tram 250sl</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Patient Monitors<br /><a href=\"en/monitoring-devices/159/critical-care-monitoring/179\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/229a.jpg\" border=\"0\" alt=\"Stapedektomie Set\" width=\"75\" height=\"100\" style=\"border: 0px none currentColor;\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Karl Storz</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Chirurgie Stapedektomie Set</span> <br /><a href=\"en/chirurgical-devices/158/surgery-stapedectomie-set-karl-storz/229\"><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Link...</span></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /></span></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',0),(10,'de','us','home','<div><img src=\"images/stories/frontpage-image.jpg\" border=\"0\" alt=\"MedTechTrade\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Willkommen</div>\r\n<p><strong>MedTechTrade</strong> ist eine weltweite Handelsorganisation von medizinischen Geräten für Firmen und Organisationen. Unser Ziel ist es den Handel von medizinischen Geräten zu ermöglichen und zu beschleunigen.</p>\r\n<p><strong>Bitte wählen Sie Ihr Interessengebiet:</strong></p>\r\n<p><a href=\"index.php?option=com_content&amp;view=article&amp;id=68&amp;Itemid=56&amp;lang=de\"><img src=\"images/stories/bot1.png\" border=\"0\" alt=\"Medizintechnik verkaufen\" width=\"251\" height=\"102\" /></a><a href=\"index.php?option=com_adsmanager&amp;page=front&amp;Itemid=170&amp;lang=de\"><img src=\"images/stories/bot2.png\" border=\"0\" alt=\"Medizintechnik verkaufen\" width=\"251\" height=\"102\" style=\"border: 0pt none; margin-left:18px;\" /></a></p>\r\n<p> </p>\r\n<p> </p>\r\n<hr />\r\n<p> </p>\r\n<h2><strong>Die aktuellen 3 Top-Angebote:</strong></h2>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/235a.jpg\" border=\"0\" alt=\"Freezer\" width=\"73\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Thermo Scientific<strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">ULT2586-10-V</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Ultra-Low Temperature Upright Freezers, Volumen 691l, Temperature range: from -50°C until -86°C<br /><a href=\"en/coolers-and-freezers/164/ultra-low-temperature-upright-freezers/236\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Solar 8000\" width=\"77\" height=\"100\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: Marquette</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><strong><br /> </strong></span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Modell: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Solar 8000/Tram 250sl</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Patient Monitors<br /><a href=\"en/monitoring-devices/159/critical-care-monitoring/179\">Link...</a></span></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/229a.jpg\" border=\"0\" alt=\"Stapedektomie Set\" width=\"75\" height=\"100\" style=\"border: 0px none currentColor;\" /></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Hersteller: </span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Karl Storz</span><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /> </span></strong><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Beschreibung:</span></strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"> Chirurgie Stapedektomie Set</span> <br /><a href=\"en/chirurgical-devices/158/surgery-stapedectomie-set-karl-storz/229\"><span style=\"font-size: 10pt; line-height: 115%; font-family: \">Link...</span></a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><strong><span style=\"font-size: 10pt; line-height: 115%; font-family: \"><br /></span></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',0),(11,'es','us','home','<div><img src=\"images/stories/frontpage-image.jpg\" border=\"0\" alt=\"MedTechTrade\" style=\"border: 0pt none;\" /></div>\r\n<div class=\"contentheading\" style=\"margin-bottom:10px;\"><br />Bienvenido a MedTechTrade</div>\r\n<p>MedTechTrade es su especialista suizo en la compra y venta a nivel mundial de equipamiento médico usado y reacondicionado.</p>\r\n<p> </p>\r\n<h3>Equipos medicos suizos a su alcanze</h3>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> MedTechTrade</strong> es una empresa suiza, dedicada a la venta de de equipamento medico reacondicionado de marcas líderes en el mercado mundial.</p>\r\n<p><strong><img src=\"images/stories/flag_CH.png\" border=\"0\" alt=\"flag ch\" style=\"border: 0pt none;\" /> </strong><strong>MedTechTrade</strong> contribuye con equipamiento médico proveniente de Suiza, Alemania y Austria que responde a las exigencias de nuestros clientes, aplicando especial cuidado para que distintos parámetros como calidad, confiabilidad, precisión, flexibilidad y ahorro en costos de mantención, se cumplan.</p>\r\n<p> </p>\r\n<h2><strong>Nuestras top-3 ofertas destacadas: </strong></h2>\r\n<p> </p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img src=\"media/pics/287a.jpg\" border=\"0\" alt=\"Microscopio Zeiss\" width=\"76\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Zeiss<br /><strong>Modelo</strong>: Standard 14<br /><strong>Descripción</strong>: Microscopio Zeiss<br /><a href=\"es/microscopios/156/microscop/287\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/179a.jpg\" border=\"0\" alt=\"Monitor de pacientes\" width=\"77\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Marquette<br /><strong>Modelo</strong>: Solar 8000/Tram250sl <br /><strong>Descripción</strong>: Equipo de monitoreo de pacientes<br /><a href=\"es/equipos-de-monitoreo/159/critical-care-monitoring/179\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>.</td>\r\n</tr>\r\n<tr>\r\n<td><img src=\"media/pics/228c.jpg\" border=\"0\" alt=\"Set cirugia de oido\" width=\"53\" height=\"100\" />..</td>\r\n<td><strong>Fabricante</strong>: Karl Storz<br /><strong>Descripción</strong>: Instrumetal Quirúrgico para cirugía de oido<br /><a href=\"es/instrumental-quirurgico/158/ear-surgery-set/228\">Link...</a></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td><br /><strong> </strong></td>\r\n</tr>\r\n</tbody>\r\n</table>',0);

/*Table structure for table `moneda` */

DROP TABLE IF EXISTS `moneda`;

CREATE TABLE `moneda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `simbolo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefijo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `moneda` */

insert  into `moneda`(`id`,`nombre`,`simbolo`,`prefijo`,`active`) values (1,'franco suizo','€',NULL,1),(2,'dolar','$',NULL,1),(3,'soles','s/',NULL,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `operacion` */

insert  into `operacion`(`id`,`estadooperacion_id`,`fecha`,`usuario_id`,`fechainicio`,`fechapago`) values (1,2,'2011-09-22 11:28:37',6,'2011-09-22 11:28:37','2011-09-22 11:28:37'),(2,2,'2011-09-24 11:15:54',6,'2011-09-24 11:15:54','2011-09-24 11:15:54'),(3,2,'2011-09-24 11:22:58',5,'2011-09-24 11:22:58','2011-09-24 11:22:58');

/*Table structure for table `operacion_has_equipo` */

DROP TABLE IF EXISTS `operacion_has_equipo`;

CREATE TABLE `operacion_has_equipo` (
  `operacion_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `equipo_has_formapago_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacion_has_equipo_equipo1` (`equipo_id`),
  KEY `fk_operacion_has_equipo_operacion1` (`operacion_id`),
  KEY `fk_operacion_has_equipo_equipo_has_formapago1` (`equipo_has_formapago_id`),
  CONSTRAINT `fk_operacion_has_equipo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_equipo_has_formapago1` FOREIGN KEY (`equipo_has_formapago_id`) REFERENCES `equipo_has_formapago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_operacion1` FOREIGN KEY (`operacion_id`) REFERENCES `operacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `operacion_has_equipo` */

insert  into `operacion_has_equipo`(`operacion_id`,`equipo_id`,`id`,`precio`,`cantidad`,`equipo_has_formapago_id`) values (1,13,4,158,2,1),(2,12,5,258,1,1),(3,13,6,158,1,1);

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
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `paises` */

insert  into `paises`(`id`,`nombre`,`code`,`active`) values (1,'Peru','PE',1);

/*Table structure for table `pregunta` */

DROP TABLE IF EXISTS `pregunta`;

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoriapregunta_id` int(11) NOT NULL DEFAULT '1',
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `asunto` varchar(120) NOT NULL,
  `formulacion` varchar(255) NOT NULL,
  `fechaFormulacion` datetime NOT NULL,
  `fechaRespuesta` datetime DEFAULT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `copiaEmail` int(11) DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `estado` int(11) DEFAULT '0' COMMENT '0 : no resuelto\n1 : resuelto',
  PRIMARY KEY (`id`),
  KEY `fk_preguntas_categoriapregunta1` (`categoriapregunta_id`),
  KEY `fk_pregunta_usuario1` (`usuario_id`),
  KEY `fk_pregunta_equipo1` (`equipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pregunta` */

insert  into `pregunta`(`id`,`categoriapregunta_id`,`equipo_id`,`usuario_id`,`asunto`,`formulacion`,`fechaFormulacion`,`fechaRespuesta`,`respuesta`,`copiaEmail`,`active`,`estado`) values (1,1,4,6,'testin','testing\r\nacerca del producto\r\n4\r\nsaludos','2011-09-26 13:08:38',NULL,NULL,1,1,0),(2,1,4,6,'testing 1','teststttttttttttttttttttt','0000-00-00 00:00:00',NULL,NULL,0,1,0),(3,1,4,6,'testing 1','teststttttttttttttttttttt','2011-09-26 00:00:00',NULL,NULL,0,1,0);

/*Table structure for table `publicacionequipo` */

DROP TABLE IF EXISTS `publicacionequipo`;

CREATE TABLE `publicacionequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `publicacionequipo` */

insert  into `publicacionequipo`(`id`,`nombre`,`active`) values (1,'Pendiente',1),(2,'Activada',1),(3,'Eliminada',1);

/*Table structure for table `reserva` */

DROP TABLE IF EXISTS `reserva`;

CREATE TABLE `reserva` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fechagrabacion` datetime DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `tipo_reserva_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_favorito__equipo1` (`equipo_id`),
  KEY `fk_favorito__usuario1` (`usuario_id`),
  KEY `fk_reserva_tipo_reserva1` (`tipo_reserva_id`),
  CONSTRAINT `fk_favorito__equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_favorito__usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_tipo_reserva1` FOREIGN KEY (`tipo_reserva_id`) REFERENCES `tipo_reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `reserva` */

insert  into `reserva`(`id`,`equipo_id`,`usuario_id`,`fechagrabacion`,`order`,`active`,`tipo_reserva_id`) values (3,4,6,'2011-09-28 16:25:14',NULL,0,2),(4,4,6,'2011-09-28 16:25:39',NULL,1,1),(5,13,6,'2011-09-28 16:56:43',NULL,1,2),(6,4,7,'2011-09-28 12:34:08',NULL,1,2),(7,4,3,'2011-09-28 21:33:46',NULL,1,2);

/*Table structure for table `tipo_reserva` */

DROP TABLE IF EXISTS `tipo_reserva`;

CREATE TABLE `tipo_reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Categoria de equipo usuario:\n- Reserva\n- Add Favorito';

/*Data for the table `tipo_reserva` */

insert  into `tipo_reserva`(`id`,`nombre`,`active`) values (1,'Reserva',1),(2,'Favorito',1);

/*Table structure for table `tipousuario` */

DROP TABLE IF EXISTS `tipousuario`;

CREATE TABLE `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipousuario` */

insert  into `tipousuario`(`id`,`nombre`,`active`) values (1,'Manager',1),(2,'Registered',1),(3,'User',1);

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
  `active` int(11) DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellido`,`email`,`login`,`clave`,`tipousuario_id`,`sendemail`,`fecharegistro`,`ultimavisita`,`activacion`,`active`,`direccion`,`codpostal`,`ciudad`,`institucion`,`paises_id`) values (3,'Luis','mayta mamani','slovacus@gmail.com','admin','sha1$87711$488758631b7e41e578f9b4b95d96cecfa288f696',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'mi casa','1414','Lima','master',1),(4,'Luis alberto','mayta mamani','slovacus@gmail.com','kusanagi','sha1$21ee2$9be1a234e6a93bcb218c56189d70b6a0be2d7d8b',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'mi casa','1414','Lima','dsdfsd',1),(5,'matias','franci','mfranci@gmail.com','mfranci','sha1$9d02a$de595b6b2d2bd7d9f3a8ece6f9813e7553fc8aa6',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'mi casa','1414','lima','dsfsdfs',1),(6,'Luis alberto','mayta mamani','slovacus@gmail.com','usuario','sha1$6319f$7dda231dcf59e9fba26dc7d23a1513b61084595b',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'mi casa','1414','Lima','St Grou',1),(7,'teresa','chunga ','tj.chunga@gmail.com','tchunga','sha1$2599c$917f9e211f5f06b9f52739bb7891de9274c6a02e',3,NULL,'2011-09-23 15:24:11','2011-09-23 15:24:11',NULL,1,'-','-','Lima','st',1),(11,'teresa','chunga','tere_chunga@hotmail.com','tjche','sha1$2599c$917f9e211f5f06b9f52739bb7891de9274c6a02e',2,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'pando','lima 16','lima','sx',1),(13,'Luis alberto','mayta mamani','kofyagami2k@hotmail.com','slovacus','sha1$01445$83f3fd3463b80206f814039fddbc4775f0c0bcc4',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,'Mi casa','14145','Lima','institucion',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;