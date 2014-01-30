<?php

class SMSServicesController extends Controller {
    
	public function index($id=0){
        //possible get options from,to,client_ID,timezone,service_ID,signature,order,offset,limit
        $options=$_GET;
        parse_str(file_get_contents('php://input'), $_POST);
        if($id!=0){
            $options['ID']=$id;
        }
        $options = API_helper::authorize($options);
        $http_verb = strtoupper($_SERVER['REQUEST_METHOD']);
        switch ($http_verb) {
        case 'GET':
            $this->indexGET($options);
        break;
        case 'POST':
            $this->indexPOST($options);
        break;
        case 'DELETE':
            $this->indexDELETE($options);
        break;
        }
	}
    
    protected function indexGET($options){
        $resultData=SMSServices::get($options);
        if($resultData!=FALSE){
            foreach($resultData as &$value){
                unset($value['share']);
            }
        }
        unset($value);
        API_helper::successResponse($resultData);
    }

    protected function indexPOST($options){
        if(isset($options['ID'])){
            $this->indexPOSTUpdate($options);
        } else {
            $this->indexPOSTInsert($options);
        }
    }

    protected function indexPOSTUpdate($options){
        $target=SMSServices::get($options)[0];
        if( !API_helper::isAdmin() and ( $target['client_ID'] != $options['client_ID'] )){ API_helper::failResponse('service owned by other client',403); exit(); } 
        $fieldexists=FALSE;
        $possibleOptions=array('response_static','is_dynamic','dynamic_responder_URL');
        foreach($options as $key=>$value){
            if(in_array($key, $possibleOptions)) {
                $fieldexists = TRUE;
                $target[$key]=$options[$key];
            }
        }
        if($fieldexists==false){ API_helper::failResponse('at least one option required',400); exit(); }
        $resultData=SMSServices::update($target);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }
    
    protected function indexDELETE($options){
        $options = API_helper::authorize($options);
        $target=SMSServices::get($options)[0];
        if( $target['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        $target['status']=0;
        $resultData=SMSServices::update($target);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

    protected function indexPOSTInsert($options){
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