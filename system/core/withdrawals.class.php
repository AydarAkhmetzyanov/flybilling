<?php

class Withdrawals
{

    public static function insert($data){
        try{
            $tsql="UPDATE ".SCHEMA.".[Clients] SET [balance]=[balance] - :summ WHERE [ID]=:client_ID ;";
            $statement = Database::getInstance()->prepare($tsql);
            $params=array( 'summ'=>$data['summ'], 'client_ID'=>$data['client_ID'] );
            $statement->execute($params);
            $tsql="
                INSERT INTO ".SCHEMA.".[Withdrawals]
                (summ,client_ID,status) 
                VALUES (:summ,:client_ID,0);
            ";
            $statement = Database::getInstance()->prepare($tsql);
            $statement->execute($params);
        } catch(PDOException $e) {
            echo($e->getMessage()); exit();
            return FALSE;
        }
	}

    public static function outAll(){
            $sql="SELECT * FROM ".SCHEMA.".[Clients] WHERE [status]=1 and [balance]>1";
            $statement = Database::getInstance()->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $statement->fetch()) {
               print_r($row);
               
               $options['summ']=$row['balance'];
               $options['client_ID']=$row['ID'];
               $resultData=Withdrawals::insert($options);
               echo $resultData;
           }
	}



}
