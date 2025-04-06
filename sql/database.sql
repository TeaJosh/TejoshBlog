-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Modified for better compatibility
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema site
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `site`;
CREATE SCHEMA IF NOT EXISTS `site`;
USE `site`;

-- ----------------------------------------------------------------------------
-- Table site.user
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `last_login` DATETIME NULL DEFAULT NULL,
  `active` BIT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table site.role
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`role` (
  `idrole` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table site.address
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`address` (
  `idaddress` INT NOT NULL AUTO_INCREMENT,
  `iduser` INT NULL DEFAULT NULL,
  `address_type` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(250) NULL DEFAULT NULL,
  `City` VARCHAR(45) NULL DEFAULT NULL,
  `State` VARCHAR(45) NULL DEFAULT NULL,
  `Zip` VARCHAR(10) NULL DEFAULT NULL,
<<<<<<< HEAD
  `is_primary` BIT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idaddress`),
  INDEX `user_address_idx` (`iduser`),
  CONSTRAINT `user_address`
    FOREIGN KEY (`iduser`)
    REFERENCES `site`.`user` (`iduser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;
=======
  `is_primary` BIT(1) NULL DEFAULT NULL, -- Renamed `primary` to `is_primary`
  PRIMARY KEY (`idaddress`),
  INDEX `user_address_idx` (`iduser` ASC),
  CONSTRAINT `user_address`
    FOREIGN KEY (`iduser`)
    REFERENCES `user` (`iduser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
>>>>>>> f60afa493eef1e5d74a7114a7891d2a3e8198a5e

-- ----------------------------------------------------------------------------
-- Table site.email
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`email` (
  `idemail` INT NOT NULL AUTO_INCREMENT,
  `email_address` VARCHAR(45) NOT NULL,
  `iduser` INT NOT NULL,
  `email_type` VARCHAR(45) NULL DEFAULT NULL,
  `default` BIT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idemail`),
  INDEX `email_user_idx` (`iduser`),
  CONSTRAINT `email_user`
    FOREIGN KEY (`iduser`)
    REFERENCES `site`.`user` (`iduser`)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table site.phone
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`phone` (
  `idphone` INT NOT NULL AUTO_INCREMENT,
  `iduser` INT NOT NULL,
  `phone_type` VARCHAR(45) NULL DEFAULT NULL,
  `phone_number` VARCHAR(12) NULL DEFAULT NULL,
  `primary` BIT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idphone`),
  INDEX `user_phone_idx` (`iduser`),
  CONSTRAINT `user_phone`
    FOREIGN KEY (`iduser`)
    REFERENCES `site`.`user` (`iduser`)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table site.profile
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`profile` (
  `idprofile` INT NOT NULL AUTO_INCREMENT,
  `iduser` INT NOT NULL,
  `first_name` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `middle_name` VARCHAR(45) NULL DEFAULT NULL,
  `date_of_birth` DATE NULL DEFAULT NULL,
  `picture` VARCHAR(45) NULL DEFAULT NULL,
  `color` VARCHAR(45) NULL DEFAULT NULL,
  `about` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idprofile`),
  INDEX `user_profile_idx` (`iduser`),
  CONSTRAINT `user_profile`
    FOREIGN KEY (`iduser`)
    REFERENCES `site`.`user` (`iduser`)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------------
-- Table site.user_role
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site`.`user_role` (
  `iduser_role` INT NOT NULL AUTO_INCREMENT,
  `iduser` INT NULL DEFAULT NULL,
  `idrole` INT NULL DEFAULT NULL,
  PRIMARY KEY (`iduser_role`),
  INDEX `user_role_user_idx` (`iduser`),
  INDEX `user_role_role_idx` (`idrole`),
  CONSTRAINT `user_role_role`
    FOREIGN KEY (`idrole`)
    REFERENCES `site`.`role` (`idrole`),
  CONSTRAINT `user_role_user`
    FOREIGN KEY (`iduser`)
    REFERENCES `site`.`user` (`iduser`)
) ENGINE = InnoDB;

/* Data Initialize */
INSERT INTO `site`.`user` (`iduser`, `username`, `password`, `last_login`, `active`) 
VALUES 
  (1, 'kvue', '1234', NULL, 1),
  (7, 'user', '1234', NULL, 1),
  (8, 'user2', '1234', NULL, 1);

INSERT INTO `site`.`role` (`idrole`, `description`, `name`) 
VALUES 
  (1, 'The admin if a site', 'Administrator'),
  (2, 'The user of a site', 'User');

INSERT INTO `site`.`address` (`idaddress`, `iduser`, `address_type`, `address`, `City`, `State`, `Zip`, `is_primary`) 
VALUES 
  (1, 1, 'Home', '12345 Home Ave', 'Shinjuku', 'Japan', '12345', 1),
  (2, 1, 'Work', '1234 Work Street', 'Kyoto', 'Japan', '14245', 0),
  (4, 7, 'Home', '1244 Dark Alley', 'Gotham', 'New York', '42131', 1),
  (5, 8, 'Home', '14354 54th Street', 'Kansas City', 'Kansas', '45613', 1);

INSERT INTO `site`.`email` (`idemail`, `email_address`, `iduser`, `email_type`, `default`) 
VALUES 
  (3, 'kenji@site.com', 1, 'Personal', 1),
  (4, 'kenji@work.com', 1, 'Work', 0),
  (5, 'kenji@yahoo.com', 1, 'Personal', 0),
  (6, 'bruce@home.com', 7, 'Personal', 1),
  (7, 'bruce@work.com', 7, 'Work', 0),
  (8, 'Joe@home.com', 8, 'Home', 1);
  
INSERT INTO `site`.`phone` (`idphone`, `iduser`, `phone_type`, `phone_number`, `primary`) 
VALUES 
  (3, 1, 'Home', '123-456-7890', 1),
  (4, 1, 'Work', '234-567-9821', 0),
  (5, 7, 'Home', '465-461-5533', 1),
  (6, 8, 'Home', '454-889-4454', 1);

INSERT INTO `site`.`profile` (`idprofile`, `iduser`, `first_name`, `last_name`, `middle_name`, `date_of_birth`, `picture`, `color`, `about`) 
VALUES 
  (1, 1, 'Kenji', 'Vue', 'M', '2000-01-31', 'KenjiMVue.jpg', '#431499', '<p>I am a life long anime fan ever since I saw my first series \"Macross\" all the way back in 1990. Yep, I am really old, but still love cartoons. Currently, I am watching One Punch Man. <br />Besides anime, I\'m a big final fantasy fan. Having played the entire series, as well as the recent release of FFVII - Remake, my favorite is still Final Fantasy IX.</p>'),
  (2, 7, 'Bruce', 'Wayne', NULL, '1990-12-25', 'bruce.jpg', '#0000ff', 'Batman is the superhero protector of Gotham City, a man dressed like a bat who fights against evil and strikes terror into the hearts of criminals everywhere. In his secret identity he is Bruce Wayne, billionaire industrialist and notorious playboy. Although he has no superhuman powers, he is one of the world\'s smartest men and greatest fighters. His physical prowess and technical ingenuity make him an incredibly dangerous opponent. He is also a founding member of the Justice League.'),
  (3, 8, 'Joe', 'Joestar', NULL, '1980-05-03', 'joe.png', '#00ff00', 'Joseph is a natural-born Ripple user and eventual Stand user, wielding the psychic photographic Stand, Hermit Purple. Joseph meets the fantastic threats approaching him throughout his life with initiative and impressive ingenuity, battling Vampires, the Pillar Men, and malevolent Stand users.');
 
<<<<<<< HEAD
INSERT INTO `site`.`user_role` (`iduser_role`, `iduser`, `idrole`) 
VALUES 
  (1, 1, 1),
  (2, 7, 2),
  (3, 8, 2),
  (4, 1, 2);

SET FOREIGN_KEY_CHECKS = 1;
=======
INSERT INTO `user_role` (`iduser_role`, `iduser`, `idrole`) VALUES (1,1,1),(2,7,2),(3,8,2),(4,1,2);
>>>>>>> f60afa493eef1e5d74a7114a7891d2a3e8198a5e
