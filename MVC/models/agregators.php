<?php

class Agregators extends Model
{

    public static function getAgregators(){
 $tsql = "SELECT * FROM ".SCHEMA.".[Agregators];";
        $stmt = Database::getInstance()->prepare($tsql);
        try{
            $stmt->execute();
        } catch(PDOException $e) {
            echo($e);
        }
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            //var_dump($stmt->fetchAll());
        return $stmt;
	}


}

