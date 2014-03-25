<?php

//localhost:64449/system/MESSAGES/pl3_async_ru_3-511-8809.php?url=system/MESSAGES/pl3_mo_ru_3-511-8809.php&smsText=a21ib3JkNTY2&phone=79510665133&country=ru&serviceNumber=4444&abonentId=46834203&operator=ON&operatorId=26&network=VolgaTelecom&networkId=4&now=20130916225305&evtId=34484459280&md5key=533AC55C9D1248A609EAE1D981A76E71&prjId=8809&filterKey=&profit=3.9600&profitCurrency=RUB&paymentState=PAID&X-ARR-LOG-ID=122f35c7-d950-4980-9e66-62d1afaa7c64

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS . '..' );
require_once (ROOT . DS . 'core' . DS . 'core.php');

$sms = new SMS_PSEUDO_PL3;
$sms->processMessage();
