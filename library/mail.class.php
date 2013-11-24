<?php

class Mail
{
	public static function sendEmailValidation($email, $activateLink)
	{
		$sendgrid = new SendGrid('azure_fa53844c48b1208b55c8053f0ad07bf3@azure.com', 'zrwxw7cd');
		$mail = new SendGrid\Mail();
		  $mail->
		  addTo($email)->
		  setFrom('info@flybill.ru')->
		  setSubject('Регистрация FlyBill.ru')->
		  setText($activateLink)->
		  setHtml('<p><a target="_blank" href="'.$activateLink.'">'.$activateLink.'</a></p>');
		  return $sendgrid->smtp->send($mail);
	}
}