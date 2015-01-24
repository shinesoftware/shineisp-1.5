-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 15, 2014 alle 13:10
-- Versione del server: 5.5.37
-- Versione PHP: 5.5.12-2+deb.sury.org~precise+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `user`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `user_password_reset`
--

DROP TABLE IF EXISTS `user_password_reset`;
CREATE TABLE IF NOT EXISTS `user_password_reset` (
  `request_key` varchar(32) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `request_time` datetime NOT NULL,
  PRIMARY KEY (`request_key`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_provider`
--

DROP TABLE IF EXISTS `user_provider`;
CREATE TABLE IF NOT EXISTS `user_provider` (
  `user_id` int(10) unsigned NOT NULL,
  `provider_id` varchar(50) NOT NULL,
  `provider` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`provider_id`),
  UNIQUE KEY `provider_id` (`provider_id`,`provider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Struttura della tabella `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_role` (`role_id`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `user_role`
--

INSERT INTO `user_role` (`id`, `role_id`, `is_default`, `parent_id`) VALUES
(1, 'guest', 1, NULL),
(2, 'user', 0, 1),
(3, 'admin', 0, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_role_linker`
--

DROP TABLE IF EXISTS `user_role_linker`;
CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `idx_role_id` (`role_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `user_password_reset`
--
ALTER TABLE `user_password_reset`
  ADD CONSTRAINT `user_password_reset_fk1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_provider`
--
ALTER TABLE `user_provider`
  ADD CONSTRAINT `user_provider_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `user_role` (`id`) ON DELETE SET NULL;

--
-- Limiti per la tabella `user_role_linker`
--
ALTER TABLE `user_role_linker`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
