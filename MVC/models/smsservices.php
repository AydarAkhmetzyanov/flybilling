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

        $provideroptions=array();
        
        SMSProviders::


        $requiredParams=array('country'=>get,
                              'response_static'=>'default',
                              'is_dynamic'=>0,
                              'dynamic_responder_URL'=>'',
                              'prefix'=>self::generatePrefix($data['provider_ID'],2),
                              'share'=>DEFAULT_SHARE,
                              'status'=>2,
                              'provider_ID'=>1,
                              'client_ID'=>0);
        foreach($requiredParams as $key=>$value){
            if(isset($data[$key])) {
                $requiredParams[$key]=$data[$key];
            }
        }
        print_r($requiredParams); //todo
        $tsql="INSERT INTO ".SCHEMA.".[SMSServices] 
               (country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
               VALUES ('ru', N'kmbord566', 'response_static', 1, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0)  ;";
        $statement = Database::getInstance()->prepare($tsql);
        try{
            //$statement->execute($requiredParams);
            return TRUE;
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
        print_r($corePrefixes);
        foreach ($corePrefixes as $key=>$prefix) {
            if(!self::checkPrefixAvailability($prefix['prefix'])){
                unset($corePrefixes[$key]);
            }
        }
        if(count($corePrefixes)==0){ API_helper::failResponse('Out of free prefixes',500); exit(); }
        $prefix = $corePrefixes[0]['prefix']; //TODO: random select not first
        $resultPrefix=$prefix;
        for ($i = 10; $i < 99; $i++) {
            if(self::checkPrefixAvailability($prefix['prefix'].$i)){
                $resultPrefix = $prefix['prefix'].$i;
            }
        }
        return $resultPrefix;
    }

    public static function checkPrefixAvailability($prefix){
            $subq['prefix']=$prefix;
            $tsql="SELECT * 
                  FROM ".SCHEMA.".[SMSServices]
                  WHERE [prefix]=:prefix;";
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
