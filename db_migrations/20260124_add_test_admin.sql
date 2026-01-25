-- Add a test admin user if one does not exist already
INSERT INTO `users` (`username`,`email`,`password`,`level`,`active`,`date_created`)
SELECT 'testadmin','testadmin@example.com','5f4dcc3b5aa765d61d8327deb882cf99',1,1,NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `users` WHERE `username` = 'testadmin');

-- Notes:
-- Password is MD5 of 'password' (5f4dcc3b5aa765d61d8327deb882cf99).
