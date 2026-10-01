CREATE TABLE IF NOT EXISTS `jantri_schedule_runs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cycle_date` date NOT NULL,
  `base_shift_id` int(11) NOT NULL,
  `user_shift_timing_id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `scheduled_time` time NOT NULL,
  `status` enum('running','success','failed') NOT NULL DEFAULT 'running',
  `transaction_id` int(11) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_jantri_schedule_run` (`cycle_date`,`base_shift_id`,`user_shift_timing_id`,`master_id`),
  KEY `idx_jantri_schedule_runs_status` (`status`),
  KEY `idx_jantri_schedule_runs_master` (`master_id`),
  KEY `idx_jantri_schedule_runs_timing` (`user_shift_timing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tbl_shift`
  ADD INDEX `idx_tbl_shift_schedule_time` (`id`, `is_active`, `super_admin`);

ALTER TABLE `user_shift_timings`
  ADD INDEX `idx_user_shift_schedule_lookup` (`shift_id`, `updated_by`, `open_date`, `is_active`);
