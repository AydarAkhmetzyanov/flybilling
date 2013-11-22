<?php

class SMSServices extends Model
{

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
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
        $requiredParams=array('ID','response_static','is_dynamic','dynamic_responder_URL','prefix','share','status');
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

    public static function generatePrefix($provider_ID,$length=2){
        $SMSCorePrefixesparams['provider_ID']=$provider_ID;
        $tsql="SELECT * 
               FROM ".SCHEMA.".[SMSCorePrefixes]
               WHERE [provider_ID]=:provider_ID;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($SMSCorePrefixesparams);
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
        }
        $corePrefixes = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($corePrefixes as $key=>$prefix) {
            if(!self::checkPrefixAvailability($prefix['prefix'])){
                unset($corePrefixes[$key]);
            }
        }
        if(count($corePrefixes)==0){ API_helper::failResponse('Out of free prefixes',500); exit(); }
        $prefix = $corePrefixes[0]['prefix']; //TODO: random select not first
        $resultPrefix=$prefix;
        $i = 10;
        while (!self::checkPrefixAvailability($prefix.$i)) {
            $i++;
        }
        $resultPrefix = $prefix.$i;
        return $resultPrefix;
    }

    public static function checkPrefixAvailability($prefix){
            $subq['prefix']=$prefix;
            $tsql="SELECT * 
                  FROM ".SCHEMA.".[SMSServices]
                  WHERE [prefix]=:prefix AND status<>0;";
            $pst = Database::getInstance()->prepare($tsql);
            try{
                $pst->execute($subq);
            } catch(PDOException $e) {
                API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
            }
            $sresult = $pst->fetchAll(PDO::FETCH_ASSOC);
            if(count($sresult)>0){
                return FALSE;
            } else {
                return TRUE;
            }
    }

}
