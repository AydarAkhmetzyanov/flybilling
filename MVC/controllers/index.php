<?php

class IndexController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'FlyBill СМС Биллинг';

        HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';

        
		renderView('header', $data);
        echo '<body class="page-main">';
        renderView('menu', $data);
		renderView('pages/index', $data);
		renderView('footer', $data);
	}
	

}