<?php

class Notifications extends Model
{

    public static function get($data){
        if(isset($data['mark_read']) and $data['mark_read']==true and isset($data['client_ID'])){
            
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
        $providerOptions['ID']=$data['provider_ID'];
        $providers=SMSProviders::get($providerOptions);
        if($providers==FALSE){ API_helper::failResponse('provider not found',404); exit(); } 
        $provider=$providers[0];
        $requiredParams=array('country'=>$provider['code'],
                              'response_static'=>'default',
                              'is_dynamic'=>0,
                              'dynamic_responder_URL'=>'',
                              'prefix'=>self::generatePrefix($data['provider_ID'],2),
                              'share'=>DEFAULT_SHARE,
                              'status'=>2,
                              'provider_ID'=>$data['provider_ID'],
                              'client_ID'=>$data['client_ID'],
                              'is_pseudo'=>0);
        foreach($requiredParams as $key=>$value){
            if(isset($data[$key])) {
                $requiredParams[$key]=$data[$key];
            }
        }
        $tsql="INSERT INTO ".SCHEMA.".[SMSServices] 
               (country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
               VALUES (:country, :prefix, :response_static, :is_dynamic, :dynamic_responder_URL, :share, :status, :client_ID, :provider_ID, :is_pseudo)  ;";
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
