<?php

require_once ('config.php');

require_once ('autoloader.class.php');

spl_autoload_register(array('Autoloader', 'loadDomainObject'));
spl_autoload_register(array('Autoloader', 'loadCoreObject'));
