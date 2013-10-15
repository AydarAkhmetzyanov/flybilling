<?php

class Autoloader
{
    public static function loadDomainObject($className)
    {
        if (file_exists(ROOT . DS . 'core' . DS . 'objects' . DS . strtolower($className) . '.class.php')) {
		    require_once(ROOT . DS . 'core' . DS . 'objects' . DS . strtolower($className) . '.class.php');
		}
    }

    public static function loadCoreObject($className)
    {
        if (file_exists(ROOT . DS . 'core' . DS . strtolower($className) . '.class.php')) {
		    require_once(ROOT . DS . 'core' . DS . strtolower($className) . '.class.php');
		}
    }
	
}
