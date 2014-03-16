<?php

class SessionServices extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[SessionServices] WHERE 1=1  ";
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
        if(isset($data['client_ID'])){
            $tsql.=' AND [client_ID]=:client_ID';
            $params['client_ID']=$data['client_ID'];
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

    public static function update($data){
        $params=array();
        $requiredParams=array('ID','status','default_text');
        foreach($data as $key=>$value){
            if(!in_array($key, $requiredParams)) {
                unset($data[$key]);
            }
        }
        $fieldexists=true;
        foreach($requiredParams as $key=>$value){
            if(!in_array($value,array_keys($data))) {
                $fieldexists = false;
                $field=$value;
            }
        }
        if($fieldexists==false){ API_helper::failResponse('field required: '.$field,400); exit(); }
        $params=$data;
        $tsql="UPDATE ".SCHEMA.".[SessionServices] 
        SET [default_text]=:default_text,[status]=:status 
        WHERE [ID]=:ID ;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($params);
            return TRUE;
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
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
                              'prefix'=>'',
                              'share'=>DEFAULT_SHARE,
                              'status'=>2,
                              'provider_ID'=>$data['provider_ID'],
                              'client_ID'=>$data['client_ID'],
                              'is_pseudo'=>1);
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
            $newserviceID = Database::getInstance()->lastInsertId();
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
        $requiredParams=array('country'=>$provider['code'],
                              'is_text_unlocked'=>0,
                              'default_text'=>$data['default_text'],
                              'status'=>2,
                              'provider_ID'=>$data['provider_ID'],
                              'client_ID'=>$data['client_ID'],
                              'client_service_ID'=>$newserviceID);
        foreach($requiredParams as $key=>$value){
            if(isset($data[$key])) {
                $requiredParams[$key]=$data[$key];
            }
        }
        $tsql="INSERT INTO ".SCHEMA.".[SessionServices] 
               (country, is_text_unlocked, status, default_text, client_ID, provider_ID, client_service_ID) 
               VALUES (:country, :is_text_unlocked, :status, :default_text, :client_ID, :provider_ID, :client_service_ID)  ;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($requiredParams);
            $newsessionserviceID = Database::getInstance()->lastInsertId();
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            return FALSE;
        }
        return $newserviceID;
	}

}
