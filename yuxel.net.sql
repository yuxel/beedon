CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('active','passive','deleted') NOT NULL DEFAULT 'active',
  `auth` enum('normal','admin') NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `username` (`email`)
);


CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(250) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link` (`link`)
);


CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `contentPreview` text,
  `content` text ,
  `timeAdded` int(11),
  `tags` text,
  `status` enum('active','passive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
);

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(250) NOT NULL,
  `status` enum('active','passive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `contentComment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderName` varchar(250) NOT NULL,
  `senderEmail` varchar(250),
  `senderWeb` varchar(250),
  `message` text NOT NULL,
  `timeAdded` int(11),
  `contentType` enum('article','page') NOT NULL,
  `relatedId` int(11),
  `status` enum('active','passive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `relatedId` (`relatedId`)
);
