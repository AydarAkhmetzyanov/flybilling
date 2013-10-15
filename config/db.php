<?php

//try {
//$db = new PDO("mysql:host=localhost;dbname=creatives_fly", 'root', 'usbw', 
//$db = new PDO("mysql:host=92.53.122.16;dbname=creatives_fly", 'creatives_fly', 'flypsw', 
  //array(
    //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;"
  //));

//}
//catch(PDOException $e) { 
    //echo $e->getMessage();
	//exit();
//}

try {  
    $conn = new PDO ( "sqlsrv:server = tcp:g25tmfm7rt.database.windows.net,1433; Database = dev", "flybilling", "CXquWUMa!");   
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {  
    print( "Error connecting to SQL Server." );  
    die(print_r($e));
}
