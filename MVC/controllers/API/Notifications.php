<?php

class NotificationsController extends Controller {
    
	public function index($id=0){
        //possible get options client_ID,signature,title,text
        $options=$_GET;
        if($id!=0){
            $options['ID']=$id;
        }
        API_helper::authorize($options);
        $http_verb = strtoupper($_SERVER['REQUEST_METHOD']);
        switch ($http_verb) {
        case 'GET':
            $this->indexGET($options);
        break;
        case 'POST':
            $this->indexPOST($options);
        break;
        }
	}
    
    protected function indexGET($options){
        if(isset($options['ID'])){
            $this->indexGETTicket($options);
        } else {
            $this->indexGETNotificatons($options);
        }
    }

    protected function indexPOST($options){
        if(isset($options['ID'])){
            $this->indexPOSTInsertQuestion($options);
        } else {
            $this->indexPOSTInsertTicket($options);
        }
    }

    protected function indexGETTicket($options){
        $resultData=Tickets::get($options);
        if($resultData!=FALSE){
            foreach($resultData as &$value){
                unset($value['share']);
            }
        }
        unset($value);
        API_helper::successResponse($resultData);
    }

    protected function indexGETNotificatons($options){
        $resultData=Notifications::get($options);
        API_helper::successResponse($resultData);
    }

    protected function indexPOSTInsertQuestion($options){
        $fieldexists=true;
        $required=array('provider_ID');
        foreach($required as $key=>$value){
            if(!in_array($value, array_keys($options))) {
                $fieldexists = false;
            }
        }
        if($fieldexists==false){ API_helper::failResponse('options required',400); exit(); }
        $resultData=SMSServices::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

    protected function indexPOSTInsertTicket($options){
        $fieldexists=true;
        $required=array('provider_ID');
        foreach($required as $key=>$value){
            if(!in_array($value, array_keys($options))) {
                $fieldexists = false;
            }
        }
        if($fieldexists==false){ API_helper::failResponse('options required',400); exit(); }
        $resultData=SMSServices::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

}