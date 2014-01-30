<?php

class NotificationsController extends Controller {
    
	public function index($id=0){
        //possible get options client_ID,signature,title,text
        parse_str(file_get_contents('php://input'), $_POST);
        $options=$_GET;
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
        API_helper::successResponse($resultData);
    }

    protected function indexGETNotificatons($options){
        $resultData=Notifications::get($options);
        API_helper::successResponse($resultData);
    }

    protected function indexPOSTInsertQuestion($options){
        if(!isset($_POST['text'])){ API_helper::failResponse('option required: text',400); exit(); }
        $options['text']=$_POST['text'];
        $resultData=Tickets::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

    protected function indexPOSTInsertTicket($options){
        if(!isset($_POST['text'])){ API_helper::failResponse('option required: text',400); exit(); }
        if(!isset($_POST['title'])){ API_helper::failResponse('option required: text',400); exit(); }
        $options['text']=$_POST['text'];
        $options['title']=$_POST['title'];
        $resultData=Notifications::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

}