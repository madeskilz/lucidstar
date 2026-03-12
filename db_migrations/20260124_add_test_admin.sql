-- Add a test admin user if one does not exist already
INSERT INTO `users` (`username`,`email`,`password`,`level`,`active`,`date_created`)
SELECT 'testadmin','testadmin@example.com','$2y$10$Lz1BUZvHSuOtX66MU3sPzuFJv6f74BXkK4lpvdRdkay1uV1I9P8ee',1,1,NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `users` WHERE `username` = 'testadmin');

-- Notes:
-- Password is a bcrypt `password_hash()` of 'password'. To regenerate locally:
-- php -r 'echo password_hash("password", PASSWORD_DEFAULT)."\n";'
