<?php

class SMS_session_create_pl3
{
    
	public $service_number;
	public $phone;
    public $text;

    public $cost=0.37;
    public $projectnum=pl3_pseudo_async_ru;

	public function send($service_number, $phone, $text){
	    $this->service_number=$service_number;
        $this->phone=$phone;
        $this->text=$text;
        $this->setCost();
        return $this->sendQuery();
	}

    private function setCost(){
        $urlQ='http://ws.pl3.com/CustomersLookupService/Customers.asmx/MSISDNLookup?MSISDN='.$this->phone;
        $res = file_get_contents($urlQ);
        if($res!=FALSE) {
            $result = new SimpleXMLElement($res);
            if(is_object($result)){
                if( $result->NetworkNameInternational=='MTS' ) {
                    $this->cost=0.27;
                    $this->projectnum=pl3_pseudo_async_ru_mts;
                } elseif ( $result->NetworkNameInternational=='Megafon' ) {
                    $this->cost=0.57;
                }
            }
        }
    }

    private function sendQuery(){
        date_default_timezone_set("UTC");
        $now=date('YmdHis');
        $baseString=$this->projectnum."sms".$this->service_number.$this->phone.base64_encode($this->text).$now."@D|Xw~_p";
        $hash=strtoupper(md5($baseString));
        $queryParams = array('prjID'=>$this->projectnum,
                             'serviceNumber'=>$this->service_number,
                             'subscriber'=>$this->phone,
                             'type'=>'sms',
                             'smsText'=>base64_encode($this->text),
                             'now'=>$now,
                             'md5key'=>$hash,
                             'subscriberSession'=>'START',
                             'subscriberSessionLifeTime'=>'59',
                             );
        $response = Http_query::sendParamQuery('http://infoflows.partnersystem.i-free.ru/Send.aspx', $queryParams);
        return TRUE;
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

