<?php

class API_helper
{

    public static function requested_with_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function successResponse(){
        $response=array();
        $response['result']=1;
        echo json_encode($response);
    }

    public static function failResponse($error,$code=400){
        http_response_code($code);
        $response=array();
        $response['result']=0;
        $response['code']=$code;
        $response['reason']=$error;
        echo json_encode($response);
    }
	
}
