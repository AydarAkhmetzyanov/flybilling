<?php

class Numbers extends Model
{

    public static function getNumbersByCountryJSON($country){
	    global $db;
		$stmt = $db->prepare("
			    SELECT * FROM `numbers` WHERE `country_id`=:c ORDER BY `price` DESC
		    ");
        $stmt->execute( array(
		            'c' => $country
				    ));
        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return json_encode($stmt->fetchAll());
	}

    public static function getNumbers(){
	    global $db;
		$stmt = $db->prepare("
			    SELECT numbers.`id`,  numbers.`number`, numbers.`preprefix`,numbers.`price`, numbers.`country_id`, numbers.`agregator_id`, countries.`name` AS `country`, agregators.`name` AS `agregator` 
                FROM `numbers` numbers , `countries` countries, `agregators` agregators 
                WHERE numbers.`country_id` = countries.`id` and numbers.`agregator_id` = agregators.`id`
                ORDER BY numbers.`country_id`, numbers.`price` DESC
		    ");
        $stmt->execute();
        if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
	}

    public static function addNumber(){
	    global $db;
        $stmt = $db->prepare("
			    SELECT * FROM `numbers` WHERE `country_id`=:c and `number`=:n
		    ");
        $stmt->execute( array(
		            'c' => $_POST['country'],
                    'n' => $_POST['number']
				    ));
        if($stmt->rowCount()==0){
            $data = array(
            $_POST['number'],$_POST['price']*100,$_POST['agregator'],$_POST['country'],$_POST['preprefix']
            );  
            $stmt = $db->prepare('
			    INSERT INTO `numbers`(`number`, `price`, `agregator_id`, `country_id`,`preprefix`) VALUES (?,?,?,?,?)
		    ');
            $stmt->execute($data);
        }
		
	}

    public static function saveNumber(){
        print_r($_POST);
	    global $db;
		$data = array(
            $_POST['price']*100,$_POST['agregator'],$_POST['country'],$_POST['number'],$_POST['preprefix'],$_POST['number']
            );  
            $stmt = $db->prepare('
			    UPDATE `numbers` SET `price`=?,`agregator_id`=?,`country_id`=?,`number`=?,`preprefix`=? WHERE `number`=?
		    ');
            $stmt->execute($data);
	}

    public static function deleteNumber($id){
	    global $db;
		$data = array(
            $id
            );  
            $stmt = $db->prepare('
			    DELETE FROM `numbers` WHERE `id`=?
		    ');
            $stmt->execute($data);
	}


}