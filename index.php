<?php

//enviroment init
function timeMeasure()
{
    list($msec, $sec) = explode(chr(32), microtime());
    return ($sec+$msec);
}
define('TIMESTART', timeMeasure());

function getAppDir(){
$nurl = $_SERVER['PHP_SELF'];
$nurl = str_replace('index.php', '', $nurl);
return $nurl;
}

function getAppURLDir(){
    if((empty($_SERVER["HTTPS"])) or ($_SERVER["HTTPS"]=='off')) {
        $nurl = 'http://' . $_SERVER['HTTP_HOST'] . getAppDir();
		return $nurl;
    } else {
        $nurl = 'https://' . $_SERVER['HTTP_HOST'] . getAppDir();	    
		return $nurl;
    } 
}

define('APPDIR', getAppURLDir());
define('APPURLDIR', getAppURLDir());
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)));

//configs
require_once (ROOT . DS . 'config' . DS . 'main.php');
require_once (ROOT . DS . 'config' . DS . 'db.php');

//language
global $language;
if(isset($_COOKIE['language'])){
    $language = $_COOKIE['language'];
} else {
    $language = DEFAULT_LANGUAGE;
    setcookie("language", $language, time() + 60*60*24*30*12);
}
require_once (ROOT . DS . 'config' . DS . 'lang' . DS . $language . '.php');

//main classes
require_once (ROOT . DS . 'core' . DS . 'autoloader.class.php');
require_once (ROOT . DS . 'core' . DS . 'controller.class.php');
require_once (ROOT . DS . 'core' . DS . 'model.class.php');
require_once (ROOT . DS . 'core' . DS . 'functions.php');

//autoload init
spl_autoload_register(array('Autoloader', 'loadLibrary'));
spl_autoload_register(array('Autoloader', 'loadModel'));

//bootstrap
route();

//echo '<!--'.round(timeMeasure()-TIMESTART, 6).' sec. -->';