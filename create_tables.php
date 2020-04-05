<?php


$users = "CREATE TABLE `genfors`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(200) NOT NULL , `pwhash` VARCHAR(200) NOT NULL , `is_active` TINYINT NOT NULL DEFAULT '0' , `is_admin` TINYINT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$election = "CREATE TABLE `genfors`.`election` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(100) NOT NULL , `description` TEXT NULL , `is_active` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$alternatives = "CREATE TABLE `genfors`.`alternative` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `votes` INT NOT NULL DEFAULT '0' , `election_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$votes = "CREATE TABLE `genfors`.`votes` ( `id` INT NOT NULL AUTO_INCREMENT , `val` VARCHAR(512) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";