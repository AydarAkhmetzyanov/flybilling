<?php

class MtsubscriptionsController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'МТ подписки СМС';

        HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';

		renderView('header', $data);
        echo '<body class="page-inner">';
        renderView('menu', $data);
		renderView('pages/services/mtsubscriptions', $data);
		renderView('footer', $data);
	}
	

}