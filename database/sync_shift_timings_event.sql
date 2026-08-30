-- Optional MariaDB/MySQL event for daily shift timing synchronization.
-- Review and run only after taking a database backup.
-- The event scheduler must be enabled:
--   SET GLOBAL event_scheduler = ON;

DELIMITER //

CREATE EVENT IF NOT EXISTS ev_sync_shift_timings_daily
ON SCHEDULE EVERY 1 DAY
STARTS (TIMESTAMP(CURRENT_DATE, '12:00:00') + INTERVAL (CURRENT_TIME >= '12:00:00') DAY)
DO
BEGIN
    DECLARE target_date DATE;
    SET target_date = CURRENT_DATE;

    UPDATE user_shift_timings AS target
    JOIN tbl_ledger AS masters
      ON masters.id = target.updated_by
     AND masters.is_master = '1'
     AND masters.status = 1
    JOIN tbl_shift AS shifts
      ON shifts.id = target.shift_id
     AND shifts.updated_by = '1'
     AND shifts.is_active = 1
    SET
        target.master_id = masters.id,
        target.master = shifts.super_admin,
        target.app_time = COALESCE(shifts.app_time, ''),
        target.data_entry_operator = COALESCE(shifts.data_entry_operator, ''),
        target.is_active = shifts.is_active
    WHERE target.open_date = CASE
            WHEN LOWER(TRIM(shifts.shift_name)) = 'disawer' THEN DATE_ADD(target_date, INTERVAL 1 DAY)
            ELSE target_date
        END;
END//

DELIMITER ;
