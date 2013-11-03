<?php

class SMSController extends Controller {
    
	public function index($id=0){ //possible get options limit,from,fromdate,todate,client_ID,timezone,service_ID
        //auth and get userid
        if($this->auth() == FALSE) { API_response::failResponse('wrong hash'); exit(); }



        //auth service_id

        //auth id if exists

        //get data
        $options=$_GET;
        $options['client_ID']=$clinet_ID;
        $options['timezone']=$timezone;
        $resultData=SMS::get($options);

        echo json_encode($resultData, JSON_NUMERIC_CHECK);
	}

}