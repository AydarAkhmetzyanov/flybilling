<?php

class Mail
{
	
	public static function send($html, $email, $subject)
	{
		$subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: FlyBill <info@flybill.ru>\r\n";
		
		$body = "<html> 
    <head> 
        <title>$subject</title> 
    </head> 
    <body>";
		$body .= $html;
		$body .= '</body> 
</html>';
		
		return mail($email, $subject, $body, $headers);
	}
	
	public static function sendEmailValidation($email, $activateLink)
	{
		$subject = 'Регистрация FlyBill.ru';
		$message = ' 
    <img src="http://flybill.ru/flybillSmall.png"><br>
    <h1>FlyBill Регистрация почти завершена!</h1>
        <p><a target="_blank" href="' . $activateLink . '">Завершить регистрацию</a></p> 
    ';
		return Mail::send($message, $email, $subject);
	}
	
	public static function sendInMessage($email)
	{
		$subject = 'FlyBill.ru активация';
		$message = '
    <img src="http://flybill.ru/flybillSmall.png"><br>
    <h1>FlyBill Теперь вы можете принимать оплату через смс.</h1>
        <p><a target="_blank" href="http://flybill.ru/login">Войти в панель управления</a></p> 
    ';
		return Mail::send($message, $email, $subject);
	}
	
	public static function sendOutMessage($email)
	{
		$subject = 'FlyBill.ru активация';
		$message = '
    <img src="http://flybill.ru/flybillSmall.png"><br>
    <h1>FlyBill Теперь вы можете выводить средства.</h1>
        <p><a target="_blank" href="http://flybill.ru/login">Войти в панель управления</a></p> 
    ';
		return Mail::send($message, $email, $subject);
	}
	
	public static function dynamicError($email)
	{
		$subject = 'FlyBill.ru ваш обработчик не доступен';
		$message = '
    <img src="http://flybill.ru/flybillSmall.png"><br>
    <h1>FlyBill ваш обработчик не отвечает, в ответ на смс отправляется статичный ответ.</h1>
        <p><a target="_blank" href="http://flybill.ru/login">Войти в панель управления</a></p> 
    ';
		return Mail::send($message, $email, $subject);
	}
	
	public static function sendToSupport($email, $phone, $message)
	{
		$subject = 'FlyBill.ru письмо в поддержку';
		$message = '
    <h2>' . $email . '</h2><h2>' . $phone . '</h2>
        <p>' . $message . '</p> 
    ';
		return Mail::send($message, 'info@flybill.ru', $subject);
	}
	
	
	public static function sendToUserStartNewText($email, $type, $text)
	{
		$subject = 'FlyBill.ru изменения стартового текста';
		if ($type == 'y') {
			$message = '  <img src="http://flybill.ru/flybillSmall.png"><br>
    Изменения приняты ';
		} else {
			$message = "В изменениях отказано по причине: " . $text;
		}
		return Mail::send($message, 'info@flybill.ru', $subject);
	}
	
	
	
	public static function sendToUserOut($email, $type)
	{
		$subject = 'FlyBill.ru запрос на вывод средств';
		if ($type == 'y') {
			$message = '  <img src="http://flybill.ru/flybillSmall.png"><br>
    Запрос выпполнен ';
		} else {
			$message = "В запросе отказано";
		}
		return Mail::send($message, 'info@flybill.ru', $subject);
	}
	
	
	
	
	public static function sendToUsermtsubscriptions($email, $type, $text)
	{
		$subject = 'FlyBill.ru смена режима Мт подписки';
		if ($type == 'y') {
			$message = '  <img src="http://flybill.ru/flybillSmall.png"><br>
    Запрос выпполнен ';
		} else {
			$message = "В изменениях отказано по причине: " . $text;
		}
		return Mail::send($message, 'info@flybill.ru', $subject);
	}
	
}