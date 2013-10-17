<?php

class HTML
{

    public static function includeJS($fileName) {
        if(file_exists(ROOT. DS .'js/'. DS .$fileName.'.js')){
			$data = '<script src="'. APPDIR .'js/'.$fileName.'.js"></script>';
			return $data;
        } else {
            throw new Exception('JS not found, path: '. ROOT. DS .'js'. DS .$fileName.'.js');
        }
	}

	public static function includeCSS($fileName) {
        if(file_exists(ROOT. DS .'css'. DS .$fileName.'.css')){
			$data = '<link href="'. APPDIR .'css/'.$fileName.'.css" rel="stylesheet">';
			return $data;
        } else {
        	throw new Exception('CSS not found, path: '. ROOT. DS .'css'. DS .$fileName.'.css');
        }
	}
	
	public static function getString($stringName) {
        global $language;
        global $languageString;
        if(isset($languageString[$stringName])){
            return $languageString[$stringName];
        } else {
            return $stringName;
        }
	}
	
    public static function echoString($stringName) {
        global $language;
        global $languageString;
        if(isset($languageString[$stringName])){
            echo $languageString[$stringName];
            return true;
        } else {
            echo $stringName;
            return false;
        }
	}
	
	public static function setUserLanguage($lang) {
        setcookie("language", $lang, time() + 60*60*24*30*12);
	}
	
}
