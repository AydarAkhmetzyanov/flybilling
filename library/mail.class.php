<?php

class Mail
{
	
	public static function send($email)
	{
		$sendgrid = new SendGrid('azure_fa53844c48b1208b55c8053f0ad07bf3@azure.com', 'zrwxw7cd');
		$mail = new SendGrid\Mail();
$mail->
  addTo($email)->
  setFrom('me@bar.com')->
  setSubject('Subject goes here')->
  setText('Hello World!')->
  setHtml('<strong>Hello World!</strong>');
  return $sendgrid->smtp->send($mail);
	}
	
}