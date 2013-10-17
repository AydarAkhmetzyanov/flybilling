<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS . '..' );
require_once (ROOT . DS . 'core' . DS . 'core.php');

echo md5('21234');