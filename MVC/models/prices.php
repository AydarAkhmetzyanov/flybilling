<?php

class Prices extends Model
{

    public static function getPricesJSON($number){ //fixed
           $tsql = "
               SELECT * 
FROM ".SCHEMA.".[Prices] 
WHERE [number]=(SELECT [number] from ".SCHEMA.".[Numbers] where [ID]=$number) and [code]=(SELECT [code] from ".SCHEMA.".[Countries] WHERE [ID]=(SELECT [country_id] FROM ".SCHEMA.".[Numbers] WHERE [ID]=$number));
 ";
        $stmt = Database::getInstance()->prepare($tsql);
        try{
            $stmt->execute();
        } catch(PDOException $e) {
            echo($e);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $res=$rows;
        return json_encode($res);
        }

    public static function getPrices($number){
            $stmt = Database::getInstance()->prepare("
                            SELECT * FROM ".SCHEMA.".[prices] 
                            WHERE [number]=(SELECT [number] from ".SCHEMA.".[numbers] where [ID]=$number) 
                            and [code]=(SELECT [code] from ".SCHEMA.".[countries] WHERE [ID]=(SELECT [country_id] FROM ".SCHEMA.".[numbers] WHERE [ID]=$number));
                    ");
          try{
               $stmt->execute();
          } catch(PDOException $e) {
               echo($e);
          }
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //var_dump($stmt->fetchAll());
        return $stmt;
        }

    public static function getForCSV($percent){//deprecated
            $stmt = Database::getInstance()->prepare("
                            SELECT * FROM ".SCHEMA.".[prices]
                    ");
            $stmt->execute();
       if($stmt->rowCount()>0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $stmt=FALSE;
        }
        return $stmt;
        }

    public static function addPrice(){//deprecated
    print_r($_POST);
            $stmt = Database::getInstance()->prepare("
                            SELECT * FROM ".SCHEMA.".[prices] WHERE [operator_short_name]=:operator_short_name AND [number]=:number
                    ");
        $stmt->execute( array(
                            'operator_short_name' => $_POST['operator'],
                    'number' => $_POST['number']
                                    ));
        if($stmt->rowCount()==0){
            $data = array(
            $_POST['number'],$_POST['cost']*100,$_POST['share']*100,$_POST['operator'],$_POST['number']
            );  
            $stmt = Database::getInstance()->prepare("
                            INSERT INTO ".SCHEMA.".[prices]([number], [cost], [share], [operator_short_name],[code]) VALUES ((SELECT [number] from ".SCHEMA.".[numbers] where [ID]=?),?,?,?,
                            (SELECT [code] from ".SCHEMA.".[countries] WHERE [ID]=(SELECT [country_id] FROM ".SCHEMA.".[numbers] WHERE [ID]=?))
                            )
                    ");
            try{
               $stmt->execute($data);
          } catch(PDOException $e) {
               echo($e);
          }
        }
                
        }

    public static function savePrice(){//deprecated
            
                $data = array(
            $_POST['number'],$_POST['cost']*100,$_POST['share']*100,$_POST['operator'],$_POST['id']
            );  
          $stmt = Database::getInstance()->prepare("
                            UPDATE ".SCHEMA.".[prices] SET [number]=(SELECT [number] FROM ".SCHEMA.".[numbers] WHERE [ID]=?),[cost]=?,[share]=?,[operator_short_name]=? WHERE [ID]=?
                    ");

            
             try{
               $stmt->execute($data);
          } catch(PDOException $e) {
               echo($e);
          }
        }

    public static function deletePrice($id){//deprecated
           
                $data = array(
            $id
            );  
           $stmt = Database::getInstance()->prepare("
                            DELETE FROM ".SCHEMA.".[prices] WHERE [ID]=?
                    ");
            try{
               $stmt->execute($data);
          } catch(PDOException $e) {
               echo($e);
          }
        }


}

