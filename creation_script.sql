-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema roc_dev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema roc_dev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `roc_dev` DEFAULT CHARACTER SET utf8 ;
USE `roc_dev` ;

-- -----------------------------------------------------
-- Table `roc_dev`.`user_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`user_role` (
  `user_role_id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_role_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roc_dev`.`group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`group` (
  `group_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`group_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roc_dev`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_role_id` INT NOT NULL,
  `group_id` INT NULL,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(250) NOT NULL,
  `salt` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_user_user_role_idx` (`user_role_id` ASC),
  INDEX `fk_user_group1_idx` (`group_id` ASC),
  CONSTRAINT `fk_user_user_role`
    FOREIGN KEY (`user_role_id`)
    REFERENCES `roc_dev`.`user_role` (`user_role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `roc_dev`.`group` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roc_dev`.`subject_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`subject_type` (
  `type_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`type_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roc_dev`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`subject` (
  `subject_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `hours` INT NOT NULL,
  `core_competence` INT NOT NULL,
  `type_id` INT NOT NULL,
  PRIMARY KEY (`subject_id`),
  INDEX `fk_subject_subject_type1_idx` (`type_id` ASC),
  CONSTRAINT `fk_subject_subject_type1`
    FOREIGN KEY (`type_id`)
    REFERENCES `roc_dev`.`subject_type` (`type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `roc_dev`.`user_has_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roc_dev`.`user_has_subject` (
  `user_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `finished` TINYINT NOT NULL DEFAULT 0,
  `starting_date` DATE NULL,
  `finished_date` DATE NULL,
  `result_number` INT NULL,
  `result_letter` CHAR(1) NULL,
  `rating` DECIMAL NULL,
  PRIMARY KEY (`user_id`, `subject_id`),
  INDEX `fk_user_has_subject_subject1_idx` (`subject_id` ASC),
  INDEX `fk_user_has_subject_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_subject_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `roc_dev`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_subject_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `roc_dev`.`subject` (`subject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
