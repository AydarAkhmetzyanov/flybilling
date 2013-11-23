<?php

session_start();
header("Content-type: text/html; charset=utf-8");

define ('DEVELOPMENT_ENVIRONMENT',true);

if(DEVELOPMENT_ENVIRONMENT==true){
    error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );   
} else {
    error_reporting(0); ini_set('display_errors', 'Off'); error_reporting( E_ERROR );
}

define ('DEFAULT_CONTROLLER_PATH','index');
define ('DEFAULT_SECONDARY_CONTROLLER_NAME','index');
define ('DEFAULT_LANGUAGE','ru');

define('SCHEMA','[dbo]');
define('DEFAULT_SHARE',75);

print_r($_ENV);

print_r(getenv('SCHEMA'));
