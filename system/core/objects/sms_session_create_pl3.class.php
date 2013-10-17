<?php

class SMS_session_create_pl3
{

    //public $ID;
    public $service_ID;
	public $hash;
	public $service_number;
	public $phone;
    public $text;
    protected $tech_key='1234';

    public function processSessionCreate(){
        if($this->checkParams() == FALSE) { $this->failResponse('param missing'); exit(); }
		if($this->getData() == FALSE) { $this->failResponse('service error'); exit(); }
        if($this->auth() == FALSE) { $this->failResponse('wrong hash'); exit(); }
		if($this->setProvider() == FALSE) { $this->failResponse('wrong hash'); exit(); }
		if($this->sendMessage() == FALSE) { $this->failResponse('wrong hash'); exit(); }
		$this->save();
    }

    protected function checkParams(){
        $requiredParams=array('service_ID','hash','service_number','phone','text');
        foreach($requiredParams as $paramName){
            if(!isset($_GET[$paramName])){
                return FALSE;
            } else {
                $this->$paramName=$_GET[$paramName];
            }
        }
        return TRUE;
    }

    protected function auth(){
        if(md5($this->service_ID.$this->tech_key)==$this->hash){ 
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
    protected function getData(){
        $tsql="SELECT SMS.*, Clients.[tech_key] 
        FROM ".SCHEMA.".[SMS] SMS
        LEFT JOIN [dbo].[Clients] Clients ON Clients.[ID]=SMS.[client_ID]
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

    protected function successResponse(){
        $response=array();
        $response['result']=1;
        echo json_encode($response);
    }

    protected function failResponse($error){
        $response=array();
        $response['result']=0;
        $response['reason']=$error;
        echo json_encode($response);
    }

}

