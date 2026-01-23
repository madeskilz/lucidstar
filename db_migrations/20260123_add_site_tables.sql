-- Migration: Add site editable content tables
-- Run this SQL in your lucidstar database to enable DB-driven frontend options

CREATE TABLE IF NOT EXISTS `settings` (
  `skey` varchar(191) NOT NULL,
  `svalue` text NOT NULL,
  PRIMARY KEY (`skey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(1000) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `caption` text,
  `date_uploaded` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ctas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `style` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed some common settings
INSERT INTO `settings` (`skey`, `svalue`) VALUES
('site_name', 'Lucid Stars Private School')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('logo_path', 'assets/img/logo-black.png')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('short_description', 'We can\'t wait to see you kids in the class learning, and playing during break time, we missed you all.')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('address', '6, Akinwale Street,\n\nOgba, Ikeja,\n\nLagos State, Nigeria.')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('phone1', '08023148981')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('phone2', '08033160691')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('email', 'info@lucidstars.sch.ng')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('staff_email_url', 'http://webmail.lucidstars.sch.ng')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('social_facebook', 'http://facebook.com/')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('social_twitter', 'http://twitter.com/')
ON DUPLICATE KEY UPDATE skey = skey;

INSERT INTO `settings` (`skey`, `svalue`) VALUES
('social_instagram', 'http://instagram.com/')
ON DUPLICATE KEY UPDATE skey = skey;
