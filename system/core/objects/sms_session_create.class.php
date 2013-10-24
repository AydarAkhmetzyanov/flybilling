<?php

class SMS_session_create
{

    public $ID;
    public $service_ID;
	public $hash;
	public $service_number;
	public $phone;
    public $text;
    public $country;
    public $tech_key='1234';
	public $provider_name;
    public $client_cost;
    public $client_ID;

    public function processSessionCreate(){
        if($this->checkParams() == FALSE) { API_response::failResponse('param missing'); exit(); }
		if($this->getData() == FALSE) { API_response::failResponse('service error'); exit(); }
        if($this->auth() == FALSE) { API_response::failResponse('wrong hash'); exit(); }
		$sms_sender_class='SMS_session_create_'.$this->provider_name;
        $sms_sender = new $sms_sender_class();
		if($sms_sender->send($this->service_number, $this->phone, $this->text) == FALSE) { API_response::failResponse('provider error'); exit(); }
        $this->client_cost=$sms_sender->cost;
		print_R($this);
		$this->saveData();
        API_response::successResponse();
    }

    protected function saveData(){
        try{
            Database::getInstance()->beginTransaction();
            $tsql="UPDATE ".SCHEMA.".[Clients] SET [balance]=[balance] - :client_share WHERE [ID]=:client_ID ;";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'client_share'=>$this->client_cost, 'client_ID'=>$this->client_ID );
            $statement->execute($params);
            $tsql="
                INSERT INTO ".SCHEMA.".[SessionSMS]
                (text, phone, country, service_number, client_cost, client_ID, service_ID)
                VALUES (:text, :phone, :country, :service_number, :client_cost, :client_ID, :service_ID);
            ";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'text'=>$this->text, 
                           'phone'=>$this->phone,
                           'country'=>$this->country,
                           'service_number'=>$this->service_number,
                           'client_cost'=>$this->client_cost,
                           'client_ID'=>$this->client_ID,
                           'service_ID'=>$this->service_ID
                           );
            $statement->execute($params);
            $this->ID = Database::getInstance()->lastInsertId();
            Database::getInstance()->commit();
        } catch(PDOException $e) {
            Database::getInstance()->rollBack();
            echo $e->getMessage();
        }
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
        $tsql="SELECT SessionService.*, Clients.[tech_key], Clients.[ID] AS [client_ID], Provider.[name]
        FROM ".SCHEMA.".[SessionServices] SessionService
        LEFT JOIN ".SCHEMA.".[Clients] Clients ON Clients.[ID]=SessionService.[client_ID]
		LEFT JOIN ".SCHEMA.".[SMSProviders] Provider ON Provider.[ID]=SessionService.[provider_ID]
        WHERE SessionService.[ID]=:ID AND SessionService.[status]=1";
        $statement = Database::getInstance()->prepare($tsql);
        $params=array( 'ID'=>$this->service_ID );
        $statement->execute($params);
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            $this->tech_key = $row[0]['tech_key'];
			$this->provider_name = $row[0]['name'];
            $this->client_ID = $row[0]['client_ID'];
            $this->country = $row[0]['country'];
            $this->service_ID = $row[0]['service_ID'];
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

