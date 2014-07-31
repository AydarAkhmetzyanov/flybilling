<?php

class SMS_PLASTIC1 extends SMS
{

    protected function setHandlerLogic(){
        $this->handler_is_async = 0;
    }

    protected function setProviderID(){
        $this->provider_ID = 2;
    }

    protected function sendResponse(){
header('Content-Type: text/html; charset=utf-8');
	$sms_id = urldecode($_REQUEST['sms_id']);
	$key = 'goldenbill'.$sms_id;
	$secretkey = md5($key);

	echo "reply:".$this->response_text."secretkey:".$secretkey;


    }

    protected function getData(){
        $this->timestamp = date('Y-m-d H:i:s');
        $this->sender_phone = urldecode($_REQUEST['abonent_num']);
        $this->sender_country = 'ru';
        $this->sender_cost = 0;
        $this->sender_text = urldecode($_REQUEST['message']);
        $this->external_share=urldecode($_REQUEST['income']);
        $this->sender_service_number = urldecode($_REQUEST['number']);
        $this->external_ID = urldecode($_REQUEST['sms_id']);
        $this->external_operator = urldecode($_REQUEST['operator']);
        $this->external_operator_ID = urldecode($_REQUEST['operator_id']);
    }

    protected function checkForTest(){
        return TRUE;
    }

    protected function checkMessageParams(){
  $requiredParams=array('abonent_num','message','income','number','sms_id','operator','operator_id');
        foreach($requiredParams as $paramName){
            if(!isset($_GET[$paramName])){
                return FALSE;
            }
        }
        return TRUE;
        return TRUE;
    }

    protected function errorResponse($msg){

    }

    protected function asyncResponse(){

    }

    protected function asyncResponseQuery(){

    }

}

