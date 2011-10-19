/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.8-log : Database - medtechtrade
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `alerta` */

DROP TABLE IF EXISTS `alerta`;

CREATE TABLE `alerta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `detalle` varchar(255) DEFAULT NULL COMMENT 'detalle de configuracion de alertas ',
  `active` int(11) DEFAULT '1',
  `fecharegistro` datetime DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conf_alertas_usuario1` (`usuario_id`),
  CONSTRAINT `fk_alerta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `busqueda` */

DROP TABLE IF EXISTS `busqueda`;

CREATE TABLE `busqueda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `palabras_busqueda` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fabricante` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `anio_inicio` int(11) DEFAULT NULL,
  `anio_fin` int(11) DEFAULT NULL,
  `precio_inicio` int(11) DEFAULT NULL,
  `precio_fin` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_busqueda_usuario1` (`usuario_id`),
  KEY `fk_busqueda_categoria1` (`categoria_id`),
  CONSTRAINT `fk_busqueda_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_busqueda_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `categoriapregunta` */

DROP TABLE IF EXISTS `categoriapregunta`;

CREATE TABLE `categoriapregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `idioma_id` int(11) NOT NULL,
  `active` int(1) DEFAULT '1',
  `fechaactualizacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_config_idiomas` (`idioma_id`),
  KEY `FK_config_usuario` (`usuario_id`),
  KEY `FK_config_paises` (`pais_id`),
  CONSTRAINT `FK_config_idiomas` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_config_paises` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_config_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `contacto` */

DROP TABLE IF EXISTS `contacto`;

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `dbversion` */

DROP TABLE IF EXISTS `dbversion`;

CREATE TABLE `dbversion` (
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `tag` text COLLATE utf8_unicode_ci,
  `especificaciones` text COLLATE utf8_unicode_ci,
  `moneda_id` int(11) NOT NULL,
  `paises_id` int(11) NOT NULL,
  `calidad` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `modelo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechafabricacion` date DEFAULT NULL,
  `documento` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sourceDocumento` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pesoEstimado` decimal(10,2) DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `ancho` decimal(10,2) DEFAULT NULL,
  `alto` decimal(10,2) DEFAULT NULL,
  `sizeCaja` decimal(10,2) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `views` int(11) DEFAULT NULL COMMENT 'es para la parte de productos mas visitados',
  `topofers` int(2) DEFAULT '0' COMMENT 'si es un producto top offers',
  `publishdate` date DEFAULT NULL COMMENT 'fecha de publicacion',
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `estadocuota` */

DROP TABLE IF EXISTS `estadocuota`;

CREATE TABLE `estadocuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `estadoequipo` */

DROP TABLE IF EXISTS `estadoequipo`;

CREATE TABLE `estadoequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `estadooperacion` */

DROP TABLE IF EXISTS `estadooperacion`;

CREATE TABLE `estadooperacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `fabricantes` */

DROP TABLE IF EXISTS `fabricantes`;

CREATE TABLE `fabricantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `formaenvio` */

DROP TABLE IF EXISTS `formaenvio`;

CREATE TABLE `formaenvio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `formapago` */

DROP TABLE IF EXISTS `formapago`;

CREATE TABLE `formapago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `idiomas` */

DROP TABLE IF EXISTS `idiomas`;

CREATE TABLE `idiomas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prefijo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgequipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagenes_equipo1` (`equipo_id`),
  CONSTRAINT `fk_imagenes_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `moneda` */

DROP TABLE IF EXISTS `moneda`;

CREATE TABLE `moneda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `simbolo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefijo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `cambio` decimal(8,3) DEFAULT NULL,
  `fechacambio` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `paises` */

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `integrate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `publicacionequipo` */

DROP TABLE IF EXISTS `publicacionequipo`;

CREATE TABLE `publicacionequipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `tipo_reserva` */

DROP TABLE IF EXISTS `tipo_reserva`;

CREATE TABLE `tipo_reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Categoria de equipo usuario:\n- Reserva\n- Add Favorito';

/*Table structure for table `tipousuario` */

DROP TABLE IF EXISTS `tipousuario`;

CREATE TABLE `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `activacion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codpostal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `institucion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paises_id` int(11) NOT NULL,
  `direccion1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tratamiento` int(11) DEFAULT NULL COMMENT '0 Sr, 1 Sra/Srta',
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipousuario1` (`tipousuario_id`),
  KEY `fk_usuario_paises1` (`paises_id`),
  CONSTRAINT `fk_usuario_paises1` FOREIGN KEY (`paises_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`tipousuario_id`) REFERENCES `tipousuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
