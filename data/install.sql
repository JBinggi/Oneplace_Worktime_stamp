--
-- Add new tab
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('worktime-stamp', 'worktime-single', 'Stamp', 'Recent Stamp', 'fas fa-stamp', '', '1', '', '');

--
-- Add new partial
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'partial', 'Stamp', 'worktime_stamp', 'worktime-stamp', 'worktime-single', 'col-md-12', '', '', '0', '1', '0', '', '', '');

--
-- create stamp table
--
CREATE TABLE `worktime_stamp` (
  `Stamp_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
('stamp-base', 'worktimestamp-single', 'Stamp', 'Recent Stamp', 'fas fa-stamp', '', '1', '', '');
