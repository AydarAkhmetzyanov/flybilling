<?php

class SMS_async_response
{

    public $ID;
    public $hash;
    public $sender_text;
    protected $tech_key='1234';

    public function processAsyncResponse(){
        if($this->checkParams() == FALSE) { API_response::failResponse('param missing'); exit(); }
        if($this->getData() == FALSE) { API_response::failResponse('sms not found or already sent'); exit(); }
        if($this->auth() == FALSE) { API_response::failResponse('wrong hash'); exit(); }
        $this->saveResponse();
        API_response::successResponse();
        //Http_query::sendAsync(API_URL.'/system/WORKERS/sms_async_send.php',array());
    }

    protected function checkParams(){
        $requiredParams=array('ID','hash','sender_text');
        foreach($requiredParams as $paramName){
            if(!isset($_GET[$paramName])){
                return FALSE;
            } else {
                $this->$paramName=$_GET[$paramName];
            }
        }
        return TRUE;
    }

    protected function getData(){
        $tsql="SELECT SMS.*, Clients.[tech_key] 
        FROM ".SCHEMA.".[SMS] SMS
        LEFT JOIN ".SCHEMA.".[Clients] Clients ON Clients.[ID]=SMS.[client_ID]
        WHERE SMS.[ID]=:ID AND SMS.[response_is_sent]=0";
        $statement = Database::getInstance()->prepare($tsql);
        $params=array( 'ID'=>$this->ID );
        $statement->execute($params);
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            $this->tech_key = $row[0]['tech_key'];
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function auth(){
        if(md5($this->ID.$this->tech_key)==$this->hash){ 
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function saveResponse(){
        try{
             $tsql="UPDATE ".SCHEMA.".[SMS] 
                  SET [response_text]=:response_text 
                  WHERE [ID]=:ID;
                  ";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'response_text'=>$this->sender_text,
                           'ID'=>$this->ID
                           );
            $statement->execute($params);
        } catch(PDOException $e) {
            echo $e->getMessage();
            return FALSE;
        }
        return TRUE;
    }

}

