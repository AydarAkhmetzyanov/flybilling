<?php

class SMSController extends Controller {
    
	public function index($id=0){ //possible get options from,to,client_ID,timezone,service_ID,signature,order,offset,limit
        $options=$_GET;
        if(API_helper::requested_with_ajax()){
            if(!isset($_SESSION['isAdmin'])){
                if(!isset($_SESSION['ID'])){ API_helper::failResponse('auth required',401); exit(); } 
                $options['client_ID']=Clients::getInstance()->data['ID'];
            }
        } else {
            if(!isset($_GET['client_ID'])){ API_helper::failResponse('client_ID option required',401); exit(); } 
            if(!isset($_GET['signature'])){ API_helper::failResponse('signature option required',401); exit(); } 
            if( md5(Clients::getInstance($_GET['client_ID'])->data['tech_key']) != $_GET['signature'] ){ API_helper::failResponse('wrong signature',401); exit(); } 
        }
        if(!isset($_GET['timezone'])){
            $options['timezone']=Clients::getInstance()->data['timezone'];
        }
        if(isset($_GET['service_ID'])){
            $serviceOptions['ID']=$_GET['service_ID'];
            $serviceOptions['timezone']=$options['timezone'];
            if( SMSServices::get($serviceOptions)[0]['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        }
        if($id!=0){
            $options['ID']=$id;
        }
        $resultData=SMS::get($options);
        //delete share field
        //TODO: api pattern class
        echo json_encode($resultData, JSON_NUMERIC_CHECK);
	}

}