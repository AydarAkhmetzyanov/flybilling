<?php

class API_response
{

    public static function successResponse(){
        $response=array();
        $response['result']=1;
        echo json_encode($response);
    }

    public static function failResponse($error){
        $response=array();
        $response['result']=0;
        $response['reason']=$error;
        echo json_encode($response);
    }

}

