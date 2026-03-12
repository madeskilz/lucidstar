-- Migration: Add soft-delete columns to support server-side undo
-- Date: 2026-02-04
-- Adds `is_deleted` (TINYINT) and `deleted_at` (DATETIME NULL) columns if they do not already exist.

-- Note: uses MySQL 8+ `ADD COLUMN IF NOT EXISTS`. If your MySQL is older, run each ALTER TABLE manually after inspecting.

ALTER TABLE `news`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

ALTER TABLE `gallery`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

ALTER TABLE `gallery_tags`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

ALTER TABLE `media`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

ALTER TABLE `ctas`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

ALTER TABLE `slides`
  ADD COLUMN IF NOT EXISTS `is_deleted` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `deleted_at` DATETIME NULL;

-- You can run this file using the mysql client, for example:
-- mysql -u root -p lucidstar < db_migrations/20260204_add_soft_delete_columns.sql

-- If `ADD COLUMN IF NOT EXISTS` is not supported on your MySQL, run the following per table after verifying:
-- ALTER TABLE `news` ADD COLUMN `is_deleted` TINYINT(1) NOT NULL DEFAULT 0;
-- ALTER TABLE `news` ADD COLUMN `deleted_at` DATETIME NULL;

```