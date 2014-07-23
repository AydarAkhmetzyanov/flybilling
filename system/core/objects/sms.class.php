<?php

abstract class SMS
{

    public $ID;
    public $timestamp;
    public $handler_is_async; //0-no 1-yes
    public $response_text;
    public $response_is_sent; //0 1 2 - async
    public $response_is_async = 0;
    public $response_is_dynamic;
    public $sender_phone;
    public $sender_country;
    public $sender_cost;
    public $sender_service_number;
    public $sender_text;
    public $client_share;
    public $client_ID;
    public $provider_ID;
    public $service_ID;
    public $service_response_static;
    public $service_dynamic_responder_URL;
    public $external_ID;
    public $external_operator;
    public $external_operator_ID;
    public $external_share;

    abstract protected function checkMessageParams();
    abstract protected function checkForTest();
    abstract protected function getData();
    abstract protected function setHandlerLogic();
    abstract protected function setProviderID();
    abstract protected function sendResponse();
    abstract protected function errorResponse($msg);
    abstract protected function asyncResponse();
    abstract protected function asyncResponseQuery();

    public function processAsync($data){
        foreach($data as $key=>$value){
            $this->$key=$value;
        }
        if( (empty($this->response_text)) || (!isset($this->response_text)) || ($this->response_text=='') ){
            date_default_timezone_set('UTC');
            $diff=floor((time() - strtotime($this->timestamp)) / 60);
            if($diff>50){
                $this->response_text=$this->service_response_static;
            } else {
                if($this->response_is_dynamic==1){
                    if($this->response_is_async==0){
                        $dynamicResponse = $this->getDynamicResponse();
                        if($dynamicResponse === FALSE){

                        } else {
                            $decodedResponse=json_decode($dynamicResponse, true);
                            if($decodedResponse===NULL){

                            } else {
                                if($decodedResponse['type']=='async'){
                                    $this->response_is_async=1;
                                } elseif ($decodedResponse['type']=='sync') {
                                    $this->response_text=$decodedResponse['text'];
                                }
                            }
                        }
                    }
                } else {
                    $this->response_text=$this->service_response_static;
                }
            }
        }
        if( (empty($this->response_text)) || (!isset($this->response_text)) || ($this->response_text=='') ){
            
        } else {
            if($this->asyncResponseQuery()===false){
                $this->response_is_sent=0;
            } else {
                $this->response_is_sent=1;
            }
        }
        $this->saveData();
    }

    public function processMessage(){
        $this->setHandlerLogic();
        $this->setProviderID();
        if($this->checkMessageParams() == FALSE){ $this->processError('Query variable missing'); exit(); }
        if($this->checkForTest() == FALSE){ exit(); }
        $this->getData();
        if($this->searchResponse() == FALSE){
            if($this->getClientData() == FALSE){
                $this->response_text=EMPTY_RECIEVER_TEXT;
            } else {
                if($this->handler_is_async==0){
                    if($this->response_is_dynamic==1){
                        $dynamicResponse = $this->getDynamicResponse();
                        if($dynamicResponse == FALSE || empty($dynamicResponse)){
                            $this->response_text=$this->service_response_static;
                        } else {
                            $decodedResponse=json_decode($dynamicResponse, true);
                            if($decodedResponse===NULL){
                                $this->response_text=$this->service_response_static;
                            } else {
                                if($decodedResponse['type']=='async'){
                                    $this->response_text=$this->service_response_static;
                                } elseif ($decodedResponse['type']=='sync') {
                                    $this->response_text=$decodedResponse['text'];
                                } else {
                                    $this->response_text=$this->service_response_static;
                                }
                            }
                        }
                    } else {
                        $this->response_text=$this->service_response_static;
                    }
                }
            }
        }
        if($this->handler_is_async==1){
            $this->asyncResponse();
            $this->response_is_sent=0;
            if(empty($this->ID)){
                $this->saveData();
            }
            Http_query::sendAsync(API_URL.'/system/WORKERS/sms_async_send.php',array());
        } else {
            $this->sendResponse();
            $this->response_is_sent=1;
            if(empty($this->ID)){
                $this->saveData();
            }
        }
    }

