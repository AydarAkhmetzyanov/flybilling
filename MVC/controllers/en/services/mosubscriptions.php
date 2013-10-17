<?php

class MosubscriptionsController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'Pseudo SMS Subscriptions';

        HTML::setUserLanguage('en');
        $data['newGuest']=false;
        $data['locale']='en_EN';

        $data['countries'] = Countries::getExCountries()->fetchAll();
		renderView('header', $data);
        echo '<body class="page-inner">';
        renderView('menu_en', $data);
		renderView('pages/en/services/mosubscriptions', $data);
		renderView('footer_en', $data);
	}
	

}