DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `links`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(255),
	`created_at` timestamp,
	`updated_at` timestamp
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `users` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
        `users` VARCHAR(20) NOT NULL,
	`student_id` VARCHAR(12) NOT NULL
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `links` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`url` varchar(5000) NOT NULL,
	`title` varchar(5000) NOT NULL,
	`description` varchar(5000) NOT NULL,
	`category_id` int,
	`created_at` timestamp,
	`updated_at` timestamp,
	`user_id` int,
	FOREIGN KEY(`category_id`) REFERENCES `categories` (`id`),
	FOREIGN KEY(`user_id`) REFERENCES `users` (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `comments` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
	`link_id` int,
	`user_id` int,
        `content` varchar(5000) NOT NULL,
	`created_at` timestamp,
	`updated_at` timestamp,
	FOREIGN KEY(`link_id`) REFERENCES `links` (`id`),
	FOREIGN KEY(`user_id`) REFERENCES `users` (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
