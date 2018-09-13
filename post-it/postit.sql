DROP TABLE IF EXISTS postit;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS color;




-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema pms
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mul18` DEFAULT CHARACTER SET latin1 ;
USE `mul18` ;

-- -----------------------------------------------------
-- Table `pms`.`color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul18`.`color` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `colorname` VARCHAR(45) NULL DEFAULT NULL,
  `cssclass` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `pms`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul18`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(40) NULL DEFAULT NULL,
  `pwhash` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `pms`.`postit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul18`.`postit` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `createdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `headertext` VARCHAR(45) NULL DEFAULT NULL,
  `bodytext` VARCHAR(100) NULL DEFAULT NULL,
  `color_id` INT(11) NOT NULL,
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_postit_color_idx` (`color_id` ASC) ,
  INDEX `fk_postit_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_postit_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `mul18`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_postit_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mul18`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- Add color info to the color table
INSERT INTO color (colorname, cssclass) VALUES ('Yellow', 'postityellow');
INSERT INTO color (colorname, cssclass) VALUES ('Blue', 'postitblue');
INSERT INTO color (colorname, cssclass) VALUES ('Green', 'postitgreen');
INSERT INTO color (colorname, cssclass) VALUES ('Orange', 'postitorange');
INSERT INTO color (colorname, cssclass) VALUES ('Pink', 'postitpink');



SELECT * FROM color;
SELECT * FROM postit;
SELECT * FROM users;


SELECT postit.id, createdate, headertext, bodytext, cssclass, username FROM postit, color, users WHERE color_id=color.id AND users_id=users.id;



-- SQL til valg af farve
SELECT id, colorname FROM color;


-- SQL til at slette postit
DELETE FROM postit WHERE id=1;