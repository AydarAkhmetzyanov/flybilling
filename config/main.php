<?php

//error_reporting(0); ini_set('display_errors', 'Off'); error_reporting( E_ERROR );
error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );    

session_start();
header("Content-type: text/html; charset=utf-8");

define ('DEVELOPMENT_ENVIRONMENT',true);
define ('DEFAULT_CONTROLLER_PATH','index');
define ('DEFAULT_SECONDARY_CONTROLLER_NAME','index');
define ('DEFAULT_LANGUAGE','ru');

define('SCHEMA','[dbo]');
print_r($_ENV);
define('DEFAULT_SHARE',75);
