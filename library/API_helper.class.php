<?php

class API_helper
{

    public static function requested_with_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function successResponse($data=FALSE){
        $response=array();
        $response['result']=1;
        $response['data']=$data;
        echo json_encode($response, JSON_NUMERIC_CHECK);
    }

    public static function failResponse($error,$code=500){
        http_response_code($code);
        $response=array();
        $response['result']=0;
        $response['code']=$code;
        $response['reason']=$error;
        echo json_encode($response);
    }

    public static function authorize($options) {
        parse_str(file_get_contents('php://input'), $_POST);
        if(API_helper::requested_with_ajax()){
            if(!isset($_SESSION['isAdmin'])){
                if(!isset($_SESSION['id'])){ API_helper::failResponse('auth required',401); exit(); } 
                $options['client_ID']=Clients::getInstance()->data['ID'];
            }
        } else {
            if(!isset($_GET['client_ID'])){ API_helper::failResponse('client_ID option required',401); exit(); } 
            if(!isset($_GET['signature'])){ API_helper::failResponse('signature option required',401); exit(); } 
            if( md5(Clients::getInstance($_GET['client_ID'])->data['tech_key']) != $_GET['signature'] ){ API_helper::failResponse('wrong signature',401); exit(); } 
            if( Clients::getInstance($_GET['client_ID'])->data['status']!=1 ){ API_helper::failResponse('client not active',401); exit(); } 
        }
        if(!isset($options['timezone'])){
            $options['timezone']=Clients::getInstance()->data['timezone'];
        }
        return $options;
    }
	
}
