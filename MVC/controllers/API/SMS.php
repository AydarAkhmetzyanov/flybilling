<?php

class SMSController extends Controller {
    
	public function index($id=0){ //possible get options limit,from,fromdate,todate,client_ID,timezone,service_ID,signature
        $options=$_GET;
        //auth and get userid
        if(API_helper::requested_with_ajax()){
            //check for admin
            if(!isset($_SESSION['isAdmin'])){
                if(!isset($_SESSION['ID'])){ API_helper::failResponse('auth required',401); exit(); } 
            }
        } else {
            if(!isset($_GET['client_ID'])){ API_helper::failResponse('client_ID option required',401); exit(); } 
            if(!isset($_GET['signature'])){ API_helper::failResponse('signature option required',401); exit(); } 
            if( md5(Clients::getInstance($_GET['client_ID'])->data['tech_key']) != $_GET['signature'] ){ API_helper::failResponse('wrong signature',401); exit(); } 
        }
        //auth service_id
        if(isset($_GET['service_ID'])){
            $serviceOptions['ID']=$_GET['service_ID'];
            if( SMSServices::get($serviceOptions)['client_ID'] != $_GET['client_ID'] ){ API_helper::failResponse('service_ID option required',401); exit(); } 
        }
        //get data
        
        if(!isset($_GET['timezone'])){
            $options['timezone']=Clients::getInstance()->data['timezone'];
        }
        $options['ID']=$id;
        $resultData=SMS::get($options);

        echo json_encode($resultData, JSON_NUMERIC_CHECK);
	}

}