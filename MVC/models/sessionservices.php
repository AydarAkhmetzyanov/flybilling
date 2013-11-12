<?php

class SessionServices extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(hour,$data[timezone],CAST([timestamp] AS datetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[SessionServices] WHERE 1=1 ";
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
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
