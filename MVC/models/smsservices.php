<?php

class SMSServices extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(hour,$data[timezone],CAST([timestamp] AS datetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[SMSServices] WHERE 1=1 ";
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

    public static function update($data){
        $params=array();
        $requiredParams=array('response_static','is_dynamic','dynamic_responder_URL','prefix','share','status','ID');
        foreach($data as $key=>$value){
            if(!in_array($key, $requiredParams)) {
                unset($data[$key]);
            }
        }
        $fieldexists=true;
        foreach($requiredParams as $key=>$value){
            if(!in_array($key, $data)) {
                $fieldexists = false;
            }
        }
        if($fieldexists==false){ API_helper::failResponse('fields required',400); exit(); }
        $params=$data;
        $tsql="UPDATE ".SCHEMA.".[SMSServices] 
        SET [response_static]=:response_static,[is_dynamic]=:is_dynamic,[dynamic_responder_URL]=:dynamic_responder_URL,[prefix]=:prefix,[share]=:share,[status]=:status 
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

    public static function delete($data){
       
	}

    public static function insert($data){
        print_r($data);
        $requiredParams=array('response_static'=>'default',
                              'is_dynamic'=>0,
                              'dynamic_responder_URL'=>'',
                              'prefix'=>self::generatePrefix($data->provider_ID),
                              'share'=>75,
                              'status'=>2,
                              'provider_ID'=>1,
                              'client_ID'=>0);
        foreach($requiredParams as $key=>$value){
            if(in_array($key, $data)) {
                $requiredParams[$key]=$data[$key];
            }
        }
        print_r($requiredParams);



	}

    public static function generatePrefix($provider){
        return $provider;
    }

}
