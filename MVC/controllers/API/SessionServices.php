<?php

class SessionServicesController extends Controller {
    
	public function index($id=0){
        //possible get options response_static,is_dynamic,dynamic_responder_URL,provider_ID,default_text
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
        case 'DELETE':
            $this->indexDELETE($options);
        break;
        }
	}
    
    protected function indexGET($options){
        $resultData=SessionServices::get($options);
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
        $target=SessionServices::get($options)[0];
        if( $target['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        $fieldexists=FALSE;
        $possibleOptions=array('default_text');
        foreach($options as $key=>$value){
            if(in_array($key, $possibleOptions)) {
                $fieldexists = TRUE;
                $target[$key]=$options[$key];
            }
        }
        if($fieldexists==false){ API_helper::failResponse('at least one option required',400); exit(); }
        $resultData=SessionServices::update($target);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }
    
    protected function indexDELETE($options){
        API_helper::authorize($options);
        $target=SessionServices::get($options)[0];
        if( $target['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        $target['status']=0;
        $resultData=SessionServices::update($target);
        $options2['ID']=$target['client_service_ID'];
        $target2=SMSServices::get($options2)[0];
        $target2['status']=0;
        SMSServices::update($target2);
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
        $resultData=SessionServices::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }


}