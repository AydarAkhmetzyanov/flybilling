<?php

class ServicesController extends Controller {
    
	public function index($change=0){
		if(Clients::isAuth()){
	    $data = array();
        $data['title'] = 'Сервисы';
		
		HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';
        
		renderView('header', $data);
        echo '<body class="page-main"><div id="wrap">';
        renderView('clientMenu', $data);
		renderView('pages/console/services', $data);
		renderView('consoleFooter', $data);
		} else {
            redirect('login');
        }
	}
	

}