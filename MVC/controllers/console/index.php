<?php

class IndexController extends Controller {
    
	public function index($change=0){
		if(Clients::isAuth()){
	    $data = array();
        $data['title'] = 'Кабинет пользователя';
		
		HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';
        
		renderView('header', $data);
        echo '<body class="page-main">';
        renderView('clientMenu', $data);
		renderView('pages/console/index', $data);
		renderView('consoleFooter', $data);
		} else {
            redirect('login');
        }
	}
	

}