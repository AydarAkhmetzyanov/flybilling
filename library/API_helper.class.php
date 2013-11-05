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
	
}
