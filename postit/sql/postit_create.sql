-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mul18
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mul18
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mul18` DEFAULT CHARACTER SET utf8 ;
USE `mul18` ;


DROP TABLE IF EXISTS postit;
DROP TABLE IF EXISTS color;

-- -----------------------------------------------------
-- Table `mul18`.`color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul18`.`color` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `colorname` VARCHAR(45) NULL,
  `cssclass` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mul18`.`postit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mul18`.`postit` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `createdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `headertext` VARCHAR(45) NULL,
  `bodytext` VARCHAR(100) NULL,
  `color_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_postit_color_idx` (`color_id` ASC),
  CONSTRAINT `fk_postit_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `mul18`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- Add color info to the color table
INSERT INTO color (colorname, cssclass) VALUES ('Yellow', 'postityellow');
INSERT INTO color (colorname, cssclass) VALUES ('Green', 'postitgreen');
INSERT INTO color (colorname, cssclass) VALUES ('Red', 'postitred');
INSERT INTO color (colorname, cssclass) VALUES ('Blue', 'postitblue');

-- Add a few test PostIt's
INSERT INTO postit (author, headertext, bodytext, color_id) 
VALUES ('Husk', 'Databaser er vigtige!!!', 3);
INSERT INTO postit (author, headertext, bodytext, color_id) 
VALUES ('Interface', 'Intet interface - ingen brugere', 2);


SELECT * FROM color;
SELECT * FROM postit;


-- SQL til valg af farve
SELECT id, colorname FROM color;


-- SQL til at slette postit
DELETE FROM postit WHERE id=1;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(40) UNIQUE,
    pwhash VARCHAR(255)
);

INSERT INTO users (username, pwhash) VALUES ("niels", "asdfasdfasdfasdfasdfasdfsd");

SELECT * FROM users;
SELECT id, pwhash FROM users WHERE username="niels";













