<?php

class IndexController extends Controller {
    
	public function index(){
	    $data = array();
        $data['title'] = 'FlyBill SMS Billing';

        HTML::setUserLanguage('en');
        $data['newGuest']=false;
        $data['locale']='en_EN';

		renderView('header', $data);
        echo '<body class="page-main">';
        renderView('menu_en', $data);
		renderView('pages/en/index', $data);
		renderView('footer_en', $data);
	}
	

}