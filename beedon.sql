CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(250) NOT NULL,
  `isActive` enum('active','passive','deleted') NOT NULL DEFAULT 'passive',
  `registrationCode` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
);
