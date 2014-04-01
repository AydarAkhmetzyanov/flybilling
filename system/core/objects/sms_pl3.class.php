<?php

class SMS_PL3 extends SMS
{

    protected function setHandlerLogic(){
        $this->handler_is_async = 1;
    }

    protected function setProviderID(){
        $this->provider_ID = 1;
    }

    protected function sendResponse(){
        echo '<Response><SmsText>';
        echo Helper::xml_entities($this->response_text);
        echo '</SmsText></Response>';
    }

    protected function getData(){
        $this->timestamp = date('Y-m-d H:i:s');
        $this->sender_phone = $_GET['phone'];
        $this->sender_country = $_GET['country'];
        $this->sender_cost = 0;
        $this->sender_text = base64_decode($_GET['smsText']);
        if($_GET['profitCurrency']!='RUB'){
            $this->external_share=Currency::convert($_GET['profit'],$_GET['profitCurrency'],'RUB') * 1.01;
        }
        $this->external_share = $_GET['profit'];
        $this->sender_service_number = $_GET['serviceNumber'];
        $this->external_ID = $_GET['evtId'];
        $this->external_operator = $_GET['operator'];
        $this->external_operator_ID = $_GET['operatorId'];
    }

    protected function checkForTest(){
        if($_GET['operator']=='i-­Free'){
            echo '<Response><SmsText>';
            echo 'test';
            echo '</SmsText></Response>';
            return FALSE;
        }
        if(isset($_GET['test'])){
            echo '<Response><SmsText>';
            echo $_GET['test'];
            echo '</SmsText></Response>';
            return FALSE;
        }
        if((isset($_GET['debug']))and($_GET['debug']=='1')){
            echo '<Response><SmsText>';
            echo 'test';
            echo '</SmsText></Response>';
            return FALSE;
        }
        return TRUE;
    }

    protected function checkMessageParams(){
        $requiredParams=array('smsText','phone','country','serviceNumber','operator','operatorId','now','evtId','md5key','profit');
        foreach($requiredParams as $paramName){
            if(!isset($_GET[$paramName])){
                return FALSE;
            }
        }
        return TRUE;
    }

    protected function errorResponse($msg){
        echo '<Response><ErrorText>';
        echo Helper::xml_entities($msg);
        echo '</ErrorText></Response>';
    }

    protected function asyncResponse(){
        echo '<Response async="true"/>';
    }

    protected function asyncResponseQuery(){
        date_default_timezone_set("UTC");
        $now=date('YmdHis');
        $baseString=$this->external_ID.'sms'.base64_encode($this->response_text).$now."@D|Xw~_p";
        $hash=strtoupper(md5($baseString));
        $queryParams = array('evtID'=>$this->external_ID,
                             'type'=>'sms',
                             'smsText'=>base64_encode($this->response_text),
                             'now'=>$now,
                             'md5key'=>$hash);
        $response = Http_query::sendParamQuery('http://infoflows.partnersystem.i-free.ru/Send.aspx', $queryParams);
        print_r($response);
        if($response === FALSE){
            return FALSE;
        } else {
            $result = new SimpleXMLElement($response);
            if(!is_object($result)){
                return FALSE;
            } else {
                if( $result['status']==1 ) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

}

