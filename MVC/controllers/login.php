<?php

class LoginController extends Controller {
    
	public function index($referedBy = 0){
        if(!(Clients::isAuth())){
	    $data = array();
        $data['title'] = 'Авторизация';
		
        HTML::setUserLanguage('ru');
        $data['newGuest'] = false;
        $data['locale']   = 'ru_RU';
		
		renderView('header', $data);
		echo '<body class="page-main">';
        renderView('menu', $data);
		renderView('pages/login', $data);
		renderView('footer', $data);
        } else {
            redirect('');
        }
	}
	
    public function logout(){
        Clients::logOut();
	    $data = array();
        $data['title'] = 'Авторизация';
		renderView('header', $data);
        renderView('guestMenu', $data);
		renderView('pages/login', $data);
		renderView('footer', $data);
	}

    public function login(){
	    if(isset($_POST['email']) && isset($_POST['password'])){
		    $arr = Clients::checkLoginData($_POST['email'], $_POST['password']);
            echo json_encode($arr);
        }
	}

}