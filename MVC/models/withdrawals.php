<?php

class Withdrawals extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[Withdrawals] WHERE 1=1 ";
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
        if(isset($data['client_ID'])){
            $tsql.=' AND [client_ID]=:client_ID';
            $params['client_ID']=$data['client_ID'];
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

    public static function insert($data){
        if($data['summ']<1){ API_helper::failResponse('minimum transation is 1',400); exit(); } 
        if(!is_numeric($data['summ'])){ API_helper::failResponse('summ should be numeric',400); exit(); } 
        if(Clients::getInstance()->data['balance']<$data['summ']){ API_helper::failResponse('balance lower then required summ',406); exit(); } 
        try{
            Database::getInstance()->beginTransaction();
            $tsql="UPDATE ".SCHEMA.".[Clients] SET [balance]=[balance] - :summ WHERE [ID]=:client_ID ;";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'summ'=>$data['summ'], 'client_ID'=>Clients::getInstance()->data['ID'] );
            $statement->execute($params);
            $tsql="
                INSERT INTO ".SCHEMA.".[Withdrawals]
                (summ,client_ID,status) 
                VALUES (:summ,:client_ID,0);
            ";
            $statement = Database::getInstance()->prepare($tsql);
            $statement->execute($params);
            $ID = Database::getInstance()->lastInsertId();
            Database::getInstance()->commit();
            return $ID;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
	}
}
