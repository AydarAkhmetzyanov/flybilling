<?php

class WithdrawalsController extends Controller {
    
	public function index(){
		if(Clients::isAdmin()){
	        $data = array();
            $data['title'] = 'Заявки на вывод средств';
		
            $data['newGuest']=false;
        
		renderView('header', $data);
        echo '<body class="page-main"><div id="wrap">';
            renderView('adminMenu', $data);
		renderView('pages/administration/withdrawals', $data);
		renderView('consoleFooter', $data);
		} else {
            redirect('administration');
        }
	}
	

}