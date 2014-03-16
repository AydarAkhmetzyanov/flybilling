<?php

class IndexController extends Controller {
    
	public function index($change=0){
		if(Clients::isAdmin()){
	    $data = array();
        $data['title'] = 'Панель администратора';
		
		HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';
        
		renderView('header', $data);
        echo '<body class="page-main"><div id="wrap">';
        renderView('adminMenu', $data);
		renderView('pages/administration/index', $data);
		renderView('consoleFooter', $data);
		} else {
            $data = array();
			$data['title'] = 'Вход в панель администратора';
			
			HTML::setUserLanguage('ru');
			$data['newGuest']=false;
			$data['locale']='ru_RU';
			
			renderView('header', $data);
			echo '<body class="page-inner">';
			renderView('menu', $data);
			renderView('pages/administration/login', $data);
			renderView('footer', $data);
        }
	}
	
	public function login(){
	    if(isset($_POST['login']) && isset($_POST['password'])){
		    $arr = Clients::checkAdminLoginData($_POST['login'], $_POST['password']);
            echo json_encode($arr);
        }
	}
	

}