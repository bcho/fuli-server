DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `links`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
	`id` int PRIMARY KEY,
	`name` varchar(255),
	`created_at` timestamp,
	`updated_at` timestamp
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `users` (
	`id` int PRIMARY KEY,
	`student_id` int
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `links` (
	`id` int PRIMARY KEY,
	`url` varchar(255),
	`title` varchar(255),
	`description` varchar(255),
	`category_id` int,
	`created_at` timestamp,
	`updated_at` timestamp,
	`user_id` int,
	FOREIGN KEY(`category_id`) REFERENCES `categories` (`id`),
	FOREIGN KEY(`user_id`) REFERENCES `users` (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `comments` (
	`id` int PRIMARY KEY,
	`link_id` int,
	`user_id` int,
	`created_at` timestamp,
	`updated_at` timestamp,
	FOREIGN KEY(`link_id`) REFERENCES `links` (`id`),
	FOREIGN KEY(`user_id`) REFERENCES `users` (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
