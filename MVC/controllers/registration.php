<?php

class RegistrationController extends Controller
{
    
    public function index($referedBy = 0)
    {
        if (!(Clients::isAuth())) {
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
            redirect('');
        }
    }
    
    public function submit()
    {
        if (!(Clients::isAuth())) {
            $data          = array();
            $data['title'] = 'Регистрация';
			
            HTML::setUserLanguage('ru');
            $data['newGuest'] = false;
            $data['locale']   = 'ru_RU';
			
            renderView('header', $data);
            echo '<body class="page-main">';
            renderView('menu', $data);
            echo '<div class="container">';
            //print_r($_POST);
            $secret = Pass::generateString(16);
            Clients::registration($secret);
            $activateLink = 'http://flybill.ru/reg/complete/' . $secret . '/' . $_POST['email'];
            Mail::sendEmailValidation($_POST['email'], $activateLink);
            echo "<h1>На вашу почту отправлено письмо подтверждения регистрации, пройдите по ссылке в письме для завершения.</h1>";
            echo '</div>';
            renderView('footer', $data);
        } else {
            redirect('/');
        }
    }
    
    public function complete($secret, $email)
    {
        Clients::regComplete($secret, $email);
        redirect('');
    }
    
}