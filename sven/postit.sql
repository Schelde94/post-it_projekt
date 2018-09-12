-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `pms` DEFAULT CHARACTER SET utf8 ;
USE `pms` ;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS color;
DROP TABLE IF EXISTS postit;


-- -----------------------------------------------------
-- Table `pms`.`users`
-- -----------------------------------------------------
CREATE TABLE `pms`.`users` (
	`id`INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(40) UNIQUE,
    `pwhash` VARCHAR(255)
)ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pms`.`color`
-- -----------------------------------------------------
CREATE TABLE `pms`.`color` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `colorname` VARCHAR(45),
    `cssclass` varchar(45)
)ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pms`.`postit`
-- -----------------------------------------------------
CREATE TABLE `pms`.`postit` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `createdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    -- `author` VARCHAR(45) NULL,
    `headertext` VARCHAR(45) NULL,
    `bodytext` VARCHAR(100) NULL,
    `color_id` INT NOT NULL,
    INDEX `fk_postit_color_idx` (`color_id` ASC),
    CONSTRAINT `fk_postit_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `pms`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- Add color info to the color table
INSERT INTO color (colorname, cssclass) VALUES ('Yellow', 'postityellow');
INSERT INTO color (colorname, cssclass) VALUES ('Blue', 'postitblue');
INSERT INTO color (colorname, cssclass) VALUES ('Green', 'postitgreen');
INSERT INTO color (colorname, cssclass) VALUES ('Orange', 'postitorange');


SELECT * FROM color;
SELECT * FROM postit;
SELECT * FROM users;


-- SQL til valg af farve
SELECT id, colorname FROM color;


-- SQL til at slette postit
DELETE FROM postit WHERE id=1;