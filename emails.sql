DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `station` tinyint(1) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `pubDate` datetime,
  `imageLink` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `position` tinyint(1) DEFAULT 0,
  `category` tinyint(1) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `visible` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_username` (`username`)
);

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `imageLink` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` tinyint(1) DEFAULT 1,
  `station` longtext,
  `visible` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
);
