<?php

class PremiumController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'Премиум СМС';

        HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';

        $data['countries'] = Countries::getExCountries()->fetchAll();
		renderView('header', $data);
        echo '<body class="page-inner">';
        renderView('menu', $data);
		renderView('pages/services/premium', $data);
		renderView('footer', $data);
	}
	

}