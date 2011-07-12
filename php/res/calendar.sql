/*
	Auteur:  Stefan Meier
	Version: 2011.05.05
	
	Description: script de création de tables pour la base
				 calendar)
				 
	Détails: 	 l'ordre de création est à respecter (contraintes)

	Restauration d'un fichier: 
	mysql --user=USR --password=PWD --default-character-set=utf8  < /iafbm_personnes.sql

*/
DROP DATABASE IF EXISTS calendar;
CREATE DATABASE calendar DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;
USE calendar;

DROP TABLE IF EXISTS sites;
CREATE TABLE IF NOT EXISTS sites (
  site_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  PRIMARY KEY (site_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO sites VALUES 
(1, 'Dorigny'), 
(2, 'Bugnon'),
(3, 'Epalinges');

DROP TABLE IF EXISTS buildings;
CREATE TABLE IF NOT EXISTS buildings (
  building_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  site_id INTEGER(9) NOT NULL,
  name VARCHAR(30) NOT NULL,
  PRIMARY KEY (building_id),
    FOREIGN KEY (site_id) REFERENCES sites(site_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO buildings VALUES 
(7, 2, '7'),
(71, 2, '7A'),
(27, 2, '27'),
(21, 2, '21'),
(1, 3, 'Biopôle 3');

DROP TABLE IF EXISTS room_categories;
CREATE TABLE IF NOT EXISTS room_categories (
  room_category_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (room_category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `room_categories` (`room_category_id`, `name`) VALUES
(1, 'other'),
(2, 'setup'),
(3, 'room'),
(4, 'animalLab'),
(5, 'p2'),
(6, 'microscope'),
(7, 'machine'),
(8, 'rent');

DROP TABLE IF EXISTS rooms;
CREATE TABLE IF NOT EXISTS rooms (
  room_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  building_id INTEGER(9) NOT NULL,
  room_category_id INTEGER(9),
  local VARCHAR(20) NOT NULL,
  name VARCHAR(100) NOT NULL,
  manager VARCHAR(100),
  description TEXT DEFAULT '',
  admins VARCHAR(200) NOT NULL DEFAULT 'fbm-admin-g',
  superAdmins VARCHAR(200) NOT NULL DEFAULT 'fbm-admin-g',
  acceptStudents INTEGER(1) NOT NULL DEFAULT 1,
  monitoring INTEGER(1) NOT NULL DEFAULT 0,
  maxEvents INTEGER(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (room_id),
  FOREIGN KEY (building_id) REFERENCES buildings(building_id),
  FOREIGN KEY (room_category_id) REFERENCES room_categories(room_category_id)
    /*ON DELETE SET DEFAULT*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `rooms` (`room_id`, `building_id`, `room_category_id`, `local`, `name`, `manager`, `description`, `admins`, `superAdmins`, `acceptStudents`, `monitoring`, `maxEvents`) VALUES
(1, 27, 2, '001', 'Culture primaire - hotte 1', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(2, 27, 2, '001', 'Culture primaire - hotte 2', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(3, 27, 4, '002', 'LEA', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(4, 27, 4, '003', 'Microchirurgie', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(6, 27, 4, '008', 'LEA - cages métaboliques', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(7, 27, 4, '009', 'LEA - cages métaboliques', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(8, 27, 2, 'Sous-sol', 'Comportement', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(9, 27, 2, 'Sous-sol', 'Ex labo B', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(10, 27, 2, 'Sous-sol', 'Télémétrie', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(11, 27, 2, '317', 'Real-time PCR', '', '', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(12, 27, 6, '313', 'Microscope à fluorescence', '', 'Please indicate if you use fluorescence or not (fluo oui, fluo non).', 'fbm-calendar-bu27-setups-g', 'fbm-admin-g', 0, 0, 1),
(13, 27, 7, '105', 'Salle de séminaire', '', '30 pl. assises + 3 chaises, ordinateur, beamer, rétro-projecteur, tableau noir', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(14, 27, 7, '106', 'Salle de réunion', '', '10 pl. assises + 8 chaises, beamer, tableau blanc', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(15, 27, 7, '219', 'Salle de conférence', '', '12 pl. assises + 9 chaises, rétro-projecteur, tableau blanc, vidéoconférence', 'fbm-dgm-secretariat-g;fbm-dpt-secretariat-g', 'fbm-admin-g;fbm-calendar-bu27-salles-admin-g', 0, 0, 1),
(16, 27, 4, '006', 'Animalerie - Flux 1A', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(17, 27, 4, '006', 'Animalerie - Flux 1B', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(18, 27, 4, '006', 'Animalerie - Flux 3A', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(19, 27, 4, '006', 'Animalerie - Flux 3B', '', '<table class="tabular" border="0" cellspacing="0" cellpadding="0" width="220">\r\n<tbody>\r\n<tr>\r\n<th colspan="2">Horaires animaliers<br /></th>\r\n</tr>\r\n<tr>\r\n<td width="60">\r\n<p>Lu</p></td>\r\n<td width="160">\r\n<p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n<td>Ma</td>\r\n<td> 06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n<td>Me</td>\r\n<td><p>  06:30 - 11:15</p></td>\r\n</tr>\r\n<tr>\r\n  <td>Je</td>\r\n  <td>06:30 - 08:30</td>\r\n</tr>\r\n<tr>\r\n  <td>Ve</td>\r\n  <td><p>    06:30 - 11:30</p></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'fbm-calendar-bu27-animalerie-g', 'fbm-admin-g', 1, 0, 1),
(20, 71, 7, 'Niv. 1', 'Congélateur de réserve', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(21, 7, 4, '01 029', 'Hébergement', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(22, 7, 4, '01 027', 'Douleur (Dr Isabelle Decosterd)', '', 'Responsable: Dr Isabelle Decoster, DBCM bureau 106, tél.: 079 55 66 477', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(23, 7, 4, '01 031', 'Sommeil (Dr Anita Lüthi)', '', 'Responsable: Dr Anita Lüthi, DBCM bureau 332, tél.: 5294', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(24, 7, 4, '01 033', 'Experimentation animale', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(25, 7, 4, '01 035', 'Etude de comportement', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(26, 7, 4, '01 037', 'Salle d''opération', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(27, 7, 4, '01 039', 'Prélèvement d''organes', '', 'Respect des conditions sanitaires pour animaux', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(28, 7, 5, '01 041', 'Hotte Lenti', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(29, 7, 5, '01 041', 'Hotte AAV', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(30, 7, 5, '01 043', 'Poste in vivo Lenti', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(31, 7, 5, '01 043', 'Poste in vivo AAV', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(32, 7, 5, '01 045', 'Hébergement P2', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1),
(33, 7, 2, '02 corridor', 'Cytomics FC500', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(34, 7, 6, '03 001', 'Nikon Eclipse 80i', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(35, 7, 6, '03 001', 'Zeiss Obs. A1', '', 'Réservation autorisée uniquement aux membres du groupe de Luc Pellerin', 'fbm-dp-lp-g', 'fbm-dp-admin-g', 1, 0, 1),
(36, 7, 6, '03 001', 'Axiovert 40 CFL', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(37, 7, 2, '03 corridor', 'Licor Odyssey', '', 'Réservation autorisée uniquement aux personnes ayant le droit de faire des mesures', 'fbm-dp-lp-odyssey-g', 'fbm-dp-admin-g', 1, 0, 1),
(38, 7, 2, '03 corridor', 'Synergy MX', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(39, 7, 6, '04 001', 'Nikon Eclipse 90i', '', '', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(40, 7, 6, '04 001', 'Nikon Eclipse TS100', '', 'Chambre noire niveau 4', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(41, 7, 7, '04 033', 'Ultracentrifugeuse L90K', '', 'Salle des appareils, niv. 4', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(42, 7, 8, '05 029', 'Reception Laptop #1', '', 'Réservé pour présentation', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(43, 7, 8, '05 029', 'Reception Laptop #2', '', 'Usage général, pour invités, etc.', 'fbm-dp-g', 'fbm-dp-admin-g', 1, 0, 1),
(44, 7, 3, '06 E02', 'Seminar room', '', '40 places, beamer + écran.\r\nRéservation autorisée uniquement aux chefs de groupe + Alexandra Defago', 'fbm-dp-calendar-seminaire-g', 'fbm-dp-admin-g', 1, 0, 1),
(45, 27, NULL, 'Sous-sol', 'Boxs circadiens', '', ' ', 'fbm-calendar-bu27-setups-g', 'fbm-dp-admin-g', 0, 0, 1),
(46, 7, 5, '01 043', 'Poste in vivo Moloney', '', 'Réservation et accès uniquement pour les personnes en possession d''une carte de sécurité P2', 'fbm-dp-labop2-g', 'fbm-dp-admin-g', 1, 0, 1);


DROP TABLE IF EXISTS events;
CREATE TABLE IF NOT EXISTS events (
  event_id VARCHAR(255) NOT NULL,
  room_id INTEGER(9) NOT NULL,
  owner VARCHAR(50) NOT NULL DEFAULT '',
  title VARCHAR(50) NOT NULL DEFAULT '',
  description TEXT NOT NULL DEFAULT '',
  mode VARCHAR(2) NOT NULL,
  PRIMARY KEY (event_id),
  FOREIGN KEY (room_id) REFERENCES rooms(room_id)
    ON DELETE cascade,
  /*le check est ignoré par mysql et sert donc qu'à titre explicatif */
  CONSTRAINT c_mode CHECK (mode IN ('a', 'd', 'w', '2w', 'm', 'y'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS event_dates;
CREATE TABLE IF NOT EXISTS event_dates (
  event_date_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  event_id VARCHAR(255) NOT NULL,
  begin DATETIME NOT NULL,
  end DATETIME NOT NULL,
  PRIMARY KEY (event_date_id),
  FOREIGN KEY (event_id) REFERENCES events(event_id)
    ON DELETE cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS logs;
CREATE TABLE IF NOT EXISTS logs (
  log_id INTEGER(9) NOT NULL AUTO_INCREMENT,
  log_datetime DATETIME NOT NULL,
  log_uid VARCHAR(20) NOT NULL DEFAULT '',
  log_action VARCHAR(20) NOT NULL DEFAULT '',
  log_rooms_id INTEGER(9) NOT NULL,
  log_events_id INTEGER(9),
  log_event_name VARCHAR(50) NOT NULL DEFAULT '',
  log_event_date DATE NOT NULL,
  log_event_begin TIME NOT NULL,
  log_event_end TIME NOT NULL,
  log_event_description TEXT NOT NULL DEFAULT '',
  log_repeat_mode VARCHAR(5),
  log_repeat_end DATE, 
  PRIMARY KEY (log_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
Example event

INSERT INTO events VALUES
(1, 13, 'smeier6', 'test1', '',  'w');
INSERT INTO events VALUES
(2, 13, 'smeier6', 'test2', '', 'n');

INSERT INTO event_dates VALUES
(1, 1, '2011-03-14 15:22', '2011-03-14 16:00'),
(2, 1, '2011-03-21 15:22', '2011-03-21 16:00'),
(3, 1, '2011-02-28 15:22', '2011-02-28 16:00'),
(4, 2, '2011-02-28 16:22', '2011-02-28 17:00');
*/