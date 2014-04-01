<?php

define ('DEVELOPMENT_ENVIRONMENT',getenv('DEVELOPMENT_ENVIRONMENT'));

if(DEVELOPMENT_ENVIRONMENT==true){
    error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );   
} else {
    error_reporting(0); ini_set('display_errors', 'Off'); error_reporting( E_ERROR );
}


define('EMPTY_RECIEVER_TEXT','Thanks for SMS');


define('pl3_pseudo_async_ru',getenv('pl3_pseudo_async_ru'));
define('pl3_pseudo_async_ru_mts',getenv('pl3_pseudo_async_ru_mts'));

define('SCHEMA',getenv('SCHEMA'));
define('DEFAULT_SHARE',getenv('DEFAULT_SHARE'));
define('API_URL',getenv('API_URL'));
define('SITE',getenv('SITE'));
define('BRAND',getenv('BRAND'));
define('SHORT_BRAND',getenv('SHORT_BRAND'));
define('EMAIL',getenv('EMAIL'));
define('ADMIN_LOGIN','Admin');
define('SECRET','d785c99d298a4e9e6e13fe99e602ef42');
