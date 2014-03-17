<?php

class Numbers extends Model
{

    public static function getNumbersByCountryJSON($country){ //fixed
                $tsql = "
                            SELECT Numbers.[ID] AS id,Numbers.*,agregators.[name] as provider
                            FROM ".SCHEMA.".[Numbers] Numbers
                            LEFT JOIN ".SCHEMA.".[Agregators] agregators ON Numbers.[agregator_id]=agregators.[ID]
                            WHERE [country_id]=:c ORDER BY [price] DESC
                    ";

        $stmt = Database::getInstance()->prepare($tsql);
        try{
            $stmt->execute(array(
                            'c' => $country
                                    ));
        } catch(PDOException $e) {
            echo($e);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)>0){
            $res=$rows;
        } else {
            $res=FALSE;
        }
        return json_encode($res);
        }

    public static function getNumbers(){
            $stmt = Database::getInstance()->prepare("
                            SELECT numbers.[ID],  numbers.[number], numbers.[preprefix],numbers.[price], numbers.[country_id], numbers.[agregator_id], countries.[name] AS country, agregators.[name] AS agregator 
                FROM ".SCHEMA.".[numbers] numbers , ".SCHEMA.".[countries] countries, ".SCHEMA.".[agregators] agregators 
                WHERE numbers.[country_id] = countries.[ID] and numbers.[agregator_id] = agregators.[ID]
                ORDER BY numbers.[country_id], numbers.[price] DESC
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

    public static function addNumber(){ 
          $stmt = Database::getInstance()->prepare("
                            SELECT * FROM ".SCHEMA.".[numbers] WHERE [country_id]=:c and [number]=:n
                    ");
        $stmt->execute( array(
                            'c' => $_POST['country'],
                    'n' => $_POST['number']
                                    ));
        if($stmt->rowCount()==0){
            $data = array(
            $_POST['number'],$_POST['price']*100,$_POST['agregator'],$_POST['country'],$_POST['preprefix']
            );  
            $stmt = Database::getInstance()->prepare("
                            INSERT INTO ".SCHEMA.".[numbers]([number], [price], [agregator_id], [country_id],[preprefix]) VALUES (?,?,?,?,?)
                    ");
            $stmt->execute($data);
        }
                
        }

    public static function saveNumber(){
        print_r($_POST);
           
                $data = array(
            $_POST['price']*100,$_POST['agregator'],$_POST['country'],$_POST['number'],$_POST['preprefix'],$_POST['number']
            );  
           $stmt = Database::getInstance()->prepare("
                            UPDATE ".SCHEMA.".[numbers] SET [price]=?,[agregator_id]=?,[country_id]=?,[number]=?,[preprefix]=? WHERE [number]=?
                    ");
            $stmt->execute($data);
        }

    public static function deleteNumber($id){
            
                $data = array(
            $id
            );  
            $stmt = Database::getInstance()->prepare("
                            DELETE FROM ".SCHEMA.".[numbers] WHERE [ID]=?
                    ");
            $stmt->execute($data);
        }


}
