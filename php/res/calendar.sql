-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 13 Janvier 2012 à 11:33
-- Version du serveur: 5.1.45
-- Version de PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `calendar_prod`
--

-- --------------------------------------------------------

--
-- Structure de la table `buildings`
--

CREATE TABLE `buildings` (
  `building_id` int(9) NOT NULL AUTO_INCREMENT,
  `site_id` int(9) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`building_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Contenu de la table `buildings`
--

INSERT INTO `buildings` (`building_id`, `site_id`, `name`) VALUES
(1, 3, 'Biopôle 3'),
(7, 2, '7'),
(21, 2, '21'),
(27, 2, '27'),
(71, 2, '7A');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `event_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_id` int(9) NOT NULL,
  `owner` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `event_dates`
--

CREATE TABLE `event_dates` (
  `event_date_id` int(9) NOT NULL AUTO_INCREMENT,
  `event_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`event_date_id`),
  KEY `event_id` (`event_id`),
  KEY `b` (`begin`),
  KEY `e` (`end`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21030 ;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(9) NOT NULL AUTO_INCREMENT,
  `log_datetime` datetime NOT NULL,
  `log_uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `log_action` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `log_rooms_id` int(9) NOT NULL,
  `log_events_id` int(9) DEFAULT NULL,
  `log_event_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `log_event_date` date NOT NULL,
  `log_event_begin` time NOT NULL,
  `log_event_end` time NOT NULL,
  `log_event_description` text COLLATE utf8_unicode_ci NOT NULL,
  `log_repeat_mode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_repeat_end` date DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(9) NOT NULL AUTO_INCREMENT,
  `building_id` int(9) NOT NULL,
  `room_category_id` int(9) DEFAULT NULL,
  `local` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `admins` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fbm-admin-g',
  `superAdmins` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fbm-admin-g',
  `acceptStudents` int(1) NOT NULL DEFAULT '1',
  `monitoring` int(1) NOT NULL DEFAULT '0',
  `maxEvents` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`room_id`),
  KEY `building_id` (`building_id`),
  KEY `room_category_id` (`room_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`room_id`, `building_id`, `room_category_id`, `local`, `name`, `manager`, `description`, `admins`, `superAdmins`, `acceptStudents`, `monitoring`, `maxEvents`) VALUES
(1, 27, 4, '001', 'Culture primaire - hotte 1', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(2, 27, 4, '001', 'Culture primaire - hotte 2', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(3, 27, 4, '002', 'LEA', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 0),
(4, 27, 4, '003', 'Microchirurgie', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(6, 27, 10, '008', 'LEA - cages métaboliques', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 0),
(7, 27, 10, '009', 'LEA - cages métaboliques', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 0),
(8, 27, 4, 'Sous-sol', 'Comportement', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 0),
(9, 27, 10, 'Sous-sol', 'Ex labo B', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 0),
(10, 27, 4, 'Sous-sol', 'Télémétrie', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(11, 27, 2, '317', 'Real-time PCR', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(12, 27, 6, '313', 'Microscope à fluorescence', '', 'Please indicate if you use fluorescence or not (fluo oui, fluo non).', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(13, 27, 3, '105', 'Salle de séminaire', '', '30 pl. assises + 3 chaises, ordinateur, beamer, rétro-projecteur, tableau noir', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(14, 27, 3, '106', 'Salle de réunion', '', '10 pl. assises + 8 chaises, beamer, tableau blanc', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(15, 27, 3, '219', 'Salle de conférence', '', '12 pl. assises + 9 chaises, rétro-projecteur, tableau blanc, vidéoconférence', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(16, 27, 9, '006', 'Flux 1A', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(17, 27, 9, '006', 'Flux 1B', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(18, 27, 9, '006', 'Flux 3A', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(19, 27, 9, '006', 'Flux 3B', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:30</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(20, 71, 7, 'Niv. 1', 'Congélateur de réserve', '', '', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(21, 7, 4, '01 029', 'Hébergement', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(22, 7, 4, '01 027', 'Douleur (Dr Isabelle Decosterd)', '', 'Responsable: Dr Isabelle Decoster, DBCM bureau 106, tél.: 079 55 66 477', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(23, 7, 4, '01 031', 'Sommeil (Dr Anita Lüthi)', '', 'Responsable: Dr Anita Lüthi, DBCM bureau 332, tél.: 5294', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(24, 7, 4, '01 033', 'Experimentation animale', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(25, 7, 4, '01 035', 'Etude de comportement', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(26, 7, 4, '01 037', 'Salle d''opération', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(27, 7, 4, '01 039', 'Prélèvement d''organes', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(28, 7, 5, '01 041', 'Hotte Lenti', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(29, 7, 5, '01 041', 'Hotte AAV & AV', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(30, 7, 5, '01 043', 'Poste in vivo Lenti', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(31, 7, 5, '01 043', 'Poste in vivo AAV & AV', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(32, 7, 5, '01 045', 'Hébergement P2', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(33, 7, 2, '02 corridor', 'Cytomics FC500', '', '', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(34, 7, 6, '03 001', 'Nikon Eclipse 80i', '', 'Chambre noire niveau 3', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(35, 7, 6, '03 001', 'Zeiss Obs. A1', '', 'Chambre noire niveau 3\r\n<br /><br/>\r\nRéservation autorisée uniquement aux membres du groupe de Luc Pellerin', 'fbm-dp-lp-g', 'fbm-dp-admin-g', 1, 0, 1),
(36, 7, 6, '03 001', 'Axiovert 40 CFL', '', 'Chambre noire niveau 3', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(37, 7, 2, '03 corridor', 'Licor Odyssey', '', 'Réservation autorisée uniquement aux personnes ayant le droit de faire des mesures', 'fbm-dp-lp-odyssey-g', 'fbm-dp-admin-g', 1, 0, 1),
(38, 7, 2, '03 corridor', 'Synergy MX', '', '', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(39, 7, 6, '04 001', 'Nikon Eclipse 90i', '', 'Chambre noire niveau 4', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(40, 7, 6, '04 001', 'Nikon Eclipse TS100', '', 'Chambre noire niveau 4', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(41, 7, 7, '04 033', 'Ultracentrifugeuse L90K', '', 'Salle des appareils, niv. 4', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(42, 7, 8, '05 029', 'Reception Laptop #1', '', 'Réservé pour présentation', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(43, 7, 8, '05 029', 'Reception Laptop #2', '', 'Usage général, pour invités, etc.', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(44, 7, 3, '06 E02', 'Salle de séminaire', '', '40 places, beamer + écran.\r\nRéservation autorisée uniquement aux chefs de groupe + Alexandra Defago', 'fbm-dp-calendar-seminaire-g', 'fbm-dp-admin-g', 1, 0, 1),
(45, 27, 4, 'Sous-sol', 'Boxs circadiens', '', 'Please indicate box numbers you are going to use ( A2, A5, B1, B2).', 'fbm-calendar-bu27-setups-g', 'fbm-dp-admin-g', 0, 0, 0),
(46, 7, 5, '01 043', 'Poste in vivo Moloney', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(47, 7, 2, '03 corridor', 'ChemiDoc XRS+ (chemiluminescence)', '', '', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(48, 7, 2, '03 015', 'ViiA 7 Real-Time PCR System', '', '', 'fbm-dp-g;fbm-dp-calendrier-g', 'fbm-dp-admin-g', 1, 0, 1),
(49, 21, 8, '5222', 'MacBook Pro 15"', NULL, '<ul>\r\n<li>DEC14546</li>\r\n<li>Sacoche noir</li>\r\n<li>Chargeur</li>\r\n<li>Batterie faible durée</li>\r\n<li>Adaptateur VGA et DVI</li>\r\n</ul>', 'fbm-decanat-informatique-g', 'fbm-admin-g', 0, 0, 1),
(50, 21, 8, '5222', 'Dell Latitude XT', NULL, '<ul>\r\n<li>DEC17581</li>\r\n<li>Ecran tactile</li>\r\n<li>Fourre de protection noir</li>\r\n<li>Chargeur</li>\r\n<li>Batterie faible durée</li>\r\n</ul>\r\n', 'fbm-decanat-informatique-g', 'fbm-admin-g', 0, 0, 1),
(51, 27, 9, 'Sous-sol', 'Flux 1', NULL, 'Animaliers tous les mardis de 6h-14h', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(52, 27, 9, 'Sous-sol', 'Flux 2', NULL, 'Animaliers tous les mardis de 6h-14h', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(53, 21, 3, '5006', 'Salle du Décanat', NULL, 'Pour toute réservation, veuillez vous adresser à Sandrine Kilmister', 'fbm-decanat-administration-secr-g', 'fbm-decanat-administration-secr-g', 0, 0, 1),
(54, 1, 3, 'Niveau 2', 'Meeting room', NULL, 'Meeting Room LICR', 'fbm-licr-g', 'fbm-licr-admin-g', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `room_categories`
--

CREATE TABLE `room_categories` (
  `room_category_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`room_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `room_categories`
--

INSERT INTO `room_categories` (`room_category_id`, `name`) VALUES
(1, 'other'),
(2, 'scientificSetup'),
(3, 'seminarRoom'),
(4, 'animalLab'),
(5, 'p2'),
(6, 'microscope'),
(7, 'machineRoom'),
(8, 'rental'),
(9, 'animalFacility'),
(10, 'metabolicCages');

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE `sites` (
  `site_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `sites`
--

INSERT INTO `sites` (`site_id`, `name`) VALUES
(1, 'Dorigny'),
(2, 'Bugnon'),
(3, 'Epalinges');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`site_id`);

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_dates`
--
ALTER TABLE `event_dates`
  ADD CONSTRAINT `event_dates_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`),
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`room_category_id`) REFERENCES `room_categories` (`room_category_id`);
