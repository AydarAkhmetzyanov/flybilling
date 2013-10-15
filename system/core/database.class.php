<?php

class Database{

    private static $instance = NULL;
    private function __construct() {}
    private function __clone(){}
    public static function getInstance() {
        if (!self::$instance){
            try {
                self::$instance = new PDO ( "sqlsrv:server = tcp:g25tmfm7rt.database.windows.net,1433; Database = dev", "flybilling", "CXquWUMa!");
                self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO::ATTR_PERSISTENT 
            } catch ( PDOException $e ) {  
                print( "Error connecting to SQL Server." );  
                die(print_r($e));
            }
        }
        return self::$instance;
    }

}