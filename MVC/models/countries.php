<?php

class Countries extends Model
{

	public static function getCountries(){
	    global $db;
		$stmt = $db->prepare("
			    SELECT * FROM `countries`
		    ");
        $stmt->execute();
        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
	}

    public static function getExCountries(){
	    global $db;
		$stmt = $db->prepare("
			    SELECT numbers.`country_id` AS `id`,countries.`name` FROM `numbers` numbers,`countries` countries WHERE numbers.`country_id`=countries.`id` group by `country_id`
		    ");
        $stmt->execute();
        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
	}

}