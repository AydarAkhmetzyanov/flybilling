<?php

define ('DEVELOPMENT_ENVIRONMENT',getenv('DEVELOPMENT_ENVIRONMENT'));

if(DEVELOPMENT_ENVIRONMENT==true){
    error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );   
} else {
    error_reporting(0); ini_set('display_errors', 'Off'); error_reporting( E_ERROR );
}

define('API_URL',getenv('API_URL'));

define('SCHEMA',getenv('SCHEMA'));

define('EMPTY_RECIEVER_TEXT','Thanks for SMS');
