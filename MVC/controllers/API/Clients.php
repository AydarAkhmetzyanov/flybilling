<?php

class ClientsController extends Controller {
    
	public function index($id=0){
        //possible get options 
        $options=$_GET;
        if($id!=0){
            $options['ID']=$id;
            $options['client_ID']=$id;
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
        $resultData=Clients::get($options);
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
        }
    }

    protected function indexPOSTUpdate($options){
        $target=Clients::get($options)[0];
        if( $target['client_ID'] != $options['client_ID'] ){ API_helper::failResponse('service owned by other client',403); exit(); } 
        $fieldexists=FALSE;
        $possibleOptions=array('response_static','is_dynamic','dynamic_responder_URL');
        foreach($options as $key=>$value){
            if(in_array($key, $possibleOptions)) {
                $fieldexists = TRUE;
                $target[$key]=$options[$key];
            }
        }
        if($fieldexists==false){ API_helper::failResponse('at least one option required',400); exit(); }
        $resultData=Clients::update($target);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }



}