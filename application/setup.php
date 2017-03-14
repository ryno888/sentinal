<?php

/**
 * Setup file
 */

//general

defined('CI_BASE_URL')          OR define('CI_BASE_URL', "http://sentinal.local/"); 
defined('CI_NAME')              OR define('CI_NAME', "Sentinal"); 
defined('CI_ENCRYPT_KEY')       OR define('CI_ENCRYPT_KEY', "locSentinalKey"); 

//site db
defined('DB_DATABASE')          OR define('DB_DATABASE', "loc_sentinal"); 
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
defined('CI_DATE')              OR define('CI_TIME', "H:i:s");

//facebook api
if (!defined('CR_FACEBOOK_ID'))         { define('CR_FACEBOOK_ID', "145737412583580"); }
if (!defined('CR_FACEBOOK_SECRET'))     { define('CR_FACEBOOK_SECRET', "1498be992f38d36e181dba78283743d4"); }

//meta
defined('CI_META_DESCRIPTION')  OR define('CI_META_DESCRIPTION', "Modified System Structure in Codeigniter");
defined('CI_META_KEYWORDS')     OR define('CI_META_KEYWORDS', "System, Codeigniter, application");
defined('CI_META_AUTHOR')       OR define('CI_META_AUTHOR', "Ryno van Zyl");
defined('CI_META_ROBOTS')       OR define('CI_META_ROBOTS', "no-cache");
defined('CI_META_VIEWPORT')     OR define('CI_META_VIEWPORT', "width=device-width, initial-scale=1.0");
