<?php

class Mail
{
	public static function sendEmailValidation($email, $activateLink)
	{
		$sendgrid = new SendGrid('azure_fa53844c48b1208b55c8053f0ad07bf3@azure.com', 'zrwxw7cd');
		$mail = new SendGrid\Mail();
		  $mail->
		  addTo($email)->
		  setFrom(EMAIL)->
		  setSubject('Подтверждение регистрации '.BRAND)->
		  setText($activateLink)->
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
		<td style="background: #2C2C2C; padding: 20px; text-align: center;"><a href="'.SITE.'" target="_blank"><img src="'.SITE.'/img/logo-flybill.png"></a></td>
	</tr>
	<tr style="color: #fff;">
		<td style="background: #338DDC url('.SITE.'/img/promo-top-bottom.png) no-repeat right 25px; padding: 20px 20px 30px; font-weight: bold; font-size: 26px;">Подтверждение регистрации</td>
	</tr>
	<tr style="color: #000;">
		<td style="background: url('.SITE.'/img/polygon-1.png) no-repeat right center; padding: 20px;">
			<p style="margin-bottom: 10px;">Для завершения регистрации перейдите по ссылке ниже:</p>
			<p style="margin-bottom: 10px;"><a target="_blank" href="'.$activateLink.'">Завершить регистрацию</a></p>
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
		  return $sendgrid->smtp->send($mail);
	}
}