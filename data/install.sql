--
-- Add new tab
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('worktime-stamp', 'worktime-single', 'Stamp', 'Recent Stamp', 'fas fa-stamp', '', '1', '', '');

--
-- Add new partial
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'partial', 'Stamp', 'worktime_stamp', 'worktime-stamp', 'worktime-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'hidden', 'Finger', 'finger_idfs', 'stamp-base', 'worktimestamp-single', 'col-md-1', '', '', '0', '1', '0', '', '', ''),
(NULL, 'select', 'Type ', 'type_idfs', 'stamp-base', 'worktimestamp-single', 'col-md-2', 'tag/api/list/worktimestamp-single/type', '', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-JBinggi\\Worktime\\Stamp\\Controller\\TypeController');
--
-- create stamp table
--
CREATE TABLE `worktime_stamp` (
  `Stamp_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finger_idfs` int(11)  NOT NULL DEFAULT '0',
  `type_idfs` int(11)  NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `worktime_stamp`
  ADD PRIMARY KEY (`Stamp_ID`);

ALTER TABLE `worktime_stamp`
  MODIFY `Stamp_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- add stamp form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('worktimestamp-single', 'Worktime Stamp', 'JBinggi\\Worktime\\Stamp\\Model\\Stamp', 'JBinggi\\Worktime\\Stamp\\Model\\StampTable');

--
-- add form tab
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('stamp-base', 'worktimestamp-single', 'Stamp', 'Recent Stamp', 'fas fa-barcode', '', '1', '', '');

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`, `needs_globaladmin`) VALUES
('list', 'JBinggi\\Worktime\\Stamp\\Controller\\ApiController', 'List', '', '', 1, 0),
('index', 'JBinggi\\Worktime\\Stamp\\Controller\\ApiController', 'index', '', '', 1, 0),
('add', 'JBinggi\\Worktime\\Stamp\\Controller\\StampController', 'Add Stamp', '', '', 1, 0),
('add', 'JBinggi\\Worktime\\Stamp\\Controller\\TypeController', 'Add Type', '', '', 0, 0);

--
-- Custom Tags
--
INSERT IGNORE INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'type', 'Type', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');

--
-- add State Entities
--
INSERT INTO `core_entity_tag` (`Entitytag_ID`, `entity_form_idfs`, `tag_idfs`, `tag_value`, `parent_tag_idfs`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'worktimestamp-single', (select `Tag_ID` from `core_tag` where `tag_key`='type'), 'coming', '0', '1', '2020-01-01 00:00:00', '1', '2020-01-01 00:00:00'),
(NULL, 'worktimestamp-single',  (select `Tag_ID` from `core_tag` where `tag_key`='type'), 'going', '0', '1', '2020-01-01 00:00:00', '1', '2020-01-01 00:00:00');

