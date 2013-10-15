<?php

class IndexController extends Controller {
    
	public function index($change=0){
	    $data = array();
        $data['title'] = 'Home';

        
		renderView('header', $data);
        echo '<body class="page-main">';
        renderView('clientMenu', $data);
		renderView('pages/console/index', $data);
		renderView('consoleFooter', $data);
	}
	

}