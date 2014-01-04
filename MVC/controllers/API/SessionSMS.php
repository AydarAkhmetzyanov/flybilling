<?php

class SessionSMSController extends Controller {
    
	public function index($id=0){
        //possible get options from,to,client_ID,timezone,service_ID,signature,order,offset,limit,group[day,hour,month,year]
        $options=$_GET;
        $options = API_helper::authorize($options);

        
        if(isset($_GET['service_ID'])){
            $serviceOptions['ID']=$_GET['service_ID'];
            $serviceOptions['timezone']=$options['timezone'];
            if( SessionServices::get($serviceOptions)[0]['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        }
        if($id!=0){
            $options['ID']=$id;
        }
        $resultData=SessionSMS::get($options);
        API_helper::successResponse($resultData);
	}

}