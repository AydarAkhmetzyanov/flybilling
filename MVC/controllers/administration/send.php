<?php
error_reporting(1); ini_set('display_errors', 'on'); error_reporting( E_ALL | !E_STRICT );   
class SendController extends Controller {
    
	public function index(){
	        $data = array();
            $data['title'] = 'Рассылка';
		
            $data['newGuest']=false;

            $source='aydar@creativestripe.ru;palatidis@gmail.com';

        $base = explode(';',$source);

        print_r($base);

            foreach($base as $email){
            $sendgrid = new SendGrid('azure_5045b82a4a098fff04fb3a1e2d07af03@azure.com', 'Lpzr8OmBZ1WIgkV');
		$mail = new SendGrid\Mail();
		  $mail->
		  addTo($email)->
		  setFrom('send@payway.org')->
		  setSubject('Подтверждение регистрации '.BRAND)->
		  setText('123')->
		  setHtml('
<!DOCTYPE hmtl>
<html>
<head>
	<meta charset="utf-8">
	<style>
		.flybill-email,
		.flybill-email * {
			margin: 0;
			padding: 0;
			font: 16px Arial, Tahoma, Verdana
		}
	</style>
</head>

<body class="flybill-email">

<table style="width: 100%" cellpadding="0" cellspacing="0" style="font: 16px Arial, Tahoma, Verdana; color: #000;">
	<tr height="60" style="color: #fff;">
		<td style="background: #2C2C2C; padding: 20px; text-align: center;"><a href="'.SITE.'" target="_blank"><img src="'.SITE.'/img/logo-payway.png"></a></td>
	</tr>
	<tr style="color: #fff;">
		<td style="background: #338DDC url('.SITE.'/img/promo-top-bottom.png) no-repeat right 25px; padding: 20px 20px 30px; font-weight: bold; font-size: 26px;">Подтверждение регистрации</td>
	</tr>
	<tr style="color: #000;">
		<td style="background: url('.SITE.'/img/polygon-1.png) no-repeat right center; padding: 20px;">
            <p style="margin-bottom: 10px;"><strong>Добро пожаловать в '.BRAND.'!</strong></p>
            <p style="margin-bottom: 10px;">Мы рады что вы выбрали нас. Наша компания готова предложить вам современные инструменты которые помогут вашему бизнесу. Мы всегда стремимся к взаимовыгодному сотрудничеству.</p>
			<p style="margin-bottom: 10px;"><strong>Для завершения регистрации перейдите по ссылке ниже:</strong></p>
			<p style="margin-bottom: 10px;"><a target="_blank" href="'.'">Завершить регистрацию</a></p>
            <p style="margin-bottom: 10px;">Если вы не регистрировались в '.BRAND.' проигнорируйте это сообщение.</p>
		</td>
	</tr>
	<tr height="62">
		<td style="background: url('.SITE.'/img/advant-top.jpg) no-repeat 50% 0;"></td>
	</tr>
	<tr>
		<td style="background: #D7E6F3; padding: 0 20px 20px; text-align: center; color: #88A1B6; font-size: 13px;"><a href="'.SITE.'" target="_blank">'.BRAND.'</a></td>
	</tr>
</table>

</body>
</html>');
if(isset($_GET['send'])){
    $sendgrid->smtp->send($mail);
}


		  echo '<br>send to:'.$email.'<br>';
            
        }

	
	

}

}