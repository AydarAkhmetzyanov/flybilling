<?php

class PremiumController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'Premium SMS';

        HTML::setUserLanguage('en');
        $data['newGuest']=false;
        $data['locale']='en_EN';

        $data['countries'] = Countries::getExCountries();
		renderView('header', $data);
        echo '<body class="page-inner">';
        renderView('menu_en', $data);
		renderView('pages/en/services/premium', $data);
		renderView('footer_en', $data);
	}
	

}