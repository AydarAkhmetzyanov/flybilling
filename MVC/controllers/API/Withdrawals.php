<?php

class WithdrawalsController extends Controller {
    
	public function index($id=0){
        //possible get options summ
        $options=$_GET;
        parse_str(file_get_contents('php://input'), $_POST);
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
        $resultData=Withdrawals::get($options);
        API_helper::successResponse($resultData);
    }

    protected function indexPOST($options){
        if(!isset($_POST['summ'])){ API_helper::failResponse('option required: summ',400); exit(); }
        $options['summ']=$_POST['summ'];
        $resultData=Withdrawals::insert($options);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

    public function confirm($ID){ 
        if(!API_helper::isAdmin()){ API_helper::failResponse('admin access required',400); exit(); }
        $resultData=Withdrawals::confirm($ID);
        if($resultData==FALSE){ API_helper::failResponse('unknown error',500); exit(); } 
        API_helper::successResponse($resultData);
    }

}