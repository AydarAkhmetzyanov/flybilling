<?php

//localhost:64449/system/WORKERS/sms_async_send.php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS . '..' );
require_once (ROOT . DS . 'core' . DS . 'core.php');

$sms = new SMS_session_create;
$sms->processSessionCreate();
