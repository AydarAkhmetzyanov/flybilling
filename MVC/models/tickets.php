<?php

class Tickets extends Model
{

    public static function get($data){
        $tsql=" (SELECT [timestamp],[text_ru],[text_en],[title_ru],[title_en],[status],'a' [type]";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.="
  FROM ".SCHEMA.".[Notifications]
  WHERE [ID]=$data[ID] or [notification_ID]=$data[ID] 
   UNION 
 SELECT [timestamp],[text] [text_ru],[text] [text_en],NULL [title_ru],NULL [title_en],[status] ,'q' [type]";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.="
  FROM ".SCHEMA.".[Questions]
  WHERE [notification_ID]=$data[ID] 
)
    ORDER BY [timestamp] DESC;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute();
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
        $notificationOptions['ID']=$data['ID'];
        $notification=Notifications::get($notificationOptions);
        if($notification==FALSE){ API_helper::failResponse('ticket not found',404); exit(); } 
        $requiredParams=array('text'=>$data['text'],
                              'client_ID'=>$data['client_ID'],
                              'notification_ID'=>$data['ID']);
        $tsql="INSERT INTO ".SCHEMA.".[Questions] 
               (text,client_ID,notification_ID,status)  
               VALUES (:text,:client_ID,:notification_ID,0);";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($requiredParams);
            return Database::getInstance()->lastInsertId();
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
	}

}
