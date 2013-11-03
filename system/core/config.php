<?php

//error_reporting(0); ini_set('display_errors', 'Off'); error_reporting( E_ERROR );
error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );

define('API_URL','http://localhost:64449');
//define('API_URL','http://flybilling.azurewebsites.net');

define('SCHEMA','[dbo]');

define('EMPTY_RECIEVER_TEXT','Thanks for SMS');
