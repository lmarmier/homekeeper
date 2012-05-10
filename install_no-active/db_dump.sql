SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE  TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `firstName` VARCHAR(45) NULL ,
  `lastName` VARCHAR(45) NULL ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `home`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `home` ;

CREATE  TABLE IF NOT EXISTS `home` (
  `id` BIGINT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `description` VARCHAR(45) NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_home_user` (`user_id` ASC) ,
  CONSTRAINT `fk_home_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `user` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event` ;

CREATE  TABLE IF NOT EXISTS `event` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NULL ,
  `value` VARCHAR(45) NULL ,
  `gravity` VARCHAR(45) NULL ,
  `comment` TEXT NULL ,
  `datetime` DATETIME NULL ,
  `history` TINYINT(1)  NULL ,
  `home_id` BIGINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_home1` (`home_id` ASC) ,
  CONSTRAINT `fk_event_home1`
    FOREIGN KEY (`home_id` )
    REFERENCES `home` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `webcam`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `webcam` ;

CREATE  TABLE IF NOT EXISTS `webcam` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `location` VARCHAR(45) NULL ,
  `updated` DATETIME NULL ,
  `home_id` BIGINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_webcam_home1` (`home_id` ASC) ,
  CONSTRAINT `fk_webcam_home1`
    FOREIGN KEY (`home_id` )
    REFERENCES `home` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
