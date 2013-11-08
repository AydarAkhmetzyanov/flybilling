<?php

class SMS_async_worker
{

    public function processQueue(){
        $tsql="SELECT SMS.*,Provider.[name],Service.[response_static] AS [service_response_static], Service.[dynamic_responder_URL] AS [service_dynamic_responder_URL], Service.[is_pseudo] AS [is_pseudo]
               FROM [dbo].[SMS] SMS
               LEFT JOIN [dbo].[SMSProviders] Provider ON Provider.[ID]=SMS.[provider_ID]
               LEFT JOIN [dbo].[SMSServices] Service ON Service.[ID]=SMS.[service_ID]
               WHERE [response_is_sent]=0;";
        $statement = Database::getInstance()->prepare($tsql);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            print_r($row);
            if($row['is_pseudo']==1){
                $smsHandlerName='SMS_PSEUDO_'.strtoupper($row['name']);
            } else {
                $smsHandlerName='SMS_'.strtoupper($row['name']);
            }
            print_r($smsHandlerName);
            $SMS = new $smsHandlerName();
            $SMS->processAsync($row);
            unset($SMS);
        }
    }

}

