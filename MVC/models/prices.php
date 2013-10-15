<?php

class Prices extends Model
{

    public static function getPricesJSON($number){
	    global $db;
		$stmt = $db->prepare("
			    SELECT * FROM `prices` WHERE `number`=(SELECT `number` from `numbers` where `id`=:number) and `code`=(SELECT `code` from `countries` WHERE `id`=(SELECT `country_id` FROM `numbers` WHERE `id`=:number))
		    ");
        $stmt->execute(array('number' => $number));
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        return json_encode($stmt->fetchAll());
	}

    public static function getPrices($number){
	    global $db;
		$stmt = $db->prepare("
			    SELECT * FROM `prices` WHERE `number`=(SELECT `number` from `numbers` where `id`=:number) and `code`=(SELECT `code` from `countries` WHERE `id`=(SELECT `country_id` FROM `numbers` WHERE `id`=:number))
		    ");
        $stmt->execute(array('number' => $number));
        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
	}

    public static function getForCSV($percent){
	    global $db;
            $stmt = $db->prepare("
			    SELECT * FROM `prices`
		    ");
            $stmt->execute();
       if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
	}

    public static function addPrice(){
	    global $db;
        $stmt = $db->prepare("
			    SELECT * FROM `prices` WHERE `operator_short_name`=:operator_short_name AND `number`=:number
		    ");
        $stmt->execute( array(
		            'operator_short_name' => $_POST['operator'],
                    'number' => $_POST['number']
				    ));
        if($stmt->rowCount()==0){
            $data = array(
            $_POST['number'],$_POST['cost']*100,$_POST['share']*100,$_POST['operator'],$_POST['operator']
            );  
            $stmt = $db->prepare('
			    INSERT INTO `prices`(`number`, `cost`, `share`, `operator_short_name`,`code`) VALUES ((SELECT `number` from `numbers` where `id`=?),?,?,?,(SELECT `code` from `operators` where `short_name`=?))
		    ');
            $stmt->execute($data);
        }
		
	}

    public static function savePrice(){
	    global $db;
		$data = array(
            $_POST['number'],$_POST['cost']*100,$_POST['share']*100,$_POST['operator'],$_POST['id']
            );  
            $stmt = $db->prepare('
			    UPDATE `prices` SET `number`=?,`cost`=?,`share`=?,`operator_short_name`=? WHERE `id`=?
		    ');
            $stmt->execute($data);
	}

    public static function deletePrice($id){
	    global $db;
		$data = array(
            $id
            );  
            $stmt = $db->prepare('
			    DELETE FROM `prices` WHERE `id`=?
		    ');
            $stmt->execute($data);
	}


}