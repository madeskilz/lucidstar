<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-07 08:44:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) C:\wamp64\www\lucidstar\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2019-11-07 08:44:09 --> Unable to connect to the database
ERROR - 2019-11-07 08:45:05 --> Query error: Table 'lucidstar.ci_session' doesn't exist - Invalid query: SELECT 1
FROM `ci_session`
WHERE `id` = 'npjlldvuleibt628se3ujvs4q744kjch'
ERROR - 2019-11-07 15:36:11 --> Query error: Table 'lucidstar.ci_session' doesn't exist - Invalid query: SELECT `data`
FROM `ci_session`
WHERE `id` = 'h8t4j1nsn3q4ikfsp235ht0bt94c6lai'
ERROR - 2019-11-07 15:36:11 --> Severity: Warning --> session_write_close(): Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2019-11-07 15:36:11 --> Severity: Warning --> session_write_close(): Failed to write session data using user defined save handler. (session.save_path: c:/wamp64/tmp) Unknown 0
ERROR - 2019-11-07 15:36:18 --> Query error: Table 'lucidstar.ci_session' doesn't exist - Invalid query: SELECT 1
FROM `ci_session`
WHERE `id` = 'h8t4j1nsn3q4ikfsp235ht0bt94c6lai'
