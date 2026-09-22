ALTER TABLE `tbl_ledger`
  ADD COLUMN `helpline_number` VARCHAR(10) NULL DEFAULT NULL AFTER `mobile`;

-- If the earlier draft with helpline_type was already applied, run these cleanup statements instead:
-- ALTER TABLE `tbl_ledger` MODIFY COLUMN `helpline_number` VARCHAR(10) NULL DEFAULT NULL;
-- ALTER TABLE `tbl_ledger` DROP COLUMN `helpline_type`;
