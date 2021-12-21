<?php
/**
 *
 * An SMF utility to compare database structures to various SMF releases.
 * Used to help determine if changes have been made to databases that might
 * interfere with upgrades, etc.
 *
 * ***** SMF 1.x & 2.x *****
 * ***** MySQL ONLY *****
 *
 * Usage guidelines:
 * (1) Copy this file to your base SMF directory - (the one with Settings.php in it).
 * (2) Execute it from your browser.
 * (3) Delete this file when you're done.
 *     by sbulen
 *
 */

$site_title = 'SMF DB Compare Tool';
$db_needed = true;
$width = 1500;
$ui = new SimpleSmfUI($site_title, $db_needed, $width);

// Massive internal tables holding SMF db info per version...
$smf_tables['2.1'] = Array
(
	'admin_info_files' => Array
		(
			'Name' => 'smf_admin_info_files',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'approval_queue' => Array
		(
			'Name' => 'smf_approval_queue',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'attachments' => Array
		(
			'Name' => 'smf_attachments',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'background_tasks' => Array
		(
			'Name' => 'smf_background_tasks',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'ban_groups' => Array
		(
			'Name' => 'smf_ban_groups',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'ban_items' => Array
		(
			'Name' => 'smf_ban_items',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'board_permissions' => Array
		(
			'Name' => 'smf_board_permissions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'board_permissions_view' => Array
		(
			'Name' => 'smf_board_permissions_view',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'boards' => Array
		(
			'Name' => 'smf_boards',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'calendar' => Array
		(
			'Name' => 'smf_calendar',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'calendar_holidays' => Array
		(
			'Name' => 'smf_calendar_holidays',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'categories' => Array
		(
			'Name' => 'smf_categories',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'custom_fields' => Array
		(
			'Name' => 'smf_custom_fields',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'group_moderators' => Array
		(
			'Name' => 'smf_group_moderators',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_actions' => Array
		(
			'Name' => 'smf_log_actions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_activity' => Array
		(
			'Name' => 'smf_log_activity',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_banned' => Array
		(
			'Name' => 'smf_log_banned',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_boards' => Array
		(
			'Name' => 'smf_log_boards',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_comments' => Array
		(
			'Name' => 'smf_log_comments',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_digest' => Array
		(
			'Name' => 'smf_log_digest',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_errors' => Array
		(
			'Name' => 'smf_log_errors',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_floodcontrol' => Array
		(
			'Name' => 'smf_log_floodcontrol',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_group_requests' => Array
		(
			'Name' => 'smf_log_group_requests',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_mark_read' => Array
		(
			'Name' => 'smf_log_mark_read',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_member_notices' => Array
		(
			'Name' => 'smf_log_member_notices',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_notify' => Array
		(
			'Name' => 'smf_log_notify',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_online' => Array
		(
			'Name' => 'smf_log_online',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_packages' => Array
		(
			'Name' => 'smf_log_packages',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_polls' => Array
		(
			'Name' => 'smf_log_polls',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_reported' => Array
		(
			'Name' => 'smf_log_reported',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_reported_comments' => Array
		(
			'Name' => 'smf_log_reported_comments',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_scheduled_tasks' => Array
		(
			'Name' => 'smf_log_scheduled_tasks',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_search_messages' => Array
		(
			'Name' => 'smf_log_search_messages',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_search_results' => Array
		(
			'Name' => 'smf_log_search_results',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_search_subjects' => Array
		(
			'Name' => 'smf_log_search_subjects',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_search_topics' => Array
		(
			'Name' => 'smf_log_search_topics',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_spider_hits' => Array
		(
			'Name' => 'smf_log_spider_hits',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_spider_stats' => Array
		(
			'Name' => 'smf_log_spider_stats',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_subscribed' => Array
		(
			'Name' => 'smf_log_subscribed',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'log_topics' => Array
		(
			'Name' => 'smf_log_topics',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'mail_queue' => Array
		(
			'Name' => 'smf_mail_queue',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'member_logins' => Array
		(
			'Name' => 'smf_member_logins',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'membergroups' => Array
		(
			'Name' => 'smf_membergroups',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'members' => Array
		(
			'Name' => 'smf_members',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'mentions' => Array
		(
			'Name' => 'smf_mentions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'message_icons' => Array
		(
			'Name' => 'smf_message_icons',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'messages' => Array
		(
			'Name' => 'smf_messages',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'moderator_groups' => Array
		(
			'Name' => 'smf_moderator_groups',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'moderators' => Array
		(
			'Name' => 'smf_moderators',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'package_servers' => Array
		(
			'Name' => 'smf_package_servers',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'permission_profiles' => Array
		(
			'Name' => 'smf_permission_profiles',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'permissions' => Array
		(
			'Name' => 'smf_permissions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'personal_messages' => Array
		(
			'Name' => 'smf_personal_messages',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'pm_labeled_messages' => Array
		(
			'Name' => 'smf_pm_labeled_messages',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'pm_labels' => Array
		(
			'Name' => 'smf_pm_labels',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'pm_recipients' => Array
		(
			'Name' => 'smf_pm_recipients',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'pm_rules' => Array
		(
			'Name' => 'smf_pm_rules',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'poll_choices' => Array
		(
			'Name' => 'smf_poll_choices',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'polls' => Array
		(
			'Name' => 'smf_polls',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'qanda' => Array
		(
			'Name' => 'smf_qanda',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'scheduled_tasks' => Array
		(
			'Name' => 'smf_scheduled_tasks',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'sessions' => Array
		(
			'Name' => 'smf_sessions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'settings' => Array
		(
			'Name' => 'smf_settings',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'smiley_files' => Array
		(
			'Name' => 'smf_smiley_files',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'smileys' => Array
		(
			'Name' => 'smf_smileys',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'spiders' => Array
		(
			'Name' => 'smf_spiders',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'subscriptions' => Array
		(
			'Name' => 'smf_subscriptions',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'themes' => Array
		(
			'Name' => 'smf_themes',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'topics' => Array
		(
			'Name' => 'smf_topics',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'user_alerts' => Array
		(
			'Name' => 'smf_user_alerts',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'user_alerts_prefs' => Array
		(
			'Name' => 'smf_user_alerts_prefs',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'user_drafts' => Array
		(
			'Name' => 'smf_user_drafts',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),

	'user_likes' => Array
		(
			'Name' => 'smf_user_likes',
			'Engine' => 'InnoDB',
			'Collation' => 'utf8_general_ci',
		),
);

$smf_columns['2.1'] = Array
(
	'admin_info_files data' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'admin_info_files filename' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'admin_info_files filetype' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'filetype',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'admin_info_files id_file' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'id_file',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'admin_info_files parameters' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'parameters',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'admin_info_files path' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'path',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'approval_queue id_attach' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_attach',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'approval_queue id_event' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_event',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'approval_queue id_msg' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments approved' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments attachment_type' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'attachment_type',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments downloads' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'downloads',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments file_hash' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'file_hash',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'attachments fileext' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'fileext',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'attachments filename' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'attachments height' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'height',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_attach' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_attach',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_folder' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_folder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_member' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_msg' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_thumb' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_thumb',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments mime_type' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'mime_type',
			'COLUMN_TYPE' => 'varchar(128)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'attachments size' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'size',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments width' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'width',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'background_tasks claimed_time' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'COLUMN_NAME' => 'claimed_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'background_tasks id_task' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'COLUMN_NAME' => 'id_task',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'background_tasks task_class' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'COLUMN_NAME' => 'task_class',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'background_tasks task_data' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'COLUMN_NAME' => 'task_data',
			'COLUMN_TYPE' => 'mediumtext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'background_tasks task_file' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'COLUMN_NAME' => 'task_file',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_groups ban_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'ban_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_access' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_access',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_login' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_login',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_post' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_post',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_register' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_register',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups expire_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups id_ban_group' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'id_ban_group',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups name' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_groups notes' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'notes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_groups reason' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_items email_address' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_items hits' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items hostname' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hostname',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'ban_items id_ban' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_ban',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items id_ban_group' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_ban_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items id_member' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions add_deny' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'add_deny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions id_group' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions id_profile' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'board_permissions_view deny' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'COLUMN_NAME' => 'deny',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions_view id_board' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions_view id_group' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards board_order' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'board_order',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards child_level' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'child_level',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards count_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'count_posts',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards deny_member_groups' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'deny_member_groups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'boards description' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'boards id_board' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_cat' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_cat',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_last_msg' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_last_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_msg_updated' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_msg_updated',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_parent' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_parent',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_profile' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards member_groups' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'member_groups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1,0',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'boards name' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'boards num_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'num_posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards num_topics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'num_topics',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards override_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'override_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards redirect' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'redirect',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'boards unapproved_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'unapproved_posts',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards unapproved_topics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'unapproved_topics',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar end_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'end_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1004-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar end_time' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'end_time',
			'COLUMN_TYPE' => 'time',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_board' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_event' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_event',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_member' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_topic' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar location' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'location',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'calendar start_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'start_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1004-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar start_time' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'start_time',
			'COLUMN_TYPE' => 'time',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar timezone' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'timezone',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'calendar title' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'calendar_holidays event_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'event_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1004-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays id_holiday' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'id_holiday',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays title' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'categories can_collapse' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'can_collapse',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories cat_order' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'cat_order',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories description' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'categories id_cat' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'id_cat',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories name' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields active' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'active',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields bbc' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'bbc',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields can_search' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'can_search',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields col_name' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'col_name',
			'COLUMN_TYPE' => 'varchar(12)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields default_value' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'default_value',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields enclose' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'enclose',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields field_desc' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_desc',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields field_length' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_length',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '255',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields field_name' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_name',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields field_options' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_options',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields field_order' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_order',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields field_type' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_type',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'text',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields id_field' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'id_field',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields mask' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'mask',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields placement' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'placement',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields private' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'private',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields show_display' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_display',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields show_mlist' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_mlist',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields show_profile' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_profile',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'forumprofile',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'custom_fields show_reg' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_reg',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'group_moderators id_group' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'group_moderators id_member' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_actions extra' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_actions id_action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_action',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_log' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_log',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions ip' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity date' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity hits' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity most_on' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'most_on',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity posts' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity registers' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'registers',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity topics' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'topics',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned email' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'email',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_banned id_ban_log' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'id_ban_log',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ip' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments body' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_comments comment_type' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'comment_type',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'warning',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_comments counter' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'counter',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_comment' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_comment',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_notice' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_notice',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_recipient' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_recipient',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments member_name' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'member_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_comments recipient_name' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'recipient_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_digest daily' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'daily',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest exclude' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'exclude',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest note_type' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'note_type',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'post',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors backtrace' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'backtrace',
			'COLUMN_TYPE' => 'varchar(10000)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors error_type' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'error_type',
			'COLUMN_TYPE' => 'char(15)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'general',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors file' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'file',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors id_error' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'id_error',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ip' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors line' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'line',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors message' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'message',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors session' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'varchar(128)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_errors url' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_floodcontrol ip' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_floodcontrol log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_floodcontrol log_type' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'log_type',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'post',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_group_requests act_reason' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'act_reason',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_group_requests id_group' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests id_member_acted' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_member_acted',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests id_request' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_request',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests member_name_acted' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'member_name_acted',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_group_requests reason' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_group_requests status' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'status',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests time_acted' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'time_acted',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests time_applied' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'time_applied',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_member_notices body' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_member_notices id_notice' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'id_notice',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_member_notices subject' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_notify id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify sent' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'sent',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ip' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online session' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'varchar(128)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_online url' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'varchar(2048)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages credits' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'credits',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages db_changes' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'db_changes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages failed_steps' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'failed_steps',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages filename' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages id_install' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_install',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages id_member_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_member_installed',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages id_member_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_member_removed',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages install_state' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'install_state',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages member_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'member_installed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages member_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'member_removed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages name' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages package_id' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'package_id',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages sha256_hash' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'sha256_hash',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages themes_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'themes_installed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_packages time_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'time_installed',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages time_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'time_removed',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages version' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'version',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_polls id_choice' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_choice',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls id_poll' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported body' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'mediumtext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_reported closed' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'closed',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_report' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_report',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported ignore_all' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'ignore_all',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported membername' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'membername',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_reported num_reports' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'num_reports',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported subject' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_reported time_started' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'time_started',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported time_updated' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'time_updated',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments comment' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'comment',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_reported_comments id_comment' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_comment',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments id_report' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_report',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments member_ip' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'member_ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments membername' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'membername',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_reported_comments time_sent' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'time_sent',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks id_log' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'id_log',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks id_task' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'id_task',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks time_run' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'time_run',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks time_taken' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'time_taken',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results num_matches' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'num_matches',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results relevance' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'relevance',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects word' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'word',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_search_topics id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits id_hit' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'id_hit',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits processed' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'processed',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits url' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'varchar(1024)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_spider_stats id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats last_seen' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'last_seen',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats page_hits' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'page_hits',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats stat_date' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'stat_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1004-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed end_time' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'end_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_sublog' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_sublog',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_subscribe' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_subscribe',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed old_id_group' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'old_id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed payments_pending' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'payments_pending',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed pending_details' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'pending_details',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_subscribed reminder_sent' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'reminder_sent',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed start_time' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'start_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed status' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'status',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed vendor_ref' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'vendor_ref',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'log_topics id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics unwatched' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'unwatched',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue body' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'mediumtext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mail_queue headers' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'headers',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mail_queue id_mail' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'id_mail',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue priority' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'priority',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue private' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'private',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue recipient' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'recipient',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mail_queue send_html' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'send_html',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue subject' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mail_queue time_sent' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'time_sent',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'member_logins id_login' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'COLUMN_NAME' => 'id_login',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'member_logins id_member' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'member_logins ip' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'member_logins ip2' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'COLUMN_NAME' => 'ip2',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'member_logins time' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'COLUMN_NAME' => 'time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups description' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'membergroups group_name' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'group_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'membergroups group_type' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'group_type',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups hidden' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups icons' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'icons',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'membergroups id_group' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups id_parent' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'id_parent',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-2',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups max_messages' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'max_messages',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups min_posts' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'min_posts',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups online_color' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'online_color',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'membergroups tfa_required' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'tfa_required',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members additional_groups' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'additional_groups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members alerts' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'alerts',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members avatar' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'avatar',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members birthdate' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'birthdate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1004-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members buddy_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'buddy_list',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members date_registered' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'date_registered',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members email_address' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members id_group' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_member' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_msg_last_visit' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_msg_last_visit',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_post_group' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_post_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_theme' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ignore_boards' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ignore_boards',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members instant_messages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'instant_messages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members is_activated' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'is_activated',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members last_login' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'last_login',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lngfile' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members member_ip' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members member_ip2' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_ip2',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members member_name' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members mod_prefs' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'mod_prefs',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members new_pm' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'new_pm',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members passwd' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members passwd_flood' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd_flood',
			'COLUMN_TYPE' => 'varchar(12)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members password_salt' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'password_salt',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members personal_text' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'personal_text',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members pm_ignore_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_ignore_list',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members pm_prefs' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_prefs',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members pm_receive_from' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_receive_from',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members posts' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members real_name' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'real_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members secret_answer' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secret_answer',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members secret_question' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secret_question',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members show_online' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'show_online',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members signature' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'signature',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members smiley_set' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'smiley_set',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members tfa_backup' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'tfa_backup',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members tfa_secret' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'tfa_secret',
			'COLUMN_TYPE' => 'varchar(24)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members time_format' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'time_format',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members time_offset' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'time_offset',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members timezone' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'timezone',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'UTC',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members total_time_logged_in' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'total_time_logged_in',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members unread_messages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'unread_messages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members usertitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'usertitle',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members validation_code' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'validation_code',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members warning' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'warning',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members website_title' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'website_title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'members website_url' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'website_url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mentions content_id' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'COLUMN_NAME' => 'content_id',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mentions content_type' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'COLUMN_NAME' => 'content_type',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'mentions id_member' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mentions id_mentioned' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'COLUMN_NAME' => 'id_mentioned',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mentions time' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'COLUMN_NAME' => 'time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons filename' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'message_icons icon_order' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'icon_order',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons id_board' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons id_icon' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'id_icon',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons title' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages approved' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages body' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages icon' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'xx',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages id_board' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_member' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_msg' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_msg_modified' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_msg_modified',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_topic' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages likes' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'likes',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages modified_name' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modified_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages modified_reason' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modified_reason',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages modified_time' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modified_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages poster_email' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_email',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages poster_ip' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_ip',
			'COLUMN_TYPE' => 'varbinary(16)',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages poster_name' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'messages poster_time' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages smileys_enabled' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'smileys_enabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages subject' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'moderator_groups id_board' => Array
		(
			'TABLE_NAME' => 'smf_moderator_groups',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderator_groups id_group' => Array
		(
			'TABLE_NAME' => 'smf_moderator_groups',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderators id_board' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderators id_member' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'package_servers extra' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'package_servers id_server' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'id_server',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'package_servers name' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'package_servers url' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'package_servers validation_url' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'validation_url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'permission_profiles id_profile' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permission_profiles profile_name' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'COLUMN_NAME' => 'profile_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'permissions add_deny' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'add_deny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions id_group' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'personal_messages body' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'personal_messages deleted_by_sender' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'deleted_by_sender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages from_name' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'from_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'personal_messages id_member_from' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_member_from',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages id_pm' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_pm',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages id_pm_head' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_pm_head',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages msgtime' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'msgtime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages subject' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'pm_labeled_messages id_label' => Array
		(
			'TABLE_NAME' => 'smf_pm_labeled_messages',
			'COLUMN_NAME' => 'id_label',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_labeled_messages id_pm' => Array
		(
			'TABLE_NAME' => 'smf_pm_labeled_messages',
			'COLUMN_NAME' => 'id_pm',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_labels id_label' => Array
		(
			'TABLE_NAME' => 'smf_pm_labels',
			'COLUMN_NAME' => 'id_label',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_labels id_member' => Array
		(
			'TABLE_NAME' => 'smf_pm_labels',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_labels name' => Array
		(
			'TABLE_NAME' => 'smf_pm_labels',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'pm_recipients bcc' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'bcc',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients deleted' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'deleted',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients id_member' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients id_pm' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'id_pm',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients in_inbox' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'in_inbox',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients is_new' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'is_new',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients is_read' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'is_read',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules actions' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'actions',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'pm_rules criteria' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'criteria',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'pm_rules delete_pm' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'delete_pm',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules id_member' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules id_rule' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'id_rule',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules is_or' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'is_or',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules rule_name' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'rule_name',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'poll_choices id_choice' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'id_choice',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices id_poll' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices label' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'label',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'poll_choices votes' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'votes',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls change_vote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'change_vote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls expire_time' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls guest_vote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'guest_vote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls hide_results' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'hide_results',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls id_member' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls id_poll' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls max_votes' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'max_votes',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls num_guest_voters' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'num_guest_voters',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls poster_name' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'poster_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'polls question' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'polls reset_poll' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'reset_poll',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls voting_locked' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'voting_locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'qanda answers' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'COLUMN_NAME' => 'answers',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'qanda id_question' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'COLUMN_NAME' => 'id_question',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'qanda lngfile' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'qanda question' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'scheduled_tasks callable' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'callable',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'scheduled_tasks disabled' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'disabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks id_task' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'id_task',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks next_time' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'next_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks task' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'task',
			'COLUMN_TYPE' => 'varchar(24)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'scheduled_tasks time_offset' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_offset',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks time_regularity' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_regularity',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks time_unit' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_unit',
			'COLUMN_TYPE' => 'varchar(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'h',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'sessions data' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'sessions last_update' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'last_update',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions session_id' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'session_id',
			'COLUMN_TYPE' => 'varchar(128)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'settings value' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'settings variable' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'smiley_files filename' => Array
		(
			'TABLE_NAME' => 'smf_smiley_files',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'smiley_files id_smiley' => Array
		(
			'TABLE_NAME' => 'smf_smiley_files',
			'COLUMN_NAME' => 'id_smiley',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smiley_files smiley_set' => Array
		(
			'TABLE_NAME' => 'smf_smiley_files',
			'COLUMN_NAME' => 'smiley_set',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'smileys code' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'code',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'smileys description' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'smileys hidden' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys id_smiley' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'id_smiley',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smiley_order' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smiley_order',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smiley_row' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smiley_row',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'spiders id_spider' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'spiders ip_info' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'ip_info',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'spiders spider_name' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'spider_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'spiders user_agent' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'user_agent',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions active' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'active',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions add_groups' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'add_groups',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions allow_partial' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'allow_partial',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions cost' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'cost',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions description' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions email_complete' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'email_complete',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions id_group' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions id_subscribe' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'id_subscribe',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions length' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'length',
			'COLUMN_TYPE' => 'varchar(6)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions name' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'subscriptions reminder' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'reminder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions repeatable' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'repeatable',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes id_member' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes id_theme' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes value' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'themes variable' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'topics approved' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_board' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_first_msg' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_first_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_last_msg' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_last_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_member_started' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_member_started',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_member_updated' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_member_updated',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_poll' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_previous_board' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_previous_board',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_previous_topic' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_previous_topic',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_redirect_topic' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_redirect_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics is_sticky' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'is_sticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics locked' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics num_replies' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'num_replies',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics num_views' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'num_views',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics redirect_expires' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'redirect_expires',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics unapproved_posts' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'unapproved_posts',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts alert_time' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'alert_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts content_action' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'content_action',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_alerts content_id' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'content_id',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts content_type' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'content_type',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_alerts extra' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_alerts id_alert' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'id_alert',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts id_member' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts id_member_started' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'id_member_started',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts is_read' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'is_read',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts member_name' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'COLUMN_NAME' => 'member_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_alerts_prefs alert_pref' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts_prefs',
			'COLUMN_NAME' => 'alert_pref',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_alerts_prefs alert_value' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts_prefs',
			'COLUMN_NAME' => 'alert_value',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_alerts_prefs id_member' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts_prefs',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts body' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'mediumtext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_drafts icon' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'xx',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_drafts id_board' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts id_draft' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'id_draft',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts id_member' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts id_reply' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'id_reply',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts id_topic' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts is_sticky' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'is_sticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts locked' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts poster_time' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'poster_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts smileys_enabled' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'smileys_enabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_drafts subject' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_drafts to_list' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'to_list',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_drafts type' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'COLUMN_NAME' => 'type',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_likes content_id' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'COLUMN_NAME' => 'content_id',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_likes content_type' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'COLUMN_NAME' => 'content_type',
			'COLUMN_TYPE' => 'char(6)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'utf8_general_ci',
		),

	'user_likes id_member' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'user_likes like_time' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'COLUMN_NAME' => 'like_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),
);

$smf_indexes['2.1'] = Array
(
	'admin_info_files filename 0001' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_filename',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'filename',
			'SUB_PART' => '30',
		),

	'admin_info_files id_file 0001' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_file',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments attachment_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_attachment_type',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'attachment_type',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_attach 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_attach',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_member,id_attach 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_member,id_attach 0002' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_attach',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_thumb 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_thumb',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_thumb',
			'SUB_PART' => '<em>null</em>',
		),

	'background_tasks id_task 0001' => Array
		(
			'TABLE_NAME' => 'smf_background_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_task',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_groups id_ban_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_group',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items id_ban 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items id_ban_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_ban_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_group',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items ip_low,ip_high 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_ban_ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip_low',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items ip_low,ip_high 0002' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_ban_ip',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ip_high',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_profile',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0003' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions_view id_group,id_board,deny 0001' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions_view id_group,id_board,deny 0002' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions_view id_group,id_board,deny 0003' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions_view',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'deny',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_cat,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_categories',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_cat',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_cat,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_categories',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_msg_updated 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_msg_updated',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg_updated',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_parent 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_parent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_parent',
			'SUB_PART' => '<em>null</em>',
		),

	'boards member_groups 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_member_groups',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'member_groups',
			'SUB_PART' => '48',
		),

	'calendar end_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_end_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'end_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_event 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_event',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_topic,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_topic,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar start_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_start_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'start_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays event_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_event_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'event_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays id_holiday 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_holiday',
			'SUB_PART' => '<em>null</em>',
		),

	'categories id_cat 0001' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_cat',
			'SUB_PART' => '<em>null</em>',
		),

	'custom_fields col_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_col_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'col_name',
			'SUB_PART' => '<em>null</em>',
		),

	'custom_fields id_field 0001' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_field',
			'SUB_PART' => '<em>null</em>',
		),

	'group_moderators id_group,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'group_moderators id_group,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_action 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_action',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_log',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_topic,id_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic_id_log',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_topic,id_log 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic_id_log',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity date 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned id_ban_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments comment_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_comment_type',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'comment_type',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments id_comment 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_comment',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments id_recipient 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_recipient',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_recipient',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors id_error 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_error',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ip 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip,log_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip,log_type 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'log_type',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_member,id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_member,id_group 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_request 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_request',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_member_notices id_notice 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_notice',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_topic,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_topic,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online session 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session',
			'SUB_PART' => '<em>null</em>',
		),

	'log_packages filename 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_filename',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'filename',
			'SUB_PART' => '15',
		),

	'log_packages id_install 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_install',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_poll',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_choice',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported closed 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_closed',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'closed',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_report 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_report',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported time_started 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_time_started',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_started',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_comment 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_comment',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_report 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_report',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_report',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments time_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_time_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'log_scheduled_tasks id_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages id_search,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages id_search,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results id_search,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results id_search,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'word',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics id_search,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics id_search,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits id_hit 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_hit',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_spider',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits processed 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_processed',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'processed',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_stats stat_date,id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'stat_date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_stats stat_date,id_spider 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed end_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_end_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'end_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_sublog 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_sublog',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_subscribe,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_subscribe',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_subscribe',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_subscribe,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_subscribe',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed payments_pending 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_payments_pending',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'payments_pending',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed reminder_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_reminder_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'reminder_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed status 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_status',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'status',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_member,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_member,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue id_mail 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_mail',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue priority,id_mail 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_mail_priority',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'priority',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue priority,id_mail 0002' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_mail_priority',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_mail',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue time_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_time_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'member_logins id_login 0001' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_login',
			'SUB_PART' => '<em>null</em>',
		),

	'member_logins id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'member_logins time 0001' => Array
		(
			'TABLE_NAME' => 'smf_member_logins',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups min_posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_min_posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'min_posts',
			'SUB_PART' => '<em>null</em>',
		),

	'members birthdate 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_birthdate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'birthdate',
			'SUB_PART' => '<em>null</em>',
		),

	'members date_registered 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_date_registered',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date_registered',
			'SUB_PART' => '<em>null</em>',
		),

	'members email_address 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_email_address',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'email_address',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_post_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_post_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_post_group',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_theme 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_theme',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_theme',
			'SUB_PART' => '<em>null</em>',
		),

	'members last_login 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_last_login',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'last_login',
			'SUB_PART' => '<em>null</em>',
		),

	'members lngfile 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '30',
		),

	'members member_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_member_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'member_name',
			'SUB_PART' => '<em>null</em>',
		),

	'members posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posts',
			'SUB_PART' => '<em>null</em>',
		),

	'members real_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_real_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'real_name',
			'SUB_PART' => '<em>null</em>',
		),

	'members total_time_logged_in 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_total_time_logged_in',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'total_time_logged_in',
			'SUB_PART' => '<em>null</em>',
		),

	'members warning 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_warning',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'warning',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions content_id,content_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'content',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'content_id',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions content_id,content_type 0002' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'content',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'content_type',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions content_id,content_type,id_mentioned 0001' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'content_id',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions content_id,content_type,id_mentioned 0002' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'content_type',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions content_id,content_type,id_mentioned 0003' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_mentioned',
			'SUB_PART' => '<em>null</em>',
		),

	'mentions id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_mentions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'mentionee',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons id_icon 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_icon',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_board,id_msg,approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_board,id_msg,approved 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_board',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_board,id_msg,approved 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_board',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member_msg',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member_msg',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_show_posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_show_posts',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_participation',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_participation',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_related_ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_related_ip',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'poster_ip',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_related_ip',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_current_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_current_topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_current_topic',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0004' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_current_topic',
			'SEQ_IN_INDEX' => '4',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages likes 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_likes',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'likes',
			'SUB_PART' => '<em>null</em>',
		),

	'messages poster_ip,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_ip_index',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'poster_ip',
			'SUB_PART' => '<em>null</em>',
		),

	'messages poster_ip,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_ip_index',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'moderator_groups id_board,id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_moderator_groups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'moderator_groups id_board,id_group 0002' => Array
		(
			'TABLE_NAME' => 'smf_moderator_groups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators id_board,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators id_board,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'package_servers id_server 0001' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_server',
			'SUB_PART' => '<em>null</em>',
		),

	'permission_profiles id_profile 0001' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_profile',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions id_group,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions id_group,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_member_from,deleted_by_sender 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member_from',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_member_from,deleted_by_sender 0002' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted_by_sender',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_pm_head 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_pm_head',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm_head',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages msgtime 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_msgtime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'msgtime',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_labeled_messages id_label,id_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_labeled_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_label',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_labeled_messages id_label,id_pm 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_labeled_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_labels id_label 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_labels',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_label',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0003' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_pm,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_pm,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules delete_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_delete_pm',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'delete_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules id_rule 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_rule',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices id_poll,id_choice 0001' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices id_poll,id_choice 0002' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_choice',
			'SUB_PART' => '<em>null</em>',
		),

	'polls id_poll 0001' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'qanda id_question 0001' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_question',
			'SUB_PART' => '<em>null</em>',
		),

	'qanda lngfile 0001' => Array
		(
			'TABLE_NAME' => 'smf_qanda',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks disabled 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_disabled',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'disabled',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks id_task 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_task',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks next_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_next_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'next_time',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks task 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_task',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'task',
			'SUB_PART' => '<em>null</em>',
		),

	'sessions session_id 0001' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session_id',
			'SUB_PART' => '<em>null</em>',
		),

	'settings variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'smiley_files id_smiley,smiley_set 0001' => Array
		(
			'TABLE_NAME' => 'smf_smiley_files',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_smiley',
			'SUB_PART' => '<em>null</em>',
		),

	'smiley_files id_smiley,smiley_set 0002' => Array
		(
			'TABLE_NAME' => 'smf_smiley_files',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'smiley_set',
			'SUB_PART' => '<em>null</em>',
		),

	'smileys id_smiley 0001' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_smiley',
			'SUB_PART' => '<em>null</em>',
		),

	'spiders id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'subscriptions active 0001' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_active',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'active',
			'SUB_PART' => '<em>null</em>',
		),

	'subscriptions id_subscribe 0001' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_subscribe',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_theme',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0002' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0003' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'topics approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_approved',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,id_first_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_board_news',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,id_first_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_board_news',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_first_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_last_message_sticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_last_message_sticky',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'is_sticky',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_last_message_sticky',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_last_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_first_msg,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_first_message',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_first_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_first_msg,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_first_message',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_last_msg,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_last_message',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_last_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_last_msg,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_last_message',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_member_started,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_member_started',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member_started',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_member_started,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_member_started',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_poll,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_poll,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'topics is_sticky 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_is_sticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'is_sticky',
			'SUB_PART' => '<em>null</em>',
		),

	'user_alerts alert_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_alert_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'alert_time',
			'SUB_PART' => '<em>null</em>',
		),

	'user_alerts id_alert 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_alert',
			'SUB_PART' => '<em>null</em>',
		),

	'user_alerts id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'user_alerts_prefs id_member,alert_pref 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts_prefs',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'user_alerts_prefs id_member,alert_pref 0002' => Array
		(
			'TABLE_NAME' => 'smf_user_alerts_prefs',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'alert_pref',
			'SUB_PART' => '<em>null</em>',
		),

	'user_drafts id_draft 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_draft',
			'SUB_PART' => '<em>null</em>',
		),

	'user_drafts id_member,id_draft,type 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'user_drafts id_member,id_draft,type 0002' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_draft',
			'SUB_PART' => '<em>null</em>',
		),

	'user_drafts id_member,id_draft,type 0003' => Array
		(
			'TABLE_NAME' => 'smf_user_drafts',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'idx_id_member',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'type',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes content_id,content_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'content',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'content_id',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes content_id,content_type 0002' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'content',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'content_type',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes content_id,content_type,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'content_id',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes content_id,content_type,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'content_type',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes content_id,content_type,id_member 0003' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'user_likes id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_user_likes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'liker',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),
);

$smf_tables['2.0'] = Array
(
	'admin_info_files' => Array
		(
			'Name' => 'smf_admin_info_files',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'approval_queue' => Array
		(
			'Name' => 'smf_approval_queue',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'attachments' => Array
		(
			'Name' => 'smf_attachments',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'ban_groups' => Array
		(
			'Name' => 'smf_ban_groups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'ban_items' => Array
		(
			'Name' => 'smf_ban_items',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'board_permissions' => Array
		(
			'Name' => 'smf_board_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'boards' => Array
		(
			'Name' => 'smf_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar' => Array
		(
			'Name' => 'smf_calendar',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar_holidays' => Array
		(
			'Name' => 'smf_calendar_holidays',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'categories' => Array
		(
			'Name' => 'smf_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'collapsed_categories' => Array
		(
			'Name' => 'smf_collapsed_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'custom_fields' => Array
		(
			'Name' => 'smf_custom_fields',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'group_moderators' => Array
		(
			'Name' => 'smf_group_moderators',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_actions' => Array
		(
			'Name' => 'smf_log_actions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_activity' => Array
		(
			'Name' => 'smf_log_activity',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_banned' => Array
		(
			'Name' => 'smf_log_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_boards' => Array
		(
			'Name' => 'smf_log_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_comments' => Array
		(
			'Name' => 'smf_log_comments',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_digest' => Array
		(
			'Name' => 'smf_log_digest',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_errors' => Array
		(
			'Name' => 'smf_log_errors',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_floodcontrol' => Array
		(
			'Name' => 'smf_log_floodcontrol',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_group_requests' => Array
		(
			'Name' => 'smf_log_group_requests',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_karma' => Array
		(
			'Name' => 'smf_log_karma',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_mark_read' => Array
		(
			'Name' => 'smf_log_mark_read',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_member_notices' => Array
		(
			'Name' => 'smf_log_member_notices',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_notify' => Array
		(
			'Name' => 'smf_log_notify',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_online' => Array
		(
			'Name' => 'smf_log_online',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_packages' => Array
		(
			'Name' => 'smf_log_packages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_polls' => Array
		(
			'Name' => 'smf_log_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_reported' => Array
		(
			'Name' => 'smf_log_reported',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_reported_comments' => Array
		(
			'Name' => 'smf_log_reported_comments',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_scheduled_tasks' => Array
		(
			'Name' => 'smf_log_scheduled_tasks',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_messages' => Array
		(
			'Name' => 'smf_log_search_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_results' => Array
		(
			'Name' => 'smf_log_search_results',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_subjects' => Array
		(
			'Name' => 'smf_log_search_subjects',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_topics' => Array
		(
			'Name' => 'smf_log_search_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_spider_hits' => Array
		(
			'Name' => 'smf_log_spider_hits',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_spider_stats' => Array
		(
			'Name' => 'smf_log_spider_stats',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_subscribed' => Array
		(
			'Name' => 'smf_log_subscribed',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_topics' => Array
		(
			'Name' => 'smf_log_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'mail_queue' => Array
		(
			'Name' => 'smf_mail_queue',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'membergroups' => Array
		(
			'Name' => 'smf_membergroups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'members' => Array
		(
			'Name' => 'smf_members',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'message_icons' => Array
		(
			'Name' => 'smf_message_icons',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'messages' => Array
		(
			'Name' => 'smf_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'moderators' => Array
		(
			'Name' => 'smf_moderators',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'openid_assoc' => Array
		(
			'Name' => 'smf_openid_assoc',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'package_servers' => Array
		(
			'Name' => 'smf_package_servers',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'permission_profiles' => Array
		(
			'Name' => 'smf_permission_profiles',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'permissions' => Array
		(
			'Name' => 'smf_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'personal_messages' => Array
		(
			'Name' => 'smf_personal_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'pm_recipients' => Array
		(
			'Name' => 'smf_pm_recipients',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'pm_rules' => Array
		(
			'Name' => 'smf_pm_rules',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'poll_choices' => Array
		(
			'Name' => 'smf_poll_choices',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'polls' => Array
		(
			'Name' => 'smf_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'scheduled_tasks' => Array
		(
			'Name' => 'smf_scheduled_tasks',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'sessions' => Array
		(
			'Name' => 'smf_sessions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'settings' => Array
		(
			'Name' => 'smf_settings',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'smileys' => Array
		(
			'Name' => 'smf_smileys',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'spiders' => Array
		(
			'Name' => 'smf_spiders',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'subscriptions' => Array
		(
			'Name' => 'smf_subscriptions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'themes' => Array
		(
			'Name' => 'smf_themes',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'topics' => Array
		(
			'Name' => 'smf_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),
);

$smf_columns['2.0'] = Array
(
	'admin_info_files data' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'admin_info_files filename' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'admin_info_files filetype' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'filetype',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'admin_info_files id_file' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'id_file',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'admin_info_files parameters' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'parameters',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'admin_info_files path' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'COLUMN_NAME' => 'path',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'approval_queue id_attach' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_attach',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'approval_queue id_event' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_event',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'approval_queue id_msg' => Array
		(
			'TABLE_NAME' => 'smf_approval_queue',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments approved' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments attachment_type' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'attachment_type',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments downloads' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'downloads',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments file_hash' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'file_hash',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments fileext' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'fileext',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments filename' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments height' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'height',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_attach' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_attach',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_folder' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_folder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_member' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_msg' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments id_thumb' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'id_thumb',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments mime_type' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'mime_type',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments size' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'size',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments width' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'width',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups ban_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'ban_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_access' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_access',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_login' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_login',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_post' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_post',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_register' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_register',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups expire_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups id_ban_group' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'id_ban_group',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups name' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_groups notes' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'notes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_groups reason' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items email_address' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items hits' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items hostname' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hostname',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items id_ban' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_ban',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items id_ban_group' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_ban_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items id_member' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high1' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high2' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high3' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high4' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low1' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low2' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low3' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low4' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions add_deny' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'add_deny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions id_group' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions id_profile' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards board_order' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'board_order',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards child_level' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'child_level',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards count_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'count_posts',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards description' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards id_board' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_cat' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_cat',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_last_msg' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_last_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_msg_updated' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_msg_updated',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_parent' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_parent',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_profile' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards id_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards member_groups' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'member_groups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1,0',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards name' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards num_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'num_posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards num_topics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'num_topics',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards override_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'override_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards redirect' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'redirect',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards unapproved_posts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'unapproved_posts',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards unapproved_topics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'unapproved_topics',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar end_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'end_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_board' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_event' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_event',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_member' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_topic' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar start_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'start_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar title' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'calendar_holidays event_date' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'event_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays id_holiday' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'id_holiday',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays title' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'categories can_collapse' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'can_collapse',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories cat_order' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'cat_order',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories id_cat' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'id_cat',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories name' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'collapsed_categories id_cat' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'id_cat',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'collapsed_categories id_member' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields active' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'active',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields bbc' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'bbc',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields can_search' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'can_search',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields col_name' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'col_name',
			'COLUMN_TYPE' => 'varchar(12)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields default_value' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'default_value',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields enclose' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'enclose',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields field_desc' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_desc',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields field_length' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_length',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '255',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields field_name' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_name',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields field_options' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_options',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields field_type' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'field_type',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'text',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields id_field' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'id_field',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields mask' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'mask',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields placement' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'placement',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields private' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'private',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields show_display' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_display',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'custom_fields show_profile' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_profile',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'forumprofile',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'custom_fields show_reg' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'COLUMN_NAME' => 'show_reg',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'group_moderators id_group' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'group_moderators id_member' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions extra' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions id_action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_action',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_log' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_log',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions ip' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity date' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity hits' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity most_on' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'most_on',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity posts' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity registers' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'registers',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity topics' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'topics',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned email' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'email',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned id_ban_log' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'id_ban_log',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ip' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments body' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_comments comment_type' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'comment_type',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'warning',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_comments counter' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'counter',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_comment' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_comment',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_notice' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_notice',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments id_recipient' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'id_recipient',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_comments member_name' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'member_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_comments recipient_name' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'COLUMN_NAME' => 'recipient_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_digest daily' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'daily',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest exclude' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'exclude',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_digest note_type' => Array
		(
			'TABLE_NAME' => 'smf_log_digest',
			'COLUMN_NAME' => 'note_type',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'post',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors error_type' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'error_type',
			'COLUMN_TYPE' => 'char(15)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'general',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors file' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'file',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors id_error' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'id_error',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ip' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors line' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'line',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors message' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'message',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors session' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors url' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol ip' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_floodcontrol log_type' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'log_type',
			'COLUMN_TYPE' => 'varchar(8)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'post',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_group_requests id_group' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests id_request' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'id_request',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_group_requests reason' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_group_requests time_applied' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'COLUMN_NAME' => 'time_applied',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma action' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma id_executor' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'id_executor',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma id_target' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'id_target',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_member_notices body' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_member_notices id_notice' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'id_notice',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_member_notices subject' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_notify id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify sent' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'sent',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ip' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online session' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_online url' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages db_changes' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'db_changes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages failed_steps' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'failed_steps',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages filename' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages id_install' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_install',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages id_member_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_member_installed',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages id_member_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'id_member_removed',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages install_state' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'install_state',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages member_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'member_installed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages member_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'member_removed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages name' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages package_id' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'package_id',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages themes_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'themes_installed',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_packages time_installed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'time_installed',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages time_removed' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'time_removed',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_packages version' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'COLUMN_NAME' => 'version',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_polls id_choice' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_choice',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls id_poll' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported body' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported closed' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'closed',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_board' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_report' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_report',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported ignore_all' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'ignore_all',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported membername' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'membername',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported num_reports' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'num_reports',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported subject' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported time_started' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'time_started',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported time_updated' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'COLUMN_NAME' => 'time_updated',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments comment' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'comment',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported_comments email_address' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported_comments id_comment' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_comment',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments id_report' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'id_report',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_reported_comments member_ip' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'member_ip',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported_comments membername' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'membername',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_reported_comments time_sent' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'COLUMN_NAME' => 'time_sent',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks id_log' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'id_log',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks id_task' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'id_task',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks time_run' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'time_run',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_scheduled_tasks time_taken' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'COLUMN_NAME' => 'time_taken',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results num_matches' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'num_matches',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results relevance' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'relevance',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects word' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'word',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_search_topics id_search' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'id_search',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits id_hit' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'id_hit',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits log_time' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'log_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits processed' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'processed',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_hits url' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_spider_stats id_spider' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats last_seen' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'last_seen',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats page_hits' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'page_hits',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_spider_stats stat_date' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'COLUMN_NAME' => 'stat_date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed end_time' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'end_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_sublog' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_sublog',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed id_subscribe' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'id_subscribe',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed old_id_group' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'old_id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed payments_pending' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'payments_pending',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed pending_details' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'pending_details',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_subscribed reminder_sent' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'reminder_sent',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed start_time' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'start_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed status' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'status',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_subscribed vendor_ref' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'COLUMN_NAME' => 'vendor_ref',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_topics id_member' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics id_msg' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue body' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'mail_queue headers' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'headers',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'mail_queue id_mail' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'id_mail',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue priority' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'priority',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue private' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'private',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue recipient' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'recipient',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'mail_queue send_html' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'send_html',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'mail_queue subject' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'mail_queue time_sent' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'COLUMN_NAME' => 'time_sent',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups description' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups group_name' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'group_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups group_type' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'group_type',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups hidden' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups id_group' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups id_parent' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'id_parent',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-2',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups max_messages' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'max_messages',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups min_posts' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'min_posts',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups online_color' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'online_color',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups stars' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'stars',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members additional_groups' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'additional_groups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members aim' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'aim',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members avatar' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'avatar',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members birthdate' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'birthdate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members buddy_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'buddy_list',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members date_registered' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'date_registered',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members email_address' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members gender' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'gender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members hide_email' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'hide_email',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members icq' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'icq',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members id_group' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_member' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_msg_last_visit' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_msg_last_visit',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_post_group' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_post_group',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members id_theme' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ignore_boards' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ignore_boards',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members instant_messages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'instant_messages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members is_activated' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'is_activated',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karma_bad' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karma_bad',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karma_good' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karma_good',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members last_login' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'last_login',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lngfile' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members location' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'location',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members member_ip' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_ip',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members member_ip2' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_ip2',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members member_name' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'member_name',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members message_labels' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'message_labels',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members mod_prefs' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'mod_prefs',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members msn' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'msn',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members new_pm' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'new_pm',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notify_announcements' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notify_announcements',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notify_regularity' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notify_regularity',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notify_send_body' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notify_send_body',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notify_types' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notify_types',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '2',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members openid_uri' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'openid_uri',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members passwd' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members passwd_flood' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd_flood',
			'COLUMN_TYPE' => 'varchar(12)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members password_salt' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'password_salt',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members personal_text' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'personal_text',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members pm_email_notify' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_email_notify',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members pm_ignore_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_ignore_list',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members pm_prefs' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_prefs',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members pm_receive_from' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_receive_from',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members posts' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members real_name' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'real_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secret_answer' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secret_answer',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secret_question' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secret_question',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members show_online' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'show_online',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members signature' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'signature',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members smiley_set' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'smiley_set',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members time_format' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'time_format',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members time_offset' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'time_offset',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members total_time_logged_in' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'total_time_logged_in',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members unread_messages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'unread_messages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members usertitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'usertitle',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members validation_code' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'validation_code',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members warning' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'warning',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members website_title' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'website_title',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members website_url' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'website_url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members yim' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'yim',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'message_icons filename' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'message_icons icon_order' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'icon_order',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons id_board' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons id_icon' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'id_icon',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons title' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages approved' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages body' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages icon' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'xx',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages id_board' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_member' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_msg' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_msg_modified' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_msg_modified',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages id_topic' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages modified_name' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modified_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modified_time' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modified_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages poster_email' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_email',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages poster_ip' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_ip',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages poster_name' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages poster_time' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'poster_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages smileys_enabled' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'smileys_enabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages subject' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'moderators id_board' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderators id_member' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'openid_assoc assoc_type' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'assoc_type',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'openid_assoc expires' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'expires',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'openid_assoc handle' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'handle',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'openid_assoc issued' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'issued',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'openid_assoc secret' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'secret',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'openid_assoc server_url' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'COLUMN_NAME' => 'server_url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'package_servers id_server' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'id_server',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'package_servers name' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'package_servers url' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'permission_profiles id_profile' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'COLUMN_NAME' => 'id_profile',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permission_profiles profile_name' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'COLUMN_NAME' => 'profile_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'permissions add_deny' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'add_deny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions id_group' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages body' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages deleted_by_sender' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'deleted_by_sender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages from_name' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'from_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages id_member_from' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_member_from',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages id_pm' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_pm',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages id_pm_head' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'id_pm_head',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages msgtime' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'msgtime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages subject' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'pm_recipients bcc' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'bcc',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients deleted' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'deleted',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients id_member' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients id_pm' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'id_pm',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients is_new' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'is_new',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients is_read' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'is_read',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients labels' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'labels',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'pm_rules actions' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'actions',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'pm_rules criteria' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'criteria',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'pm_rules delete_pm' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'delete_pm',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules id_member' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules id_rule' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'id_rule',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules is_or' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'is_or',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_rules rule_name' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'COLUMN_NAME' => 'rule_name',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices id_choice' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'id_choice',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices id_poll' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices label' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'label',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices votes' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'votes',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls change_vote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'change_vote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls expire_time' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls guest_vote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'guest_vote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls hide_results' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'hide_results',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls id_member' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls id_poll' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls max_votes' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'max_votes',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls num_guest_voters' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'num_guest_voters',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls poster_name' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'poster_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls question' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls reset_poll' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'reset_poll',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls voting_locked' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'voting_locked',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks disabled' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'disabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks id_task' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'id_task',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks next_time' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'next_time',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks task' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'task',
			'COLUMN_TYPE' => 'varchar(24)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'scheduled_tasks time_offset' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_offset',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks time_regularity' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_regularity',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'scheduled_tasks time_unit' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'COLUMN_NAME' => 'time_unit',
			'COLUMN_TYPE' => 'varchar(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'h',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'sessions data' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'sessions last_update' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'last_update',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions session_id' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'session_id',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings value' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings variable' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys code' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'code',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys description' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys filename' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys hidden' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys id_smiley' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'id_smiley',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smiley_order' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smiley_order',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smiley_row' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smiley_row',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'spiders id_spider' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'id_spider',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'spiders ip_info' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'ip_info',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'spiders spider_name' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'spider_name',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'spiders user_agent' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'COLUMN_NAME' => 'user_agent',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions active' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'active',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions add_groups' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'add_groups',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions allow_partial' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'allow_partial',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions cost' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'cost',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions description' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions email_complete' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'email_complete',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions id_group' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'id_group',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions id_subscribe' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'id_subscribe',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions length' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'length',
			'COLUMN_TYPE' => 'varchar(6)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions name' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'subscriptions reminder' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'reminder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'subscriptions repeatable' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'COLUMN_NAME' => 'repeatable',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes id_member' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes id_theme' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'id_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes value' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'themes variable' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'topics approved' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'approved',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_board' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_first_msg' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_first_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_last_msg' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_last_msg',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_member_started' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_member_started',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_member_updated' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_member_updated',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_poll' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_poll',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_previous_board' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_previous_board',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_previous_topic' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_previous_topic',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics id_topic' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics is_sticky' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'is_sticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics locked' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics num_replies' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'num_replies',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics num_views' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'num_views',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics unapproved_posts' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'unapproved_posts',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),
);

$smf_indexes['2.0'] = Array
(
	'admin_info_files filename 0001' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'filename',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'filename',
			'SUB_PART' => '30',
		),

	'admin_info_files id_file 0001' => Array
		(
			'TABLE_NAME' => 'smf_admin_info_files',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_file',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments attachment_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'attachment_type',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'attachment_type',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_attach 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_attach',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_member,id_attach 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_member,id_attach 0002' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_attach',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_groups id_ban_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_group',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items id_ban 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items id_ban_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_ban_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_group',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_profile',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions id_group,id_profile,permission 0003' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_cat,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_cat',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_cat,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_msg_updated 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_msg_updated',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg_updated',
			'SUB_PART' => '<em>null</em>',
		),

	'boards id_parent 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_parent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_parent',
			'SUB_PART' => '<em>null</em>',
		),

	'boards member_groups 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'member_groups',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'member_groups',
			'SUB_PART' => '48',
		),

	'calendar end_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'end_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'end_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_event 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_event',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_topic,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id_topic,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar start_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'start_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'start_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays event_date 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'event_date',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'event_date',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays id_holiday 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_holiday',
			'SUB_PART' => '<em>null</em>',
		),

	'categories id_cat 0001' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_cat',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories id_cat,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_cat',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories id_cat,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'custom_fields col_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'col_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'col_name',
			'SUB_PART' => '<em>null</em>',
		),

	'custom_fields id_field 0001' => Array
		(
			'TABLE_NAME' => 'smf_custom_fields',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_field',
			'SUB_PART' => '<em>null</em>',
		),

	'group_moderators id_group,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'group_moderators id_group,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_group_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_action 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_action',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_log',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity date 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity most_on 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'most_on',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'most_on',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned id_ban_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_ban_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments comment_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'comment_type',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'comment_type',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments id_comment 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_comment',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments id_recipient 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_recipient',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_recipient',
			'SUB_PART' => '<em>null</em>',
		),

	'log_comments log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors id_error 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_error',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ip 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip,log_type 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip,log_type 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'log_type',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_member,id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_member,id_group 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'log_group_requests id_request 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_group_requests',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_request',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma id_target,id_executor 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_target',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma id_target,id_executor 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_executor',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_member_notices id_notice 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_member_notices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_notice',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_member,id_topic,id_board 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_topic,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify id_topic,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online session 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session',
			'SUB_PART' => '<em>null</em>',
		),

	'log_packages filename 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'filename',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'filename',
			'SUB_PART' => '15',
		),

	'log_packages id_install 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_packages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_install',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls id_poll,id_member,id_choice 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_poll',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_choice',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported closed 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'closed',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'closed',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_report 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_report',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported time_started 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'time_started',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_started',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_comment 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_comment',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments id_report 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_report',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_report',
			'SUB_PART' => '<em>null</em>',
		),

	'log_reported_comments time_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_reported_comments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'time_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'log_scheduled_tasks id_log 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_log',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages id_search,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages id_search,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results id_search,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results id_search,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'word',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics id_search,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_search',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics id_search,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits id_hit 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_hit',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_spider',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits log_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'log_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'log_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_hits processed 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_hits',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'processed',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'processed',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_stats stat_date,id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'stat_date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_spider_stats stat_date,id_spider 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_spider_stats',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed end_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'end_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'end_time',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_sublog 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_sublog',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_subscribe,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_subscribe',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_subscribe',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed id_subscribe,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_subscribe',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed payments_pending 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'payments_pending',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'payments_pending',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed reminder_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'reminder_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'reminder_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'log_subscribed status 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_subscribed',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'status',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'status',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_member,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_member,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue id_mail 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_mail',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue priority,id_mail 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'mail_priority',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'priority',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue priority,id_mail 0002' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'mail_priority',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_mail',
			'SUB_PART' => '<em>null</em>',
		),

	'mail_queue time_sent 0001' => Array
		(
			'TABLE_NAME' => 'smf_mail_queue',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'time_sent',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'time_sent',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups min_posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'min_posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'min_posts',
			'SUB_PART' => '<em>null</em>',
		),

	'members birthdate 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'birthdate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'birthdate',
			'SUB_PART' => '<em>null</em>',
		),

	'members date_registered 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'date_registered',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date_registered',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_post_group 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_post_group',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_post_group',
			'SUB_PART' => '<em>null</em>',
		),

	'members id_theme 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_theme',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_theme',
			'SUB_PART' => '<em>null</em>',
		),

	'members last_login 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'last_login',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'last_login',
			'SUB_PART' => '<em>null</em>',
		),

	'members lngfile 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '30',
		),

	'members member_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'member_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'member_name',
			'SUB_PART' => '<em>null</em>',
		),

	'members posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posts',
			'SUB_PART' => '<em>null</em>',
		),

	'members real_name 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'real_name',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'real_name',
			'SUB_PART' => '<em>null</em>',
		),

	'members total_time_logged_in 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'total_time_logged_in',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'total_time_logged_in',
			'SUB_PART' => '<em>null</em>',
		),

	'members warning 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'warning',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'warning',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons id_icon 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_icon',
			'SUB_PART' => '<em>null</em>',
		),

	'messages approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'approved',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_board,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_board,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_board',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member_msg',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member_msg',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,approved,id_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member_msg',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'show_posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'show_posts',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'related_ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'related_ip',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'poster_ip',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_member,poster_ip,id_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'related_ip',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'current_topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'current_topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0003' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'current_topic',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'messages id_topic,id_msg,id_member,approved 0004' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'current_topic',
			'SEQ_IN_INDEX' => '4',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'messages poster_ip,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ip_index',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'poster_ip',
			'SUB_PART' => '15',
		),

	'messages poster_ip,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ip_index',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators id_board,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators id_board,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'openid_assoc expires 0001' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'expires',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'expires',
			'SUB_PART' => '<em>null</em>',
		),

	'openid_assoc server_url,handle 0001' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'server_url',
			'SUB_PART' => '125',
		),

	'openid_assoc server_url,handle 0002' => Array
		(
			'TABLE_NAME' => 'smf_openid_assoc',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'handle',
			'SUB_PART' => '125',
		),

	'package_servers id_server 0001' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_server',
			'SUB_PART' => '<em>null</em>',
		),

	'permission_profiles id_profile 0001' => Array
		(
			'TABLE_NAME' => 'smf_permission_profiles',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_profile',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions id_group,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_group',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions id_group,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_member_from,deleted_by_sender 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member_from',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_member_from,deleted_by_sender 0002' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted_by_sender',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages id_pm_head 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_pm_head',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm_head',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages msgtime 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'msgtime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'msgtime',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_member,deleted,id_pm 0003' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_pm,id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients id_pm,id_member 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules delete_pm 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'delete_pm',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'delete_pm',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_rules id_rule 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_rules',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_rule',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices id_poll,id_choice 0001' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices id_poll,id_choice 0002' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_choice',
			'SUB_PART' => '<em>null</em>',
		),

	'polls id_poll 0001' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks disabled 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'disabled',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'disabled',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks id_task 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_task',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks next_time 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'next_time',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'next_time',
			'SUB_PART' => '<em>null</em>',
		),

	'scheduled_tasks task 0001' => Array
		(
			'TABLE_NAME' => 'smf_scheduled_tasks',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'task',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'task',
			'SUB_PART' => '<em>null</em>',
		),

	'sessions session_id 0001' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session_id',
			'SUB_PART' => '<em>null</em>',
		),

	'settings variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'smileys id_smiley 0001' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_smiley',
			'SUB_PART' => '<em>null</em>',
		),

	'spiders id_spider 0001' => Array
		(
			'TABLE_NAME' => 'smf_spiders',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_spider',
			'SUB_PART' => '<em>null</em>',
		),

	'subscriptions active 0001' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'active',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'active',
			'SUB_PART' => '<em>null</em>',
		),

	'subscriptions id_subscribe 0001' => Array
		(
			'TABLE_NAME' => 'smf_subscriptions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_subscribe',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_member 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_member',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_theme',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0002' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_member',
			'SUB_PART' => '<em>null</em>',
		),

	'themes id_theme,id_member,variable 0003' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'topics approved 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'approved',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'approved',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'id_board',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,id_first_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'board_news',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,id_first_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'board_news',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_first_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'last_message_sticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'last_message_sticky',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'is_sticky',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_board,is_sticky,id_last_msg 0003' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'last_message_sticky',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'id_last_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_first_msg,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'first_message',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_first_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_first_msg,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'first_message',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_last_msg,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'last_message',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_last_msg',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_last_msg,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'last_message',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_member_started,id_board 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'member_started',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_member_started',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_member_started,id_board 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'member_started',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_board',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_poll,id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_poll',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_poll,id_topic 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'topics id_topic 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id_topic',
			'SUB_PART' => '<em>null</em>',
		),

	'topics is_sticky 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'is_sticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'is_sticky',
			'SUB_PART' => '<em>null</em>',
		),
);

$smf_tables['1.1'] = Array
(
	'attachments' => Array
		(
			'Name' => 'smf_attachments',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'ban_groups' => Array
		(
			'Name' => 'smf_ban_groups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'ban_items' => Array
		(
			'Name' => 'smf_ban_items',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'board_permissions' => Array
		(
			'Name' => 'smf_board_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'boards' => Array
		(
			'Name' => 'smf_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar' => Array
		(
			'Name' => 'smf_calendar',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar_holidays' => Array
		(
			'Name' => 'smf_calendar_holidays',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'categories' => Array
		(
			'Name' => 'smf_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'collapsed_categories' => Array
		(
			'Name' => 'smf_collapsed_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_actions' => Array
		(
			'Name' => 'smf_log_actions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_activity' => Array
		(
			'Name' => 'smf_log_activity',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_banned' => Array
		(
			'Name' => 'smf_log_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_boards' => Array
		(
			'Name' => 'smf_log_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_errors' => Array
		(
			'Name' => 'smf_log_errors',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_floodcontrol' => Array
		(
			'Name' => 'smf_log_floodcontrol',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_karma' => Array
		(
			'Name' => 'smf_log_karma',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_mark_read' => Array
		(
			'Name' => 'smf_log_mark_read',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_notify' => Array
		(
			'Name' => 'smf_log_notify',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_online' => Array
		(
			'Name' => 'smf_log_online',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_polls' => Array
		(
			'Name' => 'smf_log_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_messages' => Array
		(
			'Name' => 'smf_log_search_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_results' => Array
		(
			'Name' => 'smf_log_search_results',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_subjects' => Array
		(
			'Name' => 'smf_log_search_subjects',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search_topics' => Array
		(
			'Name' => 'smf_log_search_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_topics' => Array
		(
			'Name' => 'smf_log_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'membergroups' => Array
		(
			'Name' => 'smf_membergroups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'members' => Array
		(
			'Name' => 'smf_members',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'message_icons' => Array
		(
			'Name' => 'smf_message_icons',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'messages' => Array
		(
			'Name' => 'smf_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'moderators' => Array
		(
			'Name' => 'smf_moderators',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'package_servers' => Array
		(
			'Name' => 'smf_package_servers',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'permissions' => Array
		(
			'Name' => 'smf_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'personal_messages' => Array
		(
			'Name' => 'smf_personal_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'pm_recipients' => Array
		(
			'Name' => 'smf_pm_recipients',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'poll_choices' => Array
		(
			'Name' => 'smf_poll_choices',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'polls' => Array
		(
			'Name' => 'smf_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'sessions' => Array
		(
			'Name' => 'smf_sessions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'settings' => Array
		(
			'Name' => 'smf_settings',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'smileys' => Array
		(
			'Name' => 'smf_smileys',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'themes' => Array
		(
			'Name' => 'smf_themes',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'topics' => Array
		(
			'Name' => 'smf_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

);

$smf_columns['1.1'] = Array
(
	'attachments ID_ATTACH' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_ATTACH',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments ID_THUMB' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_THUMB',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments attachmentType' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'attachmentType',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments downloads' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'downloads',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments file_hash' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'file_hash',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments filename' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments height' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'height',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments size' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'size',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments width' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'width',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups ID_BAN_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'ID_BAN_GROUP',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups ban_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'ban_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_access' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_access',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_login' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_login',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_post' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_post',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups cannot_register' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'cannot_register',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups expire_time' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_groups name' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_groups notes' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'notes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_groups reason' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items ID_BAN' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ID_BAN',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ID_BAN_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ID_BAN_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items email_address' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items hits' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items hostname' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'hostname',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'ban_items ip_high1' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high2' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high3' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_high4' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_high4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low1' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low2' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low3' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'ban_items ip_low4' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'COLUMN_NAME' => 'ip_low4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions addDeny' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'addDeny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_LAST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_MSG_UPDATED' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_MSG_UPDATED',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_PARENT' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_PARENT',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards boardOrder' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'boardOrder',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards childLevel' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'childLevel',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards countPosts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'countPosts',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards description' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards memberGroups' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'memberGroups',
			'COLUMN_TYPE' => 'varchar(255)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1,0',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards name' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards numPosts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'numPosts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards numTopics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'numTopics',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards override_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'override_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards permission_mode' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'permission_mode',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_EVENT' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_EVENT',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar endDate' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'endDate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar startDate' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'startDate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar title' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'calendar_holidays ID_HOLIDAY' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'ID_HOLIDAY',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays eventDate' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'eventDate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays title' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'categories ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories canCollapse' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'canCollapse',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories catOrder' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'catOrder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories name' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'collapsed_categories ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'collapsed_categories ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions ID_ACTION' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ID_ACTION',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions extra' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions ip' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity date' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity hits' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity mostOn' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'mostOn',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity posts' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity registers' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'registers',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity topics' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'topics',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ID_BAN_LOG' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ID_BAN_LOG',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned email' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'email',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned ip' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ID_ERROR' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ID_ERROR',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ip' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors message' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'message',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors session' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors url' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol ip' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'char(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_EXECUTOR' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_TARGET' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'ID_TARGET',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma action' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify sent' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'sent',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ip' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'timestamp',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'CURRENT_TIMESTAMP',
			'EXTRA' => 'DEFAULT_GENERATED on update CURRENT_TIMESTAMP',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online session' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_online url' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_polls ID_CHOICE' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_CHOICE',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_messages ID_SEARCH' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'COLUMN_NAME' => 'ID_SEARCH',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results ID_SEARCH' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'ID_SEARCH',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results num_matches' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'num_matches',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_results relevance' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'COLUMN_NAME' => 'relevance',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_subjects word' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'COLUMN_NAME' => 'word',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_search_topics ID_SEARCH' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'ID_SEARCH',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search_topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups groupName' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'groupName',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups maxMessages' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'maxMessages',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups minPosts' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'minPosts',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups onlineColor' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'onlineColor',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups stars' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'stars',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members AIM' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'AIM',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ICQ' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ICQ',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_MSG_LAST_VISIT' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_MSG_LAST_VISIT',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_POST_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_POST_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members MSN' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'MSN',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members YIM' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'YIM',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members additionalGroups' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'additionalGroups',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members avatar' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'avatar',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members birthdate' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'birthdate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0001-01-01',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members buddy_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'buddy_list',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members dateRegistered' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'dateRegistered',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members emailAddress' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'emailAddress',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members gender' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'gender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members hideEmail' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'hideEmail',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members instantMessages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'instantMessages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members is_activated' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'is_activated',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karmaBad' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karmaBad',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karmaGood' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karmaGood',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lastLogin' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lastLogin',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lngfile' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members location' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'location',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberIP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'memberIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberIP2' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'memberIP2',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberName' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'memberName',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members messageLabels' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'messageLabels',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members notifyAnnouncements' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifyAnnouncements',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notifyOnce' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifyOnce',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notifySendBody' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifySendBody',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notifyTypes' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifyTypes',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '2',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members passwd' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members passwordSalt' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwordSalt',
			'COLUMN_TYPE' => 'varchar(5)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members personalText' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'personalText',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members pm_email_notify' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_email_notify',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members pm_ignore_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'pm_ignore_list',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members posts' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members realName' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'realName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretAnswer' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secretAnswer',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretQuestion' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secretQuestion',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members showOnline' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'showOnline',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members signature' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'signature',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members smileySet' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'smileySet',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeFormat' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'timeFormat',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeOffset' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'timeOffset',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members totalTimeLoggedIn' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'totalTimeLoggedIn',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members unreadMessages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'unreadMessages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members usertitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'usertitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members validation_code' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'validation_code',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteTitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'websiteTitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteUrl' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'websiteUrl',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'message_icons ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons ID_ICON' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'ID_ICON',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons filename' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'message_icons iconOrder' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'iconOrder',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'message_icons title' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MSG_MODIFIED' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_MSG_MODIFIED',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages body' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages icon' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'xx',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedName' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modifiedName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedTime' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modifiedTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages posterEmail' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterEmail',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterIP' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterName' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterTime' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages smileysEnabled' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'smileysEnabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages subject' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'moderators ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderators ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'package_servers ID_SERVER' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'ID_SERVER',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'package_servers name' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'package_servers url' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'permissions ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions addDeny' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'addDeny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages ID_MEMBER_FROM' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages ID_PM' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'ID_PM',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages body' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages deletedBySender' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'deletedBySender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages fromName' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'fromName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'personal_messages msgtime' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'msgtime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'personal_messages subject' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'pm_recipients ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients ID_PM' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'ID_PM',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients bcc' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'bcc',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients deleted' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'deleted',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients is_read' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'is_read',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'pm_recipients labels' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'COLUMN_NAME' => 'labels',
			'COLUMN_TYPE' => 'varchar(60)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices ID_CHOICE' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'ID_CHOICE',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices label' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'label',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices votes' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'votes',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls changeVote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'changeVote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls expireTime' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'expireTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls hideResults' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'hideResults',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls maxVotes' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'maxVotes',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls posterName' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'posterName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls question' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls votingLocked' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'votingLocked',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions data' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'sessions last_update' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'last_update',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions session_id' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'session_id',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings value' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings variable' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys ID_SMILEY' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'ID_SMILEY',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys code' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'code',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys description' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys filename' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys hidden' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smileyOrder' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smileyOrder',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smileyRow' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smileyRow',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes value' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'themes variable' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'topics ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_FIRST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_LAST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_STARTED' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_MEMBER_STARTED',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_UPDATED' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_MEMBER_UPDATED',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics isSticky' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'isSticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics locked' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics numReplies' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'numReplies',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics numViews' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'numViews',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),
);

$smf_indexes['1.1'] = Array
(
	'attachments ID_ATTACH 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ATTACH',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MEMBER,ID_ATTACH 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MEMBER,ID_ATTACH 0002' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_ATTACH',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MSG',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_groups ID_BAN_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_groups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items ID_BAN 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN',
			'SUB_PART' => '<em>null</em>',
		),

	'ban_items ID_BAN_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_ban_items',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_BAN_GROUP',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0003' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_CAT,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_CAT,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_MSG_UPDATED 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MSG_UPDATED',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG_UPDATED',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_PARENT 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_PARENT',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_PARENT',
			'SUB_PART' => '<em>null</em>',
		),

	'boards memberGroups 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberGroups',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberGroups',
			'SUB_PART' => '48',
		),

	'calendar ID_EVENT 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_EVENT',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar ID_TOPIC,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar ID_TOPIC,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar endDate 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'endDate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'endDate',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar startDate 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'startDate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'startDate',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays ID_HOLIDAY 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_HOLIDAY',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays eventDate 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'eventDate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'eventDate',
			'SUB_PART' => '<em>null</em>',
		),

	'categories ID_CAT 0001' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories ID_CAT,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories ID_CAT,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions ID_ACTION 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ACTION',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity date 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity hits 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'hits',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'hits',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity mostOn 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'mostOn',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'mostOn',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned ID_BAN_LOG 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN_LOG',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_MEMBER,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_MEMBER,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ID_ERROR 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ERROR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ip 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ip',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma ID_TARGET,ID_EXECUTOR 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TARGET',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma ID_TARGET,ID_EXECUTOR 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_MEMBER,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_MEMBER,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online session 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'ID_CHOICE',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages ID_SEARCH,ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SEARCH',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_messages ID_SEARCH,ID_MSG 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results ID_SEARCH,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SEARCH',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_results ID_SEARCH,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_results',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TOPIC',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'word',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_subjects word,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_subjects',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics ID_SEARCH,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SEARCH',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search_topics ID_SEARCH,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_MEMBER,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_MEMBER,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TOPIC',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups ID_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups minPosts 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'minPosts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'minPosts',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_GROUP',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_POST_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_POST_GROUP',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POST_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'members birthdate 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'birthdate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'birthdate',
			'SUB_PART' => '<em>null</em>',
		),

	'members dateRegistered 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'dateRegistered',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'dateRegistered',
			'SUB_PART' => '<em>null</em>',
		),

	'members lastLogin 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lastLogin',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lastLogin',
			'SUB_PART' => '<em>null</em>',
		),

	'members lngfile 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '30',
		),

	'members memberName 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberName',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberName',
			'SUB_PART' => '30',
		),

	'members posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posts',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'message_icons ID_ICON 0001' => Array
		(
			'TABLE_NAME' => 'smf_message_icons',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ICON',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_BOARD,ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_BOARD,ID_MSG 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'showPosts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'showPosts',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_MSG 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TOPIC',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC,ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC,ID_MSG 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages posterIP,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ipIndex',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posterIP',
			'SUB_PART' => '15',
		),

	'messages posterIP,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ipIndex',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'package_servers ID_SERVER 0001' => Array
		(
			'TABLE_NAME' => 'smf_package_servers',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SERVER',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions ID_GROUP,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions ID_GROUP,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages ID_MEMBER_FROM,deletedBySender 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages ID_MEMBER_FROM,deletedBySender 0002' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deletedBySender',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages ID_PM 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_PM',
			'SUB_PART' => '<em>null</em>',
		),

	'personal_messages msgtime 0001' => Array
		(
			'TABLE_NAME' => 'smf_personal_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'msgtime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'msgtime',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients ID_MEMBER,deleted,ID_PM 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients ID_MEMBER,deleted,ID_PM 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients ID_MEMBER,deleted,ID_PM 0003' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'ID_PM',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients ID_PM,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_PM',
			'SUB_PART' => '<em>null</em>',
		),

	'pm_recipients ID_PM,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_pm_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices ID_POLL,ID_CHOICE 0001' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices ID_POLL,ID_CHOICE 0002' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_CHOICE',
			'SUB_PART' => '<em>null</em>',
		),

	'polls ID_POLL 0001' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'sessions session_id 0001' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session_id',
			'SUB_PART' => '<em>null</em>',
		),

	'settings variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'smileys ID_SMILEY 0001' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SMILEY',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_THEME,ID_MEMBER,variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_THEME',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_THEME,ID_MEMBER,variable 0002' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_THEME,ID_MEMBER,variable 0003' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'topics ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'firstMessage',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_FIRST_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'firstMessage',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_LAST_MSG,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'lastMessage',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_LAST_MSG,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'lastMessage',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_POLL,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_POLL,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'topics isSticky 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'isSticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'isSticky',
			'SUB_PART' => '<em>null</em>',
		),
);

$smf_tables['1.0'] = Array
(
	'attachments' => Array
		(
			'Name' => 'smf_attachments',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'banned' => Array
		(
			'Name' => 'smf_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'board_permissions' => Array
		(
			'Name' => 'smf_board_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'boards' => Array
		(
			'Name' => 'smf_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar' => Array
		(
			'Name' => 'smf_calendar',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar_holidays' => Array
		(
			'Name' => 'smf_calendar_holidays',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'categories' => Array
		(
			'Name' => 'smf_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'collapsed_categories' => Array
		(
			'Name' => 'smf_collapsed_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'im_recipients' => Array
		(
			'Name' => 'smf_im_recipients',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'instant_messages' => Array
		(
			'Name' => 'smf_instant_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_actions' => Array
		(
			'Name' => 'smf_log_actions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_activity' => Array
		(
			'Name' => 'smf_log_activity',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_banned' => Array
		(
			'Name' => 'smf_log_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_boards' => Array
		(
			'Name' => 'smf_log_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_errors' => Array
		(
			'Name' => 'smf_log_errors',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_floodcontrol' => Array
		(
			'Name' => 'smf_log_floodcontrol',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_karma' => Array
		(
			'Name' => 'smf_log_karma',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_mark_read' => Array
		(
			'Name' => 'smf_log_mark_read',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_notify' => Array
		(
			'Name' => 'smf_log_notify',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_online' => Array
		(
			'Name' => 'smf_log_online',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_polls' => Array
		(
			'Name' => 'smf_log_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_search' => Array
		(
			'Name' => 'smf_log_search',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_topics' => Array
		(
			'Name' => 'smf_log_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'membergroups' => Array
		(
			'Name' => 'smf_membergroups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'members' => Array
		(
			'Name' => 'smf_members',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'messages' => Array
		(
			'Name' => 'smf_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'moderators' => Array
		(
			'Name' => 'smf_moderators',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'permissions' => Array
		(
			'Name' => 'smf_permissions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'poll_choices' => Array
		(
			'Name' => 'smf_poll_choices',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'polls' => Array
		(
			'Name' => 'smf_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'sessions' => Array
		(
			'Name' => 'smf_sessions',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'settings' => Array
		(
			'Name' => 'smf_settings',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'smileys' => Array
		(
			'Name' => 'smf_smileys',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'themes' => Array
		(
			'Name' => 'smf_themes',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'topics' => Array
		(
			'Name' => 'smf_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),
);

$smf_columns['1.0'] = Array
(
	'attachments ID_ATTACH' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_ATTACH',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments downloads' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'downloads',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'attachments file_hash' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'file_hash',
			'COLUMN_TYPE' => 'varchar(40)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments filename' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'attachments size' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'COLUMN_NAME' => 'size',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ID_BAN' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ID_BAN',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ban_time' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ban_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ban_type' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ban_type',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned email_address' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'email_address',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned expire_time' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'expire_time',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned hostname' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'hostname',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned ip_high1' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_high1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_high2' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_high2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_high3' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_high3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_high4' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_high4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_low1' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_low1',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_low2' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_low2',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_low3' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_low3',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned ip_low4' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'ip_low4',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'banned notes' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'notes',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned reason' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'reason',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned restriction_type' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'COLUMN_NAME' => 'restriction_type',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'board_permissions ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions addDeny' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'addDeny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'board_permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_LAST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_PARENT' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_PARENT',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards boardOrder' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'boardOrder',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards childLevel' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'childLevel',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards countPosts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'countPosts',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards description' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards lastUpdated' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'lastUpdated',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards memberGroups' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'memberGroups',
			'COLUMN_TYPE' => 'varchar(128)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1,0',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards name' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards numPosts' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'numPosts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards numTopics' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'numTopics',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards override_theme' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'override_theme',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards use_local_permissions' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'COLUMN_NAME' => 'use_local_permissions',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_EVENT' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_EVENT',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar eventDate' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'eventDate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0000-00-00',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar title' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'calendar_holidays ID_HOLIDAY' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'ID_HOLIDAY',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays eventDate' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'eventDate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0000-00-00',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holidays title' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'categories ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories canCollapse' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'canCollapse',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories catOrder' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'catOrder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories name' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'collapsed_categories ID_CAT' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'collapsed_categories ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'im_recipients ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'im_recipients ID_PM' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'COLUMN_NAME' => 'ID_PM',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'im_recipients bcc' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'COLUMN_NAME' => 'bcc',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'im_recipients deleted' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'COLUMN_NAME' => 'deleted',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'im_recipients is_read' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'COLUMN_NAME' => 'is_read',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_FROM' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages ID_PM' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'ID_PM',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages body' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages deletedBySender' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'deletedBySender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages fromName' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'fromName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages msgtime' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'msgtime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages subject' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions ID_ACTION' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ID_ACTION',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_actions IP' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'IP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions action' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions extra' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'extra',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_actions logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity date' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'date',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0000-00-00',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity hits' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity mostOn' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'mostOn',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity posts' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity registers' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'registers',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity topics' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'COLUMN_NAME' => 'topics',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ID_BAN_LOG' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ID_BAN_LOG',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned email' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'email',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned ip' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ID_ERROR' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ID_ERROR',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors IP' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'IP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors message' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'message',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors session' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors url' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol ip' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_EXECUTOR' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_TARGET' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'ID_TARGET',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma action' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_notify sent' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'COLUMN_NAME' => 'sent',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online ip' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'timestamp',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'CURRENT_TIMESTAMP',
			'EXTRA' => 'DEFAULT_GENERATED on update CURRENT_TIMESTAMP',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online session' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'session',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_online url' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_polls ID_CHOICE' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_CHOICE',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_polls ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search ID_SEARCH' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'COLUMN_NAME' => 'ID_SEARCH',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search num_matches' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'COLUMN_NAME' => 'num_matches',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_search relevance' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'COLUMN_NAME' => 'relevance',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics logTime' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups groupName' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'groupName',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups maxMessages' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'maxMessages',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups minPosts' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'minPosts',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups onlineColor' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'onlineColor',
			'COLUMN_TYPE' => 'varchar(20)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'membergroups stars' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'COLUMN_NAME' => 'stars',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members AIM' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'AIM',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ICQ' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ICQ',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_MSG_LAST_VISIT' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_MSG_LAST_VISIT',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_POST_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_POST_GROUP',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members MSN' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'MSN',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members YIM' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'YIM',
			'COLUMN_TYPE' => 'varchar(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members additionalGroups' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'additionalGroups',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members avatar' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'avatar',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members birthdate' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'birthdate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0000-00-00',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members dateRegistered' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'dateRegistered',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members emailAddress' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'emailAddress',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members gender' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'gender',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members hideEmail' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'hideEmail',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members im_email_notify' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'im_email_notify',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members im_ignore_list' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'im_ignore_list',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members instantMessages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'instantMessages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members is_activated' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'is_activated',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karmaBad' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karmaBad',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karmaGood' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'karmaGood',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lastLogin' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lastLogin',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lngfile' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members location' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'location',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberIP' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'memberIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberName' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'memberName',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members notifyAnnouncements' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifyAnnouncements',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notifyOnce' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'notifyOnce',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members passwd' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwd',
			'COLUMN_TYPE' => 'varchar(64)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members passwordSalt' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'passwordSalt',
			'COLUMN_TYPE' => 'varchar(5)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members personalText' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'personalText',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members posts' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members realName' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'realName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretAnswer' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secretAnswer',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretQuestion' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'secretQuestion',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members showOnline' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'showOnline',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members signature' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'signature',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members smileySet' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'smileySet',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeFormat' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'timeFormat',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeOffset' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'timeOffset',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members totalTimeLoggedIn' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'totalTimeLoggedIn',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members unreadMessages' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'unreadMessages',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members usertitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'usertitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members validation_code' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'validation_code',
			'COLUMN_TYPE' => 'varchar(10)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteTitle' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'websiteTitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteUrl' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'COLUMN_NAME' => 'websiteUrl',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MSG' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages body' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages icon' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'varchar(16)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => 'xx',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedName' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modifiedName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedTime' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'modifiedTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages posterEmail' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterEmail',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterIP' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterName' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterTime' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'posterTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages smileysEnabled' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'smileysEnabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages subject' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'moderators ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'moderators ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions ID_GROUP' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions addDeny' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'addDeny',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'permissions permission' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'COLUMN_NAME' => 'permission',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices ID_CHOICE' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'ID_CHOICE',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'poll_choices label' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'label',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'poll_choices votes' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'COLUMN_NAME' => 'votes',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls changeVote' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'changeVote',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls expireTime' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'expireTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls hideResults' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'hideResults',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls maxVotes' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'maxVotes',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls posterName' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'posterName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls question' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls votingLocked' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'COLUMN_NAME' => 'votingLocked',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions data' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'data',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'sessions last_update' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'last_update',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'sessions session_id' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'COLUMN_NAME' => 'session_id',
			'COLUMN_TYPE' => 'char(32)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings value' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings variable' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys ID_SMILEY' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'ID_SMILEY',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys code' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'code',
			'COLUMN_TYPE' => 'varchar(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys description' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys filename' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'filename',
			'COLUMN_TYPE' => 'varchar(48)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'smileys hidden' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'hidden',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smileyOrder' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smileyOrder',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'smileys smileyRow' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'COLUMN_NAME' => 'smileyRow',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes ID_THEME' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'ID_THEME',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'themes value' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'themes variable' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'topics ID_BOARD' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_FIRST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_LAST_MSG' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_STARTED' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_MEMBER_STARTED',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_UPDATED' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_MEMBER_UPDATED',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_POLL' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics isSticky' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'isSticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics locked' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics numReplies' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'numReplies',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics numViews' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'COLUMN_NAME' => 'numViews',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),
);

$smf_indexes['1.0'] = Array
(
	'attachments ID_ATTACH 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ATTACH',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MEMBER,ID_ATTACH 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MEMBER,ID_ATTACH 0002' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_ATTACH',
			'SUB_PART' => '<em>null</em>',
		),

	'attachments ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_attachments',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MSG',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'banned ID_BAN 0001' => Array
		(
			'TABLE_NAME' => 'smf_banned',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'board_permissions ID_GROUP,ID_BOARD,permission 0003' => Array
		(
			'TABLE_NAME' => 'smf_board_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_CAT,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_CAT,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'categories',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards boardOrder 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'boardOrder',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'boardOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'boards childLevel,ID_PARENT,boardOrder,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'children',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'childLevel',
			'SUB_PART' => '<em>null</em>',
		),

	'boards childLevel,ID_PARENT,boardOrder,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'children',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_PARENT',
			'SUB_PART' => '<em>null</em>',
		),

	'boards childLevel,ID_PARENT,boardOrder,ID_BOARD 0003' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'children',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'boardOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'boards childLevel,ID_PARENT,boardOrder,ID_BOARD 0004' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'children',
			'SEQ_IN_INDEX' => '4',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards lastUpdated 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lastUpdated',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lastUpdated',
			'SUB_PART' => '<em>null</em>',
		),

	'boards memberGroups 0001' => Array
		(
			'TABLE_NAME' => 'smf_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberGroups',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberGroups',
			'SUB_PART' => '48',
		),

	'calendar ID_EVENT 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_EVENT',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar eventDate 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'eventDate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'eventDate',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays ID_HOLIDAY 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_HOLIDAY',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holidays eventDate 0001' => Array
		(
			'TABLE_NAME' => 'smf_calendar_holidays',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'eventDate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'eventDate',
			'SUB_PART' => '<em>null</em>',
		),

	'categories ID_CAT 0001' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'categories catOrder 0001' => Array
		(
			'TABLE_NAME' => 'smf_categories',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'catOrder',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'catOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories ID_CAT,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'collapsed_categories ID_CAT,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_collapsed_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'im_recipients ID_MEMBER,deleted 0001' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'im_recipients ID_MEMBER,deleted 0002' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deleted',
			'SUB_PART' => '<em>null</em>',
		),

	'im_recipients ID_PM,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_PM',
			'SUB_PART' => '<em>null</em>',
		),

	'im_recipients ID_PM,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_im_recipients',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_FROM,deletedBySender 0001' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_FROM,deletedBySender 0002' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'deletedBySender',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_PM 0001' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_PM',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages msgtime 0001' => Array
		(
			'TABLE_NAME' => 'smf_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'msgtime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'msgtime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions ID_ACTION 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ACTION',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_actions logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_actions',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity date 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'date',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity hits 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'hits',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'hits',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity mostOn 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'mostOn',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'mostOn',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned ID_BAN_LOG 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BAN_LOG',
			'SUB_PART' => '<em>null</em>',
		),

	'log_banned logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_banned',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ID_ERROR 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ERROR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '16',
		),

	'log_floodcontrol logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_floodcontrol',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma ID_TARGET,ID_EXECUTOR 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TARGET',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma ID_TARGET,ID_EXECUTOR 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma logTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_notify ID_MEMBER,ID_TOPIC,ID_BOARD 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_notify',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online logTime,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'online',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online logTime,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'online',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online session 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_online',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_polls ID_POLL,ID_MEMBER,ID_CHOICE 0003' => Array
		(
			'TABLE_NAME' => 'smf_log_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'ID_CHOICE',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search ID_SEARCH,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SEARCH',
			'SUB_PART' => '<em>null</em>',
		),

	'log_search ID_SEARCH,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_search',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_TOPIC,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_TOPIC,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups ID_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups minPosts 0001' => Array
		(
			'TABLE_NAME' => 'smf_membergroups',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'minPosts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'minPosts',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_GROUP',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_POST_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_POST_GROUP',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POST_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'members birthdate 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'birthdate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'birthdate',
			'SUB_PART' => '<em>null</em>',
		),

	'members dateRegistered 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'dateRegistered',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'dateRegistered',
			'SUB_PART' => '<em>null</em>',
		),

	'members lastLogin 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lastLogin',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lastLogin',
			'SUB_PART' => '<em>null</em>',
		),

	'members lngfile 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '30',
		),

	'members memberName 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberName',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberName',
			'SUB_PART' => '30',
		),

	'members posts 0001' => Array
		(
			'TABLE_NAME' => 'smf_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posts',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'participation',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TOPIC',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC,ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC,ID_MSG 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'topic',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages posterIP,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ipIndex',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posterIP',
			'SUB_PART' => '15',
		),

	'messages posterIP,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ipIndex',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages posterTime 0001' => Array
		(
			'TABLE_NAME' => 'smf_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posterTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posterTime',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'moderators ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'smf_moderators',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions ID_GROUP,permission 0001' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'permissions ID_GROUP,permission 0002' => Array
		(
			'TABLE_NAME' => 'smf_permissions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'permission',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices ID_POLL,ID_CHOICE 0001' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'poll_choices ID_POLL,ID_CHOICE 0002' => Array
		(
			'TABLE_NAME' => 'smf_poll_choices',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_CHOICE',
			'SUB_PART' => '<em>null</em>',
		),

	'polls ID_POLL 0001' => Array
		(
			'TABLE_NAME' => 'smf_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'sessions session_id 0001' => Array
		(
			'TABLE_NAME' => 'smf_sessions',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'session_id',
			'SUB_PART' => '<em>null</em>',
		),

	'settings variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_settings',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'smileys ID_SMILEY 0001' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_SMILEY',
			'SUB_PART' => '<em>null</em>',
		),

	'smileys smileyOrder 0001' => Array
		(
			'TABLE_NAME' => 'smf_smileys',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'smileyOrder',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'smileyOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_MEMBER,ID_THEME,variable 0001' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_MEMBER,ID_THEME,variable 0002' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_THEME',
			'SUB_PART' => '<em>null</em>',
		),

	'themes ID_MEMBER,ID_THEME,variable 0003' => Array
		(
			'TABLE_NAME' => 'smf_themes',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'topics ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_BOARD',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'firstMessage',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_FIRST_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'firstMessage',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_LAST_MSG,ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'lastMessage',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_LAST_MSG,ID_BOARD 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'lastMessage',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_POLL,ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_POLL,ID_TOPIC 0002' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'poll',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'topics ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'topics isSticky 0001' => Array
		(
			'TABLE_NAME' => 'smf_topics',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'isSticky',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'isSticky',
			'SUB_PART' => '<em>null</em>',
		),
);

$smf_tables['Yabbse'] = Array
(
	'banned' => Array
		(
			'Name' => 'yabbse_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'boards' => Array
		(
			'Name' => 'yabbse_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar' => Array
		(
			'Name' => 'yabbse_calendar',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'calendar_holiday' => Array
		(
			'Name' => 'yabbse_calendar_holiday',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'categories' => Array
		(
			'Name' => 'yabbse_categories',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'censor' => Array
		(
			'Name' => 'yabbse_censor',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'instant_messages' => Array
		(
			'Name' => 'yabbse_instant_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_activity' => Array
		(
			'Name' => 'yabbse_log_activity',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_banned' => Array
		(
			'Name' => 'yabbse_log_banned',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_boards' => Array
		(
			'Name' => 'yabbse_log_boards',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_clicks' => Array
		(
			'Name' => 'yabbse_log_clicks',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_errors' => Array
		(
			'Name' => 'yabbse_log_errors',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_floodcontrol' => Array
		(
			'Name' => 'yabbse_log_floodcontrol',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_karma' => Array
		(
			'Name' => 'yabbse_log_karma',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_mark_read' => Array
		(
			'Name' => 'yabbse_log_mark_read',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_online' => Array
		(
			'Name' => 'yabbse_log_online',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'log_topics' => Array
		(
			'Name' => 'yabbse_log_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'membergroups' => Array
		(
			'Name' => 'yabbse_membergroups',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'members' => Array
		(
			'Name' => 'yabbse_members',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'messages' => Array
		(
			'Name' => 'yabbse_messages',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'polls' => Array
		(
			'Name' => 'yabbse_polls',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'reserved_names' => Array
		(
			'Name' => 'yabbse_reserved_names',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'settings' => Array
		(
			'Name' => 'yabbse_settings',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),

	'topics' => Array
		(
			'Name' => 'yabbse_topics',
			'Engine' => 'MyISAM',
			'Collation' => 'latin1_swedish_ci',
		),
);

$smf_columns['Yabbse'] = Array
(
	'banned type' => Array
		(
			'TABLE_NAME' => 'yabbse_banned',
			'COLUMN_NAME' => 'type',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'banned value' => Array
		(
			'TABLE_NAME' => 'yabbse_banned',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_CAT' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards ID_LAST_TOPIC' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'ID_LAST_TOPIC',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards boardOrder' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'boardOrder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards count' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'count',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards description' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'description',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards isAnnouncement' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'isAnnouncement',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards moderators' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'moderators',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards name' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'boards notifyAnnouncements' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'notifyAnnouncements',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards numPosts' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'numPosts',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'boards numTopics' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'COLUMN_NAME' => 'numTopics',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar day' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'day',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'id',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_board' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'id_board',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_member' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'id_member',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar id_topic' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'id_topic',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar month' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'month',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar title' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'char(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'calendar year' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'COLUMN_NAME' => 'year',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holiday day' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'COLUMN_NAME' => 'day',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holiday id' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'COLUMN_NAME' => 'id',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holiday month' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'COLUMN_NAME' => 'month',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'calendar_holiday title' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'COLUMN_NAME' => 'title',
			'COLUMN_TYPE' => 'char(30)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'calendar_holiday year' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'COLUMN_NAME' => 'year',
			'COLUMN_TYPE' => 'smallint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories ID_CAT' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'COLUMN_NAME' => 'ID_CAT',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories catOrder' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'COLUMN_NAME' => 'catOrder',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'categories memberGroups' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'COLUMN_NAME' => 'memberGroups',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'categories name' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'COLUMN_NAME' => 'name',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'censor proper' => Array
		(
			'TABLE_NAME' => 'yabbse_censor',
			'COLUMN_NAME' => 'proper',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'censor vulgar' => Array
		(
			'TABLE_NAME' => 'yabbse_censor',
			'COLUMN_NAME' => 'vulgar',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages ID_IM' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'ID_IM',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_FROM' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_TO' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'ID_MEMBER_TO',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages body' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages deletedBy' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'deletedBy',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages fromName' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'fromName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages msgtime' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'msgtime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages readBy' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'readBy',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'instant_messages subject' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'instant_messages toName' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'COLUMN_NAME' => 'toName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_activity day' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'day',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity hits' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'hits',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity month' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'month',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity mostOn' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'mostOn',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity posts' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity registers' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'registers',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity topics' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'topics',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_activity year' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'COLUMN_NAME' => 'year',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_banned email' => Array
		(
			'TABLE_NAME' => 'yabbse_log_banned',
			'COLUMN_NAME' => 'email',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned ip' => Array
		(
			'TABLE_NAME' => 'yabbse_log_banned',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_banned logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_banned',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_BOARD' => Array
		(
			'TABLE_NAME' => 'yabbse_log_boards',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_log_boards',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_boards logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_boards',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_clicks agent' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'COLUMN_NAME' => 'agent',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_clicks fromUrl' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'COLUMN_NAME' => 'fromUrl',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_clicks ip' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_clicks logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_clicks toUrl' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'COLUMN_NAME' => 'toUrl',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors ID_ERROR' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'ID_ERROR',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors IP' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'IP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_errors message' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'message',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_errors url' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'COLUMN_NAME' => 'url',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol ip' => Array
		(
			'TABLE_NAME' => 'yabbse_log_floodcontrol',
			'COLUMN_NAME' => 'ip',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_floodcontrol logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_floodcontrol',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_EXECUTOR' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma ID_TARGET' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'COLUMN_NAME' => 'ID_TARGET',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_karma action' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'COLUMN_NAME' => 'action',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'log_karma logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD' => Array
		(
			'TABLE_NAME' => 'yabbse_log_mark_read',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'smallint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_log_mark_read',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_mark_read logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_mark_read',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online identity' => Array
		(
			'TABLE_NAME' => 'yabbse_log_online',
			'COLUMN_NAME' => 'identity',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_online logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_online',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'mediumint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics logTime' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'COLUMN_NAME' => 'logTime',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'log_topics notificationSent' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'COLUMN_NAME' => 'notificationSent',
			'COLUMN_TYPE' => 'tinyint unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups ID_GROUP' => Array
		(
			'TABLE_NAME' => 'yabbse_membergroups',
			'COLUMN_NAME' => 'ID_GROUP',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups grouptype' => Array
		(
			'TABLE_NAME' => 'yabbse_membergroups',
			'COLUMN_NAME' => 'grouptype',
			'COLUMN_TYPE' => 'tinyint(1)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'membergroups membergroup' => Array
		(
			'TABLE_NAME' => 'yabbse_membergroups',
			'COLUMN_NAME' => 'membergroup',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members AIM' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'AIM',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ICQ' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'ICQ',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'int unsigned',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members MSN' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'MSN',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members YIM' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'YIM',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members avatar' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'avatar',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members birthdate' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'birthdate',
			'COLUMN_TYPE' => 'date',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0000-00-00',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members dateRegistered' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'dateRegistered',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members emailAddress' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'emailAddress',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members gender' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'gender',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members hideEmail' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'hideEmail',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members im_email_notify' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'im_email_notify',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members im_ignore_list' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'im_ignore_list',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members karmaBad' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'karmaBad',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members karmaGood' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'karmaGood',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lastLogin' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'lastLogin',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members lngfile' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'lngfile',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members location' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'location',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberGroup' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'memberGroup',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberIP' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'memberIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members memberName' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'memberName',
			'COLUMN_TYPE' => 'varchar(80)',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members notifyAnnouncements' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'notifyAnnouncements',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members notifyOnce' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'notifyOnce',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members passwd' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'passwd',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members personalText' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'personalText',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members posts' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'posts',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members realName' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'realName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretAnswer' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'secretAnswer',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members secretQuestion' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'secretQuestion',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members signature' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'signature',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeFormat' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'timeFormat',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members timeOffset' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'timeOffset',
			'COLUMN_TYPE' => 'float',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'members usertitle' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'usertitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteTitle' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'websiteTitle',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'members websiteUrl' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'COLUMN_NAME' => 'websiteUrl',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages ID_MEMBER' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'ID_MEMBER',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_MSG' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'ID_MSG',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages attachmentFilename' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'attachmentFilename',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages attachmentSize' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'attachmentSize',
			'COLUMN_TYPE' => 'mediumint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages body' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'body',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages icon' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'icon',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedName' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'modifiedName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages modifiedTime' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'modifiedTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages posterEmail' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'posterEmail',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterIP' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'posterIP',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterName' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'posterName',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'messages posterTime' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'posterTime',
			'COLUMN_TYPE' => 'bigint',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages smiliesEnabled' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'smiliesEnabled',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'messages subject' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'COLUMN_NAME' => 'subject',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls ID_POLL' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls option1' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option1',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option2' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option2',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option3' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option3',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option4' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option4',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option5' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option5',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option6' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option6',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option7' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option7',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls option8' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'option8',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls question' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'question',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls votedMemberIDs' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votedMemberIDs',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'polls votes1' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes1',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes2' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes2',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes3' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes3',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes4' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes4',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes5' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes5',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes6' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes6',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes7' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes7',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votes8' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votes8',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'polls votingLocked' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'COLUMN_NAME' => 'votingLocked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'reserved_names setting' => Array
		(
			'TABLE_NAME' => 'yabbse_reserved_names',
			'COLUMN_NAME' => 'setting',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'reserved_names value' => Array
		(
			'TABLE_NAME' => 'yabbse_reserved_names',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings value' => Array
		(
			'TABLE_NAME' => 'yabbse_settings',
			'COLUMN_NAME' => 'value',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'settings variable' => Array
		(
			'TABLE_NAME' => 'yabbse_settings',
			'COLUMN_NAME' => 'variable',
			'COLUMN_TYPE' => 'tinytext',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'topics ID_BOARD' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_BOARD',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_FIRST_MSG' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_FIRST_MSG',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_LAST_MSG' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_LAST_MSG',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_STARTED' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_MEMBER_STARTED',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_MEMBER_UPDATED' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_MEMBER_UPDATED',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_POLL' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_POLL',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '-1',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics ID_TOPIC' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'ID_TOPIC',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => 'auto_increment',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics isSticky' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'isSticky',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics locked' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'locked',
			'COLUMN_TYPE' => 'tinyint',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics notifies' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'notifies',
			'COLUMN_TYPE' => 'text',
			'IS_NULLABLE' => 'YES',
			'COLUMN_DEFAULT' => '<em>null</em>',
			'EXTRA' => '',
			'COLLATION_NAME' => 'latin1_swedish_ci',
		),

	'topics numReplies' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'numReplies',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),

	'topics numViews' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'COLUMN_NAME' => 'numViews',
			'COLUMN_TYPE' => 'int',
			'IS_NULLABLE' => 'NO',
			'COLUMN_DEFAULT' => '0',
			'EXTRA' => '',
			'COLLATION_NAME' => '<em>null</em>',
		),
);

$smf_indexes['Yabbse'] = Array
(
	'boards ID_BOARD 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'boards ID_CAT 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_CAT',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'boards boardOrder 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_boards',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'boardOrder',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'boardOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar id 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar year,month 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_year_month',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'year',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar year,month 0002' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_year_month',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'month',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holiday id 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'id',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holiday month 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_month',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'month',
			'SUB_PART' => '<em>null</em>',
		),

	'calendar_holiday year 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_calendar_holiday',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'idx_year',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'year',
			'SUB_PART' => '<em>null</em>',
		),

	'categories ID_CAT 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_CAT',
			'SUB_PART' => '<em>null</em>',
		),

	'categories catOrder 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_categories',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'catOrder',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'catOrder',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_IM 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_IM',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_FROM 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER_FROM',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER_FROM',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages ID_MEMBER_TO 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER_TO',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER_TO',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages deletedBy 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'deletedBy',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'deletedBy',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages msgtime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'msgtime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'msgtime',
			'SUB_PART' => '<em>null</em>',
		),

	'instant_messages readBy 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_instant_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'readBy',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'readBy',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity hits 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'hits',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'hits',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity month,day,year 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'month',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity month,day,year 0002' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'day',
			'SUB_PART' => '<em>null</em>',
		),

	'log_activity month,day,year 0003' => Array
		(
			'TABLE_NAME' => 'yabbse_log_activity',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '3',
			'COLUMN_NAME' => 'year',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_boards ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'yabbse_log_boards',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_clicks logTime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_clicks',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors ID_ERROR 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_ERROR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_errors logTime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_errors',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_floodcontrol ip 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_floodcontrol',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ip',
			'SUB_PART' => '16',
		),

	'log_karma ID_EXECUTOR 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_EXECUTOR',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_EXECUTOR',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma ID_TARGET 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TARGET',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TARGET',
			'SUB_PART' => '<em>null</em>',
		),

	'log_karma logTime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_karma',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_BOARD',
			'SUB_PART' => '<em>null</em>',
		),

	'log_mark_read ID_BOARD,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'yabbse_log_mark_read',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online identity 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_online',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'identity',
			'SUB_PART' => '<em>null</em>',
		),

	'log_online logTime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_online',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'logTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'logTime',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_TOPIC,ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'log_topics ID_TOPIC,ID_MEMBER 0002' => Array
		(
			'TABLE_NAME' => 'yabbse_log_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '2',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'membergroups ID_GROUP 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_membergroups',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_GROUP',
			'SUB_PART' => '<em>null</em>',
		),

	'members ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'members birthdate 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'birthdate',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'birthdate',
			'SUB_PART' => '<em>null</em>',
		),

	'members dateRegistered 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'dateRegistered',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'dateRegistered',
			'SUB_PART' => '<em>null</em>',
		),

	'members lastLogin 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lastLogin',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lastLogin',
			'SUB_PART' => '<em>null</em>',
		),

	'members lngfile 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'lngfile',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'lngfile',
			'SUB_PART' => '30',
		),

	'members memberGroup 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberGroup',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberGroup',
			'SUB_PART' => '30',
		),

	'members memberName 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'memberName',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'memberName',
			'SUB_PART' => '30',
		),

	'members posts 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_members',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posts',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posts',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MEMBER 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_MEMBER',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MEMBER',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_MSG 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_MSG',
			'SUB_PART' => '<em>null</em>',
		),

	'messages ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'ID_TOPIC',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),

	'messages posterTime 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_messages',
			'NON_UNIQUE' => '1',
			'INDEX_NAME' => 'posterTime',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'posterTime',
			'SUB_PART' => '<em>null</em>',
		),

	'polls ID_POLL 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_polls',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_POLL',
			'SUB_PART' => '<em>null</em>',
		),

	'settings variable 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_settings',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'variable',
			'SUB_PART' => '30',
		),

	'topics ID_TOPIC 0001' => Array
		(
			'TABLE_NAME' => 'yabbse_topics',
			'NON_UNIQUE' => '0',
			'INDEX_NAME' => 'PRIMARY',
			'SEQ_IN_INDEX' => '1',
			'COLUMN_NAME' => 'ID_TOPIC',
			'SUB_PART' => '<em>null</em>',
		),
);

$ui->addChunk('Settings File', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_type, $sourcedir;

	// First some settings file stuff...
	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type', 'db_character_set', 'db_mb4');

	$settings = array();
	$settings[0] = array('Variable','Value');
	foreach($dumpvars AS $var)
	{
		if (!isset($ui->getSettingsFile()[$var]))
			$value = '<strong>NOT SET</strong>';
		elseif (is_null($ui->getSettingsFile()[$var]))
			$value = '<em>null</em>';
		elseif ($ui->getSettingsFile()[$var] === false)
			$value = '<em>false</em>';
		elseif ($ui->getSettingsFile()[$var] === true)
			$value = '<em>true</em>';
		else
			$value = $ui->getSettingsFile()[$var];

		$settings[] = array($var, $value);
	}

	$ui->dumpTable($settings);

});

$ui->addChunk('Settings Table', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_prefix;

	$settings = array();
	$settings[0] = array('Variable','Value');

	$result = $smcFunc['db_query']('', '
		SELECT variable, value FROM {db_prefix}settings
		WHERE variable = {string:smf_ver}',
		array(
			'smf_ver' => 'smfVersion',
		)
	);

	while ($row = $smcFunc['db_fetch_assoc']($result))
	{
		if (is_null($row['value']))
			$row['value'] = '<em>null</em>';
		elseif ($row['value'] === false)
			$row['value'] = '<em>false</em>';
		elseif ($row['value'] === true)
			$row['value'] = '<em>true</em>';

		$settings[] = $row;

		// Set default based on what you found...
		// Note Yabbse didn't have this setting.
		if (substr($row['value'], 0, 3) === '1.0')
			$ui->smf_ver = '1.0';
		elseif (substr($row['value'], 0, 3) === '1.1')
			$ui->smf_ver = '1.1';
		elseif (substr($row['value'], 0, 3) === '2.0')
			$ui->smf_ver = '2.0';
		elseif (substr($row['value'], 0, 3) === '2.1')
			$ui->smf_ver = '2.1';
		
	}
	$ui->dumpTable($settings);
});

$ui->addChunk('Select SMF Version for Comparison', function() use ($ui)
{
	// Value selected?
	if (isset($_SESSION['ver']) && in_array($_SESSION['ver'], array('Yabbse', '1.0', '1.1', '2.0', '2.1')))
		$ui->smf_ver = $_SESSION['ver'];

	// Provide a default if none somehow found yet...
	if (empty($ui->smf_ver))
		$ui->smf_ver = '2.1';

	// Prompt for a change...
	echo '<form>';
	echo '<label for="ver">SMF Version:</label>
	<select name="ver">
		<option value="2.1"' . ($ui->smf_ver == '2.1' ? 'selected' : '') . '>2.1</option>
		<option value="2.0"' . ($ui->smf_ver == '2.0' ? 'selected' : '') . '>2.0</option>
		<option value="1.1"' . ($ui->smf_ver == '1.1' ? 'selected' : '') . '>1.1</option>
		<option value="1.0"' . ($ui->smf_ver == '1.0' ? 'selected' : '') . '>1.0</option>
		<option value="Yabbse"' . ($ui->smf_ver == 'Yabbse' ? 'selected' : '') . '>Yabbse</option>
	</select><br><br>';

	echo '<input type="submit" class="button" formmethod="post" value="Ok">';
	echo '</form>';
});

$ui->addChunk('Compare Tables - Current DB on Left, Vanilla SMF on Right', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_prefix, $smf_tables, $db_type;

	$ui->tables = array();

	// Ensure we are running mysql...
	if (!empty($db_type) && $db_type != 'mysql')
	{
		$ui->addError('This utility works for MySQL only.');
		return;
	}

	// Get them tables...
	$result = $smcFunc['db_query']('', '
		SHOW TABLE STATUS',
		array(
		)
	);

	while ($row = $smcFunc['db_fetch_assoc']($result))
		$ui->tables[substr($row['Name'], strlen($db_prefix))] = array('Name' => $row['Name'], 'Engine' => $row['Engine'], 'Collation' => $row['Collation']);

	compareArrays($ui->tables, $smf_tables[$ui->smf_ver], $ui);
});

$ui->addChunk('Compare Columns - Current DB on Left, Vanilla SMF on Right', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_prefix, $smf_columns, $db_type, $db_name;

	// Ensure we are running mysql...
	if (!empty($db_type) && $db_type != 'mysql')
		return;

	$columns = array();
	foreach ($ui->tables AS $table_name => $info)
	{
		$result = $smcFunc['db_query']('', '
			SELECT TABLE_NAME, COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, EXTRA, COLLATION_NAME
				FROM information_schema.COLUMNS
				WHERE TABLE_SCHEMA = {string:schema}
				AND TABLE_NAME = {string:table}',
			array(
				'schema' => $db_name,
				'table' => $db_prefix . $table_name,
			)
		);
		while ($row = $smcFunc['db_fetch_assoc']($result))
			$columns[substr($row['TABLE_NAME'], strlen($db_prefix)) . ' ' . $row['COLUMN_NAME']] = array('TABLE_NAME' => $row['TABLE_NAME'], 'COLUMN_NAME' => $row['COLUMN_NAME'], 'COLUMN_TYPE' => $row['COLUMN_TYPE'], 'IS_NULLABLE' => $row['IS_NULLABLE'], 'COLUMN_DEFAULT' => (is_null($row['COLUMN_DEFAULT']) ? '<em>null</em>' : $row['COLUMN_DEFAULT']), 'EXTRA' => $row['EXTRA'], 'COLLATION_NAME' => (is_null($row['COLLATION_NAME']) ? '<em>null</em>' : $row['COLLATION_NAME']));
	}
	compareArrays($columns, $smf_columns[$ui->smf_ver], $ui);
});

$ui->addChunk('Compare Indexes - Current DB on Left, Vanilla SMF on Right', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_prefix, $smf_indexes, $db_name, $db_type;

	// Ensure we are running mysql...
	if (!empty($db_type) && $db_type != 'mysql')
		return;

	$indexes = array();
	foreach ($ui->tables AS $table_name => $info)
	{
		// Find all indexes for that table...
		$table_indexes = array();
		$result = $smcFunc['db_query']('', '
			SELECT DISTINCT INDEX_NAME
				FROM information_schema.STATISTICS
				WHERE TABLE_SCHEMA = {string:schema}
				AND TABLE_NAME = {string:table}',
			array(
				'schema' => $db_name,
				'table' => $db_prefix . $table_name,
			)
		);
		while ($row = $smcFunc['db_fetch_assoc']($result))
			$table_indexes[] = $row['INDEX_NAME'];

		// Loop thru each index...
		// Note due to high # of index renames over time, use index signature (column list) to uniquely ID index,
		// not name, otherwise far too many exceptions...
		foreach ($table_indexes AS $index_name)
		{
			// Get the signature...
			$result = $smcFunc['db_query']('', '
				SELECT GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) AS signature
					FROM information_schema.STATISTICS
					WHERE TABLE_SCHEMA = {string:schema}
					AND TABLE_NAME = {string:table}
					AND INDEX_NAME = {string:index}',
				array(
					'schema' => $db_name,
					'table' => $db_prefix . $table_name,
					'index' => $index_name,
				)
			);
			$row = $smcFunc['db_fetch_assoc']($result);
			$signature = $row['signature'];

			// Now get the columns...
			$result = $smcFunc['db_query']('', '
				SELECT TABLE_NAME, NON_UNIQUE, INDEX_NAME, SEQ_IN_INDEX, COLUMN_NAME, SUB_PART
					FROM information_schema.STATISTICS
					WHERE TABLE_SCHEMA = {string:schema}
					AND TABLE_NAME = {string:table}
					AND INDEX_NAME = {string:index}',
				array(
					'schema' => $db_name,
					'table' => $db_prefix . $table_name,
					'index' => $index_name,
				)
			);
			while ($row = $smcFunc['db_fetch_assoc']($result))
				$indexes[substr($row['TABLE_NAME'], strlen($db_prefix)) . ' ' . $signature . ' ' . str_pad($row['SEQ_IN_INDEX'], 4, '0', STR_PAD_LEFT)] = array('TABLE_NAME' => $row['TABLE_NAME'], 'NON_UNIQUE' => $row['NON_UNIQUE'], 'INDEX_NAME' => $row['INDEX_NAME'], 'SEQ_IN_INDEX' => $row['SEQ_IN_INDEX'], 'COLUMN_NAME' => $row['COLUMN_NAME'], 'SUB_PART' => (is_null($row['SUB_PART']) ? '<em>null</em>' : $row['SUB_PART']));
		}
	}
	compareArrays($indexes, $smf_indexes[$ui->smf_ver], $ui);
});

$ui->go();

// Compare the two arrays, producing one large combined array with stuff lined up...
function compareArrays($left_arr, $right_arr, $ui)
{
	// First, sort 'em...
	ksort($left_arr, SORT_NATURAL | SORT_FLAG_CASE);
	ksort($right_arr, SORT_NATURAL | SORT_FLAG_CASE);

	$leftit = new ArrayIterator($left_arr);
	$rightit = new ArrayIterator($right_arr);

	// Let's start at the beginning, shall we...
	$leftit->rewind();
	$rightit->rewind();

	// Produce some headers...
	// Try to account for... Missing stuff...
	if ($leftit->valid())
		$leftcols = array_keys($leftit->current());
	else
		$leftcols = array_keys($rightit->current());

	if ($rightit->valid())
		$rightcols = array_keys($rightit->current());
	else
		$rightcols = array_keys($leftit->current());

	$header = array_merge($leftcols, $rightcols);

	// Setup table...
	echo '<br><div class="sui_table">';
	echo '<div class="sui_row_header">';
	echo '<div class="sui_cell">';
	echo implode('</div><div class="sui_cell">', $header);
	echo '</div></div>';

	// Now cycle thru both arrays lining stuff up...
	// Important these comparisons are all case insensitive due to variations over the years...
	while ($leftit->valid() || $rightit->valid())
	{
		// Only compare if both are valid...
		if ($leftit->valid() && $rightit->valid())
		{
			if (strcasecmp($leftit->key(), $rightit->key()) == 0)
			{
				compareRows($leftit->current(), $rightit->current());
				$leftit->next();
				$rightit->next();
			}
			elseif (strcasecmp($leftit->key(), $rightit->key()) < 0)
			{
				leftOnly($leftit->current());
				$leftit->next();
			}
			else
			{
				rightOnly($rightit->current());
				$rightit->next();
			}
		}
		// OK, one or the other is invalid...
		elseif ($rightit->valid() === false)
		{
			leftOnly($leftit->current());
			$leftit->next();
		}
		else
		{
			rightOnly($rightit->current());
			$rightit->next();
		}
	}

	// Wrap table...
	echo '</div><br>';
}

// Compare the two rows, producing one combined table row...
// Important these comparisons are all case insensitive due to variations over the years...
// Don't highlight table names - differences due to different prefixes.
function compareRows($left_row, $right_row)
{
	echo '<div class="sui_row">';

	foreach ($left_row AS $key => $value)
	{
		if ((strcasecmp($right_row[$key], $value) == 0) || in_array($key, array('Name', 'TABLE_NAME')))
			echo '<div class="sui_cell">' . $value . '</div>';
		else
			echo '<div class="sui_cell_yellow">' . $value . '</div>';
	}

	foreach ($right_row AS $key => $value)
	{
		if ((strcasecmp($left_row[$key], $value) == 0) || in_array($key, array('Name', 'TABLE_NAME')))
			echo '<div class="sui_cell">' . $value . '</div>';
		else
			echo '<div class="sui_cell_yellow">' . $value . '</div>';
	}

	echo '</div>';
}

// Only got the left...
function leftOnly($left_row)
{
	echo '<div class="sui_row_green">';
	echo '<div class="sui_cell">';

	$left = array_values($left_row);
	$right = array_fill(0, count($left), '');
	$return_array = array_merge($left, $right);
	echo implode('</div><div class="sui_cell">', $return_array);

	echo '</div></div>';
}

// Only got the right...
function rightOnly($right_row)
{
	echo '<div class="sui_row_red">';
	echo '<div class="sui_cell">';

	$right = array_values($right_row);
	$left = array_fill(0, count($right), '');
	$return_array = array_merge($left, $right);
	echo implode('</div><div class="sui_cell">', $return_array);

	echo '</div></div>';
}

/**
 * SimpleSmfUI
 *
 * A simple basic abstracted UI for utilities.
 *
 * Copyright 2021 Shawn Bulen
 *
 * This file is part of the sjrbTools library.
 *
 * SimpleSmfUI is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SimpleSmfUI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SimpleSmfUI.  If not, see <https://www.gnu.org/licenses/>.
 *
 */

class SimpleSmfUI
{
	/*
	 * Properties
	 */
	protected $site_title = 'Simple UI';
	protected $max_width = 1200;
	protected $db_needed;
	protected $txt = array(
		'err_no_title' => 'Site title is required and must be a string!',
		'err_width' => 'Funky width specified!',
		'err_no_settings' => 'Could not find Settings.php!  Place this file in the same folder as Settings.php.',
		'err_no_db' => 'Could not establish connection with the database!',
		'err_no_chunk_title' => 'Invalid chunk title!',
		'err_no_chunk_func' => 'Invalid chunk function!',
		'errors' => 'Errors',
	);
	protected $chunks = array();
	protected $errors = array();

	/*
	 * SMF Properties
	 */
	protected $settings_file;

	/**
	 * Constructor
	 *
	 * Builds a SimpleSmfUI object
	 *
	 * @param string title
	 * @param bool db_needed
	 * @return void
	 */
	function __construct($title, $db_needed = null, $max_width = 800)
	{
		// Might as well try...
		@set_time_limit(6000);
		@ini_set('memory_limit', '512M');

		// Title...
		if (is_string($title))
			$this->site_title = $title;
		else
			$this->addError('err_no_title');

		// db_needed...
		if (empty($db_needed))
			$this->db_needed = false;
		else
			$this->db_needed = true;

		// Width...
		if (is_numeric($max_width))
			$this->max_width = $max_width;
		else
			$this->addError('err_width');

		// Error handler
		set_error_handler(
			function($errno, $errstr, $errfile, $errline)
			{
				$this->addError($errstr . ' (' . $errno . ')');
				return true;
			}
		);

		// DB...
		define('SMF', 1);
		define('SMF_VERSION', '2.x');
		define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
		define('SMF_SOFTWARE_YEAR', '2021');

		define('POSTGRE_TITLE', 'PostgreSQL');
		define('MYSQL_TITLE', 'MySQL');
		define('SMF_USER_AGENT', 'Mozilla/5.0 (' . php_uname('s') . ' ' . php_uname('m') . ') AppleWebKit/605.1.15 (KHTML, like Gecko)  SMF/' . strtr(SMF_VERSION, ' ', '.'));

		// These must remain globals when calling SMF funcs...
		global $smcFunc, $db_connection, $db_prefix, $db_name, $db_type, $sourcedir, $cachedir;
		$smcFunc = array();
		$this->settings_file = array();

		if ($this->db_needed)
		{
			// Load & save off settings file contents
			if (file_exists('Settings.php'))
			{
				include_once('Settings.php');
				$dumpvars = array('mbname', 'db_server', 'db_name', 'db_prefix', 'db_type', 'db_character_set', 'db_mb4', 'language',
					'boardurl', 'boarddir', 'sourcedir', 'packagesdir', 'tasksdir', 'cachedir',
					'maintenance', 'mtitle', 'mmessage',
					'cookiename', 'db_persist', 'db_error_send',
					'cache_accelerator', 'cache_enable', 'cache_memcached',
					'image_proxy_enabled', 'image_proxy_secret', 'image_proxy_maxsize');

				foreach($dumpvars as $setting)
					$this->settings_file[$setting] = (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>');
			}
			else
				$this->addError('err_no_settings');

			if (!empty($sourcedir))
			{
				// Get the database going!
				if (empty($db_type) || $db_type == 'mysqli')
					$db_type = 'mysql';

				// Make the connection...
				require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
				$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

				if (empty($db_connection))
					$this->addError('err_no_db');
			}
		}
	}

	/**
	 * Render chunk
	 *
	 * Display one portion of the form
	 *
	 * @return void
	 */
	protected function doChunk($ix, $chunk)
	{
		echo '<section>';	// sections needed to narrow scope of expand/collapse action
		echo '<input type="checkbox" name="collapse" checked id="chunk' . $ix . '">
			<div class="chunkhdr">
				<label for="chunk' . $ix . '">' . $chunk['title'] . '</label>
			</div>
			<div class="content_nopad">
			<div class="content">';

		$chunk['function']();

		echo '</div></div>';
		echo '</section>';
	}

	/**
	 * Display errors
	 *
	 * Display errors in current display area
	 *
	 * @return void
	 */
	protected function renderErrors()
	{
		echo '<div id="errhdr">' . $this->txt['errors'] . '</div>
			<div class="content_nopad">
			<div class="content">';

		foreach ($this->errors AS $error)
			echo $error . '<br>';

		echo '</div></div>';
	}

	/**
	 * Render header
	 *
	 * Spits out the head, title, style & starts the body
	 *
	 * @return void
	 */
	protected function renderHeader()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<meta charset="utf-8">
		<title>' . $this->site_title . '</title>
		<style type="text/css">
			body
			{
				padding: 12px 0px 0px 0px;
				font-family: "Roboto", sans-serif;
				background-color: rgb(242,242,242);
				max-width: ' . $this->max_width . 'px;
				margin: 0 auto;
				box-shadow: 2px 2px 2px 2px rgb(220,220,220);
				border-bottom: 1px solid rgb(170,170,170);
			}

			#header
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(54,126,189);
				font-family: "Roboto", sans-serif;
				font-size: x-large;
				height: 30px;
				vertical-align: middle;
				text-align:center;
				border-bottom: 1px solid rgb(58,123,155);
			}

			.content_nopad
			{
				background: linear-gradient(180deg, rgb(190,190,190) 0%, rgb(252,252,252) 5px);
			}

			.content
			{
				padding: 10px 10px 10px 10px;
				font-size: small;
			}

			#nametag
			{
				font-family: "Roboto", sans-serif;
				font-size: smaller;
				color: rgb(122,132,134);
				background-color: rgb(252,252,252);
				text-align: right;
			}

			.chunkhdr
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(0,153,204);
				font-family: "Roboto", sans-serif;
				font-size: large;
				height: 25px;
				vertical-align: middle;
				text-align:center;
				border-bottom: 1px solid rgb(89,154,187);
			}

			.chunkhdr label
			{
				display: inline-block;
				width: 100%;
			}

			.chunkhdr:hover,
			.chunkhdr:focus
			{
				background: rgb(76,175,208);
			}

			input[name="collapse"]:not(:checked) ~ .content_nopad
			{
				display: none;
			}

			input[name="collapse"]
			{
				display: none;
			}

			.chunkhdr label:before {
				content: "▲";
				display: inline-block;
				float: left;
				vertical-align: middle;
				color: rgb(54,126,189);
			}

			input[name="collapse"]:not(:checked) ~ .chunkhdr label:before
			{
				transform: rotate(180deg);
				transform-origin: center;
			}

			#errhdr
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(230,130,130);
				font-family: "Roboto", sans-serif;
				font-size: large;
				height: 25px;
				vertical-align: middle;
				text-align:center;
			}

			input[type=text], select
			{
				width: 85%;
				height: 25px;
				margin: 4px 0px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			.button
			{
				padding: 1px 1px;
				text-align: center;
				width: 100px;
				box-shadow: 1px 1px 1px 1px rgb(210,210,210);
			}

			.sui_table
			{
				display: table;
				table-layout:fixed;
				border-collapse: collapse;
				border-spacing: 0;
				padding: 0px;
				border: 1px solid #ccc;
				text-align: left;
				vertical-align: top;
				white-space: normal;
				word-break: break-word;
				font-weight: normal;
				font-variant: normal;
				color: inherit;
			}

			.sui_row
			{
				display: table-row;
			}

			.sui_row_red
			{
				display: table-row;
				background-color: rgb(230,130,130);
			}

			.sui_row_green
			{
				display: table-row;
				background-color: #42ddcf;
			}

			.sui_row_header
			{
				display: table-header-group;
				font-weight: bold;
				color: rgb(46,96,140);
			}

			.sui_cell
			{
				border: 1px solid #ccc;
				display: table-cell;
				padding: 2px;
				min-width: 80px;
				max-width: 750px;
			}

			.sui_cell_yellow
			{
				border: 1px solid #ccc;
				display: table-cell;
				padding: 2px;
				min-width: 80px;
				max-width: 750px;
				background-color: #f7f793;
			}
		</style>
		</head>
		<body>
		<div id="header">' . $this->site_title . '
		</div>';
	}

	/**
	 * Render header
	 *
	 * Closes out the body & html tags
	 *
	 * @return void
	 */
	protected function renderFooter()
	{
		// Close out body & html tags
		echo '<div id="nametag">sbulen/sjrbTools</div>';
		echo '</body>
		</html>';
	}

	/**
	 * Cleanse text
	 *
	 * Some basic hygiene for user-entered input
	 *
	 * @param string input
	 * @param bool gtlt - whether to leave > and < alone (e.g., for queries)
	 * @return string cleansed
	 */
	public function cleanseText($input, $gtlt = false)
	{
		$input = trim($input);
		$input = htmlspecialchars($input);
		if ($gtlt)
		{
			$input = str_replace('&gt;', '>', $input);
			$input = str_replace('&amp;gt;', '>', $input);
			$input = str_replace('&lt;', '<', $input);
			$input = str_replace('&amp;lt;', '<', $input);
		}
		return $input;
	}

	/**
	 * Dump table
	 *
	 * Render a simple 2-d array in table form
	 *
	 * @param array passed_array
	 * @return void
	 */
	public function dumpTable($passed_array)
	{
		static $special_cells = array('<strong>NOT SET</strong>', '<em>null</em>', '<em>true</em>', '<em>false</em>');

		$header = true;
		echo '<br><div class="sui_table">';
		foreach($passed_array as $row)
		{
			// Some cleansing...
			foreach ($row AS $ix => $cell)
			{
				// Treat NOT SET, null, true, & false special...
				if (in_array($cell, $special_cells))
					$row[$ix] = $cell;
				else
				{
					$row[$ix] = htmlspecialchars($cell);
					// Undo any line breaks you just broke...
					$row[$ix] = str_replace('&lt;br&gt;', '<br>', $row[$ix]); 
					$row[$ix] = str_replace('&lt;br /&gt;', '<br>', $row[$ix]); 
				}
			}
			if ($header)
				echo '<div class="sui_row_header">';
			else
				echo '<div class="sui_row">';
			echo '<div class="sui_cell">';
			echo implode('</div><div class="sui_cell">', $row);
			echo '</div></div>';
			$header = false;
		}
		echo '</div><br>';
	}

	/**
	 * Add Chunk
	 *
	 * Adds an entry to the internal chunk array.
	 * Each chunk will display a header, do some logic, & display some content.
	 * If errors are encountered, ideally they should be added to the errors display and displayed at the end.
	 *
	 * @param string title - title to display above this chunk
	 * @param function logic - what to execute, passed as an anonymous function
	 * @return void
	 */
	public function addChunk($title, $func)
	{
		if (!is_string($title))
		{
			$title = '';
			$this->addError('err_no_chunk_title');
		}

		if (!is_callable($func))
		{
			$func = function() {};
			$this->addError('err_no_chunk_func');
		}

		$this->chunks[] = array('title' => $title, 'function' => $func);
	}

	/**
	 * Get Settings File contents
	 *
	 * @return array
	 */
	public function getSettingsFile()
	{
		return $this->settings_file;
	}

	/**
	 * Add Error
	 *
	 * Add error to internal log
	 *
	 * @param string key - is key to $txt array
	 * @param string more - is additional info to be added to output string if needed
	 * @return void
	 */
	public function addError($key, $more = '')
	{
		if (!is_string($key))
			$key = '';

		if (!is_string($more))
			$more = '';

		if (!empty($this->txt[$key]))
			$key = $this->txt[$key];

		$this->errors[] = $key . ' ' . $more;
	}

	/**
	 * Go
	 *
	 * Got everything, now do it...
	 *
	 * @return void
	 */
	public function go()
	{
		global $db_connection;

		// Responding to a POST? Cleanse info, put in session and redirect
		session_start();
		if ($_POST)
		{
			$_SESSION = array();
			foreach($_POST as $var => $val)
				$_SESSION[$this->cleanseText($var)] = $this->cleanseText($val);
			
		   // Redirect to this page
		   header("Location: {$_SERVER['REQUEST_URI']}", true, 302);
		   exit();
		}

		// OK, display stuff...
		$this->renderHeader();

		// Execute the chunks...
		// Note if db_needed & no connection, do not process chunks, just display the errors
		if (!$this->db_needed || ($this->db_needed && !empty($db_connection)))
		{
			foreach($this->chunks AS $ix => $chunk)
				$this->doChunk($ix, $chunk);
		}

		// Display any errors...
		if (!empty($this->errors))
			$this->renderErrors();

		$this->renderFooter();

		// Ensure refreshes actually refresh!
		$_SESSION = array();
	}
}
