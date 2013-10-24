<?php

abstract class SMS_PSEUDO extends SMS
{

    public function getClientData(){
        //search for external message
        //SELECT TOP 1 * FROM [dbo].[SessionSMS] WHERE [timestamp] > dateadd(minute,-55,getdate()) AND [phone]=:phone;


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

}
