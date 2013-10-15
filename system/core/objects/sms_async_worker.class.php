<?php

class SMS_async_worker
{

    public function processQueue(){
        $tsql="SELECT SMS.*,Provider.[name],Service.[response_static] AS [service_response_static], Service.[dynamic_responder_URL] AS [service_dynamic_responder_URL]
               FROM [dbo].[SMS] SMS
               LEFT JOIN [dbo].[SMSProviders] Provider ON Provider.[ID]=SMS.[provider_ID]
               LEFT JOIN [dbo].[SMSServices] Service ON Service.[ID]=SMS.[service_ID]
               WHERE [response_is_sent]=0;";
        $statement = Database::getInstance()->prepare($tsql);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $smsHandlerName='SMS_'.strtoupper($row['name']);
            $SMS = new $smsHandlerName();
            $SMS->processAsync($row);
            unset($SMS);
        }
    }

}

