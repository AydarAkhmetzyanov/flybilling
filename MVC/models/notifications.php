<?php

class Notifications extends Model
{

    public static function get($data){
        if(isset($data['mark_read']) and $data['mark_read']==true and isset($data['client_ID'])){
            $params['client_ID']=$data['client_ID'];
            $tsql="UPDATE ".SCHEMA.".[Notifications] 
            SET [status]=1
            WHERE [client_ID]=:client_ID ";
            if(isset($data['ID'])){
                $tsql.=' AND [ID]=:ID';
                $params['ID']=$data['ID'];
            }
            $tsql.=';';
            $statement = Database::getInstance()->prepare($tsql);
            try{
                $statement->execute($params);
            } catch(PDOException $e) {
                API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
                return FALSE;
            }
        } 
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[Notifications] WHERE 1=1 ";
        $tsql.=' AND [notification_ID] IS NULL ';
        if(isset($data['client_ID'])){
            $tsql.=' AND [client_ID]=:client_ID';
            $params['client_ID']=$data['client_ID'];
        }
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
        $tsql.=' ORDER BY [localtimestamp]';
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
        $requiredParams=array('text_ru'=>'',
                              'text_en'=>'',
                              'title_ru'=>'Тикет: '.$data['title'],
                              'title_en'=>'Ticket: '.$data['title'],
                              'client_ID'=>$data['client_ID']);
        $tsql="INSERT INTO ".SCHEMA.".[Notifications] 
               (text_ru,text_en,title_ru,title_en,client_ID,notification_ID,status)  
               VALUES (:text_ru,:text_en,:title_ru,:title_en,:client_ID,NULL,1)  ;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($requiredParams);
            $notification_ID=Database::getInstance()->lastInsertId();
            $questonData=array('text'=>$data['text'],
                              'client_ID'=>$data['client_ID'],
                              'ID'=>$notification_ID,
                              );
            $resultData=Tickets::insert($questonData);
            return $notification_ID;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }

	}

}
