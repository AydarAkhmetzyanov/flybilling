<?php

class Currency extends Model
{

    public static function convert($count,$fromC,$toC){
	    if($fromC == $toC){
		    return $count;
		} else {
		    $directRate = self::get(array('fromC' => $fromC, 'toC' => $toC));
		    if($directRate != false){
			    return $count*$directRate[0]['rate'];
			} else {
			    $reverseRate = self::get(array('fromC' => $toC, 'toC' => $fromC));
			    if($reverseRate != false){
			        return $count/$reverseRate[0]['rate'];
			    } else {
			        return $count; //TODO: error log to system log
			    }
			}
		}
	}

    public static function get($data){
        $params=array();
        $tsql="SELECT *";
        $tsql.=" FROM ".SCHEMA.".[Currency] WHERE 1=1 ";
        if(isset($data['fromC'])){
            $tsql.=' AND [fromC]=:fromC';
            $params['fromC']=$data['fromC'];
        }
        if(isset($data['toC'])){
            $tsql.=' AND [toC]=:toC';
            $params['toC']=$data['toC'];
        }
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($params);
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
        }
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            return $row;
        } else {
            return FALSE;
        }
	}

    public static function toRUBUpdate(){
	    $source = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');
        if($source==FALSE){
             return FALSE;
        } else {
            $object = new SimpleXMLElement($source);
            if(is_object($object)){
                $result = FALSE;
                foreach($object->Valute as $value){
                    self::setRate(str_replace(',','.',$value->Value)/$value->Nominal,$value->CharCode,'RUB');
                }
                return $result;
            } else {
                return FALSE;
            }

        }
	}

    private static function setRate($rate,$fromC,$toC){
        echo '<br>'.$rate.$fromC.$toC;
        if(self::get(array('fromC' => $fromC, 'toC' => $toC)) != false){
            try{
                $tsql="UPDATE ".SCHEMA.".[Currency] SET [rate]=:rate WHERE [fromC]=:fromC AND [toC]=:toC ;";
                $statement = Database::getInstance()->prepare($tsql);
                $params=array( 'rate'=>$rate, 'fromC'=>$fromC, 'toC'=>$toC );
                $statement->execute($params);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            try{
                $tsql="INSERT INTO ".SCHEMA.".[Currency] (rate, fromC, toC) VALUES (:rate, :fromC, :toC);";
                $statement = Database::getInstance()->prepare($tsql);
                $params=array( 'rate'=>$rate, 'fromC'=>$fromC, 'toC'=>$toC );
                $statement->execute($params);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

}