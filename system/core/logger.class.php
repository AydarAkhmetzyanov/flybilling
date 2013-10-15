<?php

class Logger
{

    public static function logError($msg) {
        try{
            $tsql="INSERT INTO ".SCHEMA.".[ErrorLog] (msg,url,is_warning,timestamp) VALUES (:msg,:url,0,GETUTCDATE())";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'msg'=>$msg, 'url'=>$_SERVER['REQUEST_URI'] );
            $statement->execute($params);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function logWarning($msg) {
        try{
            $tsql="INSERT INTO ".SCHEMA.".[ErrorLog] (msg,url,is_warning,timestamp) VALUES (:msg,:url,1,GETUTCDATE())";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'msg'=>$msg, 'url'=>$_SERVER['REQUEST_URI'] );
            $statement->execute($params);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}

