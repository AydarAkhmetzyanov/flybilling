<?php

class SMSServicesController extends Controller {
    
	public function index($id=0){
        //possible get options from,to,client_ID,timezone,service_ID,signature,order,offset,limit
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
        
    }

    protected function indexDELETE($options){
        
    }

}