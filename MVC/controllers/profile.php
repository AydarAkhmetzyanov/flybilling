<?php

class ProfileController extends Controller {
    
	public function index($change=0){
		if(Clients::isAuth()){
	    $data = array();
        $data['title'] = 'Редактирование профиля';
		
		HTML::setUserLanguage('ru');
        $data['newGuest']=false;
        $data['locale']='ru_RU';
        
		renderView('header', $data);
        echo '<body class="page-main"><div id="wrap">';
        renderView('clientMenu', $data);
		renderView('pages/profile', $data);
		renderView('consoleFooter', $data);
		} else {
            redirect('login');
        }
	}
	
	public function checkPassword(){
		$id = Clients::getInstance()->data['ID'];
		$client = Clients::getClient($id);
		if (Pass::password_verify($_POST['password'], $client['password'])) echo 'correct';
		else echo 'uncorrect';
	}
	
	public function submit(){
		if ($_POST) {
			$message = '';
			
			$id = Clients::getInstance()->data['ID'];
			$client = Clients::getClient($id);
			if ($_POST['oldPassword']) {
				if (Pass::password_verify($_POST['oldPassword'], $client['password'])) {
					Clients::updateProfile($_POST);
					$message = 'Профиль успешно изменен';
				}
				else $message = 'Вы ввели неверный старый пароль';
			}
			else {
				Clients::updateProfile($_POST);
				$message = 'Профиль успешно изменен';
			}
			
			if(Clients::isAuth()){
			$data = array();
			$data['title'] = 'Редактирование профиля';
			
			HTML::setUserLanguage('ru');
			$data['newGuest']=false;
			$data['locale']='ru_RU';
			
			renderView('header', $data);
			echo '<body class="page-main"><div id="wrap">';
			renderView('clientMenu', $data);
			echo '<div class="page-inner page-inner-console">
				<div class="top-promo">
							<div class="container">
								<div class="hero-unit">
									<h1>Редактирование профиля</h1>
									<div class="promo-3angl-1" data-stellar-ratio="2" data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
									<div class="promo-3angl-2" data-stellar-ratio="1.5"  data-stellar-vertical-offset="80" data-stellar-horizontal-offset="100"></div>
								</div>
							</div>
							<div class="promo-3angl-3" data-stellar-ratio="1.5"  data-stellar-vertical-offset="70"></div>
							<div class="promo-top-bottom"></div>
						</div>

						<div class="container content">
							<div class="polygon-2" data-stellar-ratio="0.3"  data-stellar-vertical-offset="250"></div>

						<div class="content-inner">
							'.$message.'
						</div>
						</div>
						
				</div>';
			renderView('consoleFooter', $data);
			} else {
				redirect('login');
			}
		}
		else redirect('profile');
	}

}