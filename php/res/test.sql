
INSERT INTO `rooms` (`room_id`, `building_id`, `room_category_id`, `local`, `name`, `manager`, `description`, `monitoring`, `maxEvents`) VALUES
(55, 27, 4, 'test', 'test', '', '', 0, 1);
INSERT INTO `room_acls` (`room_id`, `read`, `write`, `overwrite`, `admin`, `denyShibAttrib`) VALUES
(55, '*', 'fbm-licr-admin-g', '', 'fbm-licr-admin-g','');