    public function saveData(){
        if(empty($this->ID)){
            try{
                Database::getInstance()->beginTransaction();
                $tsql="UPDATE ".SCHEMA.".[Clients] SET [balance]=[balance] + :client_share WHERE [ID]=:client_ID ;";
                $statement = Database::getInstance()->prepare($tsql);
                $params=array( 'client_share'=>$this->client_share, 'client_ID'=>$this->client_ID );
                $statement->execute($params);
                $tsql="
                    INSERT INTO ".SCHEMA.".[SMS]
                    (response_text, response_is_sent, response_is_async, response_is_dynamic, sender_phone, sender_country, sender_cost, sender_service_number
                    , sender_text, client_share, client_ID, service_ID, provider_ID
                    , external_ID, external_operator, external_operator_ID, external_share) 
                    VALUES (:response_text, :response_is_sent, :response_is_async, :response_is_dynamic, :sender_phone, :sender_country, :sender_cost, :sender_service_number
                    , :sender_text, :client_share, :client_ID, :service_ID, :provider_ID
                    , :external_ID, :external_operator, :external_operator_ID, :external_share);
                ";
                $statement = Database::getInstance()->prepare($tsql);
                $params=array( 'response_text'=>$this->response_text, 
                               'response_is_sent'=>$this->response_is_sent,
                               'response_is_async'=>$this->response_is_async,
                               'response_is_dynamic'=>$this->response_is_dynamic,
                               'sender_phone'=>$this->sender_phone,
                               'sender_country'=>$this->sender_country,
                               'sender_cost'=>$this->sender_cost,
                               'sender_service_number'=>$this->sender_service_number,
                               'sender_text'=>$this->sender_text,
                               'client_share'=>$this->client_share,
                               'client_ID'=>$this->client_ID,
                               'service_ID'=>$this->service_ID,
                               'provider_ID'=>$this->provider_ID,
                               'external_ID'=>$this->external_ID,
                               'external_operator'=>$this->external_operator,
                               'external_operator_ID'=>$this->external_operator_ID,
                               'external_share'=>$this->external_share
                               );
                $statement->execute($params);
                $this->ID = Database::getInstance()->lastInsertId();
                Database::getInstance()->commit();
            } catch(PDOException $e) {
                Database::getInstance()->rollBack();
                echo $e->getMessage();
            }
        } else {
            try{
                $tsql="UPDATE ".SCHEMA.".[SMS] 
                      SET [response_text]=:response_text,
                      [response_is_sent]=:response_is_sent, 
                      [response_is_async]=:response_is_async, 
                      [response_is_dynamic]=:response_is_dynamic, 
                      [sender_phone]=:sender_phone, 
                      [sender_country]=:sender_country, 
                      [sender_cost]=:sender_cost, 
                      [sender_service_number]=:sender_service_number, 
                      [sender_text]=:sender_text, 
                      [client_share]=:client_share, 
                      [client_ID]=:client_ID, 
                      [service_ID]=:service_ID, 
                      [provider_ID]=:provider_ID, 
                      [external_ID]=:external_ID, 
                      [external_operator]=:external_operator, 
                      [external_operator_ID]=:external_operator_ID, 
                      [external_share]=:external_share
                      WHERE [ID]=:ID;
                      ";
                $statement = Database::getInstance()->prepare($tsql);
                $params=array( 'response_text'=>$this->response_text, 
                               'response_is_sent'=>$this->response_is_sent,
                               'response_is_async'=>$this->response_is_async,
                               'response_is_dynamic'=>$this->response_is_dynamic,
                               'sender_phone'=>$this->sender_phone,
                               'sender_country'=>$this->sender_country,
                               'sender_cost'=>$this->sender_cost,
                               'sender_service_number'=>$this->sender_service_number,
                               'sender_text'=>$this->sender_text,
                               'client_share'=>$this->client_share,
                               'client_ID'=>$this->client_ID,
                               'service_ID'=>$this->service_ID,
                               'provider_ID'=>$this->provider_ID,
                               'external_ID'=>$this->external_ID,
                               'external_operator'=>$this->external_operator,
                               'external_operator_ID'=>$this->external_operator_ID,
                               'external_share'=>$this->external_share,
                               'ID'=>$this->ID
                               );
                $statement->execute($params);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return TRUE;
    }

    public function getDynamicResponse(){
        $queryParams = array('external_ID'=>$this->external_ID,
                             'ID'=>$this->ID,
                             'sender_phone'=>$this->sender_phone,
                             'sender_country'=>$this->sender_country,
                             'sender_cost'=>$this->sender_cost,
                             'sender_service_number'=>$this->sender_service_number,
                             'sender_text'=>$this->sender_text,
                             'client_share'=>$this->client_share,
                             'service_ID'=>$this->service_ID,
                             'external_operator'=>$this->external_operator,
                             'external_operator_ID'=>$this->external_operator_ID);
        $queryParams['md5']=md5(json_encode($queryParams));
        return Http_query::sendParamQuery($this->service_dynamic_responder_URL, $queryParams);
    }

    public function searchResponse(){
        $tsql="SELECT * FROM ".SCHEMA.".[SMS] WHERE [external_ID]=:external_ID AND [provider_ID]=:provider_ID";
        $statement = Database::getInstance()->prepare($tsql);
        $params=array( 'external_ID'=>$this->external_ID, 'provider_ID'=>$this->provider_ID );
        $statement->execute($params);
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            $this->ID = $row[0]['ID'];
            $this->response_text = $row[0]['response_text'];
            $this->response_is_dynamic = $row[0]['response_is_dynamic'];
            $this->client_share = $row[0]['client_share'];
            $this->client_ID = $row[0]['client_ID'];
            $this->service_ID = $row[0]['service_ID'];
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getClientData(){
        $tsql="SELECT TOP 1 * 
            FROM ".SCHEMA.".[SMSServices] 
            WHERE [status]=1 AND [country]=:country AND [provider_ID]=:provider_ID and SUBSTRING( :text , 0, LEN([prefix])+1)=[prefix]";
        $statement = Database::getInstance()->prepare($tsql);
        $params=array( 'country'=>$this->sender_country, 'provider_ID'=>$this->provider_ID, 'text'=>substr($this->sender_text,0,15) );
        $statement->execute($params);
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            $this->client_share = $row[0]['share'] * $this->external_share / 100;
            $this->client_ID = $row[0]['client_ID'];
            $this->service_ID = $row[0]['ID'];
            $this->service_response_static = $row[0]['response_static'];
            $this->response_is_dynamic = $row[0]['is_dynamic'];
            $this->service_dynamic_responder_URL = $row[0]['dynamic_responder_URL'];
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function processError($msg){
        $this->errorResponse($msg);
        Logger::logError($msg);
    }


}

