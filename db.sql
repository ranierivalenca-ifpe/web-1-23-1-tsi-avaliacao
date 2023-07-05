DROP DATABASE IF EXISTS `lost_found_tsi`;
CREATE DATABASE `lost_found_tsi`;
USE `lost_found_tsi`;

CREATE TABLE `categories` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL
);

CREATE TABLE `items` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `category_id` INT NOT NULL,
    FOREIGN KEY(`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);