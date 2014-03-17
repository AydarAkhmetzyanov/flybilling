<?php

class SMSProviders extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        $tsql.=" FROM ".SCHEMA.".[SMSProviders] WHERE 1=1 ";
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
        if(isset($data['code'])){
            $tsql.=' AND [code]=:code';
            $params['code']=$data['code'];
        }
        $tsql.=' ORDER BY [ID] DESC ';
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($params);
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
        }
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            return $row;
        } else {
            return FALSE;
        }
	}

}
