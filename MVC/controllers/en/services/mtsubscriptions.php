<?php

class MtsubscriptionsController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'MT SMS Subscriptions';

        HTML::setUserLanguage('en');
        $data['newGuest']=false;
        $data['locale']='en_EN';

		renderView('header', $data);
        echo '<body class="page-inner">';
        renderView('menu_en', $data);
		renderView('pages/en/services/mtsubscriptions', $data);
		renderView('footer_en', $data);
	}
	

}