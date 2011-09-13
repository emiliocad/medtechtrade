SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `medtechtrade` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `medtechtrade` ;

-- -----------------------------------------------------
-- Table `medtechtrade`.`fabricantes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`fabricantes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(250) NOT NULL ,
  `active` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `title` VARCHAR(150) NULL ,
  `thumbnail` VARCHAR(255) NULL ,
  `descripcion` TEXT NULL ,
  `published` INT NULL ,
  `order` INT NULL ,
  `active` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`estadoequipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`estadoequipo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `acive` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`tipousuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`tipousuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `active` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`paises`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`paises` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(150) NOT NULL ,
  `code` VARCHAR(10) NOT NULL ,
  `active` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(200) NULL ,
  `apellido` VARCHAR(200) NULL ,
  `email` VARCHAR(150) NULL ,
  `login` VARCHAR(70) NULL ,
  `clave` VARCHAR(90) NULL ,
  `tipousuario_id` INT NOT NULL ,
  `sendemail` INT NULL ,
  `fecharegistro` DATETIME NOT NULL ,
  `ultimavisita` DATETIME NOT NULL ,
  `activacion` VARCHAR(90) NULL ,
  `active` INT NULL DEFAULT 0 ,
  `direccion` VARCHAR(200) NULL ,
  `codpostal` VARCHAR(100) NOT NULL ,
  `ciudad` VARCHAR(150) NOT NULL ,
  `institucion` VARCHAR(200) NULL ,
  `paises_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuario_tipousuario1` (`tipousuario_id` ASC) ,
  INDEX `fk_usuario_paises1` (`paises_id` ASC) ,
  CONSTRAINT `fk_usuario_tipousuario1`
    FOREIGN KEY (`tipousuario_id` )
    REFERENCES `medtechtrade`.`tipousuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_paises1`
    FOREIGN KEY (`paises_id` )
    REFERENCES `medtechtrade`.`paises` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`moneda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`moneda` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `simbolo` VARCHAR(10) NULL ,
  `prefijo` VARCHAR(45) NULL ,
  `active` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`equipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`equipo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `precioventa` FLOAT(11) NOT NULL ,
  `preciocompra` FLOAT(11) NOT NULL ,
  `categoria_id` INT(11) NOT NULL ,
  `estadoequipo_id` INT(11) NOT NULL ,
  `publicacionEquipo_id` INT(11) NOT NULL ,
  `usuario_id` INT(11) NOT NULL ,
  `fabricantes_id` INT(11) NOT NULL ,
  `tag` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `moneda_id` INT NOT NULL ,
  `paises_id` INT NOT NULL ,
  `calidad` VARCHAR(200) NULL ,
  `cantidad` INT NOT NULL ,
  `modelo` VARCHAR(150) NULL ,
  `fechafabricacion` DATETIME NULL ,
  `documento` VARCHAR(200) NULL ,
  `sourceDocumento` VARCHAR(200) NULL ,
  `pesoEstimado` FLOAT(11) NULL ,
  `size` INT NULL ,
  `ancho` INT NULL ,
  `alto` INT NULL ,
  `sizeCaja` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_equipo_categoria` (`categoria_id` ASC) ,
  INDEX `fk_equipo_estadoequipo1` (`estadoequipo_id` ASC) ,
  INDEX `fk_equipo_publicacionEquipo1` (`publicacionEquipo_id` ASC) ,
  INDEX `fk_equipo_usuario1` (`usuario_id` ASC) ,
  INDEX `fk_equipo_fabricantes1` (`fabricantes_id` ASC) ,
  INDEX `fk_equipo_moneda1` (`moneda_id` ASC) ,
  INDEX `fk_equipo_paises1` (`paises_id` ASC) ,
  CONSTRAINT `fk_equipo_fabricantes1`
    FOREIGN KEY (`fabricantes_id` )
    REFERENCES `medtechtrade`.`fabricantes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_categoria`
    FOREIGN KEY (`categoria_id` )
    REFERENCES `medtechtrade`.`categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_estadoequipo1`
    FOREIGN KEY (`estadoequipo_id` )
    REFERENCES `medtechtrade`.`estadoequipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_usuario1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `medtechtrade`.`usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_moneda1`
    FOREIGN KEY (`moneda_id` )
    REFERENCES `medtechtrade`.`moneda` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_paises1`
    FOREIGN KEY (`paises_id` )
    REFERENCES `medtechtrade`.`paises` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`publicacionEquipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`publicacionEquipo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(255) NOT NULL ,
  `active` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`formapago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`formapago` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(150) NOT NULL ,
  `active` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`equipo_has_formapago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`equipo_has_formapago` (
  `equipo_id` INT NOT NULL ,
  `formapago_id` INT NOT NULL ,
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nrocuotas` INT NOT NULL ,
  `pago` FLOAT NULL ,
  `dias` INT NULL ,
  `totalpago` FLOAT NULL ,
  `moraxdia` FLOAT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_equipo_has_formapago_formapago1` (`formapago_id` ASC) ,
  INDEX `fk_equipo_has_formapago_equipo1` (`equipo_id` ASC) ,
  CONSTRAINT `fk_equipo_has_formapago_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `medtechtrade`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_has_formapago_formapago1`
    FOREIGN KEY (`formapago_id` )
    REFERENCES `medtechtrade`.`formapago` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`formaenvio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`formaenvio` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(150) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`formaenvio_has_equipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`formaenvio_has_equipo` (
  `formaenvio_id` INT NOT NULL ,
  `equipo_id` INT NOT NULL ,
  `id` INT NOT NULL AUTO_INCREMENT ,
  INDEX `fk_formaenvio_has_equipo_equipo1` (`equipo_id` ASC) ,
  INDEX `fk_formaenvio_has_equipo_formaenvio1` (`formaenvio_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_formaenvio_has_equipo_formaenvio1`
    FOREIGN KEY (`formaenvio_id` )
    REFERENCES `medtechtrade`.`formaenvio` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_formaenvio_has_equipo_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `medtechtrade`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`estadooperacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`estadooperacion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `active` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`operacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`operacion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `estadooperacion_id` INT NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `fechainicio` DATETIME NOT NULL ,
  `fechapago` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_operacion_estadooperacion1` (`estadooperacion_id` ASC) ,
  INDEX `fk_operacion_usuario1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_operacion_estadooperacion1`
    FOREIGN KEY (`estadooperacion_id` )
    REFERENCES `medtechtrade`.`estadooperacion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_usuario1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `medtechtrade`.`usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`operacion_has_equipo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`operacion_has_equipo` (
  `operacion_id` INT NOT NULL ,
  `equipo_id` INT NOT NULL ,
  `id` INT NOT NULL AUTO_INCREMENT ,
  `precio` FLOAT NULL ,
  `equipo_has_formapago_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_operacion_has_equipo_equipo1` (`equipo_id` ASC) ,
  INDEX `fk_operacion_has_equipo_operacion1` (`operacion_id` ASC) ,
  INDEX `fk_operacion_has_equipo_equipo_has_formapago1` (`equipo_has_formapago_id` ASC) ,
  CONSTRAINT `fk_operacion_has_equipo_operacion1`
    FOREIGN KEY (`operacion_id` )
    REFERENCES `medtechtrade`.`operacion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `medtechtrade`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacion_has_equipo_equipo_has_formapago1`
    FOREIGN KEY (`equipo_has_formapago_id` )
    REFERENCES `medtechtrade`.`equipo_has_formapago` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`estadocuota`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`estadocuota` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(60) NOT NULL ,
  `active` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`cuotaspago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`cuotaspago` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `operacion_has_equipo_id` INT NOT NULL ,
  `estadocuota_id` INT NOT NULL ,
  `nrocuota` INT NOT NULL ,
  `pago` FLOAT NOT NULL ,
  `fechapago` DATETIME NOT NULL ,
  `fechalimite` DATETIME NOT NULL ,
  `mora` FLOAT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cuotaspago_operacion_has_equipo1` (`operacion_has_equipo_id` ASC) ,
  INDEX `fk_cuotaspago_estadocuota1` (`estadocuota_id` ASC) ,
  CONSTRAINT `fk_cuotaspago_operacion_has_equipo1`
    FOREIGN KEY (`operacion_has_equipo_id` )
    REFERENCES `medtechtrade`.`operacion_has_equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuotaspago_estadocuota1`
    FOREIGN KEY (`estadocuota_id` )
    REFERENCES `medtechtrade`.`estadocuota` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`idiomas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`idiomas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `prefijo` VARCHAR(10) NOT NULL ,
  `active` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`pagina`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`pagina` (
  `idpagina` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(90) NOT NULL ,
  `body` TEXT NOT NULL ,
  `active` INT NULL ,
  `idiomas_id` INT NOT NULL ,
  `paises_id` INT NOT NULL ,
  PRIMARY KEY (`idpagina`) ,
  INDEX `fk_pagina_idiomas1` (`idiomas_id` ASC) ,
  INDEX `fk_pagina_paises1` (`paises_id` ASC) ,
  CONSTRAINT `fk_pagina_idiomas1`
    FOREIGN KEY (`idiomas_id` )
    REFERENCES `medtechtrade`.`idiomas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagina_paises1`
    FOREIGN KEY (`paises_id` )
    REFERENCES `medtechtrade`.`paises` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`traducciones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`traducciones` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idiomas_id` INT NOT NULL ,
  `nombretabla` VARCHAR(250) NOT NULL ,
  `nombrecampo` VARCHAR(150) NOT NULL ,
  `texto` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_traducciones_idiomas1` (`idiomas_id` ASC) ,
  CONSTRAINT `fk_traducciones_idiomas1`
    FOREIGN KEY (`idiomas_id` )
    REFERENCES `medtechtrade`.`idiomas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `medtechtrade`.`equipodescripcion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`equipodescripcion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idiomas_id` INT NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `equipo_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_equipodescripcion_idiomas1` (`idiomas_id` ASC) ,
  INDEX `fk_equipodescripcion_equipo1` (`equipo_id` ASC) ,
  CONSTRAINT `fk_equipodescripcion_idiomas1`
    FOREIGN KEY (`idiomas_id` )
    REFERENCES `medtechtrade`.`idiomas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipodescripcion_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `medtechtrade`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`imagen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`imagen` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `equipo_id` INT NOT NULL ,
  `nombre` VARCHAR(255) NULL ,
  `thumb` VARCHAR(255) NULL ,
  `imagen` VARCHAR(255) NULL ,
  `published` INT NULL ,
  `descripcion` TEXT NULL ,
  INDEX `fk_imagenes_equipo1` (`equipo_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_imagenes_equipo1`
    FOREIGN KEY (`equipo_id` )
    REFERENCES `medtechtrade`.`equipo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `medtechtrade`.`contacto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `medtechtrade`.`contacto` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
