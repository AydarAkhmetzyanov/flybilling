<?php

class AnalyticsController extends Controller {
    
	public function index(){
		if(Clients::isAdmin()){
	        $data = array();
            $data['title'] = 'Статистика';
		
		$data['newGuest']=false;
        
		renderView('header', $data);
        echo '<body class="page-main"><div id="wrap">';
        renderView('adminMenu', $data);
		renderView('pages/administration/analytics', $data);
		renderView('consoleFooter', $data);
		} else {
            redirect('administration');
        
	}

    }}