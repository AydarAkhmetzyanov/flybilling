<?php

class Countries extends Model
{

        public static function getCountries(){ //fixed
                $tsql = "
                            SELECT * FROM ".SCHEMA.".[Countries]
                    ";

       $stmt = Database::getInstance()->prepare($tsql);
        try{
            $stmt->execute();
        } catch(PDOException $e) {
            echo($e);
        }
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            return $row;
        } else {
            return FALSE;
        }
            //var_dump($stmt->fetchAll());
        return $row;
	}

    public static function getExCountries(){ //fixed
        
                $tsql = "
                            SELECT Numbers.[country_id] AS [id], Countries.[name] AS [name]
FROM ".SCHEMA.".[Numbers] Numbers
LEFT JOIN ".SCHEMA.".[Countries] Countries ON Countries.[id]=Numbers.[country_id]
GROUP BY Numbers.[country_id],Countries.[name];
                    ";

                    $stmt = Database::getInstance()->prepare($tsql);
        try{
            $stmt->execute();
        } catch(PDOException $e) {
            echo($e);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)>0){
            return $rows;
        } else {
            return FALSE;
        }
        return $stmt;
        }

}
