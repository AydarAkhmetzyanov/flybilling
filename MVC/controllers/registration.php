<?php

class RegistrationController extends Controller
{
    
    public function index($referedBy = 0)
    {
        if (!(Clients::isAuth())) {
			$_SESSION['captcha'] = Captcha::simple_php_captcha();
            $data          = array();
            $data['title'] = 'Регистрация';
            
            HTML::setUserLanguage('ru');
            $data['newGuest'] = false;
            $data['locale']   = 'ru_RU';
            
            renderView('header', $data);
            echo '<body class="page-inner">';
            renderView('menu', $data);
            renderView('pages/registration', $data);
            renderView('footer', $data);
        } else {
            redirect('console');
        }
    }
    
    public function submit()
    {
			if (!(Clients::isAuth())) {
            $secret = Pass::generateString(16);
            Clients::registration($secret);
			$activateLink='http://'.$_SERVER["HTTP_HOST"].'/registration/complete/'.$secret.'/'.$_POST['email'];
            Mail::sendEmailValidation($_POST['email'],$activateLink);
			
            $data          = array();
            $data['title'] = 'Завершение регистрации';
			
            HTML::setUserLanguage('ru');
            $data['newGuest'] = false;
            $data['locale']   = 'ru_RU';
			
            renderView('header', $data);
            echo '<body class="page-inner">';
            renderView('menu', $data);
            renderView('pages/registration-complete', $data);
            renderView('footer', $data);
        } else {
            redirect('/');
        }
    }
    
    public function complete($secret, $email)
    {
        Clients::regComplete($secret, $email);
        redirect('console');
    }
	
	public function validate()
    {
        echo Clients::checkEmail($_POST['email']);
    }
	
	public function validateCaptcha()
    {
		if (strtolower($_POST['captcha']) == strtolower($_SESSION['captcha']['code']))
		{
			echo 'off';
		}
		else
		{
			echo 'on';
		}
    }
    
}