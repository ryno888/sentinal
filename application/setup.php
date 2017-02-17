<?php

/**
 * Setup file
 */

//general

defined('CI_BASE_URL')          OR define('CI_BASE_URL', "http://localhost/sentinal/"); 
defined('CI_NAME')              OR define('CI_NAME', "Codeigniter"); 

//site db
defined('DB_DATABASE')          OR define('DB_DATABASE', "loc_printq"); 
defined('DB_HOST_NAME')         OR define('DB_HOST_NAME', "localhost"); 
defined('DB_USERNAME')          OR define('DB_USERNAME', "root"); 
defined('DB_PASSWORD')          OR define('DB_PASSWORD', "root"); 
defined('DB_PORT')              OR define('DB_PORT', "3306"); 

//email
defined('EMAIL_PROTOCOL')       OR define('EMAIL_PROTOCOL', "smtp"); 
defined('EMAIL_HOST')           OR define('EMAIL_HOST', "ssl://smtp.gmail.com"); 
defined('EMAIL_PORT')           OR define('EMAIL_PORT', "465"); 
defined('EMAIL_USERNAME')       OR define('EMAIL_USERNAME', "ryno888@gmail.com"); 
defined('EMAIL_PASSWORD')       OR define('EMAIL_PASSWORD', "083229Ryno"); 
defined('EMAIL_ADDRESS')        OR define('EMAIL_ADDRESS', "ryno888@gmail.com"); 

//formatting
defined('CI_DATETIME')          OR define('CI_DATETIME', "Y-m-d H:i:s");
defined('CI_DATE')              OR define('CI_DATE', "Y-m-d");
defined('CI_DATE')              OR define('CI_DATE', "H:i:s");