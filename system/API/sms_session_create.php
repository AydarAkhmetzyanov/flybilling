<?php

//http://flybilling.azurewebsites.net/system/API/sms_session_create.php?service_ID=2&hash=01044cfd18dd5c0cde26733c11a3b542&service_number=4443&phone=79510665133&text=1234

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS . '..' );
require_once (ROOT . DS . 'core' . DS . 'core.php');

$sms = new SMS_session_create;
$sms->processSessionCreate();
